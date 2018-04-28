<?php
/**
 * north-star functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package north-star
 */

if ( ! function_exists( 'north_star_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function north_star_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on north-star, use a find and replace
		 * to change 'north-star' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'north-star', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'north-star' ),
			'menu-2' => esc_html__( 'Footer', 'north-star' ),
		) );


		function atg_menu_classes($items, $args) {
      if($args->menu->slug == 'mobile-menu') {
        foreach ( $items as $item ) {
          $item->classes[] = 'mobile-menu__nav-item';
//          nav-link
        }
      }
      return $items;
		}
		add_filter('wp_nav_menu_objects','atg_menu_classes',1,3);

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
		add_theme_support( 'custom-background', apply_filters( 'north_star_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'north_star_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function north_star_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'north_star_content_width', 640 );
}
add_action( 'after_setup_theme', 'north_star_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function north_star_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'north-star' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'north-star' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'north_star_widgets_init' );


/**
 * Enqueue scripts and styles.
 */
function north_star_scripts() {

	wp_enqueue_style( 'north-star-style', get_stylesheet_uri() );

	wp_enqueue_style( 'wordpress-overrides', get_template_directory_uri() . '/css/wordpress-overrides.css');

	wp_enqueue_script( 'north-star-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'north-star-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'underscore-helpers', get_template_directory_uri() . '/js/underscore-helpers.js', array('jquery'), '1', true );

	wp_enqueue_script( 'north-star-scripts', get_template_directory_uri() . '/js/theme.js', array('underscore-helpers'), '1', true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'north_star_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function remove_menus(){

  // remove_menu_page( 'index.php' );                  //Dashboard
  // remove_menu_page( 'jetpack' );                    //Jetpack*
  remove_menu_page( 'edit.php' );                   //Posts
  // remove_menu_page( 'upload.php' );                 //Media
  // remove_menu_page( 'edit.php?post_type=page' );    //Pages
  remove_menu_page( 'edit-comments.php' );          //Comments
  // remove_menu_page( 'themes.php' );                 //Appearance
  // remove_menu_page( 'plugins.php' );                //Plugins
  // remove_menu_page( 'users.php' );                  //Users
  // remove_menu_page( 'tools.php' );                  //Tools
  // remove_menu_page( 'options-general.php' );        //Settings

}
add_action( 'admin_menu', 'remove_menus' );


function custom_post_type() {

    $labels = array(
        'name'                => _x( 'People', 'Post Type General Name', 'north-star' ),
        'singular_name'       => _x( 'Person', 'Post Type Singular Name', 'north-star' ),
        'menu_name'           => __( 'People', 'north-star' ),
//        'parent_item_colon'   => __( 'Parent Movie', 'north-star' ),
        'all_items'           => __( 'All People', 'north-star' ),
        'view_item'           => __( 'View Person', 'north-star' ),
        'add_new_item'        => __( 'Add New Person', 'north-star' ),
        'add_new'             => __( 'Add New', 'north-star' ),
        'edit_item'           => __( 'Edit Person', 'north-star' ),
        'update_item'         => __( 'Update Person', 'north-star' ),
        'search_items'        => __( 'Search Person', 'north-star' ),
        'not_found'           => __( 'Not Found', 'north-star' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'north-star' ),
    );

    $args = array(
        'label'               => __( 'people', 'north-star' ),
        'description'         => __( 'People and Employees', 'north-star' ),
        'labels'              => $labels,
        // Features this CPT supports in Post Editor
        'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions', 'page-attributes'),
        // You can associate this CPT with a taxonomy or custom taxonomy.
        'taxonomies'          => array( 'genres' ),
        'rewrite'             => array('slug' => 'team'),
        /* A hierarchical CPT is like Pages and can have
        * Parent and child items. A non-hierarchical CPT
        * is like Posts.
        */
        'hierarchical'        => true,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 20,
        'can_export'          => true,
        'has_archive'         => false,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',
        'menu_icon'           => 'dashicons-id'
    );

    // Registering your Custom Post Type
    register_post_type( 'people', $args );

    $labels = array(
            'name'                => _x( 'Departments', 'Post Type General Name', 'north-star' ),
            'singular_name'       => _x( 'Department', 'Post Type Singular Name', 'north-star' ),
            'menu_name'           => __( 'Departments', 'north-star' ),
    //        'parent_item_colon'   => __( 'Parent Movie', 'north-star' ),
            'all_items'           => __( 'All Departments', 'north-star' ),
            'view_item'           => __( 'View Department', 'north-star' ),
            'add_new_item'        => __( 'Add New Department', 'north-star' ),
            'add_new'             => __( 'Add New', 'north-star' ),
            'edit_item'           => __( 'Edit Department', 'north-star' ),
            'update_item'         => __( 'Update Department', 'north-star' ),
            'search_items'        => __( 'Search Department', 'north-star' ),
            'not_found'           => __( 'Not Found', 'north-star' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'north-star' ),
        );

        $args = array(
            'label'               => __( 'departments', 'north-star' ),
            'description'         => __( 'Departments', 'north-star' ),
            'labels'              => $labels,
            // Features this CPT supports in Post Editor
            'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions'),
            // You can associate this CPT with a taxonomy or custom taxonomy.
            'taxonomies'          => array( 'genres' ),
            /* A hierarchical CPT is like Pages and can have
            * Parent and child items. A non-hierarchical CPT
            * is like Posts.
            */
            'hierarchical'        => false,
            'public'              => false,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'show_in_nav_menus'   => true,
            'show_in_admin_bar'   => true,
            'menu_position'       => 20,
            'can_export'          => true,
            'has_archive'         => false,
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'capability_type'     => 'page',
            'menu_icon'           => 'dashicons-networking'
        );

        // Registering your Custom Post Type
        register_post_type( 'departments', $args );
}

/* Hook into the 'init' action so that the function
* Containing our post type registration is not
* unnecessarily executed.
*/

add_action( 'init', 'custom_post_type', 0 );

/**
 * Custom walker class.
 */
class WPDocs_Walker_Nav_Menu extends Walker_Nav_Menu {

    /**
     * Starts the list before the elements are added.
     *
     * Adds classes to the unordered list sub-menus.
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     */
    function start_lvl( &$output, $depth = 0, $args = array() ) {
      if($args->menu_id == 'primary-menu') {
        $output .= "\n" . $indent . '<ul class="header__dropdown list--unstyled dropdown">' . "\n";
      } else {
        $output .= "\n" . $indent . '<ul class="list--unstyled dropdown mobile-menu__nav-dropdown dropdown">' . "\n";
      }
    }

    /**
     * Start the element output.
     *
     * Adds main/sub-classes to the list items and links.
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item   Menu item data object.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     * @param int    $id     Current item ID.
     */
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $wp_query;
        $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

        if ($args->menu_id == 'primary-menu') {
          // Depth-dependent classes.
          $depth_classes = array(
            ($depth == 0 ? 'header__nav-item' : ''),
          );

          $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

          // Passed classes.
          $classes = empty( $item->classes ) ? array() : (array) $item->classes;
          $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

          // Build HTML.
          $output .= $indent . '<li class="' . $depth_class_names . ' ' . $class_names . '">';

          // Link attributes.
          if($depth == 1) {
            $title = substr(get_permalink('8'), 0, -1) . '#' . sanitize_title($item->title);
          }

          if(in_array ( 'menu-item-has-children' , $item->classes )) {
            $dropdown_class = 'js-dropdown dropdown-link';
            $dropdown_attributes = ' aria-expanded="false" aria-role="button"';
            $attributes .= $dropdown_attributes;
            $icon = $depth == 0 ? '<span class="icon-chevron dropdown__icon"></span>' : '';
            $attributes .= ' class="' . $dropdown_class . '"';
          }

          $attributes .= ! empty( $item->url ) ? ' href="'   . esc_attr(( $depth > 0 ? $title : $item->url ) ) .'"' : '';
        } else if ($args->menu_id === 'mobile-menu') {
          // Depth-dependent classes.
          $depth_classes = array(
            ($depth == 0 ? 'mobile-menu__nav-item' : 'hero__links-item'),
          );

          $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

          // Passed classes.
          $classes = empty( $item->classes ) ? array() : (array) $item->classes;
          $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

          // Build HTML.
          $output .= $indent . '<li class="' . $depth_class_names . ' ' . $class_names . '">';

          // Link attributes.
          if($depth == 1) {
            $title = substr(get_permalink('8'), 0, -1) . '#' . sanitize_title($item->title);
          }

          $dropdown_class = '';

          if(in_array ( 'menu-item-has-children' , $item->classes )) {
            $dropdown_class = ' js-dropdown dropdown-link';
            $dropdown_attributes = ' aria-expanded="false" aria-role="button"';
            $attributes .= $dropdown_attributes;
            $icon = $depth == 0 ? '<span class="icon-chevron dropdown__icon"></span>' : '';
          }

          $attributes .= ' class="' . 'nav-link' . $dropdown_class . '"';

          $attributes .= ! empty( $item->url ) ? ' href="'   . esc_attr(( $depth > 0 ? $title : $item->url ) ) .'"' : '';
        }



        // Build HTML output and pass through the proper filter.
        $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
            $args->before,
            $attributes,
            $args->link_before,
            apply_filters( 'the_title', $item->title, $item->ID ),
            $icon,
            $args->after
        );
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}

add_filter('upload_mimes', 'custom_upload_mimes');
function custom_upload_mimes ( $existing_mimes=array() ){
  // add your extension to the array
  $existing_mimes['vcf'] = 'text/x-vcard'; return $existing_mimes;
}
