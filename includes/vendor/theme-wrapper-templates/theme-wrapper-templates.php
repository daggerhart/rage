<?php

/**
 * Class Theme_Wrapper
 *
 * Templates are discovered the same way Page templates work, but with different
 * comment at the top of the file.
 *
 * Examples:
 *  - If type is "wrapper", template must have "Theme Wrapper Name:" in the file.
 *  - If type is "layout", template must have "Theme Layout Name:" in the file.
 *
 * Default templates (wrapper.php & layout.php) do not require the comment at
 * the top of the file.
 * 
 *
 * Provided Filters
 * ---
 * - theme_wrapper_templates-folder               | string
 * - theme_wrapper_templates-suggestions          | array, string
 * - theme_wrapper_templates-allowed-post-types   | array
 */
if ( !defined('ABSPATH') ) die();

if ( ! class_exists('Theme_Wrapper_Templates') ) :

	// later priority for this version, newer versions have earlier priority
	add_action( 'init', array( 'Theme_Wrapper_Templates', 'init'), 9999 );

	/**
	 * Class Theme_Wrapper_Templates
	 */
	class Theme_Wrapper_Templates {

		const VERSION = '0.0.1';

		/**
		 * @var string
		 */
		private $wrapper_meta_key   = '_theme_wrapper_wrapper_template';
		private $layout_meta_key    = '_theme_wrapper_layout_template';
		private $allowed_post_types = array( 'page' );

		/**
		 * Location of wrapper templates relative to the theme folder
		 *
		 * @var string
		 */
		private $template_folder = '';

		/**
		 * A maybe-slashed version of the template_folder
		 *
		 * @var string
		 */
		private $template_file_prefix = '';

		/**
		 * Setup the class
		 */
		function __construct(){
			$this->template_folder    = apply_filters( 'theme_wrapper_templates-folder', $this->template_folder );
			$this->allowed_post_types = apply_filters( 'theme_wrapper_templates-allowed-post-types', $this->allowed_post_types );

			if ( !empty( $this->template_folder ) ){
				$this->template_file_prefix = trailingslashit( $this->template_folder );
			}
		}

		/**
		 * Hook class up with WP
		 */
		public static function init(){
			$plugin = new self();

			// alter template output
			// very high priority so this goes last and can be avoided
			add_filter( 'template_include', array( $plugin, 'template_include' ), 999 );
			add_filter( 'theme_wrapper_templates-suggestions', array( $plugin, 'additional_suggestions' ), 0, 3 );
			add_action( 'page_attributes_meta_box_template',   array( $plugin, 'meta_box_field' ), 20, 2 );

			// admin ui hooks
			add_action( 'add_meta_boxes', array( $plugin, 'register_meta_boxes' ) );
			add_action( 'save_post',      array( $plugin, 'save_post' ) );
		}

		/**
		 * Hijack the template_include, buffer the include, wrap in a layout
		 * template, then a wrapper template.
		 *
		 * @param $template_file
		 *
		 * @return mixed
		 */
		function template_include( $template_file ){
			$wrapper_suggestions = $this->get_template_suggestions( 'wrapper', $template_file );
			$wrapper_file = locate_template( array_reverse( $wrapper_suggestions ) );

			$layout_suggestions = $this->get_template_suggestions( 'layout', $template_file );
			$layout_file = locate_template( array_reverse( $layout_suggestions ) );

			if ( $wrapper_file && $layout_file && $template_file ){
				// provide $content to layouts
				ob_start();
				include( $template_file );
				$content = ob_get_clean();

				// provide $layout to wrappers
				ob_start();
				call_user_func(function() use ($layout_file, $content) {
					include( $layout_file );
				});
				$layout = ob_get_clean();

				call_user_func(function() use ($wrapper_file, $layout) {
					include( $wrapper_file );
				});

				// we're done. template_include is the last thing WP handles itself,
				// the rest is up to the template files
				exit;
			}

			return $template_file;
		}

		/**
		 * Get an array of possible templates for the given file and type
		 *
		 * @param string $type
		 * @param string $template_file
		 *
		 * @return array
		 */
		function get_template_suggestions( $type = 'wrapper', $template_file = '' ){
			$filename = basename( $template_file );

			$default = $this->template_file_prefix . $type .'.php';

			// suggestions are reversed, making them a stack. last in = first out.
			// key=>value pairs to provide a reliable key for late filter adjustments
			$suggestions = array( $default => $default );

			// if provided, use a prefixed version of the given template file
			// as a template suggestion
			if ( !empty( $template_file ) ){
				$specific = $this->template_file_prefix . $type . '-' . $filename;
				$suggestions[ $specific ] = $specific;
			}

			// allow for late template changes
			return apply_filters('theme_wrapper-template-suggestions', $suggestions, $type, $filename );
		}

		/**
		 * Pages can select their wrappers and layouts explicitly
		 *
		 * @param $suggestions
		 * @param $type
		 * @param $filename
		 *
		 * @return mixed
		 */
		function additional_suggestions( $suggestions, $type, $filename ){
			// look for meta data that wants a specific template
			if ( get_the_ID() ){

				if ( $type == 'wrapper') {
					$selected_template = get_post_meta( get_the_ID(), $this->wrapper_meta_key, TRUE );
				}
				else if ( $type == 'layout' ) {
					$selected_template = get_post_meta( get_the_ID(), $this->layout_meta_key, true );
				}

				if ( !empty( $selected_template ) ){
					$suggestions[ $this->template_file_prefix . $selected_template ] = $this->template_file_prefix . $selected_template;
				}
			}
			return $suggestions;
		}

		/**
		 * Add meta boxes for template selection
		 */
		function register_meta_boxes(){
			add_meta_box(
					'theme-wrapper-templates',
					__( 'Theme Wrapper Templates' ),
					array( $this, 'meta_box' ),
					$this->allowed_post_types,
					'side',
					'default'
			);
		}

		/**
		 * Provide a UI for choosing wrapper & layout templates
		 *
		 * @param $post
		 *
		 * @return mixed
		 */
		function meta_box($post){
			$layout_templates = array( '' => 'Default Layout' ) + $this->find_templates( 'layout' );
			$selected_layout_template = get_post_meta( $post->ID, $this->layout_meta_key, TRUE );

			if ( count( $layout_templates ) > 1 ) {
				?>
				<div>
					<strong><?php _e('Layout Template') ?></strong>
					<label class="screen-reader-text" for="<?php echo $this->layout_meta_key; ?>"><?php _e('Layout Template') ?></label>
					<p class="description"><?php _e('Layout templates are generally used to determine sidebar and content layout.'); ?></p>

					<select name="<?php echo $this->layout_meta_key; ?>" id="<?php echo $this->layout_meta_key; ?>">
						<?php foreach( $layout_templates as $file => $name ){ ?>
							<option value="<?php echo esc_attr( $file ); ?>" <?php selected( $file, $selected_layout_template ); ?>><?php echo esc_attr( $name ); ?></option>
						<?php } ?>
					</select>
				</div>
				<?php
			}

			$wrapper_templates = array( '' => 'Default Wrapper' ) + $this->find_templates( 'wrapper' );
			$selected_wrapper_template = get_post_meta( $post->ID, $this->wrapper_meta_key, TRUE );

			if ( count( $wrapper_templates ) > 1 ) {
				?>
				<hr>
				<div>
					<strong><?php _e('Wrapper Template') ?></strong>
					<label class="screen-reader-text" for="<?php echo $this->wrapper_meta_key; ?>"><?php _e('Wrapper Template') ?></label>
					<p class="description"><?php _e('Wrapper templates are generally used to determine alternate header and footer content.'); ?></p>
					<select name="<?php echo $this->wrapper_meta_key; ?>" id="<?php echo $this->wrapper_meta_key; ?>">
						<?php foreach( $wrapper_templates as $file => $name ){ ?>
							<option value="<?php echo esc_attr( $file ); ?>" <?php selected( $file, $selected_wrapper_template ); ?>><?php echo esc_attr( $name ); ?></option>
						<?php } ?>
					</select>
				</div>
				<?php
			}
		}

		/**
		 * Save our meta data
		 *
		 * @param $post_id
		 */
		function save_post( $post_id ){
			// wrapper template
			if ( isset( $_REQUEST[ $this->wrapper_meta_key ] ) ){
				$selected_template = sanitize_text_field( $_REQUEST[ $this->wrapper_meta_key ] );

				if ( !empty( $selected_template ) ){
					update_post_meta( $post_id, $this->wrapper_meta_key, $selected_template );
				}
				else {
					delete_post_meta( $post_id, $this->wrapper_meta_key );
				}
			}

			// layout template
			if ( isset( $_REQUEST[ $this->layout_meta_key ] ) ){
				$selected_template = sanitize_text_field( $_REQUEST[ $this->layout_meta_key ] );

				if ( !empty( $selected_template ) ){
					update_post_meta( $post_id, $this->layout_meta_key, $selected_template );
				}
				else {
					delete_post_meta( $post_id, $this->layout_meta_key );
				}
			}
		}

		/**
		 * Find theme wrapper templates and parse their names.
		 *
		 * @param string $type
		 *
		 * @return array
		 */
		function find_templates( $type = 'wrapper' ){
			$wrapper_templates = array();
			$find = trailingslashit( get_stylesheet_directory() . '/' . $this->template_file_prefix ) . $type . '-*.php';

			foreach( glob( $find ) as $full_path ) {
				$file = basename($full_path);

				if ( preg_match( '|Theme '.ucfirst( $type ).' Name:(.*)$|mi', file_get_contents( $full_path ), $header ) ){
					$wrapper_templates[ $file ] = _cleanup_header_comment( $header[1] );
				}
			}

			return $wrapper_templates;
		}
	}
endif;

