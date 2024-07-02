/**
 * Plugin to customize the block editor for the 'note' post type in the Editor Curation Examples demo.
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

        if ( currentPostType === 'note' ) {
			// Unregister Core block styles.
			wp.blocks.unregisterBlockStyle( 'core/image', [ 'default', 'rounded' ] );

			// Unregister Twenty Twenty-Four block styles.
			wp.blocks.unregisterBlockStyle( 'core/list', [ 'default', 'checkmark' ] );
			wp.blocks.unregisterBlockStyle( 'core/heading', [ 'default', 'asterisk' ] );

			// Disable specific RichText formatting options.
			wp.richText.unregisterFormatType( 'core/image' );
			wp.richText.unregisterFormatType( 'core/language' );
			wp.richText.unregisterFormatType( 'core/keyboard' );
			wp.richText.unregisterFormatType( 'core/subscript' );
			wp.richText.unregisterFormatType( 'core/superscript' );
        }
    
        return null;
    },
} );