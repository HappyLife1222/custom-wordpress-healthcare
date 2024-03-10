<?php
/**
 * Online Pharmacy Customizer Sortable Control.
 * 
 * @package Online Pharmacy
 */
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Exit if WP_Customize_Control does not exsist.
if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return null;
}

/**
 * Sortable control (uses checkboxes).
 */
class Online_Pharmacy_Control_Sortable extends WP_Customize_Control {

	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'online-pharmacy-sortable';

    public function enqueue() {
    	wp_enqueue_style( 'online_pharmacy-sortable-control', get_parent_theme_file_uri( '/assets/css/controls/sortable.css' ), false, '1.0.0', 'all' );
    	wp_enqueue_script( 'online_pharmacy-sortable-control-scripts', get_parent_theme_file_uri( '/assets/js/controls/sortable.js' ), array( 'jquery' ), '1.0.0', true );
    }

	/**
	 * Refresh the parameters passed to the JavaScript via JSON.
	 *
	 * @see WP_Customize_Control::to_json()
	 */
	public function to_json() {

		parent::to_json();

		$this->json['default'] = $this->setting->default;
		if ( isset( $this->default ) ) {
			$this->json['default'] = $this->default;
		}

		$this->json['id']         = $this->id;
		$this->json['link']       = $this->get_link();
		$this->json['value']      = maybe_unserialize( $this->value() );
		$this->json['choices']    = $this->choices;
		$this->json['inputAttrs'] = '';

		foreach ( $this->input_attrs as $attr => $value ) {
			$this->json['inputAttrs'] .= $attr . '="' . esc_attr( $value ) . '" ';
		}
		$this->json['inputAttrs'] = maybe_serialize( $this->input_attrs() );

	}

	/**
	 * An Underscore (JS) template for this control's content (but not its container).
	 *
	 * Class variables for this control class are available in the `data` JS object;
	 * export custom variables by overriding {@see WP_Customize_Control::to_json()}.
	 *
	 * @see WP_Customize_Control::print_template()
	 *
	 * @access protected
	 */
	protected function content_template() {
		?>
	<label class="customize-control-online-pharmacy-sortable">
	  <span class="customize-control-title">
	    {{{ data.label }}}
	  </span>
	  <# if ( data.description ) { #>
	    <span class="customize-control-description">{{{ data.description }}}</span>
	  <# } #>

	  <ul class="sortable">
	    <# _.each( data.value, function( choiceID ) { #>
	      <li {{{ data.inputAttrs }}} class="online-pharmacy-sortable-item" data-value="{{ choiceID }}">
	        <span>{{{ data.choices[ choiceID ] }}}</span>
	        <i class="dashicons dashicons-visibility visibility"></i>
	      </li>
	    <# }); #>
	    <# _.each( data.choices, function( choiceLabel, choiceID ) { #>
	      <# if ( -1 === data.value.indexOf( choiceID ) ) { #>
	        <li {{{ data.inputAttrs }}} class="online-pharmacy-sortable-item invisible" data-value="{{ choiceID }}">
	          <span>{{{ data.choices[ choiceID ] }}}</span>
	          <i class="dashicons dashicons-visibility visibility"></i>
	        </li>
	      <# } #>
	    <# }); #>
	  </ul>
	</label>


		<?php
	}

	/**
	 * Render the control's content.
	 *
	 * @see WP_Customize_Control::render_content()
	 */
	protected function render_content() {}
}

