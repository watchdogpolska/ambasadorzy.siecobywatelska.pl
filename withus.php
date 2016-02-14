<?php

include_once('functions.inc.php');
include_once('db.inc.php');

showHead("Są z nami", "&nbsp;");

?>




<div class="row">
	<div class="grid" id="with-us-grid">
		<div class="grid-sizer grid-item-with-us"></div>
		<div class="grid-stamp grid-size-xs-1-1 grid-size-md-1-3 grid-stamp-top-right">
			<div class="card">
				<div class="card--content">
					<div class="embed-responsive embed-responsive-16by9">
						<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/5feZrqYOisY" frameborder="0" allowfullscreen></iframe>
					</div>
				</div>
			</div>
		</div>

		<?php
		$link = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_BASE);
		$celebryci = mysqli_query($link, "SELECT * from famous");
		while($celebryta = mysqli_fetch_array($celebryci, MYSQLI_ASSOC)) {
			$id = $celebryta['idfamous'];
			$name = htmlspecialchars($celebryta['name']);
			$link = htmlspecialchars($celebryta['videolink']);
			$desc = htmlspecialchars($celebryta['desc']);

			?>
			<div class="grid-item grid-item-with-us">
				<?php
				if (strpos($link,'youtube') !== false) {
					$search = '/youtube\.com\/watch\?v=([a-zA-Z0-9]+)/smi';
					$replace = "youtube.com/embed/$1";
					$url = preg_replace($search,$replace,$link);
					$isYT = true;
					$yt_embed = '
					<div class="embed-responsive embed-responsive-16by9">
						<iframe class="embed-responsive-item" src="' . $url . '" frameborder="0" allowfullscreen></iframe>
					</div>';
				}
				else{
					$isYT = false;
				}
				?>
				<div class="card2">
					<div class="card2--summary">
						<div class="card2--holder">
							<?php
							if(!$isYT):
							?>
							<img src='<?php echo $link; ?>' alt='<?php echo $name; ?>'>
							<?php
							endif;
							?>
						</div>
						<?php
						if($isYT){
							echo $yt_embed;
						}
						?>
						<div class="card2--short">
							<h2><?php echo $name; ?></h2>
							<a href="#" class="js-expand-card">Rozwiń ></a>
						</div>
					</div>
					<div class="card2--detail">
						<?php echo $desc; ?>
					</div>
				</div>
			</div>
			<?php
		}
		?>
	</div>
</div>
<?php

showFooter();

?>
