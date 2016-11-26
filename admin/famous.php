<?php

include_once("functions.inc.php");

if(!isset($_SESSION['admin'])) header('Location: login.php');

if(isset($_GET['remove'])) {
	$id = $_GET['remove'];
	$link = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_BASE);
	$user = mysqli_query($link, "SELECT * FROM famous WHERE idfamous = ".mysqli_real_escape_string($link, $id));
	if($user->num_rows == 0) $errormsg = "Sława o zadanym ID nie istnieje. Nie można usunąć.";
	else {
		mysqli_query($link, "DELETE FROM famous WHERE idfamous = ".mysqli_real_escape_string($link, $id));
		$errormsg = "Sława #".htmlspecialchars($id)." została pomyślnie usunięta!";
	}
}

if(isset($_POST['sent'])) {
	$a = $_POST['name'];
	$b = $_POST['desc'];
	$c = $_POST['link'];
	$d = $_POST['piclink'];
	$e = $_POST['www'];

	$link = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_BASE);
	$a = mysqli_real_escape_string($link, $a);
	$b = mysqli_real_escape_string($link, $b);
	$c = mysqli_real_escape_string($link, $c);
	$d = mysqli_real_escape_string($link, $d);
	$e = mysqli_real_escape_string($link, $e);

	if(!empty($d)) $c = $d;

	mysqli_query($link, "INSERT INTO famous (`name`,`desc`,`videolink`,`www`) VALUES ('$a','$b','$c', '$e')");

}

?>

<head>
	<title>Celebryci - adminpanel</title>
	<meta name="robots" content="nofollow, noindex">
	<link rel="stylesheet" href="/static/css/style.css">
</head>
<body>
<div class="container">
	<h2>Lista celebrytów</h2>
	<hr/>
	<?php
	if(!empty($errormsg)) {
	?>
	<div class="alert alert-success" role="alert"><?php echo $errormsg; ?></div>
	<?php
	}
	?>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>Imię i nazwisko</th>
				<th>Link</th>
				<th>Akcje</th>
			</tr>
		</thead>
		<tbody>
		<?php

			$link = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_BASE);
			$celebryci = mysqli_query($link, "SELECT * from famous");
			while($celebryta = mysqli_fetch_array($celebryci, MYSQLI_ASSOC)) {
				$id = $celebryta['idfamous'];
				$name = htmlspecialchars($celebryta['name']);
				$link = htmlspecialchars($celebryta['videolink']);
				?>
				<tr data-id="$id">
					<td><?php echo $name; ?></td>
					<td><?php echo $link; ?></td>
					<td><button class="btn btn-danger" onclick="document.location.href = 'famous.php?remove=<?php echo $id; ?>';">Usuń</button></td>
				<?php
			}
			?>
	</tbody>
	</table>
	<hr/>
	<h3>Dodaj celebrytę</h3>
	<form action="famous.php" method="post" id="add_famous">
		<div class="form-horizontal">
			<div class="form-group">
				<label for="field_name" class="col-sm-4 control-label">Imię i nazwisko <abbr title="Pola oznaczone gwiazdką (*) są wymagane">*</abbr>:</label>
				<div class="col-sm-8">
					<input placeholder="dr Jan Kowalski" name="name" maxlength="60" class="form-control" required id="field_name"/>
				</div>
			</div>
			<div class="form-group">
				<label for="field_desc" class="col-sm-4 control-label">Opis osoby <abbr title="Pola oznaczone gwiazdką (*) są wymagane">*</abbr>:</label>
				<div class="col-sm-8">
					<textarea placeholder="Adiunkt na Wydziale Prawa i Administracji Uniwersytetu w ..." name="desc" required class="form-control" id="field_desc"></textarea>
				</div>
			</div>
			<div class="form-group">
				<label for="field_4" class="col-sm-4 control-label">Link do filmiku:</label>
				<div class="col-sm-8">
					<input name="link" length="90" class="form-control" id="field_link">
				</div>
			</div>
			<div class="form-group">
				<label for="field_www" class="col-sm-4 control-label">WWW:</label>
				<div class="col-sm-8">
					<input name="link" length="90" class="form-control" id="field_www">
				</div>
			</div>
			<div class="form-group">
				<label for="field_4" class="col-sm-4 control-label">Link do zdjęcia:</label>
				<div class="col-sm-8">
					<input name="piclink" placeholder='pic/u_xxxxxx.jpg' length="90" class="form-control" id="field_piclink">
				<p class="help-block">Zdjęcie możesz wysłać poprzez <a target="_blank" href="uploader.php">uploader</a>.</p>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-8">
					<button type="submit" name="sent" class="btn btn-default">Dodaj nowego celebrytę!</button>
				</div>
			</div>
		</div>
	</form>
	<hr/>
	<a href="index.php">Strona główna</a><br/>
	<br/>
	<hr/>
	<img src="/static/images/watchdog.png" alt="Logo Watchdog" />
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.2.0.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</div>
</body>
