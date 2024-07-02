/**
 * Plugin to customize the block editor for the 'note' post type in the Editor Curation Examples demo.
 *
 * This plugin conditionally unregisters specific block styles for the 'note' post type when the 
 * global `enableNotesDemo` flag is enabled. It ensures that the current post type is 'note' 
 * and that the necessary values are defined before unregistering the block styles.
 *
 * @return null We don't actually render anything.
 */
wp.plugins.registerPlugin( 'editor-curation-examples-notes-demo', {
	render: () => {

        if ( ! window.enableNotesDemo ) {
            return null;
        }

        // Get the current post type.
        const currentPostType = wp.data.select( 'core/editor' ).getCurrentPostType();

        // Unregister block styles if the current post type is 'note'.
        if ( currentPostType === 'note' ) {
			// Provided by Core.
			wp.blocks.unregisterBlockStyle( 'core/image', [ 'default', 'rounded' ] );

			// Provided by Twenty Twenty-Four.
			wp.blocks.unregisterBlockStyle( 'core/list', [ 'default', 'checkmark' ] );
			wp.blocks.unregisterBlockStyle( 'core/heading', [ 'default', 'asterisk' ] );
        }
    
        return null;
    },
} );