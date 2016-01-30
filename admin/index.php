<?php

include_once("functions.inc.php");

if(!isset($_SESSION['admin'])) header('Location: login.php');

?>

<head>
	<title>Home - adminpanel</title>
	<meta name="robots" content="nofollow, noindex">
	<link rel="stylesheet" href="/static/css/style.css">
</head>
<body>
	<div class="container">
		<h2>Witaj, <?php echo $_SESSION['admin_name']; ?>!</h2>
		<hr/>
		<?php

		$link = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_BASE);
		$ambasadorzy = mysqli_query($link, "SELECT * from ambassadors WHERE zaakceptowany = 1");
		$ambasadorzy_new = mysqli_query($link, "SELECT * from ambassadors WHERE odrzucony = 0 AND zaakceptowany = 0");

		if(isset($_GET['action']) && $_GET['action'] == "created"){
		?>
			<div class="alert alert-success" role="alert">Użytkownik został utworzony!</div>
		<?php
		}
		?>
		Aktualna liczba ambasadorów: <?php echo $ambasadorzy->num_rows; ?>
		<i><a href="lista.php">(lista i dane)</a></i><br/>
		<?php
		if($ambasadorzy_new->num_rows > 0) {
			?>
			<br/><b>Oczekujących na weryfikację:</b> ".$ambasadorzy_new->num_rows."<br/><i><a href=waiting.php>(lista i dane)</a></i>
		<?php
		}
		?>
		<hr/><br/>

		<a href="famous.php">Zarządzaj celebrytami</a><br/>
		<a href="orgs.php">Zarządzaj organizacjami</a><br/>
		<a href="uploader.php">Uploader zdjęć</a><br/>
		<hr/>
		<br/>
		<a href="login.php" class="btn btn-default">Wyloguj się</a><br/>
		<a href="new.php" class="btn btn-default">Nowy użytkownik</a><br/>
		<a href="users.php" class="btn btn-default">Lista użytkowników</a><br/>
		<a href="newpass.php" class="btn btn-default">Zmień hasło</a><br/>
		<a href="newdata.php" class="btn btn-default">Zmień dane osobowe</a><br/>

		<br/>
		<hr/>
		<img src="../img/watchdog.png" alt="Logo Watchdog" /><br/><br/>
	</div>
</body>
