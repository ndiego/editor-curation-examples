<?php
/**
 * Add the plugin settings page.
 *
 * @package EditorCurationExamples
 */

/**
 * Add a settings page under the "Settings" menu in the WordPress admin.
 */
function ece_create_admin_menu_item() {
	add_options_page(
		__( 'Editor curation examples', 'editor-curation-examples' ),
		__( 'Curation examples', 'editor-curation-examples' ),
		'edit_posts',
		'editor-curation-examples',
		'ece_render_settings_page'
	);
}
add_action( 'admin_menu', 'ece_create_admin_menu_item' );

/**
 * The main entry point for the Editor curation examples page.
 */
function ece_render_settings_page() {
	?>
	<div
		id="editor-curation-examples-editor"
		class="wrap"
	>
	<h1><?php echo __( 'Editor curation examples', 'editor-curation-examples' ); ?></h1>
	<form method="post" action="options.php">
		<?php settings_fields( 'editor-curation-examples' ); ?>
		<?php do_settings_sections( 'editor-curation-examples' ); ?>
		<?php submit_button(); ?>
	</form>
	</div>
	<?php
}

/**
 * Register the example settings.
 */
function ece_register_settings() {

	add_settings_section(
		'editor_curation_examples_section',
		// The empty string ensures the render function won't output a h2.
		'',
		'editor_curation_examples_display_section',
		'editor-curation-examples'
	);

	add_settings_field(
		'ece-block-filters-php',
		__( 'Block Filters (PHP)', 'editor-curation-examples' ),
		'ece_display_example_field',
		'editor-curation-examples',
		'editor_curation_examples_section',
		array(
			'label' => sprintf(
				__( 'Enable PHP block filters. Examples use the <code>block_type_metadata</code> and <code>register_block_type_args</code> filters. <a href="%s" target="_blank">View source code</a>.', 'editor-curation-examples' ),
				esc_url( 'https://github.com/ndiego/editor-curation-examples/tree/main/includes/examples/editor-filters' )
			),
			'id'    => 'ece-block-filters-php',
		)
	);

	add_settings_field(
		'ece-editor-filters-php',
		__( 'Editor Filters (PHP)', 'editor-curation-examples' ),
		'ece_display_example_field',
		'editor-curation-examples',
		'editor_curation_examples_section',
		array(
			'label' => sprintf(
				__( 'Enable PHP editor filters. Examples use the <code>block_editor_settings_all</code> filter. <a href="%s" target="_blank">View source code</a>.', 'editor-curation-examples' ),
				esc_url( 'https://github.com/ndiego/editor-curation-examples/tree/main/includes/examples/editor-filters' )
			),
			'id'    => 'ece-editor-filters-php',
		)
	);

	add_settings_field(
		'ece-global-styles-filters-php',
		__( 'Global Styles Filters (PHP)', 'editor-curation-examples' ),
		'ece_display_example_field',
		'editor-curation-examples',
		'editor_curation_examples_section',
		array(
			'label' => sprintf(
				__( 'Enable PHP theme.json filters. Examples use the <code>wp_theme_json_data_theme</code> and <code>wp_theme_json_data_user</code> filters. <a href="%s" target="_blank">View source code</a>.', 'editor-curation-examples' ),
				esc_url( 'https://github.com/ndiego/editor-curation-examples/tree/main/includes/examples/global-styles-filters' )
			),
			'id'    => 'ece-global-styles-filters-php',
		)
	);

	add_settings_field(
		'ece-misc-curations-php',
		__( 'Misc Curations (php)', 'editor-curation-examples' ),
		'ece_display_example_field',
		'editor-curation-examples',
		'editor_curation_examples_section',
		array(
			'label' => sprintf(
				__( 'Enable PHP miscellaneous curation techniques. Examples include disabling the Block Directory, Pattern Directory, and more. <a href="%s" target="_blank">View source code</a>.', 'editor-curation-examples' ),
				esc_url( 'https://github.com/ndiego/editor-curation-examples/tree/main/src/examples/misc-curations' )
			),
			'id'    => 'ece-misc-curations-php',
		)
	);

	add_settings_field(
		'ece-block-filters-js',
		__( 'Block Filters (JS)', 'editor-curation-examples' ),
		'ece_display_example_field',
		'editor-curation-examples',
		'editor_curation_examples_section',
		array(
			'label' => sprintf(
				__( 'Enable JS block filters. Examples use the <code>bblocks.registerBlockType</code> filter. <a href="%s" target="_blank">View source code</a>.', 'editor-curation-examples' ),
				esc_url( 'https://github.com/ndiego/editor-curation-examples/tree/main/src/examples/block-filters' )
			),
			'id'    => 'ece-block-filters-js',
		)
	);

	add_settings_field(
		'ece-editor-filters-js',
		__( 'Editor Filters (JS)', 'editor-curation-examples' ),
		'ece_display_example_field',
		'editor-curation-examples',
		'editor_curation_examples_section',
		array(
			'label' => sprintf(
				__( 'Enable JS editor filters. Examples use the <code>blockEditor.useSetting.before</code> filter. <a href="%s" target="_blank">View source code</a>.', 'editor-curation-examples' ),
				esc_url( 'https://github.com/ndiego/editor-curation-examples/tree/main/src/examples/editor-filters' )
			),
			'id'    => 'ece-editor-filters-js',
		)
	);

	add_settings_field(
		'ece-misc-curations-js',
		__( 'Misc Curations (JS)', 'editor-curation-examples' ),
		'ece_display_example_field',
		'editor-curation-examples',
		'editor_curation_examples_section',
		array(
			'label' => sprintf(
				__( 'Enable JS miscellaneous curation techniques. Examples include disabling block types, block styles, block variations, and more. <a href="%s" target="_blank">View source code</a>.', 'editor-curation-examples' ),
				esc_url( 'https://github.com/ndiego/editor-curation-examples/tree/main/src/examples/misc-curations.js' )
			),
			'id'    => 'ece-misc-curations-js',
		)
	);

	add_settings_field(
		'ece-notes-demo',
		__( 'Notes Demo', 'editor-curation-examples' ),
		'ece_display_example_field',
		'editor-curation-examples',
		'editor_curation_examples_section',
		array(
			'label' => sprintf(
				__( 'Enable the "Notes" post type, which demonstrates a highly curated editing experience for this specific custom post type. <a href="%s" target="_blank">View source code</a>.', 'editor-curation-examples' ),
				esc_url( 'https://github.com/ndiego/editor-curation-examples/tree/main/includes/examples/notes-demo' )
			),
			'id'    => 'ece-notes-demo',
		)
	);

	register_setting( 'editor-curation-examples', 'editor-curation-examples' );
}
add_action( 'admin_init', 'ece_register_settings' );

/**
 * Display a checkbox field for a curation example.
 *
 * @param array $args ( $label, $id ).
 */
function ece_display_example_field( $args ) {
	$options = get_option( 'editor-curation-examples' );
	$value   = isset( $options[ $args['id'] ] ) ? 1 : 0;
	?>
		<label for="<?php echo $args['id']; ?>">
			<input type="checkbox" name="<?php echo 'editor-curation-examples[' . $args['id'] . ']'; ?>" id="<?php echo $args['id']; ?>" value="1" <?php checked( 1, $value ); ?> />
			<?php echo $args['label']; ?>
		</label>
	<?php
}

/**
 * Display the experiments section.
 */
function editor_curation_examples_display_section() {
	?>
	<p><?php echo __( 'Toggle the different Editor curation examples. Note that enabling multiple examples at once may cause conflicts.', 'editor-curation-examples' ); ?></p>
	<?php
}

/**
 * Checks whether the Gutenberg experiment is enabled.
 *
 * @param string $name The name of the experiment.
 *
 * @return bool True when the experiment is enabled.
 */
function ece_is_example_enabled( $name ) {
	$examples = get_option( 'editor-curation-examples' );
	return ! empty( $examples[ $name ] );
}
