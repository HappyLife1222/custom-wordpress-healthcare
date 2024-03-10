<?php
class Sfwf_Label_Only extends WP_Customize_Control {
	public $type = 'label_only';

	public function render_content() {
		?>
	<label>
		<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>  
	</label>
		<?php
	}
}
