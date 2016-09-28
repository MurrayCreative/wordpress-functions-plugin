<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://murraycreative.ie
 * @since      1.0.0
 *
 * @package    Studio_Manager
 * @subpackage Studio_Manager/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Studio_Manager
 * @subpackage Studio_Manager/public
 * @author     Murray Creative <studio.manager@murraygroup.ie>
 */
class Studio_Manager_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->studio_manager_options = get_option($this->plugin_name);

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/studio-manager-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/studio-manager-public.js', array( 'jquery' ), $this->version, false );

	}

    /**
     * Cleanup functions depending on each checkbox returned value in admin
     *
     * @since    1.0.0
     */
    // Cleanup head
    public function studio_manager() {

        if($this->studio_manager_options['cleanup']){

            remove_action( 'wp_head', 'rsd_link' ); // RSD link
            remove_action( 'wp_head', 'feed_links_extra', 3 ); // Category feed link
            remove_action( 'wp_head', 'feed_links', 2 ); // Post and comment feed links
            remove_action( 'wp_head', 'index_rel_link' );
            remove_action( 'wp_head', 'wlwmanifest_link' );
            remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // Parent rel link
            remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // Start post rel link
            remove_action( 'wp_head', 'rel_canonical', 10, 0 );
            remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
            remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); // Adjacent post rel link
            remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
            remove_action( 'wp_head', 'wp_generator' ); // WP Version
            remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
            remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
            remove_action( 'wp_print_styles', 'print_emoji_styles' );
            remove_action( 'admin_print_styles', 'print_emoji_styles' );

        }

    }   
    // Cleanup head
    public function studio_manager_remove_x_pingback($headers) {
        if(!empty($this->studio_manager_options['cleanup'])){
            unset($headers['X-Pingback']);
            return $headers;
        }
    }


    // Add post/page slug
    public function studio_manager_body_class_slug( $classes ) {
        if(!empty($this->studio_manager_options['body_class_slug'])){
            global $post;
            if(is_singular()){
                $classes[] = $post->post_name;
            }
        }
                return $classes;
    }

	// Prettify search
	public function studio_manager_prettify_search_redirect() {
		if(!empty($this->studio_manager_options['prettify_search'])){
			global $wp_rewrite;
			if ( !isset( $wp_rewrite ) || !is_object( $wp_rewrite ) || !$wp_rewrite->using_permalinks() ) return;

			$search_base = $wp_rewrite->search_base;
			if ( is_search() && !is_admin() && strpos( $_SERVER['REQUEST_URI'], "/{$search_base}/" ) === false ) {
				wp_redirect( home_url( "/{$search_base}/" . urlencode( get_query_var( 's' ) ) ) );
				exit();
			}
		}
	}

	// Remove  CSS and JS query strings versions
	public function studio_manager_remove_cssjs_ver( ) {
		if(!empty($this->studio_manager_options['css_js_versions'])){
			function studio_manager_remove_cssjs_ver_filter($src ){
				 if( strpos( $src, '?ver=' ) ) $src = remove_query_arg( 'ver', $src );
				 return $src;
			}
			add_filter( 'style_loader_src', 'studio_manager_remove_cssjs_ver_filter', 10, 2 );
			add_filter( 'script_loader_src', 'studio_manager_remove_cssjs_ver_filter', 10, 2 );
		}
	}

	// Hide Admin Bar
	public function studio_manager_remove_admin_bar(){
		if(!empty($this->studio_manager_options['hide_admin_bar'])){
			add_filter('show_admin_bar', '__return_false');
		}
	}


	// Remove default image sizes
	public function studio_manager_remove_default_image_sizes(){
		if(!empty($this->studio_manager_options['remove_default_image_sizes'])){
			function remove_default_image_sizes_filter($sizes) {
				unset( $sizes['thumbnail']);
				unset( $sizes['medium']);
				unset( $sizes['large']);
				return $sizes;
			}
			add_filter('intermediate_image_sizes_advanced', 'remove_default_image_sizes_filter');
		}
	}


	// Remove thumbnail dimensions
	public function studio_manager_remove_thumbnail_dimensions( $html ){
		if(!empty($this->studio_manager_options['remove_thumbnail_dimensions'])){
			$html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
			return $html;
		} else {
			return $html;
		}
	}


	// Add new images size
	public function studio_manager_add_images_size(){
		if(is_array($this->studio_manager_options['images_size_arr'])):
			foreach($this->studio_manager_options['images_size_arr'] as $images_size_name => $images_size):
				// Pass in the width value
				$images_size_w =  $images_size['width'];
				// Pass in the height value
				$images_size_h =  $images_size['height'];
				// If the crop value is not 0 or empty, set the crop values that were passed
				$images_size_c =  ($images_size['crop'] != 0) ? $images_size['crop'] : 0;
				// Add the image size with all values using the WordPress add_image_size function
				add_image_size( $images_size_name, $images_size_w, $images_size_h, $images_size_c );

			endforeach;
		endif;
	}

	// Add new image sizes to media size selection menu
	public function studio_manager_image_size_names_choose( $sizes ) {
		if(is_array($this->studio_manager_options['images_size_arr'])):
			foreach($this->studio_manager_options['images_size_arr'] as $images_size_name => $images_size):
				$sizes[$images_size_name] = $images_size['name'];
			endforeach;
		endif;
		return $sizes;
	}

}
