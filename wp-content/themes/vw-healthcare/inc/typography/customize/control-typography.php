<?php
/**
 * Typography control class.
 *
 * @since  1.0.0
 * @access public
 */

class VW_Healthcare_Control_Typography extends WP_Customize_Control {

	/**
	 * The type of customize control being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'vw-healthcare-typography';

	/**
	 * Array 
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $l10n = array();

	/**
	 * Set up our control.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @param  string  $id
	 * @param  array   $args
	 * @return void
	 */
	public function __construct( $manager, $id, $args = array() ) {

		// Let the parent class do its thing.
		parent::__construct( $manager, $id, $args );

		// Make sure we have labels.
		$this->l10n = wp_parse_args(
			$this->l10n,
			array(
				'color'       => esc_html__( 'Font Color', 'vw-healthcare' ),
				'family'      => esc_html__( 'Font Family', 'vw-healthcare' ),
				'size'        => esc_html__( 'Font Size',   'vw-healthcare' ),
				'weight'      => esc_html__( 'Font Weight', 'vw-healthcare' ),
				'style'       => esc_html__( 'Font Style',  'vw-healthcare' ),
				'line_height' => esc_html__( 'Line Height', 'vw-healthcare' ),
				'letter_spacing' => esc_html__( 'Letter Spacing', 'vw-healthcare' ),
			)
		);
	}

	/**
	 * Enqueue scripts/styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue() {
		wp_enqueue_script( 'vw-healthcare-ctypo-customize-controls' );
		wp_enqueue_style(  'vw-healthcare-ctypo-customize-controls' );
	}

	/**
	 * Add custom parameters to pass to the JS via JSON.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function to_json() {
		parent::to_json();

		// Loop through each of the settings and set up the data for it.
		foreach ( $this->settings as $setting_key => $setting_id ) {

			$this->json[ $setting_key ] = array(
				'link'  => $this->get_link( $setting_key ),
				'value' => $this->value( $setting_key ),
				'label' => isset( $this->l10n[ $setting_key ] ) ? $this->l10n[ $setting_key ] : ''
			);

			if ( 'family' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_families();

			elseif ( 'weight' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_weight_choices();

			elseif ( 'style' === $setting_key )
				$this->json[ $setting_key ]['choices'] = $this->get_font_style_choices();
		}
	}

	/**
	 * Underscore JS template to handle the control's output.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function content_template() { ?>

		<# if ( data.label ) { #>
			<span class="customize-control-title">{{ data.label }}</span>
		<# } #>

		<# if ( data.description ) { #>
			<span class="description customize-control-description">{{{ data.description }}}</span>
		<# } #>

		<ul>

		<# if ( data.family && data.family.choices ) { #>

			<li class="typography-font-family">

				<# if ( data.family.label ) { #>
					<span class="customize-control-title">{{ data.family.label }}</span>
				<# } #>

				<select {{{ data.family.link }}}>

					<# _.each( data.family.choices, function( label, choice ) { #>
						<option value="{{ choice }}" <# if ( choice === data.family.value ) { #> selected="selected" <# } #>>{{ label }}</option>
					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.weight && data.weight.choices ) { #>

			<li class="typography-font-weight">

				<# if ( data.weight.label ) { #>
					<span class="customize-control-title">{{ data.weight.label }}</span>
				<# } #>

				<select {{{ data.weight.link }}}>

					<# _.each( data.weight.choices, function( label, choice ) { #>

						<option value="{{ choice }}" <# if ( choice === data.weight.value ) { #> selected="selected" <# } #>>{{ label }}</option>

					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.style && data.style.choices ) { #>

			<li class="typography-font-style">

				<# if ( data.style.label ) { #>
					<span class="customize-control-title">{{ data.style.label }}</span>
				<# } #>

				<select {{{ data.style.link }}}>

					<# _.each( data.style.choices, function( label, choice ) { #>

						<option value="{{ choice }}" <# if ( choice === data.style.value ) { #> selected="selected" <# } #>>{{ label }}</option>

					<# } ) #>

				</select>
			</li>
		<# } #>

		<# if ( data.size ) { #>

			<li class="typography-font-size">

				<# if ( data.size.label ) { #>
					<span class="customize-control-title">{{ data.size.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.size.link }}} value="{{ data.size.value }}" />

			</li>
		<# } #>

		<# if ( data.line_height ) { #>

			<li class="typography-line-height">

				<# if ( data.line_height.label ) { #>
					<span class="customize-control-title">{{ data.line_height.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.line_height.link }}} value="{{ data.line_height.value }}" />

			</li>
		<# } #>

		<# if ( data.letter_spacing ) { #>

			<li class="typography-letter-spacing">

				<# if ( data.letter_spacing.label ) { #>
					<span class="customize-control-title">{{ data.letter_spacing.label }} (px)</span>
				<# } #>

				<input type="number" min="1" {{{ data.letter_spacing.link }}} value="{{ data.letter_spacing.value }}" />

			</li>
		<# } #>

		</ul>
	<?php }

	/**
	 * Returns the available fonts.  Fonts should have available weights, styles, and subsets.
	 *
	 * @todo Integrate with Google fonts.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_fonts() { return array(); }

	/**
	 * Returns the available font families.
	 *
	 * @todo Pull families from `get_fonts()`.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	function get_font_families() {

		return array(
			'' => __( 'No Fonts', 'vw-healthcare' ),
        'Abril Fatface' => __( 'Abril Fatface', 'vw-healthcare' ),
        'Acme' => __( 'Acme', 'vw-healthcare' ),
        'Anton' => __( 'Anton', 'vw-healthcare' ),
        'Architects Daughter' => __( 'Architects Daughter', 'vw-healthcare' ),
        'Arimo' => __( 'Arimo', 'vw-healthcare' ),
        'Arsenal' => __( 'Arsenal', 'vw-healthcare' ),
        'Arvo' => __( 'Arvo', 'vw-healthcare' ),
        'Alegreya' => __( 'Alegreya', 'vw-healthcare' ),
        'Alfa Slab One' => __( 'Alfa Slab One', 'vw-healthcare' ),
        'Averia Serif Libre' => __( 'Averia Serif Libre', 'vw-healthcare' ),
        'Bangers' => __( 'Bangers', 'vw-healthcare' ),
        'Boogaloo' => __( 'Boogaloo', 'vw-healthcare' ),
        'Bad Script' => __( 'Bad Script', 'vw-healthcare' ),
        'Bitter' => __( 'Bitter', 'vw-healthcare' ),
        'Bree Serif' => __( 'Bree Serif', 'vw-healthcare' ),
        'BenchNine' => __( 'BenchNine', 'vw-healthcare' ),
        'Cabin' => __( 'Cabin', 'vw-healthcare' ),
        'Cardo' => __( 'Cardo', 'vw-healthcare' ),
        'Courgette' => __( 'Courgette', 'vw-healthcare' ),
        'Cherry Swash' => __( 'Cherry Swash', 'vw-healthcare' ),
        'Cormorant Garamond' => __( 'Cormorant Garamond', 'vw-healthcare' ),
        'Crimson Text' => __( 'Crimson Text', 'vw-healthcare' ),
        'Cuprum' => __( 'Cuprum', 'vw-healthcare' ),
        'Cookie' => __( 'Cookie', 'vw-healthcare' ),
        'Chewy' => __( 'Chewy', 'vw-healthcare' ),
        'Days One' => __( 'Days One', 'vw-healthcare' ),
        'Dosis' => __( 'Dosis', 'vw-healthcare' ),
        'Droid Sans' => __( 'Droid Sans', 'vw-healthcare' ),
        'Economica' => __( 'Economica', 'vw-healthcare' ),
        'Fredoka One' => __( 'Fredoka One', 'vw-healthcare' ),
        'Fjalla One' => __( 'Fjalla One', 'vw-healthcare' ),
        'Francois One' => __( 'Francois One', 'vw-healthcare' ),
        'Frank Ruhl Libre' => __( 'Frank Ruhl Libre', 'vw-healthcare' ),
        'Gloria Hallelujah' => __( 'Gloria Hallelujah', 'vw-healthcare' ),
        'Great Vibes' => __( 'Great Vibes', 'vw-healthcare' ),
        'Handlee' => __( 'Handlee', 'vw-healthcare' ),
        'Hammersmith One' => __( 'Hammersmith One', 'vw-healthcare' ),
        'Inconsolata' => __( 'Inconsolata', 'vw-healthcare' ),
        'Indie Flower' => __( 'Indie Flower', 'vw-healthcare' ),
        'IM Fell English SC' => __( 'IM Fell English SC', 'vw-healthcare' ),
        'Julius Sans One' => __( 'Julius Sans One', 'vw-healthcare' ),
        'Josefin Slab' => __( 'Josefin Slab', 'vw-healthcare' ),
        'Josefin Sans' => __( 'Josefin Sans', 'vw-healthcare' ),
        'Kanit' => __( 'Kanit', 'vw-healthcare' ),
        'Lobster' => __( 'Lobster', 'vw-healthcare' ),
        'Lato' => __( 'Lato', 'vw-healthcare' ),
        'Lora' => __( 'Lora', 'vw-healthcare' ),
        'Libre Baskerville' => __( 'Libre Baskerville', 'vw-healthcare' ),
        'Lobster Two' => __( 'Lobster Two', 'vw-healthcare' ),
        'Merriweather' => __( 'Merriweather', 'vw-healthcare' ),
        'Monda' => __( 'Monda', 'vw-healthcare' ),
        'Montserrat' => __( 'Montserrat', 'vw-healthcare' ),
        'Muli' => __( 'Muli', 'vw-healthcare' ),
        'Marck Script' => __( 'Marck Script', 'vw-healthcare' ),
        'Noto Serif' => __( 'Noto Serif', 'vw-healthcare' ),
        'Open Sans' => __( 'Open Sans', 'vw-healthcare' ),
        'Overpass' => __( 'Overpass', 'vw-healthcare' ),
        'Overpass Mono' => __( 'Overpass Mono', 'vw-healthcare' ),
        'Oxygen' => __( 'Oxygen', 'vw-healthcare' ),
        'Orbitron' => __( 'Orbitron', 'vw-healthcare' ),
        'Patua One' => __( 'Patua One', 'vw-healthcare' ),
        'Pacifico' => __( 'Pacifico', 'vw-healthcare' ),
        'Padauk' => __( 'Padauk', 'vw-healthcare' ),
        'Playball' => __( 'Playball', 'vw-healthcare' ),
        'Playfair Display' => __( 'Playfair Display', 'vw-healthcare' ),
        'PT Sans' => __( 'PT Sans', 'vw-healthcare' ),
        'Philosopher' => __( 'Philosopher', 'vw-healthcare' ),
        'Permanent Marker' => __( 'Permanent Marker', 'vw-healthcare' ),
        'Poiret One' => __( 'Poiret One', 'vw-healthcare' ),
        'Quicksand' => __( 'Quicksand', 'vw-healthcare' ),
        'Quattrocento Sans' => __( 'Quattrocento Sans', 'vw-healthcare' ),
        'Raleway' => __( 'Raleway', 'vw-healthcare' ),
        'Rubik' => __( 'Rubik', 'vw-healthcare' ),
        'Rokkitt' => __( 'Rokkitt', 'vw-healthcare' ),
        'Russo One' => __( 'Russo One', 'vw-healthcare' ),
        'Righteous' => __( 'Righteous', 'vw-healthcare' ),
        'Slabo' => __( 'Slabo', 'vw-healthcare' ),
        'Source Sans Pro' => __( 'Source Sans Pro', 'vw-healthcare' ),
        'Shadows Into Light Two' => __( 'Shadows Into Light Two', 'vw-healthcare'),
        'Shadows Into Light' => __( 'Shadows Into Light', 'vw-healthcare' ),
        'Sacramento' => __( 'Sacramento', 'vw-healthcare' ),
        'Shrikhand' => __( 'Shrikhand', 'vw-healthcare' ),
        'Tangerine' => __( 'Tangerine', 'vw-healthcare' ),
        'Ubuntu' => __( 'Ubuntu', 'vw-healthcare' ),
        'VT323' => __( 'VT323', 'vw-healthcare' ),
        'Varela Round' => __( 'Varela Round', 'vw-healthcare' ),
        'Vampiro One' => __( 'Vampiro One', 'vw-healthcare' ),
        'Vollkorn' => __( 'Vollkorn', 'vw-healthcare' ),
        'Volkhov' => __( 'Volkhov', 'vw-healthcare' ),
        'Yanone Kaffeesatz' => __( 'Yanone Kaffeesatz', 'vw-healthcare' )
		);
	}

	/**
	 * Returns the available font weights.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_font_weight_choices() {

		return array(
			'' => esc_html__( 'No Fonts weight', 'vw-healthcare' ),
			'100' => esc_html__( 'Thin',       'vw-healthcare' ),
			'300' => esc_html__( 'Light',      'vw-healthcare' ),
			'400' => esc_html__( 'Normal',     'vw-healthcare' ),
			'500' => esc_html__( 'Medium',     'vw-healthcare' ),
			'700' => esc_html__( 'Bold',       'vw-healthcare' ),
			'900' => esc_html__( 'Ultra Bold', 'vw-healthcare' ),
		);
	}

	/**
	 * Returns the available font styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function get_font_style_choices() {

		return array(
			'' => esc_html__( 'No Fonts Style', 'vw-healthcare' ),
			'normal'  => esc_html__( 'Normal', 'vw-healthcare' ),
			'italic'  => esc_html__( 'Italic', 'vw-healthcare' ),
			'oblique' => esc_html__( 'Oblique', 'vw-healthcare' )
		);
	}
}
