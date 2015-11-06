<?php 

if(isset($_GET['filename']) && !empty($_GET['filename'])) {
	if(@unlink($_GET['filename'])) {
		header('Location: uv2.php');
	} else {
		echo 'File not deleted.';
	}
}

?>