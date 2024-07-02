/**
 * WordPress dependencies
 */
import domReady from '@wordpress/dom-ready';
import { unregisterBlockStyle } from '@wordpress/blocks';

domReady( function () {
	// Only execute if the Notes Demo is enabled and you are editing a 'note'.
	if ( window.enableNotesDemo && 'note' === pagenow ) {
		// Provided by Core.
		unregisterBlockStyle( 'core/image', [ 'default', 'rounded' ] );

		// Provided by Twenty Twenty-Four.
		unregisterBlockStyle( 'core/list', [ 'default', 'checkmark' ] );
		unregisterBlockStyle( 'core/heading', [ 'default', 'asterisk' ] );
	}
} );
