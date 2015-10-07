<?php $t_uri = get_template_directory_uri(); ?>
<!DOCTYPE html>
<html lang="nb-no">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<title><?php wp_title('-', true, 'right'); ?> <?php bloginfo('name') ?></title>
	<link rel="stylesheet" href="<?php echo $t_uri ?>/css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Economica:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="<?php echo $t_uri ?>/js/jquery.bgswitcher.js" type="text/javascript"></script>
	<script type="text/javascript">var baseUri = '<?php echo $t_uri ?>';</script>
	<script src="<?php echo $t_uri ?>/js/main.js" type="text/javascript"></script>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	
	<header><a href="/">Oppen fotografi</a></header>
	
		<div class="wrapper">
			<nav>
				<?php wp_nav_menu(array('container' => false)); ?>
			</nav>
		</div>
