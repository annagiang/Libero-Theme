<?php 

class RsFileSystem{
	private static function requestCredentials(){
		require_once( ABSPATH .'/wp-admin/includes/file.php' );
		$url = rs::currentUrl();
		if (false === ($creds = request_filesystem_credentials($url, '', false, false,null) ) ) {
			return false;		
		}
		if(!WP_Filesystem($creds) ) {
			return false;
		}
		return true;
	}
	
	public static function putContents($fullname, $data){
		if(static::requestCredentials()){
			global $wp_filesystem;
			return $wp_filesystem ? $wp_filesystem->put_contents( $fullname, $data, FS_CHMOD_FILE) : false;
		}
	}
	public static function getContents($fullname){
		if(static::requestCredentials()){
			global $wp_filesystem;
			return $wp_filesystem ? $wp_filesystem->get_contents( $fullname) : false;
		}
	}
	
}