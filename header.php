<?php $t_uri = get_template_directory_uri(); ?>
<!DOCTYPE html>
<html lang="nb-no">

<head>
	<meta charset="utf-8">
	<title><?php wp_title('-', true, 'right'); ?> <?php bloginfo('name') ?></title>
	<link rel="stylesheet" href="<?php echo $t_uri ?>/css/phone.css" media="only screen and (min-width: 320px) and (max-width: 767px)">
	<link rel="stylesheet" href="<?php echo $t_uri ?>/css/tablet.css" media="only screen and (min-width: 768px) and (max-width: 959px)">
	<link rel="stylesheet" href="<?php echo $t_uri ?>/css/desktop.css" media="only screen and (min-width: 960px)">
	<link href='http://fonts.googleapis.com/css?family=Economica:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="<?php echo $t_uri ?>/js/jquery.bgswitcher.js" type="text/javascript"></script>
	<script type="text/javascript">var baseUri = '<?php echo $t_uri ?>';</script>
	<script src="<?php echo $t_uri ?>/js/main.js" type="text/javascript"></script>
	<?php wp_head(); ?>
</head>

<body>
	
	<header><a href="/">Oppen fotografi</a></header>
	
	<div id="content">	
		<nav>
			<ul>
				<li id="contact"><a href="/kontakt">Kontakt</a></li>
				<li id="price"><a href="#">Pris</a></li>
				<li id="portfolio"><a href="#">Portefølje</a></li>
				<li id="blog"><a href="#">Blogg</a></li>			
			</ul>
		</nav>
		
	
