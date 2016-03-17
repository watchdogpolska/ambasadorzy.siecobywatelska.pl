<?php

include_once("functions.inc.php");

if(!isset($_SESSION['admin'])) header('Location: login.php');

if(isset($_GET['uid']) && isset($_GET['a']) && isset($_GET['photoid'])) {


	$link = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_BASE);

	$u = mysqli_real_escape_string($link,$_GET['uid']);
	$a = mysqli_real_escape_string($link,$_GET['a']);
	$photoid = $_GET['photoid'];

	$test = mysqli_query($link, "SELECT * FROM ambassadors WHERE zaakceptowany = 0 AND odrzucony = 0 AND idambassadors = $u LIMIT 1");
	if($test->num_rows != 0) {
		if($a == "true") {
			mysqli_query($link, "UPDATE ambassadors SET zaakceptowany = 1 WHERE idambassadors = $u");
			if(!empty($photoid)) rename("../tmp/$photoid","../pic/$photoid");
		}
		else {
			mysqli_query($link, "UPDATE ambassadors SET odrzucony = 1 WHERE idambassadors = $u");
			if(!empty($photoid)) unlink("../tmp/$photoid");
		}

	}
	header('location: waiting.php');
}

?>
