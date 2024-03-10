<?php
/**
 * Custom Social Widget
 */

class VW_Healthcare_Social_Widget extends WP_Widget {
	function __construct() {
		parent::__construct(
			'VW_Healthcare_Social_Widget',
			__('VW Social Icon', 'vw-healthcare'),
			array( 'description' => __( 'Widget for Social icons section', 'vw-healthcare' ), ) 
		);
	}

	public function widget( $args, $instance ) { ?>
		<div class="widget">
			<?php
			$title = isset( $instance['title'] ) ? $instance['title'] : '';
			$facebook = isset( $instance['facebook'] ) ? $instance['facebook'] : '';
			$instagram = isset( $instance['instagram'] ) ? $instance['instagram'] : '';
			$twitter = isset( $instance['twitter'] ) ? $instance['twitter'] : '';
			$linkedin = isset( $instance['linkedin'] ) ? $instance['linkedin'] : '';
			$pinterest = isset( $instance['pinterest'] ) ? $instance['pinterest'] : '';
			$tumblr = isset( $instance['tumblr'] ) ? $instance['tumblr'] : '';
			$youtube = isset( $instance['youtube'] ) ? $instance['youtube'] : '';

	        echo '<div class="custom-social-icons">';
	        if(!empty($title) ){ ?><h3 class="custom_title"><?php echo esc_html($title); ?></h3><?php } ?>
	        <?php if(!empty($facebook) ){ ?><a class="custom_facebook fff" target="_blank" href="<?php echo esc_url($facebook); ?>"><i class="fab fa-facebook-f"></i><span class="screen-reader-text"><?php esc_html_e( 'Facebook','vw-healthcare' );?></span></a><?php } ?>
	        <?php if(!empty($twitter) ){ ?><a class="custom_twitter" target="_blank" href="<?php echo esc_url($twitter); ?>"><i class="fab fa-twitter"></i><span class="screen-reader-text"><?php esc_html_e( 'Twitter','vw-healthcare' );?></span></a><?php } ?>
	        <?php if(!empty($linkedin) ){ ?><a class="custom_linkedin" target="_blank" href="<?php echo esc_url($linkedin); ?>"><i class="fab fa-linkedin-in"></i><span class="screen-reader-text"><?php esc_html_e( 'Linkedin','vw-healthcare' );?></span></a><?php } ?>
	        <?php if(!empty($pinterest) ){ ?><a class="custom_pinterest" target="_blank" href="<?php echo esc_url($pinterest); ?>"><i class="fab fa-pinterest-p"></i><span class="screen-reader-text"><?php esc_html_e( 'Pinterest','vw-healthcare' );?></span></a><?php } ?>
	        <?php if(!empty($tumblr) ){ ?><a class="custom_tumblr" target="_blank" href="<?php echo esc_url($tumblr); ?>"><i class="fab fa-tumblr"></i><span class="screen-reader-text"><?php esc_html_e( 'Tumblr','vw-healthcare' );?></span></a><?php } ?>
	        <?php if(!empty($instagram) ){ ?><a class="custom_instagram" target="_blank" href="<?php echo esc_url($instagram); ?>"><i class="fab fa-instagram"></i><span class="screen-reader-text"><?php esc_html_e( 'Instagram','vw-healthcare' );?></span></a><?php } ?>
	        <?php if(!empty($youtube) ){ ?><a class="custom_youtube" target="_blank" href="<?php echo esc_url($youtube); ?>"><i class="fab fa-youtube"></i><span class="screen-reader-text"><?php esc_html_e( 'Youtube','vw-healthcare' );?></span></a><?php } ?>
	        <?php echo '</div>';
			?>
		</div>
		<?php
	}
	
	// Widget Backend 
	public function form( $instance ) {

		$title= ''; $facebook = ''; $twitter = ''; $linkedin = '';  $pinterest = '';$tumblr = ''; $instagram = ''; $youtube = ''; 

		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$facebook = isset( $instance['facebook'] ) ? $instance['facebook'] : '';
		$instagram = isset( $instance['instagram'] ) ? $instance['instagram'] : '';
		$twitter = isset( $instance['twitter'] ) ? $instance['twitter'] : '';
		$linkedin = isset( $instance['linkedin'] ) ? $instance['linkedin'] : '';
		$pinterest = isset( $instance['pinterest'] ) ? $instance['pinterest'] : '';
		$tumblr = isset( $instance['tumblr'] ) ? $instance['tumblr'] : '';
		$youtube = isset( $instance['youtube'] ) ? $instance['youtube'] : '';
		?>
		<p>
        <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:','vw-healthcare'); ?></label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
    	</p>
		<p>
		<label for="<?php echo esc_attr($this->get_field_id('facebook')); ?>"><?php esc_html_e('Facebook:','vw-healthcare'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('facebook')); ?>" name="<?php echo esc_attr($this->get_field_name('facebook')); ?>" type="text" value="<?php echo esc_attr($facebook); ?>">
		</p>
		<p>
		<label for="<?php echo esc_attr($this->get_field_id('twitter')); ?>"><?php esc_html_e('Twitter:','vw-healthcare'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('twitter')); ?>" name="<?php echo esc_attr($this->get_field_name('twitter')); ?>" type="text" value="<?php echo esc_attr($twitter); ?>">
		</p>
		<p>
		<label for="<?php echo esc_attr($this->get_field_id('linkedin')); ?>"><?php esc_html_e('Linkedin:','vw-healthcare'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('linkedin')); ?>" name="<?php echo esc_attr($this->get_field_name('linkedin')); ?>" type="text" value="<?php echo esc_attr($linkedin); ?>">
		</p>
		<p>
		<label for="<?php echo esc_attr($this->get_field_id('instagram')); ?>"><?php esc_html_e('Instagram:','vw-healthcare'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('instagram')); ?>" name="<?php echo esc_attr($this->get_field_name('instagram')); ?>" type="text" value="<?php echo esc_attr($instagram); ?>">
		</p>
		<p>
		<label for="<?php echo esc_attr($this->get_field_id('pinterest')); ?>"><?php esc_html_e('Pinterest:','vw-healthcare'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('pinterest')); ?>" name="<?php echo esc_attr($this->get_field_name('pinterest')); ?>" type="text" value="<?php echo esc_attr($pinterest); ?>">
		</p>
		<p>
		<label for="<?php echo esc_attr($this->get_field_id('tumblr')); ?>"><?php esc_html_e('Tumblr:','vw-healthcare'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('tumblr')); ?>" name="<?php echo esc_attr($this->get_field_name('tumblr')); ?>" type="text" value="<?php echo esc_attr($tumblr); ?>">
		</p>
		<p>
		<label for="<?php echo esc_attr($this->get_field_id('youtube')); ?>"><?php esc_html_e('Youtube:','vw-healthcare'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('youtube')); ?>" name="<?php echo esc_attr($this->get_field_name('youtube')); ?>" type="text" value="<?php echo esc_attr($youtube); ?>">
		</p>
		<?php 
	}
	
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';	
        $instance['facebook'] = (!empty($new_instance['facebook']) ) ? esc_url_raw($new_instance['facebook']) : '';
        $instance['twitter'] = (!empty($new_instance['twitter']) ) ? esc_url_raw($new_instance['twitter']) : '';
        $instance['instagram'] = (!empty($new_instance['instagram']) ) ? esc_url_raw($new_instance['instagram']) : '';
        $instance['linkedin'] = (!empty($new_instance['linkedin']) ) ? esc_url_raw($new_instance['linkedin']) : '';
        $instance['pinterest'] = (!empty($new_instance['pinterest']) ) ? esc_url_raw($new_instance['pinterest']) : '';
        $instance['tumblr'] = (!empty($new_instance['tumblr']) ) ? esc_url_raw($new_instance['tumblr']) : '';
     	$instance['youtube'] = (!empty($new_instance['youtube']) ) ? esc_url_raw($new_instance['youtube']) : '';
		return $instance;
	}
}

function vw_healthcare_custom_load_widget() {
	register_widget( 'VW_Healthcare_Social_Widget' );
}
add_action( 'widgets_init', 'vw_healthcare_custom_load_widget' );