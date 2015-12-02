<?php
session_start();
if(isset($_SESSION['admin'])) {
	$g = $_GET['url'];
	if($g != "validate.php" && strpos($g, "/") === false) { //security mechanism
		echo file_get_contents($g);	
	}
}

?>
