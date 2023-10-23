<?php
/**
 * Extend Timber Post class for Cards.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 * @package WordPress
 * @subpackage  Timber
 */

/**
 * Create a Card Post.
 */
class Card_Post extends Timber\Post {

	/**
	 * The featured image.
	 *
	 * @var Timber\Image
	 */
	public $featured_image;

	/**
	 * The tag.
	 *
	 * @var Timber\Term
	 */
	public $tag;

	/**
	 * The excerpt.
	 *
	 * @var string
	 */
	public $excerpt;

	/**
	 * Constructor method.
	 *
	 * @param int $post_id Post ID.
	 */
	public function __construct( $post_id = null ) {
		parent::__construct( $post_id );
		$banner_thumbnail     = $this->get_field( 'banner_image' );
		$this->featured_image = $banner_thumbnail ? new Timber\Image( $banner_thumbnail ) : $this->thumbnail();
		$this->tag            = count( $this->tags() ) ? $this->tags()[0] : null;
		$this->excerpt        = $this->preview->length( 25 )->read_more( false );
	}
}
