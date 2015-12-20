<?php

include_once("functions.inc.php");

if(!isset($_SESSION['admin'])) header('Location: login.php');

$errors[] = "";unset($errors[0]);

if(isset($_GET['remove'])) {
  $filename = explode("/",$_GET['remove']);
  $filename = $filename[count($filename)-1];
  if(file_exists("../pic/".$filename)) {
    unlink("../pic/".$filename);
  }
  else $errors[] = "Nie ma takiego pliku!";
}

if(isset($_POST['sentit'])) {
  $foto = $_FILES['newfile'];
  if(is_uploaded_file($foto['tmp_name']) && $foto['size'] <= (1024*1024*1024*2)) {
    $x = explode(".",$foto["name"]);
    $ext = $x[sizeof($x)-1];
    if($ext == "jpg" || $ext == "png" || $ext == "bmp" || $ext == "gif" || $ext == "jpeg") {
      $nam = "u_".generateRandomString(16);
      move_uploaded_file($foto["tmp_name"], $_SERVER['DOCUMENT_ROOT']."/pic/$nam.$ext");
      $errors[] = "Plik został dodany!";
    }
    else $errors[] = "Plik ma nieprawidłowe rozszerzenie!";
  }
  else $errors[] = "Wystąpił problem z wysyłaniem zdjęcia!";
}

?>

<head>
<title>Uploader - adminpanel</title>
<meta name="robots" content="nofollow, noindex">
</head>
<body style="text-align: center; font-size:1.1em; width: 80%; margin: 0 auto; margin-top: 10px">
<h2>Lista wysłanych zdjęć</h2>
<hr/>
<?php
foreach($errors as $error) {
  echo "<span style='color:red'>$error</span><br/>";
}
?>
<table style="width: 100%; display: block; margin: 0 auto; border: 1px solid; text-align: center">
<tr style="background-color: lightgray; font-weight: bold"><td>Nazwa pliku</td><td>Zdjęcie</td><td>Usuń</td></tr>
<?php

$files = scandir("../pic");
foreach($files as $file) {
  if(substr($file,0,2) === "u_") {
      echo "<tr><td>".htmlspecialchars($file)."</td><td><img style='max-height: 200px' src='../pic/".htmlspecialchars($file)."' alt='photo'></td><td><a href='uploader.php?remove=".htmlspecialchars($file)."'>Usuń</a></td></tr>";
  }
}

?>
</table>
<br/>
<hr/>
<h3>Prześlij nowy plik</h3>
<form action=uploader.php method=post enctype="multipart/form-data">
Plik: <input type=file name=newfile required><br/>
<input type=submit name=sentit required value="Wyślij to zdjęcie! (max 2MB)">
</form>
<hr/>
<a href=index.php>Strona główna</a><br/>
<br/>
<hr/>
<img src="../img/watchdog.png" alt="Logo Watchdog" /><br/><br/>
</body>
