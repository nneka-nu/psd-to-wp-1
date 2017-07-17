<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
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
	<header class="header" role="banner" <?php echo is_front_page() ? 'style="background-image: url(' . get_field('hero_bg') . ')"' : ''; ?>>
		<div class="header-logo-wrap">
			<div class="header__logo">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">WebDesign<span class="orange">Studio</span></a>
			</div>
			<div class="header__nav__icon js-menu">
				<span class="header__nav__text">Menu</span>
				<i class="fa fa-bars" aria-hidden="true"></i>
			</div>
		</div>
		<div class="header__content">
			<div class="header__heading"><?php the_field('hero_heading'); ?></div>
			<div class="header__desc"><?php the_field('hero_desc'); ?></div>
			<div class="header__cta">
				<a href="#contact" class="btn header__cta__hire js-scroll">Hire Us</a>
				<a href="#works" class="btn header__cta__works js-scroll">Our Work</a>
			</div>
		</div>
		<a href="#services" class="header__scroll js-scroll">
			<i class="fa fa-angle-down" aria-hidden="true"></i>
		</a>
	</header>
	<?php get_template_part( 'template-parts/content', 'nav-overlay' ); ?>
