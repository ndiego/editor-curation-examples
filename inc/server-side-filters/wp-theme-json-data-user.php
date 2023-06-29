<?php

/**
 * This function modifies the theme JSON data disabling all color settings
 * and then renabling settings for Administrators.
 *
 * @param object $theme_json The original theme JSON data.
 * @return object The modified theme JSON data.
 */
function enable_color_settings_for_administrators( $theme_json ){

    // First disable color settings for everyone. 
    // This will override any theme settings.
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

    // Get the roles of the current user.
	$current_user = wp_get_current_user();
    $user_roles   = $current_user->roles;

    // If the current user is an administrator, enable color settings.
    if ( in_array( 'administrator', $user_roles ) ) {
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
function apply_theme_json_user_filters() {

	// Check to make sure the theme has a theme.json file.
	if ( wp_theme_has_theme_json() ) {
		add_filter( 'wp_theme_json_data_theme', __NAMESPACE__ . '\enable_color_settings_for_administrators' );
	}
}
add_action( 'after_setup_theme', __NAMESPACE__ . '\apply_theme_json_user_filters' );