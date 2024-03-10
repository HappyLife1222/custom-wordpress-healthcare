<?php
//about theme info
add_action( 'admin_menu', 'vw_healthcare_gettingstarted' );
function vw_healthcare_gettingstarted() {
	add_theme_page( esc_html__('About VW Healthcare', 'vw-healthcare'), esc_html__('About VW Healthcare', 'vw-healthcare'), 'edit_theme_options', 'vw_healthcare_guide', 'vw_healthcare_mostrar_guide');
}

// Add a Custom CSS file to WP Admin Area
function vw_healthcare_admin_theme_style() {
	wp_enqueue_style('vw-healthcare-custom-admin-style', esc_url(get_template_directory_uri()) . '/inc/getstart/getstart.css');
	wp_enqueue_script('vw-healthcare-tabs', esc_url(get_template_directory_uri()) . '/inc/getstart/js/tab.js');
}
add_action('admin_enqueue_scripts', 'vw_healthcare_admin_theme_style');

//guidline for about theme
function vw_healthcare_mostrar_guide() { 
	//custom function about theme customizer
	$vw_healthcare_return = add_query_arg( array()) ;
	$vw_healthcare_theme = wp_get_theme( 'vw-healthcare' );
?>

<div class="wrapper-info">
    <div class="col-left">
    	<h2><?php esc_html_e( 'Welcome to VW Healthcare', 'vw-healthcare' ); ?> <span class="version"><?php esc_html_e( 'Version', 'vw-healthcare' ); ?>: <?php echo esc_html($vw_healthcare_theme['Version']);?></span></h2>
    	<p><?php esc_html_e('All our WordPress themes are modern, minimalist, 100% responsive, seo-friendly,feature-rich, and multipurpose that best suit designers, bloggers and other professionals who are working in the creative fields.','vw-healthcare'); ?></p>
    </div>
    <div class="col-right">
    	<div class="logo">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/final-logo.png" alt="" />
		</div>
		<div class="update-now">
			<h4><?php esc_html_e('Buy VW Healthcare at 20% Discount','vw-healthcare'); ?></h4>
			<h4><?php esc_html_e('Use Coupon','vw-healthcare'); ?> ( <span><?php esc_html_e('vwpro20','vw-healthcare'); ?></span> ) </h4> 
			<div class="info-link">
				<a href="<?php echo esc_url( VW_HEALTHCARE_BUY_NOW ); ?>" target="_blank"> <?php esc_html_e( 'Upgrade to Pro', 'vw-healthcare' ); ?></a>
			</div>
		</div>
    </div>

    <div class="tab-sec">
    	<div class="tab">
			<button class="tablinks" onclick="vw_healthcare_open_tab(event, 'lite_theme')"><?php esc_html_e( 'Setup With Customizer', 'vw-healthcare' ); ?></button>
			<button class="tablinks" onclick="vw_healthcare_open_tab(event, 'block_pattern')"><?php esc_html_e( 'Setup With Block Pattern', 'vw-healthcare' ); ?></button>
			<button class="tablinks" onclick="vw_healthcare_open_tab(event, 'gutenberg_editor')"><?php esc_html_e( 'Setup With Gutunberg Block', 'vw-healthcare' ); ?></button>
			<button class="tablinks" onclick="vw_healthcare_open_tab(event, 'product_addons_editor')"><?php esc_html_e( 'Woocommerce Product Addons', 'vw-healthcare' ); ?></button>
			<button class="tablinks" onclick="vw_healthcare_open_tab(event, 'pro_theme')"><?php esc_html_e( 'Get Premium', 'vw-healthcare' ); ?></button>
			<button class="tablinks" onclick="vw_healthcare_open_tab(event, 'lite_pro')"><?php esc_html_e( 'Support', 'vw-healthcare' ); ?></button>
		</div>

		<?php
			$vw_healthcare_plugin_custom_css = '';
			if(class_exists('Ibtana_Visual_Editor_Menu_Class')){
				$vw_healthcare_plugin_custom_css ='display: block';
			}
		?>
		<div id="lite_theme" class="tabcontent open">
			<?php if(!class_exists('Ibtana_Visual_Editor_Menu_Class')){ 
				$plugin_ins = VW_Healthcare_Plugin_Activation_Settings::get_instance();
				$vw_healthcare_actions = $plugin_ins->recommended_actions;
				?>
				<div class="vw-healthcare-recommended-plugins">
				    <div class="vw-healthcare-action-list">
				        <?php if ($vw_healthcare_actions): foreach ($vw_healthcare_actions as $key => $vw_healthcare_actionValue): ?>
				                <div class="vw-healthcare-action" id="<?php echo esc_attr($vw_healthcare_actionValue['id']);?>">
			                        <div class="action-inner">
			                            <h3 class="action-title"><?php echo esc_html($vw_healthcare_actionValue['title']); ?></h3>
			                            <div class="action-desc"><?php echo esc_html($vw_healthcare_actionValue['desc']); ?></div>
			                            <?php echo wp_kses_post($vw_healthcare_actionValue['link']); ?>
			                            <a class="ibtana-skip-btn" get-start-tab-id="lite-theme-tab" href="javascript:void(0);"><?php esc_html_e('Skip','vw-healthcare'); ?></a>
			                        </div>
				                </div>
				            <?php endforeach;
				        endif; ?>
				    </div>
				</div>
			<?php } ?>
			<div class="lite-theme-tab" style="<?php echo esc_attr($vw_healthcare_plugin_custom_css); ?>">
				<h3><?php esc_html_e( 'Lite Theme Information', 'vw-healthcare' ); ?></h3>
				<hr class="h3hr">	
				<p><?php esc_html_e('If you are willing to get started with a website that represents your healthcare services, then you must consider tying this Free Healthcare WordPress Theme. Being a free theme, it costs you absolutely nothing. For using the theme, all you need to do is download it. It doesn’t matter what kind of healthcare services you provide; it will cater to the needs of all of them. The theme is extremely easy to set up and you can effortlessly get on with it as you don’t really need to have any sort of programming knowledge or coding experience to use it. This user-friendly theme lets you upload your own personalized logo as it plays a key role in establishing your identity as a brand. The theme is scalable which means your website is going to look amazing on screens of various devices. Moreover, your visitors will be able to access your website using any popular web browser.','vw-healthcare'); ?></p>	
			  	<div class="col-left-inner">
			  		<h4><?php esc_html_e( 'Theme Documentation', 'vw-healthcare' ); ?></h4>
					<p><?php esc_html_e( 'If you need any assistance regarding setting up and configuring the Theme, our documentation is there.', 'vw-healthcare' ); ?></p>
					<div class="info-link">
						<a href="<?php echo esc_url( VW_HEALTHCARE_FREE_THEME_DOC ); ?>" target="_blank"> <?php esc_html_e( 'Documentation', 'vw-healthcare' ); ?></a>
					</div>
					<hr>
					<h4><?php esc_html_e('Theme Customizer', 'vw-healthcare'); ?></h4>
					<p> <?php esc_html_e('To begin customizing your website, start by clicking "Customize".', 'vw-healthcare'); ?></p>
					<div class="info-link">
						<a target="_blank" href="<?php echo esc_url( admin_url('customize.php') ); ?>"><?php esc_html_e('Customizing', 'vw-healthcare'); ?></a>
					</div>
					<hr>				
					<h4><?php esc_html_e('Having Trouble, Need Support?', 'vw-healthcare'); ?></h4>
					<p> <?php esc_html_e('Our dedicated team is well prepared to help you out in case of queries and doubts regarding our theme.', 'vw-healthcare'); ?></p>
					<div class="info-link">
						<a href="<?php echo esc_url( VW_HEALTHCARE_SUPPORT ); ?>" target="_blank"><?php esc_html_e('Support Forum', 'vw-healthcare'); ?></a>
					</div>
					<hr>
					<h4><?php esc_html_e('Reviews & Testimonials', 'vw-healthcare'); ?></h4>
					<p> <?php esc_html_e('All the features and aspects of this WordPress Theme are phenomenal. I\'d recommend this theme to all.', 'vw-healthcare'); ?></p>
					<div class="info-link">
						<a href="<?php echo esc_url( VW_HEALTHCARE_REVIEW ); ?>" target="_blank"><?php esc_html_e('Reviews', 'vw-healthcare'); ?></a>
					</div>
					<div class="link-customizer">
						<h3><?php esc_html_e( 'Link to customizer', 'vw-healthcare' ); ?></h3>
						<hr class="h3hr">
						<div class="first-row">
							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-buddicons-buddypress-logo"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[control]=custom_logo') ); ?>" target="_blank"><?php esc_html_e('Upload your logo','vw-healthcare'); ?></a>
								</div>
								<div class="row-box2">
									<span class="dashicons dashicons-format-gallery"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_healthcare_post_settings') ); ?>" target="_blank"><?php esc_html_e('Post settings','vw-healthcare'); ?></a>
								</div>
							</div>

							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-slides"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_healthcare_slidersettings') ); ?>" target="_blank"><?php esc_html_e('Slider Settings','vw-healthcare'); ?></a>
								</div>
								<div class="row-box2">
									<span class="dashicons dashicons-category"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_healthcare_services') ); ?>" target="_blank"><?php esc_html_e('Specialize Section','vw-healthcare'); ?></a>
								</div>
							</div>
						
							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-menu"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=nav_menus') ); ?>" target="_blank"><?php esc_html_e('Menus','vw-healthcare'); ?></a>
								</div>
								<div class="row-box2">
									<span class="dashicons dashicons-screenoptions"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=widgets') ); ?>" target="_blank"><?php esc_html_e('Footer Widget','vw-healthcare'); ?></a>
								</div>
							</div>
							
							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-admin-generic"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_healthcare_left_right') ); ?>" target="_blank"><?php esc_html_e('General Settings','vw-healthcare'); ?></a>
								</div>
								<div class="row-box2">
									<span class="dashicons dashicons-text-page"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_healthcare_footer') ); ?>" target="_blank"><?php esc_html_e('Footer Text','vw-healthcare'); ?></a>
								</div>
							</div>
						</div>
					</div>
			  	</div>
				<div class="col-right-inner">
					<h3 class="page-template"><?php esc_html_e('How to set up Home Page Template','vw-healthcare'); ?></h3>
				  	<hr class="h3hr">
					<p><?php esc_html_e('Follow these instructions to setup Home page.','vw-healthcare'); ?></p>
                  	<p><span class="strong"><?php esc_html_e('1. Create a new page :','vw-healthcare'); ?></span><?php esc_html_e(' Go to ','vw-healthcare'); ?>
					  	<b><?php esc_html_e(' Dashboard >> Pages >> Add New Page','vw-healthcare'); ?></b></p>
                  	<p><?php esc_html_e('Name it as "Home" then select the template "Custom Home Page".','vw-healthcare'); ?></p>
                  	<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/home-page-template.png" alt="" />
                  	<p><span class="strong"><?php esc_html_e('2. Set the front page:','vw-healthcare'); ?></span><?php esc_html_e(' Go to ','vw-healthcare'); ?>
					  	<b><?php esc_html_e(' Settings >> Reading ','vw-healthcare'); ?></b></p>
				  	<p><?php esc_html_e('Select the option of Static Page, now select the page you created to be the homepage, while another page to be your default page.','vw-healthcare'); ?></p>
                  	<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/set-front-page.png" alt="" />
                  	<p><?php esc_html_e(' Once you are done with setup, then follow the','vw-healthcare'); ?> <a class="doc-links" href="<?php echo esc_url( VW_HEALTHCARE_FREE_THEME_DOC ); ?>" target="_blank"><?php esc_html_e('Documentation','vw-healthcare'); ?></a></p>
			  	</div>
			</div>
		</div>	

		<div id="block_pattern" class="tabcontent">
			<?php if(!class_exists('Ibtana_Visual_Editor_Menu_Class')){ 
			$plugin_ins = VW_Healthcare_Plugin_Activation_Settings::get_instance();
			$vw_healthcare_actions = $plugin_ins->recommended_actions;
			?>
				<div class="vw-healthcare-recommended-plugins">
				    <div class="vw-healthcare-action-list">
				        <?php if ($vw_healthcare_actions): foreach ($vw_healthcare_actions as $key => $vw_healthcare_actionValue): ?>
				                <div class="vw-healthcare-action" id="<?php echo esc_attr($vw_healthcare_actionValue['id']);?>">
			                        <div class="action-inner">
			                            <h3 class="action-title"><?php echo esc_html($vw_healthcare_actionValue['title']); ?></h3>
			                            <div class="action-desc"><?php echo esc_html($vw_healthcare_actionValue['desc']); ?></div>
			                            <?php echo wp_kses_post($vw_healthcare_actionValue['link']); ?>
			                            <a class="ibtana-skip-btn" href="javascript:void(0);" get-start-tab-id="gutenberg-editor-tab"><?php esc_html_e('Skip','vw-healthcare'); ?></a>
			                        </div>
				                </div>
				            <?php endforeach;
				        endif; ?>
				    </div>
				</div>
			<?php } ?>
			<div class="gutenberg-editor-tab" style="<?php echo esc_attr($vw_healthcare_plugin_custom_css); ?>">
				<div class="block-pattern-img">
				  	<h3><?php esc_html_e( 'Block Patterns', 'vw-healthcare' ); ?></h3>
					<hr class="h3hr">
					<p><?php esc_html_e('Follow the below instructions to setup Home page with Block Patterns.','vw-healthcare'); ?></p>
	              		<p><b><?php esc_html_e('Click on Below Add new page button >> Click on "+" Icon.','vw-healthcare'); ?></span></b></p>
	              	<div class="vw-healthcare-pattern-page">
				    	<a href="javascript:void(0)" class="vw-pattern-page-btn button-primary button"><?php esc_html_e('Add New Page','vw-healthcare'); ?></a>
				    </div>
				    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/block-pattern1.png" alt="" />
				    	<p><b><?php esc_html_e('Click on Patterns Tab >> Click on Theme Name >> Click on Sections >> Publish.','vw-healthcare'); ?></span></b></p>
	              	<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/block-pattern.png" alt="" />		
	            </div>

	            <div class="block-pattern-link-customizer">
	              	<div class="link-customizer-with-block-pattern">
						<h3><?php esc_html_e( 'Link to customizer', 'vw-healthcare' ); ?></h3>
						<hr class="h3hr">
						<div class="first-row">
							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-buddicons-buddypress-logo"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[control]=custom_logo') ); ?>" target="_blank"><?php esc_html_e('Upload your logo','vw-healthcare'); ?></a>
								</div>
								<div class="row-box2">
									<span class="dashicons dashicons-format-gallery"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_healthcare_post_settings') ); ?>" target="_blank"><?php esc_html_e('Post settings','vw-healthcare'); ?></a>
								</div>
							</div>
							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-menu"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=nav_menus') ); ?>" target="_blank"><?php esc_html_e('Menus','vw-healthcare'); ?></a>
								</div>
								
								<div class="row-box2">
									<span class="dashicons dashicons-text-page"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_healthcare_footer') ); ?>" target="_blank"><?php esc_html_e('Footer Text','vw-healthcare'); ?></a>
								</div>
							</div>
							
							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-admin-generic"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_healthcare_left_right') ); ?>" target="_blank"><?php esc_html_e('General Settings','vw-healthcare'); ?></a>
								</div>
								 <div class="row-box2">
									<span class="dashicons dashicons-screenoptions"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=widgets') ); ?>" target="_blank"><?php esc_html_e('Footer Widget','vw-healthcare'); ?></a>
								</div> 
							</div>
						</div>
					</div>	
				</div>

	        </div>
		</div>

		<div id="gutenberg_editor" class="tabcontent">
			<?php if(!class_exists('Ibtana_Visual_Editor_Menu_Class')){ 
			$plugin_ins = VW_Healthcare_Plugin_Activation_Settings::get_instance();
			$vw_healthcare_actions = $plugin_ins->recommended_actions;
			?>
				<div class="vw-healthcare-recommended-plugins">
				    <div class="vw-healthcare-action-list">
				        <?php if ($vw_healthcare_actions): foreach ($vw_healthcare_actions as $key => $vw_healthcare_actionValue): ?>
				                <div class="vw-healthcare-action" id="<?php echo esc_attr($vw_healthcare_actionValue['id']);?>">
			                        <div class="action-inner plugin-activation-redirect">
			                            <h3 class="action-title"><?php echo esc_html($vw_healthcare_actionValue['title']); ?></h3>
			                            <div class="action-desc"><?php echo esc_html($vw_healthcare_actionValue['desc']); ?></div>
			                            <?php echo wp_kses_post($vw_healthcare_actionValue['link']); ?>
			                        </div>
				                </div>
				            <?php endforeach;
				        endif; ?>
				    </div>
				</div>
			<?php }else{ ?>
				<h3><?php esc_html_e( 'Gutunberg Blocks', 'vw-healthcare' ); ?></h3>
				<hr class="h3hr">
				<div class="vw-healthcare-pattern-page">
			    	<a href="<?php echo esc_url( admin_url( 'admin.php?page=ibtana-visual-editor-templates' ) ); ?>" class="vw-pattern-page-btn ibtana-dashboard-page-btn button-primary button"><?php esc_html_e('Ibtana Settings','vw-healthcare'); ?></a>
			    </div>

			    <div class="link-customizer-with-guternberg-ibtana">
	              	<div class="link-customizer-with-block-pattern">
						<h3><?php esc_html_e( 'Link to customizer', 'vw-healthcare' ); ?></h3>
						<hr class="h3hr">
						<div class="first-row">
							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-buddicons-buddypress-logo"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[control]=custom_logo') ); ?>" target="_blank"><?php esc_html_e('Upload your logo','vw-healthcare'); ?></a>
								</div>
								<div class="row-box2">
									<span class="dashicons dashicons-format-gallery"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_healthcare_post_settings') ); ?>" target="_blank"><?php esc_html_e('Post settings','vw-healthcare'); ?></a>
								</div>
							</div>
							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-menu"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=nav_menus') ); ?>" target="_blank"><?php esc_html_e('Menus','vw-healthcare'); ?></a>
								</div>
								
								<div class="row-box2">
									<span class="dashicons dashicons-text-page"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_healthcare_footer') ); ?>" target="_blank"><?php esc_html_e('Footer Text','vw-healthcare'); ?></a>
								</div>
							</div>
							
							<div class="row-box">
								<div class="row-box1">
									<span class="dashicons dashicons-admin-generic"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_healthcare_left_right') ); ?>" target="_blank"><?php esc_html_e('General Settings','vw-healthcare'); ?></a>
								</div>
								 <div class="row-box2">
									<span class="dashicons dashicons-screenoptions"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[panel]=widgets') ); ?>" target="_blank"><?php esc_html_e('Footer Widget','vw-healthcare'); ?></a>
								</div> 
							</div>
						</div>
					</div>	
				</div>
			<?php } ?>
		</div>

		<div id="product_addons_editor" class="tabcontent">
			<?php if(!class_exists('IEPA_Loader')){
				$plugin_ins = vw_healthcare_Plugin_Activation_Woo_Products::get_instance();
				$vw_healthcare_actions = $plugin_ins->recommended_actions;
				?>
				<div class="vw-healthcare-recommended-plugins">
					    <div class="vw-healthcare-action-list">
					        <?php if ($vw_healthcare_actions): foreach ($vw_healthcare_actions as $key => $vw_healthcare_actionValue): ?>
					                <div class="vw-healthcare-action" id="<?php echo esc_attr($vw_healthcare_actionValue['id']);?>">
				                        <div class="action-inner plugin-activation-redirect">
				                            <h3 class="action-title"><?php echo esc_html($vw_healthcare_actionValue['title']); ?></h3>
				                            <div class="action-desc"><?php echo esc_html($vw_healthcare_actionValue['desc']); ?></div>
				                            <?php echo wp_kses_post($vw_healthcare_actionValue['link']); ?>
				                        </div>
					                </div>
					            <?php endforeach;
					        endif; ?>
					    </div>
				</div>
			<?php }else{ ?>
				<h3><?php esc_html_e( 'Woocommerce Products Blocks', 'vw-healthcare' ); ?></h3>
				<hr class="h3hr">
				<div class="vw-healthcare-pattern-page">
					<p><?php esc_html_e('Follow the below instructions to setup Products Templates.','vw-healthcare'); ?></p>
					<p><b><?php esc_html_e('1. First you need to activate these plugins','vw-healthcare'); ?></b></p>
						<p><?php esc_html_e('1. Ibtana - WordPress Website Builder ','vw-healthcare'); ?></p>
						<p><?php esc_html_e('2. Ibtana - Ecommerce Product Addons.','vw-healthcare'); ?></p>
						<p><?php esc_html_e('3. Woocommerce','vw-healthcare'); ?></p>

					<p><b><?php esc_html_e('2. Go To Dashboard >> Ibtana Settings >> Woocommerce Templates','vw-healthcare'); ?></span></b></p>
	              	<div class="vw-healthcare-pattern-page">
			    		<a href="<?php echo esc_url( admin_url( 'admin.php?page=ibtana-visual-editor-woocommerce-templates&ive_wizard_view=parent' ) ); ?>" class="vw-pattern-page-btn ibtana-dashboard-page-btn button-primary button"><?php esc_html_e('Woocommerce Templates','vw-healthcare'); ?></a>
			    	</div>
	              	<p><?php esc_html_e('You can create a template as you like.','vw-healthcare'); ?></span></p>
			    </div>
			<?php } ?>
		</div>

		<div id="pro_theme" class="tabcontent">
		  	<h3><?php esc_html_e( 'Premium Theme Information', 'vw-healthcare' ); ?></h3>
			<hr class="h3hr">
		    <div class="col-left-pro">
		    	<p><?php esc_html_e('This Healthcare WordPress Theme is a professionally designed theme that serves as a complete solution for establishing any kind of healthcare-related website such as websites for hospitals, clinics, healthcare professionals, etc. Sometimes, simple and elegant stuff can be more appealing as compared to the gaudy and messy look. Considering this thing, the theme embraces a clean and sophisticated design with a well-suited header and top bar having your contact information. Ample space is given for uploading your custom designed logo. The slider of this theme is so elegantly designed that it never fails to make your website’s first impression count by leaving a positive impact of your services on visitors’ minds. You do not need to worry about the resources as you will find plenty of them in this theme, for sure. WP Healthcare WordPress Theme is translatable into different local as well as global languages thanks to its WPML and RTL compatibility.','vw-healthcare'); ?></p>
		    	<div class="pro-links">
			    	<a href="<?php echo esc_url( VW_HEALTHCARE_LIVE_DEMO ); ?>" target="_blank"><?php esc_html_e('Live Demo', 'vw-healthcare'); ?></a>
					<a href="<?php echo esc_url( VW_HEALTHCARE_BUY_NOW ); ?>" target="_blank"><?php esc_html_e('Buy Pro', 'vw-healthcare'); ?></a>
					<a href="<?php echo esc_url( VW_HEALTHCARE_PRO_DOC ); ?>" target="_blank"><?php esc_html_e('Pro Documentation', 'vw-healthcare'); ?></a>
				</div>
		    </div>
		    <div class="col-right-pro">
		    	<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/responsive.png" alt="" />
		    </div>
		    <div class="featurebox">
			    <h3><?php esc_html_e( 'Theme Features', 'vw-healthcare' ); ?></h3>
				<hr class="h3hr">
				<div class="table-image">
					<table class="tablebox">
						<thead>
							<tr>
								<th></th>
								<th><?php esc_html_e('Free Themes', 'vw-healthcare'); ?></th>
								<th><?php esc_html_e('Premium Themes', 'vw-healthcare'); ?></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><?php esc_html_e('Theme Customization', 'vw-healthcare'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Responsive Design', 'vw-healthcare'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Logo Upload', 'vw-healthcare'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Social Media Links', 'vw-healthcare'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Slider Settings', 'vw-healthcare'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Number of Slides', 'vw-healthcare'); ?></td>
								<td class="table-img"><?php esc_html_e('4', 'vw-healthcare'); ?></td>
								<td class="table-img"><?php esc_html_e('Unlimited', 'vw-healthcare'); ?></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Template Pages', 'vw-healthcare'); ?></td>
								<td class="table-img"><?php esc_html_e('3', 'vw-healthcare'); ?></td>
								<td class="table-img"><?php esc_html_e('6', 'vw-healthcare'); ?></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Home Page Template', 'vw-healthcare'); ?></td>
								<td class="table-img"><?php esc_html_e('1', 'vw-healthcare'); ?></td>
								<td class="table-img"><?php esc_html_e('1', 'vw-healthcare'); ?></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Theme sections', 'vw-healthcare'); ?></td>
								<td class="table-img"><?php esc_html_e('2', 'vw-healthcare'); ?></td>
								<td class="table-img"><?php esc_html_e('18', 'vw-healthcare'); ?></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Contact us Page Template', 'vw-healthcare'); ?></td>
								<td class="table-img">0</td>
								<td class="table-img"><?php esc_html_e('1', 'vw-healthcare'); ?></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Blog Templates & Layout', 'vw-healthcare'); ?></td>
								<td class="table-img">0</td>
								<td class="table-img"><?php esc_html_e('3(Full width/Left/Right Sidebar)', 'vw-healthcare'); ?></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Page Templates & Layout', 'vw-healthcare'); ?></td>
								<td class="table-img">0</td>
								<td class="table-img"><?php esc_html_e('2(Left/Right Sidebar)', 'vw-healthcare'); ?></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Color Pallete For Particular Sections', 'vw-healthcare'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Global Color Option', 'vw-healthcare'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Section Reordering', 'vw-healthcare'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Demo Importer', 'vw-healthcare'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Allow To Set Site Title, Tagline, Logo', 'vw-healthcare'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Enable Disable Options On All Sections, Logo', 'vw-healthcare'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Full Documentation', 'vw-healthcare'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Latest WordPress Compatibility', 'vw-healthcare'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Woo-Commerce Compatibility', 'vw-healthcare'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Support 3rd Party Plugins', 'vw-healthcare'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Secure and Optimized Code', 'vw-healthcare'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Exclusive Functionalities', 'vw-healthcare'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Section Enable / Disable', 'vw-healthcare'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Section Google Font Choices', 'vw-healthcare'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Gallery', 'vw-healthcare'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Simple & Mega Menu Option', 'vw-healthcare'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Support to add custom CSS / JS ', 'vw-healthcare'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Shortcodes', 'vw-healthcare'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Custom Background, Colors, Header, Logo & Menu', 'vw-healthcare'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Premium Membership', 'vw-healthcare'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Budget Friendly Value', 'vw-healthcare'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Priority Error Fixing', 'vw-healthcare'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Custom Feature Addition', 'vw-healthcare'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('All Access Theme Pass', 'vw-healthcare'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Seamless Customer Support', 'vw-healthcare'); ?></td>
								<td class="table-img"><span class="dashicons dashicons-no"></span></td>
								<td class="table-img"><span class="dashicons dashicons-saved"></span></td>
							</tr>
							<tr>
								<td></td>
								<td class="table-img"></td>
								<td class="update-link"><a href="<?php echo esc_url( VW_HEALTHCARE_BUY_NOW ); ?>" target="_blank"><?php esc_html_e('Upgrade to Pro', 'vw-healthcare'); ?></a></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div id="lite_pro" class="tabcontent">
		  	<div class="col-3">
		  		<h4><span class="dashicons dashicons-star-filled"></span><?php esc_html_e('Pro Version', 'vw-healthcare'); ?></h4>
				<p> <?php esc_html_e('To gain access to extra theme options and more interesting features, upgrade to pro version.', 'vw-healthcare'); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( VW_HEALTHCARE_BUY_NOW ); ?>" target="_blank"><?php esc_html_e('Get Pro', 'vw-healthcare'); ?></a>
				</div>
		  	</div>
		  	<div class="col-3">
		  		<h4><span class="dashicons dashicons-cart"></span><?php esc_html_e('Pre-purchase Queries', 'vw-healthcare'); ?></h4>
				<p> <?php esc_html_e('If you have any pre-sale query, we are prepared to resolve it.', 'vw-healthcare'); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( VW_HEALTHCARE_CONTACT ); ?>" target="_blank"><?php esc_html_e('Question', 'vw-healthcare'); ?></a>
				</div>
		  	</div>
		  	<div class="col-3">		  		
		  		<h4><span class="dashicons dashicons-admin-customizer"></span><?php esc_html_e('Child Theme', 'vw-healthcare'); ?></h4>
				<p> <?php esc_html_e('For theme file customizations, make modifications in the child theme and not in the main theme file.', 'vw-healthcare'); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( VW_HEALTHCARE_CHILD_THEME ); ?>" target="_blank"><?php esc_html_e('About Child Theme', 'vw-healthcare'); ?></a>
				</div>
		  	</div>

		  	<div class="col-3">
		  		<h4><span class="dashicons dashicons-admin-comments"></span><?php esc_html_e('Frequently Asked Questions', 'vw-healthcare'); ?></h4>
				<p> <?php esc_html_e('We have gathered top most, frequently asked questions and answered them for your easy understanding. We will list down more as we get new challenging queries. Check back often.', 'vw-healthcare'); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( VW_HEALTHCARE_FAQ ); ?>" target="_blank"><?php esc_html_e('View FAQ','vw-healthcare'); ?></a>
				</div>
		  	</div>

		  	<div class="col-3">
		  		<h4><span class="dashicons dashicons-sos"></span><?php esc_html_e('Support Queries', 'vw-healthcare'); ?></h4>
				<p> <?php esc_html_e('If you have any queries after purchase, you can contact us. We are eveready to help you out.', 'vw-healthcare'); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( VW_HEALTHCARE_SUPPORT ); ?>" target="_blank"><?php esc_html_e('Contact Us', 'vw-healthcare'); ?></a>
				</div>
		  	</div>
		</div>

	</div>
</div>

<?php } ?>