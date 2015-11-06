<?php 

require('core.inc.php');

ob_end_clean();
session_destroy();

header('Location: index.php');


?>