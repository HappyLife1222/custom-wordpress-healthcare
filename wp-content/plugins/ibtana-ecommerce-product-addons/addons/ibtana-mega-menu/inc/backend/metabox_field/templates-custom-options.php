<?php


$enable_cdesigns 				= ( isset( $menu_general_settings[$mlocation]['enable_cdesigns'] ) && $menu_general_settings[$mlocation]['enable_cdesigns'] == '1' ) ? esc_attr( '1' ) : esc_attr( '0' );
$bgcolor 								= ( isset( $menu_general_settings[$mlocation]['bgcolor'] ) && $menu_general_settings[$mlocation]['bgcolor'] != '' ) ? esc_attr( $menu_general_settings[$mlocation]['bgcolor'] ) : '';
$menu_bordercolor 			= ( isset( $menu_general_settings[$mlocation]['menu_bordercolor'] ) && $menu_general_settings[$mlocation]['menu_bordercolor'] != '' ) ? esc_attr( $menu_general_settings[$mlocation]['menu_bordercolor'] ) : '';
$topmenubordercolor 		= ( isset( $menu_general_settings[$mlocation]['topmenubordercolor'] ) && $menu_general_settings[$mlocation]['topmenubordercolor'] != '') ? esc_attr( $menu_general_settings[$mlocation]['topmenubordercolor'] ) : '';
$divider_color 					= ( isset( $menu_general_settings[$mlocation]['divider_color'] ) && $menu_general_settings[$mlocation]['divider_color'] != '' ) ? esc_attr( $menu_general_settings[$mlocation]['divider_color'] ) : '';
$menu_fontsize 					= ( isset( $menu_general_settings[$mlocation]['menu_fontsize'] ) && $menu_general_settings[$mlocation]['menu_fontsize'] != '') ? esc_attr( $menu_general_settings[$mlocation]['menu_fontsize'] ) : '';
$menu_font_family 			= ( isset( $menu_general_settings[$mlocation]['menu_font_family'] ) && $menu_general_settings[$mlocation]['menu_font_family'] != '' ) ? esc_attr( $menu_general_settings[$mlocation]['menu_font_family'] ) : '';
$menu_font_weight 			= ( isset( $menu_general_settings[$mlocation]['menu_font_weight'] ) && $menu_general_settings[$mlocation]['menu_font_weight'] != '' ) ? esc_attr( $menu_general_settings[$mlocation]['menu_font_weight'] ) : '';
$menu_fcolor 						= ( isset( $menu_general_settings[$mlocation]['menu_fcolor'] ) && $menu_general_settings[$mlocation]['menu_fcolor'] != '' ) ? esc_attr( $menu_general_settings[$mlocation]['menu_fcolor'] ) : '';
//active bg color
$active_bgcolor 				= ( isset( $menu_general_settings[$mlocation]['active_bgcolor'] ) && $menu_general_settings[$mlocation]['active_bgcolor'] != '')?esc_attr($menu_general_settings[$mlocation]['active_bgcolor']):'';
$active_fcolor 					= ( isset( $menu_general_settings[$mlocation]['active_fcolor'] ) && $menu_general_settings[$mlocation]['active_fcolor'] != '')?esc_attr($menu_general_settings[$mlocation]['active_fcolor']):'';

$padding_top 						= ( isset( $menu_general_settings[$mlocation]['padding_top'] ) && $menu_general_settings[$mlocation]['padding_top'] != '')?esc_attr($menu_general_settings[$mlocation]['padding_top']):'';
$padding_left 					= ( isset( $menu_general_settings[$mlocation]['padding_left'] ) && $menu_general_settings[$mlocation]['padding_left'] != '')?esc_attr($menu_general_settings[$mlocation]['padding_left']):'';
$padding_right 					= ( isset( $menu_general_settings[$mlocation]['padding_right'] ) && $menu_general_settings[$mlocation]['padding_right'] != '')?esc_attr($menu_general_settings[$mlocation]['padding_right']):'';
$padding_bottom 				= ( isset( $menu_general_settings[$mlocation]['padding_bottom'] ) && $menu_general_settings[$mlocation]['padding_bottom'] != '')?esc_attr($menu_general_settings[$mlocation]['padding_bottom']):'';
$margin_top 						= ( isset( $menu_general_settings[$mlocation]['margin_top'] ) && $menu_general_settings[$mlocation]['margin_top'] != '')?esc_attr($menu_general_settings[$mlocation]['margin_top']):'';
$margin_left 						= ( isset( $menu_general_settings[$mlocation]['margin_left'] ) && $menu_general_settings[$mlocation]['margin_left'] != '')?esc_attr($menu_general_settings[$mlocation]['margin_left']):'';
$margin_right 					= ( isset( $menu_general_settings[$mlocation]['margin_right'] ) && $menu_general_settings[$mlocation]['margin_right'] != '')?esc_attr($menu_general_settings[$mlocation]['margin_right']):'';
$margin_bottom 					= ( isset( $menu_general_settings[$mlocation]['margin_bottom'] ) && $menu_general_settings[$mlocation]['margin_bottom'] != '')?esc_attr($menu_general_settings[$mlocation]['margin_bottom']):'';
$padding_top_noicon 		= ( isset( $menu_general_settings[$mlocation]['padding_top_noicon'] ) && $menu_general_settings[$mlocation]['padding_top_noicon'] != '')?esc_attr($menu_general_settings[$mlocation]['padding_top_noicon']):'';
$padding_left_noicon 		= ( isset( $menu_general_settings[$mlocation]['padding_left_noicon'] ) && $menu_general_settings[$mlocation]['padding_left_noicon'] != '')?esc_attr($menu_general_settings[$mlocation]['padding_left_noicon']):'';
$padding_right_noicon 	= ( isset( $menu_general_settings[$mlocation]['padding_right_noicon'] ) && $menu_general_settings[$mlocation]['padding_right_noicon'] != '')?esc_attr($menu_general_settings[$mlocation]['padding_right_noicon']):'';
$padding_bottom_noicon	= ( isset( $menu_general_settings[$mlocation]['padding_bottom_noicon'] ) && $menu_general_settings[$mlocation]['padding_bottom_noicon'] != '')?esc_attr($menu_general_settings[$mlocation]['padding_bottom_noicon']):'';
//social icon menu type
$sicon_margin_top 			= ( isset( $menu_general_settings[$mlocation]['sicon_margin_top'] ) && $menu_general_settings[$mlocation]['sicon_margin_top'] != '')?esc_attr($menu_general_settings[$mlocation]['sicon_margin_top']):'';
$sicon_margin_left 			= ( isset( $menu_general_settings[$mlocation]['sicon_margin_left'] ) && $menu_general_settings[$mlocation]['sicon_margin_left'] != '')?esc_attr($menu_general_settings[$mlocation]['sicon_margin_left']):'';
$sicon_margin_right 		= ( isset( $menu_general_settings[$mlocation]['sicon_margin_right'] ) && $menu_general_settings[$mlocation]['sicon_margin_right'] != '')?esc_attr($menu_general_settings[$mlocation]['sicon_margin_right']):'';
$sicon_margin_bottom 		= ( isset( $menu_general_settings[$mlocation]['sicon_margin_bottom'] ) && $menu_general_settings[$mlocation]['sicon_margin_bottom'] != '')?esc_attr($menu_general_settings[$mlocation]['sicon_margin_bottom']):'';
$sicon_padding_top 			= ( isset( $menu_general_settings[$mlocation]['sicon_padding_top'] ) && $menu_general_settings[$mlocation]['sicon_padding_top'] != '')?esc_attr($menu_general_settings[$mlocation]['sicon_padding_top']):'';
$sicon_padding_left 		= ( isset( $menu_general_settings[$mlocation]['sicon_padding_left'] ) && $menu_general_settings[$mlocation]['sicon_padding_left'] != '')?esc_attr($menu_general_settings[$mlocation]['sicon_padding_left']):'';
$sicon_padding_right 		= ( isset( $menu_general_settings[$mlocation]['sicon_padding_right'] ) && $menu_general_settings[$mlocation]['sicon_padding_right'] != '')?esc_attr($menu_general_settings[$mlocation]['sicon_padding_right']):'';
$sicon_padding_bottom 	= ( isset( $menu_general_settings[$mlocation]['sicon_padding_bottom'] ) && $menu_general_settings[$mlocation]['sicon_padding_bottom'] != '')?esc_attr($menu_general_settings[$mlocation]['sicon_padding_bottom']):'';
?>
<div class="iepa-custom-options-wrap">
	<div class="iepa-template-tab-leftsection">
	     <div class="widgetss_header">
	     	<div class="imma-label clearfix">
          	<label for="iepammmegamenu_enabledcdesign_<?php echo esc_attr( $mlocation ); ?>">
          		<?php esc_html_e( 'Enable Custom Designs?', IEPA_TEXT_DOMAIN ); ?>
          	</label>
          	<div class="iepa-mm-switch">
		        <input type='checkbox' class='iepammmegamenu_enabled'
		        name='iepammmegamenu_custommeta[<?php echo esc_attr($mlocation); ?>][enable_cdesigns]' id="iepammmegamenu_enabledcdesign_<?php echo esc_attr( $mlocation ); ?>" value='1' <?php checked( $enable_cdesigns ); ?> />
		        <label for="iepammmegamenu_enabledcdesign_<?php echo esc_attr($mlocation); ?>"></label>
		      </div>
          	</div>
	     </div>
	      <ul>
          <li>
						<div class="imma_tabss active" id="menubar">
							<?php esc_html_e( "Menu Bar Settings", IEPA_TEXT_DOMAIN ); ?>
						</div>
					</li>
          <li>
						<div class="imma_tabss" id="icons">
							<?php esc_html_e( "Menu Icons Settings", IEPA_TEXT_DOMAIN ); ?>
						</div>
					</li>
	        <li>
						<div class="imma_tabss" id="flyout">
							<?php esc_html_e( "Flyout Menu Settings", IEPA_TEXT_DOMAIN ); ?>
						</div>
					</li>
	        <li>
						<div class="imma_tabss" id="megamenu">
							<?php esc_html_e( "Mega Menu Settings", IEPA_TEXT_DOMAIN ); ?>
						</div>
					</li>
	        <li>
						<div class="imma_tabss" id="menu_label">
							<?php esc_html_e( "Menu Label Settings", IEPA_TEXT_DOMAIN ); ?>
						</div>
					</li>
	      </ul>
	</div>
	<div class="widget_right_section">
      <div class="imma-btn_close_me btn_close_me">
        <div class="title_widget_add">
	        <div class="rt-header">
	     	<?php esc_html_e( "Menu Location - ", IEPA_TEXT_DOMAIN ); ?>
				<?php
	     	$menulocation = str_replace('_', ' ', $mlocation);
	     	$menulocation = str_replace('-', ' ', $menulocation);
	     	echo ucwords( esc_html( $menulocation ) );
				?>
	       	<i class="fa fa-wrench" aria-hidden="true"></i>
					<?php esc_html_e( "Customize Pre Available Template Options", IEPA_TEXT_DOMAIN ); ?>
				</div>
	        </div>
        <div class="imma-rt-side-action">
          <span class="iepa-load-data" style="display: none;">
						<span class="iepa_saving_message"></span>
						<img src=<?php echo esc_url( IEPA_MM_IMG_DIR . '/ajax-loader.svg' ); ?> />
					</span>
          <span class="imma-save-data">
						<i class="fa fa-save" aria-hidden="true"></i>
						<?php esc_html_e( "SAVE CHANGES", IEPA_TEXT_DOMAIN ); ?>
					</span>
          <span class="imma-close-wrap">
						<i class="fa fa-close" aria-hidden="true"></i>
						<?php esc_html_e( "CLOSE", IEPA_TEXT_DOMAIN ); ?>
					</span>
        </div>
       </div>
      <div class="right_middle_widgets">
        <div class="tab-panes" id="tabs_menubar" style="display: block;">
          <p class="description">
						<b>
						<?php esc_html_e( "Note: Some of the options will only work as per pre available templates design layout setup. So, few custom option selected might not work for some pre available templates.", IEPA_TEXT_DOMAIN ); ?>
						</b>
					</p>
           <table>
             <tr>
               <td width="400">
								 <?php esc_html_e( "Menu Background Color", IEPA_TEXT_DOMAIN ); ?>
                 <p class="description">
                  <?php esc_html_e( "Set overall background color for menu bar.", IEPA_TEXT_DOMAIN ); ?>
                 </p>
               </td>
               <td>
                <input type='text'
                name='iepammmegamenu_custommeta[<?php echo esc_attr( $mlocation ); ?>][bgcolor]'
                value="<?php echo esc_attr( $bgcolor ); ?>" class="imma-mm-color-picker" data-alpha="true"/>
              </td>
             </tr>
              <tr>
               <td width="400">
								 <?php esc_html_e( "Border Color", IEPA_TEXT_DOMAIN ); ?>
                 <p class="description">
                  <?php esc_html_e( "Set overall border color for menu bar.", IEPA_TEXT_DOMAIN ); ?>
                 </p>
               </td>
               <td>
                <input type='text'
                name='iepammmegamenu_custommeta[<?php echo esc_attr( $mlocation ); ?>][menu_bordercolor]'
                value="<?php echo esc_attr( $menu_bordercolor ); ?>" class="imma-mm-color-picker"
								/>
              </td>
             </tr>
             <tr>
               <td width="400">
								 <?php esc_html_e( "Menu Top Border Color", IEPA_TEXT_DOMAIN ) ?>
                 <p class="description">
                  <?php esc_html_e( "Set overall top border color of menu bar. For Unique Mega Menu template only.", IEPA_TEXT_DOMAIN ); ?>
                 </p>
               </td>
               <td>
                <input type='text' name='iepammmegamenu_custommeta[<?php echo esc_attr($mlocation);?>][topmenubordercolor]'
                value="<?php echo esc_attr($topmenubordercolor);?>" class="imma-mm-color-picker"/>
              </td>
             </tr>
               <tr>
               <td width="400"><?php esc_html_e( "Divider Color", IEPA_TEXT_DOMAIN ); ?>
                  <p class="description">
                  <?php esc_html_e( "Set overall divider color for menu bar.", IEPA_TEXT_DOMAIN ) ?>
                 </p>
               </td>
               <td>
                <input type='text'
                name='iepammmegamenu_custommeta[<?php echo esc_attr( $mlocation ); ?>][divider_color]'
                value="<?php echo esc_attr( $divider_color ); ?>" class="imma-mm-color-picker" />
              </td>
             </tr>
               <tr>
               <td width="400">
								 <?php esc_html_e("Font Family", IEPA_TEXT_DOMAIN); ?>
                  <p class="description">
                  <?php esc_html_e( "Choose font family for overall menu.", IEPA_TEXT_DOMAIN ); ?>
                 </p>
               </td>
               <td>
                <select name="iepammmegamenu_custommeta[<?php echo esc_attr($mlocation); ?>][menu_font_family]">
                    <option value="theme-default">
                    	<?php esc_html_e( 'Default', IEPA_TEXT_DOMAIN ); ?>
                    </option>
                    <option value="Assistant" <?php if( isset( $menu_font_family ) && $menu_font_family == 'Assistant' ) {echo esc_attr( "selected" );} ?>>
											<?php echo esc_html_e( 'Assistant', IEPA_TEXT_DOMAIN ); ?>
										</option>
                    <?php  $imma_mm_fonts = get_option( 'iepa_mm_font_family' );
                     if( isset( $imma_mm_fonts ) && !empty( $imma_mm_fonts ) ) {
											 foreach ( $imma_mm_fonts as $value ) {
												 ?>
												 <option value="<?php echo esc_attr( $value ); ?>" <?php if( isset( $menu_font_family ) ) if( $value == $menu_font_family ) {echo esc_attr("selected");} ?>>
													 <?php echo esc_html( $value ); ?>
												 </option>
                     <?php }
                     }?>
                  </select>
              </td>
             </tr>
             <tr>
               <td width="400">
								 <?php esc_html_e( "Font Weight", IEPA_TEXT_DOMAIN ); ?>
                 <p class="description">
                  <?php esc_html_e( "Choose font weight for overall menu.", IEPA_TEXT_DOMAIN ); ?>
                 </p>
               </td>
               <td>
                <select name="iepammmegamenu_custommeta[<?php echo esc_attr( $mlocation ); ?>][menu_font_weight]">
									<option value="theme_default" <?php echo ( isset( $menu_font_weight ) && $menu_font_weight == 'theme_default' ) ? esc_attr("selected=selected") : ''; ?>>
										<?php esc_html_e( 'Template Default', IEPA_TEXT_DOMAIN ); ?>
									</option>
									<option value="normal" <?php echo ( isset( $menu_font_weight ) && $menu_font_weight == 'normal' ) ? esc_attr("selected=selected") : ''; ?>>
										<?php esc_html_e( 'Normal(400)',IEPA_TEXT_DOMAIN ); ?>
									</option>
									<option value="bold" <?php echo ( isset( $menu_font_weight ) && $menu_font_weight == 'bold' ) ? esc_attr("selected=selected") : ''; ?>>
										<?php esc_html_e( 'Bold(700)', IEPA_TEXT_DOMAIN ); ?>
									</option>
									<option value="light" <?php echo ( isset( $menu_font_weight ) && $menu_font_weight == 'light' ) ? esc_attr("selected=selected") : ''; ?>>
										<?php esc_html_e( 'Light(300)', IEPA_TEXT_DOMAIN ); ?>
									</option>
                </select>
              </td>
             </tr>
             <tr>
               <td width="400">
								 <?php esc_html_e( "Menu Font Size", IEPA_TEXT_DOMAIN ); ?>
                 <p class="description">
                  <?php esc_html_e( "Set font size for all menu items.", IEPA_TEXT_DOMAIN ); ?>
                 </p>
               </td>
               <td>
                <input type='number'
                name='iepammmegamenu_custommeta[<?php echo esc_attr( $mlocation ); ?>][menu_fontsize]'
                value="<?php echo esc_attr( $menu_fontsize ); ?>" />
              </td>
             </tr>
             <tr>
               <td width="400">
								 <?php esc_html_e( "Menu Font Color", IEPA_TEXT_DOMAIN ); ?>
                 <p class="description">
                  <?php esc_html_e( "Set font color for all menu items.", IEPA_TEXT_DOMAIN ); ?>
                 </p>
               </td>
               <td>
                <input type='text'
                name='iepammmegamenu_custommeta[<?php echo esc_attr( $mlocation ); ?>][menu_fcolor]'
                value="<?php echo esc_attr( $menu_fcolor ); ?>" class="imma-mm-color-picker"
								/>
              </td>
             </tr>
            <tr>
               <td width="400">
								 <?php esc_html_e( "Active Background Color", IEPA_TEXT_DOMAIN ); ?>
                 <p class="description">
                  <?php esc_html_e( "Set Active menu item Background color.", IEPA_TEXT_DOMAIN ); ?>
                 </p>
               </td>
               <td>
                <input type='text'
                name='iepammmegamenu_custommeta[<?php echo esc_attr( $mlocation ); ?>][active_bgcolor]'
                value="<?php echo esc_attr( $active_bgcolor ); ?>" class="imma-mm-color-picker" data-alpha="true" />
              </td>
             </tr>
              <tr>
               <td width="400">
								 <?php esc_html_e( "Active Font Color", IEPA_TEXT_DOMAIN ); ?>
                 <p class="description">
                  <?php esc_html_e( "Set Active menu item font color.", IEPA_TEXT_DOMAIN ); ?>
                 </p>
               </td>
               <td>
                <input type='text'
                name='iepammmegamenu_custommeta[<?php echo esc_attr( $mlocation ); ?>][active_fcolor]'
                value="<?php echo esc_attr( $active_fcolor ); ?>" class="imma-mm-color-picker" />
              </td>
             </tr>
             <tr>
               <td width="400">
								 <?php esc_html_e( "Menu Item Margin", IEPA_TEXT_DOMAIN ) ?>
                 <p class="description">
                  <?php esc_html_e( "Set margin for overall main menu bar's items. Not applicable for social custom menu item type.", IEPA_TEXT_DOMAIN ); ?>
                 </p>
               </td>
               <td>
                <label data-validation="px" class="iepa-mm-mega_container-padding">
                <span>
									<?php esc_html_e( 'Top', IEPA_TEXT_DOMAIN ); ?>
								</span>
                <input type="text" value="<?php echo ( !isset( $margin_top ) ) ? '' : esc_attr( $margin_top ); ?>" name="iepammmegamenu_custommeta[<?php echo esc_attr( $mlocation ); ?>][margin_top]"
                class="iepammmega-menu_bar_padding" placeholder="23px">
                 <span><?php esc_html_e('Right',IEPA_TEXT_DOMAIN);?></span>
                <input type="text" value="<?php echo (!isset($margin_right))?'':esc_attr($margin_right);?>" name="iepammmegamenu_custommeta[<?php echo esc_attr( $mlocation ); ?>][margin_right]"
                class="iepammmega-menu_bar_padding" placeholder="23px">
                <span><?php esc_html_e('Bottom',IEPA_TEXT_DOMAIN);?></span>
                <input type="text" value="<?php echo (!isset($margin_bottom))?'':esc_attr($margin_bottom);?>" name="iepammmegamenu_custommeta[<?php echo esc_attr( $mlocation ); ?>][margin_bottom]"
                class="iepammmega-menu_bar_padding" placeholder="23px">
                <span><?php esc_html_e('Left',IEPA_TEXT_DOMAIN);?></span>
                <input type="text" value="<?php echo (!isset($margin_left))?'':esc_attr($margin_left);?>" name="iepammmegamenu_custommeta[<?php echo esc_attr( $mlocation ) ;?>][margin_left]"
                class="iepammmega-menu_bar_padding" placeholder="23px">
                </label>
              </td>
             </tr>
             <tr>
               <td width="400"><?php esc_html_e("Menu Item Padding With Icon", IEPA_TEXT_DOMAIN) ?>
                 <p class="description">
                  <?php esc_html_e("Set padding for overall main menu bar's items which have menu icon. Not applicable for social custom menu item type.", IEPA_TEXT_DOMAIN); ?>
                 </p>
               </td>
               <td>
                <label data-validation="px" class="iepa-mm-mega_container-padding">
                <span><?php esc_html_e('Top',IEPA_TEXT_DOMAIN);?></span>
                <input type="text" value="<?php echo (!isset($padding_top))?'':esc_attr($padding_top);?>" name="iepammmegamenu_custommeta[<?php echo esc_attr($mlocation); ?>][padding_top]"
                class="iepammmega-menu_bar_padding" placeholder="23px">
                 <span><?php esc_html_e('Right',IEPA_TEXT_DOMAIN);?></span>
                <input type="text" value="<?php echo (!isset($padding_right))?'':esc_attr($padding_right);?>" name="iepammmegamenu_custommeta[<?php echo esc_attr($mlocation); ?>][padding_right]"
                class="iepammmega-menu_bar_padding" placeholder="23px">
                <span><?php esc_html_e('Bottom',IEPA_TEXT_DOMAIN);?></span>
                <input type="text" value="<?php echo (!isset($padding_bottom))?'':esc_attr($padding_bottom);?>" name="iepammmegamenu_custommeta[<?php echo esc_attr($mlocation); ?>][padding_bottom]"
                class="iepammmega-menu_bar_padding" placeholder="23px">
                <span><?php esc_html_e('Left',IEPA_TEXT_DOMAIN);?></span>
                <input type="text" value="<?php echo (!isset($padding_left))?'':esc_attr($padding_left);?>" name="iepammmegamenu_custommeta[<?php echo esc_attr($mlocation); ?>][padding_left]"
                class="iepammmega-menu_bar_padding" placeholder="23px">
                </label>
              </td>
             </tr>

          <tr>
               <td width="400"><?php esc_html_e("Menu Item Padding Without Icon ", IEPA_TEXT_DOMAIN) ?>
                 <p class="description">
                  <?php esc_html_e("Set padding for overall main menu bar's items which doesn't have menu icon. Not applicable for social custom menu item type.", IEPA_TEXT_DOMAIN) ?>
                 </p>
               </td>
               <td>
                <label data-validation="px" class="iepa-mm-mega_container-padding">
                <span><?php esc_html_e('Top',IEPA_TEXT_DOMAIN);?></span>
                <input type="text" value="<?php echo (!isset($padding_top_noicon))?'':esc_attr($padding_top_noicon);?>" name="iepammmegamenu_custommeta[<?php echo esc_attr($mlocation); ?>][padding_top_noicon]"
                class="iepammmega-menu_bar_padding" placeholder="23px">
                 <span><?php esc_html_e('Right',IEPA_TEXT_DOMAIN);?></span>
                <input type="text" value="<?php echo (!isset($padding_right_noicon))?'':esc_attr($padding_right_noicon);?>" name="iepammmegamenu_custommeta[<?php echo esc_attr($mlocation);?>][padding_right_noicon]"
                class="iepammmega-menu_bar_padding" placeholder="23px">
                <span><?php esc_html_e('Bottom',IEPA_TEXT_DOMAIN);?></span>
                <input type="text" value="<?php echo (!isset($padding_bottom_noicon))?'':esc_attr($padding_bottom_noicon);?>" name="iepammmegamenu_custommeta[<?php echo esc_attr($mlocation); ?>][padding_bottom_noicon]"
                class="iepammmega-menu_bar_padding" placeholder="23px">
                <span><?php esc_html_e('Left',IEPA_TEXT_DOMAIN);?></span>
                <input type="text" value="<?php echo (!isset($padding_left_noicon))?'':esc_attr($padding_left_noicon);?>" name="iepammmegamenu_custommeta[<?php echo esc_attr($mlocation);?>][padding_left_noicon]"
                class="iepammmega-menu_bar_padding" placeholder="23px">
                </label>
              </td>
             </tr>

          <tr>
               <td width="400"><?php esc_html_e("Social Menu Item's Margin", IEPA_TEXT_DOMAIN) ?>
                 <p class="description">
                 <?php esc_html_e("Set margin for menu items assigned as custom social links menu item type. Social Icon Menu Type is set by enabling General Settings > `Active Single Menu` on click blue button which opens a popup form for each menu item individually.", IEPA_TEXT_DOMAIN) ?>
                 </p>
               </td>
               <td>
                <label data-validation="px" class="iepa-mm-mega_container-padding">
                <span><?php esc_html_e('Top',IEPA_TEXT_DOMAIN);?></span>
                <input type="text" value="<?php echo (!isset($sicon_margin_top))?'':esc_attr($sicon_margin_top);?>" name="iepammmegamenu_custommeta[<?php echo esc_attr($mlocation); ?>][sicon_margin_top]"
                class="iepammmega-menu_bar_padding" placeholder="23px">
                 <span><?php esc_html_e('Right',IEPA_TEXT_DOMAIN);?></span>
                <input type="text" value="<?php echo (!isset($sicon_margin_right))?'':esc_attr($sicon_margin_right);?>" name="iepammmegamenu_custommeta[<?php echo esc_attr($mlocation);?>][sicon_margin_right]"
                class="iepammmega-menu_bar_padding" placeholder="23px">
                <span><?php esc_html_e('Bottom',IEPA_TEXT_DOMAIN);?></span>
                <input type="text" value="<?php echo (!isset($sicon_margin_bottom))?'':esc_attr($sicon_margin_bottom);?>" name="iepammmegamenu_custommeta[<?php echo esc_attr($mlocation);?>][sicon_margin_bottom]"
                class="iepammmega-menu_bar_padding" placeholder="23px">
                <span><?php esc_html_e('Left',IEPA_TEXT_DOMAIN);?></span>
                <input type="text" value="<?php echo (!isset($sicon_margin_left))?'':esc_attr($sicon_margin_left);?>" name="iepammmegamenu_custommeta[<?php echo esc_attr($mlocation);?>][sicon_margin_left]"
                class="iepammmega-menu_bar_padding" placeholder="23px">
                </label>
              </td>
             </tr>

            <tr>
               <td width="400"><?php esc_html_e("Social Menu Item's Padding", IEPA_TEXT_DOMAIN) ?>
                <p class="description">
                 <?php esc_html_e("Set padding for menu items assigned as custom social links menu item type. Social Icon Menu Type is set by enabling General Settings > `Active Single Menu` on click blue button which opens a popup form for each menu item individually.", IEPA_TEXT_DOMAIN); ?>
                 </p>
               </td>
               <td>
                <label data-validation="px" class="iepa-mm-mega_container-padding">
                <span><?php esc_html_e('Top',IEPA_TEXT_DOMAIN);?></span>
                <input type="text" value="<?php echo (!isset($sicon_padding_top))?'':esc_attr($sicon_padding_top);?>" name="iepammmegamenu_custommeta[<?php echo esc_attr($mlocation);?>][sicon_padding_top]"
                class="iepammmega-menu_bar_padding" placeholder="23px">
                 <span><?php esc_html_e('Right',IEPA_TEXT_DOMAIN);?></span>
                <input type="text" value="<?php echo (!isset($sicon_padding_right))?'':esc_attr($sicon_padding_right);?>" name="iepammmegamenu_custommeta[<?php echo esc_attr($mlocation);?>][sicon_padding_right]"
                class="iepammmega-menu_bar_padding" placeholder="23px">
                <span><?php esc_html_e('Bottom',IEPA_TEXT_DOMAIN);?></span>
                <input type="text" value="<?php echo (!isset($sicon_padding_bottom))?'':esc_attr($sicon_padding_bottom);?>" name="iepammmegamenu_custommeta[<?php echo esc_attr($mlocation);?>][sicon_padding_bottom]"
                class="iepammmega-menu_bar_padding" placeholder="23px">
                <span><?php esc_html_e('Left',IEPA_TEXT_DOMAIN);?></span>
                <input type="text" value="<?php echo (!isset($sicon_padding_left))?'':esc_attr($sicon_padding_left);?>" name="iepammmegamenu_custommeta[<?php echo esc_attr($mlocation);?>][sicon_padding_left]"
                class="iepammmega-menu_bar_padding" placeholder="23px">
                </label>
              </td>
             </tr>
        </table>
        <?php
        $eachmenu_bgcolor = (isset($menu_general_settings[$mlocation]['eachmenu_bgcolor']) && $menu_general_settings[$mlocation]['eachmenu_bgcolor'] != '')?esc_attr($menu_general_settings[$mlocation]['eachmenu_bgcolor']):'';
        $eachmenu_fhcolor = (isset($menu_general_settings[$mlocation]['eachmenu_fhcolor']) && $menu_general_settings[$mlocation]['eachmenu_fhcolor'] != '')?esc_attr($menu_general_settings[$mlocation]['eachmenu_fhcolor']):'';
        $eachmenu_topbordercolor = (isset($menu_general_settings[$mlocation]['eachmenu_topbordercolor']) && $menu_general_settings[$mlocation]['eachmenu_topbordercolor'] != '')?esc_attr($menu_general_settings[$mlocation]['eachmenu_topbordercolor']):'';
        $megamenu_topborder = (isset($menu_general_settings[$mlocation]['megamenu_topborder']) && $menu_general_settings[$mlocation]['megamenu_topborder'] != '')?esc_attr($menu_general_settings[$mlocation]['megamenu_topborder']):'';
        ?>
        <div class="imma-title-header-opt">
					<?php esc_attr_e( 'Hover Effect On Top Level Menu Items', IEPA_TEXT_DOMAIN ); ?>
				</div>
        <table>
              <tr>
               <td width="400">
								 <?php esc_attr_e( "Background Hover Color", IEPA_TEXT_DOMAIN ) ?>
                  <p class="description">
                  <?php esc_attr_e( "Set background hover color for top level menu items .", IEPA_TEXT_DOMAIN ) ?>
                 </p>
               </td>
               <td>
                <input type='text'
                name='iepammmegamenu_custommeta[<?php echo esc_attr($mlocation);?>][eachmenu_bgcolor]'
                value="<?php echo esc_attr($eachmenu_bgcolor);?>" class="imma-mm-color-picker" data-alpha="true" />
              </td>
             </tr>
             <tr>
               <td width="400"><?php esc_attr_e("Font Hover Color", IEPA_TEXT_DOMAIN) ?>
                 <p class="description">
                  <?php esc_attr_e("Set font hover color for all menu items.", IEPA_TEXT_DOMAIN) ?>
                 </p>
               </td>
               <td>
                <input type='text'
                name='iepammmegamenu_custommeta[<?php echo esc_attr($mlocation);?>][eachmenu_fhcolor]'
                value="<?php echo esc_attr($eachmenu_fhcolor);?>" class="imma-mm-color-picker"/>
              </td>
             </tr>
             <tr>
               <td width="400"><?php esc_attr_e( "Top Border Color", IEPA_TEXT_DOMAIN ); ?>
                 <p class="description">
                  <?php esc_attr_e("Set top border color on hover menu items. Only for specific template type - Modern Mega Menu.", IEPA_TEXT_DOMAIN) ?>
                 </p>
               </td>
               <td>
                <input type='text'
                name='iepammmegamenu_custommeta[<?php echo esc_attr($mlocation); ?>][eachmenu_topbordercolor]'
                value="<?php echo esc_attr($eachmenu_topbordercolor); ?>" class="imma-mm-color-picker"/>
              </td>
             </tr>
             <tr>
               <td width="400">
								 <?php esc_attr_e( "Border Circle Color", IEPA_TEXT_DOMAIN ); ?>
                 <p class="description">
                  <?php esc_attr_e( "Set border circle color on hover each menu items. Only for specific template type - Advanced Magazine Mega Menu and Mini Sized Mega Menu.", IEPA_TEXT_DOMAIN ); ?>
                 </p>
               </td>
               <td>
                <input type='text'
                name='iepammmegamenu_custommeta[<?php echo esc_attr( $mlocation ); ?>][eachmenu_border_circlecolor]'
                value="<?php echo esc_attr($eachmenu_border_circlecolor); ?>" class="imma-mm-color-picker"/>
              </td>
             </tr>
              <tr>
               <td width="400">
								 <?php esc_attr_e("Mega Menu's Top Border Color", IEPA_TEXT_DOMAIN) ?>
                 <p class="description">
                  <?php esc_attr_e("Set mega menu wrapper's top border color on hover for each menu items. Only for specific template type -Simple Mega Menu,Advanced Magazine Mega Menu and Highlighted Border Mega Menu.", IEPA_TEXT_DOMAIN) ?>
                 </p>
               </td>
               <td>
                <input type='text'
                name='iepammmegamenu_custommeta[<?php echo esc_attr( $mlocation ); ?>][megamenu_topborder]'
                value="<?php echo esc_attr($megamenu_topborder); ?>" class="imma-mm-color-picker"/>
              </td>
             </tr>
           </table>

        </div>
        <?php
        $iconcolor = (isset($menu_general_settings[$mlocation]['iconcolor']) && $menu_general_settings[$mlocation]['iconcolor'] != '')?esc_attr($menu_general_settings[$mlocation]['iconcolor']):'';
        $icon_hcolor = (isset($menu_general_settings[$mlocation]['icon_hcolor']) && $menu_general_settings[$mlocation]['icon_hcolor'] != '')?esc_attr($menu_general_settings[$mlocation]['icon_hcolor']):'';
        $icon_bgcolor = (isset($menu_general_settings[$mlocation]['icon_bgcolor']) && $menu_general_settings[$mlocation]['icon_bgcolor'] != '')?esc_attr($menu_general_settings[$mlocation]['icon_bgcolor']):'';
        $icon_bghcolor = (isset($menu_general_settings[$mlocation]['icon_bghcolor']) && $menu_general_settings[$mlocation]['icon_bghcolor'] != '')?esc_attr($menu_general_settings[$mlocation]['icon_bghcolor']):'';
        ?>
        <div class="tab-panes" id="tabs_icons" style="display:none;">
          <table>
              <tr>
               <td width="400"><?php esc_attr_e( "Color", IEPA_TEXT_DOMAIN ); ?>
                 <p class="description">
                  <?php esc_attr_e( "Set menu icon color for top level menu items.", IEPA_TEXT_DOMAIN ); ?>
                 </p>
               </td>
               <td>
                <input type='text'
                name='iepammmegamenu_custommeta[<?php echo esc_attr($mlocation);?>][iconcolor]'
                value="<?php echo esc_attr($iconcolor);?>" class="imma-mm-color-picker"/>
              </td>
             </tr>
             <tr>
               <td width="400"><?php esc_attr_e("Hover Color", IEPA_TEXT_DOMAIN) ?>
                  <p class="description">
                  <?php esc_attr_e("Set icon hover color for top level menu items.", IEPA_TEXT_DOMAIN) ?>
                 </p>
               </td>
               <td>
                <input type='text'
                name='iepammmegamenu_custommeta[<?php echo esc_attr($mlocation);?>][icon_hcolor]'
                value="<?php echo esc_attr($icon_hcolor);?>" class="imma-mm-color-picker"/>
              </td>
             </tr>
             <tr>
               <td width="400"><?php esc_attr_e("Background Color", IEPA_TEXT_DOMAIN) ?>
                 <p class="description">
                  <?php esc_attr_e("Set icon background color for top level menu items. Only used for pre available template type Box Sized Mega Menu", IEPA_TEXT_DOMAIN) ?>
                 </p>
               </td>
               <td>
                <input type='text'
                name='iepammmegamenu_custommeta[<?php echo esc_attr($mlocation);?>][icon_bgcolor]'
                value="<?php echo esc_attr($icon_bgcolor);?>" class="imma-mm-color-picker" data-alpha="true"/>
              </td>
             </tr>
             <tr>
               <td width="400"><?php esc_attr_e("Background Hover Color", IEPA_TEXT_DOMAIN) ?>
                  <p class="description">
                  <?php esc_attr_e("Set icon background hover color for top level menu items. Only used for pre available template type Box Sized Mega Menu", IEPA_TEXT_DOMAIN) ?>
                 </p>
               </td>
               <td>
                <input type='text'
                name='iepammmegamenu_custommeta[<?php echo esc_attr($mlocation);?>][icon_bghcolor]'
                value="<?php echo esc_attr($icon_bghcolor);?>" class="imma-mm-color-picker"/>
              </td>
             </tr>
           </table>
        </div>

        <div class="tab-panes" id="tabs_megamenu" style="display:none;">
        <?php
        $headertitle_fcolor = (isset($menu_general_settings[$mlocation]['headertitle_fcolor']) && $menu_general_settings[$mlocation]['headertitle_fcolor'] != '')?esc_attr($menu_general_settings[$mlocation]['headertitle_fcolor']):'';
        $underline_color = (isset($menu_general_settings[$mlocation]['underline_color']) && $menu_general_settings[$mlocation]['underline_color'] != '')?esc_attr($menu_general_settings[$mlocation]['underline_color']):'';
        $header_title_bgcolor = (isset($menu_general_settings[$mlocation]['header_title_bgcolor']) && $menu_general_settings[$mlocation]['header_title_bgcolor'] != '')?esc_attr($menu_general_settings[$mlocation]['header_title_bgcolor']):'';
        $header_title_fsize = (isset($menu_general_settings[$mlocation]['header_title_fsize']) && $menu_general_settings[$mlocation]['header_title_fsize'] != '') ? intval( esc_attr( $menu_general_settings[$mlocation]['header_title_fsize'] ) ) : '';

        $submenu_fsize = (isset($menu_general_settings[$mlocation]['submenu_fsize']) && $menu_general_settings[$mlocation]['submenu_fsize'] != '')?intval( esc_attr( $menu_general_settings[$mlocation]['submenu_fsize'] ) ):'';
        $submenu_fcolor = (isset($menu_general_settings[$mlocation]['submenu_fcolor']) && $menu_general_settings[$mlocation]['submenu_fcolor'] != '')?esc_attr($menu_general_settings[$mlocation]['submenu_fcolor']):'';
        $submenu_fhcolor = (isset($menu_general_settings[$mlocation]['submenu_fhcolor']) && $menu_general_settings[$mlocation]['submenu_fhcolor'] != '')?esc_attr($menu_general_settings[$mlocation]['submenu_fhcolor']):'';
        $submenu_border_ucolor = (isset($menu_general_settings[$mlocation]['submenu_border_ucolor']) && $menu_general_settings[$mlocation]['submenu_border_ucolor'] != '')?esc_attr($menu_general_settings[$mlocation]['submenu_border_ucolor']):'';
        $submenu_bghcolor = (isset($menu_general_settings[$mlocation]['submenu_bghcolor']) && $menu_general_settings[$mlocation]['submenu_bghcolor'] != '')?esc_attr($menu_general_settings[$mlocation]['submenu_bghcolor']):'';
        $megamenu_bgcolor = (isset($menu_general_settings[$mlocation]['megamenu_bgcolor']) && $menu_general_settings[$mlocation]['megamenu_bgcolor'] != '')?esc_attr($menu_general_settings[$mlocation]['megamenu_bgcolor']):'';
        ?>
          <table>
              <tr>
               <td width="400"><?php esc_html_e("Header Title Font Color", IEPA_TEXT_DOMAIN) ?>
								 <p class="description">
                  <?php esc_html_e("Set mega menu's content header title font color. Useful for simple-mm-template", IEPA_TEXT_DOMAIN) ?>
                 </p></td>
               <td>
                <input type='text'
                name='iepammmegamenu_custommeta[<?php echo esc_attr($mlocation); ?>][headertitle_fcolor]'
                value="<?php echo esc_attr($headertitle_fcolor);?>" class="imma-mm-color-picker"/>
              </td>
             </tr>

             <tr>
               <td width="400"><?php esc_html_e("Underline Color", IEPA_TEXT_DOMAIN) ?>
                 <p class="description">
                  <?php esc_html_e("Set mega menu's content header title below underline color.", IEPA_TEXT_DOMAIN) ?>
                 </p>
               </td>
               <td>
                <input type='text'
                name='iepammmegamenu_custommeta[<?php echo esc_attr($mlocation);?>][underline_color]'
                value="<?php echo esc_attr($underline_color);?>" class="imma-mm-color-picker"/>
              </td>
             </tr>
              <tr>
               <td width="400">
								 <?php esc_html_e( "Header Title Background Color", IEPA_TEXT_DOMAIN ) ?>
                 <p class="description">
                  <?php esc_html_e("Set mega menu's content header title background color. Only for template - Modern Mega Menu,Advanced Sporty Mega Menu and Orange Bar Mega Menu.", IEPA_TEXT_DOMAIN) ?>
                 </p>
               </td>
               <td>
                <input type='text'
                name='iepammmegamenu_custommeta[<?php echo esc_attr( $mlocation ); ?>][header_title_bgcolor]'
                value="<?php echo esc_attr($header_title_bgcolor); ?>" class="imma-mm-color-picker" data-alpha="true" />
              </td>
             </tr>
             <tr>
               <td width="400"><?php esc_html_e("Header Title Font Size", IEPA_TEXT_DOMAIN) ?>
                  <p class="description">
                  <?php esc_html_e("Set mega menu's content header title font size", IEPA_TEXT_DOMAIN) ?>
                 </p>
               </td>
               <td>
                <input type='number'
                name='iepammmegamenu_custommeta[<?php echo esc_attr($mlocation); ?>][header_title_fsize]'
                value="<?php echo esc_attr($header_title_fsize);?>"/>
              </td>
             </tr>
             <tr>
               <td width="400"><?php esc_html_e("Sub Menu Font Size", IEPA_TEXT_DOMAIN) ?>
                 <p class="description">
                  <?php esc_html_e("Set mega menu's content all sub menu items font size.", IEPA_TEXT_DOMAIN) ?>
                 </p>
               </td>
               <td>
                <input type='number'
                name='iepammmegamenu_custommeta[<?php echo esc_attr($mlocation); ?>][submenu_fsize]'
                value="<?php echo esc_attr($submenu_fsize); ?>"/>
              </td>
             </tr>

            <tr>
               <td width="400"><?php esc_html_e("Sub Menu Font Color", IEPA_TEXT_DOMAIN) ?>
                 <p class="description">
                  <?php esc_html_e("Set mega menu's content sub menu item's font color.", IEPA_TEXT_DOMAIN) ?>
                 </p>
               </td>
               <td>
                <input type='text'
                name='iepammmegamenu_custommeta[<?php echo esc_attr($mlocation);?>][submenu_fcolor]'
                value="<?php echo esc_attr($submenu_fcolor);?>" class="imma-mm-color-picker"/>
              </td>
             </tr>
             <tr>
               <td width="400"><?php esc_html_e("Sub Menu Hover Font Color", IEPA_TEXT_DOMAIN) ?>
                 <p class="description">
                  <?php esc_html_e("Set mega menu's content sub menu item's font hover color.", IEPA_TEXT_DOMAIN) ?>
                 </p>
               </td>
               <td>
                <input type='text'
                name='iepammmegamenu_custommeta[<?php echo esc_attr($mlocation); ?>][submenu_fhcolor]'
                value="<?php echo esc_attr($submenu_fhcolor); ?>" class="imma-mm-color-picker"/>

              </td>
             </tr>
             <tr>
               <td width="400">
								 <?php esc_html_e("Sub Menu Underline Color", IEPA_TEXT_DOMAIN) ?>
                  <p class="description">
                  <?php esc_html_e("Set mega menu's content sub menu item's on hover underline color.For template type - Simple Mega Menu,Highlighted Border Mega Menu", IEPA_TEXT_DOMAIN) ?>
                 </p>
               </td>
               <td>
                <input type='text'
                name="iepammmegamenu_custommeta[<?php echo esc_attr($mlocation); ?>][submenu_border_ucolor]"
                value="<?php echo esc_attr($submenu_border_ucolor); ?>" class="imma-mm-color-picker"/>
              </td>
             </tr>
             <tr>
               <td width="400"><?php esc_html_e("Background Hover Color", IEPA_TEXT_DOMAIN) ?>
                 <p class="description">
                  <?php esc_html_e("Set mega menu's content sub menu item's on hover background color. For template type - Dark Orchid Mega Menu,Box Sized Mega Menu", IEPA_TEXT_DOMAIN) ?>
                 </p>
               </td>
               <td>
                <input type='text'
                name='iepammmegamenu_custommeta[<?php echo esc_attr($mlocation); ?>][submenu_bghcolor]'
                value="<?php echo esc_attr($submenu_bghcolor); ?>" class="imma-mm-color-picker" data-alpha="true"/>
              </td>
             </tr>
             <tr>
               <td width="400"><?php esc_html_e("Mega Menu Background Color", IEPA_TEXT_DOMAIN) ?>
                 <p class="description">
                  <?php esc_html_e("Set mega menu's background color for all menu items having mega menu wrapper except flyout menu.", IEPA_TEXT_DOMAIN); ?>
                 </p>
               </td>
               <td>
                <input type='text'
                name='iepammmegamenu_custommeta[<?php echo esc_attr($mlocation);?>][megamenu_bgcolor]'
                value="<?php echo esc_attr($megamenu_bgcolor);?>" class="imma-mm-color-picker" data-alpha="true"/>
              </td>
             </tr>
          </table>
        </div>

        <div class="tab-panes" id="tabs_flyout" style="display:none;">
        <?php
        $flyoutmenu_fcolor = (isset($menu_general_settings[$mlocation]['flyoutmenu_fcolor']) && $menu_general_settings[$mlocation]['flyoutmenu_fcolor'] != '')?esc_attr($menu_general_settings[$mlocation]['flyoutmenu_fcolor']):'';
        $flyoutmenu_fhcolor = (isset($menu_general_settings[$mlocation]['flyoutmenu_fhcolor']) && $menu_general_settings[$mlocation]['flyoutmenu_fhcolor'] != '')?esc_attr($menu_general_settings[$mlocation]['flyoutmenu_fhcolor']):'';
        $flyoutmenu_ucolor = (isset($menu_general_settings[$mlocation]['flyoutmenu_ucolor']) && $menu_general_settings[$mlocation]['flyoutmenu_ucolor'] != '')?esc_attr($menu_general_settings[$mlocation]['flyoutmenu_ucolor']):'';
        $flyoutmenu_bghcolor = (isset($menu_general_settings[$mlocation]['flyoutmenu_bghcolor']) && $menu_general_settings[$mlocation]['flyoutmenu_bghcolor'] != '')?esc_attr($menu_general_settings[$mlocation]['flyoutmenu_bghcolor']):'';
        $flyoutmenu_bgcolor = (isset($menu_general_settings[$mlocation]['flyoutmenu_bgcolor']) && $menu_general_settings[$mlocation]['flyoutmenu_bgcolor'] != '')?esc_attr($menu_general_settings[$mlocation]['flyoutmenu_bgcolor']):'';
        ?>
         <table>
            <tr>
               <td width="400"><?php esc_html_e("Font Color", IEPA_TEXT_DOMAIN) ?>
                  <p class="description">
                  <?php esc_html_e("Set all flyout sub menu item's font color except top level menu item.", IEPA_TEXT_DOMAIN); ?>
                 </p>
               </td>
               <td>
                 <input type='text'
                name='iepammmegamenu_custommeta[<?php echo esc_attr($mlocation);?>][flyoutmenu_fcolor]'
                value="<?php echo esc_attr($flyoutmenu_fcolor);?>" class="imma-mm-color-picker"/>
               </td>
            </tr>
            <tr>
               <td width="400"><?php esc_html_e(" Font Hover Color", IEPA_TEXT_DOMAIN) ?>
                 <p class="description">
                  <?php esc_html_e("Set all flyout sub menu item's font hover color except top level menu item.", IEPA_TEXT_DOMAIN); ?>
                 </p>
               </td>
               <td>
                 <input type='text'
                name='iepammmegamenu_custommeta[<?php echo esc_attr($mlocation);?>][flyoutmenu_fhcolor]'
                value="<?php echo esc_attr($flyoutmenu_fhcolor);?>" class="imma-mm-color-picker"/>
               </td>
            </tr>
            <tr>
               <td width="400"><?php esc_html_e("Underline Hover Color", IEPA_TEXT_DOMAIN) ?>
                 <p class="description">
                  <?php esc_html_e("Set all flyout sub menu item's on hover underline color except top level menu item.", IEPA_TEXT_DOMAIN); ?>
                 </p>
               </td>
               <td>
                 <input type='text'
                name='iepammmegamenu_custommeta[<?php echo esc_attr($mlocation); ?>][flyoutmenu_ucolor]'
                value="<?php echo esc_attr($flyoutmenu_ucolor);?>" class="imma-mm-color-picker" />
               </td>
            </tr>
             <tr>
               <td width="400"><?php esc_html_e("Background Hover Color", IEPA_TEXT_DOMAIN) ?>
                  <p class="description">
                  <?php esc_html_e("Set all flyout sub menu item's on hover background color except top level menu item.", IEPA_TEXT_DOMAIN); ?>
                 </p>
               </td>
               <td>
                 <input type='text'
                name='iepammmegamenu_custommeta[<?php echo esc_attr($mlocation);?>][flyoutmenu_bghcolor]'
                value="<?php echo esc_attr($flyoutmenu_bghcolor);?>" class="imma-mm-color-picker"/>
               </td>
            </tr>
            <tr>
               <td width="400"><?php esc_html_e("Background Color", IEPA_TEXT_DOMAIN) ?>
                 <p class="description">
                  <?php esc_html_e("Set all flyout sub menu item's custom background color except top level menu item.", IEPA_TEXT_DOMAIN); ?>
                 </p>
               </td>
               <td>
                 <input type='text'
                name='iepammmegamenu_custommeta[<?php echo esc_attr($mlocation);?>][flyoutmenu_bgcolor]'
                value="<?php echo esc_attr($flyoutmenu_bgcolor);?>" class="imma-mm-color-picker"/>
               </td>
            </tr>
          </table>
        </div>
        <div class="tab-panes" id="tabs_menu_label" style="display:none;">
        <?php
          $menu_label_bradius = ( isset( $menu_general_settings[$mlocation]['menu_label_bradius']) && $menu_general_settings[$mlocation]['menu_label_bradius'] != '' ) ? intval( esc_attr( $menu_general_settings[$mlocation]['menu_label_bradius'] ) ) : '';
          $menu_label_fcolor = ( isset( $menu_general_settings[$mlocation]['menu_label_fcolor']) && $menu_general_settings[$mlocation]['menu_label_fcolor'] != '')?esc_attr($menu_general_settings[$mlocation]['menu_label_fcolor']):'';
          $menu_label_bgcolor = ( isset( $menu_general_settings[$mlocation]['menu_label_bgcolor']) && $menu_general_settings[$mlocation]['menu_label_bgcolor'] != '')?esc_attr($menu_general_settings[$mlocation]['menu_label_bgcolor']):'';
          $menu_label_text_transform = ( isset( $menu_general_settings[$mlocation]['menu_label_text_transform']) && $menu_general_settings[$mlocation]['menu_label_text_transform'] != '')?esc_attr($menu_general_settings[$mlocation]['menu_label_text_transform']):'';
          $menu_label_arrowcolor = ( isset( $menu_general_settings[$mlocation]['menu_label_arrowcolor']) && $menu_general_settings[$mlocation]['menu_label_arrowcolor'] != '')?esc_attr($menu_general_settings[$mlocation]['menu_label_arrowcolor']):'';
          ?>
          <table>
            <tr>
               <td width="400">
								 <?php esc_html_e( "Border Radius (in px)", IEPA_TEXT_DOMAIN ); ?>
                  <p class="description">
                  <?php esc_html_e( "Set all menu label's common border radius in pixel.", IEPA_TEXT_DOMAIN ); ?>
                 </p>
               </td>
               <td>
                <input type='number'
                name="iepammmegamenu_custommeta[<?php echo esc_attr($mlocation);?>][menu_label_bradius]"
                value="<?php echo esc_attr($menu_label_bradius); ?>" />
              </td>
             </tr>
             <tr>
               <td width="400"><?php esc_html_e( "Font Color", IEPA_TEXT_DOMAIN ); ?>
                 <p class="description">
                  <?php esc_html_e( "Set all menu label's common font color.", IEPA_TEXT_DOMAIN ); ?>
                 </p>
               </td>
               <td>
                <input type='text'
                name='iepammmegamenu_custommeta[<?php echo esc_attr($mlocation);?>][menu_label_fcolor]'
                value="<?php echo esc_attr($menu_label_fcolor);?>" class="imma-mm-color-picker"
								/>
              </td>
             </tr>
             <tr>
               <td width="400"><?php esc_html_e( "Background Color", IEPA_TEXT_DOMAIN ); ?>
                 <p class="description">
                  <?php esc_html_e( "Set all menu label's common background color.", IEPA_TEXT_DOMAIN ); ?>
                 </p>
               </td>
               <td>
                <input type='text'
                name='iepammmegamenu_custommeta[<?php echo esc_attr($mlocation); ?>][menu_label_bgcolor]'
                value="<?php echo esc_attr($menu_label_bgcolor);?>" class="imma-mm-color-picker" data-alpha="true"/>
              </td>
             </tr>
             <tr>
               <td width="400"><?php esc_html_e("Text Transform", IEPA_TEXT_DOMAIN) ?>
                 <p class="description">
                  <?php esc_html_e("Set all menu label's common text transfrom.", IEPA_TEXT_DOMAIN); ?>
                 </p>
               </td>
               <td>
                <select name="iepammmegamenu_custommeta[<?php echo esc_attr( $mlocation ); ?>][menu_label_text_transform]">
									<option value="normal" <?php echo ( isset( $menu_label_text_transform ) && $menu_label_text_transform == 'normal' ) ? esc_attr("selected=selected") : ''; ?>>
										<?php esc_html_e( 'Normal', IEPA_TEXT_DOMAIN ); ?>
									</option>
									<option value="capitalize" <?php echo (isset($menu_label_text_transform) && $menu_label_text_transform == 'capitalize')?esc_attr("selected=selected"):'';?>>
										<?php esc_html_e( 'Capitalize', IEPA_TEXT_DOMAIN ); ?>
									</option>
									<option value="uppercase" <?php echo (isset($menu_label_text_transform) && $menu_label_text_transform == 'uppercase')?esc_attr("selected=selected"):'';?>>
										<?php esc_html_e( 'Uppercase', IEPA_TEXT_DOMAIN ); ?>
									</option>
									<option value="lowercase" <?php echo ( isset( $menu_label_text_transform ) && $menu_label_text_transform == 'lowercase' ) ? esc_attr("selected=selected") : '';?>>
										<?php esc_html_e( 'Lowercase', IEPA_TEXT_DOMAIN ); ?>
									</option>
                </select>
              </td>
             </tr>

						 <tr>
               <td width="400">
								 <?php esc_html_e("Arrow Background Color", IEPA_TEXT_DOMAIN); ?>
                  <p class="description">
                  <?php esc_html_e( "Set all menu label's down arrow background color. For Advanced Magazine Mega Menu template layout, this option works for both menu label's border and its down arrow type custom color.", IEPA_TEXT_DOMAIN ); ?>
                 </p>
               </td>
               <td>
               <input type='text' name='iepammmegamenu_custommeta[<?php echo esc_attr( $mlocation ); ?>][menu_label_arrowcolor]' value="<?php echo esc_attr( $menu_label_arrowcolor ); ?>" class="imma-mm-color-picker"/>
              </td>
             </tr>
          </table>
        </div>
      </div>
   </div>
</div>
