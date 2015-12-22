<?php

include_once("functions.inc.php");

if(!isset($_SESSION['admin'])) header('Location: login.php');

$errormsg = "";

if(isset($_GET['remove'])) {
	$id = $_GET['remove'];
	if($id != $_SESSION['admin_id']) {
		$link = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_BASE);
		$user = mysqli_query($link, "SELECT * FROM users WHERE usuniety = 0 AND idusers = ".mysqli_real_escape_string($link, $id));
		if($user->num_rows == 0) $errormsg = "Użytkownik o zadanym ID nie istnieje. Nie można usunąć.";
		else {
			mysqli_query($link, "UPDATE users SET usuniety = 1 WHERE idusers = ".mysqli_real_escape_string($link, $id));
			$errormsg = "Użytkownik #".htmlspecialchars($id)." został pomyślnie usunięty!";
		}
	}
	else $errormsg = "Nie możesz usunąć swojego konta użytkownika";

}
?>

<head>
	<title>Użytkownicy - adminpanel</title>
	<meta name="robots" content="nofollow, noindex">
	<style>tr{border:1px solid;}td{border:1px solid;}</style>
</head>
<body style="text-align: center; font-size:1.1em; width: 80%; margin: 0 auto; margin-top: 10px">
	<h2>Lista użytkowników</h2><hr/>
	<?php if(!empty($errormsg)) {
		echo "<span style='color: red'>$errormsg</span><br/><br/>";
	} ?>
	<table style="width: 100%; display: block; margin: 0 auto; border: 1px solid; text-align: center">
		<tr style="background-color: lightgray; font-weight: bold"><td>Nick</td><td>Imię i nazwisko</td><td>Usuń</td></tr>
		<?php
		$link = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_BASE);
		$userzy = mysqli_query($link, "SELECT * from users");
		while($user = mysqli_fetch_array($userzy, MYSQLI_ASSOC)) {
			$nick = htmlspecialchars($user['login']);
			$name = htmlspecialchars($user['name']);
			$id = htmlspecialchars($user['idusers']);
			echo "<tr><td>$nick</td><td>$name</td>";
			if($id != $_SESSION['admin_id']) if(!$user['usuniety']) echo "<td><input type=button value=\"Usuń!\" onclick=\"document.location.href = 'users.php?remove=$id';\" /></td>"; else echo "<td>Usunięty</td>";
			else echo "<td></td>";
			echo "</tr>";
		}
		?>
	</table>
	<br/>
	<a href=login.php>Wyloguj się</a><br/>
	<a href=new.php>Nowy użytkownik</a><br/>
	<a href=index.php>Strona główna</a><br/>
	<br/>
	<hr/>
	<img src="../img/watchdog.png" alt="Logo Watchdog" /><br/><br/>
</body>
