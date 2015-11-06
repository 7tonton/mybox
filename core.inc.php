<?php 

ob_start();
session_start();

$ip_address = $_SERVER['REMOTE_ADDR'];

$script_name = $_SERVER['SCRIPT_NAME'];

if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER']))
	$http_referer = $_SERVER['HTTP_REFERER'];

function loggedin() {
	if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
		return true;
	} else {
		return false;
	}
}

?>