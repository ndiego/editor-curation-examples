/**
 * Globally restrict allowed blocks in the Editor.
 */
function restrictAllowedBlocks() {
	const allowedBlocks = [
		'core/block',
		'core/button',
		'core/buttons',
		'core/code',
		'core/column',
		'core/columns',
		'core/cover',
		'core/gallery',
		'core/group',
		'core/heading',
		'core/image',
		'core/list',
		'core/list-item',
		'core/missing', // Needed for when a post contains a block type that is no longer supported.
		'core/paragraph',
		'core/spacer',
	];

    wp.blocks.getBlockTypes().forEach( function ( blockType ) {
        if ( allowedBlocks.indexOf( blockType.name ) === -1 ) {
            wp.blocks.unregisterBlockType( blockType.name );
        }
    } );
}

wp.domReady( function() {
	if ( window.enableAllowListGlobal ) {
		restrictAllowedBlocks();
	}
} );

/**
 * Restrict blocks by post type and user permissions in the block editor.
 *
 * This function registers a plugin that restricts the available blocks in the block editor
 * based on user permissions and the current post type. It ensures that only a specified
 * list of blocks is available when editing a 'post' and the user does not have permissions
 * to update settings.
 * 
 * @return null We don't actually render anything.
 */
wp.plugins.registerPlugin( 'editor-curation-examples-allow-blocks-by-post-type-and-user-permissions', {
	render: () => {

        if ( ! window.enableAllowListLocal ) {
            return null;
        }

        // Restrict blocks to the following list.
        const allowedBlocks = [
            'core/block',
            'core/button',
            'core/buttons',
            'core/code',
            'core/column',
            'core/columns',
            'core/cover',
            'core/gallery',
            'core/group',
            'core/heading',
            'core/image',
            'core/list',
            'core/list-item',
            'core/missing', // Needed for when a post contains a block type that is no longer supported.
            'core/paragraph',
            'core/spacer',
        ];

        // Check user permissions and get the current post type.
        const canUserUpdateSettings = wp.data.select( 'core' ).canUser( 'update', 'settings' );
        const currentPostType = wp.data.select( 'core/editor' ).getCurrentPostType();
        
        // Ensure the values are actually defined.
        if ( canUserUpdateSettings === undefined || currentPostType === undefined ) {
            return null;
        }

        // Unregister all blocks but the allow list if the user is not an Administrator  
        // and the current post type is 'post'.
        if ( ! canUserUpdateSettings && currentPostType === 'post' ) {
            wp.blocks.getBlockTypes().forEach( function ( blockType ) {
                if ( allowedBlocks.indexOf( blockType.name ) === -1 ) {
                    wp.blocks.unregisterBlockType( blockType.name );
                }
            } );
        }
    
        return null;
    },
} );