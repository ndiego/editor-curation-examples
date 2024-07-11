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
	<p><?php echo __( 'A collection of examples that demonstrate different ways you can curate the editing experience in WordPress. Click on "View source code" to see how each work.', 'editor-curation-examples' ); ?></p>
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
		'editor_curation_examples_demos',
		__( 'Curation demos', 'editor-curation-examples' ),
		function() { 
			echo __( 'Complete demos that combine various curation techniques.', 'editor-curation-examples' ); 
		},
		'editor-curation-examples'
	);

	add_settings_field(
		'ece-notes-demo',
		__( 'Notes demo', 'editor-curation-examples' ),
		'ece_display_example_field',
		'editor-curation-examples',
		'editor_curation_examples_demos',
		array(
			'label' => sprintf(
				__( 'Enable the "Notes" demo, which showcases a highly curated editing experience for this specific custom post type. <a href="%s" target="_blank">View source code</a>.', 'editor-curation-examples' ),
				esc_url( 'https://github.com/ndiego/editor-curation-examples/tree/main/includes/examples/notes-demo' )
			),
			'id'    => 'ece-notes-demo',
		)
	);

	add_settings_section(
		'editor_curation_examples_block_filters',
		__( 'Block filters', 'editor-curation-examples' ),
		function() { 
			echo __( 'Filters that modify block attributes, supports, etc.', 'editor-curation-examples' ); 
		},
		'editor-curation-examples'
	);

	add_settings_field(
		'ece-block-type-metadata',
		__( '<code>block_type_metadata</code>', 'editor-curation-examples' ),
		'ece_display_example_field',
		'editor-curation-examples',
		'editor_curation_examples_block_filters',
		array(
			'label' => sprintf(
				__( 'Enable examples that use the PHP filter <code>block_type_metadata</code>. <a href="%s" target="_blank">View source code</a>.', 'editor-curation-examples' ),
				esc_url( 'https://github.com/ndiego/editor-curation-examples/tree/main/includes/examples/editor-filters/block-type-metadata.php' )
			),
			'id'    => 'ece-block-type-metadata',
		)
	);

	add_settings_field(
		'ece-register-block-type-args',
		__( '<code>register_block_type_args</code>', 'editor-curation-examples' ),
		'ece_display_example_field',
		'editor-curation-examples',
		'editor_curation_examples_block_filters',
		array(
			'label' => sprintf(
				__( 'Enable examples that use the PHP filter <code>register_block_type_args</code>. <a href="%s" target="_blank">View source code</a>.', 'editor-curation-examples' ),
				esc_url( 'https://github.com/ndiego/editor-curation-examples/tree/main/includes/examples/editor-filters/register-block-type-args.php' )
			),
			'id'    => 'ece-register-block-type-args',
		)
	);

	add_settings_field(
		'ece-block-filters-js',
		__( '<code>blocks.registerBlockType</code>', 'editor-curation-examples' ),
		'ece_display_example_field',
		'editor-curation-examples',
		'editor_curation_examples_block_filters',
		array(
			'label' => sprintf(
				__( 'Enable examples that use the JavaScript filter <code>blocks.registerBlockType</code>. <a href="%s" target="_blank">View source code</a>.', 'editor-curation-examples' ),
				esc_url( 'https://github.com/ndiego/editor-curation-examples/tree/main/src/examples/block-filters' )
			),
			'id'    => 'ece-block-filters-js',
		)
	);

	add_settings_section(
		'editor_curation_examples_editor_filters',
		__( 'Editor filters', 'editor-curation-examples' ),
		function() { 
			echo __( 'Filters that modify Editor settings and functionality.', 'editor-curation-examples' ); 
		},
		'editor-curation-examples'
	);

	add_settings_field(
		'ece-editor-filters-php',
		__( '<code>block_editor_settings_all</code>', 'editor-curation-examples' ),
		'ece_display_example_field',
		'editor-curation-examples',
		'editor_curation_examples_editor_filters',
		array(
			'label' => sprintf(
				__( 'Enable examples that use the PHP filter <code>block_editor_settings_all</code>. <a href="%s" target="_blank">View source code</a>.', 'editor-curation-examples' ),
				esc_url( 'https://github.com/ndiego/editor-curation-examples/tree/main/includes/examples/editor-filters' )
			),
			'id'    => 'ece-editor-filters-php',
		)
	);

	add_settings_field(
		'ece-editor-filters-js',
		__( '<code>blockEditor.useSetting.before</code>', 'editor-curation-examples' ),
		'ece_display_example_field',
		'editor-curation-examples',
		'editor_curation_examples_editor_filters',
		array(
			'label' => sprintf(
				__( 'Enable examples that use the JavaScript filter <code>blockEditor.useSetting.before</code>. <a href="%s" target="_blank">View source code</a>.', 'editor-curation-examples' ),
				esc_url( 'https://github.com/ndiego/editor-curation-examples/tree/main/src/examples/editor-filters' )
			),
			'id'    => 'ece-editor-filters-js',
		)
	);

	add_settings_section(
		'editor_curation_examples_global_styles_filters',
		__( 'Global Styles filters', 'editor-curation-examples' ),
		function() { 
			echo __( 'Filters that allow you to modify theme.json data.', 'editor-curation-examples' ); 
		},
		'editor-curation-examples'
	);

	add_settings_field(
		'ece-global-styles-filters-php',
		__( 'Global Styles filters (PHP)', 'editor-curation-examples' ),
		'ece_display_example_field',
		'editor-curation-examples',
		'editor_curation_examples_global_styles_filters',
		array(
			'label' => sprintf(
				__( 'Enable PHP theme.json filters. Examples use the <code>wp_theme_json_data_theme</code> and <code>wp_theme_json_data_user</code> filters. <a href="%s" target="_blank">View source code</a>.', 'editor-curation-examples' ),
				esc_url( 'https://github.com/ndiego/editor-curation-examples/tree/main/includes/examples/global-styles-filters' )
			),
			'id'    => 'ece-global-styles-filters-php',
		)
	);

	add_settings_section(
		'editor_curation_examples_disable_blocks',
		__( 'Disable blocks', 'editor-curation-examples' ),
		function() { 
			echo __( 'Disable blocks in the Editor using different methods. For best results, only enable one at a time.', 'editor-curation-examples' ); 
		},
		'editor-curation-examples'
	);

	add_settings_field(
		'ece-disable-blocks-allow-list-global-php',
		__( 'Global allow list (PHP)', 'editor-curation-examples' ),
		'ece_display_example_field',
		'editor-curation-examples',
		'editor_curation_examples_disable_blocks',
		array(
			'label' => sprintf(
				__( 'Disable block globally using an allow list in PHP. <a href="%s" target="_blank">View source code</a>.', 'editor-curation-examples' ),
				esc_url( 'https://github.com/ndiego/editor-curation-examples/tree/main/includes/examples/disable-blocks/allow-list.php' )
			),
			'id'    => 'ece-disable-blocks-allow-list-global-php',
		)
	);

	add_settings_field(
		'ece-disable-blocks-allow-list-local-php',
		__( 'Local allow list (PHP)', 'editor-curation-examples' ),
		'ece_display_example_field',
		'editor-curation-examples',
		'editor_curation_examples_disable_blocks',
		array(
			'label' => sprintf(
				__( 'Disable block for specific users and post types using an allow list in PHP. <a href="%s" target="_blank">View source code</a>.', 'editor-curation-examples' ),
				esc_url( 'https://github.com/ndiego/editor-curation-examples/tree/main/includes/examples/disable-blocks/allow-list.php' )
			),
			'id'    => 'ece-disable-blocks-allow-list-local-php',
		)
	);

	add_settings_field(
		'ece-disable-blocks-disallow-list-local-php',
		__( 'Local disallow list (PHP)', 'editor-curation-examples' ),
		'ece_display_example_field',
		'editor-curation-examples',
		'editor_curation_examples_disable_blocks',
		array(
			'label' => sprintf(
				__( 'Disable block for specific users and post types using a disallow list in PHP. <a href="%s" target="_blank">View source code</a>.', 'editor-curation-examples' ),
				esc_url( 'https://github.com/ndiego/editor-curation-examples/tree/main/includes/examples/disable-blocks/allow-list.php' )
			),
			'id'    => 'ece-disable-blocks-disallow-list-local-php',
		)
	);

	add_settings_field(
		'ece-disable-blocks-allow-list-global-js',
		__( 'Global allow list (JS)', 'editor-curation-examples' ),
		'ece_display_example_field',
		'editor-curation-examples',
		'editor_curation_examples_disable_blocks',
		array(
			'label' => sprintf(
				__( 'Disable block globally using an allow list in JavaScript. <a href="%s" target="_blank">View source code</a>.', 'editor-curation-examples' ),
				esc_url( 'https://github.com/ndiego/editor-curation-examples/tree/main/src/examples/disable-blocks/allow-list.js' )
			),
			'id'    => 'ece-disable-blocks-allow-list-global-js',
		)
	);

	add_settings_field(
		'ece-disable-blocks-allow-list-local-js',
		__( 'Local allow list (JS)', 'editor-curation-examples' ),
		'ece_display_example_field',
		'editor-curation-examples',
		'editor_curation_examples_disable_blocks',
		array(
			'label' => sprintf(
				__( 'Disable block for specific users and post types using an allow list in JavaScript. <a href="%s" target="_blank">View source code</a>.', 'editor-curation-examples' ),
				esc_url( 'https://github.com/ndiego/editor-curation-examples/tree/main/src/examples/disable-blocks/allow-list.js' )
			),
			'id'    => 'ece-disable-blocks-allow-list-local-js',
		)
	);

	add_settings_field(
		'ece-disable-blocks-disallow-list-local-js',
		__( 'Local disallow list (JS)', 'editor-curation-examples' ),
		'ece_display_example_field',
		'editor-curation-examples',
		'editor_curation_examples_disable_blocks',
		array(
			'label' => sprintf(
				__( 'Disable block for specific users and post types using a disallow list in JavaScript. <a href="%s" target="_blank">View source code</a>.', 'editor-curation-examples' ),
				esc_url( 'https://github.com/ndiego/editor-curation-examples/tree/main/src/examples/disable-blocks/allow-list.js' )
			),
			'id'    => 'ece-disable-blocks-disallow-list-local-js',
		)
	);

	add_settings_section(
		'editor_curation_examples_block_styles_variations',
		__( 'Block Styles & Variations', 'editor-curation-examples' ),
		null,
		'editor-curation-examples'
	);

	add_settings_field(
		'ece-block-styles',
		__( 'Block Styles (JS)', 'editor-curation-examples' ),
		'ece_display_example_field',
		'editor-curation-examples',
		'editor_curation_examples_block_styles_variations',
		array(
			'label' => sprintf(
				__( 'Globally unregister selected block styles in JavaScript. <a href="%s" target="_blank">View source code</a>.', 'editor-curation-examples' ),
				esc_url( 'https://github.com/ndiego/editor-curation-examples/tree/main/src/examples/block-styles/index.js' )
			),
			'id'    => 'ece-block-styles',
		)
	);

	add_settings_field(
		'ece-block-variations',
		__( 'Block Variations (JS)', 'editor-curation-examples' ),
		'ece_display_example_field',
		'editor-curation-examples',
		'editor_curation_examples_block_styles_variations',
		array(
			'label' => sprintf(
				__( 'Globally unregister selected block variations in JavaScript. <a href="%s" target="_blank">View source code</a>.', 'editor-curation-examples' ),
				esc_url( 'https://github.com/ndiego/editor-curation-examples/tree/main/src/examples/block-variations/index.js' )
			),
			'id'    => 'ece-block-variations',
		)
	);

	add_settings_section(
		'editor_curation_examples_misc',
		__( 'Miscellaneous', 'editor-curation-examples' ),
		null,
		'editor-curation-examples'
	);

	add_settings_field(
		'ece-misc-disable-block-directory',
		__( 'Block Directory (PHP)', 'editor-curation-examples' ),
		'ece_display_example_field',
		'editor-curation-examples',
		'editor_curation_examples_misc',
		array(
			'label' => sprintf(
				__( 'Globally disable the Block Directory. <a href="%s" target="_blank">View source code</a>.', 'editor-curation-examples' ),
				esc_url( 'https://github.com/ndiego/editor-curation-examples/tree/main/src/examples/misc-curations.php' )
			),
			'id'    => 'ece-misc-disable-block-directory',
		)
	);

	add_settings_field(
		'ece-misc-disable-pattern-directory',
		__( 'Pattern Directory (PHP)', 'editor-curation-examples' ),
		'ece_display_example_field',
		'editor-curation-examples',
		'editor_curation_examples_misc',
		array(
			'label' => sprintf(
				__( 'Globally disable the Pattern Directory. <a href="%s" target="_blank">View source code</a>.', 'editor-curation-examples' ),
				esc_url( 'https://github.com/ndiego/editor-curation-examples/tree/main/src/examples/misc-curations.php' )
			),
			'id'    => 'ece-misc-disable-pattern-directory',
		)
	);

	// add_settings_field(
	// 	'ece-misc-curations-js',
	// 	__( 'Misc curations (JS)', 'editor-curation-examples' ),
	// 	'ece_display_example_field',
	// 	'editor-curation-examples',
	// 	'editor_curation_examples_misc',
	// 	array(
	// 		'label' => sprintf(
	// 			__( 'Enable miscellaneous JavaScript curation techniques. Examples include disabling block types, block styles, block variations, and more. <a href="%s" target="_blank">View source code</a>.', 'editor-curation-examples' ),
	// 			esc_url( 'https://github.com/ndiego/editor-curation-examples/tree/main/src/examples/misc-curations.js' )
	// 		),
	// 		'id'    => 'ece-misc-curations-js',
	// 	)
	// );

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
