<?php

include_once("functions.inc.php");

if(!isset($_SESSION['admin'])) header('Location: login.php');

if(isset($_POST['sent'])) {
	$a = $_POST['name'];
	$b = $_POST['desc'];
	$c = $_POST['link'];
	$d = $_POST['piclink'];

	$link = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_BASE);
	$a = mysqli_real_escape_string($link, $a);
	$b = mysqli_real_escape_string($link, $b);
	$c = mysqli_real_escape_string($link, $c);
	$d = mysqli_real_escape_string($link, $d);

	if(!empty($d)) $c = $d;

	mysqli_query($link, "INSERT INTO famous (`name`,`desc`,`videolink`) VALUES ('$a','$b','$c')");
}

?>

<head>
	<title>Celebryci - adminpanel</title>
	<meta name="robots" content="nofollow, noindex">
</head>
<body style="text-align: center; font-size:1.1em; width: 80%; margin: 0 auto; margin-top: 10px">
	<h2>Lista celebrytów</h2>
	<hr/>
	<table style="width: 100%; display: block; margin: 0 auto; border: 1px solid; text-align: center">
		<tr style="background-color: lightgray; font-weight: bold"><td>Imię i nazwisko</td><td>Link</td><td>Usuń</td></tr>
		<?php

		$link = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_BASE);
		$celebryci = mysqli_query($link, "SELECT * from famous");
		while($celebryta = mysqli_fetch_array($celebryci, MYSQLI_ASSOC)) {
			$id = $celebryta['idfamous'];
			$name = htmlspecialchars($celebryta['name']);
			$link = htmlspecialchars($celebryta['videolink']);
			echo "<tr><td>$name</td><td>$link</td><td><input type=button value=\"Usuń!\" onclick=\"document.location.href = 'famous.php?remove=$id';\" /></td>";
		}
		?>
	</table>
	<br/>
	<hr/>
	<h3>Dodaj celebrytę</h3>
	<form action=famous.php method=post>
		Imię i nazwisko *: <input placeholder="dr Jan Kowalski" name=name maxlength=60 required /><br/><br/>
		Opis osoby *: <textarea placeholder="Adiunkt na Wydziale Prawa i Administracji Uniwersytetu w ..." name=desc required></textarea><br/>
		Link do filmiku: <input name=link length=90><br/>
		Link do zdjęcia (<a target="_blank" href="uploader.php">uploader</a>): <input name=piclink placeholder='pic/u_xxxxxx.jpg' length=90><br/>
		<input type=submit name=sent value="Dodaj nowego celebrytę!">
	</form>
	<hr/>
	<a href=index.php>Strona główna</a><br/>
	<br/>
	<hr/>
	<img src="../img/watchdog.png" alt="Logo Watchdog" /><br/><br/>
</body>
