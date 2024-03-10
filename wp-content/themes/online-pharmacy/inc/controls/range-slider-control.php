<?php
/**
 * Range Button Customizer Control
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
 * This class is for the range control in the Customizer.
 *
 * @access public
 */
/** Range Control */
class Online_Pharmacy_Range_Slider extends WP_Customize_Control {
    /**
     * Enqueue scripts and styles.
     *
     * @access public
     * @since  1.0.0
     * @return void
     */
    public function enqueue() {
        wp_enqueue_style( 'online_pharmacy-range-control-styles', get_parent_theme_file_uri( '/assets/css/controls/range.css' ), false, '1.0.0', 'all' );
        wp_enqueue_script( 'online_pharmacy-range-control-scripts', get_parent_theme_file_uri( '/assets/js/controls/range.js' ), array( 'jquery' ), '1.0.0', true );
    }
    /**
     * The type of control being rendered
     */
    public $type = 'ms-range-slider';
    public $unit = '';

    public function __construct($manager, $id, $args = array()) {
        if (isset($args['unit'])) {
            $this->unit = $args['unit'];
        }
        parent::__construct($manager, $id, $args);
    }

    /**
     * Render the control in the customizer
     */
    public function render_content() {
        ?>
        <span class="customize-control-title">
            <?php echo esc_html($this->label); ?>
           
        </span>

        <div class="control-wrap"> 
            <div class="ms-range-slider" slider-min-value="<?php echo esc_attr($this->input_attrs['min']); ?>" slider-max-value="<?php echo esc_attr($this->input_attrs['max']); ?>" slider-step-value="<?php echo esc_attr($this->input_attrs['step']); ?>"></div>
            <div class="ms-range-slider-input">
                <input type="number" value="<?php echo esc_attr($this->value()); ?>" class="ms-slider-input" <?php $this->link(); ?> />
            </div>
            <div class="ms-slider-reset dashicons dashicons-image-rotate" slider-reset-value="10"></div>

            <?php if ($this->unit) { ?>
                <div class="ms-range-slider-unit">
                    <?php echo esc_html($this->unit); ?>
                </div>
            <?php } ?>
        </div>

        <?php
        if ($this->description) {
            ?>
            <span class="description customize-control-description">
                <?php echo wp_kses_post($this->description); ?>
            </span>
            <?php
        }
    }

}
