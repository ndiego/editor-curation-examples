<?php
/**
 * Plugin Name:         Editor Curation Examples
 * Description:         A collection of Editor curation examples.
 * Version:             0.1.0
 * Requires at least:   6.3
 * Requires PHP:        7.0
 * Author:              Nick Diego
 * Author URI:          https://www.nickdiego.com
 * License:             GPL-2.0-or-later
 * License URI:         https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:         editor-curation-examples
 * Domain Path:         /languages
 *
 * @package EditorCurationExamples
 */

defined( 'ABSPATH' ) || exit;

/**
 * Enqueue Editor assets.
 */
function ece_enqueue_editor_scripts() {
	$asset_file  = include plugin_dir_path( __FILE__ ) . 'build/index.asset.php';

    wp_enqueue_script(
        'editor-curation-examples-scripts',
        plugin_dir_url( __FILE__ ) . 'build/index.js',
        array_merge( $asset_file['dependencies'], array( 'wp-edit-post', 'wp-blocks', 'wp-dom-ready' ) ),
        $asset_file['version'],
        true // Print scripts in the footer. This is required for scripts to work correctly in the Site Editor.
    );

    wp_set_script_translations(
        'editor-curation-examples-scripts',
        'editor-curation-examples',
        plugin_dir_path( __FILE__ ) . 'languages'
    );
}
add_action( 'enqueue_block_editor_assets', 'ece_enqueue_editor_scripts' );

// Require plugin files.
include_once( plugin_dir_path( __FILE__ ) . 'includes/settings.php' );
include_once( plugin_dir_path( __FILE__ ) . 'includes/load-examples.php' );