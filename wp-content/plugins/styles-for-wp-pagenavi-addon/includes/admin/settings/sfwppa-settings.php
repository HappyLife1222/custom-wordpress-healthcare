<?php
/**
 * Settings Page
 *
 * @package Styles For WP Pagenavi Addon
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;
?>

<div class="wrap sfwppa-settings-form-settings">

	<h2><?php _e( 'Styles For Pagenavi Settings', 'styles-for-wp-pagenavi-addon' ); ?></h2><br />
	<form action="options.php" method="POST" id="sfwppa-settings-form" class="sfwppa-settings-form">
	
	<?php
	    settings_fields( 'sfwppa_plugin_options' );
	    global $sfwppa_options , $wp_version;
	?>
	
	<!-- General Settings Starts -->
	<div id="sfwppa-general-sett" class="post-box-container sfwppa-general-sett">
		<div class="metabox-holder">
			<div class="meta-box-sortables ui-sortable">
				<div id="general" class="postbox">

					<div class="postbox-header">
						<!-- Settings box title -->
						<h2 class="hndle">
							<span><?php _e( 'General Settings', 'styles-for-wp-pagenavi-addon' ); ?></span>
						</h2>
					</div>	
						
						<div class="inside">
						
						<table class="form-table sfwppa-general-sett-tbl">
							<tbody>
								<tr>
                                    <th scope="row">
                                        <label for="mpp-default-thumbnail"><?php _e('Select Style', 'styles-for-wp-pagenavi-addon'); ?>:</label>
                                    </th>
                                    <td>
	                                    <?php
		                                    $options = sfwppa_get_option('menu_arr');
		                                   	$items = sfwppa_menu_popup_layout();
											
												echo "<select id='drop_down1' name='sfwppa_options[menu_arr]'>";
												foreach($items as $key => $item) {
													echo "<option value='$key' ".selected($options, $key, false).">$item</option>";
												}
											echo "</select>";
										?>
                                    </td>
								</tr>

								<tr>
									<th scope="row">
										<label for="sfwppa-default-title"><?php _e('Font Size', 'styles-for-wp-pagenavi-addon'); ?>:</label>
									</th>
									<td>
										<input type="number" name="sfwppa_options[font_size]" value="<?php echo sfwppa_get_option('font_size'); ?>" id="wpspw-pro-default-text" class="regular-text" />px<br/>
										<span class="description"><?php _e('Select font size. Leave empty for default font size 12px.', 'styles-for-wp-pagenavi-addon'); ?></span>
									</td>
								</tr><!-- Font Size -->

								<tr>
									<th scope="row">
										<label for="sfwppa-post-title-clr"><?php _e('Font Color', 'styles-for-wp-pagenavi-addon'); ?>:</label>
									</th>
									<td>
										<?php if( $wp_version >= 3.5 ) { ?>
											<input type="text" name="sfwppa_options[font_color]" value="<?php echo sfwppa_get_option('font_color'); ?>" id="sfwppa-post-title-clr" class="sfwppa-color-box sfwppa-post-title-clr" /><br/>
										<?php } else { ?>
											<div style='position:relative;'>
												<input type='text' name="sfwppa_options[font_color]" value="<?php echo sfwppa_get_option('font_color'); ?>" class="sfwppa-color-box-farbtastic-inp" data-default-color="" />
												<input type="button" class="sfwppa-color-box-farbtastic button button-secondary" value="<?php _e('Select Color', 'styles-for-wp-pagenavi-addon'); ?>" />
												<div class="colorpicker" style="background-color: #666; z-index:100; position:absolute; display:block;"></div>
											</div>
										<?php } ?>
											
											<span class="description"><?php _e('Select Fonts Color. Leave empty for default color.', 'styles-for-wp-pagenavi-addon'); ?></span>
									</td>
								</tr><!--Font Color -->

								<tr>
									<th scope="row">
										<label for="sfwppa-post-title-clr"><?php _e(' Border Color', 'styles-for-wp-pagenavi-addon'); ?>:</label>
									</th>
									<td>
										<?php if( $wp_version >= 3.5 ) { ?>
											<input type="text" name="sfwppa_options[border_color]" value="<?php echo sfwppa_get_option('border_color'); ?>" id="sfwppa-post-title-clr" class="sfwppa-color-box sfwppa-post-title-clr" /><br/>
										<?php } else { ?>
											<div style='position:relative;'>
												<input type='text' name="sfwppa_options[border_color]" value="<?php echo sfwppa_get_option('border_color'); ?>" class="sfwppa-color-box-farbtastic-inp" data-default-color="" />
												<input type="button" class="sfwppa-color-box-farbtastic button button-secondary" value="<?php _e('Select Color', 'styles-for-wp-pagenavi-addon'); ?>" />
												<div class="colorpicker" style="background-color: #666; z-index:100; position:absolute; display:block;"></div>
											</div>
										<?php } ?>
											
											<span class="description"><?php _e('Select Border Color. Leave empty for border color.', 'styles-for-wp-pagenavi-addon'); ?></span>
									</td>
								</tr><!-- border color -->

								<tr>
									<th scope="row">
										<label for="sfwppa-post-title-clr"><?php _e('Active Background Color', 'styles-for-wp-pagenavi-addon'); ?>:</label>
									</th>
									<td>
										<?php if( $wp_version >= 3.5 ) { ?>
											<input type="text" name="sfwppa_options[active_bg_color]" value="<?php echo sfwppa_get_option('active_bg_color'); ?>" id="sfwppa-post-title-clr" class="sfwppa-color-box sfwppa-post-title-clr" /><br/>
										<?php } else { ?>
											<div style='position:relative;'>
												<input type='text' name="sfwppa_options[active_bg_color]" value="<?php echo sfwppa_get_option('active_bg_color'); ?>" class="sfwppa-color-box-farbtastic-inp" data-default-color="" />
												<input type="button" class="sfwppa-color-box-farbtastic button button-secondary" value="<?php _e('Select Color', 'styles-for-wp-pagenavi-addon'); ?>" />
												<div class="colorpicker" style="background-color: #666; z-index:100; position:absolute; display:block;"></div>
											</div>
										<?php } ?>
											
											<span class="description"><?php _e('Select Active Background Color. Leave empty for default active background color.', 'styles-for-wp-pagenavi-addon'); ?></span>
									</td>
								</tr><!-- Active Background Color -->

								<tr>
									<th scope="row">
										<label for="sfwppa-post-title-clr"><?php _e('Hover Background Color', 'styles-for-wp-pagenavi-addon'); ?>:</label>
									</th>
									<td>
										<?php if( $wp_version >= 3.5 ) { ?>
											<input type="text" name="sfwppa_options[hover_bg_color]" value="<?php echo sfwppa_get_option('hover_bg_color'); ?>" id="sfwppa-post-title-clr" class="sfwppa-color-box sfwppa-post-title-clr" /><br/>
										<?php } else { ?>
											<div style='position:relative;'>
												<input type='text' name="sfwppa_options[hover_bg_color]" value="<?php echo sfwppa_get_option('hover_bg_color'); ?>" class="sfwppa-color-box-farbtastic-inp" data-default-color="" />
												<input type="button" class="sfwppa-color-box-farbtastic button button-secondary" value="<?php _e('Select Color', 'styles-for-wp-pagenavi-addon'); ?>" />
												<div class="colorpicker" style="background-color: #666; z-index:100; position:absolute; display:block;"></div>
											</div>
										<?php } ?>
											
											<span class="description"><?php _e('Select Hover Background Color. Leave empty for default hover background color.', 'styles-for-wp-pagenavi-addon'); ?></span>
									</td>
								</tr><!-- Hover Background Color -->

								<tr>
									<th scope="row">
										<label for="sfwppa-post-title-clr"><?php _e('Active Text Color', 'styles-for-wp-pagenavi-addon'); ?>:</label>
									</th>
									<td>
										<?php if( $wp_version >= 3.5 ) { ?>
											<input type="text" name="sfwppa_options[active_text_color]" value="<?php echo sfwppa_get_option('active_text_color'); ?>" id="sfwppa-post-title-clr" class="sfwppa-color-box sfwppa-post-title-clr" /><br/>
										<?php } else { ?>
											<div style='position:relative;'>
												<input type='text' name="sfwppa_options[active_text_color]" value="<?php echo sfwppa_get_option('active_text_color'); ?>" class="sfwppa-color-box-farbtastic-inp" data-default-color="" />
												<input type="button" class="sfwppa-color-box-farbtastic button button-secondary" value="<?php _e('Select Color', 'styles-for-wp-pagenavi-addon'); ?>" />
												<div class="colorpicker" style="background-color: #666; z-index:100; position:absolute; display:block;"></div>
											</div>
										<?php } ?>
											
											<span class="description"><?php _e('Select Active Text Color. Leave empty for default active text color.', 'styles-for-wp-pagenavi-addon'); ?></span>
									</td>
								</tr><!-- Active Text Color -->

								<tr>
									<th scope="row">
										<label for="sfwppa-post-title-clr"><?php _e('Hover Text Color', 'styles-for-wp-pagenavi-addon'); ?>:</label>
									</th>
									<td>
										<?php if( $wp_version >= 3.5 ) { ?>
											<input type="text" name="sfwppa_options[hover_text_color]" value="<?php echo sfwppa_get_option('hover_text_color'); ?>" id="sfwppa-post-title-clr" class="sfwppa-color-box sfwppa-post-title-clr" /><br/>
										<?php } else { ?>
											<div style='position:relative;'>
												<input type='text' name="sfwppa_options[hover_text_color]" value="<?php echo sfwppa_get_option('hover_text_color'); ?>" class="sfwppa-color-box-farbtastic-inp" data-default-color="" />
												<input type="button" class="sfwppa-color-box-farbtastic button button-secondary" value="<?php _e('Select Color', 'styles-for-wp-pagenavi-addon'); ?>" />
												<div class="colorpicker" style="background-color: #666; z-index:100; position:absolute; display:block;"></div>
											</div>
										<?php } ?>
											
											<span class="description"><?php _e('Select Hover Text Color. Leave empty for default hover text color.', 'styles-for-wp-pagenavi-addon'); ?></span>
									</td>
								</tr><!-- Menu Title Color -->

								<tr>
									<td colspan="2" valign="top" scope="row">
										<input type="submit" id="sfwppa-settings-submit" name="sfwppa-settings-submit" class="button button-primary right" value="<?php _e('Save Changes','styles-for-wp-pagenavi-addon'); ?>" />
									</td>
								</tr>
							</tbody>
						 </table>

					</div><!-- .inside -->
				</div><!-- #general -->
			</div><!-- .meta-box-sortables ui-sortable -->
		</div><!-- .metabox-holder -->
	</div><!-- #sfwppa-general-sett -->
	<!-- General Settings Ends -->
	</form>
</div><!-- end .sfwppa-settings-form-settings -->