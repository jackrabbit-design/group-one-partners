<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="MSSmartTagsPreventParsing" content="true" /><!--[if lte IE 9]><meta http-equiv="X-UA-Compatible" content="IE=Edge"/><![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <meta name="google-site-verification" content="4gYD3lEtM17CcUWHEZ4KGPKhYq8ixNHN1Qwn1vhsFqM" />
    <title><?php echo wp_title(); ?></title>
    <link type="text/plain" rel="author" href="<?php echo bloginfo('url'); ?>/authors.txt" />
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon-180x180.png">
    <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/android-chrome-192x192.png" sizes="192x192">
    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/mstile-144x144.png">
    <meta name="theme-color" content="#ffffff">    <!-- End Magnific Popup -->

    <?php wp_head(); ?>
</head>
<body>
    <!--[if lte IE 7]><iframe src="<?php echo bloginfo('url'); ?>/unsupported.html" frameborder="0" scrolling="no" id="no_ie6"></iframe><![endif]-->
	<header id="header">
    	<div class="container">
        	<div class="container-inner clearfix">
            	<h1 id="logo" class="pull-left">
                	<a href="<?php echo bloginfo('url'); ?>">
                    	<img src="<?php echo bloginfo('url') ?>/ui/images/main-logo.png"  alt="<?php bloginfo('name'); ?>" />
                    </a>
                </h1>

                <div class="header-right pull-right hidden-s">
                	<div class="clearfix inner-wrap">
                    	<nav id="main-nav" class="pull-left">
                            <?php
                              wp_nav_menu(array(
                                          'container'=>'',
                                          'menu_class'=>''
                                        ));
                            ?>
                        </nav>
                        <div class="search-wrap pull-left">
                        	<span class="search-icon" id="desktop-search"><i class="gp-icon-search"></i></span>
                            <div class="search-box">
                            	<form action="<?php echo site_url()?>/search-results/" method="post">
                                	<input type="text" name="search" placeholder="Search" />
                                </form>
                            </div>
                        </div>
                    </div>
                </div><!--header-right-->

            </div>
        </div>
        <div id="toggle_menu_btn"><span></span></div>
        <div id="mobile-nav-wrap">
        	<nav id="mobile-nav">
                <?php
                              wp_nav_menu(array(
                                          'container'=>'',
                                          'menu_class'=>'',
                                          'after'=>'<span>b</span>'
                                        ));
                            ?>
            </nav>

            <div class="bottom-box">
            	<span class="mobile-search" id="mobile-search"><i class="gp-icon-search"></i></span>
                <?php if (get_field('linkedin_url','options')): ?>
                <a href="<?php echo get_field('linkedin_url','options'); ?>" target="_blank"><i class="social-linkedin"></i></a>
                <?php endif; ?>
                <?php if (get_field('facebook_url','options')): ?>
                <a href="<?php echo get_field('facebook_url','options'); ?>" target="_blank"><i class="social-facebook"></i></a>
                <?php endif; ?>
                <?php if (get_field('twitter_url','options')): ?>
                <a href="<?php echo get_field('twitter_url','options'); ?>" target="_blank"><i class="social-twitter"></i></a>
                <?php endif; ?>
            </div>

            <div class="mobile-search-box">
            	<form action="<?php echo site_url()?>/search-results/" method="post">
                    <input type="text" name="search" placeholder="Search" />
                </form>
            </div>
        </div><!--mobile-nav-wrap-->
    </header>