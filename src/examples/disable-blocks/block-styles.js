/**
 * Unregister Image block styles.
 */
wp.domReady( function() {
    wp.blocks.unregisterBlockStyle( 'core/image', [ 'default', 'rounded' ] );
} );
