<?php
/**
 * VW Healthcare functions and definitions
 *
 * @package VW Healthcare
 */
/* Breadcrumb Begin */
function vw_healthcare_the_breadcrumb() {
	if (!is_home()) {
		echo '<a href="';
			echo esc_url( home_url() );
		echo '">';
			bloginfo('name');
		echo "</a> ";
		if (is_category() || is_single()) {
			the_category(',');
			if (is_single()) {
				echo "<span> ";
					the_title();
				echo "</span> ";
			}
		} elseif (is_page()) {
			echo "<span> ";
				the_title();
		}
	}
}
/**
/* Theme Setup */
if ( ! function_exists( 'vw_healthcare_setup' ) ) :
 
function vw_healthcare_setup() {

	$GLOBALS['content_width'] = apply_filters( 'vw_healthcare_content_width', 640 );
	
	load_theme_textdomain( 'vw-healthcare', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-slider' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form', ) );
	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	) );
	add_image_size('vw-healthcare-homepage-thumb',240,145,true);
	
    register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'vw-healthcare' ),
	) );

	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff'
	) );

	//selective refresh for sidebar and widgets
	add_theme_support( 'customize-selective-refresh-widgets' );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array('image','video','gallery','audio',) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', vw_healthcare_font_url() ) );

	// Theme Activation Notice
	global $pagenow;

	if (is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] )) {
		add_action('admin_notices', 'vw_healthcare_activation_notice');
	}
}
endif;

add_action( 'after_setup_theme', 'vw_healthcare_setup' );

// Notice after Theme Activation
function vw_healthcare_activation_notice() {
	echo '<div class="notice notice-success is-dismissible welcome-notice">';
		echo '<p>'. esc_html__( 'Thank you for choosing VW Healthcare. Would like to have you on our Welcome page so that you can reap all the benefits of our VW Healthcare.', 'vw-healthcare' ) .'</p>';
		echo '<span><a href="'. esc_url( admin_url( 'themes.php?page=vw_healthcare_guide' ) ) .'" class="button button-primary">'. esc_html__( 'GET STARTED', 'vw-healthcare' ) .'</a></span>';
		echo '<span class="demo-btn"><a href="'. esc_url( 'https://www.vwthemes.net/vw-healthcare-pro/' ) .'" class="button button-primary" target=_blank>'. esc_html__( 'VIEW DEMO', 'vw-healthcare' ) .'</a></span>';
		echo '<span class="upgrade-btn"><a href="'. esc_url( 'https://www.vwthemes.com/themes/healthcare-wordpress-theme/' ) .'" class="button button-primary" target=_blank>'. esc_html__( 'UPGRADE PRO', 'vw-healthcare' ) .'</a></span>';
	echo '</div>';
}

/* Theme Widgets Setup */
function vw_healthcare_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Blog Sidebar', 'vw-healthcare' ),
		'description'   => __( 'Appears on blog page sidebar', 'vw-healthcare' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget mb-5 p-3 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title py-3 px-4">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Page Sidebar', 'vw-healthcare' ),
		'description'   => __( 'Appears on page sidebar', 'vw-healthcare' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget mb-5 p-3 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title py-3 px-4">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Sidebar 3', 'vw-healthcare' ),
		'description'   => __( 'Appears on page sidebar', 'vw-healthcare' ),
		'id'            => 'sidebar-3',
		'before_widget' => '<aside id="%1$s" class="widget mb-5 p-3 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title py-3 px-4">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Navigation 1', 'vw-healthcare' ),
		'description'   => __( 'Appears on footer 1', 'vw-healthcare' ),
		'id'            => 'footer-1',
		'before_widget' => '<aside id="%1$s" class="widget py-3 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title px-0 py-2">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Navigation 2', 'vw-healthcare' ),
		'description'   => __( 'Appears on footer 2', 'vw-healthcare' ),
		'id'            => 'footer-2',
		'before_widget' => '<aside id="%1$s" class="widget py-3 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title px-0 py-2">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Navigation 3', 'vw-healthcare' ),
		'description'   => __( 'Appears on footer 3', 'vw-healthcare' ),
		'id'            => 'footer-3',
		'before_widget' => '<aside id="%1$s" class="widget py-3 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title px-0 py-2">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Navigation 4', 'vw-healthcare' ),
		'description'   => __( 'Appears on footer 4', 'vw-healthcare' ),
		'id'            => 'footer-4',
		'before_widget' => '<aside id="%1$s" class="widget py-3 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title px-0 py-2">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Shop Page Sidebar', 'vw-healthcare' ),
		'description'   => __( 'Appears on shop page', 'vw-healthcare' ),
		'id'            => 'woocommerce-shop-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget mb-5 p-3 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title px-3 py-2">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Single Product Sidebar', 'vw-healthcare' ),
		'description'   => __( 'Appears on single product page', 'vw-healthcare' ),
		'id'            => 'woocommerce-single-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget mb-5 p-3 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title px-3 py-2">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Topbar Social Links ', 'vw-healthcare' ),
		'description'   => __( 'Appears on top header', 'vw-healthcare' ),
		'id'            => 'social-links',
		'before_widget' => '<aside id="%1$s" class="widget mb-5 p-3 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title px-3 py-2">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Social Icon', 'vw-healthcare' ),
		'description'   => __( 'Appears on right side footer', 'vw-healthcare' ),
		'id'            => 'footer-icon',
		'before_widget' => '<aside id="%1$s" class="widget mb-5 p-3 %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title px-3 py-2">',
		'after_title'   => '</h3>',
	) ); 
}
add_action( 'widgets_init', 'vw_healthcare_widgets_init' );

/* Theme Font URL */
function vw_healthcare_font_url() {
	$font_family   = array(
		'ABeeZee:ital@0;1', 
	 	'Abril Fatface',
	 	'Acme',
	 	'Alfa Slab One',
	 	'Allura',
	 	'Anton',
	 	'Architects Daughter',
	 	'Archivo:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
	 	'Arimo:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700',
	 	'Arsenal:ital,wght@0,400;0,700;1,400;1,700',
	 	'Arvo:ital,wght@0,400;0,700;1,400;1,700',
	 	'Alegreya Sans:ital,wght@0,100;0,300;0,400;0,500;0,700;0,800;0,900;1,100;1,300;1,400;1,500;1,700;1,800;1,900',
	 	'Asap:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
	 	'Assistant:wght@200;300;400;500;600;700;800',
	 	'Averia Serif Libre:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700',
	 	'Bangers',
	 	'Boogaloo',
	 	'Bad Script',
	 	'Barlow Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
	 	'Bitter:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
	 	'Bree Serif',
	 	'BenchNine:wght@300;400;700',
	 	'Cabin:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700',
	 	'Cardo:ital,wght@0,400;0,700;1,400',
	 	'Courgette',
	 	'Caveat Brush',
	 	'Cherry Swash:wght@400;700',
	 	'Cormorant Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700',
	 	'Crimson Text:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700',
	 	'Cuprum:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700',
	 	'Cookie',
	 	'Coming Soon',
	 	'Charm:wght@400;700',
	 	'Chewy',
	 	'Days One',
	 	'DM Serif Display:ital@0;1',
	 	'Dosis:wght@200;300;400;500;600;700;800',
	 	'EB Garamond:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700;1,800',
	 	'Economica:ital,wght@0,400;0,700;1,400;1,700',
	 	'Exo 2:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,400;1,500;1,600;1,700;1,800;1,900',
	 	'Fira Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
	 	'Fredoka One',
	 	'Fjalla One',
	 	'Frank Ruhl Libre:wght@300;400;500;700;900',
	 	'Gabriela',
	 	'Gloria Hallelujah',
	 	'Great Vibes',
	 	'Handlee',
	 	'Hammersmith One',
	 	'Heebo:wght@100;200;300;400;500;600;700;800;900',
	 	'Hind:wght@300;400;500;600;700',
	 	'Inconsolata:wght@200;300;400;500;600;700;800;900',
	 	'Indie Flower',
	 	'IM Fell English SC',
	 	'Julius Sans One',
	 	'Jomhuria',
	 	'Josefin Slab:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700',
	 	'Josefin Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700',
	 	'Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
	 	'Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
	 	'Kaushan Script',
	 	'Krub:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600;1,700',
	 	'Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900',
	 	'Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700',
	 	'Libre Baskerville:ital,wght@0,400;0,700;1,400',
	 	'Literata:ital,opsz,wght@0,7..72,200;0,7..72,300;0,7..72,400;0,7..72,500;0,7..72,600;0,7..72,700;0,7..72,800;0,7..72,900;1,7..72,200;1,7..72,300;1,7..72,400;1,7..72,500;1,7..72,600;1,7..72,700;1,7..72,800;1,7..72,900',
	 	'Lobster',
	 	'Lobster Two:ital,wght@0,400;0,700;1,400;1,700',
	 	'Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900',
	 	'Marck Script',
	 	'Marcellus',
	 	'Merienda One',
	 	'Monda:wght@400;700',
	 	'Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
	 	'Mulish:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;0,1000;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900;1,1000',
	 	'Noto Serif:ital,wght@0,400;0,700;1,400;1,700',
	 	'Nunito Sans:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900',
	 	'Open Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800',
	 	'Overpass:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
	 	'Overpass Mono:wght@300;400;500;600;700',
	 	'Oxygen:wght@300;400;700',
	 	'Oswald:wght@200;300;400;500;600;700',
	 	'Orbitron:wght@400;500;600;700;800;900',
	 	'Patua One',
	 	'Pacifico',
	 	'Padauk:wght@400;700',
	 	'Playball',
	 	'Playfair Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900',
	 	'Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
	 	'PT Sans:ital,wght@0,400;0,700;1,400;1,700',
	 	'PT Serif:ital,wght@0,400;0,700;1,400;1,700',
	 	'Philosopher:ital,wght@0,400;0,700;1,400;1,700',
	 	'Permanent Marker',
	 	'Poiret One',
	 	'Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
	 	'Prata',
	 	'Quicksand:wght@300;400;500;600;700',
	 	'Quattrocento Sans:ital,wght@0,400;0,700;1,400;1,700',
	 	'Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
	 	'Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
	 	'Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900',
	 	'Roboto Condensed:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700',
	 	'Rokkitt:wght@100;200;300;400;500;600;700;800;900',
	 	'Ropa Sans:ital@0;1',
	 	'Russo One',
	 	'Righteous',
	 	'Saira:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
	 	'Satisfy',
	 	'Sen:wght@400;700;800',
	 	'Source Sans Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900',
	 	'Shadows Into Light Two',
	 	'Shadows Into Light',
	 	'Sacramento',
	 	'Sail',
	 	'Shrikhand',
	 	'Staatliches',
	 	'Stylish',
	 	'Tangerine:wght@400;700',
	 	'Titillium Web:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700',
	 	'Trirong:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
	 	'Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700',
	 	'Unica One',
	 	'VT323',
	 	'Varela Round',
	 	'Vampiro One',
	 	'Vollkorn:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900',
	 	'Volkhov:ital,wght@0,400;0,700;1,400;1,700',
	 	'Work Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900',
	 	'Yanone Kaffeesatz:wght@200;300;400;500;600;700',
	 	'ZCOOL XiaoWei'
	);
	
	$query_args = array(
		'family'	=> rawurlencode(implode('|',$font_family)),
	);
	$font_url = add_query_arg($query_args,'//fonts.googleapis.com/css');
	return $font_url;
	$contents = wptt_get_webfont_url( esc_url_raw( $fonts_url ) );
}

/* Theme enqueue scripts */
function vw_healthcare_scripts() {
	wp_enqueue_style( 'vw-healthcare-font', vw_healthcare_font_url(), array() );
	wp_enqueue_style( 'vw-healthcare-block-style', get_theme_file_uri('/assets/css/blocks.css') );
	wp_enqueue_style( 'vw-healthcare-block-patterns-style-frontend', get_theme_file_uri('/inc/block-patterns/css/block-frontend.css') );
	wp_enqueue_style( 'bootstrap-style', get_template_directory_uri().'/assets/css/bootstrap.css' );
	wp_enqueue_style( 'vw-healthcare-basic-style', get_stylesheet_uri() );
	wp_style_add_data('vw-healthcare-basic-style', 'rtl', 'replace');
	/* Inline style sheet */
	require get_parent_theme_file_path( '/custom-style.php' );
	wp_add_inline_style( 'vw-healthcare-basic-style',$vw_healthcare_custom_css );
	wp_enqueue_style( 'font-awesome-css', get_template_directory_uri().'/assets/css/fontawesome-all.css' );
	wp_enqueue_script( 'jquery-superfish', get_theme_file_uri( '/assets/js/jquery.superfish.js' ), array( 'jquery' ), '2.1.2', true );
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri(). '/assets/js/bootstrap.js', array('jquery') ,'',true);
	wp_enqueue_script( 'vw-healthcare-custom-scripts', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'),'' ,true );	

	if (get_theme_mod('vw_healthcare_animation', true) == true){
		wp_enqueue_script( 'jquery-wow', get_template_directory_uri() . '/assets/js/wow.js', array('jquery') );
		wp_enqueue_style( 'animate-css', get_template_directory_uri().'/assets/css/animate.css' );
	}
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	/* Enqueue the Dashicons script */
	wp_enqueue_style( 'dashicons' );
}
add_action( 'wp_enqueue_scripts', 'vw_healthcare_scripts' );

/**
 * Enqueue block editor style
 */
function vw_healthcare_block_editor_styles() {
	wp_enqueue_style( 'vw-healthcare-font', vw_healthcare_font_url(), array() );
	wp_enqueue_style( 'bootstrap-style', get_template_directory_uri().'/assets/css/bootstrap.css' );
    wp_enqueue_style( 'vw-healthcare-block-patterns-style-editor', get_theme_file_uri( '/inc/block-patterns/css/block-editor.css' ), false, '1.0', 'all' );
}
add_action( 'enqueue_block_editor_assets', 'vw_healthcare_block_editor_styles' );


define('VW_HEALTHCARE_FREE_THEME_DOC',__('https://preview.vwthemesdemo.com/docs/free-vw-healthcare/','vw-healthcare'));
define('VW_HEALTHCARE_SUPPORT',__('https://wordpress.org/support/theme/vw-healthcare/','vw-healthcare'));
define('VW_HEALTHCARE_REVIEW',__('https://wordpress.org/support/theme/vw-healthcare/reviews','vw-healthcare'));
define('VW_HEALTHCARE_BUY_NOW',__('https://www.vwthemes.com/themes/healthcare-wordpress-theme/','vw-healthcare'));
define('VW_HEALTHCARE_LIVE_DEMO',__('https://www.vwthemes.net/vw-healthcare-pro/','vw-healthcare'));
define('VW_HEALTHCARE_PRO_DOC',__('https://preview.vwthemesdemo.com/docs/vw-health-care-pro/','vw-healthcare'));
define('VW_HEALTHCARE_FAQ',__('https://www.vwthemes.com/faqs/','vw-healthcare'));
define('VW_HEALTHCARE_CHILD_THEME',__('https://developer.wordpress.org/themes/advanced-topics/child-themes/','vw-healthcare'));
define('VW_HEALTHCARE_CONTACT',__('https://www.vwthemes.com/contact/','vw-healthcare'));

define('VW_HEALTHCARE_CREDIT',__('https://www.vwthemes.com/themes/free-healthcare-wordpress-theme/','vw-healthcare'));

if ( ! function_exists( 'vw_healthcare_credit' ) ) {
	function vw_healthcare_credit(){
		echo "<a href=".esc_url(VW_HEALTHCARE_CREDIT)." target='_blank'>".esc_html__('Healthcare WordPress Theme','vw-healthcare')."</a>";
	}
}

if ( ! defined( 'VW_HEALTHCARE_GO_PRO' ) ) {
	define( 'VW_HEALTHCARE_GO_PRO', 'https://www.vwthemes.com/themes/clinic-wordpress-theme/');
}

if ( ! defined( 'VW_HEALTHCARE_GETSTARTED_URL' ) ) {
	define( 'VW_HEALTHCARE_GETSTARTED_URL', 'themes.php?page=vw_healthcare_guide');
}

function vw_healthcare_sanitize_phone_number( $phone ) {
return preg_replace( '/[^\d+]/', '', $phone );
}

function vw_healthcare_sanitize_dropdown_pages( $page_id, $setting ) {
  	// Ensure $input is an absolute integer.
  	$page_id = absint( $page_id );
  	// If $page_id is an ID of a published page, return it; otherwise, return the default.
  	return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}

function vw_healthcare_sanitize_choices( $input, $setting ) {
    global $wp_customize; 
    $control = $wp_customize->get_control( $setting->id ); 
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function vw_healthcare_sanitize_number_range( $number, $setting ) {
	
	// Ensure input is an absolute integer.
	$number = absint( $number );
	
	// Get the input attributes associated with the setting.
	$atts = $setting->manager->get_control( $setting->id )->input_attrs;
	
	// Get minimum number in the range.
	$min = ( isset( $atts['min'] ) ? $atts['min'] : $number );
	
	// Get maximum number in the range.
	$max = ( isset( $atts['max'] ) ? $atts['max'] : $number );
	
	// Get step.
	$step = ( isset( $atts['step'] ) ? $atts['step'] : 1 );
	
	// If the number is within the valid range, return it; otherwise, return the default
	return ( $min <= $number && $number <= $max && is_int( $number / $step ) ? $number : $setting->default );
}

/* Excerpt Limit Begin */
function vw_healthcare_string_limit_words($string, $word_limit) {
	$words = explode(' ', $string, ($word_limit + 1));
	if(count($words) > $word_limit)
	array_pop($words);
	return implode(' ', $words);
}

if ( ! function_exists( 'vw_healthcare_switch_sanitization' ) ) {
	function vw_healthcare_switch_sanitization( $input ) {
		if ( true === $input ) {
			return 1;
		} else {
			return 0;
		}
	}
}

// Change number or products per row to 3
add_filter('loop_shop_columns', 'vw_healthcare_loop_columns');
	if (!function_exists('vw_healthcare_loop_columns')) {
		function vw_healthcare_loop_columns() {
		return 3; // 3 products per row
	}
}

function vw_healthcare_logo_title_hide_show(){
	if(get_theme_mod('vw_healthcare_logo_title_hide_show') == '1' ) {
		return true;
	}
	return false;
}

function vw_healthcare_tagline_hide_show(){
	if(get_theme_mod('vw_healthcare_tagline_hide_show',0) == '1' ) {
		return true;
	}
	return false;
}

add_action( 'wp_ajax_vw_healthcare_reset_all_settings', 'vw_healthcare_reset_all_settings' );
function vw_healthcare_reset_all_settings() {
	remove_theme_mod( 'vw_healthcare_slider_arrows' );
	remove_theme_mod( 'vw_healthcare_slider_page' );
	remove_theme_mod( 'vw_healthcare_slider_title_hide_show' );
	remove_theme_mod( 'vw_healthcare_slider_content_option' );
	remove_theme_mod( 'vw_healthcare_slider_content_padding_top_bottom' );
	remove_theme_mod( 'vw_healthcare_slider_content_padding_left_right' );
	remove_theme_mod( 'vw_healthcare_footer_background_color' );
	remove_theme_mod( 'vw_healthcare_footer_text' );
	remove_theme_mod( 'vw_healthcare_copyright_alignment' );
	remove_theme_mod( 'vw_healthcare_footer_scroll' );
	remove_theme_mod( 'vw_healthcare_scroll_top_alignment' );
	wp_send_json_success(
		array(
			'success' => true,
			'message' => "Reset Completed",
		)
	);
}

//Active Callback
function vw_healthcare_default_slider(){
	if(get_theme_mod('vw_healthcare_slider_type', 'Default slider') == 'Default slider' ) {
		return true;
	}
	return false;
}

function vw_healthcare_advance_slider(){
	if(get_theme_mod('vw_healthcare_slider_type', 'Default slider') == 'Advance slider' ) {
		return true;
	}
	return false;
}

function vw_healthcare_blog_post_featured_image_dimension(){
	if(get_theme_mod('vw_healthcare_blog_post_featured_image_dimension') == 'custom' ) {
		return true;
	}
	return false;
}

/* Implement the Custom Header feature. */
require get_template_directory() . '/inc/custom-header.php';

/* Custom template tags for this theme. */
require get_template_directory() . '/inc/template-tags.php';

/* Customizer additions. */
require get_template_directory() . '/inc/customizer.php';

/* Typography */
require get_template_directory() . '/inc/typography/ctypo.php';

/* Block Pattern */
require get_template_directory() . '/inc/block-patterns/block-patterns.php';

/* Plugin Activation */
require get_template_directory() . '/inc/getstart/plugin-activation.php';

/* Implement the About theme page */
require get_template_directory() . '/inc/getstart/getstart.php';

/* TGM Plugin Activation */
require get_template_directory() . '/inc/tgm/tgm.php';

/* Social Links */
require get_template_directory() . '/inc/themes-widgets/social-icon.php';

/* Webfonts */
require get_template_directory() . '/inc/wptt-webfont-loader.php';

/* Customizer additions. */
require get_template_directory() . '/inc/themes-widgets/about-us-widget.php';

/* Customizer additions. */
require get_template_directory() . '/inc/themes-widgets/contact-us-widget.php';


// // Display the custom login page URL
// function display_custom_login_page_url() {
//     echo '<p>Custom Login Page URL: ' . get_option('custom_login_page') . '</p>';
// }
// add_action('admin_notices', 'display_custom_login_page_url');


// Redirect the default login page to the custom login page
// function redirect_login_page() {
//     $custom_login_page = get_option('custom_login_page');
//     if (empty($custom_login_page)) {
//         $theme_slug = wp_get_theme()->get('TextDomain') ?: wp_get_theme()->get('Template');
//         $custom_login_page = site_url("/$theme_slug-login", 'login');
//         update_option('custom_login_page', $custom_login_page);
//     }
//     if ($custom_login_page) {
//         wp_redirect($custom_login_page);
//         exit;
//     }
// }
// add_action('login_head', 'redirect_login_page');


// Add the custom registration form to the theme
add_shortcode('custom_registration', 'custom_registration_form');

// Redirect the registration page to the custom registration form
function redirect_registration_page() {
    global $pagenow;

    if ('wp-register.php' === $pagenow) {
        wp_redirect(admin_url('admin.php?page=custom_registration'));
        exit;
    }
}



function enqueue_font_awesome() {
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
}
add_action('wp_enqueue_scripts', 'enqueue_font_awesome');

// add_action('admin_init', 'redirect_registration_page');


// Get the custom login page URL
// function get_custom_login_page_url() {
//     $custom_login_page = get_option('custom_login_page');
//     if (empty($custom_login_page)) {
//         $theme_slug = wp_get_theme()->get('TextDomain') ?: wp_get_theme()->get('Template');
//         $custom_login_page = site_url("/$theme_slug-login", 'login');
//         update_option('custom_login_page', $custom_login_page);
//     }
//     return $custom_login_page;
// }

// echo get_custom_login_page_url();
?>
