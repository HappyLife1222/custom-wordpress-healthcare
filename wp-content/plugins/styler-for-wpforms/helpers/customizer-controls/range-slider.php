<?php
/**
 * Range-based sliding value picker for Customizer
 */
class Sfwf_Customize_Control_Range_Slider extends WP_Customize_Control {
	public $type = 'rangeslider';

	public function render_content() {
		?>
		<label>
			<?php if ( ! empty( $this->label ) ) : ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php
			endif;
			if ( ! empty( $this->description ) ) :
				?>
				<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php endif; ?>
			<input type="range" <?php $this->input_attrs(); ?> class="gf-sfwf-range-btn" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> data-reset_value="<?php echo esc_attr( $this->setting->default ); ?>" />
			<input type="number" <?php $this->input_attrs(); ?> class="gf-sfwf-range-input" value="<?php echo esc_attr( $this->value() ); ?>" />
		</label>
		<?php
	}
}
