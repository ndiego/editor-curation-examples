/**
 * Unregister selected Embed block variations.
 */
wp.domReady( () => {

    const embedVariations = [
        'animoto',
        'dailymotion',
        'hulu',
        'reddit',
        'tumblr',
        'vine',
        'amazon-kindle',
        'cloudup',
        'crowdsignal',
        'speaker',
        'scribd'
    ];

    embedVariations.forEach( ( variation ) => {
        wp.blocks.unregisterBlockVariation( 'core/embed', variation );
    } );
} );