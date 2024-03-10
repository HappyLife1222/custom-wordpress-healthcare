<?php
defined( 'ABSPATH' ) or die( "No script kiddies please!" );
/**
* Add Search icon with form in header layout three
**/

//use shortcode
$template_type = ( isset( $atts['template_type'] ) ) ? esc_attr( $atts['template_type'] ) : 'inline-search';
if( $template_type == "inline-search" ) {
  $style  = ( isset( $atts['style'] ) ) ? esc_attr( $atts['style'] ) : 'inline-toggle-left'; //inline-toggle-left or inline-toggle-right
} else {
  $style = '';
}
?>
<?php if( $template_type == "inline-search" ) { ?>
  <div class="iepa-search-icon <?php echo esc_attr( $template_type );?> <?php echo esc_attr( $style ); ?>">
    <?php echo get_search_form( $echo = true ); ?>
  </div>
<?php } else if( $template_type == "megamenu-type-search" ) { ?>
  <div class="iepa-search-icon <?php echo esc_attr( $template_type ); ?> <?php echo esc_attr( $style ); ?>">
    <?php echo get_search_form( $echo = true ); ?>
  </div>
<?php } else if( $template_type == "popup-search-form" ) { ?>
  <div class="iepa-search-icon <?php echo esc_attr( $template_type ); ?>">
    <div class="closepopup">
      <span></span>
    </div>
    <div class="imma-search">
      <div class="iepa-overlay-search">
        <?php echo get_search_form( $echo = true ); ?>
      </div>
    </div>
    <div class="iepa-search-overlay"></div>
  </div>
<?php } ?>
