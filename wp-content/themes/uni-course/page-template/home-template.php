<?php
/**
 * Template Name: Home Template
 */

get_header(); ?>

<main id="skip-content">
  <section id="top-slider">
    <?php if(get_theme_mod('uni_course_top_slider_setting') != ''){ ?>
    <?php $uni_course_slide_pages = array();
      for ( $uni_course_count = 1; $uni_course_count <= 3; $uni_course_count++ ) {
        $uni_course_mod = intval( get_theme_mod( 'uni_course_top_slider_page' . $uni_course_count ));
        if ( 'page-none-selected' != $uni_course_mod ) {
          $uni_course_slide_pages[] = $uni_course_mod;
        }
      }
      if( !empty($uni_course_slide_pages) ) :
        $uni_course_args = array(
          'post_type' => 'page',
          'post__in' => $uni_course_slide_pages,
          'orderby' => 'post__in'
        );
        $uni_course_query = new WP_Query( $uni_course_args );
        if ( $uni_course_query->have_posts() ) :
          $i = 1;
    ?>
    <div class="owl-carousel" role="listbox">
      <?php  while ( $uni_course_query->have_posts() ) : $uni_course_query->the_post(); ?>
        <div class="slider-box">
          <img src="<?php esc_url(the_post_thumbnail_url('full')); ?>"/>
          <div class="slider-inner-box">
            <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
            <p class="post"><?php echo wp_trim_words( get_the_content(), 10 ); ?></p>
            <div class="slider-box-btn mt-4">
              <a href="<?php the_permalink(); ?>"><?php esc_html_e('Learn More','uni-course'); ?></a>
            </div>
          </div>
        </div>
      <?php $i++; endwhile;
      wp_reset_postdata();?>
    </div>
    <?php else : ?>
      <div class="no-postfound"></div>
    <?php endif;
    endif;?>
    <?php }?>
  </section>

  <?php if(get_theme_mod('uni_course_search_on_off') != ''){ ?>

  <div class="container">
    <div class="searchbox">
      <h3><?php esc_html_e('Find A Tutor','uni-course'); ?></h3>
      <?php get_search_form(); ?>
    </div>
  </div>

<?php }?>

<?php if(get_theme_mod('uni_course_other_project_setting') != ''){ ?>
  <section id="projects" class="py-5">
    <div class="container">
      <?php if(get_theme_mod('uni_course_projects_title') != ''){ ?>
        <h2 class="text-center"><?php echo esc_html(get_theme_mod('uni_course_projects_title')); ?></h2>
      <?php }?>
      <div class="row mt-5">
        <?php $uni_course_other_project_section = array();
          $project_loop = get_theme_mod('uni_course_project_loop');
          for ($i=1; $i <= $project_loop; $i++) {
            $uni_course_mod = intval( get_theme_mod( 'uni_course_other_project_section' .$i));
            if ( 'page-none-selected' != $uni_course_mod ) {
              $uni_course_other_project_section[] = $uni_course_mod;
            }
          }
          if( !empty($uni_course_other_project_section) ) :
          $uni_course_args = array(
            'post_type' => 'post',
            'post__in' => $uni_course_other_project_section,
            'orderby' => 'post__in'
          );
          $uni_course_query = new WP_Query( $uni_course_args );
          if ( $uni_course_query->have_posts() ) :
            $i = 1;
        ?>
        <?php while ( $uni_course_query->have_posts() ) : $uni_course_query->the_post(); ?>
          <div class="col-lg-4 col-md-6">
            <div class="box mb-4">
              <img src="<?php esc_url(the_post_thumbnail_url('full')); ?>" class="w-100"/>
              <div class="price-box text-right mr-3">
                <?php if(get_theme_mod('uni_course_projects_price'.$i) != ''){ ?>
                  <h5><?php echo esc_html(get_theme_mod('uni_course_projects_price'.$i)); ?></h5>
                <?php }?>
              </div>
              <div class="p-2">
                <h3><?php the_title(); ?></h3>
                <div class="readmore">
                  <a href="<?php the_permalink(); ?>"><?php esc_html_e('Enroll Now','uni-course'); ?></a>
                </div>
              </div>
              <div class="box-content">
                <h3 class="title"><?php the_title(); ?></h3>
                <p class="post"><?php echo wp_trim_words( get_the_content(), 30 ); ?></p>
                <div class="row">
                  <div class="col-lg-6 col-md-6 col-6 align-self-center">
                    <div class="readmore">
                      <a href="<?php the_permalink(); ?>"><?php esc_html_e('Enroll Now','uni-course'); ?></a>
                    </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-6 text-right align-self-center">
                    <?php if(get_theme_mod('uni_course_projects_price'.$i) != ''){ ?>
                      <h5><?php echo esc_html(get_theme_mod('uni_course_projects_price'.$i)); ?></h5>
                    <?php }?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php $i++; endwhile;
        wp_reset_postdata();?>
        <?php else : ?>
          <div class="no-postfound"></div>
        <?php endif;
        endif;?>
      </div>
    </div>
  </section>
  <?php }?>

  <section id="page-content">
    <div class="container">
      <div class="py-5">
        <?php
          if ( have_posts() ) :
            while ( have_posts() ) : the_post();
              the_content();
            endwhile;
          endif;
        ?>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>
