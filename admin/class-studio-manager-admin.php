<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://murraycreative.ie
 * @since      1.0.0
 *
 * @package    Studio_Manager
 * @subpackage Studio_Manager/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Studio_Manager
 * @subpackage Studio_Manager/admin
 * @author     Murray Creative <studio.manager@murraygroup.ie>
 */
class Studio_Manager_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->studio_manager_options = get_option($this->plugin_name);

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Studio_Manager_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Studio_Manager_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/studio-manager-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Studio_Manager_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Studio_Manager_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/studio-manager-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	* Register the administration menu for this plugin into the WordPress Dashboard menu.
	*
	* @since    1.0.0
	*/
	public function add_plugin_admin_menu() {

		/*
		* Add a settings page for this plugin to the Settings menu.
		*
		*/
		add_options_page( 'Studio Manager Setup', 'Studio Manager', 'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page') );

	}

	/**
	* Add settings action link to the plugins page.
	*
	* @since    1.0.0
	*/
	public function add_action_links( $links ) {

		/*
		*  Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
		*/
		$settings_link = array(
			'<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',
		);

		return array_merge(  $settings_link, $links );

	}

	/**
	* Render the settings page for this plugin.
	*
	* @since    1.0.0
	*/
	public function display_plugin_setup_page() {
		include_once( 'partials/studio-manager-admin-display.php' );
	}

	/**
	*
	* admin/class-wp-cbf-admin.php
	*
	**/
	public function options_update() {
		register_setting($this->plugin_name, $this->plugin_name, array($this, 'validate'));
	}

	/**
	*
	* admin/class-wp-cbf-admin.php
	*
	**/


	/*  ==========================================================================
		 Validate all options before saving
		========================================================================== */
	public function validate($input) {
		// All checkboxes inputs        
		$valid = array();

		// Clean-up Options
		// Remove some meta and generators from the <head>
		$valid['cleanup'] = (isset($input['cleanup']) && !empty($input['cleanup'])) ? 1 : 0;

		// Add post, page or product slug class to body class
		$valid['body_class_slug'] = (isset($input['body_class_slug']) && !empty($input['body_class_slug'])) ? 1 : 0;

		// Hide Admin Bar
		$valid['hide_admin_bar'] = (isset($input['hide_admin_bar']) && !empty($input['hide_admin_bar'])) ? 1 : 0;

		// Prettify Search URL
		$valid['prettify_search'] = (isset($input['prettify_search']) && !empty($input['prettify_search'])) ? 1 : 0;

		// Remove css and js query string versions
		$valid['css_js_versions'] = (isset($input['css_js_versions']) && !empty($input['css_js_versions'])) ? 1 : 0;

		// Add client logo to login
		$valid['login_logo_id'] = (isset($input['login_logo_id']) && !empty($input['login_logo_id'])) ? absint($input['login_logo_id']) : 0;


		// Custom Image Sizes
		if(isset($input['existing_images_size']) && is_array($input['existing_images_size'])) {
			// Get all existing custom image sizes
			$existing_images_sizes = $input['existing_images_size'];
			// Loop through existing custom image sizes
			foreach($existing_images_sizes as $existing_images_size_name => $existing_images_size_value):
				// Check cropping setting on each image size
				// $existing_images_sizes[$existing_images_size_name]['crop'] = (isset($existing_images_size_value['crop'])) ? 1 : 0;

				// Check if images should be cropped
				if(!isset($existing_images_sizes[$existing_images_size_name]['crop'])){
					$existing_images_sizes[$existing_images_size_name]['crop'] = 0;
				} else if(isset($existing_images_sizes[$existing_images_size_name]['crop'])){
					// Check that the horizontal crop value is not empty, if it is send an error
					if(empty($existing_images_sizes[$existing_images_size_name]['crop'][0])){
						add_settings_error(
							'new_images_size_crop_horizontal_error', // Setting title
							'new_images_size_crop_horizontal_error_texterror', // Error ID
							__('Please choose a horizontal crop option for '.$existing_images_size_name.' image sizes', $this->plugin_name),     // Error message
							'error' // Type of message
						);
					}
					// Check that the vertical crop value is not empty, if it is send an error
					if(empty($existing_images_sizes[$existing_images_size_name]['crop'][1])){
						add_settings_error(
							'new_images_size_crop_vertical_error', // Setting title
							'new_images_size_crop_vertical_error_texterror', // Error ID
							__('Please choose a vertical crop option for '.$existing_images_size_name.' image sizes', $this->plugin_name),     // Error message
							'error' // Type of message
						);
					}
					// If both the horizontal and vertical values are set, pass them to the crop array
					if(isset($existing_images_sizes[$existing_images_size_name]['crop'][0]) && isset($existing_images_sizes[$existing_images_size_name]['crop'][1])){
						$existing_images_sizes[$existing_images_size_name]['crop'] = array($existing_images_sizes[$existing_images_size_name]['crop_horizontal'], $existing_images_sizes[$existing_images_size_name]['crop_vertical']);
					}
				}

			endforeach;
		}else{
			// Define the array for already existing image sizes
			$existing_images_sizes = array();
		}

		// Define the new image sizes array
		$new_images_size = array();

		// If there are new image sizes defined
		if(isset( $input['new_images_size']) &&  !empty($input['new_images_size']) ){
			// Get image size slug
			$images_size_slug = sanitize_title($input['images_size']['name']);
			// Get image size name
			$images_size_name = sanitize_text_field($input['images_size']['name']);
			// Return error if no slug present
			if(empty($images_size_slug)){
				add_settings_error(
					'new_images_size_error',                     // Setting title
					'new_images_size_error_texterror',            // Error ID
					__('Please enter a new image size name', $this->plugin_name),    // Error message
					'error'                         // Type of message
				);
			}else{
				// Set new size name
				$new_images_size[$images_size_slug]['name'] = $images_size_name;
				// Set new size width
				$new_images_size[$images_size_slug]['width'] = sanitize_text_field($input['images_size']['width']);
				// Return error if no width present
				if(empty($new_images_size[$images_size_slug]['width'])){
					add_settings_error(
						'new_images_size_width_error',                     // Setting title
						'new_images_size_width_error_texterror',            // Error ID
						__('Please enter a width to '.$images_size_name.' image size', $this->plugin_name),    // Error message
						'error'                         // Type of message
					);
				}

				// Set new size height
				$new_images_size[$images_size_slug]['height'] = sanitize_text_field($input['images_size']['height']);
				// Return error if no height present
				if(empty($new_images_size[$images_size_slug]['height'])){
					add_settings_error(
						'new_images_size_heigth_error',                     // Setting title
						'new_images_size_heigth_error_texterror',            // Error ID
						__('Please enter a height to '.$images_size_name.' image sizes', $this->plugin_name),     // Error message
						'error'                         // Type of message
					);
				}

				// Check if images should be cropped
				// $new_images_size[$images_size_slug]['crop'] = (isset($input['images_size']['crop'])) ? 1 : 0;
				if(!isset($input['images_size']['crop'])){
					$new_images_size[$images_size_slug]['crop'] = 0;
				} else if(isset($input['images_size']['crop'])){
					if(empty($input['images_size']['crop_horizontal'])){
						add_settings_error(
							'new_images_size_crop_horizontal_error', // Setting title
							'new_images_size_crop_horizontal_error_texterror', // Error ID
							__('Please choose a horizontal crop option for '.$images_size_name.' image sizes', $this->plugin_name),     // Error message
							'error' // Type of message
						);
					}
					if(empty($input['images_size']['crop_vertical'])){
						add_settings_error(
							'new_images_size_crop_vertical_error', // Setting title
							'new_images_size_crop_vertical_error_texterror', // Error ID
							__('Please choose a vertical crop option for '.$images_size_name.' image sizes', $this->plugin_name),     // Error message
							'error' // Type of message
						);
					}
					if(isset($input['images_size']['crop_horizontal']) && isset($input['images_size']['crop_vertical'])){
						$new_images_size[$images_size_slug]['crop'] = array($input['images_size']['crop_horizontal'], $input['images_size']['crop_vertical']);
					}
				}

			}
		}
		// If all image size details are present for new image size, add it to the array
		if(!empty($images_size_slug) && !empty($new_images_size[$images_size_slug]['width']) && !empty($new_images_size[$images_size_slug]['height']) && !empty($new_images_size[$images_size_slug]['crop'])){

			// if($new_images_size[$images_size_slug]['crop'] == 0){
			// 	$valid['images_size_arr'] = array_merge($existing_images_sizes, $new_images_size);
			// } else if($new_images_size[$images_size_slug]['crop'] == 1){
			// 	if(isset($input['images_size']['crop_horizontal']) && isset($input['images_size']['crop_vertical'])){
			// 		$valid['images_size_arr'] = array_merge($existing_images_sizes, $new_images_size);
			// 	}
			// }

			$valid['images_size_arr'] = array_merge($existing_images_sizes, $new_images_size);

		}else{
			// Validate the existing custom image sizes
			$valid['images_size_arr'] = $existing_images_sizes;
		}

        // Admin Customisations
        // Change WordPress admin footer text
        $valid['admin_footer_text'] = (isset($input['admin_footer_text']) && !empty($input['admin_footer_text'])) ? wp_kses($input['admin_footer_text'], array('a' => array( 'href' => array(), 'title' => array()))) : '';

        // Remove wp icon from admin bar
        $valid['remove_admin_bar_icon'] = (isset($input['remove_admin_bar_icon']) && !empty($input['remove_admin_bar_icon'])) ? 1 : 0;

        // Hide WordPress admin menu items
        // Use the $menu global variable to access the WordPress admin left-side menus
		global $menu;
		// Define the array of menu items
		$menu_item_arr = array();

		// If there are menu items present
		if(isset($input['admin_menu_items'])):
			// Loop through the menu items
			foreach($input['admin_menu_items'] as $menu_item_key => $menu_item_val){

				// Set the menu item keys in the menu items array
				$menu_item_arr[$menu_item_key] = (isset($input['admin_menu_items_val'])) ? unserialize($input['admin_menu_items_val'][$menu_item_key]) : $menu[$menu_item_key];
				$menu_item_arr[$menu_item_key]['hidden'] = ($input['admin_menu_items'][$menu_item_key] == 1) ? 1 : 0; 
			}
			// Add the menu items array to $valid
			$valid['admin_menu_items'] = $menu_item_arr;
		else:
			// Set $valid as new empty array
			$valid['admin_menu_items'] = array();
		endif;

		// Return
		return $valid;
	}

    /**
     * Login page customizations Functions
     *
     * @since    1.0.0
     */
	/*  ==========================================================================
		 Get new logo for WordPress login page
		========================================================================== */
	private function studio_manager_login_logo_css() {

		// If the login_logo_id is present and not empty
		if(isset($this->studio_manager_options['login_logo_id']) && !empty($this->studio_manager_options['login_logo_id'])){
			// Get the new logo
			$login_logo = wp_get_attachment_image_src($this->studio_manager_options['login_logo_id'], 'thumbnail');
			// Get the logo URL
			$login_logo_url = $login_logo[0];
			// Set the CSS for the new logo
			$login_logo_css  = "body.login h1 a {background-image: url(".$login_logo_url."); width:100px; height:100px; background-size: contain;}";
			// Return the logo CSS
			return $login_logo_css;
		}

	}


	/*  ==========================================================================
		 Write the css for login customizations
		========================================================================== */
     public function studio_manager_login_css() {

		// If the login_logo_id is present
		if( !empty($this->studio_manager_options['login_logo_id']) ){
			// Output the style
			echo '<style>';
			if( !empty($this->studio_manager_options['login_logo_id'])){
				echo $this->studio_manager_login_logo_css();
			}
			echo '</style>';
		}

     }

    /**
     * Admin customizations Functions
     *
     * @since    1.0.0
     */
	/*  ==========================================================================
		 Change the WordPress footer text to custom text
		========================================================================== */
	public function studio_manager_admin_footer_text($footer_text) {

		// If there is custom footer text present
		if(!empty($this->studio_manager_options['admin_footer_text'])){
			// Get the custom footer text
			$footer_text = $this->studio_manager_options['admin_footer_text'];
		}
		// Return the footer text
		return $footer_text;

	}


	/*  ==========================================================================
		 Remove the WordPress icon from the Admin bar
		========================================================================== */
	public function studio_manager_remove_wp_icon_from_admin_bar() {

		// If the option is set to remove the icon
		if(!empty($this->studio_manager_options['remove_admin_bar_icon'])){
			// Use the global $wp_admin_bar
			global $wp_admin_bar;
			// Remove the icon
			$wp_admin_bar->remove_menu('wp-logo');
		}

	}

	/*  ==========================================================================
		 Hide selected admin menu items
		========================================================================== */
	public function studio_manager_hide_admin_menu_items() {

		// If the menu items option is set
		if(isset($this->studio_manager_options['admin_menu_items'])){
			// Loop through the menu items in the array
			foreach($this->studio_manager_options['admin_menu_items'] as $menu_item_key => $menu_item_value){
				// If the admin_menu_items key is set
				if(isset($this->studio_manager_options['admin_menu_items'][$menu_item_key][2])){
					// If the user is not an administrator
					// if ( !current_user_can( 'edit_theme_options' ) ) {
						// Remove the menu item
						remove_menu_page( $this->studio_manager_options['admin_menu_items'][$menu_item_key][2] );
					// }
				}
			}
		}

	}


}
