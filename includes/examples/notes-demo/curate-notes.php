<?php
/**
 * Curate the editing experience for the 'note' custom post type.
 *
 * @package EditorCurationExamples
 */

/**
 * Restrict allowed blocks for the 'note' custom post type.
 *
 * This function limits the available blocks in the editor for the 'note' custom post type
 * to a specific set of core blocks: paragraph, image, heading, list, and code.
 *
 * @param array|bool $allowed_block_types Array of allowed block types, or boolean to enable/disable all.
 * @param array      $context             The current editor context, including post type information.
 * @return array|bool                     Modified array of allowed block types.
 */
function ece_restrict_allowed_blocks_for_notes( $allowed_block_types, $context ) {
	if ( 
		! empty( $context->post ) && 
		'note' === $context->post->post_type 
	) {
		return array( 
			'core/paragraph',
			'core/image',
			'core/heading',
			'core/list',
			'core/list-item',
			'core/code',
		);
	}

	return $allowed_block_types;
}
add_filter( 'allowed_block_types_all', 'ece_restrict_allowed_blocks_for_notes', 10, 2 );

/**
 * Customize block functionality for the 'note' post type.
 *
 * @param array  $args       The original block arguments.
 * @param string $block_type The block type name.
 * @return array             The modified block arguments.
 */
function ece_curate_block_functionality_for_notes( $args, $block_type ) {

	// Get the current post type.
	$post_type = ece_get_post_type();
	
	// If the post type is not 'note', return the original arguments.
	if ( 'note' !== $post_type ) {
		return $args;
	}

	$allowed_blocks = array( 
		'core/paragraph',
		'core/image',
		'core/heading',
		'core/list',
		'core/list-item',
		'core/code',
	);
	
	// Only apply the filter to allowed blocks.
	if ( ! isset( $args['name'] ) || ! in_array( $args['name'], $allowed_blocks ) ) {
		return $args;
	}

	// Add blocks to the custom note-blocks category.
	$args = array_merge(
		$args,
		array( 'category' => 'note-blocks' )
	);

	// Make sure there is a 'supports' property.
	if ( ! isset( $args['supports'] ) ) {
		$args['supports'] = array();
	}

	// Disable alignment (wide, full, etc.).
	$args['supports']['align'] = false;

	// Disable border support.
	$args['supports']['__experimentalBorder'] = false;

	// Disable spacing support.
	$args['supports']['color'] = array(
		'text' => false,
		'background' => false,
	);

	// Disable shadow support.
	$args['supports']['shadow'] = false;

	// Disable spacing support.
	$args['supports']['spacing'] = false;

	// Disable some typography supports.
	$args['supports']['typography'] = array(
		'fontSize'                      => true,
		'__experimentalFontWeight'      => true,
		'lineHeight'                    => false,
		'__experimentalFontFamily'      => false,
		'__experimentalFontStyle'       => false,
		'__experimentalLetterSpacing'   => false,
		'__experimentalTextTransform'   => false,
		'__experimentalTextDecoration'  => false,
		'__experimentalDefaultControls' => array(
			'fontSize'       => true,
			// This is the same as '__experimentalFontWeight'.
			'fontAppearance' => true,
		)
	);

	// Remove typography control entirely for Image blocks.
	if ( 'core/image' === $args['name'] ) {
		$args['supports']['typography'] = false;
	}

	// Disable custom CSS classes (Advanced panel).
	$args['supports']['customClassName'] = false;

	// Disable HTML anchors (Advanced panel).
	$args['supports']['anchor'] = false;

	return $args;
}
add_filter( 'register_block_type_args', 'ece_curate_block_functionality_for_notes', 10, 2 );

/**
 * Customize block editor settings for the 'note' post type.
 *
 * @param array $settings The current block editor settings.
 * @param array $context  The current editor context, including post information.
 * @return array          The modified block editor settings.
 */
function ece_curate_editor_settings_for_notes( $settings, $context ) {
	if ( 
		! empty( $context->post ) && 
		'note' === $context->post->post_type 
	) {
		// Disable the Code editor.
		$settings[ 'codeEditingEnabled' ] = false;

		// Disable the Openverse.
		$settings[ 'enableOpenverseMediaCategory' ] = false;

		// Add custom title placeholder text.
		$settings[ 'titlePlaceholder' ] = __( 'Add note title', 'editor-curation-examples' );
		
		// Disable block locking.
		$settings[ 'canLockBlocks' ] = false;

		// Set the default image size to full.
		$settings['imageDefaultSize'] = 'full';
	}

	return $settings;
}
add_filter( 'block_editor_settings_all', 'ece_curate_editor_settings_for_notes', 10, 2 );

/**
 * Remove theme patterns and disable the Block Directory for the 'note' post type.
 *
 * This function checks if the current screen is the post editing screen for the 'note' post type.
 * If the conditions are met, it removes support for core block patterns and disables the Block Directory.
 *
 * @return void
 */
function ece_remove_theme_patterns_and_block_directory() {
	$screen = get_current_screen();
	
	// Check if we are in the post editing screen and the post type is 'note'.
	if ( 'note' === $screen->post_type ) {

		// Remove access to the template editor. 
		remove_theme_support( 'block-templates');

		// Remove all core patterns for Notes.
		remove_theme_support( 'core-block-patterns' );

		// Disable the Block Directory for Notes.
		remove_action( 'enqueue_block_editor_assets', 'wp_enqueue_editor_block_directory_assets' );
	}
}
add_action( 'current_screen', 'ece_remove_theme_patterns_and_block_directory', 10, 1 );

/**
 * Adds a new custom block category at the beginning of the block categories array.
 * 
 * Even though this category is only used for the 'note' post type, we don't need
 * to add any conditionals here. The category will technically exist, but have no
 * block types associated with it for other post types, and therefore will not be displayed.
 *
 * @param array $categories The existing array of block categories.
 * @return array            The modified array of block categories.
 */
function ece_register_notes_block_category( $categories ) {
	
	// Define the Blocks category.
	$new_category = array(
		'slug'  => 'note-blocks',
		'title' => __( 'Blocks', 'editor-curation-examples' ),
		'icon'  => null,
	);

	// Insert the new category at the beginning of the array.
	array_unshift( $categories, $new_category );

	return $categories;
}
add_filter( 'block_categories_all', 'ece_register_notes_block_category', 10, 1 );

/**
 * Utility function to retrieve the post type from query parameters.
 *
 * This function checks the query parameters to determine the post type. It first looks for a post ID
 * in the 'post' query parameter and uses it to get the post type. If the 'post' query parameter is not set,
 * it checks for a direct 'postType' query parameter, which is often used in the Site Editor.
 *
 * @return string The post type if found, otherwise an empty string.
 */
function ece_get_post_type() {
	$post_type = '';

	// Check if the post ID is set in the query parameters and get the post type.
	if ( isset( $_GET['post'] ) ) {
		$post_type = get_post_type( absint( $_GET['post'] ) );
	} elseif ( isset( $_GET['post_type'] ) ) {

		// Check if the post type is directly set in the query parameters, which is the case when you first create a new post.
		$post_type = sanitize_text_field( $_GET['post_type'] );
	} elseif ( isset( $_GET['postType'] ) ) {
		
		// Check if the post type is directly set in the query parameters, which is the case in the Site Editor.
		$post_type = sanitize_text_field( $_GET['postType'] );
	}

	return $post_type;
}
