<?php
/**
 * Displays top navigation
 *
 * @package Uni Course
 */

$uni_course_sticky_header = get_theme_mod('uni_course_sticky_header');
    $data_sticky = "false";
    if ($uni_course_sticky_header) {
        $data_sticky = "true";
}
?>

<div class="navigation_header py-2" data-sticky="<?php echo esc_attr($data_sticky); ?>">
    <div class="container">
        <div class="navigation-inner-box">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-5 col-9 align-self-center">
                    <div class="navbar-brand">
                        <?php if ( has_custom_logo() ) : ?>
                            <div class="site-logo"><?php the_custom_logo(); ?></div>
                        <?php endif; ?>
                        <?php $uni_course_blog_info = get_bloginfo( 'name' ); ?>
                            <?php if ( ! empty( $uni_course_blog_info ) ) : ?>
                                <?php if ( is_front_page() && is_home() ) : ?>
                                <?php if( get_theme_mod('uni_course_logo_title',true) != ''){ ?>
                                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                                <?php }?>
                                <?php else : ?>
                                <?php if( get_theme_mod('uni_course_logo_title',true) != ''){ ?>
                                    <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                                <?php }?>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php
                                $uni_course_description = get_bloginfo( 'description', 'display' );
                                if ( $uni_course_description || is_customize_preview() ) :
                            ?>
                            <?php if( get_theme_mod('uni_course_theme_description',false) != ''){ ?>
                            <p class="site-description"><?php echo esc_html($uni_course_description); ?></p>
                        <?php }?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-6 col-md-3 col-sm-2 col-3 align-self-center">
                    <div class="toggle-nav mobile-menu">
                        <?php if(has_nav_menu('primary')){ ?>
                            <button onclick="uni_course_openNav()"><i class="fas fa-th"></i></button>
                        <?php }?>
                    </div>
                    <div id="mySidenav" class="nav sidenav">
                        <nav id="site-navigation" class="main-navigation navbar navbar-expand-xl" aria-label="<?php esc_attr_e( 'Top Menu', 'uni-course' ); ?>">
                            <?php if(has_nav_menu('primary')){
                                wp_nav_menu(
                                    array(
                                        'theme_location' => 'primary',
                                        'menu_class'     => 'menu',
                                        'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                    )
                                );
                            } ?>
                        </nav>
                        <a href="javascript:void(0)" class="closebtn mobile-menu" onclick="uni_course_closeNav()"><i class="fas fa-times"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-5 col-sm-5 align-self-center button-box">
                    <?php if(get_theme_mod('uni_course_button1_url') != '' || get_theme_mod('uni_course_consultation_button1') != '' || get_theme_mod('uni_course_button2_url') != '' || get_theme_mod('uni_course_consultation_button2') != ''){ ?>
                        <a href="<?php echo esc_url(get_theme_mod('uni_course_button1_url','')); ?>" class="box1"><?php echo esc_html(get_theme_mod('uni_course_consultation_button1','')); ?></a>
                        <a href="<?php echo esc_url(get_theme_mod('uni_course_button2_url','')); ?>" class="box2"><i class="fas fa-phone mr-2"></i><?php echo esc_html(get_theme_mod('uni_course_consultation_button2','')); ?></a>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
</div>
