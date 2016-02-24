<?php

/**
 * Rage
 */
class Rage_Core {

	public $theme_supports = [];

	public $sidebars = [];

	public $image_sizes = [];

	public $nav_menus = [];

	public $scripts = [];

	public $styles = [];

	/**
	 * Rage_Config constructor.
	 */
	private function __construct(){
		$this->init();
	}

	/**
	 * Singleton instance
	 *
	 * @return \Rage
	 */
	public static function get_instance(){
		static $rage = null;

		if ( is_null( $rage ) ){
			$rage = new self();
		}

		return $rage;
	}

	/**
	 * Hook up class with WordPress
	 */
	function init(){
		// assets
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );

		// structure
		add_action( 'after_setup_theme',  array( $this, 'register_nav_menus' ) );
		add_action( 'after_setup_theme',  array( $this, 'register_image_sizes' ) );
		add_action( 'after_setup_theme',  array( $this, 'register_theme_supports' ) );
		add_action( 'widgets_init',       array( $this, 'register_sidebars' ) );
	}

	/**
	 * Load the provided vendor libraries
	 *
	 * @param $includes
	 * @param null $dir
	 */
	function add_files( $includes, $dir = null ){
		if ( ! $dir ){
			$dir = get_stylesheet_directory() . '/includes';
		}

		foreach( $includes as $inc ){
			$file = trailingslashit( $dir ) . $inc;

			require $file;
		}
	}

	/**
	 * Add new theme supports
	 *
	 * @param $theme_supports
	 */
	function add_theme_supports( $theme_supports ){
		foreach( $theme_supports as $key => $support ){
			if ( is_numeric( $key ) ) {
				$this->theme_supports[] = $support;
			}
			else {
				$this->theme_supports[ $key ] = $support;
			}
		}
	}

	/**
	 * Add the registered theme supports
	 *
	 * @link https://codex.wordpress.org/Function_Reference/add_theme_support
	 */
	function register_theme_supports(){
		if ( !empty( $this->theme_supports ) ) {
			foreach ( $this->theme_supports as $key => $value ) {
				if ( is_string( $value ) ) {
					add_theme_support( $value );
				}
				else if ( is_array( $value ) ) {
					add_theme_support( $key, $value );
				}
			}
		}
	}

	/**
	 * Add an array of scripts to the queue
	 *
	 * @param $scripts
	 * @param null $handle_key
	 */
	function add_scripts( $scripts, $handle_key = null ){
		$scripts = $this->get_handle_array( $scripts, $handle_key );
		$this->scripts = array_replace( $this->scripts, $scripts );
	}

	/**
	 * Register then enqueue the scripts
	 *
	 * @link https://codex.wordpress.org/Function_Reference/wp_register_script
	 * @link https://codex.wordpress.org/Function_Reference/wp_enqueue_script
	 */
	function enqueue_scripts(){
		if ( !empty( $this->scripts ) ){
				$theme = wp_get_theme();

			// set some reasonable default values for scripts
			$default_script = array(
				// handle
				0 => null,
				// src
				1 => false,
				// dependencies
				2 => array(),
				// version
				3 => $theme->get( 'Version' ),
				// footer
				4 => TRUE,
			);

			foreach( $this->scripts as $key => $script ){
				$handle = $script;

				// array scripts need to be registered
				if ( is_array( $script ) ) {
					$handle = $key;
					$script = array_replace( $default_script, array_values( $script ) );

					call_user_func_array( 'wp_register_script', $script );
				}

				wp_enqueue_script( $handle );
			}
		}
	}

	/**
	 * Add an array of styles to the queue
	 *
	 * @param $styles
	 */
	function add_styles( $styles ){
		$styles = $this->get_handle_array( $styles );
		$this->styles = array_replace( $this->styles, $styles );
	}

	/**
	 * Register and enqueue styles
	 *
	 * @link https://codex.wordpress.org/Function_Reference/wp_register_style
	 * @link https://codex.wordpress.org/Function_Reference/wp_enqueue_style
	 */
	function enqueue_styles(){
		if ( !empty( $this->styles ) ){
			$theme = wp_get_theme();
			$default_style = array(
				// handle
				0 => null,
				// src
				1 => false,
				// dependencies
				2 => array(),
				// version
				3 => $theme->get( 'Version' ),
			);

			foreach( $this->styles as $key => $style ){
				$handle = $style;

				// array styles need to be registered
				if ( is_array( $style ) ){
					$handle = $key;
					$style = array_replace( $default_style, array_values( $style ) );

					call_user_func_array( 'wp_register_style', $style );
				}

				wp_enqueue_style( $handle );
			}
		}
	}

	/**
	 * Add an array of sidebars to the queue
	 *
	 * @param $sidebars
	 */
	function add_sidebars( $sidebars ){
		$sidebars = $this->get_handle_array( $sidebars, 'id' );
		$this->sidebars = array_replace( $this->sidebars, $sidebars );
	}

	/**
	 * Add theme sidebars using register_sidebar
	 *
	 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
	 */
	function register_sidebars(){
		if ( !empty( $this->sidebars ) ){
			foreach( $this->sidebars as $sidebar ){
				register_sidebar( $sidebar );
			}
		}
	}

	/**
	 * Add image sizes to this theme.
	 *
	 * @param $image_sizes
	 * @param null $handle_key
	 */
	function add_image_sizes( $image_sizes, $handle_key = null ){
		$image_sizes = $this->get_handle_array( $image_sizes, $handle_key );
		$this->image_sizes = array_replace( $this->image_sizes, $image_sizes );
	}

	/**
	 * Registered image sizes with WordPress by calling add_image_size()
	 *
	 * @link https://developer.wordpress.org/reference/functions/add_image_size/
	 */
	function register_image_sizes(){
		if ( !empty( $this->image_sizes ) ){
			foreach( $this->image_sizes as $handle => $size ) {
				call_user_func_array( 'add_image_size', $size );
			}
		}
	}

	/**
	 * Add nav menus to the settings
	 *
	 * @param $nav_menus
	 */
	function add_nav_menus( $nav_menus ){
		$this->nav_menus = array_replace( $this->nav_menus, $nav_menus );
	}

	/**
	 * Register navigation menus
	 *
	 * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
	 */
	function register_nav_menus(){
		if ( !empty( $this->nav_menus ) ) {
			register_nav_menus( $this->nav_menus );
		}
	}

	/**
	 * Helper function to make a keyed (handle) array from an array with
	 * unknown indexes.
	 *
	 * @param $arrays
	 * @param null $handle_key
	 *
	 * @return array
	 */
	private function get_handle_array( $arrays, $handle_key = null ){
		$result= array();

		foreach( $arrays as $array ){
			// default to first item as handle
			$handle = array_values( $array )[0];

			// allow for a specific handle
			if ( $handle_key && $array[ $handle_key ] ){
				$handle = $array[ $handle_key ];
			}

			$result[ $handle ] = $array;
		}

		return $result;
	}
}
