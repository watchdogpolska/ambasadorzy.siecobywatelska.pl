<?php

include_once("functions.inc.php");

if(!isset($_SESSION['admin'])) header('Location: login.php');

?>

<head>
<title>Home - adminpanel</title>
<meta name="robots" content="nofollow, noindex">
</head>
<body style="text-align: center; font-size:1.1em; width: 80%; margin: 0 auto; margin-top: 10px">
<h2>Witaj, <?php echo $_SESSION['admin_name']; ?>!</h2>
<hr/>
<?php

$link = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_BASE);
$ambasadorzy = mysqli_query($link, "SELECT * from ambassadors WHERE zaakceptowany = 1");
$ambasadorzy_new = mysqli_query($link, "SELECT * from ambassadors WHERE odrzucony = 0 AND zaakceptowany = 0");

if(isset($_GET['action'])) if($_GET['action'] == "created") echo "<span style='color: green'>Użytkownik został utworzony!</span><br/>";
echo "Aktualna liczba ambasadorów: ".$ambasadorzy->num_rows;
echo "<br/><i><a href=lista.php>(lista i dane)</a></i><br/>";

if($ambasadorzy_new->num_rows > 0) echo "<br/><b>Oczekujących na weryfikację:</b> ".$ambasadorzy_new->num_rows."<br/><i><a href=waiting.php>(lista i dane)</a></i>";
echo "<hr/><br/>";

echo "

<a href=login.php>Wyloguj się</a><br/>
<a href=new.php>Nowy użytkownik</a><br/>
<a href=users.php>Lista użytkowników</a><br/>
<a href=newpass.php>Zmień hasło</a><br/>
<a href=newdata.php>Zmień dane osobowe</a><br/>

<br/>
<hr/>
<img src=\"../img/watchdog.png\" alt=\"Logo Watchdog\" /><br/><br/>
";


?>

</body>
