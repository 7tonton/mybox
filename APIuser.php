<?php 

require('connect.inc.php');

// show all users
function mybox_users_get($extra = '') {

		$query = sprintf("SELECT * FROM `users` %s", $extra);
		$query_run = mysql_query($query);

		if(!@query_run)
			echo mysql_error();

		$mysql_num_rows = mysql_num_rows($query_run);
		if($mysql_num_rows == 0)
			return false;

		$user = array();
		for($i = 0; $i < $mysql_num_rows; $i ++)
			$user[count($user)] = mysql_fetch_object($query_run);

		@mysql_free_result($query_run);

		return $user;
}

function mybox_users_get_by_id($user_id) {
	$id = (int)$user_id;
	if($id == 0)
		return NULL;

	$user = mybox_users_get("WHERE `user_id` = ".$id);
	if($user == NULL) 
		return NULL;

	return $user;

}

function mybox_users_get_by_username($user_username) {
	$check_user_username = mysql_real_escape_string(strip_tags($user_username));
	
	$result = mybox_users_get("WHERE `user_username` = '$check_user_username'");
	
	if($result != NULL)
		$user = $result;
	else
		return NULL;

	return $user;
}

function mybox_users_get_by_phone($user_phone) {
	$check_user_phone = mysql_real_escape_string(strip_tags($user_phone));
	
	$result = mybox_users_get("WHERE `user_phone` = '$check_user_phone'");
	
	if($result != NULL)
		$phone = $result;
	else
		return NULL;

	return $phone;
}

function mybox_users_add($username, $password, $phone) {
	if(empty($username) || empty($password) || empty($phone))
		return false;

	$check_username = mysql_real_escape_string(strip_tags($username));
	$check_password = mysql_real_escape_string(strip_tags($password));
	$check_phone    = mysql_real_escape_string(strip_tags($phone));

	$query = sprintf("INSERT INTO `usersystem`.`users` (`user_id`, `user_username`, `user_password`, `user_phone`) VALUES (NULL, '%s', '%s', '%s')", $check_username, $check_password, $check_phone);

	if(!mysql_query($query))
		echo 'You can\'t be add, please try again';
	
	return true;

}

?>