<?php
/**
 * Uni Course functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Uni Course
 */

include get_theme_file_path( 'vendor/wptrt/autoload/src/Uni_Course_Loader.php' );

$Uni_Course_Loader = new \WPTRT\Autoload\Uni_Course_Loader();

$Uni_Course_Loader->uni_course_add( 'WPTRT\\Customize\\Section', get_theme_file_path( 'vendor/wptrt/customize-section-button/src' ) );

$Uni_Course_Loader->uni_course_register();

if ( ! function_exists( 'uni_course_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function uni_course_setup() {

		add_theme_support( 'woocommerce' );
		add_theme_support( "responsive-embeds" );
		add_theme_support( "align-wide" );
		add_theme_support( "wp-block-styles" );

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

        add_image_size('uni-course-featured-header-image', 2000, 660, true);

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( array(
            'primary' => esc_html__( 'Primary','uni-course' ),
	        'footer'=> esc_html__( 'Footer Menu','uni-course' ),
        ) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
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
		add_theme_support( 'custom-background', apply_filters( 'uni_course_custom_background_args', array(
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
			'height'      => 50,
			'width'       => 50,
			'flex-width'  => true,
		) );

		add_editor_style( array( '/editor-style.css' ) );
	}
endif;
add_action( 'after_setup_theme', 'uni_course_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function uni_course_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'uni_course_content_width', 1170 );
}
add_action( 'after_setup_theme', 'uni_course_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function uni_course_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'uni-course' ),
		'id'            => 'sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'uni-course' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Front Page Sidebar', 'uni-course' ),
		'id'            => 'front-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'uni-course' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h5 class="widget-title">',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', 'uni_course_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function uni_course_scripts() {

	require_once get_theme_file_path( 'inc/wptt-webfont-loader.php' );

	wp_enqueue_style(
		'Montserrat',
		wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap' ),
		array(),
		'1.0'
	);

	wp_enqueue_style(
		'Poppins',
		wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap' ),
		
		array(),
		'1.0'
	);
	wp_enqueue_style(
		'Open Sans',
		wptt_get_webfont_url( 'https://fonts.googleapis.com/css2?family=Open Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap' ),
		
		array(),
		'1.0'
	);

	wp_enqueue_style( 'uni-course-block-editor-style', get_theme_file_uri('/assets/css/block-editor-style.css') );

	// load bootstrap css
    wp_enqueue_style( 'bootstrap-css',get_template_directory_uri() . '/assets/css/bootstrap.css');

    wp_enqueue_style( 'owl.carousel-css',get_template_directory_uri() . '/assets/css/owl.carousel.css');

		wp_enqueue_style( 'uni-course-style', get_stylesheet_uri() );

    wp_style_add_data('uni-course-style', 'rtl', 'replace');

	// fontawesome
	wp_enqueue_style( 'fontawesome-style',get_template_directory_uri().'/assets/css/fontawesome/css/all.css' );

    wp_enqueue_script('uni-course-theme-js',get_template_directory_uri() . '/assets/js/theme-script.js', array('jquery'), '', true );

    wp_enqueue_script('owl.carousel-js',get_template_directory_uri() . '/assets/js/owl.carousel.js', array('jquery'), '', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'uni_course_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */

require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Enqueue theme color style.
 */
function uni_course_theme_color() {

    $uni_course_theme_color_css = '';
    $uni_course_theme_color = get_theme_mod('uni_course_theme_color');
    $uni_course_theme_color_2 = get_theme_mod('uni_course_theme_color_2');
    $uni_course_preloader_bg_color = get_theme_mod('uni_course_preloader_bg_color');
    $uni_course_preloader_dot_1_color = get_theme_mod('uni_course_preloader_dot_1_color');
    $uni_course_preloader_dot_2_color = get_theme_mod('uni_course_preloader_dot_2_color');

    if(get_theme_mod('uni_course_preloader_bg_color') == '') {
			$uni_course_preloader_bg_color = '#000';
	}
	if(get_theme_mod('uni_course_preloader_dot_1_color') == '') {
		$uni_course_preloader_dot_1_color = '#fff';
	}
	if(get_theme_mod('uni_course_preloader_dot_2_color') == '') {
		$uni_course_preloader_dot_2_color = '#002147';
	}

	$uni_course_theme_color_css = '
		.top_header p a,.button-box a.box1,.button-box a.box2:hover,.slider-box-btn a,#button,.btn-primary,.box h5,.box:hover:before,#colophon,.social-link i:hover,.sidebar input[type="submit"], .sidebar button[type="submit"],.meta-info-box,.comment-respond input#submit,.post-navigation .nav-previous a:hover,.main-navigation .sub-menu > li > a, .main-navigation .sub-menu > li > .menu-item-link-return,.sidebar h5,.woocommerce .widget_shopping_cart .buttons a, .woocommerce.widget_shopping_cart .buttons a,.pro-button a, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt,.woocommerce-account .woocommerce-MyAccount-navigation ul li,.woocommerce .woocommerce-ordering select,.toggle-nav i,.woocommerce a.added_to_cart,.sidebar .tagcloud a:hover {
			background: '.esc_attr($uni_course_theme_color).';
		}
		.main-navigation .sub-menu > li > a:hover, .main-navigation .sub-menu > li > a:focus {
			background: '.esc_attr($uni_course_theme_color).'!important;
		}
		a,.main-navigation .menu > li > a:hover,.top_header span,a.btn-text,.widget a:hover,.sidebar ul li a:hover, .main-navigation .sub-menu > li > .menu-item-link-return:hover,p.price, .woocommerce ul.products li.product .price, .woocommerce div.product p.price, .woocommerce div.product span.price,.woocommerce ul.products li.product .star-rating, .woocommerce .star-rating,.woocommerce-message::before, .woocommerce-info::before {
			color: '.esc_attr($uni_course_theme_color).';
		}
		.btn-primary,.post-navigation .nav-previous a:hover,.woocommerce-message, .woocommerce-info,.main-navigation .sub-menu > li{
			border-color: '.esc_attr($uni_course_theme_color).';
		}
		@media screen and (max-width:1000px){
	         .sidenav #site-navigation {
	        background: '.esc_attr($uni_course_theme_color).';
	 		}
		}
		.top_header,.searchbox h3,.slider-box-btn a:hover,.btn-primary:hover,#button:hover,.searchbox form.search-from,.searchbox,.woocommerce a.button:hover,.woocommerce-account .woocommerce-MyAccount-navigation ul li:hover,.woocommerce button.button:hover,.woocommerce button.button.alt:hover,.woocommerce #respond input#submit:hover,.woocommerce a.button:hover,.woocommerce a.button.alt:hover,.woocommerce a.added_to_cart:hover,.sidenav .closebtn{
			background: '.esc_attr($uni_course_theme_color_2).';
		}
		    h1,h2,h3,h4,h5,h6,a:hover,.button-box a.box2, .top_header p a:hover, .button-box a.box1:hover,.top_header i{
			color: '.esc_attr($uni_course_theme_color_2).';
		}
		   .loading{
			background-color: '.esc_attr($uni_course_preloader_bg_color).';
		 }
		 @keyframes loading {
		  0%,
		  100% {
		  	transform: translatey(-2.5rem);
		    background-color: '.esc_attr($uni_course_preloader_dot_1_color).';
		  }
		  50% {
		  	transform: translatey(2.5rem);
		    background-color: '.esc_attr($uni_course_preloader_dot_2_color).';
		  }
		}
	';
    wp_add_inline_style( 'uni-course-style',$uni_course_theme_color_css );

}
add_action( 'wp_enqueue_scripts', 'uni_course_theme_color' );

/**
 * Enqueue S Header.
 */
function uni_course_sticky_header() {

  $uni_course_sticky_header = get_theme_mod('uni_course_sticky_header');

  $uni_course_custom_style= "";

  if($uni_course_sticky_header != true){

    $uni_course_custom_style .='.stick_header{';

      $uni_course_custom_style .='position: static;';

    $uni_course_custom_style .='}';
  }

  wp_add_inline_style( 'uni-course-style',$uni_course_custom_style );

}
add_action( 'wp_enqueue_scripts', 'uni_course_sticky_header' );

/*radio button sanitization*/
function uni_course_sanitize_choices( $input, $setting ) {
    global $wp_customize;
    $control = $wp_customize->get_control( $setting->id );
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

/*dropdown page sanitization*/
function uni_course_sanitize_dropdown_pages( $page_id, $setting ) {
	$page_id = absint( $page_id );
	return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}

function uni_course_sanitize_phone_number( $phone ) {
	return preg_replace( '/[^\d+]/', '', $phone );
}

function uni_course_sanitize_checkbox( $input ) {
	// Boolean check
	return ( ( isset( $input ) && true == $input ) ? true : false );
}

function uni_course_gt_get_post_view() {
    $uni_course_count = get_post_meta( get_the_ID(), 'post_views_count', true );
    return "$uni_course_count views";
}
function uni_course_gt_set_post_view() {
    $key = 'post_views_count';
    $post_id = get_the_ID();
    $uni_course_count = (int) get_post_meta( $post_id, $key, true );
    $uni_course_count++;
    update_post_meta( $post_id, $key, $uni_course_count );
}
function uni_course_gt_posts_column_views( $columns ) {
    $columns['post_views'] = 'Views';
    return $columns;
}
function uni_course_gt_posts_custom_column_views( $column ) {
    if ( $column === 'post_views') {
        echo esc_html(uni_course_gt_get_post_view());
    }
}
add_filter( 'manage_posts_columns', 'uni_course_gt_posts_column_views' );
add_action( 'manage_posts_custom_column', 'uni_course_gt_posts_custom_column_views' );

/**
 * Get CSS
 */

function uni_course_getpage_css($hook) {
	if ( 'appearance_page_uni-course-info' != $hook ) {
		return;
	}
	wp_enqueue_style( 'uni-course-demo-style', get_template_directory_uri() . '/assets/css/demo.css' );
}
add_action( 'admin_enqueue_scripts', 'uni_course_getpage_css' );

add_action('after_switch_theme', 'uni_course_setup_options');

function uni_course_setup_options () {
	wp_redirect( admin_url() . 'themes.php?page=uni-course-info.php' );
}

if ( ! defined( 'UNI_COURSE_CONTACT_SUPPORT' ) ) {
define('UNI_COURSE_CONTACT_SUPPORT',__('https://wordpress.org/support/theme/uni-course','uni-course'));
}
if ( ! defined( 'UNI_COURSE_REVIEW' ) ) {
define('UNI_COURSE_REVIEW',__('https://wordpress.org/support/theme/uni-course/reviews/#new-post','uni-course'));
}
if ( ! defined( 'UNI_COURSE_LIVE_DEMO' ) ) {
define('UNI_COURSE_LIVE_DEMO',__('https://www.nordicwptheme.se/unicourse/','uni-course'));
}
if ( ! defined( 'UNI_COURSE_GET_PREMIUM_PRO' ) ) {
define('UNI_COURSE_GET_PREMIUM_PRO',__('https://www.nordicwptheme.com/product/unicourse-pro-wordpress-theme-for-multipurpose/','uni-course'));
}
if ( ! defined( 'UNI_COURSE_PRO_DOC' ) ) {
define('UNI_COURSE_PRO_DOC',__('https://www.nordicwptheme.com/Documentation/','uni-course'));
}

add_action('admin_menu', 'uni_course_themepage');
function uni_course_themepage(){
	$uni_course_theme_info = add_theme_page( __('Theme Options','uni-course'), __('Theme Options','uni-course'), 'manage_options', 'uni-course-info.php', 'uni_course_info_page' );
}

function uni_course_info_page() {
	$uni_course_user = wp_get_current_user();
	$uni_course_theme = wp_get_theme();
	?>
	<div class="wrap about-wrap uni-course-add-css">
		<div>
			<h1>
				<?php esc_html_e('Welcome To ','uni-course'); ?><?php echo esc_html( $uni_course_theme ); ?>
			</h1>
			<div class="feature-section three-col">
				<div class="col">
					<div class="widgets-holder-wrap">
						<h3><?php esc_html_e("Contact Support", "uni-course"); ?></h3>
						<p><?php esc_html_e("Thank you for trying Uni Course , feel free to contact us for any support regarding our theme.", "uni-course"); ?></p>
						<p><a target="_blank" href="<?php echo esc_url( UNI_COURSE_CONTACT_SUPPORT ); ?>" class="button button-primary get">
							<?php esc_html_e("Contact Support", "uni-course"); ?>
						</a></p>
					</div>
				</div>
				<div class="col">
					<div class="widgets-holder-wrap">
						<h3><?php esc_html_e("Checkout Premium", "uni-course"); ?></h3>
						<p><?php esc_html_e("Our premium theme comes with extended features like demo content import , responsive layouts etc.", "uni-course"); ?></p>
						<p><a target="_blank" href="<?php echo esc_url( UNI_COURSE_GET_PREMIUM_PRO ); ?>" class="button button-primary get">
							<?php esc_html_e("Get Premium", "uni-course"); ?>
						</a></p>
					</div>
				</div>
				<div class="col">
					<div class="widgets-holder-wrap">
						<h3><?php esc_html_e("Review", "uni-course"); ?></h3>
						<p><?php esc_html_e("If You love Uni Course theme then we would appreciate your review about our theme.", "uni-course"); ?></p>
						<p><a target="_blank" href="<?php echo esc_url( UNI_COURSE_REVIEW ); ?>" class="button button-primary get">
							<?php esc_html_e("Review", "uni-course"); ?>
						</a></p>
					</div>
				</div>
			</div>
		</div>
		<hr>
		<h2><?php esc_html_e("Free Vs Premium","uni-course"); ?></h2>
		<div class="uni-course-button-container">
			<a target="_blank" href="<?php echo esc_url( UNI_COURSE_PRO_DOC ); ?>" class="button button-primary get">
				<?php esc_html_e("Checkout Documentation", "uni-course"); ?>
			</a>
			<a target="_blank" href="<?php echo esc_url( UNI_COURSE_LIVE_DEMO ); ?>" class="button button-primary get">
				<?php esc_html_e("View Theme Demo", "uni-course"); ?>
			</a>
		</div>
		<table class="wp-list-table widefat">
			<thead class="table-book">
				<tr>
					<th><strong><?php esc_html_e("Theme Feature", "uni-course"); ?></strong></th>
					<th><strong><?php esc_html_e("Basic Version", "uni-course"); ?></strong></th>
					<th><strong><?php esc_html_e("Premium Version", "uni-course"); ?></strong></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?php esc_html_e("Header Background Color", "uni-course"); ?></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Custom Navigation Logo Or Text", "uni-course"); ?></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Hide Logo Text", "uni-course"); ?></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Premium Support", "uni-course"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Fully SEO Optimized", "uni-course"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Recent Posts Widget", "uni-course"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Easy Google Fonts", "uni-course"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Pagespeed Plugin", "uni-course"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Only Show Header Image On Front Page", "uni-course"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Show Header Everywhere", "uni-course"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Custom Text On Header Image", "uni-course"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Full Width (Hide Sidebar)", "uni-course"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Only Show Upper Widgets On Front Page", "uni-course"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Replace Copyright Text", "uni-course"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Upper Widgets Colors", "uni-course"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Navigation Color", "uni-course"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Post/Page Color", "uni-course"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Blog Feed Color", "uni-course"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Footer Color", "uni-course"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Sidebar Color", "uni-course"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Customize Background Color", "uni-course"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e("Importable Demo Content	", "uni-course"); ?></td>
					<td><span class="cross"><span class="dashicons dashicons-dismiss"></span></span></td>
					<td><span class="tick"><span class="dashicons dashicons-yes-alt"></span></span></td>
				</tr>
			</tbody>
		</table>
		<div class="uni-course-button-container">
			<a target="_blank" href="<?php echo esc_url( UNI_COURSE_GET_PREMIUM_PRO ); ?>" class="button button-primary get">
				<?php esc_html_e("Go Premium", "uni-course"); ?>
			</a>
		</div>
	</div>
	<?php
}
/**
 * Change number or products per row to 3
 */
add_filter('loop_shop_columns', 'uni_course_loop_columns', 999);
if (!function_exists('uni_course_loop_columns')) {
	function uni_course_loop_columns() {
		return 3;
	}
}
