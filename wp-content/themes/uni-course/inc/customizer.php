<?php
/**
 * Uni Course Theme Customizer
 *
 * @link: https://developer.wordpress.org/themes/customize-api/customizer-objects/
 *
 * @package Uni Course
 */

if ( ! defined( 'UNI_COURSE_URL' ) ) {
    define( 'UNI_COURSE_URL', esc_url( 'https://www.nordicwptheme.com/product/unicourse-pro-wordpress-theme-for-multipurpose/', 'uni-course') );
}
if ( ! defined( 'UNI_COURSE_TEXT' ) ) {
    define( 'UNI_COURSE_TEXT', __( 'Uni Course Pro','uni-course' ));
}
if ( ! defined( 'UNI_COURSE_BUY_TEXT' ) ) {
    define( 'UNI_COURSE_BUY_TEXT', __( 'Buy Uni Course Pro','uni-course' ));
}

use WPTRT\Customize\Section\Uni_Course_Button;

add_action( 'customize_register', function( $manager ) {

    $manager->register_section_type( Uni_Course_Button::class );

    $manager->add_section(
        new Uni_Course_Button( $manager, 'uni_course_pro', [
            'title'       => esc_html( UNI_COURSE_TEXT, 'uni-course' ),
            'priority'    => 0,
            'button_text' => __( 'GET PREMIUM', 'uni-course' ),
            'button_url'  => esc_url( UNI_COURSE_URL )
        ] )
    );

} );

// Load the JS and CSS.
add_action( 'customize_controls_enqueue_scripts', function() {

    $version = wp_get_theme()->get( 'Version' );

    wp_enqueue_script(
        'uni-course-customize-section-button',
        get_theme_file_uri( 'vendor/wptrt/customize-section-button/public/js/customize-controls.js' ),
        [ 'customize-controls' ],
        $version,
        true
    );

    wp_enqueue_style(
        'uni-course-customize-section-button',
        get_theme_file_uri( 'vendor/wptrt/customize-section-button/public/css/customize-controls.css' ),
        [ 'customize-controls' ],
        $version
    );

} );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function uni_course_customize_register($wp_customize){

    // Pro Version
    class Uni_Course_Customize_Pro_Version extends WP_Customize_Control {
        public $type = 'pro_options';

        public function render_content() {
            echo '<span>For More <strong>'. esc_html( $this->label ) .'</strong>?</span>';
            echo '<a href="'. esc_url($this->description) .'" target="_blank">';
                echo '<span class="dashicons dashicons-info"></span>';
                echo '<strong> '. esc_html( UNI_COURSE_BUY_TEXT,'uni-course' ) .'<strong></a>';
            echo '</a>';
        }
    }

    // Custom Controls
    function Uni_Course_sanitize_custom_control( $input ) {
        return $input;
    }

    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';

    $wp_customize->add_setting('uni_course_logo_title', array(
        'default' => true,
        'sanitize_callback' => 'uni_course_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'uni_course_logo_title',array(
        'label'          => __( 'Enable Disable Title', 'uni-course' ),
        'section'        => 'title_tagline',
        'settings'       => 'uni_course_logo_title',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('uni_course_theme_description', array(
        'default' => false,
        'sanitize_callback' => 'uni_course_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'uni_course_theme_description',array(
        'label'          => __( 'Enable Disable Tagline', 'uni-course' ),
        'section'        => 'title_tagline',
        'settings'       => 'uni_course_theme_description',
        'type'           => 'checkbox',
    )));


    $wp_customize->add_setting('uni_course_logo_title', array(
        'default' => true,
        'sanitize_callback' => 'uni_course_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'uni_course_logo_title',array(
        'label'          => __( 'Enable Disable Title', 'uni-course' ),
        'section'        => 'title_tagline',
        'settings'       => 'uni_course_logo_title',
        'type'           => 'checkbox',
    )));

    // General Settings
     $wp_customize->add_section('uni_course_general_settings',array(
        'title' => esc_html__('General Settings','uni-course'),
        'priority'   => 1,
    ));

    $wp_customize->add_setting('uni_course_preloader_hide', array(
        'default' => 0,
        'sanitize_callback' => 'uni_course_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'uni_course_preloader_hide',array(
        'label'          => __( 'Show Theme Preloader', 'uni-course' ),
        'section'        => 'uni_course_general_settings',
        'settings'       => 'uni_course_preloader_hide',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting( 'uni_course_preloader_bg_color', array(
        'default' => '#000',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'uni_course_preloader_bg_color', array(
        'label' => esc_html__('Preloader Background Color','uni-course'),
        'section' => 'uni_course_general_settings',
        'settings' => 'uni_course_preloader_bg_color'
    )));

    $wp_customize->add_setting( 'uni_course_preloader_dot_1_color', array(
        'default' => '#fff',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'uni_course_preloader_dot_1_color', array(
        'label' => esc_html__('Preloader First Dot Color','uni-course'),
        'section' => 'uni_course_general_settings',
        'settings' => 'uni_course_preloader_dot_1_color'
    )));

    $wp_customize->add_setting( 'uni_course_preloader_dot_2_color', array(
        'default' => '#002147',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'uni_course_preloader_dot_2_color', array(
        'label' => esc_html__('Preloader Second Dot Color','uni-course'),
        'section' => 'uni_course_general_settings',
        'settings' => 'uni_course_preloader_dot_2_color'
    )));

    $wp_customize->add_setting('uni_course_sticky_header', array(
        'default' => false,
        'sanitize_callback' => 'uni_course_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'uni_course_sticky_header',array(
        'label'          => __( 'Show Sticky Header', 'uni-course' ),
        'section'        => 'uni_course_general_settings',
        'settings'       => 'uni_course_sticky_header',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('uni_course_scroll_hide', array(
        'default' => false,
        'sanitize_callback' => 'uni_course_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'uni_course_scroll_hide',array(
        'label'          => __( 'Show Theme Scroll To Top', 'uni-course' ),
        'section'        => 'uni_course_general_settings',
        'settings'       => 'uni_course_scroll_hide',
        'type'           => 'checkbox',
    )));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_general_setting', array(
        'sanitize_callback' => 'Uni_Course_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Uni_Course_Customize_Pro_Version ( $wp_customize,'pro_version_general_setting', array(
        'section'     => 'uni_course_general_settings',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'uni-course' ),
        'description' => esc_url( UNI_COURSE_URL ),
        'priority'    => 100
    )));


    // Theme Color
    $wp_customize->add_section('uni_course_color_option',array(
        'title' => esc_html__('Theme Color','uni-course'),
        'priority' => 2,
    ));

    $wp_customize->add_setting( 'uni_course_theme_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'uni_course_theme_color', array(
        'label' => esc_html__('First Color Option','uni-course'),
        'section' => 'uni_course_color_option',
        'settings' => 'uni_course_theme_color'
    )));

    $wp_customize->add_setting( 'uni_course_theme_color_2', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'uni_course_theme_color_2', array(
        'label' => esc_html__('Second Color Option','uni-course'),
        'section' => 'uni_course_color_option',
        'settings' => 'uni_course_theme_color_2'
    )));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_theme_color', array(
        'sanitize_callback' => 'Uni_Course_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Uni_Course_Customize_Pro_Version ( $wp_customize,'pro_version_theme_color', array(
        'section'     => 'uni_course_color_option',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'uni-course' ),
        'description' => esc_url( UNI_COURSE_URL ),
        'priority'    => 100
    )));

    // Top Header
    $wp_customize->add_section('uni_course_top_header',array(
        'title' => esc_html__('Top Header','uni-course'),
    ));

    $wp_customize->add_setting('uni_course_top_header_setting', array(
        'default' => 0,
        'sanitize_callback' => 'uni_course_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'uni_course_top_header_setting',array(
        'label'          => __( 'Enable Disable Top Header', 'uni-course' ),
        'section'        => 'uni_course_top_header',
        'settings'       => 'uni_course_top_header_setting',
        'type'           => 'checkbox',
        'priority' => 1,
    )));

    $wp_customize->add_setting('uni_course_facebook_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('uni_course_facebook_icon',array(
        'label' => esc_html__('Social Icon','uni-course'),
        'section' => 'uni_course_top_header',
        'setting' => 'uni_course_facebook_icon',
        'type'  => 'text',
        'default' => 'fab fa-facebook-f',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fab fa-facebook-f','uni-course')
    ));

    $wp_customize->add_setting('uni_course_facebook_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('uni_course_facebook_url',array(
        'label' => esc_html__('Facebook Link','uni-course'),
        'section' => 'uni_course_top_header',
        'setting' => 'uni_course_facebook_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('uni_course_twitter_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('uni_course_twitter_icon',array(
        'label' => esc_html__('Social Icon','uni-course'),
        'section' => 'uni_course_top_header',
        'setting' => 'uni_course_twitter_icon',
        'type'  => 'text',
        'default' => 'fab fa-twitter',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fab fa-twitter','uni-course')
    ));

    $wp_customize->add_setting('uni_course_twitter_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('uni_course_twitter_url',array(
        'label' => esc_html__('Twitter Link','uni-course'),
        'section' => 'uni_course_top_header',
        'setting' => 'uni_course_twitter_url',
        'type'  => 'url'
    ));

     $wp_customize->add_setting('uni_course_instagram_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('uni_course_instagram_icon',array(
        'label' => esc_html__('Social Icon','uni-course'),
        'section' => 'uni_course_top_header',
        'setting' => 'uni_course_instagram_icon',
        'type'  => 'text',
        'default' => 'fab fa-instagram',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fab fa-instagram','uni-course')
    ));

    $wp_customize->add_setting('uni_course_intagram_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('uni_course_intagram_url',array(
        'label' => esc_html__('Intagram Link','uni-course'),
        'section' => 'uni_course_top_header',
        'setting' => 'uni_course_intagram_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('uni_course_linkedin_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('uni_course_linkedin_icon',array(
        'label' => esc_html__('Social Icon','uni-course'),
        'section' => 'uni_course_top_header',
        'setting' => 'uni_course_linkedin_icon',
        'type'  => 'text',
        'default' => 'fab fa-linkedin-in',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fab fa-linkedin-in','uni-course')
    ));

    $wp_customize->add_setting('uni_course_linkedin_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('uni_course_linkedin_url',array(
        'label' => esc_html__('Linkedin Link','uni-course'),
        'section' => 'uni_course_top_header',
        'setting' => 'uni_course_linkedin_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('uni_course_pinterest_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('uni_course_pinterest_icon',array(
        'label' => esc_html__('Social Icon','uni-course'),
        'section' => 'uni_course_top_header',
        'setting' => 'uni_course_pinterest_icon',
        'type'  => 'text',
        'default' => 'fab fa-pinterest-p',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fab fa-pinterest-p','uni-course')
    ));

    $wp_customize->add_setting('uni_course_pintrest_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('uni_course_pintrest_url',array(
        'label' => esc_html__('Pinterest Link','uni-course'),
        'section' => 'uni_course_top_header',
        'setting' => 'uni_course_pintrest_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('uni_course_ticket_text',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('uni_course_ticket_text',array(
        'label' => esc_html__('Ticket Text','uni-course'),
        'section' => 'uni_course_top_header',
        'setting' => 'uni_course_ticket_text',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('uni_course_ticket_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('uni_course_ticket_url',array(
        'label' => esc_html__('Ticket URL','uni-course'),
        'section' => 'uni_course_top_header',
        'setting' => 'uni_course_ticket_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('uni_course_phone_number',array(
        'default' => '',
        'sanitize_callback' => 'uni_course_sanitize_phone_number'
    ));
    $wp_customize->add_control('uni_course_phone_number',array(
        'label' => esc_html__('Phone Number','uni-course'),
        'section' => 'uni_course_top_header',
        'setting' => 'uni_course_phone_number',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('uni_course_email',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('uni_course_email',array(
        'label' => esc_html__('Email Address','uni-course'),
        'section' => 'uni_course_top_header',
        'setting' => 'uni_course_email',
        'type'  => 'text'
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_top_header_setting', array(
        'sanitize_callback' => 'Uni_Course_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Uni_Course_Customize_Pro_Version ( $wp_customize,'pro_version_top_header_setting', array(
        'section'     => 'uni_course_top_header',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'uni-course' ),
        'description' => esc_url( UNI_COURSE_URL ),
        'priority'    => 100
    )));

    // Header
    $wp_customize->add_section('uni_course_header',array(
        'title' => esc_html__('Header','uni-course')
    ));

    $wp_customize->add_setting('uni_course_search_on_off',array(
        'default' => 0,
        'sanitize_callback' => 'uni_course_sanitize_checkbox'
    ));
    $wp_customize->add_control('uni_course_search_on_off',array(
        'label' => esc_html__('On / Off Homepage Search','uni-course'),
        'section' => 'uni_course_header',
        'setting' => 'uni_course_search_on_off',
        'type'  => 'checkbox'
    ));

    $wp_customize->add_setting('uni_course_consultation_button1',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('uni_course_consultation_button1',array(
        'label' => esc_html__('Button 1 Text','uni-course'),
        'section' => 'uni_course_header',
        'setting' => 'uni_course_consultation_button1',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('uni_course_button1_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('uni_course_button1_url',array(
        'label' => esc_html__('Button 1 Link','uni-course'),
        'section' => 'uni_course_header',
        'setting' => 'uni_course_button1_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('uni_course_consultation_button2',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('uni_course_consultation_button2',array(
        'label' => esc_html__('Button 2 Text','uni-course'),
        'section' => 'uni_course_header',
        'setting' => 'uni_course_consultation_button2',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('uni_course_button2_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('uni_course_button2_url',array(
        'label' => esc_html__('Button 2 Link','uni-course'),
        'section' => 'uni_course_header',
        'setting' => 'uni_course_button2_url',
        'type'  => 'url'
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_header_setting', array(
        'sanitize_callback' => 'Uni_Course_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Uni_Course_Customize_Pro_Version ( $wp_customize,'pro_version_header_setting', array(
        'section'     => 'uni_course_header',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'uni-course' ),
        'description' => esc_url( UNI_COURSE_URL ),
        'priority'    => 100
    )));

    //Slider
    $wp_customize->add_section('uni_course_top_slider',array(
        'title' => esc_html__('Slider Option','uni-course')
    ));

    $wp_customize->add_setting('uni_course_top_slider_setting', array(
        'default' => 0,
        'sanitize_callback' => 'uni_course_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'uni_course_top_slider_setting',array(
        'label'          => __( 'Enable Disable Slider', 'uni-course' ),
        'section'        => 'uni_course_top_slider',
        'settings'       => 'uni_course_top_slider_setting',
        'type'           => 'checkbox',
    )));

    for ( $uni_course_count = 1; $uni_course_count <= 3; $uni_course_count++ ) {
        $wp_customize->add_setting( 'uni_course_top_slider_page' . $uni_course_count, array(
            'default'           => '',
            'sanitize_callback' => 'uni_course_sanitize_dropdown_pages'
        ) );
        $wp_customize->add_control( 'uni_course_top_slider_page' . $uni_course_count, array(
            'label'    => __( 'Select Slide Page', 'uni-course' ),
            'section'  => 'uni_course_top_slider',
            'type'     => 'dropdown-pages'
        ) );
    }

    // Pro Version
    $wp_customize->add_setting( 'pro_version_slider_setting', array(
        'sanitize_callback' => 'Uni_Course_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Uni_Course_Customize_Pro_Version ( $wp_customize,'pro_version_slider_setting', array(
        'section'     => 'uni_course_top_slider',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'uni-course' ),
        'description' => esc_url( UNI_COURSE_URL ),
        'priority'    => 100
    )));

    // Project Section
    $wp_customize->add_section('uni_course_latest_project',array(
        'title' => esc_html__('Latest Online Lessons','uni-course')
    ));

    $wp_customize->add_setting('uni_course_other_project_setting', array(
        'default' => 0,
        'sanitize_callback' => 'uni_course_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'uni_course_other_project_setting',array(
        'label'          => __( 'Enable Disable Project', 'uni-course' ),
        'section'        => 'uni_course_latest_project',
        'settings'       => 'uni_course_other_project_setting',
        'type'           => 'checkbox',
        'priority'       => 1,
    )));

    $wp_customize->add_setting('uni_course_projects_title',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('uni_course_projects_title',array(
        'label' => esc_html__('Section Title','uni-course'),
        'section' => 'uni_course_latest_project',
        'setting' => 'uni_course_projects_title',
        'type'  => 'text'
    ));

    $wp_customize->add_setting('uni_course_project_loop',array(
        'default'   => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('uni_course_project_loop',array(
        'label' => esc_html__('No of online lesson','uni-course'),
        'section'   => 'uni_course_latest_project',
        'type'      => 'number',
        'input_attrs' => array(
            'step'             => 1,
            'min'              => 0,
            'max'              => 9,
        ),
    ));

    $project_loop = get_theme_mod('uni_course_project_loop');

    $uni_course_args = array('numberposts' => -1);
    $post_list = get_posts($uni_course_args);
    $i = 1;
    $pst_sls[]= __('Select','uni-course');
    foreach ($post_list as $key => $p_post) {
        $pst_sls[$p_post->ID]=$p_post->post_title;
    }
    for ( $i = 1; $i <= $project_loop; $i++ ) {
        $wp_customize->add_setting('uni_course_other_project_section'.$i,array(
            'sanitize_callback' => 'uni_course_sanitize_choices',
        ));
        $wp_customize->add_control('uni_course_other_project_section'.$i,array(
            'type'    => 'select',
            'choices' => $pst_sls,
            'label' => __('Select Post','uni-course'),
            'section' => 'uni_course_latest_project',
        ));

        $wp_customize->add_setting('uni_course_projects_price'.$i, array(
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control('uni_course_projects_price'.$i, array(
            'label' => __('Lessons Price', 'uni-course'),
            'section' => 'uni_course_latest_project',
            'type' => 'text',
        ));

    }
    wp_reset_postdata();
    // Pro Version
    $wp_customize->add_setting( 'pro_version_project_setting', array(
        'sanitize_callback' => 'Uni_Course_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Uni_Course_Customize_Pro_Version ( $wp_customize,'pro_version_project_setting', array(
        'section'     => 'uni_course_latest_project',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'uni-course' ),
        'description' => esc_url( UNI_COURSE_URL ),
        'priority'    => 100
    )));

    // Footer
    $wp_customize->add_section('uni_course_site_footer_section', array(
        'title' => esc_html__('Footer', 'uni-course'),
    ));

    $wp_customize->add_setting('uni_course_footer_text_setting', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('uni_course_footer_text_setting', array(
        'label' => __('Replace the footer text', 'uni-course'),
        'section' => 'uni_course_site_footer_section',
        'priority' => 1,
        'type' => 'text',
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_footer_setting', array(
        'sanitize_callback' => 'Uni_Course_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Uni_Course_Customize_Pro_Version ( $wp_customize,'pro_version_footer_setting', array(
        'section'     => 'uni_course_site_footer_section',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'uni-course' ),
        'description' => esc_url( UNI_COURSE_URL ),
        'priority'    => 100
    )));
}
add_action('customize_register', 'uni_course_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function uni_course_customize_partial_blogname(){
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function uni_course_customize_partial_blogdescription(){
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function uni_course_customize_preview_js(){
    wp_enqueue_script('uni-course-customizer', esc_url(get_template_directory_uri()) . '/assets/js/customizer.js', array('customize-preview'), '20151215', true);
}
add_action('customize_preview_init', 'uni_course_customize_preview_js');

/*
** Load dynamic logic for the customizer controls area.
*/
function uni_course_panels_js() {
    wp_enqueue_style( 'uni-course-customizer-layout-css', get_theme_file_uri( '/assets/css/customizer-layout.css' ) );
    wp_enqueue_script( 'uni-course-customize-layout', get_theme_file_uri( '/assets/js/customize-layout.js' ), array(), '1.2', true );
}
add_action( 'customize_controls_enqueue_scripts', 'uni_course_panels_js' );
