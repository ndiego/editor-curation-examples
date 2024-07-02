/**
 * WordPress dependencies
 */
import { addFilter } from '@wordpress/hooks';

/**
 * Adds border support to Column, Heading, and Paragraph blocks.
 *
 * @see https://nickdiego.com/how-to-modify-block-supports-using-client-side-filters/
 *
 * @param {Object} settings - The original block settings.
 * @param {string} name     - The name of the block.
 *
 * @return {Object} The modified block settings with added border support.
 */
function addBorderSupport( settings, name ) {
	// Bail if the examples are not enabled.
	if ( ! window.enableBlockFilters ) {
		return settings;
	}

	// Bail early if the block does not have supports.
	if ( ! settings?.supports ) {
		return settings;
	}

	// Only apply to Column, Heading, and Paragraph blocks.
	if (
		name === 'core/column' ||
		name === 'core/heading' ||
		name === 'core/paragraph'
	) {
		return Object.assign( {}, settings, {
			supports: Object.assign( settings.supports, {
				__experimentalBorder: {
					color: true,
					style: true,
					width: true,
					radius: true,
					__experimentalDefaultControls: {
						color: false,
						style: false,
						width: false,
						radius: false,
					},
				},
			} ),
		} );
	}

	return settings;
}

addFilter(
	'blocks.registerBlockType',
	'modify-block-supports/add-border-support',
	addBorderSupport
);

/**
 * Modifies the default typography settings for blocks with typography support.
 *
 * @see https://nickdiego.com/how-to-modify-block-supports-using-client-side-filters/
 *
 * @param {Object} settings - The original block settings.
 *
 * @return {Object} The modified block settings with updated typography defaults.
 */
function modifyTypographyDefaults( settings ) {
	// Bail if the examples are not enabled.
	if ( ! window.enableBlockFilters ) {
		return settings;
	}

	// Only apply to blocks with typography support.
	if ( settings?.supports?.typography ) {
		return Object.assign( {}, settings, {
			supports: Object.assign( settings.supports, {
				typography: Object.assign( settings.supports.typography, {
					__experimentalDefaultControls: {
						fontAppearance: true,
						fontSize: true,
					},
				} ),
			} ),
		} );
	}

	return settings;
}

addFilter(
	'blocks.registerBlockType',
	'modify-block-supports/modify-typography-defaults',
	modifyTypographyDefaults
);
