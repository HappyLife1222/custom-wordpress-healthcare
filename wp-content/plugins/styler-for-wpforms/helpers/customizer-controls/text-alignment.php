<?php
class Sfwf_Text_Alignment_Option extends WP_Customize_Control {
	public $type = 'text_alignment';
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
			</label>
			<?php
			if ( empty( $this->choices ) ) {
				return;
			}
			foreach ( $this->choices as $value => $label ) :
				$checked_class = $value === $this->value() ? ' sfwf_text_alignment_checked' : '';
				?>
					<span class="sfwf_text_alignment sfwf_font_value_<?php echo esc_attr( $value );
					echo $checked_class;
					?>
					">
						<input type="radio" class="sfwf_text_alignment_radio" value="<?php echo esc_attr( $value ); ?>" <?php checked( $value, $this->value() ); ?> />
					</span>
				<?php
			endforeach;
			?>
			<input type="hidden" class="sfwf_text_alignment_control" <?php $this->input_attrs(); ?> value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />
			<?php
	}
}
