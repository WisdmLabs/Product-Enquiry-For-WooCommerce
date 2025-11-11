<?php
$img = WDM_PE_PLUGIN_URL . 'assets/admin/img/star.png';
/* translators: %1$s:html*/
$rating_text = sprintf( __( 'Rated %s4.8', 'product-enquiry-for-woocommerce' ), '<img src=' . esc_attr( $img ) . ' />' );
/* translators: %1$s:html %2$s:html*/
$hp_customers = sprintf( __( 'Trusted by %1$s3180+%2$s happy customers', 'product-enquiry-for-woocommerce' ), '<span class="hp-cust-number"><b>', '</b></span>' );
?>

<div class="pro-banner">
	<!-- Heading  -->
	<div class="pro-banner-heading">
		<h3><?php esc_html_e( 'WISDM', 'product-enquiry-for-woocommerce' ); ?></h3>
		<h3><?php esc_html_e( 'Product Enquiry Pro for WooCommerce', 'product-enquiry-for-woocommerce' ); ?></h3>
	</div>

	<div class="banner-content">
		<!-- Features List -->
		<div class="features-list-wrapper">
			<p class="features-text">
				<?php esc_html_e( 'Your suite of sweet features for a powerful enquiry & quotation system', 'product-enquiry-for-woocommerce' ); ?>
			</p>
			<ul class="features-list">
				<li>
					<a href="<?php echo esc_url( 'https://wisdmlabs.com/docs/article/wisdm-product-enquiry-pro/pep-features/create-enquiry-forms-specific-to-your-requirement/' ); ?>" target="_blank">
						<span><?php esc_html_e( 'Drag and Drop form builder', 'product-enquiry-for-woocommerce' ); ?></span>
					</a>
				</li>
				<li>
					<a href="<?php echo esc_url( 'https://wisdmlabs.com/docs/article/wisdm-product-enquiry-pro/pep-user-guide/creating-and-sending-a-quote-to-the-user/' ); ?>" target="_blank">
						<span><?php esc_html_e( 'Auto-generation of Quote PDFs', 'product-enquiry-for-woocommerce' ); ?></span>
					</a>
				</li>
				<li>
					<span><?php esc_html_e( 'Support for Simple Products', 'product-enquiry-for-woocommerce' ); ?></span>
				</li>
				<li>
					<span><?php esc_html_e( 'Support for Variable Products', 'product-enquiry-for-woocommerce' ); ?></span>
				</li>
				<li>
					<a href="<?php echo esc_url( 'https://wisdmlabs.com/docs/article/wisdm-product-enquiry-pro/pep-tips-and-tricks/how-to-add-product-enquiry-pro-button-on-shop-and-single-product-page-i-am-using-page-builder/' ); ?>" target="_blank">
						<span><?php esc_html_e( 'Advanced Enquiry button display options', 'product-enquiry-for-woocommerce' ); ?></span>
					</a>
				</li>
				<li>
					<a href="<?php echo esc_url( 'https://wisdmlabs.com/docs/article/wisdm-product-enquiry-pro/pep-features/compatibility-with-wpml/' ); ?>" target="_blank">
						<span><?php esc_html_e( 'Translation-ready with WPML Support', 'product-enquiry-for-woocommerce' ); ?></span>
					</a>
				</li>
				<li>
					<span><?php esc_html_e( 'WhatsApp Button Integration', 'product-enquiry-for-woocommerce' ); ?></span>
				</li>
				<li>
					<span><?php esc_html_e( 'Show enquiry button only when product is out of stock', 'product-enquiry-for-woocommerce' ); ?></span>
				</li>
			</ul>
		</div>

		<!-- Button to redirect to Pro plugin page -->
		<div class="pro-redirect-button-wrapper">
			<a href="<?php echo esc_url( 'https://wisdmlabs.com/woocommerce-quotation-and-inquiry/?utm_source=pefreebanner&utm_medium=pefreebanner&utm_campaign=pefreebanner&utm_term=pefreebanner&utm_content=pefreebanner' ); ?>" target="_blank">
				<button class="pro-redirect-button">
					<?php esc_html_e( 'Check out Product Enquiry Pro', 'product-enquiry-for-woocommerce' ); ?>
				</button>
			</a>
		</div>

		<!-- Footer -->
		<div class="banner-content-footer">
			<p class="pep-rating"><?php echo wp_kses_post( $rating_text ); ?></p>
			<p class="pep-hp-cust"><?php echo wp_kses_post( $hp_customers ); ?></p>
		</div>
	</div>
</div>
