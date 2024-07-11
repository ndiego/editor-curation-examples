<?php
/**
 * Register the 'note' custom post type.
 *
 * @package EditorCurationExamples
 */

/**
 * Register the 'note' custom post type.
 */
function ece_register_note_post_type() {

	$labels = array(
		'name'               => _x( 'Notes', 'post type general name', 'editor-curation-examples' ),
		'singular_name'      => _x( 'Note', 'post type singular name', 'editor-curation-examples' ),
		'menu_name'          => _x( 'Notes', 'admin menu', 'editor-curation-examples' ),
		'name_admin_bar'     => _x( 'Note', 'add new on admin bar', 'editor-curation-examples' ),
		'add_new'            => _x( 'Add New', 'note', 'editor-curation-examples' ),
		'add_new_item'       => __( 'Add New Note', 'editor-curation-examples' ),
		'new_item'           => __( 'New Note', 'editor-curation-examples' ),
		'edit_item'          => __( 'Edit Note', 'editor-curation-examples' ),
		'view_item'          => __( 'View Note', 'editor-curation-examples' ),
		'all_items'          => __( 'All Notes', 'editor-curation-examples' ),
		'search_items'       => __( 'Search Notes', 'editor-curation-examples' ),
		'parent_item_colon'  => __( 'Parent Notes:', 'editor-curation-examples' ),
		'not_found'          => __( 'No notes found.', 'editor-curation-examples' ),
		'not_found_in_trash' => __( 'No notes found in Trash.', 'editor-curation-examples' )
	);

	$args = array(
		'labels'       => $labels,
		'menu_icon'    => 'dashicons-editor-ul',
		'public'       => true,
		'show_in_rest' => true,
		'hierarchical' => true,
		'supports'     => array( 'title', 'editor' ),
	);

	if ( ece_is_example_enabled( 'ece-notes-demo' ) ) {
		// A List block will be inserted automatically for each new Note.
		$args['template'] = array( array( 'core/list' ) );
	}

	register_post_type( 'note', $args );
}
add_action( 'init', 'ece_register_note_post_type' );

// Include curation functions if demo is enabled.
if ( ece_is_example_enabled( 'ece-notes-demo' ) ) {
	include_once( plugin_dir_path( __FILE__ ) . 'curate-notes.php' );
}
