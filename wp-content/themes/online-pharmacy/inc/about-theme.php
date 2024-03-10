<?php
/**
 * Online Pharmacy Theme Page
 *
 * @package Online Pharmacy
 */

function online_pharmacy_admin_scripts() {
	wp_dequeue_script('online-pharmacy-custom-scripts');
}
add_action( 'admin_enqueue_scripts', 'online_pharmacy_admin_scripts' );

if ( ! defined( 'ONLINE_PHARMACY_FREE_THEME_URL' ) ) {
	define( 'ONLINE_PHARMACY_FREE_THEME_URL', 'https://www.themespride.com/themes/free-pharmacy-wordpress-theme/' );
}
if ( ! defined( 'ONLINE_PHARMACY_PRO_THEME_URL' ) ) {
	define( 'ONLINE_PHARMACY_PRO_THEME_URL', 'https://www.themespride.com/themes/online-pharmacy-wordpress-theme/' );
}
if ( ! defined( 'ONLINE_PHARMACY_DEMO_THEME_URL' ) ) {
	define( 'ONLINE_PHARMACY_DEMO_THEME_URL', 'https://www.themespride.com/online-pharmacy-pro/' );
}
if ( ! defined( 'ONLINE_PHARMACY_DOCS_THEME_URL' ) ) {
    define( 'ONLINE_PHARMACY_DOCS_THEME_URL', 'https://www.themespride.com/demo/docs/online-pharmacy-lite/' );
}
if ( ! defined( 'ONLINE_PHARMACY_RATE_THEME_URL' ) ) {
    define( 'ONLINE_PHARMACY_RATE_THEME_URL', 'https://wordpress.org/support/theme/online-pharmacy/reviews/#new-post' );
}
if ( ! defined( 'ONLINE_PHARMACY_CHANGELOG_THEME_URL' ) ) {
    define( 'ONLINE_PHARMACY_CHANGELOG_THEME_URL', get_template_directory() . '/readme.txt' );
}
if ( ! defined( 'ONLINE_PHARMACY_SUPPORT_THEME_URL' ) ) {
    define( 'ONLINE_PHARMACY_SUPPORT_THEME_URL', 'https://wordpress.org/support/theme/online-pharmacy' );
}

/**
 * Add theme page
 */
function online_pharmacy_menu() {
	add_theme_page( esc_html__( 'About Theme', 'online-pharmacy' ), esc_html__( 'About Theme', 'online-pharmacy' ), 'edit_theme_options', 'online-pharmacy-about', 'online_pharmacy_about_display' );
}
add_action( 'admin_menu', 'online_pharmacy_menu' );

/**
 * Display About page
 */
function online_pharmacy_about_display() {
	$online_pharmacy_theme = wp_get_theme();
	?>
	<div class="wrap about-wrap full-width-layout">
		<h1><?php echo esc_html( $online_pharmacy_theme ); ?></h1>
		<div class="about-theme">
			<div class="theme-description">
				<p class="about-text">
					<?php
					// Remove last sentence of description.
					$online_pharmacy_description = explode( '. ', $online_pharmacy_theme->get( 'Description' ) );

					array_pop( $online_pharmacy_description );

					$online_pharmacy_description = implode( '. ', $online_pharmacy_description );

					echo esc_html( $online_pharmacy_description . '.' );
				?></p>
				<p class="actions">
					<a href="<?php echo esc_url( ONLINE_PHARMACY_FREE_THEME_URL ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'Theme Info', 'online-pharmacy' ); ?></a>

					<a href="<?php echo esc_url( ONLINE_PHARMACY_DEMO_THEME_URL ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'View Demo', 'online-pharmacy' ); ?></a>

					<a href="<?php echo esc_url( ONLINE_PHARMACY_DOCS_THEME_URL ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'Theme Instructions', 'online-pharmacy' ); ?></a>

					<a href="<?php echo esc_url( ONLINE_PHARMACY_RATE_THEME_URL ); ?>" class="button button-secondary" target="_blank"><?php esc_html_e( 'Rate this theme', 'online-pharmacy' ); ?></a>

					<a href="<?php echo esc_url( ONLINE_PHARMACY_PRO_THEME_URL ); ?>" class="green button button-secondary" target="_blank"><?php esc_html_e( 'Upgrade to pro', 'online-pharmacy' ); ?></a>
				</p>
			</div>

			<div class="theme-screenshot">
				<img src="<?php echo esc_url( $online_pharmacy_theme->get_screenshot() ); ?>" />
			</div>

		</div>

		<nav class="nav-tab-wrapper wp-clearfix" aria-label="<?php esc_attr_e( 'Secondary menu', 'online-pharmacy' ); ?>">
			<a href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'online-pharmacy-about' ), 'themes.php' ) ) ); ?>" class="nav-tab<?php echo ( isset( $_GET['page'] ) && 'online-pharmacy-about' === $_GET['page'] && ! isset( $_GET['tab'] ) ) ?' nav-tab-active' : ''; ?>"><?php esc_html_e( 'About', 'online-pharmacy' ); ?></a>

			<a href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'online-pharmacy-about', 'tab' => 'free_vs_pro' ), 'themes.php' ) ) ); ?>" class="nav-tab<?php echo ( isset( $_GET['tab'] ) && 'free_vs_pro' === $_GET['tab'] ) ?' nav-tab-active' : ''; ?>"><?php esc_html_e( 'Compare free Vs Pro', 'online-pharmacy' ); ?></a>

			<a href="<?php echo esc_url( admin_url( add_query_arg( array( 'page' => 'online-pharmacy-about', 'tab' => 'changelog' ), 'themes.php' ) ) ); ?>" class="nav-tab<?php echo ( isset( $_GET['tab'] ) && 'changelog' === $_GET['tab'] ) ?' nav-tab-active' : ''; ?>"><?php esc_html_e( 'Changelog', 'online-pharmacy' ); ?></a>
		</nav>

		<?php
			online_pharmacy_main_screen();

			online_pharmacy_changelog_screen();

			online_pharmacy_free_vs_pro();
		?>

		<div class="return-to-dashboard">
			<?php if ( current_user_can( 'update_core' ) && isset( $_GET['updated'] ) ) : ?>
				<a href="<?php echo esc_url( self_admin_url( 'update-core.php' ) ); ?>">
					<?php is_multisite() ? esc_html_e( 'Return to Updates', 'online-pharmacy' ) : esc_html_e( 'Return to Dashboard &rarr; Updates', 'online-pharmacy' ); ?>
				</a> |
			<?php endif; ?>
			<a href="<?php echo esc_url( self_admin_url() ); ?>"><?php is_blog_admin() ? esc_html_e( 'Go to Dashboard &rarr; Home', 'online-pharmacy' ) : esc_html_e( 'Go to Dashboard', 'online-pharmacy' ); ?></a>
		</div>
	</div>
	<?php
}

/**
 * Output the main about screen.
 */
function online_pharmacy_main_screen() {
	if ( isset( $_GET['page'] ) && 'online-pharmacy-about' === $_GET['page'] && ! isset( $_GET['tab'] ) ) {
	?>
		<div class="feature-section two-col">
			<div class="col card">
				<h2 class="title"><?php esc_html_e( 'Theme Customizer', 'online-pharmacy' ); ?></h2>
				<p><?php esc_html_e( 'All Theme Options are available via Customize screen.', 'online-pharmacy' ) ?></p>
				<p><a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Customize', 'online-pharmacy' ); ?></a></p>
			</div>

			<div class="col card">
				<h2 class="title"><?php esc_html_e( 'Got theme support question?', 'online-pharmacy' ); ?></h2>
				<p><?php esc_html_e( 'Get genuine support from genuine people. Whether it\'s customization or compatibility, our seasoned developers deliver tailored solutions to your queries.', 'online-pharmacy' ) ?></p>
				<p><a href="<?php echo esc_url( ONLINE_PHARMACY_SUPPORT_THEME_URL ); ?>" class="button button-primary"target="_blank"><?php esc_html_e( 'Support Forum', 'online-pharmacy' ); ?></a></p>
			</div>

			<div class="col card">
				<h2 class="title"><?php esc_html_e( 'Upgrade To Premium With Straight 20% OFF.', 'online-pharmacy' ); ?></h2>
				<p><?php esc_html_e( 'Get our amazing WordPress theme with exclusive 20% off use the coupon', 'online-pharmacy' ) ?>"<input type="text" value="GETPro20" id="myInput">".</p>
				<button class="button button-primary" onclick="online_pharmacy_text_copyied()"><?php esc_html_e( 'GETPro20', 'online-pharmacy' ); ?></button>
			</div>
		</div>
	<?php
	}
}

/**
 * Output the changelog screen.
 */
function online_pharmacy_changelog_screen() {
	if ( isset( $_GET['tab'] ) && 'changelog' === $_GET['tab'] ) {
		global $wp_filesystem;
	?>
		<div class="wrap about-wrap">

			<p class="about-description"><?php esc_html_e( 'View changelog below:', 'online-pharmacy' ); ?></p>

			<?php
				$changelog_file = apply_filters( 'online_pharmacy_changelog_file', ONLINE_PHARMACY_CHANGELOG_THEME_URL );
				// Check if the changelog file exists and is readable.
				if ( $changelog_file && is_readable( $changelog_file ) ) {
					WP_Filesystem();
					$changelog = $wp_filesystem->get_contents( $changelog_file );
					$changelog_list = online_pharmacy_parse_changelog( $changelog );

					echo wp_kses_post( $changelog_list );
				}
			?>
		</div>
	<?php
	}
}

/**
 * Parse changelog from readme file.
 * @param  string $content
 * @return string
 */
function online_pharmacy_parse_changelog( $content ) {
	// Explode content with ==  to juse separate main content to array of headings.
	$content = explode ( '== ', $content );

	$changelog_isolated = '';

	// Get element with 'Changelog ==' as starting string, i.e isolate changelog.
	foreach ( $content as $key => $value ) {
		if (strpos( $value, 'Changelog ==') === 0) {
	    	$changelog_isolated = str_replace( 'Changelog ==', '', $value );
	    }
	}

	// Now Explode $changelog_isolated to manupulate it to add html elements.
	$changelog_array = explode( '= ', $changelog_isolated );

	// Unset first element as it is empty.
	unset( $changelog_array[0] );

	$changelog = '<pre class="changelog">';

	foreach ( $changelog_array as $value) {
		// Replace all enter (\n) elements with </span><span> , opening and closing span will be added in next process.
		$value = preg_replace( '/\n+/', '</span><span>', $value );

		// Add openinf and closing div and span, only first span element will have heading class.
		$value = '<div class="block"><span class="heading">= ' . $value . '</span></div>';

		// Remove empty <span></span> element which newr formed at the end.
		$changelog .= str_replace( '<span></span>', '', $value );
	}

	$changelog .= '</pre>';

	return wp_kses_post( $changelog );
}

/**
 * Import Demo data for theme using catch themes demo import plugin
 */
function online_pharmacy_free_vs_pro() {
	if ( isset( $_GET['tab'] ) && 'free_vs_pro' === $_GET['tab'] ) {
	?>
		<div class="wrap about-wrap">

			<p class="about-description"><?php esc_html_e( 'View Free vs Pro Table below:', 'online-pharmacy' ); ?></p>
			<div class="vs-theme-table">
				<table>
					<thead>
						<tr><th scope="col"></th>
							<th class="head" scope="col"><?php esc_html_e( 'Free Theme', 'online-pharmacy' ); ?></th>
							<th class="head" scope="col"><?php esc_html_e( 'Pro Theme', 'online-pharmacy' ); ?></th>
						</tr>
					</thead>
					<tbody>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><span><?php esc_html_e( 'Theme Demo Set Up', 'online-pharmacy' ); ?></span></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Additional Templates, Color options and Fonts', 'online-pharmacy' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Included Demo Content', 'online-pharmacy' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Section Ordering', 'online-pharmacy' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Multiple Sections', 'online-pharmacy' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Additional Plugins', 'online-pharmacy' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Premium Technical Support', 'online-pharmacy' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Access to Support Forums', 'online-pharmacy' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Free updates', 'online-pharmacy' ); ?></td>
							<td><span class="dashicons dashicons-no-alt"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Unlimited Domains', 'online-pharmacy' ); ?></td>
							<td><span class="dashicons dashicons-saved"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Responsive Design', 'online-pharmacy' ); ?></td>
							<td><span class="dashicons dashicons-saved"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td headers="features" class="feature"><?php esc_html_e( 'Live Customizer', 'online-pharmacy' ); ?></td>
							<td><span class="dashicons dashicons-saved"></span></td>
							<td><span class="dashicons dashicons-saved"></span></td>
						</tr>
						<tr class="odd" scope="row">
							<td class="feature feature--empty"></td>
							<td class="feature feature--empty"></td>
							<td headers="comp-2" class="td-btn-2"><a class="sidebar-button single-btn" href="<?php echo esc_url(ONLINE_PHARMACY_PRO_THEME_URL);?>" target="_blank"><?php esc_html_e( 'Go for Premium', 'online-pharmacy' ); ?></a></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	<?php
	}
}
