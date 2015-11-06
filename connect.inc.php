<?php

$user = 'tonton';
$host = 'localhost';
$pass = 'mostring';

$mysql_select_db = 'usersystem';

if(!mysql_connect($host, $user, $pass) || !mysql_select_db($mysql_select_db)) {
	die(mysql_error());
}

?>