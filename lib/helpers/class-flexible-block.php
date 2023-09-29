<?php
/**
 * Flexible Block class
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package WordPress
 * @subpackage  Timber
 */

/**
 * Create a flexible content block for a Post.
 */
class Flexible_Block {

	protected $block;
	protected $block_layout;


	/**
	 * Make a Banner Block.
	 */
	protected function make_banner_block() {
		// Assign block fields to banner param.
		$this->block['fields'] = $this->block;
	}

	/**
	 * Make a CTA Block
	 */
	protected function make_cta_block() {
		// Assign block fields to cta param.
		$this->block['fields'] = $this->block;
	}

	/**
	 * Make an Image + Text Block
	 */
	protected function make_image_text_block() {
		// Assign block fields to image_text param.
		$this->block['fields'] = $this->block;
	}

	/**
	 * Make a Wayfinding Cards Block
	 */
	protected function make_wayfinding_cards_block() {
		// Assign block fields to wayfinding_card param.
		$this->block['fields'] = $this->block;
	}

	/**
	 * Make a Card Grid Block
	 */
	protected function make_card_grid_block() {
		$this->block['fields'] = $this->block;
		// Check if card grid is query populated and construct the query for IDs if so.
		if ( $this->block['grid_population'] == 'automatic' ) {
			// Construct wp query to get post ids for card grid.
			$card_grid_query           = new WP_Query(
				array(
					'post_type'      => $this->block['post_type'],
					'posts_per_page' => $this->block['posts_per_page'],
					'order'          => $this->block['order'],
					'fields'         => 'ids',
				)
			);
			$this->block['grid_cards'] = $card_grid_query->posts;
		}
	}

	/**
	 * Generate Block for use in TWIG template.
	 */
	public function make_block() {
		// Assign block layout to block.
		$this->block['block_layout'] = str_replace( '_', '-', $this->block_layout );
		switch ( $this->block_layout ) {
			case 'banner':
				$this->make_banner_block();
				break;
			case 'cta':
				$this->make_cta_block();
				break;
			case 'image_text':
				$this->make_image_text_block();
				break;
			case 'card_grid':
				$this->make_card_grid_block();
				break;
			case 'wayfinding_cards':
				$this->make_wayfinding_cards_block();
				break;
			default:
				break;
		}
		return $this->block;
	}

	/**
	 * Constructor
	 *
	 * @param array $flexible_block The block data.
	 */
	public function __construct( $flexible_block ) {
		$this->block        = $flexible_block;
		$this->block_layout = isset( $flexible_block['acf_fc_layout'] ) ? $flexible_block['acf_fc_layout'] : '';
	}
}
