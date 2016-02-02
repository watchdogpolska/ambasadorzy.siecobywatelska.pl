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
	<link rel="stylesheet" href="/static/css/style.css">
</head>
<body>
<div class="container">
	<h2>Lista celebrytów</h2>
	<hr/>
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
					<td><button class="btn btn-danger js-remove-row">Usuń</button></td>
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
	<script type="text/javascript">
	(function($) {
		$('.js-remove-row').click(function(){
			var $row = $(this).closest('tr');
			var id = $row.attr('data-id');
			$.post('/admin/famous.php', {id: id}, function(data, textStatus, xhr) {
				$row.remove()
			});
			alert("Not implemented :-/")
		})
	} (jQuery));
	</script>
</div>
</body>
