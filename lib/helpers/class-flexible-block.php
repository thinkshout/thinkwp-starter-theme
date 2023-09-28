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

	protected $timber_post;
	protected $block;
	protected $block_layout;


	/**
	 * Make a Banner Block.
	 */
	protected function make_banner_block() {
		// Assign block fields to banner param.
		$this->block['fields'] = $this->block['banner'];
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
			default:
				break;
		}
		return $this->block;
	}

	/**
	 * Constructor
	 *
	 * @param TimberPost $timber_post The TimberPost object.
	 * @param array $flexible_block The block data.
	 */
	public function __construct( $timber_post = null, $flexible_block ) {
		$this->timber_post  = $timber_post;
		$this->block        = $flexible_block;
		$this->block_layout = isset( $flexible_block['acf_fc_layout'] ) ? $flexible_block['acf_fc_layout'] : '';
	}
}
