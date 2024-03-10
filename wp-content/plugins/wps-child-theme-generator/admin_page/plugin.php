<?php
// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
} ?>

<div class="wrap wps-child-theme-generator-page-settings">

    <?php include( WPS_CHILD_THEME_GENERATOR_DIR . 'blocks/title.php' ); ?>


    <div class="wps-generator-content">
        <div class="wps-tab">
            <?php

            if ( isset( $_POST['submit'] ) ) {
                echo \WPS\WPS_Child_Theme_Generator\Helpers::create_child_theme();
            } ?>
            <form action="" method="post">
	            <?php wp_nonce_field( 'form_generator', 'form_field_nonce' ); ?>
                <p>
                    <span class="wps_col_one">
                        <label for="b7ectg_ptheme"
                               class="b7ectg_label"><?php _e( 'Parent Theme', 'wps-child-theme-generator' ); ?></label>
                    </span>
                    <span class="wps_col_two">
                        <select id="b7ectg_ptheme" name="b7ectg_parenttheme" required>
                            <option value=""><?php _e( 'Select a template', 'wps-child-theme-generator' ); ?></option>
                            <?php echo \WPS\WPS_Child_Theme_Generator\Helpers::available_parent_themes(); ?>
                        </select>
                    </span>
                </p>
                <p>
                    <span class="wps_col_one">
                        <label for="b7ectg_ctheme"
                               class="b7ectg_label"><?php _e( 'Title', 'wps-child-theme-generator' ); ?></label>
                    </span>
                    <span class="wps_col_two">
                        <input type="text" name="b7ectg_childtheme" size="30" id="b7ectg_ctheme"
                               pattern="[a-zA-Z0-9\s]+"
                               oninvalid="setCustomValidity('<?php _e( 'Only Alphanumeric is allowed with Spaces', 'wps-child-theme-generator' ); ?>')"
                               onchange="try{setCustomValidity('')}catch(e){}"/>
                    </span>
                </p>
                <p>
                    <span class="wps_col_one">
                        <label for="b7ectg_themeurl"
                               class="b7ectg_label"><?php _e( 'Theme URI', 'wps-child-theme-generator' ); ?></label>
                    </span>
                    <span class="wps_col_two">
                        <input type="url" name="b7ectg_themeurl" size="30" id="b7ectg_themeurl"
                               value="https://www.wpserveur.net">
                    </span>
                </p>
                <p>
                    <span class="wps_col_one">
                        <label for="b7ectg_author"
                               class="b7ectg_label"><?php _e( 'Author', 'wps-child-theme-generator' ); ?></label></span>
                    <span class="wps_col_two">
                        <input type="text" name="b7ectg_author" size="30" id="b7ectg_author" value="WPServeur">
                    </span>
                </p>
                <p>
                    <span class="wps_col_one">
                        <label for="b7ectg_authurl"
                               class="b7ectg_label"><?php _e( 'Author URI', 'wps-child-theme-generator' ); ?></label>
                    </span>
                    <span class="wps_col_two">
                        <input type="url" name="b7ectg_authurl" size="30" id="b7ectg_authurl"
                               value="https://www.wpserveur.net">
                    </span>
                </p>
                <div id="thumb_info_0" style="">
                    <span class="wps_col_one"><label for="b7ectg_thumbnail" class="b7ectg_label"><?php _e( 'Screenshot', 'wps-child-theme-generator' ); ?></label>
                    </span>

                    <span class="wps_col_two">
                        <input class="b7ectg_img_id" id="b7ectg_img_id" name="b7ectg_img_id" type="hidden" value=""/>
                        <button id="upload-button" class="upload-custom-img button btn-wps btn-wps-screenshot"><?php _e( 'Add screenshot', 'wps-child-theme-generator' ); ?></button> <i><?php _e('Screenshot can be no larger than 1200x900px, recommanded 600x450px', 'wps-child-theme-generator');?></i>
                        <div class="wps-capture">
                            <img class="custom-img-container hidden" src="" width="300px" height="auto" style="float:left;position:relative;"/>
                        </div>
                    </span>
                </div>
                <p><span class="wps_col_one"><label class="b7ectg_label"
                                                    for="b7ectg_add_css"><?php _e( 'Add CSS', 'wps-child-theme-generator' ); ?></label></span>
                    <span class="wps_col_two">
                        <textarea id="b7ectg_add_css" name="b7ectg_add_css" cols="40" rows="30"
                                  aria-describedby="editor-keyboard-trap-help-1 editor-keyboard-trap-help-2 editor-keyboard-trap-help-3 editor-keyboard-trap-help-4"></textarea>
                    </span>
                </p>
                <p>
                    <span class="wps_col_one">
                        <label for="be7ctg_send"
                               class="b7ectg_label"><?php _e( 'Send child theme by email', 'wps-child-theme-generator' ); ?></label>
                    </span>
                    <span class="wps_col_two">
                        <input type="checkbox" name="be7ctg_send">
                        <input type="email" name="be7ctg_send_email" placeholder="your_email@gmail.com" value="">
                    </span>
                </p>
                <p>
                    <span class="wps_col_one">
                        <label class="b7ectg_label"><?php _e( 'Advanced options', 'wps-child-theme-generator' ); ?></label>
                    </span>
                    <span class="wps_col_two">
                        <button class="button btn-wps-plus btn-wps-add-options" type=button><?php _e( 'Add options', 'wps-child-theme-generator' ); ?></button></span>
                    <input id="b7ectg_options" name="b7ectg_options" type="hidden" value=""/>

                </p>
                <!-- Options block -->
                <div class="options_block">
                    <h3><?php _e( 'Images', 'wps-child-theme-generator' ); ?></h3>
                    <p>
                        <span class="wps_col_one"><?php _e( 'Image sizes', 'wps-child-theme-generator' ); ?></span>
                        <span class="wps_col_two">
                            <label for="b7ectg_img_size"
                                   class="b7ectg_label"><b><?php _e( 'List of all registered image sizes from active theme and plugins', 'wps-child-theme-generator' ); ?></b></label>
                        </span>
                    </p>
                    <p>
                        <span class="wps_col_one">&nbsp;</span>
                        <span class="wps_col_two">
                            <?php \WPS\WPS_Child_Theme_Generator\Helpers::image_sizes_render(); ?><br/>
                            <code><?php _e( 'Uncheck sizes you don\'t need anymore.', 'wps-child-theme-generator' ); ?></code><br/>
                        </span>
                    </p>

                    <p>
                        <span class="wps_col_two">
                            <label class="b7ectg_label"><?php _e( 'You can also create new size(s) (used with a previous theme)', 'wps-child-theme-generator' ); ?></label>
                            </p>
                    </span>
                    <div class="input_img_sizes_fields_wrap"></div>
                <span class="btcg_one">&nbsp;</span>
                <span class="wps_col_two">
                    <button type="button" name="" class="button btn-wps-img-size add_img_sizes_button">
                        <?php _e( 'Add new image size', 'wps-child-theme-generator' ); ?></button>
                </span>

                <!--
<h3><?php _e( 'SVG support', 'wps-child-theme-generator' ); ?></h3>
<label for="b7ectg_svg" class="b7ectg_label"><b><?php _e( 'Add support for SVG inside WordPress Media Uploader.', 'wps-child-theme-generator' ); ?></b></label><br/>
<input type="checkbox" name="b7ectg_svg"/>
<code><?php _e( 'There is a potential security risk with this. Delete this when you think you will not use it anymore (Learn how to delete this part).', 'wps-child-theme-generator' ); ?></code>
-->
                <h3><?php _e( 'Widgets', 'wps-child-theme-generator' ); ?></h3>
                <label for="b7ectg_widget"
                       class="b7ectg_label"><b><?php _e( 'List of default WordPress widgets.', 'wps-child-theme-generator' ); ?></b></label><br/>
                <div class="wps-list-check"><?php \WPS\WPS_Child_Theme_Generator\Helpers::registered_widgets_render(); ?></div>
                <br/><code><?php _e( 'Uncheck default WordPress Widgets you don\'t need anymore.', 'wps-child-theme-generator' ); ?></code>

                <p>
                    <label for="b7ectg_widget_shortcode"
                           class="b7ectg_label"><b><?php _e( 'Accept shortcode in widget', 'wps-child-theme-generator' ); ?></b><br/>
                    <input type="checkbox" id="b7ectg_widget_shortcode" name="b7ectg_widget_shortcode"/>
                    <code><?php _e( 'Widgets can\'t use shortcode. Check this box and it will be possible.', 'wps-child-theme-generator' ); ?></code>
                    </label>
                </p>

                <h3><?php _e( 'Search results', 'wps-child-theme-generator' ); ?></h3>
                <p>
                    <label for="b7ectg_search_slug"
                           class="b7ectg_label"><b><?php _e( 'Modify search results URL', 'wps-child-theme-generator' ); ?></b><br/>
                    <input type="checkbox" id="b7ectg_search_slug" name="b7ectg_search_slug"/>
                    <code><?php _e( 'Search results URL will be https://ndd.com/search/query instead of https://ndd.com/?s=query. You maybe need to save your permalink after theme activation.', 'wps-child-theme-generator' ); ?></code>
                    </label>
                </p>
                <label for="b7ectg_search_cpt"
                       class="b7ectg_label"><b><?php _e( 'Add post type to search result.', 'wps-child-theme-generator' ); ?></b></label><br/>
                <?php echo \WPS\WPS_Child_Theme_Generator\Helpers::get_post_type_render(); ?>

                <h3><?php _e( 'Administration UI', 'wps-child-theme-generator' ); ?></h3>
                <label for="b7ectg_admin_post_thumb_col"
                       class="b7ectg_label"><b><?php _e( 'Add column in post and page in admin list table.', 'wps-child-theme-generator' ); ?></b><br/>
                    <input type="checkbox" id="b7ectg_admin_post_thumb_col" name="b7ectg_admin_post_thumb_col"/>
                    <code><?php _e( 'Add thumbnail column', 'wps-child-theme-generator' ); ?></code>
                </label>
                <blockquote>
                    <label for="b7ectg_admin_post_thumb_col_post">
                        <input type="checkbox" id="b7ectg_admin_post_thumb_col_post"
                               name="b7ectg_admin_post_thumb_col_post"/> <?php _e( 'Post', 'wps-child-theme-generator' ); ?>
                    </label>
                    <label for="b7ectg_admin_post_thumb_col_page">
                        <input type="checkbox" id="b7ectg_admin_post_thumb_col_page"
                               name="b7ectg_admin_post_thumb_col_page"/><?php _e( 'Page', 'wps-child-theme-generator' ); ?>
                    </label>
                </blockquote>

                <label for="b7ectg_admin_post_id_col" class="b7ectg_label"><br/>
                    <input type="checkbox" id="b7ectg_admin_post_id_col"
                           name="b7ectg_admin_post_id_col"/><code><?php _e( 'Add ID column', 'wps-child-theme-generator' ); ?></code></label>
                <blockquote>
                    <label for="b7ectg_admin_post_id_col_post"> <input type="checkbox" id="b7ectg_admin_post_id_col_post"
                                                                       name="b7ectg_admin_post_id_col_post"/><?php _e( 'Post', 'wps-child-theme-generator' ); ?>
                    </label>
                    <label for="b7ectg_admin_post_id_col_page">
                        <input type="checkbox" id="b7ectg_admin_post_id_col_page"
                               name="b7ectg_admin_post_id_col_page"/><?php _e( 'Page', 'wps-child-theme-generator' ); ?>
                    </label>
                </blockquote>

                <p>
                    <span class="wps_col_one">
                        <label for="b7ectg_supports_block"
                               class="b7ectg_label"><?php _e( 'Supports', 'wps-child-theme-generator' ); ?></label>
                    </span>
                    <span class="wps_col_two">
                        <label for="b7ectg_supports_block"> <input class="b7ectg_supports_block" id="b7ectg_supports_block" name="b7ectg_supports_block"
                                                                   type="checkbox" value=""/><code><?php _e( 'If you do not know how it works, don\'t try to manage supports!', 'wps-child-theme-generator' ); ?></code></label>
                    </span>

                </p>
                <div class="support_block">
                    <br/>
                    <?php global $_wp_post_type_features;

                    $cpt_type = array_keys( $_wp_post_type_features );

                    $supports_by_type = array_values( array_values( array_values( $_wp_post_type_features ) ) );
                    foreach ( $supports_by_type as $item => $support ) {
                        $array_support_by_type[] = array_keys( $support );
                    }

                    foreach ( $_wp_post_type_features as $support_name => $supports ) {
                        $cpt_object = get_post_type_object( $support_name );
                        if ( ! $cpt_object ) {
                            continue;
                        }
                        $label = ($cpt_object->labels->singular_name == NULL)? $support_name : $cpt_object->labels->singular_name;

                        echo '<span class="wps_col_one" style="padding:8px 0px;"><b>'.$label.'</b> </span>';
                        echo '<span class="wps_col_two" style="position:absolute;padding:8px 0px;">';
                        echo '<code><i>' . $support_name . '</i></code>';
                        foreach ( $supports as $support => $value ) {

                            $checked = '';
                            if ( $value == true ) {
                                $checked = 'checked="checked"';
                            }
                            echo '<label class="wps-cb-separator"><input type="checkbox" name="b7ectg_support[' . $support_name . '][' . $support . ']" ' . $checked . '/>' . $support . '</label>';
                        }
                        echo '</span><br/>';
                    } ?>
                </div>
                </div>
            <p>
                <button type="submit"
                        class="button btn-wps btn-wps-add"
                        name="submit"><?php _e( 'Create child theme', 'wps-child-theme-generator' ); ?></button>
            </p>
            </form>

    </div>
</div>
<div id="plugin-filter" class="wps-autopromo">
    <?php include( WPS_CHILD_THEME_GENERATOR_DIR . '/blocks/pub-wpserveur.php' ); ?>
    <?php include( WPS_CHILD_THEME_GENERATOR_DIR . '/blocks/pub.php' ); ?>
</div>
</div>