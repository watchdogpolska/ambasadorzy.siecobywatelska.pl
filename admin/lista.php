<?php

include_once("functions.inc");

if(!isset($_SESSION['admin'])) header('Location: login.php');

?>

<head>
<title>Ambasadorzy - adminpanel</title>
<meta name="robots" content="nofollow, noindex">
<style>tr{border:1px solid;}td{border:1px solid;}</style>
</head>
<body style="text-align: center; font-size:1.1em; width: 80%; margin: 0 auto; margin-top: 10px">
<h2>Lista Ambasadorów</h2>
<hr/>
<table style="width: 100%; display: block; margin: 0 auto; border: 1px solid; text-align: center">
<tr style="background-color: lightgray; font-weight: bold"><td>Imię</td><td>Nazwisko</td><td>Miasto</td><td>Telefon</td><td>Mail</td><td>Dlaczego?</td><td>Zawód</td><td>Adres</td><td>Zdjęcie</td></tr>

<?php

$link = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_BASE);
$waiting = mysqli_query($link, "SELECT * FROM ambassadors WHERE zaakceptowany = 1");

while($ambasador = mysqli_fetch_array($waiting, MYSQLI_ASSOC)) {
	$imie = htmlspecialchars($ambasador['imie']);
	$nazwisko = htmlspecialchars($ambasador['nazwisko']);
	$email = htmlspecialchars($ambasador['email']);
	$miasto = htmlspecialchars($ambasador['miasto']);
	$telefon = htmlspecialchars($ambasador['telefon']);
	$zawod = htmlspecialchars($ambasador['zawod']);
	$dlaczego = htmlspecialchars($ambasador['dlaczego']);
	$adres = htmlspecialchars($ambasador['adres']);
	$id = htmlspecialchars($ambasador['idambassadors']);
	$foto = htmlspecialchars($ambasador['zdjecie']);
	echo "<tr><td>$imie</td><td>$nazwisko</td><td>$miasto</td><td>$telefon</td><td>$email</td><td>$dlaczego</td><td>$zawod</td><td>$adres</td><td><img style='max-width: 200px' src='../pic/$foto' alt=''></td></tr>";
	
}

?>

</table>
<br/>
<a href=index.php>Strona główna</a><br/>
<br/>
<hr/>
<img src="../img/watchdog.png" alt="Logo Watchdog" /><br/><br/>
</body>
