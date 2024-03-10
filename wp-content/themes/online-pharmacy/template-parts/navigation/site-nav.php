<?php 
/*
* Display Theme menus
*/
?>

<div class="menubar">
  	<div class="container right_menu">
		<div class="innermenubox">
	  			<div class="toggle-nav mobile-menu">
	    			<button onclick="online_pharmacy_menu_open_nav()" class="responsivetoggle"><i class="fas fa-bars"></i><span class="screen-reader-text"><?php esc_html_e('Open Button','online-pharmacy'); ?></span></button>
	  			</div>
 			<div id="mySidenav" class="nav sidenav">
				<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'online-pharmacy' ); ?>">
	              	<?php 
	                  	wp_nav_menu( array( 
		                    'theme_location' => 'primary-menu',
		                    'container_class' => 'main-menu clearfix' ,
		                    'menu_class' => 'clearfix',
		                    'items_wrap' => '<ul id="%1$s" class="%2$s mobile_nav">%3$s</ul>',
		                    'fallback_cb' => 'wp_page_menu',
	                  	) );
	              	 ?>
	  				<a href="javascript:void(0)" class="closebtn mobile-menu" onclick="online_pharmacy_menu_close_nav()"><i class="fas fa-times"></i><span class="screen-reader-text"><?php esc_html_e('Close Button','online-pharmacy'); ?></span></a>
	    		</nav>
	  		</div>
	    </div>
  	</div>
</div>