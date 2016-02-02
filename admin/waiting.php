<?php

include_once("functions.inc.php");

if(!isset($_SESSION['admin'])) header('Location: login.php');

?>

<head>
	<title>Oczekujący - adminpanel</title>
	<meta name="robots" content="nofollow, noindex">
	<style>tr{border:1px solid;}td{border:1px solid;}</style>
	<link rel="stylesheet" href="/static/css/style.css">
</head>
<body>
<div class="container">
	<h2>Lista oczekujących Ambasadorów</h2>
	<hr/>
	<table style="width: 100%; display: block; margin: 0 auto; border: 1px solid; text-align: center">
		<tr style="background-color: lightgray; font-weight: bold"><td>Imię</td><td>Nazwisko</td><td>Miasto</td><td>Telefon</td><td>Mail</td><td>Dlaczego?</td><td>Zawód</td><td>Adres</td><td>Zdjęcie</td><td>Decyzja</td></tr>

		<?php

		$link = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_BASE);
		$waiting = mysqli_query($link, "SELECT * FROM ambassadors WHERE odrzucony = 0 AND zaakceptowany = 0");

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
			echo "<tr><td>$imie</td><td>$nazwisko</td><td>$miasto</td><td>$telefon</td><td>$email</td><td>$dlaczego</td><td>$zawod</td><td>$adres</td><td><img style='max-width: 200px; max-height: 300px' src='../tmp/$foto' alt=''></td><td><a href='decide.php?uid=$id&a=true&photoid=$foto'>Zatwierdź</a>/<a href='decide.php?uid=$id&a=false&photoid=$foto'>Odrzuć</a></td></tr>";

		}

		?>

	</table>
	<br/>
	<a href=index.php>Strona główna</a><br/>
	<br/>
	<hr/>
	<img src="/static/images/watchdog.png" alt="Logo Watchdog" /><br/><br/>
</div>
</body>
