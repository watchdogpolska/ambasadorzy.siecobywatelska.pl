<?php

include_once("functions.inc.php");

if(!isset($_SESSION['admin'])) header('Location: login.php');

?>

<head>
	<title>Ambasadorzy - adminpanel</title>
	<meta name="robots" content="nofollow, noindex">
	<link rel="stylesheet" href="/static/css/style.css">
</head>
<body>
	<div class="container">
		<h2>Lista Ambasadorów</h2>
		<hr/>
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Imię</th>
					<th>Nazwisko</th>
					<th>Miasto</th>
					<th>Telefon</th>
					<th>Mail</th>
					<th>Dlaczego?</th>
					<th>Zawód</th>
					<th>Adres</th>
					<th>Zdjęcie</th>
				</tr>
			</thead>

			<tbody>
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
					?>
					<tr>
						<td><?php echo $imie; ?></td>
						<td><?php echo $nazwisko; ?></td>
						<td><?php echo $miasto; ?></td>
						<td><?php echo $telefon; ?></td>
						<td><?php echo $email; ?></td>
						<td><?php echo $dlaczego; ?></td>
						<td><?php echo $zawod; ?></td>
						<td><?php echo $adres; ?></td>
						<td><img style='max-width: 200px; max-height: 300px' src='../pic/<?php echo $foto; ?>' alt=''></td>
					</tr>
					<?php
				}
				?>
			</tbody>
		</table>
		<br/>
		<a href=index.php>Strona główna</a><br/>
		<br/>
		<hr/>
		<img src="/static/images/watchdog.png" alt="Logo Watchdog" /><br/><br/>
	</div>
</body>
