<?php 

require('core.inc.php');
require('connect.inc.php');
require('userapi.php');

$check_password_match = false;
$check_all_fields = false;
$check_length_input = false;
$check_userAlready_exisits = false;
$check_phoneAlready_exisits = false;
$check_phone_number = false;

if(!loggedin()) {
		if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['phone']) && isset($_POST['cpassword'])) {

			$username  = $_POST['username'];
			$phone 	   = $_POST['phone'];
			$password  = $_POST['password'];
			$cpassword = $_POST['cpassword'];
			
			if(!empty($username) && !empty($password) && !empty($phone) && !empty($cpassword)) {

				if(strlen($username) > 30 ) {

					$check_length_input = true;
				} else {
						if($password != $cpassword) {

							$check_password_match = true;
						} else {

							$open_code = '05';
							$sublied_phone_number = substr($phone, 0, 2);

							if((strlen($phone) != 10) || ($open_code != $sublied_phone_number)) {

								$check_phone_number = true;
							} else {
								
								$check_exisits_username = mybox_users_get_by_username($username);
								$check_exisits_phone    = mybox_users_get_by_phone($phone);

								if($check_exisits_username == NULL) {

									if($check_exisits_phone == NULL) {

										mybox_users_add($username, $password, $phone);
										header("Location: index.php");
									} else {
										$check_phoneAlready_exisits = true;
									}

								} else {
									$check_userAlready_exisits = true;
								}
							}
						}
				}
			} else {
					$check_all_fields = true;
		}
	}
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Registration form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" />

    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">

<div class="page-header">
    <h1>Registration form <small>Enter your information to gain befit from this site.</small></h1>
</div>

<!-- Registration form - START -->
<div class="container">
    <div class="row">
        <form role="form" method="POST" action="register.php">
            <div class="col-lg-6">
                <div class="well well-sm"><strong><span class="glyphicon glyphicon-asterisk"></span>Required Field</strong></div>
                <div class="form-group">
                    <label for="InputName">Enter Username</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="username" id="InputName" value="<?php if(isset($username)) {echo $username;} ?>" placeholder="Username" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="InputEmail">Enter Phone number</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="phone" value="<?php if(isset($phone)) {echo $phone;} ?>" placeholder="05XXXXXXXX" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="InputEmail">Enter Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="InputEmail">Confirm Password</label>
                    <div class="input-group">
                        <input type="password" class="form-control" name="cpassword" placeholder="Confirm Password" required>
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-info pull-right">
            </div>
        </form>
        <div class="col-lg-5 col-md-push-1">
            <div class="col-md-12">
                <div class="alert alert-danger">
                <?php
                	if($check_all_fields)
                		echo "<span class=\"glyphicon glyphicon-remove\"></span><strong> Error! Please check all page inputs.</strong>";

                	if($check_userAlready_exisits)
                		echo "<span class=\"glyphicon glyphicon-remove\"></span><strong> Error! Username already exists.</strong>";

                	if($check_phoneAlready_exisits)
                		echo "<span class=\"glyphicon glyphicon-remove\"></span><strong> Error! Phone number already exists.</strong>";

                	if($check_password_match)
                		echo "<span class=\"glyphicon glyphicon-remove\"></span><strong> Error! Password mismatch.</strong>";

                	if($check_length_input)
                		echo "<span class=\"glyphicon glyphicon-remove\"></span><strong> Error! Please check input length.</strong>";

                	if($check_phone_number)
                		echo "<span class=\"glyphicon glyphicon-remove\"></span><strong> Error! Wrong phone number.</strong>"
                ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Registration form - END -->

</div>

</body>
</html>