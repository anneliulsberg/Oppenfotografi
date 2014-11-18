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
	<?php wp_head(); ?>
</head>

<body>
	
	<header><a href="/">Oppen fotografi</a></header>
	
	<div id="content">	
		<nav>
			<ul>
				<li id="contact"><a href="#">Kontakt</a></li>
				<li id="price"><a href="#">Pris</a></li>
				<li id="portfolio"><a href="#">Portefølje</a></li>
				<li id="blog"><a href="#">Blogg</a></li>			
			</ul>
		</nav>
	</div>
		
	
