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
	 Global variables and Options
	========================================================================== */
	// Use the global $menu variable for the hide admin menu items
	global $menu;

	// Get all plugin options
	$options = get_option($this->plugin_name);

/*  ==========================================================================
	 Get all options into variables
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
	// Link login logo to homepage
	$login_logo_link = $options['login_logo_link'];

	/* Image sizes ========================================================================== */
	// Remove default image sizes
	$remove_default_image_sizes = $options['remove_default_image_sizes'];
	// Remove default image sizes
	$remove_thumbnail_dimensions = $options['remove_thumbnail_dimensions'];
	// Remove default image sizes
	$custom_jpeg_quality = $options['custom_jpeg_quality'];
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

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">

	<h1 class="plugin-title"><?php echo esc_html( get_admin_page_title() ); ?></h1>

	<div class="form-wrapper">

		<form method="post" name="cleanup_options" action="options.php">

			<?php
				// Set up hidden fields
				settings_fields( $this->plugin_name );
				do_settings_sections( $this->plugin_name );

				// Partial includes
				require_once('clean-up-settings.php');
				require_once('login-page-settings.php');
				require_once('custom-image-sizes-settings.php');
				require_once('admin-customization-settings.php');

				// Save All Changes button
				submit_button(__('Save All Changes', $this->plugin_name), 'primary','submit', TRUE);
			?>

		</form>

	</div>

</div>