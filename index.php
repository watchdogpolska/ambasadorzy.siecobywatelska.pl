<?php

include_once('functions.inc');
showHead("Strona główna");

if(isset($_POST['submit']) && csrf_validate($_POST['csrf'])) {
	

}

?>

<div id="descriptionBlock" class="block grayBlock">
<div class="blockFoldHold"><div class="blockFold"></div><div class="blockFoldClear"></div></div>
<div class="blockContent">
<h2>Dlaczego warto?</h2>
<p>Lorem ipsum dolor sit amet tellus. Donec erat volutpat. Curabitur est vitae mauris. Nam hendrerit. Donec aliquam id, ornare non, vehicula sit amet eleifend magna vitae odio id felis. In lacinia ut, tempus vehicula, enim aliquam imperdiet. Nullam et magnis dis parturient montes, nascetur ridiculus mus. Donec id mauris lacus diam at tortor. Praesent.</p>

<p>Aenean scelerisque, dui dui, eget leo. Suspendisse eu fermentum vestibulum. Aenean libero. Maecenas interdum dapibus non, tristique libero posuere dui. Morbi augue a dolor urna fringilla mi, rutrum sit amet, nonummy faucibus scelerisque. Maecenas nec dui. Nullam et odio. Nunc erat lacinia id, eleifend velit. Suspendisse turpis nec quam. Nam turpis egestas. Aenean ipsum at libero. Suspendisse porttitor egestas. Cum sociis natoque penatibus et odio.</p>

<p>Curabitur feugiat leo. Phasellus adipiscing. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus arcu vitae faucibus quis, tincidunt justo. Curabitur scelerisque a, vestibulum quis, dui. In gravida sagittis. Aliquam erat eget leo vitae libero odio consequat et, vehicula sapien vitae pede quis massa quis dolor.</p>

<p>Aenean massa molestie a, condimentum convallis. Donec accumsan id, tortor. In congue arcu accumsan vitae, vestibulum tincidunt varius laoreet. Nam urna. Quisque sed justo. Donec accumsan eget, auctor vitae, faucibus vestibulum. Nunc viverra auctor, urna felis, volutpat a, lacinia eget, eros. Phasellus pulvinar diam turpis at magna hendrerit nulla ipsum primis in neque eu ligula non eros cursus sapien. Maecenas viverra auctor, urna vitae ornare mi quam, ultrices eget, accumsan.</p>
</div>
</div>

<div id="signFormBlock" class="block redBlock">
<div class="blockFoldHold"><div class="blockFold"></div><div class="blockFoldClear"></div></div>
<div class="blockContent">
<h2>Zostań Ambasadorem/Ambasadorką Jawności!</h2>
<p style="text-align:center"><b>Kodeks Ambasadora</b></p>

<p>1. Lorem ipsum dolor sit amet libero ante, tincidunt tellus wisi, fermentum ante eget volutpat eu, leo. Suspendisse vel risus. Vestibulum.</p>

<p>2. Aenean sodales, velit suscipit lectus. Fusce et nunc hendrerit nulla a odio at nulla. Vivamus fermentum eu, nisl. Nam non.</p>

<p>3. Nulla facilisi. Nam consectetuer adipiscing diam bibendum id, libero. Aenean justo. Ut a purus. Aenean quis erat sed felis sit.</p>

<p>4. Duis ut aliquet lacinia dignissim, sapien eleifend et, fermentum ut, dolor. Praesent lacinia eget, neque. Etiam aliquam lacinia, diam magna.</p>

<p>5. Mauris ultrices. Vestibulum laoreet, enim molestie elit, dictum lectus varius nec, accumsan sit amet leo. Quisque nunc. Etiam malesuada fames.</p>

<h3 class="text-center">Twoje dane</h3>
<div id="reqNote">Pola oznaczone gwiazdką (*) są wymagane</div>
<form action="index.php" method="post">
<input type="hidden" name="csrf" value="<?php echo $_SESSION['csrf']; ?>">
Imię *<br/><input value="<?php if(isset($_POST['submit'])) echo htmlspecialchars($_POST['first']); ?>" class="textinput textInput form-control" maxlength="45" name="first" type="text" required /><br/>
Nazwisko *<br/><input value="<?php if(isset($_POST['submit'])) echo htmlspecialchars($_POST['name']); ?>" class="textinput textInput form-control" maxlength="45" name="name" type="text" required /><br/>
Email *<br/><input value="<?php if(isset($_POST['submit'])) echo htmlspecialchars($_POST['mail']); ?>" class="textinput textInput form-control" maxlength="60" name="mail" type="email" required /><br/>
Miasto *<br/><input value="<?php if(isset($_POST['submit'])) echo htmlspecialchars($_POST['city']); ?>" class="textinput textInput form-control" maxlength="45" name="city" type="text" required /><br/>
Telefon *<br/><input value="<?php if(isset($_POST['submit'])) echo htmlspecialchars($_POST['phone']); ?>" class="textinput textInput form-control" maxlength="45" name="phone" type="tel" required /><br/>
Opisz, czym zajmujesz się zawodowo? *<br/><textarea value="<?php if(isset($_POST['submit'])) echo htmlspecialchars($_POST['job']); ?>" class="textinput textInput form-control" maxlength="200" name="job" type="text" required></textarea><br/>
Adres korespondencyjny<br/><input value="<?php if(isset($_POST['submit'])) echo htmlspecialchars($_POST['address']); ?>" class="textinput textInput form-control" maxlength="200" name="address" type="text" /><br/>
Dlaczego chcesz zostać Ambasadorem Jawności? *<br/><textarea value="<?php echo htmlspecialchars($_POST['why']); ?>" class="textinput textInput form-control" maxlength="3000" name="why" type="text" required></textarea><br/>
Twoje zdjęcie (zostanie opublikowane)<br/><input class="textinput textInput form-control" name="photo" type="file" /><br/>
<p><input type="checkbox" checked=checked disabled=disabled />Oświadczam, że informacje podane w niniejszym Formularzu są zgodne ze stanem faktycznym. Oświadczam, iż wyrażam zgodę na przesyłanie informacji o działalności programowej i przetwarzanie moich danych osobowych przez Sieć Obywatelską Watchdog Polska, ul. Ursynowska 22/2, 02-605 Warszawa. Jednocześnie potwierdzam, iż zostałem/zostałam poinformowany/a o możliwości sprawdzenia w jaki sposób i w jakim zakresie moje dane są przetwarzane, co zawierają, jak są udostępniane oraz o możliwości usunięcia danych z bazy Sieci Obywatelskiej Watchdog Polska.
Wyrażam zgodę na wykorzystanie mojego wizerunku przez Sieć Obywatelską Watchdog Polska (w przypadku wysyłania zdjęcia).</p>
<div class="form-actions"><input type="submit" name="submit" value="Wyślij" class="btn btn-primary btn-lg btn-block" id="submit-id-submit"> </div>
</form>
<p></p>
</div>
</div>

<?php

showFooter();

?>
            


