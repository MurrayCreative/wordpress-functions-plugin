<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://murraycreative.ie
 * @since      1.0.0
 *
 * @package    Studio_Manager
 * @subpackage Studio_Manager/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Studio_Manager
 * @subpackage Studio_Manager/includes
 * @author     Murray Creative <studio.manager@murraygroup.ie>
 */
class Studio_Manager {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Studio_Manager_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'studio-manager';
		$this->version = '1.0.0';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Studio_Manager_Loader. Orchestrates the hooks of the plugin.
	 * - Studio_Manager_i18n. Defines internationalization functionality.
	 * - Studio_Manager_Admin. Defines all hooks for the admin area.
	 * - Studio_Manager_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-studio-manager-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-studio-manager-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-studio-manager-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-studio-manager-public.php';

		$this->loader = new Studio_Manager_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Studio_Manager_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Studio_Manager_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Studio_Manager_Admin( $this->get_plugin_name(), $this->get_version() );

		// Enqueue CSS and JS for the wp-admin area
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		
		// Add menu item
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'add_plugin_admin_menu' );

		// Add Settings link to the plugin
		$plugin_basename = plugin_basename( plugin_dir_path( __DIR__ ) . $this->plugin_name . '.php' );
		$this->loader->add_filter( 'plugin_action_links_' . $plugin_basename, $plugin_admin, 'add_action_links' );

        // Admin Customizations
        // Set admin custom footer text
		$this->loader->add_filter( 'admin_footer_text', $plugin_admin, 'studio_manager_admin_footer_text');
		// Remove WP icon from admin bar if option is set
		$this->loader->add_filter( 'wp_before_admin_bar_render', $plugin_admin, 'studio_manager_remove_wp_icon_from_admin_bar');
		// Hide specified admin menu items
		$this->loader->add_action('admin_menu', $plugin_admin, 'studio_manager_hide_admin_menu_items');
		// Load the admin CSS
		$this->loader->add_action( 'login_enqueue_scripts', $plugin_admin, 'studio_manager_admin_css' );
		// Link the logo on the login page to the homepage
		$this->loader->add_action( 'login_headerurl', $plugin_admin, 'studio_manager_login_logo_link' );
		// Change the title on the login page logo to Blog Title
		$this->loader->add_action( 'login_headertitle', $plugin_admin, 'studio_manager_login_logo_headertitle' );

		// Save / Update our plugin options
		$this->loader->add_action( 'admin_init', $plugin_admin, 'options_update' );
		// $this->loader->add_action( 'admin_init', $plugin_admin, 'studio_manager_admin_scripts' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Studio_Manager_Public( $this->get_plugin_name(), $this->get_version() );

		// $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		// $this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		// Below are our "public" frontend related actions and filters hooks

		// Run the plugin on wp-admin init
		$this->loader->add_action( 'init', $plugin_public, 'studio_manager' );
		
		// Cleanup - Actions and filters
		// Actions
		// Prettify URL of search page
		$this->loader->add_action( 'template_redirect', $plugin_public, 'studio_manager_prettify_search_redirect' );
		// Remove WP admin bar
		$this->loader->add_action( 'after_setup_theme', $plugin_public, 'studio_manager_remove_admin_bar');
		// Remove version numbers from CSS and JS files
		$this->loader->add_action( 'after_setup_theme', $plugin_public, 'studio_manager_remove_cssjs_ver');

		// Filters
		// Remove pingbacks
		$this->loader->add_filter( 'wp_headers', $plugin_public, 'studio_manager_remove_x_pingback' );
		// Add post, page or product slug class to body class
		$this->loader->add_filter( 'body_class', $plugin_public, 'studio_manager_body_class_slug' );

		// Images
		// Actions
		// Add custom image sizes
		$this->loader->add_action( 'after_setup_theme', $plugin_public, 'studio_manager_add_images_size' );

		// Filters
		// Remove default image sizes
		$this->loader->add_filter( 'after_setup_theme', $plugin_public, 'studio_manager_remove_default_image_sizes' );
		// Remove thumbnail dimensions
		$this->loader->add_filter( 'post_thumbnail_html', $plugin_public, 'studio_manager_remove_thumbnail_dimensions' );
		$this->loader->add_filter( 'image_send_to_editor', $plugin_public, 'studio_manager_remove_thumbnail_dimensions' );
		// Custom JPEG output quality
		$this->loader->add_filter( 'jpeg_quality', $plugin_public, 'studio_manager_custom_jpeg_quality' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Studio_Manager_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
