<!doctype html>
<html <?php language_attributes(); ?> class="no-js">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <title><?php wp_title(''); ?><?php if (wp_title('', false)) {
                                        echo ' :';
                                    } ?> <?php bloginfo('name'); ?></title>

    <link href="//www.google-analytics.com" rel="dns-prefetch">
    <link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
    <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed">

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php bloginfo('description'); ?>">

    <?php wp_head(); ?>

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-28332844-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-28332844-1');
    </script>

    <script>
    // conditionizr.com
    // configure environment tests
    conditionizr.config({
        assets: '<?php echo get_template_directory_uri(); ?>',
        tests: {}
    });
    </script>
    <script type="module" crossorigin="" src="<?= get_stylesheet_directory_uri() ?>/assets/index-63f8ab02.js"></script>
    <link rel="stylesheet" href="<?= get_stylesheet_directory_uri() ?>/style.css" />
</head>

<body <?php body_class(); ?>>

    <div id="root">
        <header class="Header">
            <div class="Header__logo">
                <div class="Logo Logo--small">
                    <a href="/" class="Logo__text">Call for Curators</a>
                    <div id="logo-toggle" data-toggle-sidebar="main-nav-menu" class="Logo__shell">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 23.25 26.84">
                            <path
                                d="m12.61 13.42 10.64 6.15V7.28l-10.64 6.14ZM11.95 0v12.29l10.64-6.15L11.95 0ZM10.64 0 0 6.14l10.64 6.14V0ZM11.95 26.84l10.64-6.14-10.64-6.15v12.29Z">
                            </path>
                        </svg>
                    </div>
                </div>
                <a href="/" class="Logo Logo--large"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 399.13 38.25">
                        <g style="isolation: isolate">
                            <text transform="translate(0 29.75)">
                                <tspan x="0" y="0" style="letter-spacing: -0.02em">C</tspan>
                                <tspan x="26.35" y="0">ALL FOR CUR</tspan>
                                <tspan x="250.07" y="0" style="letter-spacing: -0.06em">
                                    A
                                </tspan>
                                <tspan x="271.32" y="0" style="letter-spacing: -0.03em">
                                    T
                                </tspan>
                                <tspan x="292.28" y="0" style="letter-spacing: 0em">
                                    ORS
                                </tspan>
                            </text>
                        </g>
                        <path
                            d="m388.49 17.75 10.64 6.15V11.61l-10.64 6.14ZM387.83 4.33v12.29l10.64-6.15-10.64-6.14ZM386.52 4.33l-10.64 6.14 10.64 6.14V4.33ZM387.83 31.17l10.64-6.14-10.64-6.15v12.29Z">
                        </path>
                    </svg></a>
            </div>
            <nav class="Header__nav" id="main-nav-menu">
                <menu class="Nav">


                    <?php
                    /*wp_nav_menu(
						array(
							'theme_location'  => 'author-menu',
							'menu'            => '',
							'container'       => 'div',
							'container_class' => 'menu-{menu slug}-container',
							'container_id'    => '',
							'menu_class'      => 'menu',
							'menu_id'         => '',
							'echo'            => true,
							'fallback_cb'     => 'wp_page_menu',
							'before'          => '',
							'after'           => '',
							'link_before'     => '',
							'link_after'      => '',
							'items_wrap'      => '<ul id="menu-footer">%3$s</ul>',
							'depth'           => 0,
							'walker'          => ''
						)
					);*/
                    ?>
                    <li class="Nav__item">
                        <a href="/announce-call">Announce Call</a>
                    </li>
                    <li class="Nav__item"><a href="/search-call">Search Call</a></li>
                    <li class="Nav__item"><a href="/community">Browse Community</a></li>
                    <li class="Nav__item Subnav" data-subnav-state="0">
                        <div class="Subnav__title">Editorial</div>
                        <nav class="Subnav__nav">
                    <li><a href="/blog">Blog</a></li>
                    <li><a href="/events">CfC Events</a></li>
                    <li><a href="/podcasts">Podcasts</a></li>
            </nav>
            </li>
            <?php if (is_user_logged_in()) { 
                $current_user = wp_get_current_user(); 
                ?>
            <li class="Nav__item Nav__item--purple capitalise"><a
                    href="/account/"><?php echo esc_html($current_user->display_name); ?></a></li>
            <?php } else { ?>
            <li class="Nav__item Nav__item--purple" data-open-sidebar="sidebar-login" data-open-delay="200"
                data-close-sidebar="main-nav-menu">
                Login/Join
            </li>
            <?php } ?>
            </menu>
            </nav>
        </header>