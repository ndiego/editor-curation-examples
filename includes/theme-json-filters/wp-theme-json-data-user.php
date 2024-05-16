<?php

/**
 * This function modifies the theme JSON data by disabling color settings
 * for all users and then specifically enabling settings for users with the 
 * capability to edit_theme_options (Administrators).
 *
 * @param object $theme_json The original theme JSON data.
 * @return object The modified theme JSON data.
 */
function ece_restrict_color_settings_to_administrators( $theme_json ) {

	// First disable color settings for everyone. This will override
	// any settings that might have been supplied by the theme.
	$default_settings = array(
		'version'  => 2,
		'settings' => array(
			'color' => array(
				'text'       => false,
				'background' => false,
				'link'       => false,
			),
		),
	);

	$theme_json->update_with( $default_settings );

	// If the current user has the correct permissions, enable color settings.
	if ( current_user_can( 'edit_theme_options' ) ) {
		$administrator_settings = array(
			'version'  => 2,
			'settings' => array(
				'color' => array(
					'text'       => true,
					'background' => true,
					'link'       => true,
				),
			),
		);

		$theme_json->update_with( $administrator_settings );
	}

	// Return the modified theme JSON data.
	return $theme_json;
}

// For the filter to work properly, it must be run after theme setup.
function ece_apply_theme_json_user_filters() {

	// Check to make sure the theme has a theme.json file.
	if ( wp_theme_has_theme_json() ) {
		add_filter( 'wp_theme_json_data_user', 'ece_restrict_color_settings_to_administrators' );
	}
}
add_action( 'after_setup_theme', 'ece_apply_theme_json_user_filters' );