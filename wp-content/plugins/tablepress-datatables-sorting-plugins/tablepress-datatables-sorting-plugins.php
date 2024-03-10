<?php
/*
Plugin Name: TablePress Extension: Sorting plugins
Plugin URI: https://tablepress.org/extensions/datatables-sorting-plugins/
Description: Custom Extension for TablePress to add more sorting algorithms
Version: 1.1
Requires at least: 6.0
Requires PHP: 7.2
Author: Tobias Bäthge
Author URI: https://tablepress.org/
Update URI: https://tablepress.org/
*/

/*
 * See https://datatables.net/plug-ins/sorting/.
 */

/*
 * Register necessary Plugin Filters.
 */
add_filter( 'tablepress_table_js_options', 'tablepress_enqueue_datatables_sorting_plugins_js', 10, 3 );

/**
 * Enqueue JS files.
 *
 * @since 1.0
 *
 * @param array  $js_options    Current JS options.
 * @param string $table_id      Table ID.
 * @param array $render_options Render Options.
 * @return array Modified JS options.
 */
function tablepress_enqueue_datatables_sorting_plugins_js( array $js_options, string $table_id, array $render_options ): array {
	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	$js_url = plugins_url( "jquery.datatables.sorting-plugins{$suffix}.js", __FILE__ );
	wp_enqueue_script( 'tablepress-datatables-sorting-plugins', $js_url, array( 'tablepress-datatables' ), '1.1', true );
	return $js_options;
}
