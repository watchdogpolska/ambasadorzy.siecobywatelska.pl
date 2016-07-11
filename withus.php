<?php

include_once('functions.inc.php');
include_once('db.inc.php');

showHead("Są z nami", "&nbsp;");

?>




<div class="row">
	<div class="grid" id="with-us-grid">
		<div class="grid-sizer grid-item-with-us"></div>
		<div class="grid-stamp grid-size-xs-1-1 grid-size-md-1-3 grid-stamp-top-right">
			<div class="card" style="padding: 0;">
				<div class="card--content">
					<a href="#" class="js-open-video-modal" data-toggle="modal" data-target="#video-modal" data-url="https://www.youtube.com/embed/uPxqXYTzzp8">
						<img src="http://img.youtube.com/vi/uPxqXYTzzp8/0.jpg" style="width: 100%;" class="img-responsive" alt="Czy można żyć bez informacji? - Youtube">
					</a>
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
					$embed_url = preg_replace('/^https?:\/\/(?:www.)?youtube\.com\/watch\?v\=([a-zA-Z0-9_]+)/smi', "https://www.youtube.com/embed/$1", $link);
					$thumbnail_url = preg_replace('/^https?:\/\/(?:www.)?youtube\.com\/watch\?v\=([a-zA-Z0-9_]+)/smi', "https://img.youtube.com/vi/$1/0.jpg", $link);
					$isYT = true;
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
						<?php if($isYT): ?>
						<a href="#" class="js-open-video-modal" data-toggle="modal" data-target="#video-modal" data-url="<?= htmlspecialchars($embed_url)?>">
							<img src="<?= htmlspecialchars($thumbnail_url); ?>" style="width: 100%;" class="img-responsive" alt="Youtube">
						</a>
						<?php endif; ?>
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
<div class="modal fade" id="video-modal" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Podgląd filmu</h4>
			</div>
			<div class="modal-body">
				<div class="embed-responsive embed-responsive-16by9">
					<iframe class="embed-item embed-responsive-item" frameborder="0" allowfullscreen></iframe>
				</div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php

showFooter();

?>
