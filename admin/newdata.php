<?php

include_once("functions.inc");

if(!isset($_SESSION['admin'])) header('Location: login.php');

if(isset($_POST['sent']) && csrf_validate($_POST['csrf'])) {

	$newname = $_POST['name'];

	$link = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_BASE);
		
	$newname = mysqli_real_escape_string($link, $newname);

	mysqli_query($link, "UPDATE users SET name = '$newname' WHERE idusers = {$_SESSION['admin_id']}");
	header("location: login.php");
}

?>

<head>
<title>Zmiana danych - adminpanel</title>
<meta name="robots" content="nofollow, noindex">
</head>
<body style="text-align: center; font-size:1.1em; width: 80%; margin: 0 auto; margin-top: 10px">
<h2>Zmiana danych</h2>
<hr/>
<br/>
Uzupełnij poniższy formularz, aby zmienić swoje dane!<br/>
Po wysłaniu formularza, zostaniesz wylogowany(a).<br/><br/>
<form action=newdata.php method=post>
<input type=hidden name=csrf value="<?php echo $_SESSION['csrf']; ?>"/>
Nowe imię i nazwisko (nazwa): <input type=text required name=name /><br/><br/>
<input type=submit name=sent value="Dokonaj zmiany!" />
</form>
<br/>
<a href="index.php">Anuluj zmianę</a>
<br/>
<hr/>
<img src="../img/watchdog.png" alt="Logo Watchdog" /><br/><br/>
</body>
