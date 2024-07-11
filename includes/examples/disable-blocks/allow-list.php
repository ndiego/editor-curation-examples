<?php
/**
 * Disable blocks using an allow list.
 *
 * @package EditorCurationExamples
 */

/**
 * Filters the list of allowed block types in the block editor.
 *
 * This function restricts the available block types to Heading, List, Image, and Paragraph only.
 *
 * @param array|bool $allowed_block_types Array of block type slugs, or boolean to enable/disable all.
 * @param object     $block_editor_context The current block editor context.
 *
 * @return array The array of allowed block types.
 */
function ece_global_allowed_block_types( $allowed_block_types, $block_editor_context ) {

	$allowed_block_types = array(
		'core/heading',     // Heading block.
		'core/image',       // Image block.
		'core/list',        // List block.
		'core/list-item',   // List Item block.
		'core/paragraph',   // Paragraph block.
	);

	return $allowed_block_types;
}
if ( ece_is_example_enabled( 'ece-disable-blocks-allow-list-global-php' ) ) {
    add_filter( 'allowed_block_types_all', 'ece_global_allowed_block_types', 10, 2 );
}

/**
 * Filters the list of allowed block types based on the editing context.
 *
 * This function restricts the available block types to Heading, List, Image, and 
 * Paragraph when the user is editing posts in the Editor. When editing other post types
 * or in the Site Editor, all blocks are allowed.
 *
 * @param array|bool $allowed_block_types Array of block type slugs, or boolean to enable/disable all.
 * @param object     $block_editor_context The current block editor context, including the editor type and the post being edited.
 *
 * @return array|bool The array of allowed block types when editing posts, or true to allow all blocks in other contexts.
 */
function ece_allowed_block_types_when_editing_posts( $allowed_block_types, $block_editor_context ) {

	// Only apply in the Editor when editing posts.
	if ( 
		'core/edit-post' === $block_editor_context->name &&
		isset( $block_editor_context->post ) && 
		'post' === $block_editor_context->post->post_type
	) {
		$allowed_block_types = array(
			'core/heading',
			'core/image',
			'core/list',
			'core/list-item',
			'core/paragraph',
			'core/missing', // Displayed when a block type is no longer registered.
		);

		return $allowed_block_types;
	}

	// Allow all blocks in the Site Editor or when editing other post types.
	return true;
}
if ( ece_is_example_enabled( 'ece-disable-blocks-allow-list-local-php' ) ) {
    add_filter( 'allowed_block_types_all', 'ece_allowed_block_types_when_editing_posts', 10, 2 );
}