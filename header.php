<?php $t_uri = get_template_directory_uri(); ?>
<!DOCTYPE html>
<html lang="nb-no">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title><?php wp_title('-', true, 'right'); ?> <?php bloginfo('name') ?></title>
    <link rel="stylesheet" href="<?php echo $t_uri ?>/css/style.css">
    <link href='http://fonts.googleapis.com/css?family=Economica:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <?php wp_head(); ?>
    <script src="http://code.jquery.com/jquery-2.2.0.min.js"></script>
    <script src="<?php echo $t_uri ?>/js/main.js"></script>
    <?php include_once("googleanalytics.php") ?>
</head>

<body <?php body_class(); ?>>

    <header><a href="/">Oppen fotografi</a></header>

        <div class="wrapper">
            <nav>
                <?php wp_nav_menu(array('container' => false)); ?>
            </nav>
        </div>