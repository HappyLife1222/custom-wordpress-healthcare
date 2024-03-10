<?php
/**
 * The template part for header
 *
 * @package VW Healthcare 
 * @subpackage vw-healthcare
 * @since vw-healthcare 1.0
 */
?>

<div id="header" class="py-2 py-lg-0 ">
  <div class="container">
    <div class="toggle-nav mobile-menu text-center">
      <button role="tab" onclick="vw_healthcare_menu_open_nav()" class="responsivetoggle"><i class="py-3 px-4 <?php echo esc_attr(get_theme_mod('vw_healthcare_res_open_menu_icon','fas fa-bars')); ?>"></i><span class="screen-reader-text"><?php esc_html_e('Open Button','vw-healthcare'); ?></span></button>
    </div>
    <div id="mySidenav" class="nav sidenav">
      <nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'vw-healthcare' ); ?>">
        <?php
          wp_nav_menu( array( 
            'theme_location' => 'primary',
            'container_class' => 'main-menu clearfix' ,
            'menu_class' => 'clearfix',
            'items_wrap' => '<ul id="%1$s" class="%2$s mobile_nav">%3$s</ul>',
            'fallback_cb' => 'wp_page_menu',
          ) );
         ?>
        <a href="javascript:void(0)" class="closebtn mobile-menu" onclick="vw_healthcare_menu_close_nav()"><i class="<?php echo esc_attr(get_theme_mod('vw_healthcare_res_close_menu_icon','fas fa-times')); ?>"></i><span class="screen-reader-text"><?php esc_html_e('Close Button','vw-healthcare'); ?></span></a>
      </nav>
    </div>
  </div>
</div>