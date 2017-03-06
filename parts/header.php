<!DOCTYPE html>

<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="<?php echo META_DESC; ?>">
	<meta property="og:site_name" content="<?php echo PAGE_NAME; ?>"/>
	<meta property="og:description" content="<?php echo META_DESC; ?>" />
	<meta property="og:locale" content="pl_PL" />
	<meta property="og:image" content="/static/images/sprzyja.png" />

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="/static/css/style.css">
	<link rel="stylesheet" href="/css/cc-icons.min.css">
	<link rel="shortcut icon" type='image/x-icon' href='<?php echo htmlspecialchars(url_origin($_SERVER)); ?>/favicon.ico' />

	<title><?php if(!empty($subname)) echo $subname.' - '; ?><?php echo PAGE_NAME; ?></title>
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
		ga('create', 'UA-71083051-5', 'auto');
		ga('send', 'pageview');
	</script>
</head>
<body style='font-family: "GloberSemibold","GloberRegular",Helvetica,Arial,sans-serif;'>
	<div class="container">
		<header>
			<div class="header-top">
				<a href="/"><img src="/static/images/logo.png" height="120" alt="Logo Ambasadorzy Jawności"></a>
				<a href="http://siecobywatelska.pl/wlacz-sie-5min/#ambasadorzy" class="support-button" style="position: relative; float: right; right: auto" target="_blank">Wspieraj nas</a>
			</div>
			<?php
			$current_path = $_SERVER["SCRIPT_NAME"];
			if($current_path == '/index.php'){
				$current_path = '/';
			}
			$menu_items = [];
			$menu_items['/'] = '<i class="fa fa-home" aria-hidden="true"></i> Dołącz';
			$menu_items['/ambassadors.php'] = 'Ambasadorzy';
			$menu_items['/withus.php'] = 'Są z nami';
			$menu_items['/firmy.php'] = 'Dla firm';
			$menu_items['/download.php'] = 'Do pobrania';
			$menu_items['/contact.php'] = 'Kontakt';
			?>
			<nav id="mainMenu">
				<ul>
					<?php
					foreach ($menu_items as $path => $label):
					?>
					<li>
						<?php
						printf(
							'<a href="%s"%s>%s</a>',
							$path,
							$path == $current_path?' class="active"':'',
							$label
							)
						?>
					</li>
					<?php
					endforeach;
					?>

				</ul>
		</header>
	</nav>
		<div id="contentContainer">
			<h1><?php echo $header; ?></h1>
