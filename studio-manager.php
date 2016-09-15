<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://murraycreative.ie
 * @since             1.0.0
 * @package           Studio_Manager
 *
 * @wordpress-plugin
 * Plugin Name:       Studio Manager
 * Plugin URI:        https://bitbucket.org/refreshdev/studio-manager-plugin
 * Description:       This is a settings page that can be used to configure some common functionality for your WordPress site.
 * Version:           1.0.0
 * Author:            Murray Creative
 * Author URI:        http://murraycreative.ie
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       studio-manager
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-studio-manager-activator.php
 */
function activate_studio_manager() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-studio-manager-activator.php';
	Studio_Manager_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-studio-manager-deactivator.php
 */
function deactivate_studio_manager() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-studio-manager-deactivator.php';
	Studio_Manager_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_studio_manager' );
register_deactivation_hook( __FILE__, 'deactivate_studio_manager' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-studio-manager.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_studio_manager() {

	$plugin = new Studio_Manager();
	$plugin->run();

}
run_studio_manager();
