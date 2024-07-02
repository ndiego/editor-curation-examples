<?php
/**
 * Add curation examples the utilize 'block_editor_settings_all' filter.
 * 
 * @see https://developer.wordpress.org/reference/hooks/block_editor_settings_all/
 *
 * @package EditorCurationExamples
 */

/**
 * Restrict access to the locking UI to Administrators and 
 * disable entirely on the "book" custom post type.
 * 
 * @param array                   $settings Default editor settings.
 * @param WP_Block_Editor_Context $context  The current block editor context.
 */
function ece_restrict_locking_ui_with_context( $settings, $context ) {
	$is_administrator = current_user_can( 'edit_theme_options' );
	$is_book          = $context->post && 'book' === $context->post->post_type;

	if ( ! $is_administrator || $is_book ) {
		$settings[ 'canLockBlocks' ] = false;
	}

	return $settings;
}
add_filter( 'block_editor_settings_all', 'ece_restrict_locking_ui_with_context', 10, 2 );

/**
 * Restrict access to the locking UI and the Code Editor
 * to Administrators.
 * 
 * @param array                   $settings Default editor settings.
 * @param WP_Block_Editor_Context $context  The current block editor context.
 */
function ece_restrict_locking_ui_to_administrators( $settings, $context ) {
	$is_administrator = current_user_can( 'edit_theme_options' );

	if ( ! $is_administrator ) {
		$settings[ 'canLockBlocks' ]      = false;
		$settings[ 'codeEditingEnabled' ] = false;
	}

	return $settings;
}
add_filter( 'block_editor_settings_all', 'ece_restrict_locking_ui_to_administrators', 10, 2 );

/**
 * Disable Openverse.
 *
 * @param array $settings The current block editor settings.
 * @return array The modified block editor settings.
 */
function ece_disable_openverse( $settings ) {
	$settings['enableOpenverseMediaCategory'] = false;
	return $settings;
}
add_filter( 'block_editor_settings_all', 'ece_disable_openverse' );

/**
 * Set the default image size to Full Size.
 *
 * @param array $settings The current block editor settings.
 * @return array The modified block editor settings.
 */
function ece_set_default_image_size_to_full( $settings ) {
	$settings['imageDefaultSize'] = 'full';
	return $settings;
}
add_filter( 'block_editor_settings_all', 'ece_set_default_image_size_to_full' );

/**
 * This function modifies the block editor settings to disable inspector tabs
 * for all blocks by default.
 *
 * @param array $settings The current block editor settings.
 * @return array The modified block editor settings.
 */
function ece_disable_inspector_tabs_by_default( $settings ) {
	$settings['blockInspectorTabs'] = array( 'default' => false );
	return $settings;
}
//add_filter( 'block_editor_settings_all', 'ece_disable_inspector_tabs_by_default' );

/**
 * This function modifies the block editor settings to disable inspector tabs
 * for the 'core/heading' and 'core/paragraph' blocks.
 *
 * @param array $settings The current block editor settings.
 * @return array The modified block editor settings.
 */
function ece_disable_inspector_tabs_for_specific_blocks( $settings ) {
	if ( isset( $settings[ 'blockInspectorTabs' ] ) ) {
		$settings['blockInspectorTabs'] = array_merge(
			$settings[ 'blockInspectorTabs' ],
			array( 
				'core/heading'   => false,
				'core/paragraph' => false,
			),
		);
	}

	return $settings;
}
add_filter( 'block_editor_settings_all', 'ece_disable_inspector_tabs_for_specific_blocks' );