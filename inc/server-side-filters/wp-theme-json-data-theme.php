<?php

/**
 * This function modifies the theme JSON data by adding or updating the color palette
 * based on the user's login status.
 *
 * @param object $theme_json The original theme JSON data.
 * @return object The modified theme JSON data.
 */
function filter_theme_json_data_theme( $theme_json ){
	if ( is_user_logged_in() ) {
		$new_data = array(
			'version'  => 2,
			'settings' => array(
				'color' => array(
					'text'       => false,
					'palette'    => array(
						array(
							'slug'  => 'base',
							'color' => 'yellow',
							'name'  => __( 'Base', 'theme-domain' ),
						),
						array(
							'slug'  => 'contrast',
							'color' => 'blue',
							'name'  => __( 'Contrast', 'theme-domain' ),
						),
					),
				),
			),
		);
	
		// Return the original theme JSON data if user is not logged in.
		return $theme_json->update_with( $new_data );
	}

	return $theme_json;
}

// For the filter to work properly, it must be run after theme setup.
function apply_theme_json_filters() {

	// Check to make sure the theme has a theme.json file.
	if ( wp_theme_has_theme_json() ) {
		add_filter( 'wp_theme_json_data_theme', __NAMESPACE__ . '\filter_theme_json_data_theme' );
	}
}
add_action( 'after_setup_theme', __NAMESPACE__ . '\apply_theme_json_filters' );