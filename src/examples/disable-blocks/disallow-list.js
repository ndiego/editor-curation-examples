
/**
 * Plugin to disallow specific blocks by post type in the block editor.
 *
 * This plugin disables certain blocks in the block editor when editing posts of a specific post type.
 * Specifically, it unregisters the blocks in the `disallowedBlocks` array when the current post type is 'post'.
 *
 * @return null We don't actually render anything.
 */
wp.plugins.registerPlugin( 'editor-curation-examples-disallow-blocks-by-post-type', {
	render: () => {

        if ( ! window.enableDisallowListLocal ) {
            return null;
        }

        // Disable blocks in the following list.
        const disallowedBlocks = [
    		'core/navigation',
    		'core/query',
	    ];

        // Get the current post type.
        const currentPostType = wp.data.select( 'core/editor' ).getCurrentPostType();
        
        // Ensure the values are actually defined.
        if ( currentPostType === undefined ) {
            return null;
        }

        // Unregister the disallowed blocks if the current post type is 'post'.
        if ( currentPostType === 'post' ) {
            disallowedBlocks.forEach( function( blockType ) {
                wp.blocks.unregisterBlockType( blockType );
            } );
        }
    
        return null;
    },
} );