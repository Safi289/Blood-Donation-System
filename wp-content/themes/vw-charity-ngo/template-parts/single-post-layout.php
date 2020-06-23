<?php
/**
 * The template part for displaying single post layout
 *
 * @package VW Charity NGO
 * @subpackage vw-charity-ngo
 * @since VW Charity NGO 1.0
 */
?>
<div id="post-<?php the_ID(); ?>" <?php post_class('inner-service'); ?>>
    <div id="content-vw" class="metabox">
        <?php if(get_theme_mod('vw_charity_ngo_toggle_postdate',true)==1){ ?>
            <span class="entry-date"><i class="fas fa-calendar-alt"></i> <?php echo get_the_date(); ?></span>
        <?php } ?>

        <?php if(get_theme_mod('vw_charity_ngo_toggle_author',true)==1){ ?>
            <span class="entry-author"><i class="fas fa-user"></i><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>"><?php the_author(); ?></a></span>
        <?php } ?>

        <?php if(get_theme_mod('vw_charity_ngo_toggle_comments',true)==1){ ?>
            <span class="entry-comments"> <i class="far fa-comments"></i> <?php comments_number( '0 Comments', '0 Comments', '% Comments' ); ?> </span>
        <?php } ?>
    </div>
    <h3><?php the_title();?></h3> 
    <?php if(has_post_thumbnail()) { ?>
            <div class="feature-box">   
                <img src="<?php the_post_thumbnail_url('full'); ?>">
            </div>                 
        <?php } the_content();
        the_tags(); ?>
        <?php
        // If comments are open or we have at least one comment, load up the comment template
        if ( comments_open() || '0' != get_comments_number() )
        comments_template();

        if ( is_singular( 'attachment' ) ) {
            // Parent post navigation.
            the_post_navigation( array(
                'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'vw-charity-ngo' ),
            ) );
        } elseif ( is_singular( 'post' ) ) {
            // Previous/next post navigation.
            the_post_navigation( array(
                'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'vw-charity-ngo' ) . '</span> ' .
                    '<span class="screen-reader-text">' . __( 'Next post:', 'vw-charity-ngo' ) . '</span> ' .
                    '<span class="post-title">%title</span>',
                'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'vw-charity-ngo' ) . '</span> ' .
                    '<span class="screen-reader-text">' . __( 'Previous post:', 'vw-charity-ngo' ) . '</span> ' .
                    '<span class="post-title">%title</span>',
            ) );
        }
    ?>
</div>