<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="avicon.ico">

    <title>show <fieldset></fieldset></title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">

    <!-- Custom styles for this template
    <link href="css/custom.css" rel="stylesheet"> -->

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

<div class="col-md-6" style="width: 1000px; margin-left: 269px;"> 
          <!--  table-striped -->
          <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Size</th>
                <th>Type</th>
                <th>User</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
<?php

include 'core.inc.php';
include 'fileapi.php';

function human_filesize($bytes, $decimals = 2) {
  $sz = 'BKMGTP';
  $factor = floor((strlen($bytes) - 1) / 3);
  return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
}

$directory = 'uploads';

if ($handle = opendir($directory.'/')) {
  $count = 1;
  while($file = readdir($handle)) {

    if($file != '.' && $file != '..') {
      
      echo "
              <tr>
                <td>".$count."</td>
                <td>".$file."</td>
                <td>".human_filesize(filesize($directory.'/'.$file))."</td>
                <td>".mybox_get_filetype_by_filename($file)."</td>
                <td><input type=\"submit\" value=\"Download\" onclick=\"window.location='".$directory.'/'.$file."';\" /> </td>
                <td>by ".mybox_get_username_by_filename($file)."</td>
              </tr>
              </tr>
            
        ";
        $count = $count + 1;
    }
    
  }
}
?>
          </tbody>
          </table>
        </div>
</body>
</html>