<<!DOCTYPE html>
<html>
<head>
	<title>Chatting</title>
</head>
<body>

<div calss="container">
 <div class="row">
 	<textarea style{ margin: 0px; width: 680px; height: 724px;}>

 	<?php
		if(isset($_POST['space']) && !empty($_POST['space'])) {
			echo $_POST['space'] ;
		}
 	?>
 	</textarea>
 </div>
</div>

</body>
<footer>
	<form action="chat.php" method="post">
		<input type="text" name="space">
		<input type="submit" value="SEND">
	</form>
</footer>
</html>
