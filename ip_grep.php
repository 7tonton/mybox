<?php 

require('core.inc.php');
require('connect.inc.php');
require('APIuser.php');
require('APIip.php');

$get_result = mybox_users_get_by_id($_SESSION['user_id']);

$result = $get_result[0];

$username = $result->user_username;
$phone	  = $result->user_phone;

$add_result = mybox_ip_add($ip_address, $username, $phone);

if($add_result)
	header("Location: dirpage.php");

?>