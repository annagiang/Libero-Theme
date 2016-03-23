<?php
/// Google Control - Render Script And HTML ////

class RsGoogle extends RsControl{
	public $default = array(
		'name' => 'googlefonts', 
		'type' => 'googlefonts',
		'multiple' => false,
		'render_by' => null,
		'width' => null
	);
	public function RsGoogle(){
		$this->addControl('googlefonts', 'googlefonts');
	}
	public function loadFiles(){
		rs::loadStyle('rs-selecbox', RS_LIB_URL . '/scripts/jquery.rs.selectbox/jquery.rs.selectbox.min.css');
		rs::loadScript('rs-selecbox', RS_LIB_URL . '/scripts/jquery.rs.selectbox/jquery.rs.selectbox.min.js', true);
		rs::loadScript('rs-selecbox-init', RS_LIB_URL . '/controls/selectbox/selectbox.min.js', true);
	}
	public function render($options = array()){
		
		if(!$options = $this->parseOptions($options)){
			return $this->renderError();
		}
		
		$this->loadFiles();
		
		$wrapid = $this->addConditionalLogic($options);		
		
		$class_render_by = $options['render_by'] == 'cpanel' ? '' : 'rs-selecbox';
		$class_multiple = $options['multiple'] ? 'rs-selectbox-multiple' : '';
		
		$wstyle = $options['width'] ? "width: {$options['width']}" : "";
		
		?>
		<div id="<?php echo esc_attr($wrapid) ?>" class="rs-control rs-googlefonts <?php echo esc_attr($class_render_by) ?> <?php echo esc_attr($class_multiple) ?> <?php echo esc_attr($options['css_class']) ?>" style="<?php echo esc_attr($wstyle) ?>"> 
			<select id="<?php echo esc_attr($options['field_id']) ?>" name="<?php echo esc_attr($options['field_name']) ?>" <?php echo esc_attr($options['multiple']) ?>>
				<option value="0">Select Font</option>
				<option value="Andale Mono">Andale Mono</option>
				<option value="Arial">Arial</option>
				<option value="Arial:600">Arial Bold</option>
				<option value="Arial:400italic">Arial Italic</option>
				<option value="Arial:600italic">Arial Bold Italic</option>
				<option value="Arial Black">Arial Black</option>
				<option value="Comic Sans MS">Comic Sans MS</option>
				<option value="Comic Sans MS:600">Comic Sans MS Bold</option>
				<option value="Courier New">Courier New</option>
				<option value="Courier New:600">Courier New Bold</option>
				<option value="Courier New:400italic">Courier New Italic</option>
				<option value="Courier New:600italic">Courier New Bold Italic</option>
				<option value="Georgia">Georgia</option>
				<option value="Georgia:600">Georgia Bold</option>
				<option value="Georgia:400italic">Georgia Italic</option>
				<option value="Georgia:600italic">Georgia Bold Italic</option>
				<option value="Impact Lucida Console">Impact Lucida Console</option>
				<option value="Lucida Sans Unicode">Lucida Sans Unicode</option>
				<option value="Marlett">Marlett</option>
				<option value="Minion Web">Minion Web</option>
				<option value="Symbol">Symbol</option>
				<option value="Times New Roman">Times New Roman</option>
				<option value="Times New Roman:600">Times New Roman Bold</option>
				<option value="Times New Roman:400italic">Times New Roman Italic</option>
				<option value="Times New Roman:600italic">Times New Roman Bold Italic</option>
				<option value="Tahoma">Tahoma</option>
				<option value="Trebuchet MS">Trebuchet MS</option>
				<option value="Trebuchet MS:600">Trebuchet MS Bold</option>
				<option value="Trebuchet MS:400italic">Trebuchet MS Italic</option>
				<option value="Trebuchet MS:600italic">Trebuchet MS Bold Italic</option>
				<option value="Verdana">Verdana</option>
				<option value="Verdana:600">Verdana Bold</option>
				<option value="Verdana:400italic">Verdana Italic</option>
				<option value="Verdana:600italic">Verdana Bold Italic</option>
				<option value="Webdings">Webdings</option>
				<option value="ABeeZee">ABeeZee</option>
				<option value="ABeeZee:400italic">ABeeZee  italic</option>
				<option value="Abel">Abel</option>
				<option value="Abril Fatface">Abril Fatface</option>
				<option value="Abril Fatface&amp;subset=latin-ext">Abril Fatface latin-ext</option>
				<option value="Aclonica">Aclonica</option>
				<option value="Acme">Acme</option>
				<option value="Actor">Actor</option>
				<option value="Adamina">Adamina</option>
				<option value="Advent Pro:100">Advent Pro bold (100) </option>
				<option value="Advent Pro:200">Advent Pro bold (200) </option>
				<option value="Advent Pro:300">Advent Pro bold (300) </option>
				<option value="Advent Pro">Advent Pro</option>
				<option value="Advent Pro:500">Advent Pro bold (500) </option>
				<option value="Advent Pro:600">Advent Pro bold (600) </option>
				<option value="Advent Pro:700">Advent Pro bold (700) </option>
				<option value="Advent Pro&amp;subset=latin-ext">Advent Pro latin-ext</option>
				<option value="Advent Pro&amp;subset=greek">Advent Pro greek</option>
				<option value="Advent Pro:100&amp;subset=latin-ext">Advent Pro bold (100)  latin-ext</option>
				<option value="Advent Pro:100&amp;subset=greek">Advent Pro bold (100)  greek</option>
				<option value="Advent Pro:200&amp;subset=latin-ext">Advent Pro bold (200)  latin-ext</option>
				<option value="Advent Pro:200&amp;subset=greek">Advent Pro bold (200)  greek</option>
				<option value="Advent Pro:300&amp;subset=latin-ext">Advent Pro bold (300)  latin-ext</option>
				<option value="Advent Pro:300&amp;subset=greek">Advent Pro bold (300)  greek</option>
				<option value="Advent Pro:500&amp;subset=latin-ext">Advent Pro bold (500)  latin-ext</option>
				<option value="Advent Pro:500&amp;subset=greek">Advent Pro bold (500)  greek</option>
				<option value="Advent Pro:600&amp;subset=latin-ext">Advent Pro bold (600)  latin-ext</option>
				<option value="Advent Pro:600&amp;subset=greek">Advent Pro bold (600)  greek</option>
				<option value="Advent Pro:700&amp;subset=latin-ext">Advent Pro bold (700)  latin-ext</option>
				<option value="Advent Pro:700&amp;subset=greek">Advent Pro bold (700)  greek</option>
				<option value="Aguafina Script">Aguafina Script</option>
				<option value="Aguafina Script&amp;subset=latin-ext">Aguafina Script latin-ext</option>
				<option value="Akronim">Akronim</option>
				<option value="Akronim&amp;subset=latin-ext">Akronim latin-ext</option>
				<option value="Aladin">Aladin</option>
				<option value="Aladin&amp;subset=latin-ext">Aladin latin-ext</option>
				<option value="Aldrich">Aldrich</option>
				<option value="Alef">Alef</option>
				<option value="Alef:700">Alef bold (700) </option>
				<option value="Alegreya">Alegreya</option>
				<option value="Alegreya:400italic">Alegreya  italic</option>
				<option value="Alegreya:700">Alegreya bold (700) </option>
				<option value="Alegreya:700italic">Alegreya bold (700) italic</option>
				<option value="Alegreya:900">Alegreya bold (900) </option>
				<option value="Alegreya:900italic">Alegreya bold (900) italic</option>
				<option value="Alegreya&amp;subset=latin-ext">Alegreya latin-ext</option>
				<option value="Alegreya:400italic&amp;subset=latin-ext">Alegreya  italic latin-ext</option>
				<option value="Alegreya:700&amp;subset=latin-ext">Alegreya bold (700)  latin-ext</option>
				<option value="Alegreya:700italic&amp;subset=latin-ext">Alegreya bold (700) italic latin-ext</option>
				<option value="Alegreya:900&amp;subset=latin-ext">Alegreya bold (900)  latin-ext</option>
				<option value="Alegreya:900italic&amp;subset=latin-ext">Alegreya bold (900) italic latin-ext</option>
				<option value="Alegreya SC">Alegreya SC</option>
				<option value="Alegreya SC:400italic">Alegreya SC  italic</option>
				<option value="Alegreya SC:700">Alegreya SC bold (700) </option>
				<option value="Alegreya SC:700italic">Alegreya SC bold (700) italic</option>
				<option value="Alegreya SC:900">Alegreya SC bold (900) </option>
				<option value="Alegreya SC:900italic">Alegreya SC bold (900) italic</option>
				<option value="Alegreya SC&amp;subset=latin-ext">Alegreya SC latin-ext</option>
				<option value="Alegreya SC:400italic&amp;subset=latin-ext">Alegreya SC  italic latin-ext</option>
				<option value="Alegreya SC:700&amp;subset=latin-ext">Alegreya SC bold (700)  latin-ext</option>
				<option value="Alegreya SC:700italic&amp;subset=latin-ext">Alegreya SC bold (700) italic latin-ext</option>
				<option value="Alegreya SC:900&amp;subset=latin-ext">Alegreya SC bold (900)  latin-ext</option>
				<option value="Alegreya SC:900italic&amp;subset=latin-ext">Alegreya SC bold (900) italic latin-ext</option>
				<option value="Alex Brush">Alex Brush</option>
				<option value="Alex Brush&amp;subset=latin-ext">Alex Brush latin-ext</option>
				<option value="Alfa Slab One">Alfa Slab One</option>
				<option value="Alice">Alice</option>
				<option value="Alike">Alike</option>
				<option value="Alike Angular">Alike Angular</option>
				<option value="Allan">Allan</option>
				<option value="Allan:700">Allan bold (700) </option>
				<option value="Allan&amp;subset=latin-ext">Allan latin-ext</option>
				<option value="Allan:700&amp;subset=latin-ext">Allan bold (700)  latin-ext</option>
				<option value="Allerta">Allerta</option>
				<option value="Allerta Stencil">Allerta Stencil</option>
				<option value="Allura">Allura</option>
				<option value="Allura&amp;subset=latin-ext">Allura latin-ext</option>
				<option value="Almendra">Almendra</option>
				<option value="Almendra:400italic">Almendra  italic</option>
				<option value="Almendra:700">Almendra bold (700) </option>
				<option value="Almendra:700italic">Almendra bold (700) italic</option>
				<option value="Almendra&amp;subset=latin-ext">Almendra latin-ext</option>
				<option value="Almendra:400italic&amp;subset=latin-ext">Almendra  italic latin-ext</option>
				<option value="Almendra:700&amp;subset=latin-ext">Almendra bold (700)  latin-ext</option>
				<option value="Almendra:700italic&amp;subset=latin-ext">Almendra bold (700) italic latin-ext</option>
				<option value="Almendra Display">Almendra Display</option>
				<option value="Almendra Display&amp;subset=latin-ext">Almendra Display latin-ext</option>
				<option value="Almendra SC">Almendra SC</option>
				<option value="Amarante">Amarante</option>
				<option value="Amarante&amp;subset=latin-ext">Amarante latin-ext</option>
				<option value="Amaranth">Amaranth</option>
				<option value="Amaranth:400italic">Amaranth  italic</option>
				<option value="Amaranth:700">Amaranth bold (700) </option>
				<option value="Amaranth:700italic">Amaranth bold (700) italic</option>
				<option value="Amatic SC">Amatic SC</option>
				<option value="Amatic SC:700">Amatic SC bold (700) </option>
				<option value="Amethysta">Amethysta</option>
				<option value="Anaheim">Anaheim</option>
				<option value="Anaheim&amp;subset=latin-ext">Anaheim latin-ext</option>
				<option value="Andada">Andada</option>
				<option value="Andada&amp;subset=latin-ext">Andada latin-ext</option>
				<option value="Andika">Andika</option>
				<option value="Andika&amp;subset=latin-ext">Andika latin-ext</option>
				<option value="Andika&amp;subset=cyrillic-ext">Andika cyrillic-ext</option>
				<option value="Andika&amp;subset=cyrillic">Andika cyrillic</option>
				<option value="Angkor">Angkor</option>
				<option value="Annie Use Your Telescope">Annie Use Your Telescope</option>
				<option value="Anonymous Pro">Anonymous Pro</option>
				<option value="Anonymous Pro:400italic">Anonymous Pro  italic</option>
				<option value="Anonymous Pro:700">Anonymous Pro bold (700) </option>
				<option value="Anonymous Pro:700italic">Anonymous Pro bold (700) italic</option>
				<option value="Anonymous Pro&amp;subset=latin-ext">Anonymous Pro latin-ext</option>
				<option value="Anonymous Pro&amp;subset=greek-ext">Anonymous Pro greek-ext</option>
				<option value="Anonymous Pro&amp;subset=cyrillic-ext">Anonymous Pro cyrillic-ext</option>
				<option value="Anonymous Pro&amp;subset=cyrillic">Anonymous Pro cyrillic</option>
				<option value="Anonymous Pro&amp;subset=greek">Anonymous Pro greek</option>
				<option value="Anonymous Pro:400italic&amp;subset=latin-ext">Anonymous Pro  italic latin-ext</option>
				<option value="Anonymous Pro:400italic&amp;subset=greek-ext">Anonymous Pro  italic greek-ext</option>
				<option value="Anonymous Pro:400italic&amp;subset=cyrillic-ext">Anonymous Pro  italic cyrillic-ext</option>
				<option value="Anonymous Pro:400italic&amp;subset=cyrillic">Anonymous Pro  italic cyrillic</option>
				<option value="Anonymous Pro:400italic&amp;subset=greek">Anonymous Pro  italic greek</option>
				<option value="Anonymous Pro:700&amp;subset=latin-ext">Anonymous Pro bold (700)  latin-ext</option>
				<option value="Anonymous Pro:700&amp;subset=greek-ext">Anonymous Pro bold (700)  greek-ext</option>
				<option value="Anonymous Pro:700&amp;subset=cyrillic-ext">Anonymous Pro bold (700)  cyrillic-ext</option>
				<option value="Anonymous Pro:700&amp;subset=cyrillic">Anonymous Pro bold (700)  cyrillic</option>
				<option value="Anonymous Pro:700&amp;subset=greek">Anonymous Pro bold (700)  greek</option>
				<option value="Anonymous Pro:700italic&amp;subset=latin-ext">Anonymous Pro bold (700) italic latin-ext</option>
				<option value="Anonymous Pro:700italic&amp;subset=greek-ext">Anonymous Pro bold (700) italic greek-ext</option>
				<option value="Anonymous Pro:700italic&amp;subset=cyrillic-ext">Anonymous Pro bold (700) italic cyrillic-ext</option>
				<option value="Anonymous Pro:700italic&amp;subset=cyrillic">Anonymous Pro bold (700) italic cyrillic</option>
				<option value="Anonymous Pro:700italic&amp;subset=greek">Anonymous Pro bold (700) italic greek</option>
				<option value="Antic">Antic</option>
				<option value="Antic Didone">Antic Didone</option>
				<option value="Antic Slab">Antic Slab</option>
				<option value="Anton">Anton</option>
				<option value="Anton&amp;subset=latin-ext">Anton latin-ext</option>
				<option value="Arapey">Arapey</option>
				<option value="Arapey:400italic">Arapey  italic</option>
				<option value="Arbutus">Arbutus</option>
				<option value="Arbutus&amp;subset=latin-ext">Arbutus latin-ext</option>
				<option value="Arbutus Slab">Arbutus Slab</option>
				<option value="Arbutus Slab&amp;subset=latin-ext">Arbutus Slab latin-ext</option>
				<option value="Architects Daughter">Architects Daughter</option>
				<option value="Archivo Black">Archivo Black</option>
				<option value="Archivo Black&amp;subset=latin-ext">Archivo Black latin-ext</option>
				<option value="Archivo Narrow">Archivo Narrow</option>
				<option value="Archivo Narrow:400italic">Archivo Narrow  italic</option>
				<option value="Archivo Narrow:700">Archivo Narrow bold (700) </option>
				<option value="Archivo Narrow:700italic">Archivo Narrow bold (700) italic</option>
				<option value="Archivo Narrow&amp;subset=latin-ext">Archivo Narrow latin-ext</option>
				<option value="Archivo Narrow:400italic&amp;subset=latin-ext">Archivo Narrow  italic latin-ext</option>
				<option value="Archivo Narrow:700&amp;subset=latin-ext">Archivo Narrow bold (700)  latin-ext</option>
				<option value="Archivo Narrow:700italic&amp;subset=latin-ext">Archivo Narrow bold (700) italic latin-ext</option>
				<option value="Arimo">Arimo</option>
				<option value="Arimo:400italic">Arimo  italic</option>
				<option value="Arimo:700">Arimo bold (700) </option>
				<option value="Arimo:700italic">Arimo bold (700) italic</option>
				<option value="Arimo&amp;subset=latin-ext">Arimo latin-ext</option>
				<option value="Arimo&amp;subset=greek-ext">Arimo greek-ext</option>
				<option value="Arimo&amp;subset=cyrillic-ext">Arimo cyrillic-ext</option>
				<option value="Arimo&amp;subset=cyrillic">Arimo cyrillic</option>
				<option value="Arimo&amp;subset=vietnamese">Arimo vietnamese</option>
				<option value="Arimo&amp;subset=greek">Arimo greek</option>
				<option value="Arimo:400italic&amp;subset=latin-ext">Arimo  italic latin-ext</option>
				<option value="Arimo:400italic&amp;subset=greek-ext">Arimo  italic greek-ext</option>
				<option value="Arimo:400italic&amp;subset=cyrillic-ext">Arimo  italic cyrillic-ext</option>
				<option value="Arimo:400italic&amp;subset=cyrillic">Arimo  italic cyrillic</option>
				<option value="Arimo:400italic&amp;subset=vietnamese">Arimo  italic vietnamese</option>
				<option value="Arimo:400italic&amp;subset=greek">Arimo  italic greek</option>
				<option value="Arimo:700&amp;subset=latin-ext">Arimo bold (700)  latin-ext</option>
				<option value="Arimo:700&amp;subset=greek-ext">Arimo bold (700)  greek-ext</option>
				<option value="Arimo:700&amp;subset=cyrillic-ext">Arimo bold (700)  cyrillic-ext</option>
				<option value="Arimo:700&amp;subset=cyrillic">Arimo bold (700)  cyrillic</option>
				<option value="Arimo:700&amp;subset=vietnamese">Arimo bold (700)  vietnamese</option>
				<option value="Arimo:700&amp;subset=greek">Arimo bold (700)  greek</option>
				<option value="Arimo:700italic&amp;subset=latin-ext">Arimo bold (700) italic latin-ext</option>
				<option value="Arimo:700italic&amp;subset=greek-ext">Arimo bold (700) italic greek-ext</option>
				<option value="Arimo:700italic&amp;subset=cyrillic-ext">Arimo bold (700) italic cyrillic-ext</option>
				<option value="Arimo:700italic&amp;subset=cyrillic">Arimo bold (700) italic cyrillic</option>
				<option value="Arimo:700italic&amp;subset=vietnamese">Arimo bold (700) italic vietnamese</option>
				<option value="Arimo:700italic&amp;subset=greek">Arimo bold (700) italic greek</option>
				<option value="Arizonia">Arizonia</option>
				<option value="Arizonia&amp;subset=latin-ext">Arizonia latin-ext</option>
				<option value="Armata">Armata</option>
				<option value="Armata&amp;subset=latin-ext">Armata latin-ext</option>
				<option value="Artifika">Artifika</option>
				<option value="Arvo">Arvo</option>
				<option value="Arvo:400italic">Arvo  italic</option>
				<option value="Arvo:700">Arvo bold (700) </option>
				<option value="Arvo:700italic">Arvo bold (700) italic</option>
				<option value="Asap">Asap</option>
				<option value="Asap:400italic">Asap  italic</option>
				<option value="Asap:700">Asap bold (700) </option>
				<option value="Asap:700italic">Asap bold (700) italic</option>
				<option value="Asap&amp;subset=latin-ext">Asap latin-ext</option>
				<option value="Asap:400italic&amp;subset=latin-ext">Asap  italic latin-ext</option>
				<option value="Asap:700&amp;subset=latin-ext">Asap bold (700)  latin-ext</option>
				<option value="Asap:700italic&amp;subset=latin-ext">Asap bold (700) italic latin-ext</option>
				<option value="Asset">Asset</option>
				<option value="Astloch">Astloch</option>
				<option value="Astloch:700">Astloch bold (700) </option>
				<option value="Asul">Asul</option>
				<option value="Asul:700">Asul bold (700) </option>
				<option value="Atomic Age">Atomic Age</option>
				<option value="Aubrey">Aubrey</option>
				<option value="Audiowide">Audiowide</option>
				<option value="Audiowide&amp;subset=latin-ext">Audiowide latin-ext</option>
				<option value="Autour One">Autour One</option>
				<option value="Autour One&amp;subset=latin-ext">Autour One latin-ext</option>
				<option value="Average">Average</option>
				<option value="Average&amp;subset=latin-ext">Average latin-ext</option>
				<option value="Average Sans">Average Sans</option>
				<option value="Average Sans&amp;subset=latin-ext">Average Sans latin-ext</option>
				<option value="Averia Gruesa Libre">Averia Gruesa Libre</option>
				<option value="Averia Gruesa Libre&amp;subset=latin-ext">Averia Gruesa Libre latin-ext</option>
				<option value="Averia Libre:300">Averia Libre bold (300) </option>
				<option value="Averia Libre:300italic">Averia Libre bold (300) italic</option>
				<option value="Averia Libre">Averia Libre</option>
				<option value="Averia Libre:400italic">Averia Libre  italic</option>
				<option value="Averia Libre:700">Averia Libre bold (700) </option>
				<option value="Averia Libre:700italic">Averia Libre bold (700) italic</option>
				<option value="Averia Sans Libre:300">Averia Sans Libre bold (300) </option>
				<option value="Averia Sans Libre:300italic">Averia Sans Libre bold (300) italic</option>
				<option value="Averia Sans Libre">Averia Sans Libre</option>
				<option value="Averia Sans Libre:400italic">Averia Sans Libre  italic</option>
				<option value="Averia Sans Libre:700">Averia Sans Libre bold (700) </option>
				<option value="Averia Sans Libre:700italic">Averia Sans Libre bold (700) italic</option>
				<option value="Averia Serif Libre:300">Averia Serif Libre bold (300) </option>
				<option value="Averia Serif Libre:300italic">Averia Serif Libre bold (300) italic</option>
				<option value="Averia Serif Libre">Averia Serif Libre</option>
				<option value="Averia Serif Libre:400italic">Averia Serif Libre  italic</option>
				<option value="Averia Serif Libre:700">Averia Serif Libre bold (700) </option>
				<option value="Averia Serif Libre:700italic">Averia Serif Libre bold (700) italic</option>
				<option value="Bad Script">Bad Script</option>
				<option value="Bad Script&amp;subset=cyrillic">Bad Script cyrillic</option>
				<option value="Balthazar">Balthazar</option>
				<option value="Bangers">Bangers</option>
				<option value="Basic">Basic</option>
				<option value="Basic&amp;subset=latin-ext">Basic latin-ext</option>
				<option value="Battambang">Battambang</option>
				<option value="Battambang:700">Battambang bold (700) </option>
				<option value="Baumans">Baumans</option>
				<option value="Bayon">Bayon</option>
				<option value="Belgrano">Belgrano</option>
				<option value="Belleza">Belleza</option>
				<option value="Belleza&amp;subset=latin-ext">Belleza latin-ext</option>
				<option value="BenchNine:300">BenchNine bold (300) </option>
				<option value="BenchNine">BenchNine</option>
				<option value="BenchNine:700">BenchNine bold (700) </option>
				<option value="BenchNine&amp;subset=latin-ext">BenchNine latin-ext</option>
				<option value="BenchNine:300&amp;subset=latin-ext">BenchNine bold (300)  latin-ext</option>
				<option value="BenchNine:700&amp;subset=latin-ext">BenchNine bold (700)  latin-ext</option>
				<option value="Bentham">Bentham</option>
				<option value="Berkshire Swash">Berkshire Swash</option>
				<option value="Berkshire Swash&amp;subset=latin-ext">Berkshire Swash latin-ext</option>
				<option value="Bevan">Bevan</option>
				<option value="Bigelow Rules">Bigelow Rules</option>
				<option value="Bigelow Rules&amp;subset=latin-ext">Bigelow Rules latin-ext</option>
				<option value="Bigshot One">Bigshot One</option>
				<option value="Bilbo">Bilbo</option>
				<option value="Bilbo&amp;subset=latin-ext">Bilbo latin-ext</option>
				<option value="Bilbo Swash Caps">Bilbo Swash Caps</option>
				<option value="Bilbo Swash Caps&amp;subset=latin-ext">Bilbo Swash Caps latin-ext</option>
				<option value="Bitter">Bitter</option>
				<option value="Bitter:400italic">Bitter  italic</option>
				<option value="Bitter:700">Bitter bold (700) </option>
				<option value="Bitter&amp;subset=latin-ext">Bitter latin-ext</option>
				<option value="Bitter:400italic&amp;subset=latin-ext">Bitter  italic latin-ext</option>
				<option value="Bitter:700&amp;subset=latin-ext">Bitter bold (700)  latin-ext</option>
				<option value="Black Ops One">Black Ops One</option>
				<option value="Black Ops One&amp;subset=latin-ext">Black Ops One latin-ext</option>
				<option value="Bokor">Bokor</option>
				<option value="Bonbon">Bonbon</option>
				<option value="Boogaloo">Boogaloo</option>
				<option value="Bowlby One">Bowlby One</option>
				<option value="Bowlby One SC">Bowlby One SC</option>
				<option value="Bowlby One SC&amp;subset=latin-ext">Bowlby One SC latin-ext</option>
				<option value="Brawler">Brawler</option>
				<option value="Bree Serif">Bree Serif</option>
				<option value="Bree Serif&amp;subset=latin-ext">Bree Serif latin-ext</option>
				<option value="Bubblegum Sans">Bubblegum Sans</option>
				<option value="Bubblegum Sans&amp;subset=latin-ext">Bubblegum Sans latin-ext</option>
				<option value="Bubbler One">Bubbler One</option>
				<option value="Bubbler One&amp;subset=latin-ext">Bubbler One latin-ext</option>
				<option value="Buda:300">Buda bold (300) </option>
				<option value="Buenard">Buenard</option>
				<option value="Buenard:700">Buenard bold (700) </option>
				<option value="Buenard&amp;subset=latin-ext">Buenard latin-ext</option>
				<option value="Buenard:700&amp;subset=latin-ext">Buenard bold (700)  latin-ext</option>
				<option value="Butcherman">Butcherman</option>
				<option value="Butcherman&amp;subset=latin-ext">Butcherman latin-ext</option>
				<option value="Butterfly Kids">Butterfly Kids</option>
				<option value="Butterfly Kids&amp;subset=latin-ext">Butterfly Kids latin-ext</option>
				<option value="Cabin">Cabin</option>
				<option value="Cabin:400italic">Cabin  italic</option>
				<option value="Cabin:500">Cabin bold (500) </option>
				<option value="Cabin:500italic">Cabin bold (500) italic</option>
				<option value="Cabin:600">Cabin bold (600) </option>
				<option value="Cabin:600italic">Cabin bold (600) italic</option>
				<option value="Cabin:700">Cabin bold (700) </option>
				<option value="Cabin:700italic">Cabin bold (700) italic</option>
				<option value="Cabin Condensed">Cabin Condensed</option>
				<option value="Cabin Condensed:500">Cabin Condensed bold (500) </option>
				<option value="Cabin Condensed:600">Cabin Condensed bold (600) </option>
				<option value="Cabin Condensed:700">Cabin Condensed bold (700) </option>
				<option value="Cabin Sketch">Cabin Sketch</option>
				<option value="Cabin Sketch:700">Cabin Sketch bold (700) </option>
				<option value="Caesar Dressing">Caesar Dressing</option>
				<option value="Cagliostro">Cagliostro</option>
				<option value="Calligraffitti">Calligraffitti</option>
				<option value="Cambo">Cambo</option>
				<option value="Candal">Candal</option>
				<option value="Cantarell">Cantarell</option>
				<option value="Cantarell:400italic">Cantarell  italic</option>
				<option value="Cantarell:700">Cantarell bold (700) </option>
				<option value="Cantarell:700italic">Cantarell bold (700) italic</option>
				<option value="Cantata One">Cantata One</option>
				<option value="Cantata One&amp;subset=latin-ext">Cantata One latin-ext</option>
				<option value="Cantora One">Cantora One</option>
				<option value="Cantora One&amp;subset=latin-ext">Cantora One latin-ext</option>
				<option value="Capriola">Capriola</option>
				<option value="Capriola&amp;subset=latin-ext">Capriola latin-ext</option>
				<option value="Cardo">Cardo</option>
				<option value="Cardo:400italic">Cardo  italic</option>
				<option value="Cardo:700">Cardo bold (700) </option>
				<option value="Cardo&amp;subset=latin-ext">Cardo latin-ext</option>
				<option value="Cardo&amp;subset=greek-ext">Cardo greek-ext</option>
				<option value="Cardo&amp;subset=greek">Cardo greek</option>
				<option value="Cardo:400italic&amp;subset=latin-ext">Cardo  italic latin-ext</option>
				<option value="Cardo:400italic&amp;subset=greek-ext">Cardo  italic greek-ext</option>
				<option value="Cardo:400italic&amp;subset=greek">Cardo  italic greek</option>
				<option value="Cardo:700&amp;subset=latin-ext">Cardo bold (700)  latin-ext</option>
				<option value="Cardo:700&amp;subset=greek-ext">Cardo bold (700)  greek-ext</option>
				<option value="Cardo:700&amp;subset=greek">Cardo bold (700)  greek</option>
				<option value="Carme">Carme</option>
				<option value="Carrois Gothic">Carrois Gothic</option>
				<option value="Carrois Gothic SC">Carrois Gothic SC</option>
				<option value="Carter One">Carter One</option>
				<option value="Caudex">Caudex</option>
				<option value="Caudex:400italic">Caudex  italic</option>
				<option value="Caudex:700">Caudex bold (700) </option>
				<option value="Caudex:700italic">Caudex bold (700) italic</option>
				<option value="Caudex&amp;subset=latin-ext">Caudex latin-ext</option>
				<option value="Caudex&amp;subset=greek-ext">Caudex greek-ext</option>
				<option value="Caudex&amp;subset=greek">Caudex greek</option>
				<option value="Caudex:400italic&amp;subset=latin-ext">Caudex  italic latin-ext</option>
				<option value="Caudex:400italic&amp;subset=greek-ext">Caudex  italic greek-ext</option>
				<option value="Caudex:400italic&amp;subset=greek">Caudex  italic greek</option>
				<option value="Caudex:700&amp;subset=latin-ext">Caudex bold (700)  latin-ext</option>
				<option value="Caudex:700&amp;subset=greek-ext">Caudex bold (700)  greek-ext</option>
				<option value="Caudex:700&amp;subset=greek">Caudex bold (700)  greek</option>
				<option value="Caudex:700italic&amp;subset=latin-ext">Caudex bold (700) italic latin-ext</option>
				<option value="Caudex:700italic&amp;subset=greek-ext">Caudex bold (700) italic greek-ext</option>
				<option value="Caudex:700italic&amp;subset=greek">Caudex bold (700) italic greek</option>
				<option value="Cedarville Cursive">Cedarville Cursive</option>
				<option value="Ceviche One">Ceviche One</option>
				<option value="Changa One">Changa One</option>
				<option value="Changa One:400italic">Changa One  italic</option>
				<option value="Chango">Chango</option>
				<option value="Chango&amp;subset=latin-ext">Chango latin-ext</option>
				<option value="Chau Philomene One">Chau Philomene One</option>
				<option value="Chau Philomene One:400italic">Chau Philomene One  italic</option>
				<option value="Chau Philomene One&amp;subset=latin-ext">Chau Philomene One latin-ext</option>
				<option value="Chau Philomene One:400italic&amp;subset=latin-ext">Chau Philomene One  italic latin-ext</option>
				<option value="Chela One">Chela One</option>
				<option value="Chela One&amp;subset=latin-ext">Chela One latin-ext</option>
				<option value="Chelsea Market">Chelsea Market</option>
				<option value="Chelsea Market&amp;subset=latin-ext">Chelsea Market latin-ext</option>
				<option value="Chenla">Chenla</option>
				<option value="Cherry Cream Soda">Cherry Cream Soda</option>
				<option value="Cherry Swash">Cherry Swash</option>
				<option value="Cherry Swash:700">Cherry Swash bold (700) </option>
				<option value="Cherry Swash&amp;subset=latin-ext">Cherry Swash latin-ext</option>
				<option value="Cherry Swash:700&amp;subset=latin-ext">Cherry Swash bold (700)  latin-ext</option>
				<option value="Chewy">Chewy</option>
				<option value="Chicle">Chicle</option>
				<option value="Chicle&amp;subset=latin-ext">Chicle latin-ext</option>
				<option value="Chivo">Chivo</option>
				<option value="Chivo:400italic">Chivo  italic</option>
				<option value="Chivo:900">Chivo bold (900) </option>
				<option value="Chivo:900italic">Chivo bold (900) italic</option>
				<option value="Cinzel">Cinzel</option>
				<option value="Cinzel:700">Cinzel bold (700) </option>
				<option value="Cinzel:900">Cinzel bold (900) </option>
				<option value="Cinzel Decorative">Cinzel Decorative</option>
				<option value="Cinzel Decorative:700">Cinzel Decorative bold (700) </option>
				<option value="Cinzel Decorative:900">Cinzel Decorative bold (900) </option>
				<option value="Clicker Script">Clicker Script</option>
				<option value="Clicker Script&amp;subset=latin-ext">Clicker Script latin-ext</option>
				<option value="Coda">Coda</option>
				<option value="Coda:800">Coda bold (800) </option>
				<option value="Coda Caption:800">Coda Caption bold (800) </option>
				<option value="Codystar:300">Codystar bold (300) </option>
				<option value="Codystar">Codystar</option>
				<option value="Codystar&amp;subset=latin-ext">Codystar latin-ext</option>
				<option value="Codystar:300&amp;subset=latin-ext">Codystar bold (300)  latin-ext</option>
				<option value="Combo">Combo</option>
				<option value="Combo&amp;subset=latin-ext">Combo latin-ext</option>
				<option value="Comfortaa:300">Comfortaa bold (300) </option>
				<option value="Comfortaa">Comfortaa</option>
				<option value="Comfortaa:700">Comfortaa bold (700) </option>
				<option value="Comfortaa&amp;subset=latin-ext">Comfortaa latin-ext</option>
				<option value="Comfortaa&amp;subset=cyrillic-ext">Comfortaa cyrillic-ext</option>
				<option value="Comfortaa&amp;subset=cyrillic">Comfortaa cyrillic</option>
				<option value="Comfortaa&amp;subset=greek">Comfortaa greek</option>
				<option value="Comfortaa:300&amp;subset=latin-ext">Comfortaa bold (300)  latin-ext</option>
				<option value="Comfortaa:300&amp;subset=cyrillic-ext">Comfortaa bold (300)  cyrillic-ext</option>
				<option value="Comfortaa:300&amp;subset=cyrillic">Comfortaa bold (300)  cyrillic</option>
				<option value="Comfortaa:300&amp;subset=greek">Comfortaa bold (300)  greek</option>
				<option value="Comfortaa:700&amp;subset=latin-ext">Comfortaa bold (700)  latin-ext</option>
				<option value="Comfortaa:700&amp;subset=cyrillic-ext">Comfortaa bold (700)  cyrillic-ext</option>
				<option value="Comfortaa:700&amp;subset=cyrillic">Comfortaa bold (700)  cyrillic</option>
				<option value="Comfortaa:700&amp;subset=greek">Comfortaa bold (700)  greek</option>
				<option value="Coming Soon">Coming Soon</option>
				<option value="Concert One">Concert One</option>
				<option value="Concert One&amp;subset=latin-ext">Concert One latin-ext</option>
				<option value="Condiment">Condiment</option>
				<option value="Condiment&amp;subset=latin-ext">Condiment latin-ext</option>
				<option value="Content">Content</option>
				<option value="Content:700">Content bold (700) </option>
				<option value="Contrail One">Contrail One</option>
				<option value="Convergence">Convergence</option>
				<option value="Cookie">Cookie</option>
				<option value="Copse">Copse</option>
				<option value="Corben">Corben</option>
				<option value="Corben:700">Corben bold (700) </option>
				<option value="Courgette">Courgette</option>
				<option value="Courgette&amp;subset=latin-ext">Courgette latin-ext</option>
				<option value="Cousine">Cousine</option>
				<option value="Cousine:400italic">Cousine  italic</option>
				<option value="Cousine:700">Cousine bold (700) </option>
				<option value="Cousine:700italic">Cousine bold (700) italic</option>
				<option value="Coustard">Coustard</option>
				<option value="Coustard:900">Coustard bold (900) </option>
				<option value="Covered By Your Grace">Covered By Your Grace</option>
				<option value="Crafty Girls">Crafty Girls</option>
				<option value="Creepster">Creepster</option>
				<option value="Crete Round">Crete Round</option>
				<option value="Crete Round:400italic">Crete Round  italic</option>
				<option value="Crete Round&amp;subset=latin-ext">Crete Round latin-ext</option>
				<option value="Crete Round:400italic&amp;subset=latin-ext">Crete Round  italic latin-ext</option>
				<option value="Crimson Text">Crimson Text</option>
				<option value="Crimson Text:400italic">Crimson Text  italic</option>
				<option value="Crimson Text:600">Crimson Text bold (600) </option>
				<option value="Crimson Text:600italic">Crimson Text bold (600) italic</option>
				<option value="Crimson Text:700">Crimson Text bold (700) </option>
				<option value="Crimson Text:700italic">Crimson Text bold (700) italic</option>
				<option value="Croissant One">Croissant One</option>
				<option value="Croissant One&amp;subset=latin-ext">Croissant One latin-ext</option>
				<option value="Crushed">Crushed</option>
				<option value="Cuprum">Cuprum</option>
				<option value="Cuprum:400italic">Cuprum  italic</option>
				<option value="Cuprum:700">Cuprum bold (700) </option>
				<option value="Cuprum:700italic">Cuprum bold (700) italic</option>
				<option value="Cuprum&amp;subset=latin-ext">Cuprum latin-ext</option>
				<option value="Cuprum&amp;subset=cyrillic">Cuprum cyrillic</option>
				<option value="Cuprum:400italic&amp;subset=latin-ext">Cuprum  italic latin-ext</option>
				<option value="Cuprum:400italic&amp;subset=cyrillic">Cuprum  italic cyrillic</option>
				<option value="Cuprum:700&amp;subset=latin-ext">Cuprum bold (700)  latin-ext</option>
				<option value="Cuprum:700&amp;subset=cyrillic">Cuprum bold (700)  cyrillic</option>
				<option value="Cuprum:700italic&amp;subset=latin-ext">Cuprum bold (700) italic latin-ext</option>
				<option value="Cuprum:700italic&amp;subset=cyrillic">Cuprum bold (700) italic cyrillic</option>
				<option value="Cutive">Cutive</option>
				<option value="Cutive&amp;subset=latin-ext">Cutive latin-ext</option>
				<option value="Cutive Mono">Cutive Mono</option>
				<option value="Cutive Mono&amp;subset=latin-ext">Cutive Mono latin-ext</option>
				<option value="Damion">Damion</option>
				<option value="Dancing Script">Dancing Script</option>
				<option value="Dancing Script:700">Dancing Script bold (700) </option>
				<option value="Dangrek">Dangrek</option>
				<option value="Dawning of a New Day">Dawning of a New Day</option>
				<option value="Days One">Days One</option>
				<option value="Delius">Delius</option>
				<option value="Delius Swash Caps">Delius Swash Caps</option>
				<option value="Delius Unicase">Delius Unicase</option>
				<option value="Delius Unicase:700">Delius Unicase bold (700) </option>
				<option value="Della Respira">Della Respira</option>
				<option value="Denk One">Denk One</option>
				<option value="Denk One&amp;subset=latin-ext">Denk One latin-ext</option>
				<option value="Devonshire">Devonshire</option>
				<option value="Devonshire&amp;subset=latin-ext">Devonshire latin-ext</option>
				<option value="Didact Gothic">Didact Gothic</option>
				<option value="Didact Gothic&amp;subset=latin-ext">Didact Gothic latin-ext</option>
				<option value="Didact Gothic&amp;subset=greek-ext">Didact Gothic greek-ext</option>
				<option value="Didact Gothic&amp;subset=cyrillic-ext">Didact Gothic cyrillic-ext</option>
				<option value="Didact Gothic&amp;subset=cyrillic">Didact Gothic cyrillic</option>
				<option value="Didact Gothic&amp;subset=greek">Didact Gothic greek</option>
				<option value="Diplomata">Diplomata</option>
				<option value="Diplomata&amp;subset=latin-ext">Diplomata latin-ext</option>
				<option value="Diplomata SC">Diplomata SC</option>
				<option value="Diplomata SC&amp;subset=latin-ext">Diplomata SC latin-ext</option>
				<option value="Domine">Domine</option>
				<option value="Domine:700">Domine bold (700) </option>
				<option value="Domine&amp;subset=latin-ext">Domine latin-ext</option>
				<option value="Domine:700&amp;subset=latin-ext">Domine bold (700)  latin-ext</option>
				<option value="Donegal One">Donegal One</option>
				<option value="Donegal One&amp;subset=latin-ext">Donegal One latin-ext</option>
				<option value="Doppio One">Doppio One</option>
				<option value="Doppio One&amp;subset=latin-ext">Doppio One latin-ext</option>
				<option value="Dorsa">Dorsa</option>
				<option value="Dosis:200">Dosis bold (200) </option>
				<option value="Dosis:300">Dosis bold (300) </option>
				<option value="Dosis">Dosis</option>
				<option value="Dosis:500">Dosis bold (500) </option>
				<option value="Dosis:600">Dosis bold (600) </option>
				<option value="Dosis:700">Dosis bold (700) </option>
				<option value="Dosis:800">Dosis bold (800) </option>
				<option value="Dosis&amp;subset=latin-ext">Dosis latin-ext</option>
				<option value="Dosis:200&amp;subset=latin-ext">Dosis bold (200)  latin-ext</option>
				<option value="Dosis:300&amp;subset=latin-ext">Dosis bold (300)  latin-ext</option>
				<option value="Dosis:500&amp;subset=latin-ext">Dosis bold (500)  latin-ext</option>
				<option value="Dosis:600&amp;subset=latin-ext">Dosis bold (600)  latin-ext</option>
				<option value="Dosis:700&amp;subset=latin-ext">Dosis bold (700)  latin-ext</option>
				<option value="Dosis:800&amp;subset=latin-ext">Dosis bold (800)  latin-ext</option>
				<option value="Dr Sugiyama">Dr Sugiyama</option>
				<option value="Dr Sugiyama&amp;subset=latin-ext">Dr Sugiyama latin-ext</option>
				<option value="Droid Sans">Droid Sans</option>
				<option value="Droid Sans:700">Droid Sans bold (700) </option>
				<option value="Droid Sans Mono">Droid Sans Mono</option>
				<option value="Droid Serif">Droid Serif</option>
				<option value="Droid Serif:400italic">Droid Serif  italic</option>
				<option value="Droid Serif:700">Droid Serif bold (700) </option>
				<option value="Droid Serif:700italic">Droid Serif bold (700) italic</option>
				<option value="Duru Sans">Duru Sans</option>
				<option value="Duru Sans&amp;subset=latin-ext">Duru Sans latin-ext</option>
				<option value="Dynalight">Dynalight</option>
				<option value="Dynalight&amp;subset=latin-ext">Dynalight latin-ext</option>
				<option value="EB Garamond">EB Garamond</option>
				<option value="EB Garamond&amp;subset=latin-ext">EB Garamond latin-ext</option>
				<option value="EB Garamond&amp;subset=cyrillic-ext">EB Garamond cyrillic-ext</option>
				<option value="EB Garamond&amp;subset=cyrillic">EB Garamond cyrillic</option>
				<option value="EB Garamond&amp;subset=vietnamese">EB Garamond vietnamese</option>
				<option value="Eagle Lake">Eagle Lake</option>
				<option value="Eagle Lake&amp;subset=latin-ext">Eagle Lake latin-ext</option>
				<option value="Eater">Eater</option>
				<option value="Eater&amp;subset=latin-ext">Eater latin-ext</option>
				<option value="Economica">Economica</option>
				<option value="Economica:400italic">Economica  italic</option>
				<option value="Economica:700">Economica bold (700) </option>
				<option value="Economica:700italic">Economica bold (700) italic</option>
				<option value="Economica&amp;subset=latin-ext">Economica latin-ext</option>
				<option value="Economica:400italic&amp;subset=latin-ext">Economica  italic latin-ext</option>
				<option value="Economica:700&amp;subset=latin-ext">Economica bold (700)  latin-ext</option>
				<option value="Economica:700italic&amp;subset=latin-ext">Economica bold (700) italic latin-ext</option>
				<option value="Electrolize">Electrolize</option>
				<option value="Elsie">Elsie</option>
				<option value="Elsie:900">Elsie bold (900) </option>
				<option value="Elsie&amp;subset=latin-ext">Elsie latin-ext</option>
				<option value="Elsie:900&amp;subset=latin-ext">Elsie bold (900)  latin-ext</option>
				<option value="Elsie Swash Caps">Elsie Swash Caps</option>
				<option value="Elsie Swash Caps:900">Elsie Swash Caps bold (900) </option>
				<option value="Elsie Swash Caps&amp;subset=latin-ext">Elsie Swash Caps latin-ext</option>
				<option value="Elsie Swash Caps:900&amp;subset=latin-ext">Elsie Swash Caps bold (900)  latin-ext</option>
				<option value="Emblema One">Emblema One</option>
				<option value="Emblema One&amp;subset=latin-ext">Emblema One latin-ext</option>
				<option value="Emilys Candy">Emilys Candy</option>
				<option value="Emilys Candy&amp;subset=latin-ext">Emilys Candy latin-ext</option>
				<option value="Engagement">Engagement</option>
				<option value="Englebert">Englebert</option>
				<option value="Englebert&amp;subset=latin-ext">Englebert latin-ext</option>
				<option value="Enriqueta">Enriqueta</option>
				<option value="Enriqueta:700">Enriqueta bold (700) </option>
				<option value="Enriqueta&amp;subset=latin-ext">Enriqueta latin-ext</option>
				<option value="Enriqueta:700&amp;subset=latin-ext">Enriqueta bold (700)  latin-ext</option>
				<option value="Erica One">Erica One</option>
				<option value="Esteban">Esteban</option>
				<option value="Esteban&amp;subset=latin-ext">Esteban latin-ext</option>
				<option value="Euphoria Script">Euphoria Script</option>
				<option value="Euphoria Script&amp;subset=latin-ext">Euphoria Script latin-ext</option>
				<option value="Ewert">Ewert</option>
				<option value="Ewert&amp;subset=latin-ext">Ewert latin-ext</option>
				<option value="Exo:100">Exo bold (100) </option>
				<option value="Exo:100italic">Exo bold (100) italic</option>
				<option value="Exo:200">Exo bold (200) </option>
				<option value="Exo:200italic">Exo bold (200) italic</option>
				<option value="Exo:300">Exo bold (300) </option>
				<option value="Exo:300italic">Exo bold (300) italic</option>
				<option value="Exo">Exo</option>
				<option value="Exo:400italic">Exo  italic</option>
				<option value="Exo:500">Exo bold (500) </option>
				<option value="Exo:500italic">Exo bold (500) italic</option>
				<option value="Exo:600">Exo bold (600) </option>
				<option value="Exo:600italic">Exo bold (600) italic</option>
				<option value="Exo:700">Exo bold (700) </option>
				<option value="Exo:700italic">Exo bold (700) italic</option>
				<option value="Exo:800">Exo bold (800) </option>
				<option value="Exo:800italic">Exo bold (800) italic</option>
				<option value="Exo:900">Exo bold (900) </option>
				<option value="Exo:900italic">Exo bold (900) italic</option>
				<option value="Exo&amp;subset=latin-ext">Exo latin-ext</option>
				<option value="Exo:100&amp;subset=latin-ext">Exo bold (100)  latin-ext</option>
				<option value="Exo:100italic&amp;subset=latin-ext">Exo bold (100) italic latin-ext</option>
				<option value="Exo:200&amp;subset=latin-ext">Exo bold (200)  latin-ext</option>
				<option value="Exo:200italic&amp;subset=latin-ext">Exo bold (200) italic latin-ext</option>
				<option value="Exo:300&amp;subset=latin-ext">Exo bold (300)  latin-ext</option>
				<option value="Exo:300italic&amp;subset=latin-ext">Exo bold (300) italic latin-ext</option>
				<option value="Exo:400italic&amp;subset=latin-ext">Exo  italic latin-ext</option>
				<option value="Exo:500&amp;subset=latin-ext">Exo bold (500)  latin-ext</option>
				<option value="Exo:500italic&amp;subset=latin-ext">Exo bold (500) italic latin-ext</option>
				<option value="Exo:600&amp;subset=latin-ext">Exo bold (600)  latin-ext</option>
				<option value="Exo:600italic&amp;subset=latin-ext">Exo bold (600) italic latin-ext</option>
				<option value="Exo:700&amp;subset=latin-ext">Exo bold (700)  latin-ext</option>
				<option value="Exo:700italic&amp;subset=latin-ext">Exo bold (700) italic latin-ext</option>
				<option value="Exo:800&amp;subset=latin-ext">Exo bold (800)  latin-ext</option>
				<option value="Exo:800italic&amp;subset=latin-ext">Exo bold (800) italic latin-ext</option>
				<option value="Exo:900&amp;subset=latin-ext">Exo bold (900)  latin-ext</option>
				<option value="Exo:900italic&amp;subset=latin-ext">Exo bold (900) italic latin-ext</option>
				<option value="Expletus Sans">Expletus Sans</option>
				<option value="Expletus Sans:400italic">Expletus Sans  italic</option>
				<option value="Expletus Sans:500">Expletus Sans bold (500) </option>
				<option value="Expletus Sans:500italic">Expletus Sans bold (500) italic</option>
				<option value="Expletus Sans:600">Expletus Sans bold (600) </option>
				<option value="Expletus Sans:600italic">Expletus Sans bold (600) italic</option>
				<option value="Expletus Sans:700">Expletus Sans bold (700) </option>
				<option value="Expletus Sans:700italic">Expletus Sans bold (700) italic</option>
				<option value="Fanwood Text">Fanwood Text</option>
				<option value="Fanwood Text:400italic">Fanwood Text  italic</option>
				<option value="Fascinate">Fascinate</option>
				<option value="Fascinate Inline">Fascinate Inline</option>
				<option value="Faster One">Faster One</option>
				<option value="Fasthand">Fasthand</option>
				<option value="Fauna One">Fauna One</option>
				<option value="Fauna One&amp;subset=latin-ext">Fauna One latin-ext</option>
				<option value="Federant">Federant</option>
				<option value="Federo">Federo</option>
				<option value="Felipa">Felipa</option>
				<option value="Felipa&amp;subset=latin-ext">Felipa latin-ext</option>
				<option value="Fenix">Fenix</option>
				<option value="Fenix&amp;subset=latin-ext">Fenix latin-ext</option>
				<option value="Finger Paint">Finger Paint</option>
				<option value="Fjalla One">Fjalla One</option>
				<option value="Fjalla One&amp;subset=latin-ext">Fjalla One latin-ext</option>
				<option value="Fjord One">Fjord One</option>
				<option value="Flamenco:300">Flamenco bold (300) </option>
				<option value="Flamenco">Flamenco</option>
				<option value="Flavors">Flavors</option>
				<option value="Fondamento">Fondamento</option>
				<option value="Fondamento:400italic">Fondamento  italic</option>
				<option value="Fondamento&amp;subset=latin-ext">Fondamento latin-ext</option>
				<option value="Fondamento:400italic&amp;subset=latin-ext">Fondamento  italic latin-ext</option>
				<option value="Fontdiner Swanky">Fontdiner Swanky</option>
				<option value="Forum">Forum</option>
				<option value="Forum&amp;subset=latin-ext">Forum latin-ext</option>
				<option value="Forum&amp;subset=cyrillic-ext">Forum cyrillic-ext</option>
				<option value="Forum&amp;subset=cyrillic">Forum cyrillic</option>
				<option value="Francois One">Francois One</option>
				<option value="Francois One&amp;subset=latin-ext">Francois One latin-ext</option>
				<option value="Freckle Face">Freckle Face</option>
				<option value="Freckle Face&amp;subset=latin-ext">Freckle Face latin-ext</option>
				<option value="Fredericka the Great">Fredericka the Great</option>
				<option value="Fredoka One">Fredoka One</option>
				<option value="Freehand">Freehand</option>
				<option value="Fresca">Fresca</option>
				<option value="Fresca&amp;subset=latin-ext">Fresca latin-ext</option>
				<option value="Frijole">Frijole</option>
				<option value="Fruktur">Fruktur</option>
				<option value="Fruktur&amp;subset=latin-ext">Fruktur latin-ext</option>
				<option value="Fugaz One">Fugaz One</option>
				<option value="GFS Didot">GFS Didot</option>
				<option value="GFS Neohellenic">GFS Neohellenic</option>
				<option value="GFS Neohellenic:400italic">GFS Neohellenic  italic</option>
				<option value="GFS Neohellenic:700">GFS Neohellenic bold (700) </option>
				<option value="GFS Neohellenic:700italic">GFS Neohellenic bold (700) italic</option>
				<option value="Gabriela">Gabriela</option>
				<option value="Gabriela&amp;subset=latin-ext">Gabriela latin-ext</option>
				<option value="Gafata">Gafata</option>
				<option value="Gafata&amp;subset=latin-ext">Gafata latin-ext</option>
				<option value="Galdeano">Galdeano</option>
				<option value="Galindo">Galindo</option>
				<option value="Galindo&amp;subset=latin-ext">Galindo latin-ext</option>
				<option value="Gentium Basic">Gentium Basic</option>
				<option value="Gentium Basic:400italic">Gentium Basic  italic</option>
				<option value="Gentium Basic:700">Gentium Basic bold (700) </option>
				<option value="Gentium Basic:700italic">Gentium Basic bold (700) italic</option>
				<option value="Gentium Basic&amp;subset=latin-ext">Gentium Basic latin-ext</option>
				<option value="Gentium Basic:400italic&amp;subset=latin-ext">Gentium Basic  italic latin-ext</option>
				<option value="Gentium Basic:700&amp;subset=latin-ext">Gentium Basic bold (700)  latin-ext</option>
				<option value="Gentium Basic:700italic&amp;subset=latin-ext">Gentium Basic bold (700) italic latin-ext</option>
				<option value="Gentium Book Basic">Gentium Book Basic</option>
				<option value="Gentium Book Basic:400italic">Gentium Book Basic  italic</option>
				<option value="Gentium Book Basic:700">Gentium Book Basic bold (700) </option>
				<option value="Gentium Book Basic:700italic">Gentium Book Basic bold (700) italic</option>
				<option value="Gentium Book Basic&amp;subset=latin-ext">Gentium Book Basic latin-ext</option>
				<option value="Gentium Book Basic:400italic&amp;subset=latin-ext">Gentium Book Basic  italic latin-ext</option>
				<option value="Gentium Book Basic:700&amp;subset=latin-ext">Gentium Book Basic bold (700)  latin-ext</option>
				<option value="Gentium Book Basic:700italic&amp;subset=latin-ext">Gentium Book Basic bold (700) italic latin-ext</option>
				<option value="Geo">Geo</option>
				<option value="Geo:400italic">Geo  italic</option>
				<option value="Geostar">Geostar</option>
				<option value="Geostar Fill">Geostar Fill</option>
				<option value="Germania One">Germania One</option>
				<option value="Gilda Display">Gilda Display</option>
				<option value="Gilda Display&amp;subset=latin-ext">Gilda Display latin-ext</option>
				<option value="Give You Glory">Give You Glory</option>
				<option value="Glass Antiqua">Glass Antiqua</option>
				<option value="Glass Antiqua&amp;subset=latin-ext">Glass Antiqua latin-ext</option>
				<option value="Glegoo">Glegoo</option>
				<option value="Glegoo&amp;subset=latin-ext">Glegoo latin-ext</option>
				<option value="Gloria Hallelujah">Gloria Hallelujah</option>
				<option value="Goblin One">Goblin One</option>
				<option value="Gochi Hand">Gochi Hand</option>
				<option value="Gorditas">Gorditas</option>
				<option value="Gorditas:700">Gorditas bold (700) </option>
				<option value="Goudy Bookletter 1911">Goudy Bookletter 1911</option>
				<option value="Graduate">Graduate</option>
				<option value="Grand Hotel">Grand Hotel</option>
				<option value="Grand Hotel&amp;subset=latin-ext">Grand Hotel latin-ext</option>
				<option value="Gravitas One">Gravitas One</option>
				<option value="Great Vibes">Great Vibes</option>
				<option value="Great Vibes&amp;subset=latin-ext">Great Vibes latin-ext</option>
				<option value="Griffy">Griffy</option>
				<option value="Griffy&amp;subset=latin-ext">Griffy latin-ext</option>
				<option value="Gruppo">Gruppo</option>
				<option value="Gruppo&amp;subset=latin-ext">Gruppo latin-ext</option>
				<option value="Gudea">Gudea</option>
				<option value="Gudea:400italic">Gudea  italic</option>
				<option value="Gudea:700">Gudea bold (700) </option>
				<option value="Gudea&amp;subset=latin-ext">Gudea latin-ext</option>
				<option value="Gudea:400italic&amp;subset=latin-ext">Gudea  italic latin-ext</option>
				<option value="Gudea:700&amp;subset=latin-ext">Gudea bold (700)  latin-ext</option>
				<option value="Habibi">Habibi</option>
				<option value="Habibi&amp;subset=latin-ext">Habibi latin-ext</option>
				<option value="Hammersmith One">Hammersmith One</option>
				<option value="Hammersmith One&amp;subset=latin-ext">Hammersmith One latin-ext</option>
				<option value="Hanalei">Hanalei</option>
				<option value="Hanalei&amp;subset=latin-ext">Hanalei latin-ext</option>
				<option value="Hanalei Fill">Hanalei Fill</option>
				<option value="Hanalei Fill&amp;subset=latin-ext">Hanalei Fill latin-ext</option>
				<option value="Handlee">Handlee</option>
				<option value="Hanuman">Hanuman</option>
				<option value="Hanuman:700">Hanuman bold (700) </option>
				<option value="Happy Monkey">Happy Monkey</option>
				<option value="Happy Monkey&amp;subset=latin-ext">Happy Monkey latin-ext</option>
				<option value="Headland One">Headland One</option>
				<option value="Headland One&amp;subset=latin-ext">Headland One latin-ext</option>
				<option value="Henny Penny">Henny Penny</option>
				<option value="Herr Von Muellerhoff">Herr Von Muellerhoff</option>
				<option value="Herr Von Muellerhoff&amp;subset=latin-ext">Herr Von Muellerhoff latin-ext</option>
				<option value="Holtwood One SC">Holtwood One SC</option>
				<option value="Homemade Apple">Homemade Apple</option>
				<option value="Homenaje">Homenaje</option>
				<option value="Homenaje&amp;subset=latin-ext">Homenaje latin-ext</option>
				<option value="IM Fell DW Pica">IM Fell DW Pica</option>
				<option value="IM Fell DW Pica:400italic">IM Fell DW Pica  italic</option>
				<option value="IM Fell DW Pica SC">IM Fell DW Pica SC</option>
				<option value="IM Fell Double Pica">IM Fell Double Pica</option>
				<option value="IM Fell Double Pica:400italic">IM Fell Double Pica  italic</option>
				<option value="IM Fell Double Pica SC">IM Fell Double Pica SC</option>
				<option value="IM Fell English">IM Fell English</option>
				<option value="IM Fell English:400italic">IM Fell English  italic</option>
				<option value="IM Fell English SC">IM Fell English SC</option>
				<option value="IM Fell French Canon">IM Fell French Canon</option>
				<option value="IM Fell French Canon:400italic">IM Fell French Canon  italic</option>
				<option value="IM Fell French Canon SC">IM Fell French Canon SC</option>
				<option value="IM Fell Great Primer">IM Fell Great Primer</option>
				<option value="IM Fell Great Primer:400italic">IM Fell Great Primer  italic</option>
				<option value="IM Fell Great Primer SC">IM Fell Great Primer SC</option>
				<option value="Iceberg">Iceberg</option>
				<option value="Iceland">Iceland</option>
				<option value="Imprima">Imprima</option>
				<option value="Imprima&amp;subset=latin-ext">Imprima latin-ext</option>
				<option value="Inconsolata">Inconsolata</option>
				<option value="Inconsolata:700">Inconsolata bold (700) </option>
				<option value="Inconsolata&amp;subset=latin-ext">Inconsolata latin-ext</option>
				<option value="Inconsolata:700&amp;subset=latin-ext">Inconsolata bold (700)  latin-ext</option>
				<option value="Inder">Inder</option>
				<option value="Inder&amp;subset=latin-ext">Inder latin-ext</option>
				<option value="Indie Flower">Indie Flower</option>
				<option value="Inika">Inika</option>
				<option value="Inika:700">Inika bold (700) </option>
				<option value="Inika&amp;subset=latin-ext">Inika latin-ext</option>
				<option value="Inika:700&amp;subset=latin-ext">Inika bold (700)  latin-ext</option>
				<option value="Irish Grover">Irish Grover</option>
				<option value="Istok Web">Istok Web</option>
				<option value="Istok Web:400italic">Istok Web  italic</option>
				<option value="Istok Web:700">Istok Web bold (700) </option>
				<option value="Istok Web:700italic">Istok Web bold (700) italic</option>
				<option value="Istok Web&amp;subset=latin-ext">Istok Web latin-ext</option>
				<option value="Istok Web&amp;subset=cyrillic-ext">Istok Web cyrillic-ext</option>
				<option value="Istok Web&amp;subset=cyrillic">Istok Web cyrillic</option>
				<option value="Istok Web:400italic&amp;subset=latin-ext">Istok Web  italic latin-ext</option>
				<option value="Istok Web:400italic&amp;subset=cyrillic-ext">Istok Web  italic cyrillic-ext</option>
				<option value="Istok Web:400italic&amp;subset=cyrillic">Istok Web  italic cyrillic</option>
				<option value="Istok Web:700&amp;subset=latin-ext">Istok Web bold (700)  latin-ext</option>
				<option value="Istok Web:700&amp;subset=cyrillic-ext">Istok Web bold (700)  cyrillic-ext</option>
				<option value="Istok Web:700&amp;subset=cyrillic">Istok Web bold (700)  cyrillic</option>
				<option value="Istok Web:700italic&amp;subset=latin-ext">Istok Web bold (700) italic latin-ext</option>
				<option value="Istok Web:700italic&amp;subset=cyrillic-ext">Istok Web bold (700) italic cyrillic-ext</option>
				<option value="Istok Web:700italic&amp;subset=cyrillic">Istok Web bold (700) italic cyrillic</option>
				<option value="Italiana">Italiana</option>
				<option value="Italianno">Italianno</option>
				<option value="Italianno&amp;subset=latin-ext">Italianno latin-ext</option>
				<option value="Jacques Francois">Jacques Francois</option>
				<option value="Jacques Francois Shadow">Jacques Francois Shadow</option>
				<option value="Jim Nightshade">Jim Nightshade</option>
				<option value="Jim Nightshade&amp;subset=latin-ext">Jim Nightshade latin-ext</option>
				<option value="Jockey One">Jockey One</option>
				<option value="Jockey One&amp;subset=latin-ext">Jockey One latin-ext</option>
				<option value="Jolly Lodger">Jolly Lodger</option>
				<option value="Jolly Lodger&amp;subset=latin-ext">Jolly Lodger latin-ext</option>
				<option value="Josefin Sans:100">Josefin Sans bold (100) </option>
				<option value="Josefin Sans:100italic">Josefin Sans bold (100) italic</option>
				<option value="Josefin Sans:300">Josefin Sans bold (300) </option>
				<option value="Josefin Sans:300italic">Josefin Sans bold (300) italic</option>
				<option value="Josefin Sans">Josefin Sans</option>
				<option value="Josefin Sans:400italic">Josefin Sans  italic</option>
				<option value="Josefin Sans:600">Josefin Sans bold (600) </option>
				<option value="Josefin Sans:600italic">Josefin Sans bold (600) italic</option>
				<option value="Josefin Sans:700">Josefin Sans bold (700) </option>
				<option value="Josefin Sans:700italic">Josefin Sans bold (700) italic</option>
				<option value="Josefin Slab:100">Josefin Slab bold (100) </option>
				<option value="Josefin Slab:100italic">Josefin Slab bold (100) italic</option>
				<option value="Josefin Slab:300">Josefin Slab bold (300) </option>
				<option value="Josefin Slab:300italic">Josefin Slab bold (300) italic</option>
				<option value="Josefin Slab">Josefin Slab</option>
				<option value="Josefin Slab:400italic">Josefin Slab  italic</option>
				<option value="Josefin Slab:600">Josefin Slab bold (600) </option>
				<option value="Josefin Slab:600italic">Josefin Slab bold (600) italic</option>
				<option value="Josefin Slab:700">Josefin Slab bold (700) </option>
				<option value="Josefin Slab:700italic">Josefin Slab bold (700) italic</option>
				<option value="Joti One">Joti One</option>
				<option value="Joti One&amp;subset=latin-ext">Joti One latin-ext</option>
				<option value="Judson">Judson</option>
				<option value="Judson:400italic">Judson  italic</option>
				<option value="Judson:700">Judson bold (700) </option>
				<option value="Julee">Julee</option>
				<option value="Julius Sans One">Julius Sans One</option>
				<option value="Julius Sans One&amp;subset=latin-ext">Julius Sans One latin-ext</option>
				<option value="Junge">Junge</option>
				<option value="Jura:300">Jura bold (300) </option>
				<option value="Jura">Jura</option>
				<option value="Jura:500">Jura bold (500) </option>
				<option value="Jura:600">Jura bold (600) </option>
				<option value="Jura&amp;subset=latin-ext">Jura latin-ext</option>
				<option value="Jura&amp;subset=greek-ext">Jura greek-ext</option>
				<option value="Jura&amp;subset=cyrillic-ext">Jura cyrillic-ext</option>
				<option value="Jura&amp;subset=cyrillic">Jura cyrillic</option>
				<option value="Jura&amp;subset=greek">Jura greek</option>
				<option value="Jura:300&amp;subset=latin-ext">Jura bold (300)  latin-ext</option>
				<option value="Jura:300&amp;subset=greek-ext">Jura bold (300)  greek-ext</option>
				<option value="Jura:300&amp;subset=cyrillic-ext">Jura bold (300)  cyrillic-ext</option>
				<option value="Jura:300&amp;subset=cyrillic">Jura bold (300)  cyrillic</option>
				<option value="Jura:300&amp;subset=greek">Jura bold (300)  greek</option>
				<option value="Jura:500&amp;subset=latin-ext">Jura bold (500)  latin-ext</option>
				<option value="Jura:500&amp;subset=greek-ext">Jura bold (500)  greek-ext</option>
				<option value="Jura:500&amp;subset=cyrillic-ext">Jura bold (500)  cyrillic-ext</option>
				<option value="Jura:500&amp;subset=cyrillic">Jura bold (500)  cyrillic</option>
				<option value="Jura:500&amp;subset=greek">Jura bold (500)  greek</option>
				<option value="Jura:600&amp;subset=latin-ext">Jura bold (600)  latin-ext</option>
				<option value="Jura:600&amp;subset=greek-ext">Jura bold (600)  greek-ext</option>
				<option value="Jura:600&amp;subset=cyrillic-ext">Jura bold (600)  cyrillic-ext</option>
				<option value="Jura:600&amp;subset=cyrillic">Jura bold (600)  cyrillic</option>
				<option value="Jura:600&amp;subset=greek">Jura bold (600)  greek</option>
				<option value="Just Another Hand">Just Another Hand</option>
				<option value="Just Me Again Down Here">Just Me Again Down Here</option>
				<option value="Just Me Again Down Here&amp;subset=latin-ext">Just Me Again Down Here latin-ext</option>
				<option value="Kameron">Kameron</option>
				<option value="Kameron:700">Kameron bold (700) </option>
				<option value="Karla">Karla</option>
				<option value="Karla:400italic">Karla  italic</option>
				<option value="Karla:700">Karla bold (700) </option>
				<option value="Karla:700italic">Karla bold (700) italic</option>
				<option value="Karla&amp;subset=latin-ext">Karla latin-ext</option>
				<option value="Karla:400italic&amp;subset=latin-ext">Karla  italic latin-ext</option>
				<option value="Karla:700&amp;subset=latin-ext">Karla bold (700)  latin-ext</option>
				<option value="Karla:700italic&amp;subset=latin-ext">Karla bold (700) italic latin-ext</option>
				<option value="Kaushan Script">Kaushan Script</option>
				<option value="Kaushan Script&amp;subset=latin-ext">Kaushan Script latin-ext</option>
				<option value="Kavoon">Kavoon</option>
				<option value="Kavoon&amp;subset=latin-ext">Kavoon latin-ext</option>
				<option value="Keania One">Keania One</option>
				<option value="Keania One&amp;subset=latin-ext">Keania One latin-ext</option>
				<option value="Kelly Slab">Kelly Slab</option>
				<option value="Kelly Slab&amp;subset=latin-ext">Kelly Slab latin-ext</option>
				<option value="Kelly Slab&amp;subset=cyrillic">Kelly Slab cyrillic</option>
				<option value="Kenia">Kenia</option>
				<option value="Khmer">Khmer</option>
				<option value="Kite One">Kite One</option>
				<option value="Knewave">Knewave</option>
				<option value="Knewave&amp;subset=latin-ext">Knewave latin-ext</option>
				<option value="Kotta One">Kotta One</option>
				<option value="Kotta One&amp;subset=latin-ext">Kotta One latin-ext</option>
				<option value="Koulen">Koulen</option>
				<option value="Kranky">Kranky</option>
				<option value="Kreon:300">Kreon bold (300) </option>
				<option value="Kreon">Kreon</option>
				<option value="Kreon:700">Kreon bold (700) </option>
				<option value="Kristi">Kristi</option>
				<option value="Krona One">Krona One</option>
				<option value="Krona One&amp;subset=latin-ext">Krona One latin-ext</option>
				<option value="La Belle Aurore">La Belle Aurore</option>
				<option value="Lancelot">Lancelot</option>
				<option value="Lato:100">Lato bold (100) </option>
				<option value="Lato:100italic">Lato bold (100) italic</option>
				<option value="Lato:300">Lato bold (300) </option>
				<option value="Lato:300italic">Lato bold (300) italic</option>
				<option value="Lato">Lato</option>
				<option value="Lato:400italic">Lato  italic</option>
				<option value="Lato:700">Lato bold (700) </option>
				<option value="Lato:700italic">Lato bold (700) italic</option>
				<option value="Lato:900">Lato bold (900) </option>
				<option value="Lato:900italic">Lato bold (900) italic</option>
				<option value="League Script">League Script</option>
				<option value="Leckerli One">Leckerli One</option>
				<option value="Ledger">Ledger</option>
				<option value="Ledger&amp;subset=latin-ext">Ledger latin-ext</option>
				<option value="Ledger&amp;subset=cyrillic">Ledger cyrillic</option>
				<option value="Lekton">Lekton</option>
				<option value="Lekton:400italic">Lekton  italic</option>
				<option value="Lekton:700">Lekton bold (700) </option>
				<option value="Lekton&amp;subset=latin-ext">Lekton latin-ext</option>
				<option value="Lekton:400italic&amp;subset=latin-ext">Lekton  italic latin-ext</option>
				<option value="Lekton:700&amp;subset=latin-ext">Lekton bold (700)  latin-ext</option>
				<option value="Lemon">Lemon</option>
				<option value="Libre Baskerville">Libre Baskerville</option>
				<option value="Libre Baskerville:400italic">Libre Baskerville  italic</option>
				<option value="Libre Baskerville:700">Libre Baskerville bold (700) </option>
				<option value="Libre Baskerville&amp;subset=latin-ext">Libre Baskerville latin-ext</option>
				<option value="Libre Baskerville:400italic&amp;subset=latin-ext">Libre Baskerville  italic latin-ext</option>
				<option value="Libre Baskerville:700&amp;subset=latin-ext">Libre Baskerville bold (700)  latin-ext</option>
				<option value="Life Savers">Life Savers</option>
				<option value="Life Savers:700">Life Savers bold (700) </option>
				<option value="Life Savers&amp;subset=latin-ext">Life Savers latin-ext</option>
				<option value="Life Savers:700&amp;subset=latin-ext">Life Savers bold (700)  latin-ext</option>
				<option value="Lilita One">Lilita One</option>
				<option value="Lilita One&amp;subset=latin-ext">Lilita One latin-ext</option>
				<option value="Lily Script One">Lily Script One</option>
				<option value="Lily Script One&amp;subset=latin-ext">Lily Script One latin-ext</option>
				<option value="Limelight">Limelight</option>
				<option value="Limelight&amp;subset=latin-ext">Limelight latin-ext</option>
				<option value="Linden Hill">Linden Hill</option>
				<option value="Linden Hill:400italic">Linden Hill  italic</option>
				<option value="Lobster">Lobster</option>
				<option value="Lobster&amp;subset=latin-ext">Lobster latin-ext</option>
				<option value="Lobster&amp;subset=cyrillic-ext">Lobster cyrillic-ext</option>
				<option value="Lobster&amp;subset=cyrillic">Lobster cyrillic</option>
				<option value="Lobster Two">Lobster Two</option>
				<option value="Lobster Two:400italic">Lobster Two  italic</option>
				<option value="Lobster Two:700">Lobster Two bold (700) </option>
				<option value="Lobster Two:700italic">Lobster Two bold (700) italic</option>
				<option value="Londrina Outline">Londrina Outline</option>
				<option value="Londrina Shadow">Londrina Shadow</option>
				<option value="Londrina Sketch">Londrina Sketch</option>
				<option value="Londrina Solid">Londrina Solid</option>
				<option value="Lora">Lora</option>
				<option value="Lora:400italic">Lora  italic</option>
				<option value="Lora:700">Lora bold (700) </option>
				<option value="Lora:700italic">Lora bold (700) italic</option>
				<option value="Love Ya Like A Sister">Love Ya Like A Sister</option>
				<option value="Loved by the King">Loved by the King</option>
				<option value="Lovers Quarrel">Lovers Quarrel</option>
				<option value="Lovers Quarrel&amp;subset=latin-ext">Lovers Quarrel latin-ext</option>
				<option value="Luckiest Guy">Luckiest Guy</option>
				<option value="Lusitana">Lusitana</option>
				<option value="Lusitana:700">Lusitana bold (700) </option>
				<option value="Lustria">Lustria</option>
				<option value="Macondo">Macondo</option>
				<option value="Macondo Swash Caps">Macondo Swash Caps</option>
				<option value="Magra">Magra</option>
				<option value="Magra:700">Magra bold (700) </option>
				<option value="Magra&amp;subset=latin-ext">Magra latin-ext</option>
				<option value="Magra:700&amp;subset=latin-ext">Magra bold (700)  latin-ext</option>
				<option value="Maiden Orange">Maiden Orange</option>
				<option value="Mako">Mako</option>
				<option value="Marcellus">Marcellus</option>
				<option value="Marcellus&amp;subset=latin-ext">Marcellus latin-ext</option>
				<option value="Marcellus SC">Marcellus SC</option>
				<option value="Marcellus SC&amp;subset=latin-ext">Marcellus SC latin-ext</option>
				<option value="Marck Script">Marck Script</option>
				<option value="Marck Script&amp;subset=latin-ext">Marck Script latin-ext</option>
				<option value="Marck Script&amp;subset=cyrillic">Marck Script cyrillic</option>
				<option value="Margarine">Margarine</option>
				<option value="Margarine&amp;subset=latin-ext">Margarine latin-ext</option>
				<option value="Marko One">Marko One</option>
				<option value="Marmelad">Marmelad</option>
				<option value="Marmelad&amp;subset=latin-ext">Marmelad latin-ext</option>
				<option value="Marmelad&amp;subset=cyrillic">Marmelad cyrillic</option>
				<option value="Marvel">Marvel</option>
				<option value="Marvel:400italic">Marvel  italic</option>
				<option value="Marvel:700">Marvel bold (700) </option>
				<option value="Marvel:700italic">Marvel bold (700) italic</option>
				<option value="Mate">Mate</option>
				<option value="Mate:400italic">Mate  italic</option>
				<option value="Mate SC">Mate SC</option>
				<option value="Maven Pro">Maven Pro</option>
				<option value="Maven Pro:500">Maven Pro bold (500) </option>
				<option value="Maven Pro:700">Maven Pro bold (700) </option>
				<option value="Maven Pro:900">Maven Pro bold (900) </option>
				<option value="McLaren">McLaren</option>
				<option value="McLaren&amp;subset=latin-ext">McLaren latin-ext</option>
				<option value="Meddon">Meddon</option>
				<option value="MedievalSharp">MedievalSharp</option>
				<option value="MedievalSharp&amp;subset=latin-ext">MedievalSharp latin-ext</option>
				<option value="Medula One">Medula One</option>
				<option value="Megrim">Megrim</option>
				<option value="Meie Script">Meie Script</option>
				<option value="Meie Script&amp;subset=latin-ext">Meie Script latin-ext</option>
				<option value="Merienda">Merienda</option>
				<option value="Merienda:700">Merienda bold (700) </option>
				<option value="Merienda&amp;subset=latin-ext">Merienda latin-ext</option>
				<option value="Merienda:700&amp;subset=latin-ext">Merienda bold (700)  latin-ext</option>
				<option value="Merienda One">Merienda One</option>
				<option value="Merriweather:300">Merriweather bold (300) </option>
				<option value="Merriweather:300italic">Merriweather bold (300) italic</option>
				<option value="Merriweather">Merriweather</option>
				<option value="Merriweather:400italic">Merriweather  italic</option>
				<option value="Merriweather:700">Merriweather bold (700) </option>
				<option value="Merriweather:700italic">Merriweather bold (700) italic</option>
				<option value="Merriweather:900">Merriweather bold (900) </option>
				<option value="Merriweather:900italic">Merriweather bold (900) italic</option>
				<option value="Merriweather&amp;subset=latin-ext">Merriweather latin-ext</option>
				<option value="Merriweather:300&amp;subset=latin-ext">Merriweather bold (300)  latin-ext</option>
				<option value="Merriweather:300italic&amp;subset=latin-ext">Merriweather bold (300) italic latin-ext</option>
				<option value="Merriweather:400italic&amp;subset=latin-ext">Merriweather  italic latin-ext</option>
				<option value="Merriweather:700&amp;subset=latin-ext">Merriweather bold (700)  latin-ext</option>
				<option value="Merriweather:700italic&amp;subset=latin-ext">Merriweather bold (700) italic latin-ext</option>
				<option value="Merriweather:900&amp;subset=latin-ext">Merriweather bold (900)  latin-ext</option>
				<option value="Merriweather:900italic&amp;subset=latin-ext">Merriweather bold (900) italic latin-ext</option>
				<option value="Merriweather Sans:300">Merriweather Sans bold (300) </option>
				<option value="Merriweather Sans:300italic">Merriweather Sans bold (300) italic</option>
				<option value="Merriweather Sans">Merriweather Sans</option>
				<option value="Merriweather Sans:400italic">Merriweather Sans  italic</option>
				<option value="Merriweather Sans:700">Merriweather Sans bold (700) </option>
				<option value="Merriweather Sans:700italic">Merriweather Sans bold (700) italic</option>
				<option value="Merriweather Sans:800">Merriweather Sans bold (800) </option>
				<option value="Merriweather Sans:800italic">Merriweather Sans bold (800) italic</option>
				<option value="Merriweather Sans&amp;subset=latin-ext">Merriweather Sans latin-ext</option>
				<option value="Merriweather Sans:300&amp;subset=latin-ext">Merriweather Sans bold (300)  latin-ext</option>
				<option value="Merriweather Sans:300italic&amp;subset=latin-ext">Merriweather Sans bold (300) italic latin-ext</option>
				<option value="Merriweather Sans:400italic&amp;subset=latin-ext">Merriweather Sans  italic latin-ext</option>
				<option value="Merriweather Sans:700&amp;subset=latin-ext">Merriweather Sans bold (700)  latin-ext</option>
				<option value="Merriweather Sans:700italic&amp;subset=latin-ext">Merriweather Sans bold (700) italic latin-ext</option>
				<option value="Merriweather Sans:800&amp;subset=latin-ext">Merriweather Sans bold (800)  latin-ext</option>
				<option value="Merriweather Sans:800italic&amp;subset=latin-ext">Merriweather Sans bold (800) italic latin-ext</option>
				<option value="Metal">Metal</option>
				<option value="Metal Mania">Metal Mania</option>
				<option value="Metal Mania&amp;subset=latin-ext">Metal Mania latin-ext</option>
				<option value="Metamorphous">Metamorphous</option>
				<option value="Metamorphous&amp;subset=latin-ext">Metamorphous latin-ext</option>
				<option value="Metrophobic">Metrophobic</option>
				<option value="Michroma">Michroma</option>
				<option value="Milonga">Milonga</option>
				<option value="Milonga&amp;subset=latin-ext">Milonga latin-ext</option>
				<option value="Miltonian">Miltonian</option>
				<option value="Miltonian Tattoo">Miltonian Tattoo</option>
				<option value="Miniver">Miniver</option>
				<option value="Miss Fajardose">Miss Fajardose</option>
				<option value="Miss Fajardose&amp;subset=latin-ext">Miss Fajardose latin-ext</option>
				<option value="Modern Antiqua">Modern Antiqua</option>
				<option value="Modern Antiqua&amp;subset=latin-ext">Modern Antiqua latin-ext</option>
				<option value="Molengo">Molengo</option>
				<option value="Molengo&amp;subset=latin-ext">Molengo latin-ext</option>
				<option value="Molle:400italic">Molle  italic</option>
				<option value="Molle&amp;subset=latin-ext">Molle latin-ext</option>
				<option value="Molle:400italic&amp;subset=latin-ext">Molle  italic latin-ext</option>
				<option value="Monda">Monda</option>
				<option value="Monda:700">Monda bold (700) </option>
				<option value="Monda&amp;subset=latin-ext">Monda latin-ext</option>
				<option value="Monda:700&amp;subset=latin-ext">Monda bold (700)  latin-ext</option>
				<option value="Monofett">Monofett</option>
				<option value="Monoton">Monoton</option>
				<option value="Monsieur La Doulaise">Monsieur La Doulaise</option>
				<option value="Monsieur La Doulaise&amp;subset=latin-ext">Monsieur La Doulaise latin-ext</option>
				<option value="Montaga">Montaga</option>
				<option value="Montez">Montez</option>
				<option value="Montserrat">Montserrat</option>
				<option value="Montserrat:700">Montserrat bold (700) </option>
				<option value="Montserrat Alternates">Montserrat Alternates</option>
				<option value="Montserrat Alternates:700">Montserrat Alternates bold (700) </option>
				<option value="Montserrat Subrayada">Montserrat Subrayada</option>
				<option value="Montserrat Subrayada:700">Montserrat Subrayada bold (700) </option>
				<option value="Moul">Moul</option>
				<option value="Moulpali">Moulpali</option>
				<option value="Mountains of Christmas">Mountains of Christmas</option>
				<option value="Mountains of Christmas:700">Mountains of Christmas bold (700) </option>
				<option value="Mouse Memoirs">Mouse Memoirs</option>
				<option value="Mouse Memoirs&amp;subset=latin-ext">Mouse Memoirs latin-ext</option>
				<option value="Mr Bedfort">Mr Bedfort</option>
				<option value="Mr Bedfort&amp;subset=latin-ext">Mr Bedfort latin-ext</option>
				<option value="Mr Dafoe">Mr Dafoe</option>
				<option value="Mr Dafoe&amp;subset=latin-ext">Mr Dafoe latin-ext</option>
				<option value="Mr De Haviland">Mr De Haviland</option>
				<option value="Mr De Haviland&amp;subset=latin-ext">Mr De Haviland latin-ext</option>
				<option value="Mrs Saint Delafield">Mrs Saint Delafield</option>
				<option value="Mrs Saint Delafield&amp;subset=latin-ext">Mrs Saint Delafield latin-ext</option>
				<option value="Mrs Sheppards">Mrs Sheppards</option>
				<option value="Mrs Sheppards&amp;subset=latin-ext">Mrs Sheppards latin-ext</option>
				<option value="Muli:300">Muli bold (300) </option>
				<option value="Muli:300italic">Muli bold (300) italic</option>
				<option value="Muli">Muli</option>
				<option value="Muli:400italic">Muli  italic</option>
				<option value="Mystery Quest">Mystery Quest</option>
				<option value="Mystery Quest&amp;subset=latin-ext">Mystery Quest latin-ext</option>
				<option value="Neucha">Neucha</option>
				<option value="Neucha&amp;subset=cyrillic">Neucha cyrillic</option>
				<option value="Neuton:200">Neuton bold (200) </option>
				<option value="Neuton:300">Neuton bold (300) </option>
				<option value="Neuton">Neuton</option>
				<option value="Neuton:400italic">Neuton  italic</option>
				<option value="Neuton:700">Neuton bold (700) </option>
				<option value="Neuton:800">Neuton bold (800) </option>
				<option value="Neuton&amp;subset=latin-ext">Neuton latin-ext</option>
				<option value="Neuton:200&amp;subset=latin-ext">Neuton bold (200)  latin-ext</option>
				<option value="Neuton:300&amp;subset=latin-ext">Neuton bold (300)  latin-ext</option>
				<option value="Neuton:400italic&amp;subset=latin-ext">Neuton  italic latin-ext</option>
				<option value="Neuton:700&amp;subset=latin-ext">Neuton bold (700)  latin-ext</option>
				<option value="Neuton:800&amp;subset=latin-ext">Neuton bold (800)  latin-ext</option>
				<option value="New Rocker">New Rocker</option>
				<option value="New Rocker&amp;subset=latin-ext">New Rocker latin-ext</option>
				<option value="News Cycle">News Cycle</option>
				<option value="News Cycle:700">News Cycle bold (700) </option>
				<option value="News Cycle&amp;subset=latin-ext">News Cycle latin-ext</option>
				<option value="News Cycle:700&amp;subset=latin-ext">News Cycle bold (700)  latin-ext</option>
				<option value="Niconne">Niconne</option>
				<option value="Niconne&amp;subset=latin-ext">Niconne latin-ext</option>
				<option value="Nixie One">Nixie One</option>
				<option value="Nobile">Nobile</option>
				<option value="Nobile:400italic">Nobile  italic</option>
				<option value="Nobile:700">Nobile bold (700) </option>
				<option value="Nobile:700italic">Nobile bold (700) italic</option>
				<option value="Nokora">Nokora</option>
				<option value="Nokora:700">Nokora bold (700) </option>
				<option value="Norican">Norican</option>
				<option value="Norican&amp;subset=latin-ext">Norican latin-ext</option>
				<option value="Nosifer">Nosifer</option>
				<option value="Nosifer&amp;subset=latin-ext">Nosifer latin-ext</option>
				<option value="Nothing You Could Do">Nothing You Could Do</option>
				<option value="Noticia Text">Noticia Text</option>
				<option value="Noticia Text:400italic">Noticia Text  italic</option>
				<option value="Noticia Text:700">Noticia Text bold (700) </option>
				<option value="Noticia Text:700italic">Noticia Text bold (700) italic</option>
				<option value="Noticia Text&amp;subset=latin-ext">Noticia Text latin-ext</option>
				<option value="Noticia Text&amp;subset=vietnamese">Noticia Text vietnamese</option>
				<option value="Noticia Text:400italic&amp;subset=latin-ext">Noticia Text  italic latin-ext</option>
				<option value="Noticia Text:400italic&amp;subset=vietnamese">Noticia Text  italic vietnamese</option>
				<option value="Noticia Text:700&amp;subset=latin-ext">Noticia Text bold (700)  latin-ext</option>
				<option value="Noticia Text:700&amp;subset=vietnamese">Noticia Text bold (700)  vietnamese</option>
				<option value="Noticia Text:700italic&amp;subset=latin-ext">Noticia Text bold (700) italic latin-ext</option>
				<option value="Noticia Text:700italic&amp;subset=vietnamese">Noticia Text bold (700) italic vietnamese</option>
				<option value="Noto Sans">Noto Sans</option>
				<option value="Noto Sans:400italic">Noto Sans  italic</option>
				<option value="Noto Sans:700">Noto Sans bold (700) </option>
				<option value="Noto Sans:700italic">Noto Sans bold (700) italic</option>
				<option value="Noto Sans&amp;subset=latin-ext">Noto Sans latin-ext</option>
				<option value="Noto Sans&amp;subset=greek-ext">Noto Sans greek-ext</option>
				<option value="Noto Sans&amp;subset=cyrillic-ext">Noto Sans cyrillic-ext</option>
				<option value="Noto Sans&amp;subset=cyrillic">Noto Sans cyrillic</option>
				<option value="Noto Sans&amp;subset=vietnamese">Noto Sans vietnamese</option>
				<option value="Noto Sans&amp;subset=greek">Noto Sans greek</option>
				<option value="Noto Sans:400italic&amp;subset=latin-ext">Noto Sans  italic latin-ext</option>
				<option value="Noto Sans:400italic&amp;subset=greek-ext">Noto Sans  italic greek-ext</option>
				<option value="Noto Sans:400italic&amp;subset=cyrillic-ext">Noto Sans  italic cyrillic-ext</option>
				<option value="Noto Sans:400italic&amp;subset=cyrillic">Noto Sans  italic cyrillic</option>
				<option value="Noto Sans:400italic&amp;subset=vietnamese">Noto Sans  italic vietnamese</option>
				<option value="Noto Sans:400italic&amp;subset=greek">Noto Sans  italic greek</option>
				<option value="Noto Sans:700&amp;subset=latin-ext">Noto Sans bold (700)  latin-ext</option>
				<option value="Noto Sans:700&amp;subset=greek-ext">Noto Sans bold (700)  greek-ext</option>
				<option value="Noto Sans:700&amp;subset=cyrillic-ext">Noto Sans bold (700)  cyrillic-ext</option>
				<option value="Noto Sans:700&amp;subset=cyrillic">Noto Sans bold (700)  cyrillic</option>
				<option value="Noto Sans:700&amp;subset=vietnamese">Noto Sans bold (700)  vietnamese</option>
				<option value="Noto Sans:700&amp;subset=greek">Noto Sans bold (700)  greek</option>
				<option value="Noto Sans:700italic&amp;subset=latin-ext">Noto Sans bold (700) italic latin-ext</option>
				<option value="Noto Sans:700italic&amp;subset=greek-ext">Noto Sans bold (700) italic greek-ext</option>
				<option value="Noto Sans:700italic&amp;subset=cyrillic-ext">Noto Sans bold (700) italic cyrillic-ext</option>
				<option value="Noto Sans:700italic&amp;subset=cyrillic">Noto Sans bold (700) italic cyrillic</option>
				<option value="Noto Sans:700italic&amp;subset=vietnamese">Noto Sans bold (700) italic vietnamese</option>
				<option value="Noto Sans:700italic&amp;subset=greek">Noto Sans bold (700) italic greek</option>
				<option value="Noto Serif">Noto Serif</option>
				<option value="Noto Serif:400italic">Noto Serif  italic</option>
				<option value="Noto Serif:700">Noto Serif bold (700) </option>
				<option value="Noto Serif:700italic">Noto Serif bold (700) italic</option>
				<option value="Noto Serif&amp;subset=latin-ext">Noto Serif latin-ext</option>
				<option value="Noto Serif&amp;subset=greek-ext">Noto Serif greek-ext</option>
				<option value="Noto Serif&amp;subset=cyrillic-ext">Noto Serif cyrillic-ext</option>
				<option value="Noto Serif&amp;subset=cyrillic">Noto Serif cyrillic</option>
				<option value="Noto Serif&amp;subset=vietnamese">Noto Serif vietnamese</option>
				<option value="Noto Serif&amp;subset=greek">Noto Serif greek</option>
				<option value="Noto Serif:400italic&amp;subset=latin-ext">Noto Serif  italic latin-ext</option>
				<option value="Noto Serif:400italic&amp;subset=greek-ext">Noto Serif  italic greek-ext</option>
				<option value="Noto Serif:400italic&amp;subset=cyrillic-ext">Noto Serif  italic cyrillic-ext</option>
				<option value="Noto Serif:400italic&amp;subset=cyrillic">Noto Serif  italic cyrillic</option>
				<option value="Noto Serif:400italic&amp;subset=vietnamese">Noto Serif  italic vietnamese</option>
				<option value="Noto Serif:400italic&amp;subset=greek">Noto Serif  italic greek</option>
				<option value="Noto Serif:700&amp;subset=latin-ext">Noto Serif bold (700)  latin-ext</option>
				<option value="Noto Serif:700&amp;subset=greek-ext">Noto Serif bold (700)  greek-ext</option>
				<option value="Noto Serif:700&amp;subset=cyrillic-ext">Noto Serif bold (700)  cyrillic-ext</option>
				<option value="Noto Serif:700&amp;subset=cyrillic">Noto Serif bold (700)  cyrillic</option>
				<option value="Noto Serif:700&amp;subset=vietnamese">Noto Serif bold (700)  vietnamese</option>
				<option value="Noto Serif:700&amp;subset=greek">Noto Serif bold (700)  greek</option>
				<option value="Noto Serif:700italic&amp;subset=latin-ext">Noto Serif bold (700) italic latin-ext</option>
				<option value="Noto Serif:700italic&amp;subset=greek-ext">Noto Serif bold (700) italic greek-ext</option>
				<option value="Noto Serif:700italic&amp;subset=cyrillic-ext">Noto Serif bold (700) italic cyrillic-ext</option>
				<option value="Noto Serif:700italic&amp;subset=cyrillic">Noto Serif bold (700) italic cyrillic</option>
				<option value="Noto Serif:700italic&amp;subset=vietnamese">Noto Serif bold (700) italic vietnamese</option>
				<option value="Noto Serif:700italic&amp;subset=greek">Noto Serif bold (700) italic greek</option>
				<option value="Nova Cut">Nova Cut</option>
				<option value="Nova Flat">Nova Flat</option>
				<option value="Nova Mono">Nova Mono</option>
				<option value="Nova Mono&amp;subset=greek">Nova Mono greek</option>
				<option value="Nova Oval">Nova Oval</option>
				<option value="Nova Round">Nova Round</option>
				<option value="Nova Script">Nova Script</option>
				<option value="Nova Slim">Nova Slim</option>
				<option value="Nova Square">Nova Square</option>
				<option value="Numans">Numans</option>
				<option value="Nunito:300">Nunito bold (300) </option>
				<option value="Nunito">Nunito</option>
				<option value="Nunito:700">Nunito bold (700) </option>
				<option value="Odor Mean Chey">Odor Mean Chey</option>
				<option value="Offside">Offside</option>
				<option value="Old Standard TT">Old Standard TT</option>
				<option value="Old Standard TT:400italic">Old Standard TT  italic</option>
				<option value="Old Standard TT:700">Old Standard TT bold (700) </option>
				<option value="Oldenburg">Oldenburg</option>
				<option value="Oldenburg&amp;subset=latin-ext">Oldenburg latin-ext</option>
				<option value="Oleo Script">Oleo Script</option>
				<option value="Oleo Script:700">Oleo Script bold (700) </option>
				<option value="Oleo Script&amp;subset=latin-ext">Oleo Script latin-ext</option>
				<option value="Oleo Script:700&amp;subset=latin-ext">Oleo Script bold (700)  latin-ext</option>
				<option value="Oleo Script Swash Caps">Oleo Script Swash Caps</option>
				<option value="Oleo Script Swash Caps:700">Oleo Script Swash Caps bold (700) </option>
				<option value="Oleo Script Swash Caps&amp;subset=latin-ext">Oleo Script Swash Caps latin-ext</option>
				<option value="Oleo Script Swash Caps:700&amp;subset=latin-ext">Oleo Script Swash Caps bold (700)  latin-ext</option>
				<option value="Open Sans:300">Open Sans bold (300) </option>
				<option value="Open Sans:300italic">Open Sans bold (300) italic</option>
				<option value="Open Sans">Open Sans</option>
				<option value="Open Sans:400italic">Open Sans  italic</option>
				<option value="Open Sans:600">Open Sans bold (600) </option>
				<option value="Open Sans:600italic">Open Sans bold (600) italic</option>
				<option value="Open Sans:700">Open Sans bold (700) </option>
				<option value="Open Sans:700italic">Open Sans bold (700) italic</option>
				<option value="Open Sans:800">Open Sans bold (800) </option>
				<option value="Open Sans:800italic">Open Sans bold (800) italic</option>
				<option value="Open Sans&amp;subset=latin-ext">Open Sans latin-ext</option>
				<option value="Open Sans&amp;subset=greek-ext">Open Sans greek-ext</option>
				<option value="Open Sans&amp;subset=cyrillic-ext">Open Sans cyrillic-ext</option>
				<option value="Open Sans&amp;subset=cyrillic">Open Sans cyrillic</option>
				<option value="Open Sans&amp;subset=vietnamese">Open Sans vietnamese</option>
				<option value="Open Sans&amp;subset=greek">Open Sans greek</option>
				<option value="Open Sans:300&amp;subset=latin-ext">Open Sans bold (300)  latin-ext</option>
				<option value="Open Sans:300&amp;subset=greek-ext">Open Sans bold (300)  greek-ext</option>
				<option value="Open Sans:300&amp;subset=cyrillic-ext">Open Sans bold (300)  cyrillic-ext</option>
				<option value="Open Sans:300&amp;subset=cyrillic">Open Sans bold (300)  cyrillic</option>
				<option value="Open Sans:300&amp;subset=vietnamese">Open Sans bold (300)  vietnamese</option>
				<option value="Open Sans:300&amp;subset=greek">Open Sans bold (300)  greek</option>
				<option value="Open Sans:300italic&amp;subset=latin-ext">Open Sans bold (300) italic latin-ext</option>
				<option value="Open Sans:300italic&amp;subset=greek-ext">Open Sans bold (300) italic greek-ext</option>
				<option value="Open Sans:300italic&amp;subset=cyrillic-ext">Open Sans bold (300) italic cyrillic-ext</option>
				<option value="Open Sans:300italic&amp;subset=cyrillic">Open Sans bold (300) italic cyrillic</option>
				<option value="Open Sans:300italic&amp;subset=vietnamese">Open Sans bold (300) italic vietnamese</option>
				<option value="Open Sans:300italic&amp;subset=greek">Open Sans bold (300) italic greek</option>
				<option value="Open Sans:400italic&amp;subset=latin-ext">Open Sans  italic latin-ext</option>
				<option value="Open Sans:400italic&amp;subset=greek-ext">Open Sans  italic greek-ext</option>
				<option value="Open Sans:400italic&amp;subset=cyrillic-ext">Open Sans  italic cyrillic-ext</option>
				<option value="Open Sans:400italic&amp;subset=cyrillic">Open Sans  italic cyrillic</option>
				<option value="Open Sans:400italic&amp;subset=vietnamese">Open Sans  italic vietnamese</option>
				<option value="Open Sans:400italic&amp;subset=greek">Open Sans  italic greek</option>
				<option value="Open Sans:600&amp;subset=latin-ext">Open Sans bold (600)  latin-ext</option>
				<option value="Open Sans:600&amp;subset=greek-ext">Open Sans bold (600)  greek-ext</option>
				<option value="Open Sans:600&amp;subset=cyrillic-ext">Open Sans bold (600)  cyrillic-ext</option>
				<option value="Open Sans:600&amp;subset=cyrillic">Open Sans bold (600)  cyrillic</option>
				<option value="Open Sans:600&amp;subset=vietnamese">Open Sans bold (600)  vietnamese</option>
				<option value="Open Sans:600&amp;subset=greek">Open Sans bold (600)  greek</option>
				<option value="Open Sans:600italic&amp;subset=latin-ext">Open Sans bold (600) italic latin-ext</option>
				<option value="Open Sans:600italic&amp;subset=greek-ext">Open Sans bold (600) italic greek-ext</option>
				<option value="Open Sans:600italic&amp;subset=cyrillic-ext">Open Sans bold (600) italic cyrillic-ext</option>
				<option value="Open Sans:600italic&amp;subset=cyrillic">Open Sans bold (600) italic cyrillic</option>
				<option value="Open Sans:600italic&amp;subset=vietnamese">Open Sans bold (600) italic vietnamese</option>
				<option value="Open Sans:600italic&amp;subset=greek">Open Sans bold (600) italic greek</option>
				<option value="Open Sans:700&amp;subset=latin-ext">Open Sans bold (700)  latin-ext</option>
				<option value="Open Sans:700&amp;subset=greek-ext">Open Sans bold (700)  greek-ext</option>
				<option value="Open Sans:700&amp;subset=cyrillic-ext">Open Sans bold (700)  cyrillic-ext</option>
				<option value="Open Sans:700&amp;subset=cyrillic">Open Sans bold (700)  cyrillic</option>
				<option value="Open Sans:700&amp;subset=vietnamese">Open Sans bold (700)  vietnamese</option>
				<option value="Open Sans:700&amp;subset=greek">Open Sans bold (700)  greek</option>
				<option value="Open Sans:700italic&amp;subset=latin-ext">Open Sans bold (700) italic latin-ext</option>
				<option value="Open Sans:700italic&amp;subset=greek-ext">Open Sans bold (700) italic greek-ext</option>
				<option value="Open Sans:700italic&amp;subset=cyrillic-ext">Open Sans bold (700) italic cyrillic-ext</option>
				<option value="Open Sans:700italic&amp;subset=cyrillic">Open Sans bold (700) italic cyrillic</option>
				<option value="Open Sans:700italic&amp;subset=vietnamese">Open Sans bold (700) italic vietnamese</option>
				<option value="Open Sans:700italic&amp;subset=greek">Open Sans bold (700) italic greek</option>
				<option value="Open Sans:800&amp;subset=latin-ext">Open Sans bold (800)  latin-ext</option>
				<option value="Open Sans:800&amp;subset=greek-ext">Open Sans bold (800)  greek-ext</option>
				<option value="Open Sans:800&amp;subset=cyrillic-ext">Open Sans bold (800)  cyrillic-ext</option>
				<option value="Open Sans:800&amp;subset=cyrillic">Open Sans bold (800)  cyrillic</option>
				<option value="Open Sans:800&amp;subset=vietnamese">Open Sans bold (800)  vietnamese</option>
				<option value="Open Sans:800&amp;subset=greek">Open Sans bold (800)  greek</option>
				<option value="Open Sans:800italic&amp;subset=latin-ext">Open Sans bold (800) italic latin-ext</option>
				<option value="Open Sans:800italic&amp;subset=greek-ext">Open Sans bold (800) italic greek-ext</option>
				<option value="Open Sans:800italic&amp;subset=cyrillic-ext">Open Sans bold (800) italic cyrillic-ext</option>
				<option value="Open Sans:800italic&amp;subset=cyrillic">Open Sans bold (800) italic cyrillic</option>
				<option value="Open Sans:800italic&amp;subset=vietnamese">Open Sans bold (800) italic vietnamese</option>
				<option value="Open Sans:800italic&amp;subset=greek">Open Sans bold (800) italic greek</option>
				<option value="Open Sans Condensed:300">Open Sans Condensed bold (300) </option>
				<option value="Open Sans Condensed:300italic">Open Sans Condensed bold (300) italic</option>
				<option value="Open Sans Condensed:700">Open Sans Condensed bold (700) </option>
				<option value="Open Sans Condensed&amp;subset=latin-ext">Open Sans Condensed latin-ext</option>
				<option value="Open Sans Condensed&amp;subset=greek-ext">Open Sans Condensed greek-ext</option>
				<option value="Open Sans Condensed&amp;subset=cyrillic-ext">Open Sans Condensed cyrillic-ext</option>
				<option value="Open Sans Condensed&amp;subset=cyrillic">Open Sans Condensed cyrillic</option>
				<option value="Open Sans Condensed&amp;subset=vietnamese">Open Sans Condensed vietnamese</option>
				<option value="Open Sans Condensed&amp;subset=greek">Open Sans Condensed greek</option>
				<option value="Open Sans Condensed:300&amp;subset=latin-ext">Open Sans Condensed bold (300)  latin-ext</option>
				<option value="Open Sans Condensed:300&amp;subset=greek-ext">Open Sans Condensed bold (300)  greek-ext</option>
				<option value="Open Sans Condensed:300&amp;subset=cyrillic-ext">Open Sans Condensed bold (300)  cyrillic-ext</option>
				<option value="Open Sans Condensed:300&amp;subset=cyrillic">Open Sans Condensed bold (300)  cyrillic</option>
				<option value="Open Sans Condensed:300&amp;subset=vietnamese">Open Sans Condensed bold (300)  vietnamese</option>
				<option value="Open Sans Condensed:300&amp;subset=greek">Open Sans Condensed bold (300)  greek</option>
				<option value="Open Sans Condensed:300italic&amp;subset=latin-ext">Open Sans Condensed bold (300) italic latin-ext</option>
				<option value="Open Sans Condensed:300italic&amp;subset=greek-ext">Open Sans Condensed bold (300) italic greek-ext</option>
				<option value="Open Sans Condensed:300italic&amp;subset=cyrillic-ext">Open Sans Condensed bold (300) italic cyrillic-ext</option>
				<option value="Open Sans Condensed:300italic&amp;subset=cyrillic">Open Sans Condensed bold (300) italic cyrillic</option>
				<option value="Open Sans Condensed:300italic&amp;subset=vietnamese">Open Sans Condensed bold (300) italic vietnamese</option>
				<option value="Open Sans Condensed:300italic&amp;subset=greek">Open Sans Condensed bold (300) italic greek</option>
				<option value="Open Sans Condensed:700&amp;subset=latin-ext">Open Sans Condensed bold (700)  latin-ext</option>
				<option value="Open Sans Condensed:700&amp;subset=greek-ext">Open Sans Condensed bold (700)  greek-ext</option>
				<option value="Open Sans Condensed:700&amp;subset=cyrillic-ext">Open Sans Condensed bold (700)  cyrillic-ext</option>
				<option value="Open Sans Condensed:700&amp;subset=cyrillic">Open Sans Condensed bold (700)  cyrillic</option>
				<option value="Open Sans Condensed:700&amp;subset=vietnamese">Open Sans Condensed bold (700)  vietnamese</option>
				<option value="Open Sans Condensed:700&amp;subset=greek">Open Sans Condensed bold (700)  greek</option>
				<option value="Oranienbaum">Oranienbaum</option>
				<option value="Oranienbaum&amp;subset=latin-ext">Oranienbaum latin-ext</option>
				<option value="Oranienbaum&amp;subset=cyrillic-ext">Oranienbaum cyrillic-ext</option>
				<option value="Oranienbaum&amp;subset=cyrillic">Oranienbaum cyrillic</option>
				<option value="Orbitron">Orbitron</option>
				<option value="Orbitron:500">Orbitron bold (500) </option>
				<option value="Orbitron:700">Orbitron bold (700) </option>
				<option value="Orbitron:900">Orbitron bold (900) </option>
				<option value="Oregano">Oregano</option>
				<option value="Oregano:400italic">Oregano  italic</option>
				<option value="Oregano&amp;subset=latin-ext">Oregano latin-ext</option>
				<option value="Oregano:400italic&amp;subset=latin-ext">Oregano  italic latin-ext</option>
				<option value="Orienta">Orienta</option>
				<option value="Orienta&amp;subset=latin-ext">Orienta latin-ext</option>
				<option value="Original Surfer">Original Surfer</option>
				<option value="Oswald:300">Oswald bold (300) </option>
				<option value="Oswald">Oswald</option>
				<option value="Oswald:700">Oswald bold (700) </option>
				<option value="Oswald&amp;subset=latin-ext">Oswald latin-ext</option>
				<option value="Oswald:300&amp;subset=latin-ext">Oswald bold (300)  latin-ext</option>
				<option value="Oswald:700&amp;subset=latin-ext">Oswald bold (700)  latin-ext</option>
				<option value="Over the Rainbow">Over the Rainbow</option>
				<option value="Overlock">Overlock</option>
				<option value="Overlock:400italic">Overlock  italic</option>
				<option value="Overlock:700">Overlock bold (700) </option>
				<option value="Overlock:700italic">Overlock bold (700) italic</option>
				<option value="Overlock:900">Overlock bold (900) </option>
				<option value="Overlock:900italic">Overlock bold (900) italic</option>
				<option value="Overlock&amp;subset=latin-ext">Overlock latin-ext</option>
				<option value="Overlock:400italic&amp;subset=latin-ext">Overlock  italic latin-ext</option>
				<option value="Overlock:700&amp;subset=latin-ext">Overlock bold (700)  latin-ext</option>
				<option value="Overlock:700italic&amp;subset=latin-ext">Overlock bold (700) italic latin-ext</option>
				<option value="Overlock:900&amp;subset=latin-ext">Overlock bold (900)  latin-ext</option>
				<option value="Overlock:900italic&amp;subset=latin-ext">Overlock bold (900) italic latin-ext</option>
				<option value="Overlock SC">Overlock SC</option>
				<option value="Overlock SC&amp;subset=latin-ext">Overlock SC latin-ext</option>
				<option value="Ovo">Ovo</option>
				<option value="Oxygen:300">Oxygen bold (300) </option>
				<option value="Oxygen">Oxygen</option>
				<option value="Oxygen:700">Oxygen bold (700) </option>
				<option value="Oxygen&amp;subset=latin-ext">Oxygen latin-ext</option>
				<option value="Oxygen:300&amp;subset=latin-ext">Oxygen bold (300)  latin-ext</option>
				<option value="Oxygen:700&amp;subset=latin-ext">Oxygen bold (700)  latin-ext</option>
				<option value="Oxygen Mono">Oxygen Mono</option>
				<option value="Oxygen Mono&amp;subset=latin-ext">Oxygen Mono latin-ext</option>
				<option value="PT Mono">PT Mono</option>
				<option value="PT Mono&amp;subset=latin-ext">PT Mono latin-ext</option>
				<option value="PT Mono&amp;subset=cyrillic-ext">PT Mono cyrillic-ext</option>
				<option value="PT Mono&amp;subset=cyrillic">PT Mono cyrillic</option>
				<option value="PT Sans">PT Sans</option>
				<option value="PT Sans:400italic">PT Sans  italic</option>
				<option value="PT Sans:700">PT Sans bold (700) </option>
				<option value="PT Sans:700italic">PT Sans bold (700) italic</option>
				<option value="PT Sans&amp;subset=latin-ext">PT Sans latin-ext</option>
				<option value="PT Sans&amp;subset=cyrillic-ext">PT Sans cyrillic-ext</option>
				<option value="PT Sans&amp;subset=cyrillic">PT Sans cyrillic</option>
				<option value="PT Sans:400italic&amp;subset=latin-ext">PT Sans  italic latin-ext</option>
				<option value="PT Sans:400italic&amp;subset=cyrillic-ext">PT Sans  italic cyrillic-ext</option>
				<option value="PT Sans:400italic&amp;subset=cyrillic">PT Sans  italic cyrillic</option>
				<option value="PT Sans:700&amp;subset=latin-ext">PT Sans bold (700)  latin-ext</option>
				<option value="PT Sans:700&amp;subset=cyrillic-ext">PT Sans bold (700)  cyrillic-ext</option>
				<option value="PT Sans:700&amp;subset=cyrillic">PT Sans bold (700)  cyrillic</option>
				<option value="PT Sans:700italic&amp;subset=latin-ext">PT Sans bold (700) italic latin-ext</option>
				<option value="PT Sans:700italic&amp;subset=cyrillic-ext">PT Sans bold (700) italic cyrillic-ext</option>
				<option value="PT Sans:700italic&amp;subset=cyrillic">PT Sans bold (700) italic cyrillic</option>
				<option value="PT Sans Caption">PT Sans Caption</option>
				<option value="PT Sans Caption:700">PT Sans Caption bold (700) </option>
				<option value="PT Sans Caption&amp;subset=latin-ext">PT Sans Caption latin-ext</option>
				<option value="PT Sans Caption&amp;subset=cyrillic-ext">PT Sans Caption cyrillic-ext</option>
				<option value="PT Sans Caption&amp;subset=cyrillic">PT Sans Caption cyrillic</option>
				<option value="PT Sans Caption:700&amp;subset=latin-ext">PT Sans Caption bold (700)  latin-ext</option>
				<option value="PT Sans Caption:700&amp;subset=cyrillic-ext">PT Sans Caption bold (700)  cyrillic-ext</option>
				<option value="PT Sans Caption:700&amp;subset=cyrillic">PT Sans Caption bold (700)  cyrillic</option>
				<option value="PT Sans Narrow">PT Sans Narrow</option>
				<option value="PT Sans Narrow:700">PT Sans Narrow bold (700) </option>
				<option value="PT Sans Narrow&amp;subset=latin-ext">PT Sans Narrow latin-ext</option>
				<option value="PT Sans Narrow&amp;subset=cyrillic-ext">PT Sans Narrow cyrillic-ext</option>
				<option value="PT Sans Narrow&amp;subset=cyrillic">PT Sans Narrow cyrillic</option>
				<option value="PT Sans Narrow:700&amp;subset=latin-ext">PT Sans Narrow bold (700)  latin-ext</option>
				<option value="PT Sans Narrow:700&amp;subset=cyrillic-ext">PT Sans Narrow bold (700)  cyrillic-ext</option>
				<option value="PT Sans Narrow:700&amp;subset=cyrillic">PT Sans Narrow bold (700)  cyrillic</option>
				<option value="PT Serif">PT Serif</option>
				<option value="PT Serif:400italic">PT Serif  italic</option>
				<option value="PT Serif:700">PT Serif bold (700) </option>
				<option value="PT Serif:700italic">PT Serif bold (700) italic</option>
				<option value="PT Serif&amp;subset=latin-ext">PT Serif latin-ext</option>
				<option value="PT Serif&amp;subset=cyrillic-ext">PT Serif cyrillic-ext</option>
				<option value="PT Serif&amp;subset=cyrillic">PT Serif cyrillic</option>
				<option value="PT Serif:400italic&amp;subset=latin-ext">PT Serif  italic latin-ext</option>
				<option value="PT Serif:400italic&amp;subset=cyrillic-ext">PT Serif  italic cyrillic-ext</option>
				<option value="PT Serif:400italic&amp;subset=cyrillic">PT Serif  italic cyrillic</option>
				<option value="PT Serif:700&amp;subset=latin-ext">PT Serif bold (700)  latin-ext</option>
				<option value="PT Serif:700&amp;subset=cyrillic-ext">PT Serif bold (700)  cyrillic-ext</option>
				<option value="PT Serif:700&amp;subset=cyrillic">PT Serif bold (700)  cyrillic</option>
				<option value="PT Serif:700italic&amp;subset=latin-ext">PT Serif bold (700) italic latin-ext</option>
				<option value="PT Serif:700italic&amp;subset=cyrillic-ext">PT Serif bold (700) italic cyrillic-ext</option>
				<option value="PT Serif:700italic&amp;subset=cyrillic">PT Serif bold (700) italic cyrillic</option>
				<option value="PT Serif Caption">PT Serif Caption</option>
				<option value="PT Serif Caption:400italic">PT Serif Caption  italic</option>
				<option value="PT Serif Caption&amp;subset=latin-ext">PT Serif Caption latin-ext</option>
				<option value="PT Serif Caption&amp;subset=cyrillic-ext">PT Serif Caption cyrillic-ext</option>
				<option value="PT Serif Caption&amp;subset=cyrillic">PT Serif Caption cyrillic</option>
				<option value="PT Serif Caption:400italic&amp;subset=latin-ext">PT Serif Caption  italic latin-ext</option>
				<option value="PT Serif Caption:400italic&amp;subset=cyrillic-ext">PT Serif Caption  italic cyrillic-ext</option>
				<option value="PT Serif Caption:400italic&amp;subset=cyrillic">PT Serif Caption  italic cyrillic</option>
				<option value="Pacifico">Pacifico</option>
				<option value="Paprika">Paprika</option>
				<option value="Parisienne">Parisienne</option>
				<option value="Parisienne&amp;subset=latin-ext">Parisienne latin-ext</option>
				<option value="Passero One">Passero One</option>
				<option value="Passero One&amp;subset=latin-ext">Passero One latin-ext</option>
				<option value="Passion One">Passion One</option>
				<option value="Passion One:700">Passion One bold (700) </option>
				<option value="Passion One:900">Passion One bold (900) </option>
				<option value="Passion One&amp;subset=latin-ext">Passion One latin-ext</option>
				<option value="Passion One:700&amp;subset=latin-ext">Passion One bold (700)  latin-ext</option>
				<option value="Passion One:900&amp;subset=latin-ext">Passion One bold (900)  latin-ext</option>
				<option value="Pathway Gothic One">Pathway Gothic One</option>
				<option value="Pathway Gothic One&amp;subset=latin-ext">Pathway Gothic One latin-ext</option>
				<option value="Patrick Hand">Patrick Hand</option>
				<option value="Patrick Hand&amp;subset=latin-ext">Patrick Hand latin-ext</option>
				<option value="Patrick Hand&amp;subset=vietnamese">Patrick Hand vietnamese</option>
				<option value="Patrick Hand SC">Patrick Hand SC</option>
				<option value="Patrick Hand SC&amp;subset=latin-ext">Patrick Hand SC latin-ext</option>
				<option value="Patrick Hand SC&amp;subset=vietnamese">Patrick Hand SC vietnamese</option>
				<option value="Patua One">Patua One</option>
				<option value="Paytone One">Paytone One</option>
				<option value="Peralta">Peralta</option>
				<option value="Peralta&amp;subset=latin-ext">Peralta latin-ext</option>
				<option value="Permanent Marker">Permanent Marker</option>
				<option value="Petit Formal Script">Petit Formal Script</option>
				<option value="Petit Formal Script&amp;subset=latin-ext">Petit Formal Script latin-ext</option>
				<option value="Petrona">Petrona</option>
				<option value="Philosopher">Philosopher</option>
				<option value="Philosopher:400italic">Philosopher  italic</option>
				<option value="Philosopher:700">Philosopher bold (700) </option>
				<option value="Philosopher:700italic">Philosopher bold (700) italic</option>
				<option value="Philosopher&amp;subset=cyrillic">Philosopher cyrillic</option>
				<option value="Philosopher:400italic&amp;subset=cyrillic">Philosopher  italic cyrillic</option>
				<option value="Philosopher:700&amp;subset=cyrillic">Philosopher bold (700)  cyrillic</option>
				<option value="Philosopher:700italic&amp;subset=cyrillic">Philosopher bold (700) italic cyrillic</option>
				<option value="Piedra">Piedra</option>
				<option value="Piedra&amp;subset=latin-ext">Piedra latin-ext</option>
				<option value="Pinyon Script">Pinyon Script</option>
				<option value="Pirata One">Pirata One</option>
				<option value="Pirata One&amp;subset=latin-ext">Pirata One latin-ext</option>
				<option value="Plaster">Plaster</option>
				<option value="Plaster&amp;subset=latin-ext">Plaster latin-ext</option>
				<option value="Play">Play</option>
				<option value="Play:700">Play bold (700) </option>
				<option value="Play&amp;subset=latin-ext">Play latin-ext</option>
				<option value="Play&amp;subset=greek-ext">Play greek-ext</option>
				<option value="Play&amp;subset=cyrillic-ext">Play cyrillic-ext</option>
				<option value="Play&amp;subset=cyrillic">Play cyrillic</option>
				<option value="Play&amp;subset=greek">Play greek</option>
				<option value="Play:700&amp;subset=latin-ext">Play bold (700)  latin-ext</option>
				<option value="Play:700&amp;subset=greek-ext">Play bold (700)  greek-ext</option>
				<option value="Play:700&amp;subset=cyrillic-ext">Play bold (700)  cyrillic-ext</option>
				<option value="Play:700&amp;subset=cyrillic">Play bold (700)  cyrillic</option>
				<option value="Play:700&amp;subset=greek">Play bold (700)  greek</option>
				<option value="Playball">Playball</option>
				<option value="Playball&amp;subset=latin-ext">Playball latin-ext</option>
				<option value="Playfair Display">Playfair Display</option>
				<option value="Playfair Display:400italic">Playfair Display  italic</option>
				<option value="Playfair Display:700">Playfair Display bold (700) </option>
				<option value="Playfair Display:700italic">Playfair Display bold (700) italic</option>
				<option value="Playfair Display:900">Playfair Display bold (900) </option>
				<option value="Playfair Display:900italic">Playfair Display bold (900) italic</option>
				<option value="Playfair Display&amp;subset=latin-ext">Playfair Display latin-ext</option>
				<option value="Playfair Display&amp;subset=cyrillic">Playfair Display cyrillic</option>
				<option value="Playfair Display:400italic&amp;subset=latin-ext">Playfair Display  italic latin-ext</option>
				<option value="Playfair Display:400italic&amp;subset=cyrillic">Playfair Display  italic cyrillic</option>
				<option value="Playfair Display:700&amp;subset=latin-ext">Playfair Display bold (700)  latin-ext</option>
				<option value="Playfair Display:700&amp;subset=cyrillic">Playfair Display bold (700)  cyrillic</option>
				<option value="Playfair Display:700italic&amp;subset=latin-ext">Playfair Display bold (700) italic latin-ext</option>
				<option value="Playfair Display:700italic&amp;subset=cyrillic">Playfair Display bold (700) italic cyrillic</option>
				<option value="Playfair Display:900&amp;subset=latin-ext">Playfair Display bold (900)  latin-ext</option>
				<option value="Playfair Display:900&amp;subset=cyrillic">Playfair Display bold (900)  cyrillic</option>
				<option value="Playfair Display:900italic&amp;subset=latin-ext">Playfair Display bold (900) italic latin-ext</option>
				<option value="Playfair Display:900italic&amp;subset=cyrillic">Playfair Display bold (900) italic cyrillic</option>
				<option value="Playfair Display SC">Playfair Display SC</option>
				<option value="Playfair Display SC:400italic">Playfair Display SC  italic</option>
				<option value="Playfair Display SC:700">Playfair Display SC bold (700) </option>
				<option value="Playfair Display SC:700italic">Playfair Display SC bold (700) italic</option>
				<option value="Playfair Display SC:900">Playfair Display SC bold (900) </option>
				<option value="Playfair Display SC:900italic">Playfair Display SC bold (900) italic</option>
				<option value="Playfair Display SC&amp;subset=latin-ext">Playfair Display SC latin-ext</option>
				<option value="Playfair Display SC&amp;subset=cyrillic">Playfair Display SC cyrillic</option>
				<option value="Playfair Display SC:400italic&amp;subset=latin-ext">Playfair Display SC  italic latin-ext</option>
				<option value="Playfair Display SC:400italic&amp;subset=cyrillic">Playfair Display SC  italic cyrillic</option>
				<option value="Playfair Display SC:700&amp;subset=latin-ext">Playfair Display SC bold (700)  latin-ext</option>
				<option value="Playfair Display SC:700&amp;subset=cyrillic">Playfair Display SC bold (700)  cyrillic</option>
				<option value="Playfair Display SC:700italic&amp;subset=latin-ext">Playfair Display SC bold (700) italic latin-ext</option>
				<option value="Playfair Display SC:700italic&amp;subset=cyrillic">Playfair Display SC bold (700) italic cyrillic</option>
				<option value="Playfair Display SC:900&amp;subset=latin-ext">Playfair Display SC bold (900)  latin-ext</option>
				<option value="Playfair Display SC:900&amp;subset=cyrillic">Playfair Display SC bold (900)  cyrillic</option>
				<option value="Playfair Display SC:900italic&amp;subset=latin-ext">Playfair Display SC bold (900) italic latin-ext</option>
				<option value="Playfair Display SC:900italic&amp;subset=cyrillic">Playfair Display SC bold (900) italic cyrillic</option>
				<option value="Podkova">Podkova</option>
				<option value="Podkova:700">Podkova bold (700) </option>
				<option value="Poiret One">Poiret One</option>
				<option value="Poiret One&amp;subset=latin-ext">Poiret One latin-ext</option>
				<option value="Poiret One&amp;subset=cyrillic">Poiret One cyrillic</option>
				<option value="Poller One">Poller One</option>
				<option value="Poly">Poly</option>
				<option value="Poly:400italic">Poly  italic</option>
				<option value="Pompiere">Pompiere</option>
				<option value="Pontano Sans">Pontano Sans</option>
				<option value="Pontano Sans&amp;subset=latin-ext">Pontano Sans latin-ext</option>
				<option value="Port Lligat Sans">Port Lligat Sans</option>
				<option value="Port Lligat Slab">Port Lligat Slab</option>
				<option value="Prata">Prata</option>
				<option value="Preahvihear">Preahvihear</option>
				<option value="Press Start 2P">Press Start 2P</option>
				<option value="Press Start 2P&amp;subset=latin-ext">Press Start 2P latin-ext</option>
				<option value="Press Start 2P&amp;subset=cyrillic">Press Start 2P cyrillic</option>
				<option value="Press Start 2P&amp;subset=greek">Press Start 2P greek</option>
				<option value="Princess Sofia">Princess Sofia</option>
				<option value="Princess Sofia&amp;subset=latin-ext">Princess Sofia latin-ext</option>
				<option value="Prociono">Prociono</option>
				<option value="Prosto One">Prosto One</option>
				<option value="Prosto One&amp;subset=latin-ext">Prosto One latin-ext</option>
				<option value="Prosto One&amp;subset=cyrillic">Prosto One cyrillic</option>
				<option value="Puritan">Puritan</option>
				<option value="Puritan:400italic">Puritan  italic</option>
				<option value="Puritan:700">Puritan bold (700) </option>
				<option value="Puritan:700italic">Puritan bold (700) italic</option>
				<option value="Purple Purse">Purple Purse</option>
				<option value="Purple Purse&amp;subset=latin-ext">Purple Purse latin-ext</option>
				<option value="Quando">Quando</option>
				<option value="Quando&amp;subset=latin-ext">Quando latin-ext</option>
				<option value="Quantico">Quantico</option>
				<option value="Quantico:400italic">Quantico  italic</option>
				<option value="Quantico:700">Quantico bold (700) </option>
				<option value="Quantico:700italic">Quantico bold (700) italic</option>
				<option value="Quattrocento">Quattrocento</option>
				<option value="Quattrocento:700">Quattrocento bold (700) </option>
				<option value="Quattrocento&amp;subset=latin-ext">Quattrocento latin-ext</option>
				<option value="Quattrocento:700&amp;subset=latin-ext">Quattrocento bold (700)  latin-ext</option>
				<option value="Quattrocento Sans">Quattrocento Sans</option>
				<option value="Quattrocento Sans:400italic">Quattrocento Sans  italic</option>
				<option value="Quattrocento Sans:700">Quattrocento Sans bold (700) </option>
				<option value="Quattrocento Sans:700italic">Quattrocento Sans bold (700) italic</option>
				<option value="Quattrocento Sans&amp;subset=latin-ext">Quattrocento Sans latin-ext</option>
				<option value="Quattrocento Sans:400italic&amp;subset=latin-ext">Quattrocento Sans  italic latin-ext</option>
				<option value="Quattrocento Sans:700&amp;subset=latin-ext">Quattrocento Sans bold (700)  latin-ext</option>
				<option value="Quattrocento Sans:700italic&amp;subset=latin-ext">Quattrocento Sans bold (700) italic latin-ext</option>
				<option value="Questrial">Questrial</option>
				<option value="Quicksand:300">Quicksand bold (300) </option>
				<option value="Quicksand">Quicksand</option>
				<option value="Quicksand:700">Quicksand bold (700) </option>
				<option value="Quintessential">Quintessential</option>
				<option value="Quintessential&amp;subset=latin-ext">Quintessential latin-ext</option>
				<option value="Qwigley">Qwigley</option>
				<option value="Qwigley&amp;subset=latin-ext">Qwigley latin-ext</option>
				<option value="Racing Sans One">Racing Sans One</option>
				<option value="Racing Sans One&amp;subset=latin-ext">Racing Sans One latin-ext</option>
				<option value="Radley">Radley</option>
				<option value="Radley:400italic">Radley  italic</option>
				<option value="Radley&amp;subset=latin-ext">Radley latin-ext</option>
				<option value="Radley:400italic&amp;subset=latin-ext">Radley  italic latin-ext</option>
				<option value="Raleway:100">Raleway bold (100) </option>
				<option value="Raleway:200">Raleway bold (200) </option>
				<option value="Raleway:300">Raleway bold (300) </option>
				<option value="Raleway">Raleway</option>
				<option value="Raleway:500">Raleway bold (500) </option>
				<option value="Raleway:600">Raleway bold (600) </option>
				<option value="Raleway:700">Raleway bold (700) </option>
				<option value="Raleway:800">Raleway bold (800) </option>
				<option value="Raleway:900">Raleway bold (900) </option>
				<option value="Raleway Dots">Raleway Dots</option>
				<option value="Raleway Dots&amp;subset=latin-ext">Raleway Dots latin-ext</option>
				<option value="Rambla">Rambla</option>
				<option value="Rambla:400italic">Rambla  italic</option>
				<option value="Rambla:700">Rambla bold (700) </option>
				<option value="Rambla:700italic">Rambla bold (700) italic</option>
				<option value="Rambla&amp;subset=latin-ext">Rambla latin-ext</option>
				<option value="Rambla:400italic&amp;subset=latin-ext">Rambla  italic latin-ext</option>
				<option value="Rambla:700&amp;subset=latin-ext">Rambla bold (700)  latin-ext</option>
				<option value="Rambla:700italic&amp;subset=latin-ext">Rambla bold (700) italic latin-ext</option>
				<option value="Rammetto One">Rammetto One</option>
				<option value="Rammetto One&amp;subset=latin-ext">Rammetto One latin-ext</option>
				<option value="Ranchers">Ranchers</option>
				<option value="Ranchers&amp;subset=latin-ext">Ranchers latin-ext</option>
				<option value="Rancho">Rancho</option>
				<option value="Rationale">Rationale</option>
				<option value="Redressed">Redressed</option>
				<option value="Reenie Beanie">Reenie Beanie</option>
				<option value="Revalia">Revalia</option>
				<option value="Revalia&amp;subset=latin-ext">Revalia latin-ext</option>
				<option value="Ribeye">Ribeye</option>
				<option value="Ribeye&amp;subset=latin-ext">Ribeye latin-ext</option>
				<option value="Ribeye Marrow">Ribeye Marrow</option>
				<option value="Ribeye Marrow&amp;subset=latin-ext">Ribeye Marrow latin-ext</option>
				<option value="Righteous">Righteous</option>
				<option value="Righteous&amp;subset=latin-ext">Righteous latin-ext</option>
				<option value="Risque">Risque</option>
				<option value="Risque&amp;subset=latin-ext">Risque latin-ext</option>
				<option value="Roboto:100">Roboto bold (100) </option>
				<option value="Roboto:100italic">Roboto bold (100) italic</option>
				<option value="Roboto:300">Roboto bold (300) </option>
				<option value="Roboto:300italic">Roboto bold (300) italic</option>
				<option value="Roboto">Roboto</option>
				<option value="Roboto:400italic">Roboto  italic</option>
				<option value="Roboto:500">Roboto bold (500) </option>
				<option value="Roboto:500italic">Roboto bold (500) italic</option>
				<option value="Roboto:700">Roboto bold (700) </option>
				<option value="Roboto:700italic">Roboto bold (700) italic</option>
				<option value="Roboto:900">Roboto bold (900) </option>
				<option value="Roboto:900italic">Roboto bold (900) italic</option>
				<option value="Roboto&amp;subset=latin-ext">Roboto latin-ext</option>
				<option value="Roboto&amp;subset=greek-ext">Roboto greek-ext</option>
				<option value="Roboto&amp;subset=cyrillic-ext">Roboto cyrillic-ext</option>
				<option value="Roboto&amp;subset=cyrillic">Roboto cyrillic</option>
				<option value="Roboto&amp;subset=vietnamese">Roboto vietnamese</option>
				<option value="Roboto&amp;subset=greek">Roboto greek</option>
				<option value="Roboto:100&amp;subset=latin-ext">Roboto bold (100)  latin-ext</option>
				<option value="Roboto:100&amp;subset=greek-ext">Roboto bold (100)  greek-ext</option>
				<option value="Roboto:100&amp;subset=cyrillic-ext">Roboto bold (100)  cyrillic-ext</option>
				<option value="Roboto:100&amp;subset=cyrillic">Roboto bold (100)  cyrillic</option>
				<option value="Roboto:100&amp;subset=vietnamese">Roboto bold (100)  vietnamese</option>
				<option value="Roboto:100&amp;subset=greek">Roboto bold (100)  greek</option>
				<option value="Roboto:100italic&amp;subset=latin-ext">Roboto bold (100) italic latin-ext</option>
				<option value="Roboto:100italic&amp;subset=greek-ext">Roboto bold (100) italic greek-ext</option>
				<option value="Roboto:100italic&amp;subset=cyrillic-ext">Roboto bold (100) italic cyrillic-ext</option>
				<option value="Roboto:100italic&amp;subset=cyrillic">Roboto bold (100) italic cyrillic</option>
				<option value="Roboto:100italic&amp;subset=vietnamese">Roboto bold (100) italic vietnamese</option>
				<option value="Roboto:100italic&amp;subset=greek">Roboto bold (100) italic greek</option>
				<option value="Roboto:300&amp;subset=latin-ext">Roboto bold (300)  latin-ext</option>
				<option value="Roboto:300&amp;subset=greek-ext">Roboto bold (300)  greek-ext</option>
				<option value="Roboto:300&amp;subset=cyrillic-ext">Roboto bold (300)  cyrillic-ext</option>
				<option value="Roboto:300&amp;subset=cyrillic">Roboto bold (300)  cyrillic</option>
				<option value="Roboto:300&amp;subset=vietnamese">Roboto bold (300)  vietnamese</option>
				<option value="Roboto:300&amp;subset=greek">Roboto bold (300)  greek</option>
				<option value="Roboto:300italic&amp;subset=latin-ext">Roboto bold (300) italic latin-ext</option>
				<option value="Roboto:300italic&amp;subset=greek-ext">Roboto bold (300) italic greek-ext</option>
				<option value="Roboto:300italic&amp;subset=cyrillic-ext">Roboto bold (300) italic cyrillic-ext</option>
				<option value="Roboto:300italic&amp;subset=cyrillic">Roboto bold (300) italic cyrillic</option>
				<option value="Roboto:300italic&amp;subset=vietnamese">Roboto bold (300) italic vietnamese</option>
				<option value="Roboto:300italic&amp;subset=greek">Roboto bold (300) italic greek</option>
				<option value="Roboto:400italic&amp;subset=latin-ext">Roboto  italic latin-ext</option>
				<option value="Roboto:400italic&amp;subset=greek-ext">Roboto  italic greek-ext</option>
				<option value="Roboto:400italic&amp;subset=cyrillic-ext">Roboto  italic cyrillic-ext</option>
				<option value="Roboto:400italic&amp;subset=cyrillic">Roboto  italic cyrillic</option>
				<option value="Roboto:400italic&amp;subset=vietnamese">Roboto  italic vietnamese</option>
				<option value="Roboto:400italic&amp;subset=greek">Roboto  italic greek</option>
				<option value="Roboto:500&amp;subset=latin-ext">Roboto bold (500)  latin-ext</option>
				<option value="Roboto:500&amp;subset=greek-ext">Roboto bold (500)  greek-ext</option>
				<option value="Roboto:500&amp;subset=cyrillic-ext">Roboto bold (500)  cyrillic-ext</option>
				<option value="Roboto:500&amp;subset=cyrillic">Roboto bold (500)  cyrillic</option>
				<option value="Roboto:500&amp;subset=vietnamese">Roboto bold (500)  vietnamese</option>
				<option value="Roboto:500&amp;subset=greek">Roboto bold (500)  greek</option>
				<option value="Roboto:500italic&amp;subset=latin-ext">Roboto bold (500) italic latin-ext</option>
				<option value="Roboto:500italic&amp;subset=greek-ext">Roboto bold (500) italic greek-ext</option>
				<option value="Roboto:500italic&amp;subset=cyrillic-ext">Roboto bold (500) italic cyrillic-ext</option>
				<option value="Roboto:500italic&amp;subset=cyrillic">Roboto bold (500) italic cyrillic</option>
				<option value="Roboto:500italic&amp;subset=vietnamese">Roboto bold (500) italic vietnamese</option>
				<option value="Roboto:500italic&amp;subset=greek">Roboto bold (500) italic greek</option>
				<option value="Roboto:700&amp;subset=latin-ext">Roboto bold (700)  latin-ext</option>
				<option value="Roboto:700&amp;subset=greek-ext">Roboto bold (700)  greek-ext</option>
				<option value="Roboto:700&amp;subset=cyrillic-ext">Roboto bold (700)  cyrillic-ext</option>
				<option value="Roboto:700&amp;subset=cyrillic">Roboto bold (700)  cyrillic</option>
				<option value="Roboto:700&amp;subset=vietnamese">Roboto bold (700)  vietnamese</option>
				<option value="Roboto:700&amp;subset=greek">Roboto bold (700)  greek</option>
				<option value="Roboto:700italic&amp;subset=latin-ext">Roboto bold (700) italic latin-ext</option>
				<option value="Roboto:700italic&amp;subset=greek-ext">Roboto bold (700) italic greek-ext</option>
				<option value="Roboto:700italic&amp;subset=cyrillic-ext">Roboto bold (700) italic cyrillic-ext</option>
				<option value="Roboto:700italic&amp;subset=cyrillic">Roboto bold (700) italic cyrillic</option>
				<option value="Roboto:700italic&amp;subset=vietnamese">Roboto bold (700) italic vietnamese</option>
				<option value="Roboto:700italic&amp;subset=greek">Roboto bold (700) italic greek</option>
				<option value="Roboto:900&amp;subset=latin-ext">Roboto bold (900)  latin-ext</option>
				<option value="Roboto:900&amp;subset=greek-ext">Roboto bold (900)  greek-ext</option>
				<option value="Roboto:900&amp;subset=cyrillic-ext">Roboto bold (900)  cyrillic-ext</option>
				<option value="Roboto:900&amp;subset=cyrillic">Roboto bold (900)  cyrillic</option>
				<option value="Roboto:900&amp;subset=vietnamese">Roboto bold (900)  vietnamese</option>
				<option value="Roboto:900&amp;subset=greek">Roboto bold (900)  greek</option>
				<option value="Roboto:900italic&amp;subset=latin-ext">Roboto bold (900) italic latin-ext</option>
				<option value="Roboto:900italic&amp;subset=greek-ext">Roboto bold (900) italic greek-ext</option>
				<option value="Roboto:900italic&amp;subset=cyrillic-ext">Roboto bold (900) italic cyrillic-ext</option>
				<option value="Roboto:900italic&amp;subset=cyrillic">Roboto bold (900) italic cyrillic</option>
				<option value="Roboto:900italic&amp;subset=vietnamese">Roboto bold (900) italic vietnamese</option>
				<option value="Roboto:900italic&amp;subset=greek">Roboto bold (900) italic greek</option>
				<option value="Roboto Condensed:300">Roboto Condensed bold (300) </option>
				<option value="Roboto Condensed:300italic">Roboto Condensed bold (300) italic</option>
				<option value="Roboto Condensed">Roboto Condensed</option>
				<option value="Roboto Condensed:400italic">Roboto Condensed  italic</option>
				<option value="Roboto Condensed:700">Roboto Condensed bold (700) </option>
				<option value="Roboto Condensed:700italic">Roboto Condensed bold (700) italic</option>
				<option value="Roboto Condensed&amp;subset=latin-ext">Roboto Condensed latin-ext</option>
				<option value="Roboto Condensed&amp;subset=greek-ext">Roboto Condensed greek-ext</option>
				<option value="Roboto Condensed&amp;subset=cyrillic-ext">Roboto Condensed cyrillic-ext</option>
				<option value="Roboto Condensed&amp;subset=cyrillic">Roboto Condensed cyrillic</option>
				<option value="Roboto Condensed&amp;subset=vietnamese">Roboto Condensed vietnamese</option>
				<option value="Roboto Condensed&amp;subset=greek">Roboto Condensed greek</option>
				<option value="Roboto Condensed:300&amp;subset=latin-ext">Roboto Condensed bold (300)  latin-ext</option>
				<option value="Roboto Condensed:300&amp;subset=greek-ext">Roboto Condensed bold (300)  greek-ext</option>
				<option value="Roboto Condensed:300&amp;subset=cyrillic-ext">Roboto Condensed bold (300)  cyrillic-ext</option>
				<option value="Roboto Condensed:300&amp;subset=cyrillic">Roboto Condensed bold (300)  cyrillic</option>
				<option value="Roboto Condensed:300&amp;subset=vietnamese">Roboto Condensed bold (300)  vietnamese</option>
				<option value="Roboto Condensed:300&amp;subset=greek">Roboto Condensed bold (300)  greek</option>
				<option value="Roboto Condensed:300italic&amp;subset=latin-ext">Roboto Condensed bold (300) italic latin-ext</option>
				<option value="Roboto Condensed:300italic&amp;subset=greek-ext">Roboto Condensed bold (300) italic greek-ext</option>
				<option value="Roboto Condensed:300italic&amp;subset=cyrillic-ext">Roboto Condensed bold (300) italic cyrillic-ext</option>
				<option value="Roboto Condensed:300italic&amp;subset=cyrillic">Roboto Condensed bold (300) italic cyrillic</option>
				<option value="Roboto Condensed:300italic&amp;subset=vietnamese">Roboto Condensed bold (300) italic vietnamese</option>
				<option value="Roboto Condensed:300italic&amp;subset=greek">Roboto Condensed bold (300) italic greek</option>
				<option value="Roboto Condensed:400italic&amp;subset=latin-ext">Roboto Condensed  italic latin-ext</option>
				<option value="Roboto Condensed:400italic&amp;subset=greek-ext">Roboto Condensed  italic greek-ext</option>
				<option value="Roboto Condensed:400italic&amp;subset=cyrillic-ext">Roboto Condensed  italic cyrillic-ext</option>
				<option value="Roboto Condensed:400italic&amp;subset=cyrillic">Roboto Condensed  italic cyrillic</option>
				<option value="Roboto Condensed:400italic&amp;subset=vietnamese">Roboto Condensed  italic vietnamese</option>
				<option value="Roboto Condensed:400italic&amp;subset=greek">Roboto Condensed  italic greek</option>
				<option value="Roboto Condensed:700&amp;subset=latin-ext">Roboto Condensed bold (700)  latin-ext</option>
				<option value="Roboto Condensed:700&amp;subset=greek-ext">Roboto Condensed bold (700)  greek-ext</option>
				<option value="Roboto Condensed:700&amp;subset=cyrillic-ext">Roboto Condensed bold (700)  cyrillic-ext</option>
				<option value="Roboto Condensed:700&amp;subset=cyrillic">Roboto Condensed bold (700)  cyrillic</option>
				<option value="Roboto Condensed:700&amp;subset=vietnamese">Roboto Condensed bold (700)  vietnamese</option>
				<option value="Roboto Condensed:700&amp;subset=greek">Roboto Condensed bold (700)  greek</option>
				<option value="Roboto Condensed:700italic&amp;subset=latin-ext">Roboto Condensed bold (700) italic latin-ext</option>
				<option value="Roboto Condensed:700italic&amp;subset=greek-ext">Roboto Condensed bold (700) italic greek-ext</option>
				<option value="Roboto Condensed:700italic&amp;subset=cyrillic-ext">Roboto Condensed bold (700) italic cyrillic-ext</option>
				<option value="Roboto Condensed:700italic&amp;subset=cyrillic">Roboto Condensed bold (700) italic cyrillic</option>
				<option value="Roboto Condensed:700italic&amp;subset=vietnamese">Roboto Condensed bold (700) italic vietnamese</option>
				<option value="Roboto Condensed:700italic&amp;subset=greek">Roboto Condensed bold (700) italic greek</option>
				<option value="Roboto Slab:100">Roboto Slab bold (100) </option>
				<option value="Roboto Slab:300">Roboto Slab bold (300) </option>
				<option value="Roboto Slab">Roboto Slab</option>
				<option value="Roboto Slab:700">Roboto Slab bold (700) </option>
				<option value="Roboto Slab&amp;subset=latin-ext">Roboto Slab latin-ext</option>
				<option value="Roboto Slab&amp;subset=greek-ext">Roboto Slab greek-ext</option>
				<option value="Roboto Slab&amp;subset=cyrillic-ext">Roboto Slab cyrillic-ext</option>
				<option value="Roboto Slab&amp;subset=cyrillic">Roboto Slab cyrillic</option>
				<option value="Roboto Slab&amp;subset=vietnamese">Roboto Slab vietnamese</option>
				<option value="Roboto Slab&amp;subset=greek">Roboto Slab greek</option>
				<option value="Roboto Slab:100&amp;subset=latin-ext">Roboto Slab bold (100)  latin-ext</option>
				<option value="Roboto Slab:100&amp;subset=greek-ext">Roboto Slab bold (100)  greek-ext</option>
				<option value="Roboto Slab:100&amp;subset=cyrillic-ext">Roboto Slab bold (100)  cyrillic-ext</option>
				<option value="Roboto Slab:100&amp;subset=cyrillic">Roboto Slab bold (100)  cyrillic</option>
				<option value="Roboto Slab:100&amp;subset=vietnamese">Roboto Slab bold (100)  vietnamese</option>
				<option value="Roboto Slab:100&amp;subset=greek">Roboto Slab bold (100)  greek</option>
				<option value="Roboto Slab:300&amp;subset=latin-ext">Roboto Slab bold (300)  latin-ext</option>
				<option value="Roboto Slab:300&amp;subset=greek-ext">Roboto Slab bold (300)  greek-ext</option>
				<option value="Roboto Slab:300&amp;subset=cyrillic-ext">Roboto Slab bold (300)  cyrillic-ext</option>
				<option value="Roboto Slab:300&amp;subset=cyrillic">Roboto Slab bold (300)  cyrillic</option>
				<option value="Roboto Slab:300&amp;subset=vietnamese">Roboto Slab bold (300)  vietnamese</option>
				<option value="Roboto Slab:300&amp;subset=greek">Roboto Slab bold (300)  greek</option>
				<option value="Roboto Slab:700&amp;subset=latin-ext">Roboto Slab bold (700)  latin-ext</option>
				<option value="Roboto Slab:700&amp;subset=greek-ext">Roboto Slab bold (700)  greek-ext</option>
				<option value="Roboto Slab:700&amp;subset=cyrillic-ext">Roboto Slab bold (700)  cyrillic-ext</option>
				<option value="Roboto Slab:700&amp;subset=cyrillic">Roboto Slab bold (700)  cyrillic</option>
				<option value="Roboto Slab:700&amp;subset=vietnamese">Roboto Slab bold (700)  vietnamese</option>
				<option value="Roboto Slab:700&amp;subset=greek">Roboto Slab bold (700)  greek</option>
				<option value="Rochester">Rochester</option>
				<option value="Rock Salt">Rock Salt</option>
				<option value="Rokkitt">Rokkitt</option>
				<option value="Rokkitt:700">Rokkitt bold (700) </option>
				<option value="Romanesco">Romanesco</option>
				<option value="Romanesco&amp;subset=latin-ext">Romanesco latin-ext</option>
				<option value="Ropa Sans">Ropa Sans</option>
				<option value="Ropa Sans:400italic">Ropa Sans  italic</option>
				<option value="Ropa Sans&amp;subset=latin-ext">Ropa Sans latin-ext</option>
				<option value="Ropa Sans:400italic&amp;subset=latin-ext">Ropa Sans  italic latin-ext</option>
				<option value="Rosario">Rosario</option>
				<option value="Rosario:400italic">Rosario  italic</option>
				<option value="Rosario:700">Rosario bold (700) </option>
				<option value="Rosario:700italic">Rosario bold (700) italic</option>
				<option value="Rosarivo">Rosarivo</option>
				<option value="Rosarivo:400italic">Rosarivo  italic</option>
				<option value="Rosarivo&amp;subset=latin-ext">Rosarivo latin-ext</option>
				<option value="Rosarivo:400italic&amp;subset=latin-ext">Rosarivo  italic latin-ext</option>
				<option value="Rouge Script">Rouge Script</option>
				<option value="Ruda">Ruda</option>
				<option value="Ruda:700">Ruda bold (700) </option>
				<option value="Ruda:900">Ruda bold (900) </option>
				<option value="Ruda&amp;subset=latin-ext">Ruda latin-ext</option>
				<option value="Ruda:700&amp;subset=latin-ext">Ruda bold (700)  latin-ext</option>
				<option value="Ruda:900&amp;subset=latin-ext">Ruda bold (900)  latin-ext</option>
				<option value="Rufina">Rufina</option>
				<option value="Rufina:700">Rufina bold (700) </option>
				<option value="Rufina&amp;subset=latin-ext">Rufina latin-ext</option>
				<option value="Rufina:700&amp;subset=latin-ext">Rufina bold (700)  latin-ext</option>
				<option value="Ruge Boogie">Ruge Boogie</option>
				<option value="Ruge Boogie&amp;subset=latin-ext">Ruge Boogie latin-ext</option>
				<option value="Ruluko">Ruluko</option>
				<option value="Ruluko&amp;subset=latin-ext">Ruluko latin-ext</option>
				<option value="Rum Raisin">Rum Raisin</option>
				<option value="Rum Raisin&amp;subset=latin-ext">Rum Raisin latin-ext</option>
				<option value="Ruslan Display">Ruslan Display</option>
				<option value="Ruslan Display&amp;subset=latin-ext">Ruslan Display latin-ext</option>
				<option value="Ruslan Display&amp;subset=cyrillic-ext">Ruslan Display cyrillic-ext</option>
				<option value="Ruslan Display&amp;subset=cyrillic">Ruslan Display cyrillic</option>
				<option value="Russo One">Russo One</option>
				<option value="Russo One&amp;subset=latin-ext">Russo One latin-ext</option>
				<option value="Russo One&amp;subset=cyrillic">Russo One cyrillic</option>
				<option value="Ruthie">Ruthie</option>
				<option value="Ruthie&amp;subset=latin-ext">Ruthie latin-ext</option>
				<option value="Rye">Rye</option>
				<option value="Rye&amp;subset=latin-ext">Rye latin-ext</option>
				<option value="Sacramento">Sacramento</option>
				<option value="Sacramento&amp;subset=latin-ext">Sacramento latin-ext</option>
				<option value="Sail">Sail</option>
				<option value="Salsa">Salsa</option>
				<option value="Sanchez">Sanchez</option>
				<option value="Sanchez:400italic">Sanchez  italic</option>
				<option value="Sanchez&amp;subset=latin-ext">Sanchez latin-ext</option>
				<option value="Sanchez:400italic&amp;subset=latin-ext">Sanchez  italic latin-ext</option>
				<option value="Sancreek">Sancreek</option>
				<option value="Sancreek&amp;subset=latin-ext">Sancreek latin-ext</option>
				<option value="Sansita One">Sansita One</option>
				<option value="Sarina">Sarina</option>
				<option value="Sarina&amp;subset=latin-ext">Sarina latin-ext</option>
				<option value="Satisfy">Satisfy</option>
				<option value="Scada">Scada</option>
				<option value="Scada:400italic">Scada  italic</option>
				<option value="Scada:700">Scada bold (700) </option>
				<option value="Scada:700italic">Scada bold (700) italic</option>
				<option value="Scada&amp;subset=latin-ext">Scada latin-ext</option>
				<option value="Scada&amp;subset=cyrillic">Scada cyrillic</option>
				<option value="Scada:400italic&amp;subset=latin-ext">Scada  italic latin-ext</option>
				<option value="Scada:400italic&amp;subset=cyrillic">Scada  italic cyrillic</option>
				<option value="Scada:700&amp;subset=latin-ext">Scada bold (700)  latin-ext</option>
				<option value="Scada:700&amp;subset=cyrillic">Scada bold (700)  cyrillic</option>
				<option value="Scada:700italic&amp;subset=latin-ext">Scada bold (700) italic latin-ext</option>
				<option value="Scada:700italic&amp;subset=cyrillic">Scada bold (700) italic cyrillic</option>
				<option value="Schoolbell">Schoolbell</option>
				<option value="Seaweed Script">Seaweed Script</option>
				<option value="Seaweed Script&amp;subset=latin-ext">Seaweed Script latin-ext</option>
				<option value="Sevillana">Sevillana</option>
				<option value="Sevillana&amp;subset=latin-ext">Sevillana latin-ext</option>
				<option value="Seymour One">Seymour One</option>
				<option value="Seymour One&amp;subset=latin-ext">Seymour One latin-ext</option>
				<option value="Seymour One&amp;subset=cyrillic">Seymour One cyrillic</option>
				<option value="Shadows Into Light">Shadows Into Light</option>
				<option value="Shadows Into Light Two">Shadows Into Light Two</option>
				<option value="Shadows Into Light Two&amp;subset=latin-ext">Shadows Into Light Two latin-ext</option>
				<option value="Shanti">Shanti</option>
				<option value="Share">Share</option>
				<option value="Share:400italic">Share  italic</option>
				<option value="Share:700">Share bold (700) </option>
				<option value="Share:700italic">Share bold (700) italic</option>
				<option value="Share&amp;subset=latin-ext">Share latin-ext</option>
				<option value="Share:400italic&amp;subset=latin-ext">Share  italic latin-ext</option>
				<option value="Share:700&amp;subset=latin-ext">Share bold (700)  latin-ext</option>
				<option value="Share:700italic&amp;subset=latin-ext">Share bold (700) italic latin-ext</option>
				<option value="Share Tech">Share Tech</option>
				<option value="Share Tech Mono">Share Tech Mono</option>
				<option value="Shojumaru">Shojumaru</option>
				<option value="Shojumaru&amp;subset=latin-ext">Shojumaru latin-ext</option>
				<option value="Short Stack">Short Stack</option>
				<option value="Siemreap">Siemreap</option>
				<option value="Sigmar One">Sigmar One</option>
				<option value="Signika:300">Signika bold (300) </option>
				<option value="Signika">Signika</option>
				<option value="Signika:600">Signika bold (600) </option>
				<option value="Signika:700">Signika bold (700) </option>
				<option value="Signika&amp;subset=latin-ext">Signika latin-ext</option>
				<option value="Signika:300&amp;subset=latin-ext">Signika bold (300)  latin-ext</option>
				<option value="Signika:600&amp;subset=latin-ext">Signika bold (600)  latin-ext</option>
				<option value="Signika:700&amp;subset=latin-ext">Signika bold (700)  latin-ext</option>
				<option value="Signika Negative:300">Signika Negative bold (300) </option>
				<option value="Signika Negative">Signika Negative</option>
				<option value="Signika Negative:600">Signika Negative bold (600) </option>
				<option value="Signika Negative:700">Signika Negative bold (700) </option>
				<option value="Signika Negative&amp;subset=latin-ext">Signika Negative latin-ext</option>
				<option value="Signika Negative:300&amp;subset=latin-ext">Signika Negative bold (300)  latin-ext</option>
				<option value="Signika Negative:600&amp;subset=latin-ext">Signika Negative bold (600)  latin-ext</option>
				<option value="Signika Negative:700&amp;subset=latin-ext">Signika Negative bold (700)  latin-ext</option>
				<option value="Simonetta">Simonetta</option>
				<option value="Simonetta:400italic">Simonetta  italic</option>
				<option value="Simonetta:900">Simonetta bold (900) </option>
				<option value="Simonetta:900italic">Simonetta bold (900) italic</option>
				<option value="Simonetta&amp;subset=latin-ext">Simonetta latin-ext</option>
				<option value="Simonetta:400italic&amp;subset=latin-ext">Simonetta  italic latin-ext</option>
				<option value="Simonetta:900&amp;subset=latin-ext">Simonetta bold (900)  latin-ext</option>
				<option value="Simonetta:900italic&amp;subset=latin-ext">Simonetta bold (900) italic latin-ext</option>
				<option value="Sintony">Sintony</option>
				<option value="Sintony:700">Sintony bold (700) </option>
				<option value="Sintony&amp;subset=latin-ext">Sintony latin-ext</option>
				<option value="Sintony:700&amp;subset=latin-ext">Sintony bold (700)  latin-ext</option>
				<option value="Sirin Stencil">Sirin Stencil</option>
				<option value="Six Caps">Six Caps</option>
				<option value="Skranji">Skranji</option>
				<option value="Skranji:700">Skranji bold (700) </option>
				<option value="Skranji&amp;subset=latin-ext">Skranji latin-ext</option>
				<option value="Skranji:700&amp;subset=latin-ext">Skranji bold (700)  latin-ext</option>
				<option value="Slackey">Slackey</option>
				<option value="Smokum">Smokum</option>
				<option value="Smythe">Smythe</option>
				<option value="Sniglet:800">Sniglet bold (800) </option>
				<option value="Snippet">Snippet</option>
				<option value="Snowburst One">Snowburst One</option>
				<option value="Snowburst One&amp;subset=latin-ext">Snowburst One latin-ext</option>
				<option value="Sofadi One">Sofadi One</option>
				<option value="Sofia">Sofia</option>
				<option value="Sonsie One">Sonsie One</option>
				<option value="Sonsie One&amp;subset=latin-ext">Sonsie One latin-ext</option>
				<option value="Sorts Mill Goudy">Sorts Mill Goudy</option>
				<option value="Sorts Mill Goudy:400italic">Sorts Mill Goudy  italic</option>
				<option value="Sorts Mill Goudy&amp;subset=latin-ext">Sorts Mill Goudy latin-ext</option>
				<option value="Sorts Mill Goudy:400italic&amp;subset=latin-ext">Sorts Mill Goudy  italic latin-ext</option>
				<option value="Source Code Pro:200">Source Code Pro bold (200) </option>
				<option value="Source Code Pro:300">Source Code Pro bold (300) </option>
				<option value="Source Code Pro">Source Code Pro</option>
				<option value="Source Code Pro:500">Source Code Pro bold (500) </option>
				<option value="Source Code Pro:600">Source Code Pro bold (600) </option>
				<option value="Source Code Pro:700">Source Code Pro bold (700) </option>
				<option value="Source Code Pro:900">Source Code Pro bold (900) </option>
				<option value="Source Code Pro&amp;subset=latin-ext">Source Code Pro latin-ext</option>
				<option value="Source Code Pro:200&amp;subset=latin-ext">Source Code Pro bold (200)  latin-ext</option>
				<option value="Source Code Pro:300&amp;subset=latin-ext">Source Code Pro bold (300)  latin-ext</option>
				<option value="Source Code Pro:500&amp;subset=latin-ext">Source Code Pro bold (500)  latin-ext</option>
				<option value="Source Code Pro:600&amp;subset=latin-ext">Source Code Pro bold (600)  latin-ext</option>
				<option value="Source Code Pro:700&amp;subset=latin-ext">Source Code Pro bold (700)  latin-ext</option>
				<option value="Source Code Pro:900&amp;subset=latin-ext">Source Code Pro bold (900)  latin-ext</option>
				<option value="Source Sans Pro:200">Source Sans Pro bold (200) </option>
				<option value="Source Sans Pro:200italic">Source Sans Pro bold (200) italic</option>
				<option value="Source Sans Pro:300">Source Sans Pro bold (300) </option>
				<option value="Source Sans Pro:300italic">Source Sans Pro bold (300) italic</option>
				<option value="Source Sans Pro">Source Sans Pro</option>
				<option value="Source Sans Pro:400italic">Source Sans Pro  italic</option>
				<option value="Source Sans Pro:600">Source Sans Pro bold (600) </option>
				<option value="Source Sans Pro:600italic">Source Sans Pro bold (600) italic</option>
				<option value="Source Sans Pro:700">Source Sans Pro bold (700) </option>
				<option value="Source Sans Pro:700italic">Source Sans Pro bold (700) italic</option>
				<option value="Source Sans Pro:900">Source Sans Pro bold (900) </option>
				<option value="Source Sans Pro:900italic">Source Sans Pro bold (900) italic</option>
				<option value="Source Sans Pro&amp;subset=latin-ext">Source Sans Pro latin-ext</option>
				<option value="Source Sans Pro:200&amp;subset=latin-ext">Source Sans Pro bold (200)  latin-ext</option>
				<option value="Source Sans Pro:200italic&amp;subset=latin-ext">Source Sans Pro bold (200) italic latin-ext</option>
				<option value="Source Sans Pro:300&amp;subset=latin-ext">Source Sans Pro bold (300)  latin-ext</option>
				<option value="Source Sans Pro:300italic&amp;subset=latin-ext">Source Sans Pro bold (300) italic latin-ext</option>
				<option value="Source Sans Pro:400italic&amp;subset=latin-ext">Source Sans Pro  italic latin-ext</option>
				<option value="Source Sans Pro:600&amp;subset=latin-ext">Source Sans Pro bold (600)  latin-ext</option>
				<option value="Source Sans Pro:600italic&amp;subset=latin-ext">Source Sans Pro bold (600) italic latin-ext</option>
				<option value="Source Sans Pro:700&amp;subset=latin-ext">Source Sans Pro bold (700)  latin-ext</option>
				<option value="Source Sans Pro:700italic&amp;subset=latin-ext">Source Sans Pro bold (700) italic latin-ext</option>
				<option value="Source Sans Pro:900&amp;subset=latin-ext">Source Sans Pro bold (900)  latin-ext</option>
				<option value="Source Sans Pro:900italic&amp;subset=latin-ext">Source Sans Pro bold (900) italic latin-ext</option>
				<option value="Special Elite">Special Elite</option>
				<option value="Spicy Rice">Spicy Rice</option>
				<option value="Spinnaker">Spinnaker</option>
				<option value="Spinnaker&amp;subset=latin-ext">Spinnaker latin-ext</option>
				<option value="Spirax">Spirax</option>
				<option value="Squada One">Squada One</option>
				<option value="Stalemate">Stalemate</option>
				<option value="Stalemate&amp;subset=latin-ext">Stalemate latin-ext</option>
				<option value="Stalinist One">Stalinist One</option>
				<option value="Stalinist One&amp;subset=latin-ext">Stalinist One latin-ext</option>
				<option value="Stalinist One&amp;subset=cyrillic">Stalinist One cyrillic</option>
				<option value="Stardos Stencil">Stardos Stencil</option>
				<option value="Stardos Stencil:700">Stardos Stencil bold (700) </option>
				<option value="Stint Ultra Condensed">Stint Ultra Condensed</option>
				<option value="Stint Ultra Condensed&amp;subset=latin-ext">Stint Ultra Condensed latin-ext</option>
				<option value="Stint Ultra Expanded">Stint Ultra Expanded</option>
				<option value="Stint Ultra Expanded&amp;subset=latin-ext">Stint Ultra Expanded latin-ext</option>
				<option value="Stoke:300">Stoke bold (300) </option>
				<option value="Stoke">Stoke</option>
				<option value="Stoke&amp;subset=latin-ext">Stoke latin-ext</option>
				<option value="Stoke:300&amp;subset=latin-ext">Stoke bold (300)  latin-ext</option>
				<option value="Strait">Strait</option>
				<option value="Sue Ellen Francisco">Sue Ellen Francisco</option>
				<option value="Sunshiney">Sunshiney</option>
				<option value="Supermercado One">Supermercado One</option>
				<option value="Suwannaphum">Suwannaphum</option>
				<option value="Swanky and Moo Moo">Swanky and Moo Moo</option>
				<option value="Syncopate">Syncopate</option>
				<option value="Syncopate:700">Syncopate bold (700) </option>
				<option value="Tangerine">Tangerine</option>
				<option value="Tangerine:700">Tangerine bold (700) </option>
				<option value="Taprom">Taprom</option>
				<option value="Tauri">Tauri</option>
				<option value="Tauri&amp;subset=latin-ext">Tauri latin-ext</option>
				<option value="Telex">Telex</option>
				<option value="Tenor Sans">Tenor Sans</option>
				<option value="Tenor Sans&amp;subset=latin-ext">Tenor Sans latin-ext</option>
				<option value="Tenor Sans&amp;subset=cyrillic-ext">Tenor Sans cyrillic-ext</option>
				<option value="Tenor Sans&amp;subset=cyrillic">Tenor Sans cyrillic</option>
				<option value="Text Me One">Text Me One</option>
				<option value="Text Me One&amp;subset=latin-ext">Text Me One latin-ext</option>
				<option value="The Girl Next Door">The Girl Next Door</option>
				<option value="Tienne">Tienne</option>
				<option value="Tienne:700">Tienne bold (700) </option>
				<option value="Tienne:900">Tienne bold (900) </option>
				<option value="Tinos">Tinos</option>
				<option value="Tinos:400italic">Tinos  italic</option>
				<option value="Tinos:700">Tinos bold (700) </option>
				<option value="Tinos:700italic">Tinos bold (700) italic</option>
				<option value="Titan One">Titan One</option>
				<option value="Titan One&amp;subset=latin-ext">Titan One latin-ext</option>
				<option value="Titillium Web:200">Titillium Web bold (200) </option>
				<option value="Titillium Web:200italic">Titillium Web bold (200) italic</option>
				<option value="Titillium Web:300">Titillium Web bold (300) </option>
				<option value="Titillium Web:300italic">Titillium Web bold (300) italic</option>
				<option value="Titillium Web">Titillium Web</option>
				<option value="Titillium Web:400italic">Titillium Web  italic</option>
				<option value="Titillium Web:600">Titillium Web bold (600) </option>
				<option value="Titillium Web:600italic">Titillium Web bold (600) italic</option>
				<option value="Titillium Web:700">Titillium Web bold (700) </option>
				<option value="Titillium Web:700italic">Titillium Web bold (700) italic</option>
				<option value="Titillium Web:900">Titillium Web bold (900) </option>
				<option value="Titillium Web&amp;subset=latin-ext">Titillium Web latin-ext</option>
				<option value="Titillium Web:200&amp;subset=latin-ext">Titillium Web bold (200)  latin-ext</option>
				<option value="Titillium Web:200italic&amp;subset=latin-ext">Titillium Web bold (200) italic latin-ext</option>
				<option value="Titillium Web:300&amp;subset=latin-ext">Titillium Web bold (300)  latin-ext</option>
				<option value="Titillium Web:300italic&amp;subset=latin-ext">Titillium Web bold (300) italic latin-ext</option>
				<option value="Titillium Web:400italic&amp;subset=latin-ext">Titillium Web  italic latin-ext</option>
				<option value="Titillium Web:600&amp;subset=latin-ext">Titillium Web bold (600)  latin-ext</option>
				<option value="Titillium Web:600italic&amp;subset=latin-ext">Titillium Web bold (600) italic latin-ext</option>
				<option value="Titillium Web:700&amp;subset=latin-ext">Titillium Web bold (700)  latin-ext</option>
				<option value="Titillium Web:700italic&amp;subset=latin-ext">Titillium Web bold (700) italic latin-ext</option>
				<option value="Titillium Web:900&amp;subset=latin-ext">Titillium Web bold (900)  latin-ext</option>
				<option value="Trade Winds">Trade Winds</option>
				<option value="Trocchi">Trocchi</option>
				<option value="Trocchi&amp;subset=latin-ext">Trocchi latin-ext</option>
				<option value="Trochut">Trochut</option>
				<option value="Trochut:400italic">Trochut  italic</option>
				<option value="Trochut:700">Trochut bold (700) </option>
				<option value="Trykker">Trykker</option>
				<option value="Trykker&amp;subset=latin-ext">Trykker latin-ext</option>
				<option value="Tulpen One">Tulpen One</option>
				<option value="Ubuntu:300">Ubuntu bold (300) </option>
				<option value="Ubuntu:300italic">Ubuntu bold (300) italic</option>
				<option value="Ubuntu">Ubuntu</option>
				<option value="Ubuntu:400italic">Ubuntu  italic</option>
				<option value="Ubuntu:500">Ubuntu bold (500) </option>
				<option value="Ubuntu:500italic">Ubuntu bold (500) italic</option>
				<option value="Ubuntu:700">Ubuntu bold (700) </option>
				<option value="Ubuntu:700italic">Ubuntu bold (700) italic</option>
				<option value="Ubuntu&amp;subset=latin-ext">Ubuntu latin-ext</option>
				<option value="Ubuntu&amp;subset=greek-ext">Ubuntu greek-ext</option>
				<option value="Ubuntu&amp;subset=cyrillic-ext">Ubuntu cyrillic-ext</option>
				<option value="Ubuntu&amp;subset=cyrillic">Ubuntu cyrillic</option>
				<option value="Ubuntu&amp;subset=greek">Ubuntu greek</option>
				<option value="Ubuntu:300&amp;subset=latin-ext">Ubuntu bold (300)  latin-ext</option>
				<option value="Ubuntu:300&amp;subset=greek-ext">Ubuntu bold (300)  greek-ext</option>
				<option value="Ubuntu:300&amp;subset=cyrillic-ext">Ubuntu bold (300)  cyrillic-ext</option>
				<option value="Ubuntu:300&amp;subset=cyrillic">Ubuntu bold (300)  cyrillic</option>
				<option value="Ubuntu:300&amp;subset=greek">Ubuntu bold (300)  greek</option>
				<option value="Ubuntu:300italic&amp;subset=latin-ext">Ubuntu bold (300) italic latin-ext</option>
				<option value="Ubuntu:300italic&amp;subset=greek-ext">Ubuntu bold (300) italic greek-ext</option>
				<option value="Ubuntu:300italic&amp;subset=cyrillic-ext">Ubuntu bold (300) italic cyrillic-ext</option>
				<option value="Ubuntu:300italic&amp;subset=cyrillic">Ubuntu bold (300) italic cyrillic</option>
				<option value="Ubuntu:300italic&amp;subset=greek">Ubuntu bold (300) italic greek</option>
				<option value="Ubuntu:400italic&amp;subset=latin-ext">Ubuntu  italic latin-ext</option>
				<option value="Ubuntu:400italic&amp;subset=greek-ext">Ubuntu  italic greek-ext</option>
				<option value="Ubuntu:400italic&amp;subset=cyrillic-ext">Ubuntu  italic cyrillic-ext</option>
				<option value="Ubuntu:400italic&amp;subset=cyrillic">Ubuntu  italic cyrillic</option>
				<option value="Ubuntu:400italic&amp;subset=greek">Ubuntu  italic greek</option>
				<option value="Ubuntu:500&amp;subset=latin-ext">Ubuntu bold (500)  latin-ext</option>
				<option value="Ubuntu:500&amp;subset=greek-ext">Ubuntu bold (500)  greek-ext</option>
				<option value="Ubuntu:500&amp;subset=cyrillic-ext">Ubuntu bold (500)  cyrillic-ext</option>
				<option value="Ubuntu:500&amp;subset=cyrillic">Ubuntu bold (500)  cyrillic</option>
				<option value="Ubuntu:500&amp;subset=greek">Ubuntu bold (500)  greek</option>
				<option value="Ubuntu:500italic&amp;subset=latin-ext">Ubuntu bold (500) italic latin-ext</option>
				<option value="Ubuntu:500italic&amp;subset=greek-ext">Ubuntu bold (500) italic greek-ext</option>
				<option value="Ubuntu:500italic&amp;subset=cyrillic-ext">Ubuntu bold (500) italic cyrillic-ext</option>
				<option value="Ubuntu:500italic&amp;subset=cyrillic">Ubuntu bold (500) italic cyrillic</option>
				<option value="Ubuntu:500italic&amp;subset=greek">Ubuntu bold (500) italic greek</option>
				<option value="Ubuntu:700&amp;subset=latin-ext">Ubuntu bold (700)  latin-ext</option>
				<option value="Ubuntu:700&amp;subset=greek-ext">Ubuntu bold (700)  greek-ext</option>
				<option value="Ubuntu:700&amp;subset=cyrillic-ext">Ubuntu bold (700)  cyrillic-ext</option>
				<option value="Ubuntu:700&amp;subset=cyrillic">Ubuntu bold (700)  cyrillic</option>
				<option value="Ubuntu:700&amp;subset=greek">Ubuntu bold (700)  greek</option>
				<option value="Ubuntu:700italic&amp;subset=latin-ext">Ubuntu bold (700) italic latin-ext</option>
				<option value="Ubuntu:700italic&amp;subset=greek-ext">Ubuntu bold (700) italic greek-ext</option>
				<option value="Ubuntu:700italic&amp;subset=cyrillic-ext">Ubuntu bold (700) italic cyrillic-ext</option>
				<option value="Ubuntu:700italic&amp;subset=cyrillic">Ubuntu bold (700) italic cyrillic</option>
				<option value="Ubuntu:700italic&amp;subset=greek">Ubuntu bold (700) italic greek</option>
				<option value="Ubuntu Condensed">Ubuntu Condensed</option>
				<option value="Ubuntu Condensed&amp;subset=latin-ext">Ubuntu Condensed latin-ext</option>
				<option value="Ubuntu Condensed&amp;subset=greek-ext">Ubuntu Condensed greek-ext</option>
				<option value="Ubuntu Condensed&amp;subset=cyrillic-ext">Ubuntu Condensed cyrillic-ext</option>
				<option value="Ubuntu Condensed&amp;subset=cyrillic">Ubuntu Condensed cyrillic</option>
				<option value="Ubuntu Condensed&amp;subset=greek">Ubuntu Condensed greek</option>
				<option value="Ubuntu Mono">Ubuntu Mono</option>
				<option value="Ubuntu Mono:400italic">Ubuntu Mono  italic</option>
				<option value="Ubuntu Mono:700">Ubuntu Mono bold (700) </option>
				<option value="Ubuntu Mono:700italic">Ubuntu Mono bold (700) italic</option>
				<option value="Ubuntu Mono&amp;subset=latin-ext">Ubuntu Mono latin-ext</option>
				<option value="Ubuntu Mono&amp;subset=greek-ext">Ubuntu Mono greek-ext</option>
				<option value="Ubuntu Mono&amp;subset=cyrillic-ext">Ubuntu Mono cyrillic-ext</option>
				<option value="Ubuntu Mono&amp;subset=cyrillic">Ubuntu Mono cyrillic</option>
				<option value="Ubuntu Mono&amp;subset=greek">Ubuntu Mono greek</option>
				<option value="Ubuntu Mono:400italic&amp;subset=latin-ext">Ubuntu Mono  italic latin-ext</option>
				<option value="Ubuntu Mono:400italic&amp;subset=greek-ext">Ubuntu Mono  italic greek-ext</option>
				<option value="Ubuntu Mono:400italic&amp;subset=cyrillic-ext">Ubuntu Mono  italic cyrillic-ext</option>
				<option value="Ubuntu Mono:400italic&amp;subset=cyrillic">Ubuntu Mono  italic cyrillic</option>
				<option value="Ubuntu Mono:400italic&amp;subset=greek">Ubuntu Mono  italic greek</option>
				<option value="Ubuntu Mono:700&amp;subset=latin-ext">Ubuntu Mono bold (700)  latin-ext</option>
				<option value="Ubuntu Mono:700&amp;subset=greek-ext">Ubuntu Mono bold (700)  greek-ext</option>
				<option value="Ubuntu Mono:700&amp;subset=cyrillic-ext">Ubuntu Mono bold (700)  cyrillic-ext</option>
				<option value="Ubuntu Mono:700&amp;subset=cyrillic">Ubuntu Mono bold (700)  cyrillic</option>
				<option value="Ubuntu Mono:700&amp;subset=greek">Ubuntu Mono bold (700)  greek</option>
				<option value="Ubuntu Mono:700italic&amp;subset=latin-ext">Ubuntu Mono bold (700) italic latin-ext</option>
				<option value="Ubuntu Mono:700italic&amp;subset=greek-ext">Ubuntu Mono bold (700) italic greek-ext</option>
				<option value="Ubuntu Mono:700italic&amp;subset=cyrillic-ext">Ubuntu Mono bold (700) italic cyrillic-ext</option>
				<option value="Ubuntu Mono:700italic&amp;subset=cyrillic">Ubuntu Mono bold (700) italic cyrillic</option>
				<option value="Ubuntu Mono:700italic&amp;subset=greek">Ubuntu Mono bold (700) italic greek</option>
				<option value="Ultra">Ultra</option>
				<option value="Uncial Antiqua">Uncial Antiqua</option>
				<option value="Underdog">Underdog</option>
				<option value="Underdog&amp;subset=latin-ext">Underdog latin-ext</option>
				<option value="Underdog&amp;subset=cyrillic">Underdog cyrillic</option>
				<option value="Unica One">Unica One</option>
				<option value="Unica One&amp;subset=latin-ext">Unica One latin-ext</option>
				<option value="UnifrakturCook:700">UnifrakturCook bold (700) </option>
				<option value="UnifrakturMaguntia">UnifrakturMaguntia</option>
				<option value="Unkempt">Unkempt</option>
				<option value="Unkempt:700">Unkempt bold (700) </option>
				<option value="Unlock">Unlock</option>
				<option value="Unna">Unna</option>
				<option value="VT323">VT323</option>
				<option value="Vampiro One">Vampiro One</option>
				<option value="Vampiro One&amp;subset=latin-ext">Vampiro One latin-ext</option>
				<option value="Varela">Varela</option>
				<option value="Varela&amp;subset=latin-ext">Varela latin-ext</option>
				<option value="Varela Round">Varela Round</option>
				<option value="Vast Shadow">Vast Shadow</option>
				<option value="Vibur">Vibur</option>
				<option value="Vidaloka">Vidaloka</option>
				<option value="Viga">Viga</option>
				<option value="Viga&amp;subset=latin-ext">Viga latin-ext</option>
				<option value="Voces">Voces</option>
				<option value="Voces&amp;subset=latin-ext">Voces latin-ext</option>
				<option value="Volkhov">Volkhov</option>
				<option value="Volkhov:400italic">Volkhov  italic</option>
				<option value="Volkhov:700">Volkhov bold (700) </option>
				<option value="Volkhov:700italic">Volkhov bold (700) italic</option>
				<option value="Vollkorn">Vollkorn</option>
				<option value="Vollkorn:400italic">Vollkorn  italic</option>
				<option value="Vollkorn:700">Vollkorn bold (700) </option>
				<option value="Vollkorn:700italic">Vollkorn bold (700) italic</option>
				<option value="Voltaire">Voltaire</option>
				<option value="Waiting for the Sunrise">Waiting for the Sunrise</option>
				<option value="Wallpoet">Wallpoet</option>
				<option value="Walter Turncoat">Walter Turncoat</option>
				<option value="Warnes">Warnes</option>
				<option value="Warnes&amp;subset=latin-ext">Warnes latin-ext</option>
				<option value="Wellfleet">Wellfleet</option>
				<option value="Wellfleet&amp;subset=latin-ext">Wellfleet latin-ext</option>
				<option value="Wendy One">Wendy One</option>
				<option value="Wendy One&amp;subset=latin-ext">Wendy One latin-ext</option>
				<option value="Wire One">Wire One</option>
				<option value="Yanone Kaffeesatz:200">Yanone Kaffeesatz bold (200) </option>
				<option value="Yanone Kaffeesatz:300">Yanone Kaffeesatz bold (300) </option>
				<option value="Yanone Kaffeesatz">Yanone Kaffeesatz</option>
				<option value="Yanone Kaffeesatz:700">Yanone Kaffeesatz bold (700) </option>
				<option value="Yanone Kaffeesatz&amp;subset=latin-ext">Yanone Kaffeesatz latin-ext</option>
				<option value="Yanone Kaffeesatz:200&amp;subset=latin-ext">Yanone Kaffeesatz bold (200)  latin-ext</option>
				<option value="Yanone Kaffeesatz:300&amp;subset=latin-ext">Yanone Kaffeesatz bold (300)  latin-ext</option>
				<option value="Yanone Kaffeesatz:700&amp;subset=latin-ext">Yanone Kaffeesatz bold (700)  latin-ext</option>
				<option value="Yellowtail">Yellowtail</option>
				<option value="Yeseva One">Yeseva One</option>
				<option value="Yeseva One&amp;subset=latin-ext">Yeseva One latin-ext</option>
				<option value="Yeseva One&amp;subset=cyrillic">Yeseva One cyrillic</option>
				<option value="Yesteryear">Yesteryear</option>
				<option value="Zeyada">Zeyada</option>
			</select>
			<script>
				jQuery(function($){
					$('#<?php echo esc_attr($options['field_id']) ?>').val(<?php echo json_encode($options['value']) ?>);
				});
		   </script>
		</div>
		<?php
	}
}
