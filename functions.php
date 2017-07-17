<?php
/**
 * wagency functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package wagency
 */

if ( ! function_exists( 'wagency_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function wagency_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on wagency, use a find and replace
	 * to change 'wagency' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'wagency', get_template_directory() . '/languages' );

	// Add image size for Testimonial post type
	add_image_size( 'testimonial', 120, 120, true );

	// Add image size for Portfolio post type on the home page
	add_image_size( 'portfolio', 360, 360, true );

    // Add image size for Single Portfolio
	add_image_size( 'single-portfolio', 1920, 400, true );

	// Add image size for Team post type
	add_image_size( 'team', 262, 315, true );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'wagency' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'wagency_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'wagency_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wagency_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wagency_content_width', 640 );
}
add_action( 'after_setup_theme', 'wagency_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wagency_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'wagency' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'wagency' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'wagency_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function wagency_scripts() {
	// Flexslider stylesheet
	wp_enqueue_style( 'flexslider-style', get_template_directory_uri() . '/flexslider/flexslider.css' );

	// Theme stylesheet
	wp_enqueue_style( 'wagency-style', get_stylesheet_uri(), array(), '1.0' );

	// Fonts
	wp_enqueue_style( 'google-font-open-sans', '//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,700,700i' );

	wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );

	// Flexslider JS
	wp_enqueue_script( 'flexslider-js', get_template_directory_uri() . '/flexslider/jquery.flexslider-min.js', array('jquery') );

	wp_enqueue_script( 'wagency-script', get_template_directory_uri() . '/js/main.js', array( 'jquery' ), '1.0', true );

	wp_enqueue_script( 'wagency-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'wagency-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wagency_scripts' );

function wagency_portfolio_posttype() {
    $labels = array(
        'name'                  => 'Portfolio',
        'singular_name'         => 'Work',
        'menu_name'             => 'Portfolio',
        'name_admin_bar'        => 'Work',
        'add_new'               => 'Add New',
        'add_new_item'          => 'Add New Work',
        'new_item'              => 'New Work',
        'edit_item'             => 'Edit Work',
        'view_item'             => 'View Work',
        'all_items'             => 'All Works',
        'search_items'          => 'Search Works',
        'parent_item_colon'     => 'Parent Works:',
        'not_found'             => 'No works found.',
        'not_found_in_trash'    => 'No works found in Trash.'
    );
 
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'portfolio' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => null,
				'menu_icon'					 => 'dashicons-portfolio',
        'supports'           => array( 'title', 'editor', 'thumbnail' ),
    );
 
    register_post_type( 'portfolio', $args );
}
add_action( 'init', 'wagency_portfolio_posttype' );

function wagency_testimonial_posttype() {
    $labels = array(
        'name'                  => 'Testimonials',
        'singular_name'         => 'Testimonial',
        'menu_name'             => 'Testimonials',
        'name_admin_bar'        => 'Testimonial',
        'add_new'               => 'Add New',
        'add_new_item'          => 'Add New Testimonial',
        'new_item'              => 'New Testimonial',
        'edit_item'             => 'Edit Testimonial',
        'view_item'             => 'View Testimonial',
        'all_items'             => 'All Testimonials',
        'search_items'          => 'Search Testimonials',
        'parent_item_colon'     => 'Parent Testimonial:',
        'not_found'             => 'No testimonials found.',
        'not_found_in_trash'    => 'No testimonials found in Trash.'
    );
 
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'testimonial' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => null,
				'menu_icon'					 => 'dashicons-testimonial',
        'supports'           => array( 'title', 'editor', 'thumbnail' ),
    );
 
    register_post_type( 'testimonial', $args );
}
add_action( 'init', 'wagency_testimonial_posttype' );

function wagency_team_posttype() {
    $labels = array(
        'name'                  => 'Team',
        'singular_name'         => 'Team',
        'menu_name'             => 'Team',
        'name_admin_bar'        => 'Team',
        'add_new'               => 'Add New',
        'add_new_item'          => 'Add New Team Member',
        'new_item'              => 'New Team Member',
        'edit_item'             => 'Edit Team Member',
        'view_item'             => 'View Team Member',
        'all_items'             => 'All Team Members',
        'search_items'          => 'Search Team',
        'parent_item_colon'     => 'Parent Team:',
        'not_found'             => 'No team member found.',
        'not_found_in_trash'    => 'No team members found in Trash.'
    );
 
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_rest'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'team' ),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => null,
				'menu_icon'					 => 'dashicons-groups',
        'supports'           => array( 'title', 'editor', 'thumbnail' ),
    );
 
    register_post_type( 'team', $args );
}
add_action( 'init', 'wagency_team_posttype' );


function wagency_add_acf_data() {
    register_rest_field('portfolio', 'img', array(
        'get_callback' => function( $portfolio_obj) {
            return wp_get_attachment_link( ( get_post_meta( $portfolio_obj['id'], 'the_work_img', true ) ), 'portfolio' );
        }
    ));

    register_rest_field('portfolio', 'desc', array(
        'get_callback' => function( $portfolio_obj) {
            return get_post_meta( $portfolio_obj['id'], 'the_work_desc', true );
        }
    ));
}
add_action( 'rest_api_init', 'wagency_add_acf_data' );
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Additional features to allow styling of the templates.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
