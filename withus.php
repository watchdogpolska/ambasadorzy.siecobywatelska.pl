<?php

include_once('functions.inc.php');
include_once('db.inc.php');

showHead("Są z nami", "Znani(-ne) Ambasadorzy/Ambasadorki Jawności");

?>




<div class="row">
	<div class="col-md-6">
		<?php
		$link = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_BASE);
		$celebryci = mysqli_query($link, "SELECT * from famous");
		while($celebryta = mysqli_fetch_array($celebryci, MYSQLI_ASSOC)) {
			$id = $celebryta['idfamous'];
			$name = htmlspecialchars($celebryta['name']);
			$link = htmlspecialchars($celebryta['videolink']);
			$desc = htmlspecialchars($celebryta['desc']);

			?>
			<div id="descriptionBlock" class="block grayBlock" >
				<div class="blockContent">
					<h2><?php echo $name; ?></h2>
					<?php
					if (strpos($link,'youtube') !== false) {
						$search = '/youtube\.com\/watch\?v=([a-zA-Z0-9]+)/smi';
						$replace = "youtube.com/embed/$1";
						$url = preg_replace($search,$replace,$link);
						echo '<iframe class="embed-responsive-item" src="'.$url.'" frameborder="0" allowfullscreen></iframe>';
					}
					else echo "<img style='max-height: 200px; display: block; margin: 0 auto' src='$link' alt='$name'>";

					echo $desc;
					?>

				</div>

			</div>
			<?php
		}
		?>
	</div>



	<div class="col-md-6">
		<div id="signFormBlock" class="block redBlock">
			<div class="blockContent">
				<h2>Autorytety o tym, czy można żyć bez informacji?</h2>
				<div class="embed-responsive embed-responsive-16by9">
					<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/5feZrqYOisY" frameborder="0" allowfullscreen></iframe>
				</div>
			</div>
		</div>
	</div>
</div>
<?php

showFooter();

?>
