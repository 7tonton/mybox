<?php 

require('core.inc.php');

if(loggedin()) {
	header('Location: ip_grep.php');
} else {
	include('login_form.inc.php');
}

?>
