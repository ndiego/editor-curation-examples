<?php
/**
 * Disable background color and gradient support for Heading blocks.
 *
 * This function hooks into the 'block_type_metadata' filter to modify the block
 * settings for Heading blocks, disabling support for background color and gradients.
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
 * Add a group of allowed blocks to the new custom Featured category.
 *
 * @param array $metadata The block type metadata.
 * @return array          The modified block type metadata.
 */
function ece_add_heading_to_featured_category( $metadata ) {

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
add_filter( 'block_type_metadata', 'ece_add_heading_to_featured_category' );

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
        'title' => __( 'Featured', 'easy-plugin-stats' ),
        'icon'  => null,
    );

    // Insert the new category at the beginning of the array.
    array_unshift( $categories, $new_category );

    return $categories;
}
add_filter( 'block_categories_all', 'ece_register_featured_block_category' );