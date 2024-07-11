/**
 * Unregister all Social Link block variations except for the provided list.
 */
function unregisterSocialLinkVariations() {
	const allowedVariations = [
		'wordpress',
		'facebook',
		'x',
		'linkedin',
		'github',
		'gravatar',
	];

	// Get all Social Link block variations.
	const allVariations = wp.data.select( 'core/blocks' ).getBlockVariations( 'core/social-link' );

	allVariations.forEach( function ( variation ) {
		if ( allowedVariations.indexOf( variation.name ) === -1 ) {
			wp.blocks.unregisterBlockVariation( 'core/social-link', variation.name );
		}
	} );
}

/**
 * Unregister selected Embed block variations.
 */
function unregisterEmbedBlockVariations() {
	const disallowedVariations = [
		'animoto',
		'dailymotion',
		'hulu',
		'reddit',
		'tumblr',
		'vine',
		'amazon-kindle',
		'cloudup',
		'crowdsignal',
		'speaker',
		'scribd',
	];

	disallowedVariations.forEach( ( variation ) => {
		wp.blocks.unregisterBlockVariation( 'core/embed', variation );
	} );
}

wp.domReady( () => {
	// Only run if examples are enabled.
	if ( window.enableBlockVariations ) {
		unregisterSocialLinkVariations();
		unregisterEmbedBlockVariations();
	}
} );