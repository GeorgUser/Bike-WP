<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title><?php wp_title(); ?></title>
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta property="og:image" content="path/to/image.jpg">
    <meta name="theme-color" content="#000">
    <link rel="icon" href="<?php bloginfo('template_url') ?>/images/favicon2.png">
    <link rel="apple-touch-icon" sizes="180x180" href="#">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&display=swap&subset=cyrillic" rel="stylesheet">
    <?php wp_head();?>
</head>
<body <?php body_class(); ?>>
<header id="header" class="header sticky-top">
    <div class="page__container">
        <nav class="navbar navbar-expand-xl navbar-dark">
            <a class="navbar-brand" href="<?php echo esc_url(home_url()) ?>">
                <div class="logo">
                    <?php $logo = get_field('logo', 'option');?>
                    <img src="<?php echo $logo['url'];?>" alt="<?php echo $logo['alt'];?>" title="<?php echo $logo['title'];?>">
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <?php wp_nav_menu(array('theme_location'=>'primary', 'menu_class'=>'navbar-nav mr-auto', 'container'=>false, 'depth'=> 10, 'item_spacing'=>'discard', 'walker'=> new custom_walker_nav_menu) ); ?>
                <form class="form-inline">
                    <div class="search">
                        <input class="form-control" type="search" aria-label="Search">
                        <button class="btn" type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </form>
                <div class="social__col">
                    <?php echo bike_social('social') ?>
                    <a class="phone" href="tel: <?php echo get_field('phone', 'option');?>"><?php echo get_field('phone', 'option');?></a>
                </div>
            </div>

        </nav>
    </div>
</header>