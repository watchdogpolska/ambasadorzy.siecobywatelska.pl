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
<div class="row">
	<div class="col-xs-12 col-md-6">
		<div id="descriptionBlock" class="block grayBlock">
			<div class="blockContent">
				<h2>Dlaczego warto?</h2>
					<p>
						Prawo dostępu do&nbsp;informacji i&nbsp;transparentność, to niezaprzeczalne fundamenty zdrowej
						demokracji oraz praw człowieka i&nbsp;dlatego wciąż wymagają
						naszej ochrony i&nbsp;promocji.
					</p>
					<p>
						Dołącz do&nbsp;programu Ambasadorów/Ambasadorek Jawności, jeśli chcesz wesprzeć naszą ideę państwa
						otwartego, przyjaznego i&nbsp;po prostu lepszego. Pomóżmy dowiedzieć się innym jakie mają prawa i&nbsp;
						jak mogą z&nbsp;nich korzystać. Stwórzmy grupę osób z&nbsp;różnych środowisk, która
						będzie zmieniać państwo na wszystkich poziomach.
					</p>
					<p>
						Bycie Ambasadorem/Ambasadorką Jawności wiąże się również z&nbsp;indywidulanymi korzyściami m.in.
						możliwością uczestniczenia w&nbsp;wydarzeniach organizowanych  przez Sieć Obywatelską Watchdog
						Polska takich jak szkolenia, dyskusje oraz coroczny ,,Toast za jawność’’. Zapraszamy!
					</p>
					<p>
						Jeśli nie możesz  dołączyć  do&nbsp;grona Ambasadorów/Ambasadorek, dowiedz się, jak <a href="http://siecobywatelska.pl/wlacz-sie-5min/">inaczej wspierać
						jawność.</a>
					</p>
					<p>
						<img src="/static/images/spinka.jpg" style="display: block; margin: 0 auto; max-width: 100%; max-height: 300px" alt="Jawnościowa spinka" title="Jawnościowa spinka" />
					</p>
			</div>
		</div>
		<div id="descriptionBlock" class="block">
			<div class="blockContent" style="margin: 0 auto">
				<img src="/static/images/superbohater.svg" style="display: block; margin: 0 auto; max-width: 100%; max-height: 400px" alt="Jawność sprzyja!" title="Jawność sprzyja!" />
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-md-6">
		<div id="descriptionBlock" class="block grayBlock">
			<div class="blockContent">
				<h2>Jak zostać Ambasadorem / Ambasadorką Jawności?</h2>
				<p>
					Przygotowaliśmy propozycje, które pozwolą Ci wspierać jawność każdego dnia. Realizacja niektórych
					zajmie najwyżej kilka sekund, inne pozwalają wykazać się w&nbsp;szerszym zakresie. Mamy nadzieję, że w&nbsp;
					przedstawionym poniżej katalogu działań znajdziesz takie, które Cię zainteresują.
					A może masz swoje propozycje? Zarejestruj się i&nbsp;przedstaw je nam. Ambasadorstwo można
					realizować na wiele różnych sposobów!
				</p>
				<div class="freature">
					<div class="freature-image"><img src="/static/images/icons/contract.svg" alt="" width="" height=""></div>
					<div class="freature-content">
						<h3>Zostaw nam informacje o&nbsp;sobie</h3>
						<p>Zapoznaj się z&nbsp;regulaminem i&nbsp;podpisz Kodeks Ambasadora/Ambasadorki.
							Pamiętaj, że w&nbsp;ten sposób deklarujesz, iż bliskie Ci są nasze wartości. Informację o&nbsp;możliwości
							dołączenia do&nbsp; Ambasadorów i&nbsp;Ambasadorek udostępnij znajomym.</p>
					</div>
				</div>
				<div class="freature">
					<div class="freature-image"><img src="/static/images/icons/camera.svg" alt="" width="" height=""></div>
					<div class="freature-content">
						<h3>Pochwal się swoim zdjęciem</h3>
						<p>z&nbsp;hasłem promującym jawność (możesz skorzystać
							z naszych gotowych propozycji – <a href="/download.php" title="Do pobrania">w&nbsp;zakładce do&nbsp;pobrania</a>) lub ilustrującym, co robisz dla tej
							sprawy. Wyjaśnij, czym się zajmujemy, dlaczego dołączyłaś/dołączyłeś do&nbsp;tej idei. Wyślij
							nam to zdjęcie, abyśmy mogli zamieścić je na naszej stronie.</p>
					</div>
				</div>
				<div class="freature">
					<div class="freature-image"><img src="/static/images/icons/two.svg" alt="" width="" height=""></div>
					<div class="freature-content">
						<h3>Udostępniaj informacje </h3>
						<p>zamieszczane przez Sieć Obywatelską Watchdog Polska. Obserwuj,
							co się u nas dzieje (np. przez nasz <a href="http://siecobywatelska.pl" target="_blank" title="Sieć Obywatelska Watchdog Polska">portal</a> i&nbsp;<a href="https://www.facebook.com/SiecObywatelskaWatchdogPolska?_rdr=p" target="_blank" title="Nasz FB">profil na Facebooku</a>) i&nbsp;dziel się artykułami, postami,
							ulotkami, wydarzeniami przez media społecznościowe lub tradycyjnie (wydrukuj materiał lub
							o nim opowiedz). <a href="http://siecobywatelska.pl/wp-content/uploads/2015/09/Informacja-Publiczna_ulotka-A4-skladana-do-A5-DRUK.pdf">Możesz zacząć od ulotki o&nbsp;dostępie do&nbsp;informacji publicznej.</a></p>
					</div>
				</div>
				<div class="freature">
					<div class="freature-image"><img src="/static/images/icons/users.svg" alt="" width="" height=""></div>
					<div class="freature-content">
						<h3>Poleć nam kogoś.</h3>
						<p>Znasz osobę, która podziela nasze wartości? Zaproponuj ją na kolejnego
							Ambasadora/Ambasadorkę jawności i&nbsp;opowiedz jej o&nbsp;naszych działaniach. Może znasz firmę
							bądź instytucję, z&nbsp;którą powinniśmy się skontaktować?</p>
					</div>
				</div>
				<div class="freature">
					<div class="freature-image"><img src="/static/images/icons/currency.svg" alt="" width="" height=""></div>
					<div class="freature-content">
						<h3><a href="http://siecobywatelska.pl/wlacz-sie-5min/#wspieraj_siec">Wesprzyj nas finansowo</a></h3>
						<p>Od lat dbamy, by ludzie wiedzieli, co robi władza. Udzielamy 2000 bezpłatnych porad rocznie, pomagamy w sądach, uczymy mieszkańców i mieszkanki gmin, aby sprawdzali lokalne władze. Dzięki Tobie możemy działać skuteczniej. Już dziś przekaż nam darowiznę i razem z nami twórz standardy jawnego życia publicznego!</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="clearfix"></div>
		<div id="descriptionBlock" class="block">
			<div class="blockContent" style="margin: 0 auto">
				<a target="_blank" href="http://watchdogportal.pl"><img src="/static/images/sprzyja.png" style="display: block; margin: 0 auto; max-width: 100%; max-height: 200px" alt="Jawność sprzyja!" title="Jawność sprzyja!" /></a>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div id="signFormBlock" class="block grayBlock">
			<div class="blockContent">
				<h2>Dołącz do wspierających jawność!</h2>
				<p>
					Zostaw nam krótką informację o&nbsp;sobie, zapoznaj się z&nbsp;regulaminem i&nbsp;podpisz Kodeks Ambasadora/Ambasadorki.
					Na naszej stronie widoczne będą jedynie Twoje imię, nazwisko i&nbsp;miejscowość oraz zdjęcie, jeśli
					wyrazisz zgodę na jego opublikowanie.
				</p>
		<h3 class="text-center">Twoje dane</h3>
		<?php if($failed) echo '<div id="reqNote">NIE MOŻNA ZAREJESTROWAĆ. SPRAWDŹ POPRAWNOŚĆ DANYCH.</div><br/>'; ?>
		<form action="index.php" method="post" enctype="multipart/form-data" id="register_form">
			<input type="hidden" name="csrf" value="<?php echo $_SESSION['csrf']; ?>">
			<div class="row">
				<div class="col-xs-12 col-md-6">
					<div class="form-group">
						<label for="register_form_first">Imię <abbr title="Pola oznaczone gwiazdką (*) są wymagane">*</abbr></label>
						<input value="<?php if(isset($_POST['submit'])) echo htmlspecialchars($_POST['first']); ?>" class="form-control" maxlength="45" name="first" type="text" required id="register_form_first"/>
					</div>
				</div>
				<div class="col-xs-12 col-md-6">
					<div class="form-group">
						<label for="register_form_name">Nazwisko <abbr title="Pola oznaczone gwiazdką (*) są wymagane">*</abbr></label>
						<input value="<?php if(isset($_POST['submit'])) echo htmlspecialchars($_POST['name']); ?>" class="form-control" maxlength="45" name="name" type="text" required id="register_form_name"/>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-md-6">
					<div class="form-group">
						<label for="register_form_mail">Email <abbr title="Pola oznaczone gwiazdką (*) są wymagane">*</abbr></label>
						<input value="<?php if(isset($_POST['submit'])) echo htmlspecialchars($_POST['mail']); ?>" class="form-control" maxlength="60" name="mail" type="email" required id="register_form_mail"/>
					</div>
				</div>
				<div class="col-xs-12 col-md-6">
					<div class="form-group">
						<label for="register_form_phone">Telefon <abbr title="Pola oznaczone gwiazdką (*) są wymagane">*</abbr></label>
						<input value="<?php if(isset($_POST['submit'])) echo htmlspecialchars($_POST['phone']); ?>" class="form-control" maxlength="45" name="phone" type="tel" required id="register_form_phone"/>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label for="register_form_city">Miasto <abbr title="Pola oznaczone gwiazdką (*) są wymagane">*</abbr></label>
				<input value="<?php if(isset($_POST['submit'])) echo htmlspecialchars($_POST['city']); ?>" class="form-control" maxlength="45" name="city" type="text" required id="register_form_city"/>
			</div>
			<div class="form-group">
				<label for="register_form_job">Opisz, czym zajmujesz się zawodowo? <abbr title="Pola oznaczone gwiazdką (*) są wymagane">*</abbr></label>
				<textarea value="<?php if(isset($_POST['submit'])) echo htmlspecialchars($_POST['job']); ?>" class="form-control" maxlength="200" name="job" type="text" required id="register_form_job"></textarea>
			</div>
			<div class="form-group">
				<label for="register_form_why">Dlaczego chcesz zostać Ambasadorem Jawności? <abbr title="Pola oznaczone gwiazdką (*) są wymagane">*</abbr></label>
				<textarea value="<?php echo htmlspecialchars($_POST['why']); ?>" class="textinput textInput form-control" maxlength="3000" name="why" type="text" required id="register_form_why"></textarea>
			</div>
			<div class="form-group">
				<label for="register_form_address">Adres korespondencyjny</label>
				<input value="<?php if(isset($_POST['submit'])) echo htmlspecialchars($_POST['address']); ?>" class="form-control" placeholder="ul. Ulica 1/1, 00-001 Miejscowość" maxlength="200" name="address" type="text" id="register_form_address"/>
			</div>
			<div class="form-group">
				<label for="register_form_photo">Twoje zdjęcie - max 1 MB <abbr title="Poprzez przesłanie zdjęcia wyrażasz zgodę na wykorzystanie wizerunku i&nbsp;przesłanej fotografii przez Sieć Obywatelską Watchdog Polska.">(informacje)</abbr></label>
				<input class="form-control" name="photo" type="file" id="register_form_photo"/>
			</div>
			</ol>
			<p>
				Dziękujemy, że zechciałeś/-aś dołączyć do&nbsp;grona Ambasadorów/Ambasadorek Jawności. Mamy nadzieję, że razem będziemy dążyć do zmiany otaczającej nas rzeczywistości na przejrzystszą, przyjaźniejszą oraz wspólnie ją udoskonalać.
				Realizacja tego ważnego i&nbsp;odpowiedzialnego zadania będzie możliwa jedynie wtedy, gdy wartości i&nbsp;idee
				reprezentowane przez Sieć Obywatelską Watchdog Polska będą istotne także dla Ciebie.
				Jeśli się z&nbsp;nimi zgadzasz i&nbsp;zamierzasz się nimi kierować, prosimy o&nbsp;podpisanie Kodeksu
				Ambasadora/Ambasadorki.
			</p>
			<p style="text-align: center"><b>Kodeks Ambasadora/Ambasadorki</b></p>
			<p>Jako Ambasador/Ambasadorka Jawności zobowiązuję się:</p>
			<ol>
				<li>
					Działać na rzecz  jawności w&nbsp;życiu publicznym i&nbsp;szeroko rozumianego dobra wspólnego,
				</li>
				<li>
					Wystrzegać się sytuacji, w&nbsp;których moje działania mogłyby być postrzegane jako nieetyczne
					lub bezprawne,
				</li>
				<li>
					Rzetelnie realizować działania ambasadorskie w&nbsp;oparciu o&nbsp;przygotowane przez Sieć
					Obywatelską Watchdog Polska dyspozycje, a&nbsp;w&nbsp;szczególności - informować otoczenie o&nbsp;prawie dostępu do&nbsp;informacji oraz wadze jawności w&nbsp;sferze publicznej,
				</li>
				<li>
					Oddzielać  działalność ambasadorską od przynoszącej indywidualne korzyści oraz politycznej.
				</li>
				<li>
					Swoim uczciwym, tolerancyjnym i&nbsp;godnym postępowaniem  budować pozytywny wizerunek
					Ambasadorów i&nbsp;Ambasadorek Jawności.
				</li>
			</ol>
			<hr/>
			<div class="checkbox">
				<label for="register_form_datatrue">
					<input type="checkbox" name="kodekstrue" required id="register_form_datatrue"/>Oświadczam, że zapoznałem się ze wszystkimi punktami Kodeksu Ambasadora/Ambasadorki Jawności i zobowiązuję się do jego przestrzegania.<abbr title="Pola oznaczone gwiazdką (*) są wymagane">*</abbr>
				</label>
			</div>
			<div class="checkbox">
				<label for="register_form_datatrue">
					<input type="checkbox" name="datatrue" required id="register_form_datatrue"/>Oświadczam, że zawarte w&nbsp;powyższym formularzu dane są zgodne ze stanem faktycznym. <abbr title="Pola oznaczone gwiazdką (*) są wymagane">*</abbr>
				</label>
			</div>
			<div class="checkbox">
				<label for="register_form_datareg">
					<input type="checkbox" name="datareg" required id="register_form_datareg"/>Oświadczam, że zapoznałem(-am) się z&nbsp;<a href="files/regulamin.pdf" target="_blank">Regulaminem Programu</a> i&nbsp;akceptuję jego postanowienia.<abbr title="Pola oznaczone gwiazdką (*) są wymagane">*</abbr>
				</label>
			</div>
			<div class="checkbox">
				<label for="register_form_data">
					<input type="checkbox" name="data" required id="register_form_data"/>Oświadczam, iż wyrażam zgodę na przetwarzanie moich danych osobowych zgodnie z&nbsp;ustawą o&nbsp;ochronie danych osobowych (z 29 sierpnia 1997 roku) przez Sieć Obywatelską Watchdog Polska, ul. Ursynowska 22/2, 02-605 Warszawa w&nbsp;celach związanych z&nbsp;realizacją programu Ambasadorów i&nbsp;Ambasadorek Jawności oraz na podanie do&nbsp;wiadomości publicznej mojego imienia, nazwiska oraz miejscowości w&nbsp;przypadku zostania Ambasadorem/Ambasadorką Jawności. Jednocześnie potwierdzam, iż zostałem/zostałam poinformowany/a o&nbsp;możliwości sprawdzenia w&nbsp;jaki sposób i&nbsp;w jakim zakresie moje dane są przetwarzane, co zawierają, jak są udostępniane oraz o&nbsp;możliwości usunięcia danych z&nbsp;bazy Sieci Obywatelskiej Watchdog Polska.&nbsp;<abbr title="Pola oznaczone gwiazdką (*) są wymagane">*</abbr>
				</label>
			</div>
			<div class="form-actions"><input type="submit" name="submit" value="Wyślij" style="width: 50%; margin: 0 auto" class="btn btn-primary btn-lg btn-block" id="submit-id-submit"> </div>
		</form>
		<p></p>
		<p>
			<a href="files/kodeks.pdf" target="_blank"><i class="fa fa-file-pdf-o" title="Plik w formacie PDF"></i> Pobierz Kodeks Ambasadora</a><br>
			<a href="files/dyspozycje.pdf" target="_blank"><i class="fa fa-file-pdf-o" title="Plik w formacie PDF"></i> Pobierz przykładowe dyspozycje</a><br>
			<a href="files/regulamin.pdf" target="_blank"><i class="fa fa-file-pdf-o" title="Plik w formacie PDF"></i> Pobierz Regulamin Programu</a>
		</p>
	</div>
</div>
<?php

showFooter();
ob_end_flush();

?>
