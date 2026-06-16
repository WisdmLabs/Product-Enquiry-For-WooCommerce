<?php
/**
 * PhotoSwipe Integration for WooCommerce Product Gallery
 *
 * @package PEFree
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Add PhotoSwipe CSS fixes to head
 */
function pefree_add_photoswipe_fixes() {
	if ( ! is_product() ) {
		return;
	}
	?>
	<style type="text/css">
		/* Show WooCommerce PhotoSwipe default UI with better styling */
		.pswp__top-bar {
			display: flex !important;
			align-items: center;
			padding: 0 15px;
			background: linear-gradient(to bottom, rgba(0,0,0,0.6), transparent) !important;
			height: 60px;
		}

		/* Right side buttons container with equal spacing */
		.pswp__top-bar .pswp__button--zoom,
		.pswp__top-bar .pswp__button--fs,
		.pswp__top-bar .pswp__button--close {
			position: relative !important;
			float: none !important;
			margin: 0 6px !important;
		}

		.pswp__top-bar .pswp__button--zoom {
			margin-left: 0 !important;
		}
		.pswp__top-bar .pswp__button--close {
			margin-right: 0 !important;
		}

		/* Style the counter */
		.pswp__counter {
			color: #ffffff !important;
			font-size: 15px !important;
			font-weight: 500 !important;
			font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
			position: static !important;
			margin: 0 !important;
			padding: 0 !important;
			opacity: 1 !important;
			min-width: auto !important;
		}

		/* Hide share button */
		.pswp__button--share {
			display: none !important;
		}

		/* Style all buttons */
		.pswp__button {
			opacity: 0.9 !important;
		}

		.pswp__button:hover {
			opacity: 1 !important;
		}


		/* Hide preloader */
		.pswp__preloader {
			display: none !important;
		}

		/* Style arrows */
		.pswp__button--arrow--left,
		.pswp__button--arrow--right {
			opacity: 0.9 !important;
		}

		.pswp__button--arrow--left:hover,
		.pswp__button--arrow--right:hover {
			opacity: 1 !important;
		}

		/* Image container - center the image */
		.pswp__item {
			display: flex !important;
			align-items: center !important;
			justify-content: center !important;
			width: 100% !important;
			height: 100% !important;
		}

		.pswp__img {
			max-width: calc(100vw - 140px) !important;
			max-height: 85vh !important;
			width: auto !important;
			height: auto !important;
			object-fit: contain !important;
		}

		.pswp__zoom-wrap {
			display: flex !important;
			align-items: center !important;
			justify-content: center !important;
		}

		.pswp {
			z-index: 999999 !important;
		}

		/* Caption styling */
		.pswp__caption {
			background: linear-gradient(to top, rgba(0,0,0,0.5), transparent) !important;
		}

		.pswp__caption__center {
			color: #ffffff;
			font-size: 14px;
			padding: 15px;
		}
	</style>
	<?php
}
add_action( 'wp_head', 'pefree_add_photoswipe_fixes', 100 );

/**
 * Add data attributes to WooCommerce product gallery images
 */
function pefree_add_data_size_to_product_gallery( $content, $attachment_id ) {
	$image = wp_get_attachment_image_src( $attachment_id, 'full' );
	if ( $image ) {
		$content = str_replace( '<a ', '<a data-large_image_width="' . esc_attr( $image[1] ) . '" data-large_image_height="' . esc_attr( $image[2] ) . '" ', $content );
	}
	return $content;
}
add_filter( 'woocommerce_single_product_image_thumbnail_html', 'pefree_add_data_size_to_product_gallery', 10, 2 );
