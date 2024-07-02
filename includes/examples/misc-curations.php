<?php
/**
 * Miscellaneous curation techniques that turn stuff off globally.
 *
 * @package EditorCurationExamples
 */

// Globally disable the Pattern Directory.
if ( ece_is_example_enabled( 'ece-misc-disable-pattern-directory' ) ) {
    add_filter( 'should_load_remote_block_patterns', '__return_false' );
}

// Globally disable the Block Directory.
if ( ece_is_example_enabled( 'ce-misc-disable-block-directory' ) ) {
    remove_action( 'enqueue_block_editor_assets', 'wp_enqueue_editor_block_directory_assets' );
}