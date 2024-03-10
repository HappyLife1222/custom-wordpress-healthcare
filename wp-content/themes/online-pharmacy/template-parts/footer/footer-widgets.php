<?php
/**
 * Displays footer widgets if assigned
 *
 * @package Online Pharmacy
 * @subpackage online_pharmacy
 */

?>


<?php


// Determine the number of columns dynamically for the footer (you can replace this with your logic).
$number_of_footer_columns = get_theme_mod('online_pharmacy_footer_columns', 4); // Change this value as needed.

// Calculate the Bootstrap class for large screens (col-lg-X) for footer.
$col_lg_footer_class = 'col-lg-' . (12 / $number_of_footer_columns);

// Calculate the Bootstrap class for medium screens (col-md-X) for footer.
$col_md_footer_class = 'col-md-' . (12 / $number_of_footer_columns);
?>
<div class="container">
    <aside class="widget-area row" role="complementary" aria-label="<?php esc_attr_e( 'Footer', 'online-pharmacy' ); ?>">
        <div class="<?php echo esc_attr($col_lg_footer_class); ?> <?php echo esc_attr($col_md_footer_class); ?>">
            <?php dynamic_sidebar('footer-1'); ?>
        </div>
        <?php
        // Footer boxes 2 and onwards.
        for ($i = 2; $i <= $number_of_footer_columns; $i++) :
            if ($i <= $number_of_footer_columns) :
                ?>
               <div class="col-12 <?php echo esc_attr($col_lg_footer_class); ?> <?php echo esc_attr($col_md_footer_class); ?>">
                    <?php dynamic_sidebar('footer-' . $i); ?>
                </div><!-- .footer-one-box -->
                <?php
            endif;
        endfor;
        ?>
    </aside>
</div>