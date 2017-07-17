<?php
/**
 * The header for pages
 *
 * @package wagency
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="main-content">
	<header class="header" style="background-image: url(<?php echo get_field('page_bg') ?  get_field('page_bg') : get_field('page_bg', 88); ?>);">
		<div class="header-logo-wrap">
			<div class="header__logo">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">WebDesign<span class="orange">Studio</span></a>
			</div>
			<div class="header__nav__icon js-menu">
				<span class="header__nav__text">Menu</span>
				<i class="fa fa-bars" aria-hidden="true"></i>
			</div>
		</div>
	</header>
  <?php get_template_part( 'template-parts/content', 'nav-overlay' ); ?>
