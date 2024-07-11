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
		const currentPostType = wp.data
			.select( 'core/editor' )
			.getCurrentPostType();

		if ( currentPostType === 'note' ) {
			// Unregister Core block styles.
			wp.blocks.unregisterBlockStyle( 'core/image', [
				'default',
				'rounded',
			] );

			// Unregister Twenty Twenty-Four block styles.
			wp.blocks.unregisterBlockStyle( 'core/list', [
				'default',
				'checkmark',
			] );
			wp.blocks.unregisterBlockStyle( 'core/heading', [
				'default',
				'asterisk',
			] );

			// Disable specific RichText formatting options.
			const formatsToUnregister = [
				'core/image',
				'core/language',
				'core/keyboard',
				'core/subscript',
				'core/superscript',
			];

			formatsToUnregister.forEach( function ( format ) {
				wp.richText.unregisterFormatType( format );
			} );
		}

		return null;
	},
} );
