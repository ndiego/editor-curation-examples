<?php
/**
 * Plugin Name:         Editor Curation Examples
 * Plugin URI:          
 * Description:         A collection of Editor curation examples.
 * Version:             0.1.0
 * Requires at least:   6.2
 * Requires PHP:        7.0
 * Author:              Nick Diego
 * Author URI:          https://www.nickdiego.com
 * License:             GPLv2
 * License URI:         https://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * Text Domain:         editor-curation-examples
 * Domain Path:         /languages
 *
 * @package editor-curation-examples
 */

/**
 * Enqueue plugin specific editor scripts
 *
 * @since 0.1.0
 */
function ece_enqueue_editor_scripts() {
	$asset_file = ece_get_asset_file( 'build/index' );

	wp_enqueue_script(
		'editor-curation-examples-scripts',
		plugin_dir_url( __FILE__ ) . '/build/index.js',
		$asset_file['dependencies'],
		$asset_file['version']
	);
}
add_action( 'enqueue_block_editor_assets', 'ece_enqueue_editor_scripts' );


/**
 * Loads the asset file for the given script or style.
 * Returns a default if the asset file is not found.
 *
 * @since 0.1.0
 *
 * @param string $filepath The name of the file without the extension.
 * @return array           The asset file contents.
 */
function ece_get_asset_file( $filepath ) {
	$asset_path = dirname( __FILE__ ) . '/' . $filepath . '.asset.php';

	return file_exists( $asset_path )
		? include $asset_path
		: array(
			'dependencies' => array(),
			'version'      => get_plugin_date( __FILE__, 'version' ),
		);
}

include_once( plugin_dir_path( __FILE__ ) . 'inc/server-side-filters/wp-theme-json-data-theme.php' );
include_once( plugin_dir_path( __FILE__ ) . 'inc/server-side-filters/wp-theme-json-data-user.php' );