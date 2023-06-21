import { select } from '@wordpress/data';
import { addFilter } from '@wordpress/hooks';

/**
 * Restrict the spacing options for Column blocks to pixels.
 *
 * @param {any}    settingValue The current value of the block setting.
 * @param {string} settingName  The name of the block setting to modify.
 * @param {string} clientId     The unique identifier for the block in the client.
 * @param {string} blockName    The name of the block type.
 * @return {any} Returns the modified setting value or the original setting value.
 */
function restrictColumnSpacingSettings(
	settingValue,
	settingName,
	clientId,
	blockName
) {
	if ( blockName === 'core/column' && settingName === 'spacing.units' ) {
		return [ 'px' ];
	}
	return settingValue;
}

addFilter(
    'blockEditor.useSetting.before',
    'editor-curation-examples/useSetting.before/column-spacing',
	restrictColumnSpacingSettings
);

/**
 * If a 'core/heading' is an H3-H6, disable most typography settings and
 * restrict the available font sizes.
 *
 * @param {any}    settingValue The current value of the block setting.
 * @param {string} settingName  The name of the block setting to modify.
 * @param {string} clientId     The unique identifier for the block in the client.
 * @param {string} blockName    The name of the block type.
 * @return {any} Returns the modified setting value or the original setting value.
 */
function restrictHeadingTypographySettings(
	settingValue,
	settingName,
	clientId,
	blockName
) {
	if ( blockName === 'core/heading' ) {
		const { getBlockAttributes } = select( 'core/block-editor' );

		// Determine the level of the block based on its client id.
		const headingLevel = getBlockAttributes( clientId )?.level ?? 0;

		// Modify these block settings.
		const modifiedBlockSettings = {
			'typography.customFontSize': false,
			'typography.fontStyle': false,
			'typography.fontWeight': false,
			'typography.letterSpacing': false,
			'typography.lineHeight': false,
			'typography.textDecoration': false,
			'typography.textTransform': false,
			'typography.fontSizes': [
				{
					fluid: {
						min: '1rem',
						max: '1.125rem',
					},
					size: '1.125rem',
					slug: 'medium',
				},
				{
					fluid: {
						min: '1.75rem',
						max: '1.875rem',
					},
					size: '1.75rem',
					slug: 'large',
				},
				{
					fluid: false,
					size: '2.25rem',
					slug: 'x-large',
				},
			],
			// Add additional block settings here.
		};

		// Only apply setting modifications to H3-H6.
		if (
			headingLevel >= 3 &&
			modifiedBlockSettings.hasOwnProperty( settingName )
		) {
			return modifiedBlockSettings[ settingName ];
		}
	}

	return settingValue;
}

addFilter(
	'blockEditor.useSetting.before',
	'editor-curation-examples/useSetting.before/heading-typography',
	restrictHeadingTypographySettings
);

/**
 * If the user doesn't have permission to update settings (Editors,
 * Authors, etc.), disable the specified block settings when editing
 * the specified post types.
 *
 * @param {any}    settingValue The current value of the block setting.
 * @param {string} settingName  The name of the block setting to modify.
 * @param {string} clientId     The unique identifier for the block in the client.
 * @param {string} blockName    The name of the block type.
 * @return {any} Returns the modified setting value or the original setting value.
 */
function restrictBlockSettingsByUserPermissionsAndPostType(
	settingValue,
	settingName,
	clientId,
	blockName
) {
	const { canUser } = select( 'core' );
	const { getCurrentPostType } = select( 'core/editor' );

	// Check user permissions and get the current post type.
	const canUserUpdateSettings = canUser( 'update', 'settings' );
	const currentPostType = getCurrentPostType();

	// Disable block settings on these post types.
	const disabledPostTypes = [
		'post',
		// Add additional post types here.
	];

	// Disable these block settings.
	const disabledBlockSettings = [
		'border.color',
		'border.radius',
		'border.style',
		'border.width',
		// Add additional block settings here.
	];

	if (
		! canUserUpdateSettings &&
		disabledPostTypes.includes( currentPostType ) &&
		disabledBlockSettings.includes( settingName )
	) {
		return false;
	}

	return settingValue;
}

addFilter(
	'blockEditor.useSetting.before',
	'editor-curation-examples/useSetting.before/user-permissions-and-post-type',
	restrictBlockSettingsByUserPermissionsAndPostType
);

/**
 * If a 'core/button' block is within a 'core/cover' block, update the
 * color palette to only include 'Base" and 'Contrast'. Also disable custom
 * colors and gradients.
 *
 * @param {any}    settingValue The current value of the block setting.
 * @param {string} settingName  The name of the block setting to modify.
 * @param {string} clientId     The unique identifier for the block in the client.
 * @param {string} blockName    The name of the block type.
 * @return {any} Returns the modified setting value or the original setting value.
 */
function restrictButtonBlockSettingsByLocation(
	settingValue,
	settingName,
	clientId,
	blockName
) {
	if ( blockName === 'core/button' ) {
		const { getBlockParents, getBlockName } = select( 'core/block-editor' );

		// Get the block's parents and see if one is a 'core/cover' block.
		const blockParents = getBlockParents( clientId, true );
		const inCover = blockParents.some(
			( parentId ) => getBlockName( parentId ) === 'core/cover'
		);

		// Modify these block settings.
		const modifiedBlockSettings = {
			'color.custom': false,
			'color.customGradient': false,
			'color.defaultGradients': false,
			'color.defaultPalette': false,
			'color.gradients.theme': [],
			'color.palette.theme': [
				{
					color: '#ffffff',
					name: 'Base',
					slug: 'base',
				},
				{
					color: '#000000',
					name: 'Contrast',
					slug: 'contrast',
				},
			],
			// Add additional block settings here.
		};

		if ( inCover && modifiedBlockSettings.hasOwnProperty( settingName ) ) {
			return modifiedBlockSettings[ settingName ];
		}
	}

	return settingValue;
}

addFilter(
	'blockEditor.useSetting.before',
	'editor-curation-examples/useSetting.before/button-location',
	restrictButtonBlockSettingsByLocation
);
