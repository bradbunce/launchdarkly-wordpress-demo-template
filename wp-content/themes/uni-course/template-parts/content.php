<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Uni Course
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('article-box'); ?>>
    <div class="row">
        <?php if ( has_post_thumbnail() ) { ?>
            <div class="col-lg-5 col-md-5 col-sm-5">
                <?php uni_course_post_thumbnail(); ?>
            </div>
        <?php }?>
        <div class="<?php if(has_post_thumbnail()) { ?>col-lg-7 col-md-7<?php } else { ?>col-lg-12 col-md-12 <?php } ?>">
            <div class="entry-summary p-3 m-0">                
                <?php the_title('<h3 class="entry-title pb-3"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>');?>
                <p><?php echo wp_trim_words( get_the_content(), 30 ); ?></p>
                <a href="<?php the_permalink(); ?>" class="btn-text"><?php esc_html_e('Read Full','uni-course'); ?><i class="fas fa-long-arrow-alt-right ml-3"></i></a>
            </div>
            <div class="meta-info-box">
                <span class="entry-view"><i class="fas fa-eye mr-2"></i> <?php echo esc_html(uni_course_gt_get_post_view()); ?></span>
                <span class="entry-time ml-3"><i class="fas fa-clock mr-2"></i> <?php echo esc_html( get_the_time() ); ?></span>
                <span class="ml-3"><i class="fas fa-comments mr-2"></i> <?php comments_number( esc_attr('0', 'uni-course'), esc_attr('0', 'uni-course'), esc_attr('%', 'uni-course') ); ?> <?php esc_html_e('Comments','uni-course'); ?></span>
            </div>
        </div>
    </div>
</article>