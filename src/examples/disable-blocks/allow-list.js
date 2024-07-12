/**
 * Globally restrict allowed blocks in the Editor.
 */
function restrictAllowedBlocks() {
	const allowedBlocksTypes = [
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
		'core/missing', // Displayed when a block type is no longer registered.
		'core/paragraph',
		'core/spacer',
	];

	// Get all block types.
	const allBlockTypes = wp.blocks.getBlockTypes();

	// Unregister all blocks not in the allow list.
	allBlockTypes.getBlockTypes().forEach( function ( blockType ) {
		if ( allowedBlocksTypes.indexOf( blockType.name ) === -1 ) {
			wp.blocks.unregisterBlockType( blockType.name );
		}
	} );
}

wp.domReady( function () {
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
wp.plugins.registerPlugin(
	'editor-curation-examples-allow-blocks-by-post-type-and-user-permissions',
	{
		render: () => {
			if ( ! window.enableAllowListLocal ) {
				return null;
			}

			// Restrict blocks to the following list.
			const allowedBlocksTypes = [
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
				'core/missing', // Displayed when a block type is no longer registered.
				'core/paragraph',
				'core/spacer',
			];

			// Check user permissions and get the current post type.
			const canUserUpdateSettings = wp.data
				.select( 'core' )
				.canUser( 'update', 'settings' );
			const currentPostType = wp.data
				.select( 'core/editor' )
				.getCurrentPostType();

			// Ensure the value is actually defined.
			if ( canUserUpdateSettings === undefined ) {
				return null;
			}

			// Get all block types.
			const allBlockTypes = wp.blocks.getBlockTypes();

			// Unregister all blocks but the allow list if the user is not an Administrator
			// and the current post type is 'post'.
			if ( ! canUserUpdateSettings && currentPostType === 'post' ) {
				allBlockTypes.forEach( function( blockType ) {
					if ( allowedBlocksTypes.indexOf( blockType.name ) === -1 ) {
						wp.blocks.unregisterBlockType( blockType.name );
					}
				} );
			}

			return null;
		},
	}
);
