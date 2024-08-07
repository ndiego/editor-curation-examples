/**
 * Unregister Image block styles.
 */
function unregisterImageBlockStyles() {
	wp.blocks.unregisterBlockStyle( 'core/image', [ 'rounded' ] );
}

wp.domReady( () => {
	// Only run if examples are enabled.
	if ( window.enableBlockStyles ) {
		unregisterImageBlockStyles()
	}
} );
