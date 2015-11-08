<?php 

include 'connect.inc.php';

function mybox_file_add($file_user, $file_name, $file_size, $file_type) {

	$query = sprintf("INSERT INTO `usersystem`.`file` (`file_id`, `file_date`, `file_user`, `file_name`, `file_size`, `file_type`)
	 VALUES (NULL, CURRENT_TIMESTAMP, '%s', '%s', '%s', '%s')",$file_user, $file_name, $file_size, $file_type);

	$query_run = mysql_query($query);

	return true;
}

function mybox_get_username_by_filename($file_name) {

	$query = sprintf("SELECT `file_user` FROM `file` WHERE `file_name` = '%s' ", $file_name);

	$query_run = mysql_query($query);

	if(!$query_run)
		echo 'false';

	$query_row = mysql_fetch_assoc($query_run);
	$username  = $query_row['file_user'];
	
	return $username;
}

function mybox_get_filetype_by_filename($file_name) {
	$query = sprintf("SELECT `file_type` FROM `file` WHERE `file_name` = '%s' ", $file_name);

	$query_run = mysql_query($query);

	if(!$query_run)
		echo 'false';

	$query_row = mysql_fetch_assoc($query_run);
	$filetype  = $query_row['file_type'];
	
	return $filetype;
}

function mybox_handel_uploaded_file($name, $size, $type, $tmp_name) {

	include 'APIuser.php';
	include 'core.inc.php';

	$target_loaction = 'uploads/';

	if(isset($name)) {
		if(!empty($name)) {
			
			move_uploaded_file($tmp_name, $target_loaction.$name);
			echo 'File uploaded successfully.';
			
			$user_id = $_SESSION['user_id'];
			$result = mybox_users_get_by_id($user_id);
			$result = $result[0]->user_username;
			mybox_file_add($result, $name, $size, $type);

		} else {
			echo 'Please choose a file.';
		}
	}
}

?>