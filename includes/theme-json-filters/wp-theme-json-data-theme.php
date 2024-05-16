<?php
/**
 * This function modifies the theme JSON data by updating the theme's color
 * palette based on the user's login status.
 *
 * @param object $theme_json The original theme JSON data.
 * @return object The modified theme JSON data.
 */
function ece_modify_color_palette_if_logged_in( $theme_json ) {
	if ( is_user_logged_in() ) {
		$new_data = array(
			'version'  => 2,
			'settings' => array(
				'color' => array(
					'palette' => array(
						array(
							'color' => '#ffffff',
							'name'  => __( 'Base' ),
							'slug'  => 'base',
						),
						array(
							'color' => '#00131C',
							'name'  => __( 'Contrast' ),
							'slug'  => 'contrast',
						),
						array(
							'color' => '#3858E9',
							'name'  => __( 'Primary' ),
							'slug'  => 'primary',
						),
						array(
							'color' => '#1D35B4',
							'name'  => __( 'Secondary' ),
							'slug'  => 'secondary',
						),
						array(
							'color' => '#ECF6FA',
							'name'  => __( 'Tertiary' ),
							'slug'  => 'tertiary',
						),
					),
				),
				'custom' => array(
					'myCustomVar' => 'this-is-custom',
				),
			),
			'styles'  => array(
				'elements' => array(
					'button' => array(
						'color' => array(
							'background' => 'var(--wp--preset--color--primary)',
							'text'       => 'var(--wp--preset--color--base)',
						),
					),
				),
			),
		);

		// Return the modified theme JSON data.
		return $theme_json->update_with( $new_data );
	}

	// Return the original theme JSON data.
	return $theme_json;
}

/**
 * This function modifies the theme JSON data by creating a custom
 * CSS variables for various breakpoints.
 *
 * @param object $theme_json The original theme JSON data.
 * @return object The modified theme JSON data.
 */
function ece_create_breakpoint_variables( $theme_json ) {

	$new_data = array(
		'version'  => 2,
		'settings' => array(
			'custom' => array(
				'breakpoint' => array(
					'small'  => '360px',
					'medium' => '780px',
					'large'  => '1080px',
				),
			),
		),
	);

	// Return the modified theme JSON data.
	return $theme_json->update_with( $new_data );
}

// For the filter to work properly, it must be run after theme setup.
function ece_apply_theme_json_theme_filters() {

	// Check to make sure the theme has a theme.json file.
	if ( wp_theme_has_theme_json() ) {
		add_filter( 'wp_theme_json_data_theme', 'ece_modify_color_palette_if_logged_in' );
		add_filter( 'wp_theme_json_data_theme', 'ece_create_breakpoint_variables' );
	}
}
add_action( 'after_setup_theme', 'ece_apply_theme_json_theme_filters' );