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
						Prawo dostępu&nbsp;do informacji&nbsp;i transparentność,&nbsp;to niezaprzeczalne fundamenty zdrowej
						demokracji oraz praw człowieka&nbsp;i dlatego wciąż wymagają
						naszej ochrony&nbsp;i promocji.
					</p>
					<p>
						Dołącz&nbsp;do programu Ambasadorów/Ambasadorek Jawności, jeśli chcesz wesprzeć naszą ideę państwa
						otwartego, przyjaznego&nbsp;i po prostu lepszego. Pomóżmy dowiedzieć&nbsp;się&nbsp;innym jakie mają prawa&nbsp;i
						jak mogą&nbsp;z nich korzystać. Stwórzmy grupę osób&nbsp;z różnych środowisk, która
						będzie zmieniać państwo&nbsp;na wszystkich poziomach.
					</p>
					<p>
						Bycie Ambasadorem/Ambasadorką Jawności wiąże&nbsp;się&nbsp;również&nbsp;z indywidulanymi korzyściami m.in.
						możliwością uczestniczenia&nbsp;w wydarzeniach organizowanych  przez Sieć Obywatelską Watchdog
						Polska takich&nbsp;jak szkolenia, dyskusje oraz coroczny ,,Toast&nbsp;za jawność’’. Zapraszamy!
					</p>
					<p>
						Jeśli&nbsp;nie możesz  dołączyć &nbsp;do grona Ambasadorów/Ambasadorek, dowiedz się,&nbsp;jak <a href="http://siecobywatelska.pl/wlacz-sie-5min/">inaczej wspierać
						jawność.</a>
					</p>
					<p>
						<img src="/static/images/spinka.jpg" style="display: block; margin: 0 auto; max-width: 100%; max-height: 300px" alt="Jawnościowa spinka" title="Jawnościowa spinka" />
					</p>
			</div>
		</div>
		<div id="descriptionBlock" class="block">
			<div class="blockContent" style="padding: 20 50px; color: #FECB14">
				<?php
					$img_path = dirname(__FILE__).'/static/images/superbohater.svg';
					if(file_exists($img_path)){
						echo file_get_contents($img_path);
					}
				?>
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-md-6">
		<div id="descriptionBlock" class="block grayBlock">
			<div class="blockContent">
				<h2>Jak zostać Ambasadorem / Ambasadorką Jawności?</h2>
				<p>
					Przygotowaliśmy propozycje, które pozwolą&nbsp;Ci&nbsp;wspierać jawność każdego dnia. Realizacja niektórych
					zajmie najwyżej kilka sekund, inne pozwalają wykazać&nbsp;się&nbsp;w szerszym zakresie. Mamy nadzieję, że&nbsp;w&nbsp;
					przedstawionym poniżej katalogu działań znajdziesz takie, które&nbsp;Cię&nbsp;zainteresują.
					A&nbsp;może masz swoje propozycje? Zarejestruj&nbsp;się&nbsp;i przedstaw&nbsp;je nam. Ambasadorstwo można
					realizować&nbsp;na wiele różnych sposobów!
				</p>
				<div class="freature">
					<div class="freature-image"><img src="/static/images/icons/contract.svg" alt="" width="" height=""></div>
					<div class="freature-content">
						<h3>Zostaw&nbsp;nam informacje&nbsp;o sobie</h3>
						<p>Zapoznaj&nbsp;się&nbsp;z regulaminem&nbsp;i podpisz Kodeks Ambasadora/Ambasadorki.
							Pamiętaj, że&nbsp;w ten sposób deklarujesz, iż bliskie&nbsp;Ci&nbsp;są nasze wartości. Informację&nbsp;o możliwości
							dołączenia&nbsp;do  Ambasadorów&nbsp;i Ambasadorek udostępnij znajomym.</p>
					</div>
				</div>
				<div class="freature">
					<div class="freature-image"><img src="/static/images/icons/camera.svg" alt="" width="" height=""></div>
					<div class="freature-content">
						<h3>Pochwal&nbsp;się&nbsp;swoim zdjęciem</h3>
						<p>z&nbsp;hasłem promującym jawność (możesz skorzystać
							z&nbsp;naszych gotowych propozycji – <a href="/download.php" title="Do pobrania">w&nbsp;zakładce&nbsp;do pobrania</a>)&nbsp;lub ilustrującym,&nbsp;co robisz&nbsp;dla tej
							sprawy. Wyjaśnij, czym&nbsp;się&nbsp;zajmujemy, dlaczego dołączyłaś/dołączyłeś&nbsp;do tej idei. Wyślij
							nam&nbsp;to zdjęcie, abyśmy mogli zamieścić&nbsp;je na naszej stronie.</p>
					</div>
				</div>
				<div class="freature">
					<div class="freature-image"><img src="/static/images/icons/two.svg" alt="" width="" height=""></div>
					<div class="freature-content">
						<h3>Udostępniaj informacje </h3>
						<p>zamieszczane przez Sieć Obywatelską Watchdog Polska. Obserwuj,
							co się&nbsp;u nas dzieje (np. przez nasz <a href="http://siecobywatelska.pl" target="_blank" title="Sieć Obywatelska Watchdog Polska">portal</a>&nbsp;i <a href="https://www.facebook.com/SiecObywatelskaWatchdogPolska?_rdr=p" target="_blank" title="Nasz FB">profil&nbsp;na Facebooku</a>)&nbsp;i dziel&nbsp;się&nbsp;artykułami, postami,
							ulotkami, wydarzeniami przez media społecznościowe&nbsp;lub tradycyjnie (wydrukuj materiał lub
							o&nbsp;nim opowiedz). <a href="http://siecobywatelska.pl/wp-content/uploads/2015/09/Informacja-Publiczna_ulotka-A4-skladana-do-A5-DRUK.pdf">Możesz zacząć&nbsp;od ulotki&nbsp;o dostępie&nbsp;do informacji publicznej.</a></p>
					</div>
				</div>
				<div class="freature">
					<div class="freature-image"><img src="/static/images/icons/users.svg" alt="" width="" height=""></div>
					<div class="freature-content">
						<h3>Poleć&nbsp;nam kogoś.</h3>
						<p>Znasz osobę, która podziela nasze wartości? Zaproponuj ją&nbsp;na kolejnego
							Ambasadora/Ambasadorkę jawności&nbsp;i opowiedz&nbsp;jej o&nbsp;naszych działaniach. Może znasz firmę
							bądź instytucję,&nbsp;z którą powinniśmy&nbsp;się&nbsp;skontaktować?</p>
					</div>
				</div>
				<div class="freature">
					<div class="freature-image"><img src="/static/images/icons/currency.svg" alt="" width="" height=""></div>
					<div class="freature-content">
						<h3><a href="http://siecobywatelska.pl/wlacz-sie-5min/#wspieraj_siec">Wesprzyj&nbsp;nas finansowo</a></h3>
						<p>To dzięki Twojemu wsparciu możemy działać. Jesteśmy niezależni, apolityczni, nie korzystamy z pieniędzy rozdzielanych przez administrację publiczną. Już dziś przekaż nam darowiznę lub ustaw w swoim banku stałe zlecenie. Każda kwota jest dla nas ważna! Nr konta 29 2130 0004 2001 0343 2101 0001 (Volkswagen Bank Direct). Dowiedz się więcej, klikając <a href="http://siecobywatelska.pl/wlacz-sie-5min/#wspieraj_siec">w link.</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div id="signFormBlock" class="block grayBlock">
			<div class="blockContent">
				<h2>Dołącz&nbsp;do wspierających jawność!</h2>
				<p>
					Zostaw&nbsp;nam krótką informację&nbsp;o sobie, zapoznaj&nbsp;się&nbsp;z regulaminem&nbsp;i podpisz Kodeks Ambasadora/Ambasadorki.
					Na naszej stronie widoczne będą jedynie Twoje imię, nazwisko&nbsp;i miejscowość oraz zdjęcie, jeśli
					wyrazisz zgodę&nbsp;na jego opublikowanie.
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
				<label for="register_form_job">Opisz, czym zajmujesz&nbsp;się&nbsp;zawodowo? <abbr title="Pola oznaczone gwiazdką (*) są wymagane">*</abbr></label>
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
				<label for="register_form_photo">Twoje zdjęcie -&nbsp;max 1&nbsp;MB&nbsp;<abbr title="Poprzez przesłanie zdjęcia wyrażasz zgodę&nbsp;na wykorzystanie wizerunku&nbsp;i przesłanej fotografii przez Sieć Obywatelską Watchdog Polska.">(informacje)</abbr></label>
				<input class="form-control" name="photo" type="file" id="register_form_photo"/>
			</div>
			</ol>
			<p>
				Dziękujemy, że zechciałeś/-aś dołączyć&nbsp;do grona Ambasadorów/Ambasadorek Jawności. Mamy nadzieję, że razem będziemy dążyć&nbsp;do zmiany otaczającej&nbsp;nas rzeczywistości&nbsp;na przejrzystszą, przyjaźniejszą oraz wspólnie ją udoskonalać.
				Realizacja tego ważnego&nbsp;i odpowiedzialnego zadania będzie możliwa jedynie wtedy,&nbsp;gdy wartości&nbsp;i idee
				reprezentowane przez Sieć Obywatelską Watchdog Polska będą istotne także&nbsp;dla Ciebie.
				Jeśli&nbsp;się&nbsp;z nimi zgadzasz&nbsp;i zamierzasz&nbsp;się&nbsp;nimi kierować, prosimy&nbsp;o podpisanie Kodeksu
				Ambasadora/Ambasadorki.
			</p>
			<div style="color: black">
			<h3 style="text-align: center">Kodeks Ambasadora/Ambasadorki</h3>
			<p>Jako Ambasador/Ambasadorka Jawności zobowiązuję się:</p>
			<ol>
				<li>
					Działać&nbsp;na rzecz  jawności&nbsp;w życiu publicznym&nbsp;i szeroko rozumianego dobra wspólnego,
				</li>
				<li>
					Wystrzegać&nbsp;się&nbsp;sytuacji,&nbsp;w których moje działania mogłyby być postrzegane jako nieetyczne
					lub bezprawne,
				</li>
				<li>
					Rzetelnie realizować działania ambasadorskie&nbsp;w oparciu&nbsp;o przygotowane przez Sieć
					Obywatelską Watchdog Polska dyspozycje, a&nbsp;w szczególności - informować otoczenie&nbsp;o prawie dostępu&nbsp;do informacji oraz wadze jawności&nbsp;w sferze publicznej,
				</li>
				<li>
					Oddzielać  działalność ambasadorską&nbsp;od przynoszącej indywidualne korzyści oraz politycznej.
				</li>
				<li>
					Swoim uczciwym, tolerancyjnym&nbsp;i godnym postępowaniem  budować pozytywny wizerunek
					Ambasadorów&nbsp;i Ambasadorek Jawności.
				</li>
			</ol>
		</div>
			<hr/>
			<div class="checkbox">
				<label for="register_form_datatrue">
					<input type="checkbox" name="kodekstrue" required id="register_form_datatrue"/>Oświadczam, że zapoznałem się&nbsp;ze wszystkimi punktami Kodeksu Ambasadora/Ambasadorki Jawności&nbsp;i zobowiązuję się&nbsp;do jego przestrzegania.<abbr title="Pola oznaczone gwiazdką (*) są wymagane">*</abbr>
				</label>
			</div>
			<div class="checkbox">
				<label for="register_form_datatrue">
					<input type="checkbox" name="datatrue" required id="register_form_datatrue"/>Oświadczam, że zawarte&nbsp;w powyższym formularzu dane są zgodne&nbsp;ze stanem faktycznym. <abbr title="Pola oznaczone gwiazdką (*) są wymagane">*</abbr>
				</label>
			</div>
			<div class="checkbox">
				<label for="register_form_datareg">
					<input type="checkbox" name="datareg" required id="register_form_datareg"/>Oświadczam, że zapoznałem(-am)&nbsp;się&nbsp;z <a href="files/regulamin.pdf" target="_blank">Regulaminem Programu</a>&nbsp;i akceptuję jego postanowienia.<abbr title="Pola oznaczone gwiazdką (*) są wymagane">*</abbr>
				</label>
			</div>
			<div class="checkbox">
				<label for="register_form_data">
					<input type="checkbox" name="data" required id="register_form_data"/>Oświadczam,&nbsp;iż&nbsp;wyrażam zgodę&nbsp;na przetwarzanie moich danych osobowych zgodnie&nbsp;z ustawą&nbsp;o ochronie danych osobowych (z 29 sierpnia 1997 roku) przez Sieć Obywatelską Watchdog Polska, ul.&nbsp;Ursynowska 22/2, 02-605 Warszawa&nbsp;w celach związanych&nbsp;z realizacją programu Ambasadorów&nbsp;i Ambasadorek Jawności oraz&nbsp;na podanie&nbsp;do wiadomości publicznej mojego imienia, nazwiska oraz miejscowości&nbsp;w przypadku zostania Ambasadorem/Ambasadorką Jawności. Jednocześnie potwierdzam, iż zostałem/zostałam poinformowany/a&nbsp;o możliwości sprawdzenia&nbsp;w jaki sposób&nbsp;i w jakim zakresie moje dane są przetwarzane,&nbsp;co zawierają,&nbsp;jak są udostępniane oraz&nbsp;o możliwości usunięcia danych&nbsp;z bazy Sieci Obywatelskiej Watchdog Polska.&nbsp;<abbr title="Pola oznaczone gwiazdką (*) są wymagane">*</abbr>
				</label>
			</div>
			<div class="form-actions"><input type="submit" name="submit" value="Wyślij" style="width: 50%; margin: 0 auto; margin-top: 1em" class="btn btn-primary btn-lg btn-block" id="submit-id-submit"> </div>
		</form>
		<p></p>
		<p>
			<a href="files/kodeks.pdf" target="_blank"><i class="fa fa-file-pdf-o" title="Plik w formacie PDF"></i> Pobierz Kodeks Ambasadora</a><br>
			<a href="files/dyspozycje.pdf" target="_blank"><i class="fa fa-file-pdf-o" title="Plik w formacie PDF"></i> Pobierz przykładowe dyspozycje</a><br>
			<a href="files/regulamin.pdf" target="_blank"><i class="fa fa-file-pdf-o" title="Plik w formacie PDF"></i> Pobierz Regulamin Programu</a>
		</p>
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

<?php

showFooter();
ob_end_flush();

?>
