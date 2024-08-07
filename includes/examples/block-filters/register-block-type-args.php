<?php
/**
 * Add curation examples the utilize 'register_block_type_args' filter.
 * 
 * @see https://developer.wordpress.org/reference/hooks/register_block_type_args/
 *
 * @package EditorCurationExamples
 */

/**
 * Modify Paragraph blocks.
 *
 * @param array  $args       The block type args.
 * @param string $block_type The block type.
 * @return array             The modified block type args.
 */
function ece_modify_paragraph_blocks( $args, $block_type ) {
	
	if ( 'core/paragraph' !== $block_type ) {
		return $args;
	}
	
	// General properties.
	$args['description'] = 'Just a standard paragraph block.';
	
	// Block attributes.
	$args['attributes']['placeholder']['default'] = 'Start writing!';
	
	// Block supports.
	$args['supports']['color']['background'] = false;
	$args['supports']['color']['gradients']  = false;
	$args['supports']['color']['__experimentalDefaultControls']['link'] = true;

	return $args;
}
add_filter( 'register_block_type_args', 'ece_modify_paragraph_blocks', 10, 2 );

/**
 * Enable duotone for Media & Text blocks.
 *
 * @param array  $args       The block type args.
 * @param string $block_type The block type.
 * @return array             The modified block type args.
 */
function ece_enable_duotone_to_media_text_blocks( $args, $block_type ) {
	
	// Only apply the filter to Media & Text blocks.
	if ( 'core/media-text' !== $block_type ) {
		return $args;
	}

	$args['supports'] ??= [];
	$args['supports']['filter'] ??= [];
	$args['supports']['filter']['duotone'] = true;

	$args['selectors'] ??= [];
	$args['selectors']['filter'] ??= [];
	$args['selectors']['filter']['duotone'] = '.wp-block-media-text .wp-block-media-text__media';

	return $args;
}
add_filter( 'register_block_type_args', 'ece_enable_duotone_to_media_text_blocks', 10, 2 );