<?php
/**
 * Disable blocks using a disallow list.
 *
 * @package EditorCurationExamples
 */

/**
 * Filters the list of allowed block types based on user capabilities.
 *
 * This function checks if the current user has the 'edit_theme_options' capability.
 * If the user does not have this capability, certain blocks are removed from the
 * list of allowed block types in the Editor.
 *
 * @param array|bool $allowed_block_types Array of block type slugs, or boolean to enable/disable all.
 * @param object     $block_editor_context The current block editor context.
 *
 * @return array The filtered list of allowed block types. If the current user does not have
 *               the 'edit_theme_options' capability, the list will exclude the disallowed blocks.
 */
function ece_disallow_block_types( $allowed_block_types, $block_editor_context ) {
    
	// If the current user doesn't have the correct permissions, disallow blocks.
	if  ( ! current_user_can( 'edit_theme_options' ) ) {
		$disallowed_blocks = array(
			'core/navigation',
			'core/query',
		);
		
		// Get all registered blocks if $allowed_block_types is not already set.
		if ( ! is_array( $allowed_block_types ) || empty( $allowed_block_types ) ) {
			$registered_blocks   = WP_Block_Type_Registry::get_instance()->get_all_registered();
			$allowed_block_types = array_keys( $registered_blocks );
		}

		// Create a new array for the allowed blocks.
		$filtered_blocks = array();

		// Loop through each block in the allowed blocks list.
		foreach ( $allowed_block_types as $block ) {

			// Check if the block is not in the disallowed blocks list.
			if ( ! in_array( $block, $disallowed_blocks, true ) ) {

				// If it's not disallowed, add it to the filtered list.
				$filtered_blocks[] = $block;
			}
		}

		// Return the filtered list of allowed blocks.
		return $filtered_blocks;
	}
	
	return $allowed_block_types;
}

if ( ece_is_example_enabled( 'ce-disable-blocks-disallow-list-local-php' ) ) {
    add_filter( 'allowed_block_types_all', 'ece_disallow_block_types', 10, 2 );
}