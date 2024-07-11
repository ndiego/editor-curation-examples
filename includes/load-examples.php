<?php
/**
 * Load all PHP curation examples.
 *
 * @package EditorCurationExamples
 */

if ( ece_is_example_enabled( 'ece-block-type-metadata' ) ) {
	include_once( plugin_dir_path( __FILE__ ) . 'examples/block-filters/block-type-metadata.php' );
}

if ( ece_is_example_enabled( 'ece-register-block-type-args' ) ) {
	include_once( plugin_dir_path( __FILE__ ) . 'examples/block-filters/register-block-type-args.php' );
}

if ( ece_is_example_enabled( 'ece-editor-filters-php' ) ) {
	include_once( plugin_dir_path( __FILE__ ) . 'examples/editor-filters/block-editor-settings-all.php' );
}

if ( ece_is_example_enabled( 'ece-global-styles-filters-php' ) ) {
	include_once( plugin_dir_path( __FILE__ ) . 'examples/global-styles-filters/wp-theme-json-data-theme.php' );
	include_once( plugin_dir_path( __FILE__ ) . 'examples/global-styles-filters/wp-theme-json-data-user.php' );
}

include_once( plugin_dir_path( __FILE__ ) . 'examples/notes-demo/register-notes.php' );
include_once( plugin_dir_path( __FILE__ ) . 'examples/disable-blocks/allow-list.php' );
include_once( plugin_dir_path( __FILE__ ) . 'examples/disable-blocks/disallow-list.php' );
include_once( plugin_dir_path( __FILE__ ) . 'examples/misc-curations.php' );

/**
 * Sets a global JS variable used to trigger the availability of each example.
 */
function ece_enable_js_examples() {

	if ( ece_is_example_enabled( 'ece-notes-demo' ) ) {
		wp_add_inline_script( 'wp-block-editor', 'window.enableNotesDemo = true', 'before' );
	}

	if ( ece_is_example_enabled( 'ece-editor-filters-js' ) ) {
		wp_add_inline_script( 'wp-block-editor', 'window.enableEditorFilters = true', 'before' );
	}

	if ( ece_is_example_enabled( 'ece-block-filters-js' ) ) {
		wp_add_inline_script( 'wp-block-editor', 'window.enableBlockFilters = true', 'before' );
	}

	if ( ece_is_example_enabled( 'ece-block-styles' ) ) {
		wp_add_inline_script( 'wp-block-editor', 'window.enableBlockStyles = true', 'before' );
	}

	if ( ece_is_example_enabled( 'ece-block-variations' ) ) {
		wp_add_inline_script( 'wp-block-editor', 'window.enableBlockVariations = true', 'before' );
	}

	if ( ece_is_example_enabled( 'ece-disable-blocks-allow-list-global-js' ) ) {
		wp_add_inline_script( 'wp-block-editor', 'window.enableAllowListGlobal = true', 'before' );
	}

	if ( ece_is_example_enabled( 'ece-disable-blocks-allow-list-local-js' ) ) {
		wp_add_inline_script( 'wp-block-editor', 'window.enableAllowListLocal = true', 'before' );
	}

	if ( ece_is_example_enabled( 'ece-disable-blocks-disallow-list-local-js' ) ) {
		wp_add_inline_script( 'wp-block-editor', 'window.enableDisallowListLocal = true', 'before' );
	}
}
add_action( 'admin_init', 'ece_enable_js_examples' );