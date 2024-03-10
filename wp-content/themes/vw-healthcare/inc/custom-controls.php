<?php
/**
 * VW Healthcare Customizer Custom Controls
 *
 */

if ( class_exists( 'WP_Customize_Control' ) ) {
	class VW_Healthcare_Toggle_Switch_Custom_Control extends WP_Customize_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'vw_healthcare_toogle_switch';
		/**
		 * Enqueue our scripts and styles
		 */
		public function enqueue(){
			wp_enqueue_style( 'vw_healthcare_custom_controls_css', trailingslashit( get_template_directory_uri() ) . 'assets/css/customizer.css', array(), '1.0', 'all' );
		}
		/**
		 * Render the control in the customizer
		 */
		public function render_content(){
		?>
			<div class="toggle-switch-control">
				<div class="toggle-switch">
					<input type="checkbox" id="<?php echo esc_attr($this->id); ?>" name="<?php echo esc_attr($this->id); ?>" class="toggle-switch-checkbox" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); checked( $this->value() ); ?>>
					<label class="toggle-switch-label" for="<?php echo esc_attr( $this->id ); ?>">
						<span class="toggle-switch-inner"></span>
						<span class="toggle-switch-switch"></span>
					</label>
				</div>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php if( !empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>
			</div>
		<?php
		}
	}

	// Image Toggle Radio Buttpon
	class VW_Healthcare_Image_Radio_Control extends WP_Customize_Control {

	    public function render_content() {
	 
	        if (empty($this->choices))
	            return;
	 
	        $name = '_customize-radio-' . $this->id;
	        ?>
	        <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
	        <ul class="controls" id='vw-healthcare-img-container'>
	            <?php
	            foreach ($this->choices as $value => $label) :
	                $class = ($this->value() == $value) ? 'vw-healthcare-radio-img-selected vw-healthcare-radio-img-img' : 'vw-healthcare-radio-img-img';
	                ?>
	                <li style="display: inline;">
	                    <label>
	                        <input <?php $this->link(); ?>style = 'display:none' type="radio" value="<?php echo esc_attr($value); ?>" name="<?php echo esc_attr($name); ?>" <?php
	                          	$this->link();
	                          	checked($this->value(), $value);
	                          	?> />
	                        <img src='<?php echo esc_url($label); ?>' class='<?php echo esc_attr($class); ?>' />
	                    </label>
	                </li>
	                <?php
	            endforeach;
	            ?>
	        </ul>
	        <?php
	    } 
	}

	// Reset Settings
	class vw_healthcare_Reset_Custom_Control extends WP_Customize_Control {
    public $type = 'reset_control';
    public function render_content() {
    ?>
		<div class="reset-custom-control">
			<span class="customize-reset-title"><?php echo esc_html( $this->label ); ?></span>
		 <span class="reset-button"><?php echo esc_html_e('Reset', 'vw-healthcare'); ?></span>
		</div>
		<div id="myModal" class="modal kt-modal">
		<div class="modal-content">
		  <span class="close">X</span>
		  <h3><?php esc_html_e('Are you sure to reset the Changes ? ', 'vw-healthcare') ?></h3>
		  <p><?php esc_html_e('After click on the reset button, it will reset the previous changes that you have done and the data will be lost.', 'vw-healthcare') ?></p>
		  <p><?php esc_html_e('Please Refresh the customizer after reset the settings.', 'vw-healthcare') ?></p>
		  <a href="javascript:location.reload();" class="refresh-btn" data-value="<?php echo esc_attr( $this->description ); ?>"><?php echo esc_html_e('RESET', 'vw-healthcare'); ?></a>
		</div>
		</div>
			<?php
		}
    }	
}