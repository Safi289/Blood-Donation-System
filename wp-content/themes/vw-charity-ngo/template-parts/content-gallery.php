<?php
/**
 * The template part for displaying Gallery Post
 *
 * @package VW Charity NGO  
 * @subpackage vw_charity_ngo
 * @since VW Charity NGO  1.0
 */
?>

<?php
  $vw_charity_ngo_toggle_postdate = get_theme_mod( 'vw_charity_ngo_toggle_postdate' );
  if ( 'Disable' == $vw_charity_ngo_toggle_postdate ) {
   $colmd = 'col-lg-12 col-md-12';
  } else { 
   $colmd = 'col-lg-10 col-md-10';
  } 
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('inner-service'); ?>>
  <div class="post-main-box">
    <div class="box-image">
      <?php
        if ( ! is_single() ) {

          // If not a single post, highlight the gallery.
          if ( get_post_gallery() ) {
            echo '<div class="entry-gallery">';
              echo ( get_post_gallery() );
            echo '</div>';
          };
        };
      ?>   
    </div>
    <div class="row">
      <?php if ( 'Disable' != $vw_charity_ngo_toggle_postdate ) {?>
        <div class="col-lg-2 col-md-2">
          <div class="datebox">
              <div class="date-monthwrap">
                 <span class="date-month"><?php echo esc_html( get_the_date( 'M' ) ); ?></span>
                 <span class="date-day"><?php echo esc_html( get_the_date( 'd') ); ?></span>
              </div>
              <div class="yearwrap">
                  <span class="date-year"><?php echo esc_html( get_the_date( 'Y' ) ); ?></span>
              </div>
            </div>
        </div>
      <?php } ?>
      <div class="<?php echo esc_html( $colmd ); ?>">
        <h3 class="section-title"><?php the_title();?></h3>      
        <div class="new-text">
          <p><?php $excerpt = get_the_excerpt(); echo esc_html( vw_charity_ngo_string_limit_words( $excerpt, esc_attr(get_theme_mod('vw_charity_ngo_excerpt_number','30')))); ?></p>
        </div>
        <div class="content-bttn">
          <a href="<?php echo esc_url( get_permalink() );?>" class="blogbutton-small hvr-sweep-to-right" title="<?php esc_attr_e( 'Read More', 'vw-charity-ngo' ); ?>"><?php esc_html_e('Read More','vw-charity-ngo'); ?></a>
        </div>
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
</div>