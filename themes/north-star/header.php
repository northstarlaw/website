<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package north-star
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<link href="https://fonts.googleapis.com/css?family=Cormorant+Garamond|Montserrat:300,400" rel="stylesheet">
  <link rel="shortcut icon" href="/favicon.ico">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<header>
	  <div class="header__group">
	    <div class="header">
	      <nav class="flex grid--center-align">
	        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="header__logo" title="<?= get_bloginfo('name'); ?>">
						<svg xmlns="http://www.w3.org/2000/svg"
						     viewBox="0 0 136 130.83"
						     width="45px"
						     height="45px"
						     class="star-logo"
						     itemprop="logo"
						>
						  <g id="Layer_1-2" data-name="Layer 1">
						    <polygon points="65.67 0 68.17 1.17 95.17 47 109.67 49.5 112.17 51.83 83.17 51.83 65.67 0"/>
						    <polygon points="136 45.17 90.67 77.17 98.83 104.33 100.17 101.83 98.5 86.83 135.17 48.17 136 45.17"/>
						    <polygon points="68.5 93.67 45 110 47.67 110.5 62.33 103.33 110.33 126.33 113.33 126.33 68.5 93.67"/>
						    <polygon points="24 62 47.17 79.5 28.83 131 27.33 128.83 35.58 75.67 25 65 24 62"/>
						    <polygon points="55.33 50.83 0 51.17 1.83 49.17 55.33 38.67 61.83 25.92 64.5 24.17 55.33 50.83"/>
						  </g>
						</svg>

	        </a>

	        <div class="header__nav-wrap">
	          <button class="header__mobile-nav js-mobile-menu-button icon-burger" type="button">
	            <span class="sr-only">Open menu</span>
	          </button>
						<?php
							wp_nav_menu( array(
								'theme_location' => 'menu-1',
								'menu_id'        => 'primary-menu',
								'menu_class' => 'header__nav list--unstyled',
								'items_wrap' => '<ul class="%2$s">%3$s</ul>',
								'walker'     => new WPDocs_Walker_Nav_Menu()
							) );
						?>
	        </div>
	      </nav>
	    </div>
	  </div>
	</header>


	<div id="content" class="site-content">
