<?php
	defined( 'ABSPATH' ) or die( "No script kiddies please!" );
	$enable_bg_image	=	( isset( $iepammenu_item_meta['upload_image_settings']['enable_bg_image'] ) && $iepammenu_item_meta['upload_image_settings']['enable_bg_image'] == 'true' ) ? 'true' : 'false';
	$bg_image_type 		= ( isset( $iepammenu_item_meta['upload_image_settings']['bg_image_type'] ) && $iepammenu_item_meta['upload_image_settings']['bg_image_type'] != '' ) ? esc_attr( $iepammenu_item_meta['upload_image_settings']['bg_image_type'] ) : 'single_image';
?>
<div class="settings_title">
	<h2>
		<?php esc_html_e( 'Background Image Settings', IEPA_TEXT_DOMAIN ); ?>
		<span class="dashicons dashicons-arrow-up"></span>
		<span class="dashicons dashicons-arrow-down"></span>
	</h2>
</div>
<div class="iepa_mega_settings">
	<table class="iepa-widefat">
		<tr>
			<td class="imma_meta_table" style="width: 119px;">
				<label for="enable_bg_image">
					<?php esc_html_e( "Enable Background Image", IEPA_TEXT_DOMAIN ); ?>
				</label>
			</td>
			<td>
				<div class="iepa-mm-switch">
					<input type='checkbox' class='imma_menu_settingss' id="enable_bg_image" name='iepa_settings[upload_image_settings][enable_bg_image]' value='true' <?php echo checked( $enable_bg_image,'true', false ); ?> />
					<label for="enable_bg_image"></label>
				</div>
				<p class="description">
					<?php esc_html_e( "Note: Enable to show Background Image for this menu.", IEPA_TEXT_DOMAIN ); ?>
				</p>
			</td>
		</tr>

		<tr>
			<td class="imma_meta_table">
				<?php esc_html_e( "Background Image Type", IEPA_TEXT_DOMAIN ); ?>
			</td>
			<td>
				<select name='iepa_settings[upload_image_settings][bg_image_type]' class="imma_bgimage_type">
					<option value='single_image' <?php echo selected( $bg_image_type, 'single_image', false ); ?>>
						<?php esc_html_e( "Single Image", IEPA_TEXT_DOMAIN ); ?>
					</option>
					<option value='double_image' <?php echo selected( $bg_image_type, 'double_image', false ); ?>>
						<?php esc_html_e( "Double Image", IEPA_TEXT_DOMAIN ); ?>
					</option>
				</select>
			</td>
		</tr>

		<tr class="toggle_custom_image" id="imma_single_image">
			<td class="imma_meta_table">
				<label>
					<?php esc_html_e( "Choose Bg Image", IEPA_TEXT_DOMAIN ); ?>
				</label>
			</td>
			<td>
				<div class="imma-option-field">
					<input type="hidden" class="imma-sbgimage" name="iepa_settings[upload_image_settings][single_bg_image_url]"
					value="<?php echo ( isset( $iepammenu_item_meta['upload_image_settings']['single_bg_image_url'] ) && $iepammenu_item_meta['upload_image_settings']['single_bg_image_url'] != '' ) ? esc_url( $iepammenu_item_meta['upload_image_settings']['single_bg_image_url'] ) : ''; ?>" />
					<input type="button" class="imma_bgimage_btn button button-primary button-large" id="imma_single_image" name="imma_single_bg_image_url" value="<?php esc_attr_e( 'Upload Background Image', IEPA_TEXT_DOMAIN ) ?>" size="25" />
					<?php
					$img_url = ( isset( $iepammenu_item_meta['upload_image_settings']['single_bg_image_url']) && $iepammenu_item_meta['upload_image_settings']['single_bg_image_url'] != '' ) ? esc_url($iepammenu_item_meta['upload_image_settings']['single_bg_image_url']):'';
					?>
					<div class="imma-option-field imma-bgimage-preview <?php if( $img_url == '' ) { echo esc_attr( 'iepa-d-none' ); } ?>">
						<a class="remove_sbg_image_url" href="#">
							<i class="dashicons dashicons-trash"></i>
						</a>
						<img style="width: 38%;" class="imma-sbg-image" src="<?php echo (isset( $iepammenu_item_meta['upload_image_settings']['single_bg_image_url']) && $iepammenu_item_meta['upload_image_settings']['single_bg_image_url'] != '')?esc_url($iepammenu_item_meta['upload_image_settings']['single_bg_image_url']):'';?>" alt="">
					</div>

				</div>
			</td>
		</tr>

		<tr class="toggle_double_image" id="imma_double_image">
			<td class="imma_meta_table">
				<label>
					<?php esc_html_e( "Choose Two Image", IEPA_TEXT_DOMAIN ); ?>
				</label>
			</td>
			<td>
				<div class="imma-option-field">
					<input type="hidden" class="imma-sbgimage1" name="iepa_settings[upload_image_settings][bg_image_url1]" value="<?php echo (isset( $iepammenu_item_meta['upload_image_settings']['bg_image_url1']) && $iepammenu_item_meta['upload_image_settings']['bg_image_url1'] != '')?esc_url($iepammenu_item_meta['upload_image_settings']['bg_image_url1']):'';?>" />
					<input type="button" class="imma_bgimage_btn button button-primary button-large" id="imma_doubleimage-1" name="imma_bg_image_url1" value="<?php esc_attr_e( 'Upload First Image', IEPA_TEXT_DOMAIN ) ?>" size="25"/>
					<?php
					$img_url	=	( isset( $iepammenu_item_meta['upload_image_settings']['bg_image_url1'] ) && $iepammenu_item_meta['upload_image_settings']['bg_image_url1'] != '' ) ? esc_url( $iepammenu_item_meta['upload_image_settings']['bg_image_url1'] ) : '';
					?>
					<div class="imma-option-field imma-bgimage-preview1 <?php if( $img_url == '' ) { echo esc_attr( 'iepa-d-none' ); } ?>">
						<a class="remove_sbg_image_url" href="#">
							<i class="dashicons dashicons-trash"></i>
						</a>
						<img style="width: 38%;" class="imma-sbg-image1" src="<?php echo (isset( $iepammenu_item_meta['upload_image_settings']['bg_image_url1']) && $iepammenu_item_meta['upload_image_settings']['bg_image_url1'] != '')?esc_url($iepammenu_item_meta['upload_image_settings']['bg_image_url1']):'';?>" alt="">
					</div>

				</div>

				<div class="imma-option-field">
					<input type="hidden" class="imma-sbgimage2" name="iepa_settings[upload_image_settings][bg_image_url2]"
					value="<?php echo (isset( $iepammenu_item_meta['upload_image_settings']['bg_image_url2']) && $iepammenu_item_meta['upload_image_settings']['bg_image_url2'] != '')?esc_url($iepammenu_item_meta['upload_image_settings']['bg_image_url2']):'';?>"
					/>

					<input type="button" class="imma_bgimage_btn button button-primary button-large" id="imma_doubleimage-2"
					name="imma_bg_image_url2" value="<?php esc_attr_e( 'Upload Second Image', IEPA_TEXT_DOMAIN ) ?>" size="25"
					/>
					<?php
					$img_url	=	( isset( $iepammenu_item_meta['upload_image_settings']['bg_image_url2']) && $iepammenu_item_meta['upload_image_settings']['bg_image_url2'] != '' ) ? esc_url( $iepammenu_item_meta['upload_image_settings']['bg_image_url2'] ) : '';
					?>
					<div class="imma-option-field imma-bgimage-preview2 <?php if( $img_url == '' ) { echo esc_attr( 'iepa-d-none' ); } ?>">
						<a class="remove_sbg_image_url" href="#">
							<i class="dashicons dashicons-trash"></i>
						</a>
						<img class="imma-sbg-image2" style="width: 38%;" src="<?php echo (isset( $iepammenu_item_meta['upload_image_settings']['bg_image_url2']) && $iepammenu_item_meta['upload_image_settings']['bg_image_url2'] != '')?esc_url($iepammenu_item_meta['upload_image_settings']['bg_image_url2']):'';?>" alt="">
					</div>

				</div>

			</td>
		</tr>

		<tr class="toggle_double_image">
			<td class="imma_meta_table">
				<label>
					<?php esc_html_e( "Choose Cross Fading Type", IEPA_TEXT_DOMAIN ); ?>
				</label>
			</td>
			<td>
				<?php
				$cross_fading_type	=	(isset($iepammenu_item_meta['upload_image_settings']['cross_fading_type']) && $iepammenu_item_meta['upload_image_settings']['cross_fading_type'] != '')?esc_attr($iepammenu_item_meta['upload_image_settings']['cross_fading_type']):'';
				$animation_type			=	(isset($iepammenu_item_meta['upload_image_settings']['animation_type']) && $iepammenu_item_meta['upload_image_settings']['animation_type'] != '')?esc_attr($iepammenu_item_meta['upload_image_settings']['animation_type']):'';
				?>
				<select name='iepa_settings[upload_image_settings][cross_fading_type]' class="imma_cross_fading_type">
					<option value=''>
						<?php esc_html_e( "No Cross Fading Type", IEPA_TEXT_DOMAIN ); ?>
					</option>
					<option value='changeonhover'<?php echo selected( $cross_fading_type, 'changeonhover', false ); ?>>
						<?php esc_html_e( "Change image to another on hover.", IEPA_TEXT_DOMAIN ); ?>
					</option>

				</select>
			</td>
		</tr>

		<tr class="toggle_double_image">
			<td class="imma_meta_table">
				<label>
					<?php esc_html_e( "Choose Animation Type", IEPA_TEXT_DOMAIN ); ?>
				</label>
			</td>
			<td>
				<select name='iepa_settings[upload_image_settings][animation_type]'>
					<option value=''>
						<?php esc_html_e( "No Animation Type", IEPA_TEXT_DOMAIN ); ?>
					</option>
					<option value='FadeInOut'<?php echo selected( $animation_type, 'FadeInOut', false ); ?>>
						<?php esc_html_e( "FadeInOut", IEPA_TEXT_DOMAIN ); ?>
					</option>
				</select>
			</td>
		</tr>

		<?php

		$enable_bg_overlay = (isset($iepammenu_item_meta['upload_image_settings']['enable_bg_overlay']) && $iepammenu_item_meta['upload_image_settings']['enable_bg_overlay'] == 'true')?'true':'false';
		?>
		<tr id="imma_single_image1">
			<td class="imma_meta_table">
				<label for="enable_bg_overlay">
					<?php esc_html_e( "Set Overlay Color", IEPA_TEXT_DOMAIN ); ?>
				</label>
			</td>
			<td>
				<div class="imma-section">
					<div class="left-section-styling">
						<div class="iepa-mm-switch">
							<input type='checkbox' class='imma_menu_settingss' id="enable_bg_overlay"
							name="iepa_settings[upload_image_settings][enable_bg_overlay]" value="true" <?php echo checked( $enable_bg_overlay,'true', false ); ?> />
							<label for="enable_bg_overlay"></label>
						</div>
					</div>
					<div class="rt-section-styling">
						<input type='text' name='iepa_settings[upload_image_settings][setoverlay_color]' class="imma-mm-color-picker" data-alpha="true" value='<?php echo (isset($iepammenu_item_meta['upload_image_settings']['setoverlay_color']) && $iepammenu_item_meta['upload_image_settings']['setoverlay_color'] != '')?esc_attr($iepammenu_item_meta['upload_image_settings']['setoverlay_color']):'';?>'/>
					</div>
				</div>
				<p class="description">
					<?php esc_html_e( "Set Overlay Color for Background Image in Mega Menu.", IEPA_TEXT_DOMAIN ); ?>
				</p>
			</td>
		</tr>
		<?php
		$imageposition = (isset($iepammenu_item_meta['upload_image_settings']['image_position']) && $iepammenu_item_meta['upload_image_settings']['image_position'] != '')?esc_attr($iepammenu_item_meta['upload_image_settings']['image_position']):'left top';
		?>

		<tr>
			<td class="imma_meta_table"><label><?php _e("Image Position", IEPA_TEXT_DOMAIN) ?></label></td>
			<td>
				<select name='iepa_settings[upload_image_settings][image_position]' class="imma_image_position">
					<option value='left top'<?php echo selected( $imageposition, 'left top', false ); ?>>
						<?php esc_html_e( "Left Top", IEPA_TEXT_DOMAIN ); ?>
					</option>
					<option value='left center' <?php echo selected( $imageposition, 'left center', false ); ?>>
						<?php esc_html_e( "Left Center", IEPA_TEXT_DOMAIN ); ?>
					</option>
					<option value='left bottom' <?php echo selected( $imageposition, 'left bottom', false );?>>
						<?php esc_html_e( "Left Bottom", IEPA_TEXT_DOMAIN ); ?>
					</option>
					<option value='right top' <?php echo selected( $imageposition, 'right top', false ); ?>>
						<?php esc_html_e( "Right Top", IEPA_TEXT_DOMAIN ); ?>
					</option>
					<option value='right center' <?php echo selected( $imageposition, 'right center', false ); ?>>
						<?php esc_html_e( "Right Center", IEPA_TEXT_DOMAIN ); ?>
					</option>
					<option value='right bottom' <?php echo selected( $imageposition, 'right bottom', false ); ?>>
						<?php esc_html_e( "Right Bottom", IEPA_TEXT_DOMAIN ); ?>
					</option>
					<option value='center top' <?php echo selected( $imageposition, 'center top', false ); ?>>
						<?php esc_html_e( "Center Top", IEPA_TEXT_DOMAIN ); ?>
					</option>
					<option value='center center' <?php echo selected( $imageposition, 'center center', false ); ?>>
						<?php esc_html_e( "Center Center", IEPA_TEXT_DOMAIN ); ?>
					</option>
					<option value='center bottom' <?php echo selected( $imageposition, 'center bottom', false ); ?>>
						<?php esc_html_e( "Center Bottom", IEPA_TEXT_DOMAIN ); ?>
					</option>
					<option value='50% 50%' <?php echo selected( $imageposition, '50% 50%', false ); ?>>
						<?php esc_html_e( "50% 50%", IEPA_TEXT_DOMAIN ); ?>
					</option>
					<option value='10px 200px' <?php echo selected( $imageposition, '10px 200px', false ); ?>>
						<?php esc_html_e( "10px 200px", IEPA_TEXT_DOMAIN ); ?>
					</option>
					<option value='50px 50px' <?php echo selected( $imageposition, '50px 50px', false ); ?>>
						<?php esc_html_e( "50px 50px", IEPA_TEXT_DOMAIN ); ?>
					</option>
					<option value='initial' <?php echo selected( $imageposition, 'initial', false ); ?>>
						<?php esc_html_e( "Initial", IEPA_TEXT_DOMAIN ); ?>
					</option>
					<option value='inherit' <?php echo selected( $imageposition, 'inherit', false ); ?>>
						<?php esc_html_e( "Inherit", IEPA_TEXT_DOMAIN ); ?>
					</option>
				</select>
			</td>
		</tr>
		<?php
		$image_repeat = ( isset( $iepammenu_item_meta['upload_image_settings']['image_repeat'] ) && $iepammenu_item_meta['upload_image_settings']['image_repeat'] != '' ) ? esc_attr( $iepammenu_item_meta['upload_image_settings']['image_repeat'] ) : 'no-repeat';
		?>
		<tr>
			<td class="imma_meta_table">
				<label>
					<?php esc_html_e( "Image repeat", IEPA_TEXT_DOMAIN ); ?>
				</label>
			</td>
			<td>
				<select name='iepa_settings[upload_image_settings][image_repeat]' class="imma_image_repeat">

					<option value='repeat'<?php echo selected( $image_repeat, 'repeat', false );?>>
						<?php esc_html_e( "Repeat", IEPA_TEXT_DOMAIN ); ?>
					</option>
					<option value='repeat-x' <?php echo selected( $image_repeat, 'repeat-x', false );?>>
						<?php esc_html_e( "Repeat-X", IEPA_TEXT_DOMAIN ); ?>
					</option>
					<option value='repeat-y' <?php echo selected( $image_repeat, 'repeat-y', false ); ?>>
						<?php esc_html_e( "Repeat-Y", IEPA_TEXT_DOMAIN ); ?>
					</option>
					<option value='no-repeat' <?php echo selected( $image_repeat, 'no-repeat', false ); ?>>
						<?php esc_html_e( "No-Repeat", IEPA_TEXT_DOMAIN ); ?>
					</option>
					<option value='initial' <?php echo selected( $image_repeat, 'initial', false ); ?>>
						<?php esc_html_e( "Initial", IEPA_TEXT_DOMAIN ); ?>
					</option>
					<option value='inherit' <?php echo selected( $image_repeat, 'inherit', false ); ?>>
						<?php esc_html_e( "Inherit", IEPA_TEXT_DOMAIN ); ?>
					</option>
				</select>
			</td>
		</tr>

		<tr>
			<?php
			$bgsize = (isset( $iepammenu_item_meta['upload_image_settings']['bgsize']) &&  $iepammenu_item_meta['upload_image_settings']['bgsize'] != '')?esc_attr( $iepammenu_item_meta['upload_image_settings']['bgsize']):'cover';
			?>
			<td class="imma_meta_table">
				<label>
					<?php esc_html_e( "Background Size", IEPA_TEXT_DOMAIN ); ?>
				</label>
			</td>
			<td>
				<select name='iepa_settings[upload_image_settings][bgsize]' class="imma_image_position">
					<option value='cover' <?php echo selected( $bgsize, 'cover' , false ); ?>>
						<?php esc_html_e( "Cover", IEPA_TEXT_DOMAIN ); ?>
					</option>
					<option value='contain' <?php echo selected( $bgsize, 'contain', false ); ?>>
						<?php esc_html_e( "Contain", IEPA_TEXT_DOMAIN ); ?>
					</option>
				</select>
				<p class="description">
					<?php esc_html_e( 'Default is set to background-size as cover.', IEPA_TEXT_DOMAIN ); ?>
				</p>
			</td>
		</tr>
	</table>
</div>
