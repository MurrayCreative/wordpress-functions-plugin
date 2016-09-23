<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://murraycreative.ie
 * @since      1.0.0
 *
 * @package    Studio_Manager
 * @subpackage Studio_Manager/admin/partials
 */
?>

<?php
/*  ==========================================================================
	 Variables being used
	========================================================================== */
	// Use the global $menu variable for the hide admin menu items
	global $menu;

	// Get all plugin options
	$options = get_option($this->plugin_name);

/*  ==========================================================================
	 Get all options
	========================================================================== */

	/* Clean-up options ========================================================================== */ 
	// WP Head Clean-up
	$cleanup = $options['cleanup'];
	// Add post, page or product slug class to body class
	$body_class_slug = $options['body_class_slug'];
	// Hide admin bar
	$hide_admin_bar = $options['hide_admin_bar'];
	// Prttify search URL
	$prettify_search = $options['prettify_search'];
	// Remove version numbers from CSS and JS
	$css_js_versions = $options['css_js_versions'];

	/* Login customisations ========================================================================== */ 
	// Custom WP login page logo
	$login_logo_id = isset($options['login_logo_id']) ? $options['login_logo_id'] : '';
	$login_logo = wp_get_attachment_image_src( $login_logo_id, 'thumbnail' );
	$login_logo_url = $login_logo[0];

	/* Image sizes ========================================================================== */ 
	// New custom image sizes
	$new_images_size = $options['new_images_size'];
	// Existing custom image sizes
	$images_size_arr = $options['images_size_arr'];

	/* Admin area customisations ========================================================================== */ 
	// Admin custom footer text
	$admin_footer_text  = $options['admin_footer_text'];
	// Remove WP icon from admin bar
	$remove_admin_bar_icon = $options['remove_admin_bar_icon'];

	// Menu items to be hidden
	$menu_items = (isset($options['admin_menu_items'])) ? wp_parse_args($options['admin_menu_items'], $menu) : $menu ;
	$all_menu_items = array();
	foreach($menu_items as $menu_item_key => $menu_item_val){
		if(isset($menu_item_val[0])){
			$all_menu_items[$menu_item_key] = $menu_item_val;
			$all_menu_items[$menu_item_key]['hidden'] = (isset($menu_items[$menu_item_key]['hidden'])) ? 1 : 0;
		}
	}

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">

	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

	<div id="clean-up" class="wrap metabox-holder columns-2 studio_manager-metaboxes">

		<form method="post" name="cleanup_options" action="options.php">

			<?php
				settings_fields( $this->plugin_name );
				do_settings_sections( $this->plugin_name );
			?>

			<!-- Clean Ups -->
			<div class="section-wrapper">
				<h2 class="section-title"><?php _e('Clean Up', $this->plugin_name);?></h2>

				<!-- remove some meta and generators from the <head> -->
				<fieldset>
					<legend class="screen-reader-text"><span><?php _e('Clean WordPress head section', $this->plugin_name);?></span></legend>
					<label for="<?php echo $this->plugin_name;?>-cleanup">
					<input type="checkbox" id="<?php echo $this->plugin_name;?>-cleanup" name="<?php echo $this->plugin_name;?>[cleanup]" value="1" <?php checked( $cleanup, 1 ); ?> />
					<span><?php esc_attr_e( 'Clean up the head section', $this->plugin_name ); ?></span>
					</label>
				</fieldset>


				<!-- add post,page or product slug class to body class -->
				<fieldset>
					<legend class="screen-reader-text"><span><?php _e('Add Post, page or product slug to body class', $this->plugin_name);?></span></legend>
					<label for="<?php echo $this->plugin_name;?>-body_class_slug">
					<input type="checkbox" id="<?php echo $this->plugin_name;?>-body_class_slug" name="<?php echo $this->plugin_name;?>[body_class_slug]" value="1" <?php checked( $body_class_slug, 1 ); ?>  />
					<span><?php esc_attr_e('Add Post slug to body class', $this->plugin_name);?></span>
					</label>
				</fieldset>


				<!-- Prettify Search URL -->
				<fieldset>
					<legend class="screen-reader-text"><span><?php _e('Prettify Search URL - http://yourwebsite/search/search_terms/', $this->plugin_name);?></span></legend>
					<label for="<?php echo $this->plugin_name;?>-prettify_search">
						<input type="checkbox" id="<?php echo $this->plugin_name;?>-prettify_search" name="<?php echo $this->plugin_name;?>[prettify_search]" value="1" <?php checked($prettify_search, 1);?>/>
						<span><?php esc_attr_e('Prettify Search URL (eg: http://yourwebsite/search/search_terms/)', $this->plugin_name);?></span>
					</label>
				</fieldset>


				<!-- Hide Admin Bar -->
				<fieldset>
					<legend class="screen-reader-text"><span><?php _e('Hide Admin Bar on the Front-end', $this->plugin_name);?></span></legend>
					<label for="<?php echo $this->plugin_name;?>-hide_admin_bar">
						<input type="checkbox" id="<?php echo $this->plugin_name;?>-hide_admin_bar" name="<?php echo $this->plugin_name;?>[hide_admin_bar]" value="1" <?php checked( $hide_admin_bar, 1);?>/>
						<span><?php esc_attr_e('Hide Admin Bar', $this->plugin_name);?></span>
					</label>
				</fieldset>


				<!-- remove css and js query string versions -->
				<fieldset>
					<legend class="screen-reader-text"><span><?php _e('Remove CSS and JS files query string versions', $this->plugin_name);?></span></legend>
					<label for="<?php echo $this->plugin_name;?>-css_js_versions">
						<input type="checkbox" id="<?php echo $this->plugin_name;?>-css_js_versions" name="<?php echo $this->plugin_name;?>[css_js_versions]" value="1" <?php checked($css_js_versions, 1);?>/>
						<span><?php esc_attr_e('Remove CSS and JS versions (uncheck for dev)', $this->plugin_name);?></span>
					</label>
				</fieldset>
			</div>


			<!-- Login page customizations -->
			<div class="section-wrapper">
				<h2 class="section-title"><?php _e('Login customization', $this->plugin_name);?></h2>

				<!-- Add client logo to login -->
				<fieldset>
					<h3 class="section-subheading"><?php _e('Add logo to login form', $this->plugin_name);?></h3>
					<legend class="screen-reader-text"><span><?php esc_attr_e('Login Logo', $this->plugin_name);?></span></legend>
					<label for="<?php echo $this->plugin_name;?>-login_logo">
					<input type="hidden" id="login_logo_id" name="<?php echo $this->plugin_name;?>[login_logo_id]" value="<?php echo $login_logo_id; ?>" />
					<input id="upload_login_logo_button" type="button" class="button" value="<?php _e( 'Upload Logo', $this->plugin_name); ?>" />
					<span><?php esc_attr_e('Login Logo', $this->plugin_name);?></span>
					</label>
					<div id="upload_logo_preview" class="studio-manager-upload-preview <?php if(empty($login_logo_id)) echo 'hidden'?>">
						<img src="<?php echo $login_logo_url; ?>" />
						<button id="studio-manager-delete_logo_button" class="studio-manager-delete-image">X</button>
					</div>
				</fieldset>
	        </div>

		    
			<!-- Custom Image Sizes -->
			<div class="section-wrapper">
				<h2 class="section-title"><?php _e('Custom Image Sizes', $this->plugin_name);?></h2>

				<?php global $_wp_additional_image_sizes;
					$img_sizes = get_intermediate_image_sizes();
					$new_images_size_position = count($_wp_additional_image_sizes);
				?>

				<!-- Add images sizes -->
				<fieldset>
					<h3 class="section-subheading"><?php _e('Add custom image sizes for media images', $this->plugin_name);?></h3>

					<legend class="screen-reader-text"><span><?php _e('Add New Image sizes', $this->plugin_name);?></span></legend>
					<label for="<?php echo $this->plugin_name;?>-new_images_size">
						<input type="checkbox" id="<?php echo $this->plugin_name;?>-new_images_size" class="show-child-if-checked" name="<?php echo $this->plugin_name;?>[new_images_size]" value="1" <?php checked($new_images_size, 1);?>/>
						<span><?php esc_attr_e('Add New Image size', $this->plugin_name);?></span>
					</label>

					<fieldset class="new-images-size <?php if($new_images_size != '1') echo 'hidden'; ?>">
						<label for="<?php echo $this->plugin_name;?>-new_images_size_name">
							<span><?php esc_attr_e('New Images size name', $this->plugin_name);?></span>
						</label>
						<input id="<?php echo $this->plugin_name;?>-new_images_size_name" name="<?php echo $this->plugin_name;?>[images_size][name]" type="text" placeholder="ex: blog_featured">

						<br/>

						<label for="t<?php echo $this->plugin_name;?>-new_images_size_w">Width</label>
						<input name="<?php echo $this->plugin_name;?>[images_size][width]" type="number" step="1" min="0" id="<?php echo $this->plugin_name;?>-new_images_size_w" placeholder="500" class="small-text">
						<label for="<?php echo $this->plugin_name;?>-new_images_size_h">Height</label>
						<input name="<?php echo $this->plugin_name;?>[images_size][height]" type="number" step="1" min="0" id="<?php echo $this->plugin_name;?>-new_images_size_h" placeholder="300"  class="small-text">
						
						<br>

						<label for="<?php echo $this->plugin_name;?>-new_images_size_crop"><span><?php esc_attr_e('Hard-Crop images',  $this->plugin_name);?></span>
						</label>
						<input name="<?php echo $this->plugin_name;?>[images_size][crop]" type="checkbox" id="<?php echo $this->plugin_name;?>-new_images_size_crop" class="new-images-size-crop">

						<br>

						<div class="new-hard-crop-positions hidden">
							<span>Horizontal</span>
							<br>
							<fieldset>
								<legend class="screen-reader-text"><span>input type="radio"</span></legend>
								<label title='g:i a'>
								<input type="radio" name="<?php echo $this->plugin_name;?>[images_size][crop_horizontal]" value="left" id="<?php echo $this->plugin_name;?>-new_images_size_crop_left" />
								<span><?php esc_attr_e('Left',  $this->plugin_name);?></span>
								</label>
								<br>

								<label title='g:i a'>
								<input type="radio" name="<?php echo $this->plugin_name;?>[images_size][crop_horizontal]" value="center" id="<?php echo $this->plugin_name;?>-new_images_size_crop_hcenter" />
								<span><?php esc_attr_e('Center',  $this->plugin_name);?></span>
								</label>
								<br>

								<label title='g:i a'>
								<input type="radio" name="<?php echo $this->plugin_name;?>[images_size][crop_horizontal]" value="right" id="<?php echo $this->plugin_name;?>-new_images_size_crop_right" />
								<span><?php esc_attr_e('Right',  $this->plugin_name);?></span>
								</label>
							</fieldset>
							
							<br>
							<span>Vertical</span>
							<br>
							<fieldset>
								<legend class="screen-reader-text"><span>input type="radio"</span></legend>
								<label title='g:i a'>
								<input type="radio" name="<?php echo $this->plugin_name;?>[images_size][crop_vertical]" value="top" id="<?php echo $this->plugin_name;?>-new_images_size_crop_top" />
								<span><?php esc_attr_e('Top',  $this->plugin_name);?></span>
								</label>
								<br>

								<label title='g:i a'>
								<input type="radio" name="<?php echo $this->plugin_name;?>[images_size][crop_vertical]" value="center" id="<?php echo $this->plugin_name;?>-new_images_size_crop_vcenter" />
								<span><?php esc_attr_e('Center',  $this->plugin_name);?></span>
								</label>
								<br>

								<label title='g:i a'>
								<input type="radio" name="<?php echo $this->plugin_name;?>[images_size][crop_vertical]" value="bottom" id="<?php echo $this->plugin_name;?>-new_images_size_crop_bottom" />
								<span><?php esc_attr_e('Bottom',  $this->plugin_name);?></span>
								</label>
							</fieldset>
						</div>
							
					</fieldset>

					<fieldset class="existing-images-size-container <?php if($new_images_size_position < 2) echo 'hidden'; ?>">
						<h4 class="action-subheading"><?php _e('Already Existing Custom Images sizes', $this->plugin_name);?></h4>
						<?php
							if(is_array($images_size_arr)):
								foreach ($images_size_arr as $existing_images_size_name => $existing_images_size_values) :?>
							
								<?php
									if($existing_images_size_name != 'post-thumbnail'):?>
										<fieldset class="existing-images-size">
											<h4><?php echo $existing_images_size_name;?></h4>

											<label for="<?php echo $this->plugin_name;?>-<?php echo $existing_images_size_name;?>_w">Width</label>
											<input name="<?php echo $this->plugin_name;?>[existing_images_size][<?php echo $existing_images_size_name;?>][name]" type="hidden" value="<?php echo $existing_images_size_values['name'];?>" >
											<input name="<?php echo $this->plugin_name;?>[existing_images_size][<?php echo $existing_images_size_name;?>][width]" type="number" step="1" min="0" id="<?php echo $this->plugin_name;?>-<?php echo $existing_images_size_name;?>_w" value="<?php echo $existing_images_size_values['width'];?>" class="small-text" >

											<label for="<?php echo $this->plugin_name;?>-<?php echo $existing_images_size_name;?>_h">Height</label>
											<input name="<?php echo $this->plugin_name;?>[existing_images_size][<?php echo $existing_images_size_name;?>][height]" type="number" step="1" min="0" id="<?php echo $this->plugin_name;?>-<?php echo $existing_images_size_name;?>_h" value="<?php echo $existing_images_size_values['height'];?>" class="small-text">
											<!-- <br>
											<label for="<?php echo $this->plugin_name;?>-<?php echo $existing_images_size_name;?>_crop">
											<input name="<?php echo $this->plugin_name;?>[existing_images_size][<?php echo $existing_images_size_name;?>][crop]" type="checkbox" id="<?php echo $this->plugin_name;?>-<?php echo $existing_images_size_name;?>_crop" <?php checked($existing_images_size_values['crop'], 2);?> >
											<span><?php esc_attr_e('Hard-Crop images',  $this->plugin_name);?></span> -->
						
											<br>

											<label for="<?php echo $this->plugin_name;?>-<?php echo $existing_images_size_name;?>_crop">
												<span><?php esc_attr_e('Hard-Crop images',  $this->plugin_name);?></span>
											</label>
											<input name="<?php echo $this->plugin_name;?>[existing_images_size][<?php echo $existing_images_size_name;?>][crop]" type="checkbox" id="<?php echo $this->plugin_name;?>-<?php echo $existing_images_size_name;?>_crop"  class="existing-images-size-crop" <?php checked($existing_images_size_values['crop'], 2);?>>

											<br>

											<!-- Cropping Options -->
											<div class="existing-hard-crop-positions hidden">
												<span>Horizontal</span>
												<br>
												<fieldset>
													<legend class="screen-reader-text"><span>input type="radio"</span></legend>
													<label title='g:i a'>
													<input type="radio" name="<?php echo $this->plugin_name;?>[existing_images_size][<?php echo $existing_images_size_name;?>][crop_horizontal]" value="left" id="<?php echo $this->plugin_name;?>-new_images_size_crop_left" />
													<span><?php esc_attr_e('Left',  $this->plugin_name);?></span>
													</label>
													<br>

													<label title='g:i a'>
													<input type="radio" name="<?php echo $this->plugin_name;?>[existing_images_size][<?php echo $existing_images_size_name;?>][crop_horizontal]" value="center" id="<?php echo $this->plugin_name;?>-new_images_size_crop_hcenter" />
													<span><?php esc_attr_e('Center',  $this->plugin_name);?></span>
													</label>
													<br>

													<label title='g:i a'>
													<input type="radio" name="<?php echo $this->plugin_name;?>[existing_images_size][<?php echo $existing_images_size_name;?>][crop_horizontal]" value="right" id="<?php echo $this->plugin_name;?>-new_images_size_crop_right" />
													<span><?php esc_attr_e('Right',  $this->plugin_name);?></span>
													</label>
												</fieldset>
												
												<br>
												<span>Vertical</span>
												<br>
												<fieldset>
													<legend class="screen-reader-text"><span>input type="radio"</span></legend>
													<label title='g:i a'>
													<input type="radio" name="<?php echo $this->plugin_name;?>[existing_images_size][<?php echo $existing_images_size_name;?>][crop_vertical]" value="top" id="<?php echo $this->plugin_name;?>-new_images_size_crop_top" />
													<span><?php esc_attr_e('Top',  $this->plugin_name);?></span>
													</label>
													<br>

													<label title='g:i a'>
													<input type="radio" name="<?php echo $this->plugin_name;?>[existing_images_size][<?php echo $existing_images_size_name;?>][crop_vertical]" value="center" id="<?php echo $this->plugin_name;?>-new_images_size_crop_vcenter" />
													<span><?php esc_attr_e('Center',  $this->plugin_name);?></span>
													</label>
													<br>

													<label title='g:i a'>
													<input type="radio" name="<?php echo $this->plugin_name;?>[existing_images_size][<?php echo $existing_images_size_name;?>][crop_vertical]" value="bottom" id="<?php echo $this->plugin_name;?>-new_images_size_crop_bottom" />
													<span><?php esc_attr_e('Bottom',  $this->plugin_name);?></span>
													</label>
												</fieldset>
											</div>
											<!-- End of Cropping Options -->

											</label>
										</fieldset>
									<?php endif;?>
								<?php endforeach;?>
							<?php endif;?>
					</fieldset>
				</fieldset>
			</div>

		    
			<!-- Admin Customisations -->
			<div class="section-wrapper">
				<h2 class="section-title"><?php _e('Admin Customisations', $this->plugin_name);?></h2>

				<!-- Hide WordPress admin menu items -->
				<fieldset class="studio_manager-admin-menu-items">
					<legend class="screen-reader-text"><span><?php _e('Hide Admin menu items for editors', $this->plugin_name);?></span></legend>
					<h3 class="section-subheading"><?php esc_attr_e('Hide Admin menu items for editors', $this->plugin_name);?></h3>
					<?php
						foreach($all_menu_items as $menu_key => $menu_value):
							if($menu_value[0]):
								$re = "/(<span.*<\\/span>)/mi"; 
								$menu_label = preg_replace($re, '', $menu_value[0]);
								$menu_slug = $menu_value[2];
								$menu_arr = esc_html(serialize($menu_value));
								//$menu_arr = esc_html(json_encode($menu_value));
								?>
								<label for="<?php echo $this->plugin_name;?>-admin_menu_items_<?php echo $menu_slug;?>">
								<input type="checkbox" id="<?php echo $this->plugin_name;?>-admin_menu_items_<?php echo $menu_slug;?>" name="<?php echo $this->plugin_name;?>[admin_menu_items][<?php echo $menu_key; ?>]" value="1" <?php checked($menu_value['hidden'], 1);?>/>

								<input type="hidden" name="<?php echo $this->plugin_name;?>[admin_menu_items_val][<?php echo $menu_key; ?>]" value='<?php echo $menu_arr?>' >
								
								<span><?php esc_attr_e("Hide ".$menu_label." menu item", $this->plugin_name);?></span>
								</label>
								<br/>
								<?php
							endif;
						endforeach;
					?>
				</fieldset>


				<!-- Remove wp icon from admin bar -->
				<fieldset>
					<legend class="screen-reader-text"><span><?php _e('Remove WordPress Icon from admin bar', $this->plugin_name);?></span></legend>
					<h3 class="section-subheading"><?php esc_attr_e('Remove WordPress Icon from admin bar', $this->plugin_name);?></h3>
					<label for="<?php echo $this->plugin_name;?>-remove_admin_bar_icon">
						<input type="checkbox" id="<?php echo $this->plugin_name;?>-remove_admin_bar_icon" name="<?php echo $this->plugin_name;?>[remove_admin_bar_icon]" value="1" <?php checked($remove_admin_bar_icon, 1);?>/>
						<span><?php esc_attr_e('Remove WordPress Icon', $this->plugin_name);?></span>
					</label>
				</fieldset>


				<!-- Change WordPress admin footer text -->
				<fieldset>
					<legend class="screen-reader-text"><span><?php _e('Change Admin footer text with your own', $this->plugin_name);?></span></legend>
					<h3 class="section-subheading"><?php esc_attr_e('Change Admin footer text with your own', $this->plugin_name);?></h3>
					<input type="text" class="regular-text" id="<?php echo $this->plugin_name;?>-admin_footer_text" name="<?php echo $this->plugin_name;?>[admin_footer_text]" value="<?php if(!empty($admin_footer_text)) esc_attr_e($admin_footer_text, $this->plugin_name);?>" placeholder="<?php esc_attr_e('Theme created for your awesome business', $this->plugin_name);?>" />
				</fieldset>
			</div>


			<?php submit_button(__('Save all changes', $this->plugin_name), 'primary','submit', TRUE); ?>

		</form>

	</div>

</div>