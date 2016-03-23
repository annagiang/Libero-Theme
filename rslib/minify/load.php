<?php 
session_start();
$expires_offset = 31536000; // 1 year
header('Expires: ' . gmdate( "D, d M Y H:i:s", time() + $expires_offset ) . ' GMT');
header("Cache-Control: public, max-age=$expires_offset");

if($_GET['load'] == 'styles'){
	$sname = $_GET['k'] . '-styles';
	header("Content-type: text/css; charset: UTF-8");
	
	if(!empty($_SESSION[$sname])){
		foreach($_SESSION[$sname] as $name=>$path){
			echo "@import url('$path');\n";				
		}
	}
	else{
		echo '/* no content */';
	}
	
	exit;
}