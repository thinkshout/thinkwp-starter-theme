// Remove Embed Block Variations
export default function filterEmbeds() {
  // Array of allowed embed variations, add or remove to suit your needs.
  const allowedEmbeds = [
    'youtube',
    'twitter',
    'vimeo',
  ];

  // Get all embed block variations and filter out the allowed ones.
  const embedBlockVariations = wp.blocks.getBlockVariations( 'core/embed' );
  for (const embedVariation of embedBlockVariations) {
    if ( ! allowedEmbeds.includes( embedVariation.name ) ) {
      wp.blocks.unregisterBlockVariation( 'core/embed', embedVariation.name );
    }
  }
}