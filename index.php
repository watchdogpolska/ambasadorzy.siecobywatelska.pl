<?php

ob_start();

include_once('functions.inc.php');
include_once('db.inc.php');

$failed = 0;

if(isset($_POST['submit']) && csrf_validate($_POST['csrf'])) {
	
	$link = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_BASE);

	$first = mysqli_real_escape_string($link, $_POST['first']);
	$name = mysqli_real_escape_string($link, $_POST['name']);
	$phone = mysqli_real_escape_string($link, $_POST['phone']);
	$city = mysqli_real_escape_string($link, $_POST['city']);
	$address = mysqli_real_escape_string($link, $_POST['address']);
	$job = mysqli_real_escape_string($link, $_POST['job']);
	$mail = mysqli_real_escape_string($link, $_POST['mail']);
	$why = mysqli_real_escape_string($link, $_POST['why']);
	if(isset($_FILES['photo'])) if(file_exists($_FILES['photo']['tmp_name'])) $foto = $_FILES['photo'];
	
	$nam="";$ext="";
	
	if(empty($_POST['first']) || empty($_POST['datareg']) || empty($_POST['datatrue']) || empty($_POST['name']) || empty($_POST['phone']) || empty($_POST['city']) || empty($_POST['job'])  || empty($_POST['why']) || empty($_POST['mail']) || empty($_POST['data'])) {
		$failed = 1;
	}
	
	else {	
		$q = mysqli_query($link, "SELECT * FROM ambassadors WHERE email = '$mail' LIMIT 1");
		if($q->num_rows != 0) $failed = 1;
		else {
			if(isset($foto)) {
				if(is_uploaded_file($foto["tmp_name"]) && $foto['size'] <= (1024*1024*1024)) {
	 				$x = explode(".",$foto["name"]);
	 				$ext = mysqli_real_escape_string($link, $x[sizeof($x)-1]);
	 				if($ext == "jpg" || $ext == "png" || $ext == "bmp" || $ext == "gif" || $ext == "jpeg") {
	 					$nam = generateRandomString(32);
	 					move_uploaded_file($foto["tmp_name"], $_SERVER['DOCUMENT_ROOT']."/tmp/$nam.$ext");
	 				}
	 				else $failed = 1;
	 			}
	 			else {
	 				$failed = 1;
	 			}
 			}
 				
 			if(!$failed) {
	 			$ip = mysqli_real_escape_string($link,get_client_ip_env());
				$sql = "INSERT INTO ambassadors (imie,nazwisko,email,miasto,telefon,zawod,dlaczego,adres,zdjecie,zaakceptowany,odrzucony,ip) VALUES ('$first','$name','$mail','$city','$phone','$job','$why',";
	 			if(empty($address)) $sql .= "NULL,";
	 			else $sql .= "'$address',";
	 			if(isset($foto)) $sql .= "'".$nam.".".$ext."',";
	 			else $sql .= "NULL,";
	 			$sql .= "0,0,'$ip')";			
	 			
	 			mysqli_query($link, $sql);
	 			
	 			$_SESSION['registered'] = 1;
	 			header('Location: registered.php');
	 			echo "<script>document.location.href = registered.php</script>";
 			}
		}
	}
	
}

showHead("Strona główna", "Zostań Ambasadorem/Ambasadorką Jawności");

?>

<div class="float-left">
<div id="descriptionBlock" class="block grayBlock">
<div class="blockFoldHold"><div class="blockFold"></div><div class="blockFoldClear"></div></div>
<div class="blockContent">
<h2>Dlaczego warto?</h2>
<p>Na przestrzeni ostatnich kilku lat mogliśmy obserwować wiele pozytywnych zmian w&nbsp;dziedzinie
dostępu do&nbsp;informacji publicznej -  wzrosła świadomość praw przysługujących obywatelom, nie 
boimy się pytać urzędników i&nbsp;egzekwować odpowiedzi. Jednak jest wiele obszarów życia publicznego, 
w których panuje kultura tajemnicy. Prawo dostępu do&nbsp;informacji i&nbsp;transparentność, to 
niezaprzeczalne fundamenty zdrowej demokracji oraz praw człowieka i&nbsp;dlatego wciąż wymagają 
naszej ochrony i&nbsp;promocji.</p>
<p>Dołącz do&nbsp;programu Ambasadorów/Ambasadorek Jawności, jeśli chcesz wesprzeć naszą ideę państwa  
otwartego, przyjaznego i&nbsp;po prostu lepszego. Pomóżmy dowiedzieć się innym jakie mają prawa i&nbsp;
jak mogą z&nbsp;nich korzystać. Stwórzmy grupę osób z&nbsp;różnych środowisk, która 
będzie zmieniać państwo na wszystkich poziomach.</p>
<p>Bycie Ambasadorem/Ambasadorką Jawności wiąże się również z&nbsp;indywidulanymi korzyściami m.in. 
możliwością uczestniczenia w&nbsp;wydarzeniach organizowanych  przez Sieć Obywatelską Watchdog 
Polska takich jak szkolenia, dyskusje oraz coroczny ,,Toast za jawność’’. Zapraszamy!
Jeśli nie możesz  dołączyć  do&nbsp;grona Ambasadorów/Ambasadorek, dowiedz się, jak <a href="http://siecobywatelska.pl/wlacz-sie-5min/">inaczej wspierać 
jawność.</a></p>
</div>
</div>
<div class="clearfix"></div>
<div id="descriptionBlock" class="block">
<div class="blockContent" style="margin: 0 auto">
<a target="_blank" href="http://watchdogportal.pl"><img src="img/sprzyja.jpg" style="display: block; margin: 0 auto; max-width: 100%; max-height: 200px" alt="Jawność sprzyja!" title="Jawność sprzyja!" /></a>
</div>
</div>
<div class="clearfix"></div>
<div id="descriptionBlock" class="block grayBlock">
<div class="blockFoldHold"><div class="blockFold"></div><div class="blockFoldClear"></div></div>
<div class="blockContent">
<h2>Jak zostać Ambasadorem / Ambasadorką Jawności?</h2>
<p>Przygotowaliśmy propozycje, które pozwolą Ci wspierać jawność każdego dnia. Realizacja niektórych 
zajmie najwyżej kilka sekund, inne pozwalają wykazać się w&nbsp;szerszym zakresie. Mamy nadzieję, że w&nbsp;
przedstawionym poniżej katalogu działań znajdziesz takie, które Cię zainteresują. 
A może masz swoje propozycje? Zarejestruj się i&nbsp;przedstaw je nam. Ambasadorstwo można 
realizować na wiele różnych sposobów!</p>
<p><b>Na początek</b></p>
<ul>
<li>1. Zostaw nam informacje o&nbsp;sobie, zapoznaj się z&nbsp;regulaminem i&nbsp;podpisz Kodeks Ambasadora/Ambasadorki. 
Pamiętaj, że w&nbsp;ten sposób deklarujesz, iż bliskie Ci są nasze wartości. Informację o&nbsp;możliwości 
dołączenia do&nbsp; Ambasadorów i&nbsp;Ambasadorek udostępnij znajomym.</li>
<li>2. Pochwal się znajomym swoim zdjęciem z&nbsp;hasłem promującym jawność (możesz skorzystać 
z naszych gotowych propozycji – <a href="http://localhost/download.php" title="Do pobrania">w&nbsp;zakładce do&nbsp;pobrania</a>) lub ilustrującym, co robisz dla tej 
sprawy. Wyjaśnij, czym się zajmujemy, dlaczego dołączyłaś/dołączyłeś do&nbsp;tej idei. Wyślij 
nam to zdjęcie, abyśmy mogli zamieścić je na naszej stronie.</li>
<li>3. Udostępniaj informacje zamieszczane przez Sieć Obywatelską Watchdog Polska. Obserwuj, 
co się u nas dzieje (np. przez nasz <a href="http://siecobywatelska.pl" target="_blank" title="Sieć Obywatelska Watchdog Polska">portal</a> i&nbsp;<a href="https://www.facebook.com/SiecObywatelskaWatchdogPolska?_rdr=p" target="_blank" title="Nasz FB">profil na Facebooku</a>) i&nbsp;dziel się artykułami, postami, 
ulotkami, wydarzeniami przez media społecznościowe lub tradycyjnie (wydrukuj materiał lub 
o nim opowiedz). <a href="http://siecobywatelska.pl/wp-content/uploads/2015/09/Informacja-Publiczna_ulotka-A4-skladana-do-A5-DRUK.pdf">Możesz zacząć od ulotki o&nbsp;dostępie do&nbsp;informacji publicznej.</a></li>
<li>4. Poleć nam kogoś. Znasz osobę, która podziela nasze wartości? Zaproponuj ją na kolejnego 
Ambasadora/Ambasadorkę jawności i&nbsp;opowiedz jej o&nbsp;naszych działaniach. Może znasz firmę 
bądź instytucję, z&nbsp;którą powinniśmy się skontaktować?</li>
</ul>
</div>
</div>
</div>
<div id="signFormBlock" class="block redBlock">
<div class="blockFoldHold"><div class="blockFold"></div><div class="blockFoldClear"></div></div>
<div class="blockContent">
<h2>Dołącz do wspierających jawność!</h2>
<p>Zostaw nam krótką informację o&nbsp;sobie, zapoznaj się z&nbsp;regulaminem i&nbsp;podpisz Kodeks Ambasadora/Ambasadorki.
Na naszej stronie widoczne będą jedynie Twoje imię, nazwisko i&nbsp;miejscowość oraz zdjęcie, jeśli 
wyrazisz zgodę na jego opublikowanie.</p> 
<p style="text-align: center"><img src="img/jawnosc.jpg" alt="Ambasador jawności" style="max-width: 100%; max-height: 300px"/></p>
<p>Dziękujemy, że zechciałeś/-aś dołączyć do&nbsp;grona Ambasadorów/Ambasadorek Jawności. Mamy nadzieję, że razem będziemy dążyć do zmiany otaczającej nas rzeczywistości na przejrzystszą, przyjaźniejszą oraz wspólnie ją udoskonalać.
Realizacja tego ważnego i&nbsp;odpowiedzialnego zadania będzie możliwa jedynie wtedy, gdy wartości i&nbsp;idee 
reprezentowane przez Sieć Obywatelską Watchdog Polska będą istotne także dla Ciebie.
Jeśli się z&nbsp;nimi zgadzasz i&nbsp;zamierzasz się nimi kierować, prosimy o&nbsp;podpisanie Kodeksu 
Ambasadora/Ambasadorki.</p>
<p style="text-align: center"><b>Kodeks Ambasadora/Ambasadorki</b><p>
<p>Jako Ambasador/Ambasadorka Jawności zobowiązuję się:<ul>
<li>1. Działać na rzecz  jawności w&nbsp;życiu publicznym i&nbsp;szeroko rozumianego dobra wspólnego,</li>
<li>2. Wystrzegać się sytuacji, w&nbsp;których moje działania mogłyby być postrzegane jako nieetyczne 
lub bezprawne,</li>
<li>3. Rzetelnie realizować działania ambasadorskie w&nbsp;oparciu o&nbsp;przygotowane przez Sieć 
Obywatelską Watchdog Polska dyspozycje, a&nbsp;w&nbsp;szczególności - informować otoczenie o&nbsp;prawie dostępu do&nbsp;informacji oraz wadze jawności w&nbsp;sferze publicznej,</li>
<li>4. Oddzielać  działalność ambasadorską od przynoszącej indywidualne korzyści oraz politycznej.</li>
<li>5.  Swoim uczciwym, tolerancyjnym i&nbsp;godnym postępowaniem  budować pozytywny wizerunek 
Ambasadorów i&nbsp;Ambasadorek Jawności.</li></ul></p>
<p>
Oświadczam, że zapoznałem/łam się ze wszystkimi punktami Kodeksu i&nbsp; zobowiązuję się do&nbsp;jego 
przestrzegania.</p>
<h3 class="text-center">Twoje dane</h3>
<?php if($failed) echo '<div id="reqNote">NIE MOŻNA ZAREJESTROWAĆ. SPRAWDŹ POPRAWNOŚĆ DANYCH.</div><br/>'; ?>
<div id="reqNote">Pola oznaczone gwiazdką (*) są wymagane</div>
<form action="index.php" method="post" enctype="multipart/form-data">
<input type="hidden" name="csrf" value="<?php echo $_SESSION['csrf']; ?>">
Imię *<br/><input value="<?php if(isset($_POST['submit'])) echo htmlspecialchars($_POST['first']); ?>" class="textinput textInput form-control" maxlength="45" name="first" type="text" required /><br/>
Nazwisko *<br/><input value="<?php if(isset($_POST['submit'])) echo htmlspecialchars($_POST['name']); ?>" class="textinput textInput form-control" maxlength="45" name="name" type="text" required /><br/>
Email *<br/><input value="<?php if(isset($_POST['submit'])) echo htmlspecialchars($_POST['mail']); ?>" class="textinput textInput form-control" maxlength="60" name="mail" type="email" required /><br/>
Miasto *<br/><input value="<?php if(isset($_POST['submit'])) echo htmlspecialchars($_POST['city']); ?>" class="textinput textInput form-control" maxlength="45" name="city" type="text" required /><br/>
Telefon *<br/><input value="<?php if(isset($_POST['submit'])) echo htmlspecialchars($_POST['phone']); ?>" class="textinput textInput form-control" maxlength="45" name="phone" type="tel" required /><br/>
Opisz, czym zajmujesz się zawodowo? *<br/><textarea value="<?php if(isset($_POST['submit'])) echo htmlspecialchars($_POST['job']); ?>" class="textinput textInput form-control" maxlength="200" name="job" type="text" required></textarea><br/>
Adres korespondencyjny<br/><input value="<?php if(isset($_POST['submit'])) echo htmlspecialchars($_POST['address']); ?>" class="textinput textInput form-control" placeholder="ul. Ulica 1/1, 00-001 Miejscowość" maxlength="200" name="address" type="text" /><br/>
Dlaczego chcesz zostać Ambasadorem Jawności? *<br/><textarea value="<?php echo htmlspecialchars($_POST['why']); ?>" class="textinput textInput form-control" maxlength="3000" name="why" type="text" required></textarea><br/>
Twoje zdjęcie - max 1 MB <span style="border-bottom: 1px dotted" title="Poprzez przesłanie zdjęcia wyrażasz zgodę na wykorzystanie wizerunku i&nbsp;przesłanej fotografii przez Sieć Obywatelską Watchdog Polska.">(dodatkowe informacje)</span><br/><input class="textinput textInput form-control" name="photo" type="file" /><br/>
<p><input type="checkbox" name="datatrue" required />Oświadczam, że zawarte w&nbsp;powyższym formularzu dane są zgodne ze stanem faktycznym. *</p>
<p><input type="checkbox" name="datareg" required />Oświadczam, że zapoznałem(-am) się z&nbsp;<a href="files/regulamin.pdf" target="_blank">Regulaminem Programu</a> i&nbsp;akceptuję jego postanowienia. *</p>
<p><input type="checkbox" name="data" required />Oświadczam, iż wyrażam zgodę na przetwarzanie moich danych osobowych zgodnie z&nbsp;ustawą o&nbsp;ochronie danych osobowych (z 29 sierpnia 1997 roku) przez Sieć Obywatelską Watchdog Polska, ul. Ursynowska 22/2, 02-605 Warszawa w&nbsp;celach związanych z&nbsp;realizacją programu Ambasadorów i&nbsp;Ambasadorek Jawności oraz na podanie do&nbsp;wiadomości publicznej mojego imienia, nazwiska oraz miejscowości w&nbsp;przypadku zostania Ambasadorem/Ambasadorką Jawności. Jednocześnie potwierdzam, iż zostałem/zostałam poinformowany/a o&nbsp;możliwości sprawdzenia w&nbsp;jaki sposób i&nbsp;w jakim zakresie moje dane są przetwarzane, co zawierają, jak są udostępniane oraz o&nbsp;możliwości usunięcia danych z&nbsp;bazy Sieci Obywatelskiej Watchdog Polska. *</p>
<div class="form-actions"><input type="submit" name="submit" value="Wyślij" class="btn btn-primary btn-lg btn-block" id="submit-id-submit"> </div>
</form>
<p></p>
<p><a href="files/kodeks.pdf" target="_blank">Pobierz Kodeks Ambasadora w&nbsp;formie PDF</a></p>
<p><a href="files/dyspozycje.pdf" target="_blank">Pobierz przykładowe dyspozycje</a></p>
<p><a href="files/regulamin.pdf" target="_blank">Pobierz Regulamin Programu w&nbsp;PDF</a></p>
</div>
</div>

<?php

showFooter();
ob_end_flush();

?>
            


