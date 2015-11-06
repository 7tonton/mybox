<!--
<form action="uppage.php" method="POST" enctype="multipart/form-data">
	<input type="file" name="file">
	<input type="submit" value="Submit">
	<a href="/mybox"> BACK </a>
</form>
-->
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="avicon.ico">

    <title>File Upload Page</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/custom.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
	 <body>
		  <div id="bar_blank">
		   <div id="bar_color"></div>
		  </div>
		  <div id="status"></div>

		  <div class="progress">
	        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
	        </div>
      	  </div>

			<form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="POST" id="myForm" enctype="multipart/form-data" target="hidden_iframe">
			     <input type="hidden" value="myForm" name="<?php echo ini_get("session.upload_progress.name"); ?>">
			     <input type="file" name="file"><br>
			     <input type="submit" value="Start Upload">
			</form>

		  <iframe id="hidden_iframe" name="hidden_iframe" src="about:blank"></iframe>
		  <script type="text/javascript" src="js/custom_script.js"></script>
	 </body>
</html>



<?php

include 'fileapi.php';
include 'userapi.php';
include 'core.inc.php';

function file_add_info($name, $size, $type) {
	$user_id = $_SESSION['user_id'];
	$result = mybox_users_get_by_id($user_id);
	$result = $result[0]->user_username;
	mybox_file_add($result, $name, $size, $type);
}

@$name = $_FILES['file']['name'];
@$size = $_FILES['file']['size'];
@$type = $_FILES['file']['type'];

@$tmp_name = $_FILES['file']['tmp_name'];

$target_loaction = 'uploads/';

if(isset($name)) {
	if(!empty($name)) {
		move_uploaded_file($tmp_name, $target_loaction.$name);
		echo 'File uploaded successfully.';
		file_add_info($name, $size, $type);
	} else {
		echo 'Please choose a file.';
	}
}


?>
