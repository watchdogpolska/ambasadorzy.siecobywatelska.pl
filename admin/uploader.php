<?php

include_once("functions.inc.php");

if(!isset($_SESSION['admin'])) header('Location: login.php');

$errors = [];

if(isset($_GET['remove'])) {
	$filename = explode('/',$_GET['remove']);
	$filename = end($filename);
	if(file_exists('../pic/'.$filename)) {
		unlink('../pic/'.$filename);
		$errors[] = ['message' => 'Plik został skasowany!', 'type' => 'success'];
	} else {
		$errors[] = ['message' => 'Nie ma takiego pliku!'];
	}
}

if(isset($_POST['sentit'])) {
	$foto = $_FILES['newfile'];
	if(is_uploaded_file($foto['tmp_name']) && $foto['size'] <= (1024*1024*1024*2)) {
		$x = explode(".", $foto['name']);
		$ext = $x[sizeof($x) - 1];
		if($ext == 'jpg' || $ext == 'png' || $ext == 'bmp' || $ext == 'gif' || $ext == 'jpeg') {
			$nam = 'u_'.generateRandomString(16);
			move_uploaded_file($foto['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/pic/'.$nam.$ext);
			$errors[] = ['message' => 'Plik został dodany!', 'type' => 'success'];
		}
		else $errors[] = ['message' => 'Plik ma nieprawidłowe rozszerzenie!'];
	}
	else $errors[] = ['message' => 'Wystąpił problem z wysyłaniem zdjęcia!'];
}

?>

<head>
	<title>Uploader - adminpanel</title>
	<meta name="robots" content="nofollow, noindex">
	<link rel="stylesheet" href="/static/css/style.css">
</head>
<body>
	<div class="container">
		<h2>Lista wysłanych zdjęć</h2>
		<hr/>
		<?php
		foreach($errors as $error) {
			$type = isset($error['type']) ? $error['type'] : 'error';
			switch ($type) {
				case 'success':
					?>
					<div class="alert alert-success" role="alert"><?php echo $error['message']; ?></div>
					<?php
					break;

				default:
					?>
					<div class="alert alert-danger" role="alert"><?php echo $error['message']; ?></div>
					<?php
					break;
			}
			?>
			<?php
		}
		?>
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Nazwa pliku</th>
					<th>Zdjęcie</th>
					<th>Akcje</th>
				</tr>
			</thead>
			<tbody>
			<?php

				$files = scandir("../pic");
				foreach($files as $file) {
					if(substr($file,0,2) === "u_") {
						$escaped_file = htmlspecialchars($file);
						?>
						<tr>
							<td><?php echo $escaped_file; ?></td>
							<td><img style='max-height: 200px' src='../pic/<?php echo $escaped_file; ?>' alt='photo'></td>
							<td><a href='uploader.php?remove=<?php echo $escaped_file; ?>' class="btn btn-danger">Usuń</a></td>
						</tr>

						<?php
					}
				}

				?>
			</tbody>
		</table>
		<br/>
		<hr/>
		<h3>Prześlij nowy plik</h3>
		<form action="uploader.php" method="post" enctype="multipart/form-data" class="form-horizontal">
			<div class="form-group">
				<label for="field_file" class="col-sm-4 control-label">Plik: </label>
				<div class="col-sm-8">
					<input type="file" name="newfile" required class="control-label" id="field_file">
					<p class="help-block">Maksymalny rozmiar to: 2 MB.</p>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-8 col-sm-offset-4">
					<button type="submit" class="btn btn-primary" name="sentit">Wyślij zdjęcie</button>
				</div>
			</div>
		</form>
		<hr/>
		<a href=index.php>Strona główna</a><br/>
		<br/>
		<hr/>
		<img src="/static/images/watchdog.png" alt="Logo Watchdog" /><br/><br/>
	</div>
</body>
