<?php 

require('connect.inc.php');

function mybox_ip_add($ip_address, $ip_username, $ip_phone) {

	if(empty($ip_address))
		return false;

	$query = sprintf("INSERT INTO `usersystem`.`ips` (`ip_id`, `ip_address`, `ip_date`, `ip_username`, `ip_phone`) VALUES (NULL, '%s', CURRENT_TIMESTAMP, '%s', '%s')", $ip_address, $ip_username, $ip_phone);

	$query_run = mysql_query($query);

	if(!$query_run)
		echo 'IP address can\'t be added.';
	
	return true;

}

function mybox_ip_visitor_add($ip_address) {

	if(empty($ip_address))
		return false;

	$query = sprintf("INSERT INTO `usersystem`.`ip_visitor` (`ip_visitor_id`, `ip_visitor_address`, `ip_visitor_date`) VALUES (NULL, '%s', CURRENT_TIMESTAMP)", $ip_address);

	$query_run = mysql_query($query);

	if(!$query_run)
		echo 'IP address can\'t be added.';
	
	return true;
}



?>	