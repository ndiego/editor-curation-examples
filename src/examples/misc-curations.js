/**
 * WordPress dependencies
 */
import domReady from '@wordpress/dom-ready';
import { getBlockTypes, unregisterBlockType } from '@wordpress/blocks';

/**
 * Restrict allowed blocks in the Editor.
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

	getBlockTypes().forEach( function ( blockType ) {
		if ( allowedBlocks.indexOf( blockType.name ) === -1 ) {
			unregisterBlockType( blockType.name );
		}
	} );
}

domReady( function () {
	// Bail if the examples are not enabled.
	if ( window.enableMiscCurations ) {
		restrictAllowedBlocks();
	}
} );
