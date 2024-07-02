<?php
/**
 * Miscellaneous curation techniques that turn stuff off globally.
 *
 * @package EditorCurationExamples
 */

// Globally disable the Pattern Directory.
add_filter( 'should_load_remote_block_patterns', '__return_false' );

// Globally disable the Block Directory.
remove_action( 'enqueue_block_editor_assets', 'wp_enqueue_editor_block_directory_assets' );