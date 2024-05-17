<?php
/**
 * Disable background color and gradient support for Heading blocks.
 *
 * @param array $metadata The block type metadata.
 * @return array          The modified block type metadata.
 */
function ece_disable_heading_background_color_and_gradients( $metadata ) {
    
    // Only apply the filter to Heading blocks.
    if ( ! isset( $metadata['name'] ) || 'core/heading' !== $metadata['name'] ) {
        return $metadata;
    }

    // Check if 'supports' key exists.
    if ( isset( $metadata['supports'] ) && isset( $metadata['supports']['color'] ) ) {
        
        // Remove Background color and Gradients support.
        $metadata['supports']['color']['background'] = false;
        $metadata['supports']['color']['gradients']  = false;
    }

    return $metadata;
}
add_filter( 'block_type_metadata', 'ece_disable_heading_background_color_and_gradients' );

/**
 * Add a border support to a group of allowed blocks.
 *
 * @param array $metadata The block type metadata.
 * @return array          The modified block type metadata.
 */
function ece_add_border_support_to_allowed_blocks( $metadata ) {

    $allowed_blocks = array( 
        'core/heading',
        'core/paragraph',
        'core/column',
    );

    // Only apply the filter to allowed blocks.
    if ( ! isset( $metadata['name'] ) || ! in_array( $metadata['name'], $allowed_blocks ) ) {
        return $metadata;
    }

    // Add border support.
    $metadata['supports']['__experimentalBorder'] = array(
        'color'  => true,
        'style'  => true,
        'width'  => true,
        'radius' => true,
    );

    // Set default controls for border.
    $metadata['supports']['__experimentalBorder']['__experimentalDefaultControls'] = array(
        'color'  => false,
        'style'  => false,
        'width'  => false,
        'radius' => true,
    );

    return $metadata;
}
add_filter( 'block_type_metadata', 'ece_add_border_support_to_allowed_blocks' );

/**
 * Disable default spacing controls for File blocks.
 *
 * @param array $metadata The block type metadata.
 * @return array          The modified block type metadata.
 */
function ece_disable_spacing_default_controls_for_file_blocks( $metadata ) {

    // Only apply the filter to File blocks.
    if ( ! isset( $metadata['name'] ) || 'core/file' !== $metadata['name'] ) {
        return $metadata;
    }
    
    // Disable default controls for spacing.
    $metadata['supports']['spacing']['__experimentalDefaultControls'] = array(
        'margin'  => false,
        'padding' => false,
    );

    return $metadata;
}
add_filter( 'block_type_metadata', 'ece_disable_spacing_default_controls_for_file_blocks' );

/**
 * Add a group of allowed blocks to the new custom Featured category.
 *
 * @param array $metadata The block type metadata.
 * @return array          The modified block type metadata.
 */
function ece_add_allowed_blocks_to_featured_category( $metadata ) {

    $allowed_blocks = array( 
        'core/heading',
        'core/paragraph',
        'core/list',
        'core/image',
        'core/buttons',
    );
    
    // Only apply the filter to allowed blocks.
    if ( ! isset( $metadata['name'] ) || ! in_array( $metadata['name'], $allowed_blocks ) ) {
        return $metadata;
    }

    // Add the Heading block to the Featured category.
    return array_merge(
        $metadata,
        array( 'category' => 'featured' )
    );
}
add_filter( 'block_type_metadata', 'ece_add_allowed_blocks_to_featured_category' );

/**
 * Adds a new custom block category at the beginning of the block categories array.
 *
 * @param array $categories The existing array of block categories.
 * @return array            The modified array of block categories.
 */
function ece_register_featured_block_category( $categories ) {
    
    // Define the Featured category.
    $new_category = array(
        'slug'  => 'featured',
        'title' => __( 'Featured', 'editor-curation-examples' ),
        'icon'  => null,
    );

    // Insert the new category at the beginning of the array.
    array_unshift( $categories, $new_category );

    return $categories;
}
add_filter( 'block_categories_all', 'ece_register_featured_block_category' );