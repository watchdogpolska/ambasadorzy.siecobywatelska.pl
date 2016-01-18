<?php

include_once('functions.inc.php');
showHead("Do pobrania","");

?>

<style>
	.custome-page-template .entry-summary {
		background-color: #d9d9d9;
	  padding: 40px;
	  position: relative;
	  margin-bottom: 40px;
	}
	.custome-page-template .entry-wrap {
		color: #4c4c4c;
    position: relative;
    background-color: transparent;
	}
</style>

<?php
$files = [];
$files[] = [
	'path' => '/files/regulamin.pdf',
	'ext' => 'pdf',
	'label' => 'Regulamin Ambasadorów Jawności',
];

$files[] = [
	'path' => '/files/kodeks.pdf',
	'ext' => 'pdf',
	'label' => 'Kodeks Ambasadorów Jawności',
];

$files[] = [
	'path' => '/files/kodeks.pdf',
	'ext' => 'pdf',
	'label' => 'Kodeks Ambasadorów Jawności',
];

$files[] = [
	'path' => '/files/dyspozycje.pdf',
	'ext' => 'pdf',
	'label' => 'Przykładowe dyspozycje',
];

$files[] = [
	'path' => '/files/podpisy.pdf',
	'ext' => 'pdf',
	'label' => 'Podpisy do zdjęć',
];

$files[] = [
	'path' => '/files/ulotka.pdf',
	'ext' => 'pdf',
	'label' => 'Ulotka pt. "Zostań Ambasadorem Jawności!"',
];

$files[] = [
	'path' => '/files/ulotka2.pdf',
	'ext' => 'pdf',
	'label' => 'Ulotka nt. dostępu do informacji publicznej',
];

$files[] = [
	'path' => '/files/pub_zeby.pdf',
	'ext' => 'pdf',
	'label' => 'Publikacja pt. "Zdrowe zęby demokracji"',
];



?>
<h2>Materiały do pobrania</h2>
<div class="row">
	<div class="col-xs-12">
		<div class="grid">
			<div class="grid-sizer grid-item-xs-1-1 grid-item-md-1-2 grid-item-lg-1-3"></div>
			<div class="grid-gutter"></div>
			<?php
			foreach ($files as $file):
			extract($file);
			?>
			<div class="grid-item grid-item-xs-1-1 grid-item-md-1-2 grid-item-lg-1-3">
				<div class="grid-item--inner">
					<div class="grid-item--title">
						<a href="<?php echo $path; ?>">
							<img src="/static/images/download.svg" alt="<?php echo $label?>" class="grid-item--icon" width="26" height="33">
							<?php echo $ext; ?>
						</a>
					</div>
					<div class="grid-item--content">
						<a href="<?php echo $path; ?>">
							<?php echo $label;?>
						</a>
					</div>
				</div>
			</div>
			<?php
			endforeach;
			?>
		</div>
	</div>
</div>
<?php

showFooter();

?>
