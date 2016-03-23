<?php		

class RS{
	public static $wordpress;
	public static $controls;
	public static $types;
	public static $options;
	public static $version;
	public static $initialized = false;
	public static $message;
	public static $pageid;
	public static $queue;
	public static $jsdata;
	public static $customize;
	public static $customize_panel;

	public static function init(){
		if(!static::$initialized){
			static::$version = RS_VERSION;
			
			static::$initialized = true;
			static::$controls = array();
			static::$wordpress = new stdClass();
			static::$wordpress->version = get_bloginfo('version');
			static::$options = array();
			static::$types = array();
			static::$message = array();
			static::$pageid = md5(static::currentUrl());
			static::$queue = array();
			static::$jsdata = array();
			static::$customize = array();
			static::$customize_panel = array();
			
			$_SESSION[static::$pageid . '-styles'] = array();
				
			static::loadScript('modernizr', RS_LIB_URL . '/scripts/modernizr.min.js', true);
			static::loadScript('jquery');
			
			//add_action( 'login_head', array(__CLASS__, 'commonScript'));
			add_action( 'wp_enqueue_scripts', array(__CLASS__, 'commonScript'));
			add_action( 'login_enqueue_scripts', array(__CLASS__, 'commonScript'));
			add_action( 'admin_print_scripts', array(__CLASS__, 'commonScript'));
			
			static::loadScript('rs-common', RS_LIB_URL . '/scripts/rs.common.min.js', true);
			static::loadStyle('rs-common', RS_LIB_URL . '/styles/rs.common.min.css');
			static::loadStyle('rs-control-common', RS_LIB_URL . '/styles/rs.controls.min.css');
			
			add_action('init', array(__CLASS__, 'wpInit'));
			// add_action('wp_head', array(__CLASS__, 'wpHeader'));
			// add_action('admin_head', array(__CLASS__, 'wpHeader'));
			add_action('wp_footer', array(__CLASS__,'wpFooter'));
			add_action('admin_footer', array(__CLASS__,'wpFooter'));
			add_action('wp_enqueue_scripts', array(__CLASS__,'wpEnqueueScripts'));
			add_action('admin_enqueue_scripts', array(__CLASS__,'wpEnqueueScripts'));
			
			/// FILE SYSTEM ///
			include_once(RS_LIB_PATH . "/classes/class.filesystem.php");
			
			/// INCLUDE ALL CONTROLS ///	
			global $RS;
			include_once(RS_LIB_PATH . "/classes/class.control.php");
			$allfiles = glob(RS_LIB_PATH . "/controls/*", GLOB_ONLYDIR);
			foreach($allfiles as $dir){
				$basename = basename($dir);
				if(is_dir($dir) && file_exists(RS_LIB_PATH . "/controls/$basename/$basename.php")){
					include_once(RS_LIB_PATH . "/controls/$basename/$basename.php");
				}
			}
			
			static::initControl();
			
			
			
			/// DISPLAY MESSAGE ///
			add_action('admin_notices', array(__CLASS__,'showMessage'), 100);
			add_action('wp_footer', array(__CLASS__,'showMessage'), 100);
			add_action('admin_footer', array(__CLASS__,'showMessage'), 100);
			
			/// CUSTOMIZE ///
			add_action('customize_register', array(__CLASS__,'renderCustomizeOptions'));
			require RS_LIB_PATH . '/customize/customize_style.php';
		}
	}
	
	public static function wpInit(){
		if(isset($_POST['rs-options'])){
			
			$groups = array();
			foreach(static::$options as $tab){
				if($tab['controls']){
					$groups[$tab['name']] = $tab['controls'];
				}
				foreach($tab['subtabs'] as $subtab){
					if($subtab['controls']){
						$groups[$subtab['name']] = $subtab['controls'];
					}
				}
			}
			foreach($groups as $group){
				static::saveThemeOptions($group);
			}
			do_action('rs_save_options', $groups);
			exit;
		}
		load_textdomain('rslib', LANGUAGES_PATH . '/' .get_locale() . '.mo');
	}
	
	public static function wpEnqueueScripts(){
		// wp_enqueue_style('rs-page-style', RS_LIB_URL . '/minify/load.php?load=styles&amp;k=' . static::$pageid );
		static::enqueueScript();
	}
	
	public static function wpFooter(){
		$echo_input = count(static::$queue) > 1;
		static::enqueueScript();
		if($echo_input){
			echo balanceTags('<input type="hidden" name="rs-data-input" id="rs-data-input"/>'."\r\n");
		}
		if(!empty(static::$jsdata)){
			echo '<script type="text/javascript"> rs.data = ' . json_encode(static::$jsdata) . "; </script>\r\n";
		}
	}
	
	public static function enqueueScript(){
		if(static::$queue){
			foreach(static::$queue as $ss){
				if($ss[0] == 'script'){
					if($ss[2] == null){
						wp_enqueue_script($ss[1]);
					}	
					else{
						wp_enqueue_script($ss[1], $ss[2], array('jquery'), '', $ss[3]);
					}
				}
				else{
					if($ss[2] == null){
						wp_enqueue_style($ss[1]);
					}	
					else{
						wp_enqueue_style($ss[1], $ss[2]);
					}
				}
			}
			static::$queue = array();
		}
	}
	
	public static function initControl(){
		foreach (get_declared_classes() as $class) {
			if (is_subclass_of($class, 'RsControl')){
				new $class;
			}
		}
	}
	
	public function __call($name, $arguments) {
		return static::__callStatic($name, $arguments);
	}
	
	public static function __callStatic($name, $arguments) {
		if(isset(static::$controls[$name])) {
			return static::renderControl(static::$controls[$name], empty($arguments) ? array() : $arguments[0]);			
		} else {
			return static::message("The control/function named \"$name\" is not found in rs");
		}
	}
	
	public static function addControl($name, $types, $callback) {
		if(rs::isNotEmptyString($name) && rs::isNotEmptyString($callback)){
			
			if(is_array($types)){
				foreach($types as $type){
					if(!isset(static::$types[$type])){
						static::$types[$type] = $callback;
					}
				}
			}
			else if(is_string($types) && !isset(static::$types[$types])){
				static::$types[$types] = $callback;
			}

			static::$controls[$name] = $callback;
			return true;
		}
		return static::message('Please enter the correct parameters to add new control.', 'rs::addControl');
	}
	
	public static function renderControl($name, $options = RS_NOT_SET){
		if($options == RS_NOT_SET){
			$options = $name;
			$name = RS_NOT_SET;
		}
		if(!is_array($options)){
			return static::message('Options must be an array.', 'rs::renderControl');
		}
		if($name == RS_NOT_SET){
			if($options['type'] && $options['type'] != 'untyped'){
				$name = static::$types[$options['type']];
			}
			else{
				return static::message('The "type" property is missing.', 'rs::renderControl');
			}
		}
		
		if(isset($options['name']) && (empty($options['name']))){
			return static::message('Control name is missing.', 'rs::renderControl');
		}

		if(class_exists($name) && method_exists($name, 'render')){
			$obj = new $name; return $obj->render($options);
		}
		else if(function_exists($name)){
			return call_user_func($name, $options);
		}
		else if($name){
			return static::message('Class/function named "' . $name . '" is not found.', 'rs::renderControl');
		}
		else{
			return static::message('The type "' . $options['type'] . '" is not found.', 'rs::renderControl');
		}
	}
	
	public static function addOptionTab($tab){
		if(!is_array($tab)){
			return static::message('Tab options must be an array.', 'rs::addOptionTab');
		}
		$tab = array_merge( array(
			'title' => '[Empty]', 
			'name' => 'tab-' . (count(static::$options) + 1), 
			'link' => '', 
			'icon' => '', 
			'controls' => null
		), $tab);
		
		$tab['subtabs'] = array();
		
		static::$options[$tab['name']] = $tab;
		
		return true;
	}
	
	public static function addOptionSubTab($tab){
		if(!is_array($tab)){
			return static::message('Tab options must be an array.', 'rs::addOptionSubTab');
		}
		if(!isset($tab['parent'])) {
			static::$addOptionTab($tab);
		}
		else if(!isset(static::$options[$tab['parent']])){
			return static::message('The parent tab '.$tab['parent'].' does not exists.', 'rs::addOptionSubTab', true, 'theme-options');
		}
		else{
			$tab = array_merge( array(
				'title' => '[Empty]', 
				'name' => static::$options[$tab['parent']]['name'] . '-sub-' . (count(static::$options[$tab['parent']]['subtabs']) + 1), 
				'link' => '', 
				'icon' => '', 
				'controls' => null
			), $tab);
			
			static::$options[$tab['parent']]['subtabs'][$tab['name']] = $tab;
		}
		return true;
	}
	
	public static function getOption($name, $control_type = null, $output = null, $default = false){
		$value = static::getField($name, 'options', $control_type, $output);
		return $value === false ? $default : $value;
	}
	
	public static function updateOption($name, $value, $control_type = null){
		return static::updateField($name, $value, 'options', $control_type);
	}
	
	public static function deleteOption($key){
		delete_option(RS_META_KEY_PREFIX . $key);
	}
	
	/* 	
	 * Get value of field
	 * getField($name)
	 * getField($name, $post_id)
	 * getField($name, $post_id, $control_type)
	 * getField($name, $post_id, $control_type, $output)
	*/
	public static function getField($name, $id = null, $control_type = null, $output = null){
		if(rs::isNotEmptyString($name)){
			$callback = null;
			
			if($control_type){
				if(isset(static::$types[$control_type])){
					$callback = static::$types[$control_type];
				}
				else if(isset(static::$controls[$control_type])){
					$callback = static::$controls[$control_type];
				}
			}
			else{
				$obj = new RsControl; return $obj->getField($name, $id, $output);
			}
			
			if(class_exists($callback) && method_exists($callback, 'updateField')){
				$obj = new $callback; return $obj->getField($name, $id, $output);
			}
			else{
				$obj = new RsControl; return $obj->getField($name, $id, $output);
			}
		}

		static::message('Name is missing.', 'rs::getField');
		return null;
	}
	
	public static function stripslashes($value){
		if(is_string($value)){
			return stripslashes($value);
		}
		if(is_array($value)){
			foreach($value as $i=>$item){
				$value[$i] = rs::stripslashes($item);
			}
		}
		return $value;
	}
	
	/* 	
	 * Update value of field
	 * updateField($name, $value)
	 * updateField($name, $value, $id)
	 * updateField($name, $value, $id, $control_type)
	*/
	public static function updateField($name, $value , $id = null, $control_type = null){
		if(rs::isNotEmptyString($name)){
			$value = rs::stripslashes($value);
			
			$callback = null;
			
			if($control_type){
				if(isset(static::$types[$control_type])){
					$callback = static::$types[$control_type];
				}
				else if(isset(static::$controls[$control_type])){
					$callback = static::$controls[$control_type];
				}
			}
			else{
				$obj = new RsControl; return $obj->updateField($name, $value, $id);
			}
			
			if(class_exists($callback) && method_exists($callback, 'updateField')){
				$obj = new $callback; return $obj->updateField($name, $value, $id);
			}
			else{
				$obj = new RsControl; return $obj->updateField($name, $value, $id);
			}
		}

		return static::message('Name is missing.', 'rs::updateField');
	}
	

	private static function saveThemeOptions($group, $prefix = ''){
		foreach($group as $control){
			if($control['name']){
				if($prefix){
					$control['name_prefix'] = $prefix;
				}
				else{
					$control['name_prefix'] = isset($control['name_prefix']) ? $control['name_prefix'] : '';
				}
				$name = str_replace(' ', '_', $control['name_prefix'] . $control['name']);
				
				if(isset($_POST[$name])){
					static::updateOption($control['name'], $_POST[$name], $control['type']);
				}
			}
			elseif(is_array($control['controls'])){
				static::saveThemeOptions($control['controls'], $control['name_prefix']);
			}
		}
	}
	
	public function ajaxTrigger($for = 'document'){
		if(rs::isAjax()){
			echo '<script> jQuery(document).trigger("rs-control-rebuild", '.($for == 'document' ? $for : '"' . $for . '"' ).') </script>';
		}
	}
	
	public static function loadScript($name, $url = null, $footer = false){
		if(function_exists($url) || is_array($url)){
			if(wp_script_is('rs-common', 'done') || $footer){
				add_action('admin_print_footer_scripts', $url);
				add_action('wp_print_footer_scripts', $url);
			}
			else{
				add_action('admin_print_scripts', $url);
				add_action('wp_print_scripts', $url);
			}
		}
		else{
			static::$queue[] = array('script', $name, $url, $footer);
		}
	}
	
	public static function removeScript($name){
		wp_dequeue_script($name);
	}
	
	public static function commonScript(){
		$rs = array(
			'wordpress' => array(
				'version' => get_bloginfo('version'),
				'home_url' => home_url('/'),
				'admin_url' => admin_url(),
				'admin_ajax_url' => admin_url('admin-ajax.php'),
				'template_url' => get_template_directory_uri(),
				'is_admin' => is_admin(),
				'is_home' => is_home()
			),
			'php' => array(
				'version' => PHP_VERSION,
				'session_id' => session_id()
			),
			'controls' => array(
				'meta_prefix' => RS_META_KEY_PREFIX 
			),
			'lib' => array(
				'url' => RS_LIB_URL,
				'path' => RS_LIB_PATH,
				'version' => RS_VERSION
			),
			'data' => array()
		);
		
		echo '<script type="text/javascript" id="rs-js-common"> rs = ' . json_encode($rs) . '</script>' . "\n";
		
		remove_action( 'wp_print_scripts', array(__CLASS__, 'commonScript'));
	}
	
	public static function preLoad($controls = null){
		if(empty($controls) || $controls == 'all'){
			foreach(static::$controls as $name){
				if(class_exists($name) && method_exists($name, 'loadFiles')){
					$obj = new $name; return $obj->loadFiles();
				}
			}
		}
		elseif(is_array($controls)){
			foreach($controls as $name){
				static::preLoad($name);
			}
		}
		elseif(is_string($controls)){
			if(isset(static::$types[$controls])){
				$callback = static::$types[$controls];
			}
			else if(isset(static::$controls[$controls])){
				$callback = static::$controls[$controls];
			}
			if(class_exists($callback) && method_exists($callback, 'loadFiles')){
				$obj = new $callback; return $obj->loadFiles();
			}
		}	
	}
	
	public static function setJSData($name, $value){
		static::$jsdata[$name] = $value; 
	}
	
	public static function getJSData($name){
		return isset(static::$jsdata[$name]) ? static::$jsdata[$name] : array();
	}
	
	public static function loadStyle($name, $url = null){		
		if(function_exists($url) || is_array($url)){
			if(wp_script_is('rs-common', 'done')){
				add_action('admin_footer', $url);
				add_action('wp_footer', $url);
			}
			else{
				add_action('admin_print_styles', $url);
				add_action('wp_print_styles', $url);
			}
		}
		else{
			if(is_admin()){
				static::$queue[] = array('style', $name, $url);
			}
			else{
				$sname = static::$pageid . '-styles';
				if(!isset($_SESSION[$sname])){
					$_SESSION[$sname] = array();
				}
				if(!isset($_SESSION[$sname][$name])){
					$_SESSION[$sname][$name] = $url;
				}
			}
		}
	}
	
	public static function removeStyle($name){
		wp_dequeue_style($name);
	}

	
	public static function message($message, $from = null, $error = true, $page = ''){
		return static::$message[] = array('rs-message' => true, 'message' => $message, 'from' => $from, 'error' => $error, 'page' => $page);
	}
	
	public static function showMessage(){
		foreach(static::$message as $key=>$message){
			if($message['page'] == '' || is_page($message['page']) || $_REQUEST['page'] == $message['page']){
				$message_content = empty($message['from']) ? $message['message'] : '[' . $message['from'] . '] ' . $message['message'];
				echo '<div class="rs-message '. ($message['error'] ? 'error' : 'updated') . '"><p>' . $message_content . '</p></div>';
				unset(static::$message[$key]);
			}
		}
	}
	
	public static function isMessage($message){
		return is_array($message) && $message['rs-message'];
	}
	
	/// SQL ///
	public static function makeSqlBackup($fullname = null){
		if(empty($fullname)){
			if(!file_exists(get_template_directory() . '/sql-backup')){
				$oldumask = umask(0);
				$success = mkdir(get_template_directory() . '/sql-backup', 0777); 
				umask($oldumask);
				if(!$success){
					return false;
				}
			}
			$now = new DateTime('Asia/Ho_Chi_Minh');
			$fullname = get_template_directory() . '/sql-backup/sql-' . $now->format('Y-m-d-H-i-s') . '.sql';
		}
		$data = rs::getSqlData();
		
		if(RsFileSystem::putContents($fullname, $data)){
			return $fullname;
		}
		
		return false;
	}
	
	
	/// HELPER ///

	public static function generateId($name){
		return sanitize_title(str_replace(array('[',']'), '-', $name));
	}
	
	public static function metaKey($key){
		return empty($key) ? "" : RS_META_KEY_PREFIX . $key;
	}
	
	/// HELPER - URL AND PATH ///
	
	public static function isUrl($url){
		return !empty($url) && false !== parse_url($url);
	}
	
	
	public static function isAjax(){
		return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
	}

	public static function currentUrl(){
		return (!empty($_SERVER['HTTPS']) ? "https://" : "http://") . $_SERVER['SERVER_NAME'] . ($_SERVER['SERVER_PORT'] == "80" ? "" : ":" . $_SERVER['SERVER_PORT']) . $_SERVER['REQUEST_URI']; 
	}
	
	public static function currentSiteUrl1(){
		$protocol = is_ssl() ? 'https://' : 'http://';
		$prefix = empty($_SERVER["CONTEXT_PREFIX"]) ? '' : $_SERVER["CONTEXT_PREFIX"];
		$root = isset($_SERVER['CONTEXT_DOCUMENT_ROOT']) ? $_SERVER['CONTEXT_DOCUMENT_ROOT'] : $_SERVER['DOCUMENT_ROOT'];
		$root = str_replace("\\", "/", $root);
		$url = str_replace("\\", "/", __FILE__); 
		$url = str_replace($root, '', $url);
		$url = str_replace(array("///", "//"), "/", $_SERVER['HTTP_HOST'] . '/' . $prefix . '/' . $url);
		$url = explode("/wp-", $protocol . $url);
		return reset($url);
	}
	
	public static function currentSiteUrl2(){

		$protocol = is_ssl() ? 'https://' : 'http://';
		$prefix = empty($_SERVER["CONTEXT_PREFIX"]) ? '' : $_SERVER["CONTEXT_PREFIX"];
		$root = isset($_SERVER['CONTEXT_DOCUMENT_ROOT']) ? $_SERVER['CONTEXT_DOCUMENT_ROOT'] : $_SERVER['DOCUMENT_ROOT'];
		$root = str_replace("\\", "/", $root);
		$url = str_replace("\\", "/", __FILE__); 

		if(strpos($url, $root) === false && isset($_SERVER['PHPRC'])){
			$index_fullpath = $_SERVER['SCRIPT_FILENAME'];
			$index_name = $_SERVER['SCRIPT_NAME'];
			$full_root = str_replace($index_name, '', $index_fullpath);
			$folder = str_replace($root, '', $full_root);
			$root = str_replace(array("\\", "///", "//"), "/", $_SERVER['PHPRC'] . '/' . $folder);
		}
		if(strpos($url, $root) !== false){			
			$url = str_replace($root, '', $url);
			$url = str_replace(array("///", "//"), "/", $_SERVER['HTTP_HOST'] . '/' . $prefix . '/' . $url);
			$url = explode("/wp-", $protocol . $url);
			return reset($url);
		}
		return false;
	}
	
	public static function currentSiteUrl(){
		$filename = $_SERVER['SCRIPT_NAME'];
		$filename = explode("/wp-", $filename);
		$filename = reset($filename);
		$filename = str_replace('/index.php', '', $filename);
		$filename = empty($filename) ? '' : '/' . $filename;
		
		$protocol = is_ssl() ? 'https://' : 'http://';
		$url =  $protocol . str_replace(array("///", "//"), "/", $_SERVER['HTTP_HOST'] . $filename);
		return $url;
	}
	
	public static function urlToPath($url){
		$home = home_url('/');
		$root = str_replace("\\", "/", ABSPATH);
		$url = str_replace($home, "", $url);
		return $root . $url;
	}
	
	public static function pathToUrl($path){
		$path = realpath($path);
		$home = home_url('/');
		$root = str_replace("\\", "/", ABSPATH);
		$path = str_replace(array("\\\\", "\\"), "/", $path);
		$path = str_replace($root, "", $path);
		return $home . $path;
	}
	
	public static function referentUrl(){
		return isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
	}
	
	public static function isAdminUrl($url){
		return strpos($url, admin_url()) !== false;
	}
	
	public static function isSiteUrl($url){
		return strpos($url, home_url('/')) !== false;
	}
	
	public static function parseParams($url){
		$parse = parse_url($url);
		parse_str($parse['query'], $parse);
		return $parse;
	}
	
	/// HELPER - STRING ///
	
	public static function isNotEmptyString($val){
		return is_string($val) && !empty($val);
	}
	
	public static function unicodeDecode($str){
		$str = json_decode('{"text": "'.$str.'"}');
		return $str ? $str->text : '';
	}
	
	public static function unicodeEncode($str){
		return json_encode((string)$str);
	}
	
	public static function sanitizeUnicode($str){
		if($str){
			$unicode = array(
				'a'=>'\u00E1|\u00E0|\u1EA3|\u00E3|\u1EA1|\u0103|\u1EAF|\u1EB7|\u1EB1|\u1EB3|\u1EB5|\u00E2|\u1EA5|\u1EA7|\u1EA9|\u1EAB|\u1EAD',
				'd'=>'\u0111',
				'e'=>'\u00E9|\u00E8|\u1EBB|\u1EBD|\u1EB9|\u00EA|\u1EBF|\u1EC1|\u1EC3|\u1EC5|\u1EC7',
				'i'=>'\u00ED|\u00EC|\u1EC9|\u0129|\u1ECB',
				'o'=>'\u00F3|\u00F2|\u1ECF|\u00F5|\u1ECD|\u00F4|\u1ED1|\u1ED3|\u1ED5|\u1ED7|\u1ED9|\u01A1|\u1EDB|\u1EDD|\u1EDF|\u1EE1|\u1EE3',
				'u'=>'\u00FA|\u00F9|\u1EE7|\u0169|\u1EE5|\u01B0|\u1EE9|\u1EEB|\u1EED|\u1EEF|\u1EF1',
				'y'=>'\u00FD|\u1EF3|\u1EF7|\u1EF9|\u1EF5',
				'A'=>'\u00C1|\u00C0|\u1EA2|\u00C3|\u1EA0|\u0102|\u1EAE|\u1EB6|\u1EB0|\u1EB2|\u1EB4|\u00C2|\u1EA4|\u1EA6|\u1EA8|\u1EAA|\u1EAC',
				'D'=>'\u0110',
				'E'=>'\u00C9|\u00C8|\u1EBA|\u1EBC|\u1EB8|\u00CA|\u1EBE|\u1EC0|\u1EC2|\u1EC4|\u1EC6',
				'I'=>'\u00CD|\u00CC|\u1EC8|\u0128|\u1ECA',
				'O'=>'\u00D3|\u00D2|\u1ECE|\u00D5|\u1ECC|\u00D4|\u1ED0|\u1ED2|\u1ED4|\u1ED6|\u1ED8|\u01A0|\u1EDA|\u1EDC|\u1EDE|\u1EE0|\u1EE2',
				'U'=>'\u00DA|\u00D9|\u1EE6|\u0168|\u1EE4|\u01AF|\u1EE8|\u1EEA|\u1EEC|\u1EEE|\u1EF0',
				'Y'=>'\u00DD|\u1EF2|\u1EF6|\u1EF8|\u1EF4',
			);
			$unicode = array_map('rs::unicodeDecode', $unicode);
			foreach($unicode as $nonUnicode=>$uni){
			   $str = preg_replace("/($uni)/", $nonUnicode, $str);
			}
		}
		return $str;
	}
   
	/// HELPER - FILE AND MEDIA ///
	public static function getExtension($filename){
		return preg_replace('/^.+?\.([^.]+)$/', '$1', $filename);
	}
	
	public static function getIcon($file){
		$ext = static::getExtension('...' . $file);
		$type = wp_ext2type($ext);
		$icon = wp_mime_type_icon($type ? $type : $ext);
		if(!$icon) $icon = home_url('/') . '/wp-includes/images/media/default.png';
		return $icon;
	}
	
	public static function getThumbnail($url, $width = 150, $height = 150, $crop = true){
		$type = wp_ext2type(static::getExtension($url));
		$path = static::urlToPath($url);
		if(strpos($type , "image") !== false){
			$image = wp_get_image_editor($path);
			if (!is_wp_error($image)) {
				$image->resize( $width, $height, $crop );
				$thumbnail = $image->generate_filename("{$width}x{$height}");
				$image->save($thumbnail);
				$thumbnail = static::pathToUrl($thumbnail);
			}
			else{
				$thumbnail = $url;
			}
		}
		else{	
			$thumbnail = wp_mime_type_icon($type);
		}
		return $thumbnail;
	}
	
	//Add Customize Panel
	public static function addCustomizePanel($tab){
		
		if(!is_array($tab)){
			return static::message('Tab options must be an array.', 'rs::addCustomizePanel');
		}
		$tab = array_merge( array(
			'title' => '[Empty]', 
			'name' => 'panel-customize-' . (count(static::$customize_panel) + 1),
			'priority' => 30,
			'controls' => null
		), $tab);
		
		static::$customize_panel[$tab['name']] = $tab;
		return true;
	}
	
	//Add Customize Tab
	public static function addCustomizeTab($tab){
		
		if(!is_array($tab)){
			return static::message('Tab options must be an array.', 'rs::addCustomizeTab');
		}
		$tab = array_merge( array(
			'title' => '[Empty]', 
			'name' => 'tab-customize-' . (count(static::$customize) + 1),
			'priority' => 30,
			'controls' => null
		), $tab);
		
		static::$customize[$tab['name']] = $tab;
		return true;
	}
	
	public static function renderCustomizeOptions($wp_customize){
		if(static::$customize){
			include_once(RS_LIB_PATH . '/customize/customize.php');
		}
	}
}

global $RS;
$RS = new RS(); $RS->init();

