<?php
/**
 * Pro Features Activation Banner Template
 * 
 * This banner is displayed when the plugin is first activated to promote Pro features.
 *
 * @package PEFree/template
 */

$img = WDM_PE_PLUGIN_URL . 'assets/admin/img/star.png';
/* translators: %1$s:html*/
$rating_text = sprintf( __( 'Rated %s4.8', 'product-enquiry-for-woocommerce' ), '<img src=' . esc_attr( $img ) . ' />' );
/* translators: %1$s:html %2$s:html*/
$hp_customers = sprintf( __( 'Trusted by %1$s3180+%2$s happy customers', 'product-enquiry-for-woocommerce' ), '<span class="hp-cust-number"><b>', '</b></span>' );
?>
<div class="wdm-pefree-activation-banner notice notice-info is-dismissible" data-notice-id="wdm_pefree_activation_banner_dismissed">
	<div class="pefree-activation-banner-content">
		<div class="pefree-activation-banner-header">
			<h2><?php esc_html_e( '🎉 Welcome to Product Enquiry for WooCommerce!', 'product-enquiry-for-woocommerce' ); ?></h2>
			<p class="pefree-activation-subtitle"><?php esc_html_e( 'Unlock powerful Pro features to enhance your enquiry & quotation system', 'product-enquiry-for-woocommerce' ); ?></p>
		</div>

		<div class="pefree-activation-features">
			<div class="pefree-feature-column">
				<h3><?php esc_html_e( 'Pro Features Include:', 'product-enquiry-for-woocommerce' ); ?></h3>
				<ul class="pefree-features-list">
					<li>✅ <?php esc_html_e( 'WhatsApp Button Integration', 'product-enquiry-for-woocommerce' ); ?></li>
					<li>✅ <?php esc_html_e( 'Show enquiry button only when product is out of stock', 'product-enquiry-for-woocommerce' ); ?></li>
					<li>✅ <?php esc_html_e( 'Drag and Drop form builder', 'product-enquiry-for-woocommerce' ); ?></li>
					<li>✅ <?php esc_html_e( 'Auto-generation of Quote PDFs', 'product-enquiry-for-woocommerce' ); ?></li>
					<li>✅ <?php esc_html_e( 'Quotation workflow with approval/rejection', 'product-enquiry-for-woocommerce' ); ?></li>
					<li>✅ <?php esc_html_e( 'Multi-product enquiries and quotes', 'product-enquiry-for-woocommerce' ); ?></li>
					<li>✅ <?php esc_html_e( 'Advanced Enquiry button display options', 'product-enquiry-for-woocommerce' ); ?></li>
					<li>✅ <?php esc_html_e( 'Translation-ready with WPML Support', 'product-enquiry-for-woocommerce' ); ?></li>
				</ul>
			</div>
		</div>

		<div class="pefree-activation-actions">
			<a href="<?php echo esc_url( 'https://wisdmlabs.com/woocommerce-quotation-and-inquiry/?utm_source=pefree_activation&utm_medium=activation_banner&utm_campaign=pefree_activation&utm_term=activation_banner&utm_content=activation_banner' ); ?>" target="_blank" class="button button-primary button-large">
				<?php esc_html_e( 'Upgrade to Pro', 'product-enquiry-for-woocommerce' ); ?>
			</a>
			<a href="<?php echo esc_url( 'https://wisdmlabs.com/pep-demo/' ); ?>" target="_blank" class="button button-secondary button-large">
				<?php esc_html_e( 'View Demo', 'product-enquiry-for-woocommerce' ); ?>
			</a>
		</div>

		<div class="pefree-activation-footer">
			<p class="pep-rating"><?php echo wp_kses_post( $rating_text ); ?></p>
			<p class="pep-hp-cust"><?php echo wp_kses_post( $hp_customers ); ?></p>
		</div>
	</div>
</div>

<style>
.wdm-pefree-activation-banner {
	padding: 20px;
	margin: 20px 0;
	border-left: 4px solid #961a1d;
	background: #fff;
	box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

.pefree-activation-banner-content {
	max-width: 1200px;
}

.pefree-activation-banner-header h2 {
	margin: 0 0 10px 0;
	color: #961a1d;
	font-size: 24px;
}

.pefree-activation-subtitle {
	font-size: 16px;
	color: #666;
	margin: 0 0 20px 0;
}

.pefree-activation-features {
	margin: 20px 0;
}

.pefree-feature-column h3 {
	margin: 0 0 15px 0;
	color: #333;
	font-size: 18px;
}

.pefree-features-list {
	list-style: none;
	padding: 0;
	margin: 0;
	display: grid;
	grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
	gap: 10px;
}

.pefree-features-list li {
	padding: 8px 0;
	color: #444;
	font-size: 14px;
}

.pefree-activation-actions {
	margin: 25px 0;
	display: flex;
	gap: 15px;
	flex-wrap: wrap;
}

.pefree-activation-actions .button {
	text-decoration: none;
}

.pefree-activation-actions .button-primary {
	background-color: #961a1d;
	border-color: #961a1d;
}

.pefree-activation-actions .button-primary:hover {
	background-color: #7a1518;
	border-color: #7a1518;
}

.pefree-activation-footer {
	margin-top: 20px;
	padding-top: 15px;
	border-top: 1px solid #eee;
	display: flex;
	gap: 20px;
	flex-wrap: wrap;
	align-items: center;
}

.pefree-activation-footer .pep-rating,
.pefree-activation-footer .pep-hp-cust {
	margin: 0;
	font-size: 13px;
	color: #666;
}

.pefree-activation-footer img {
	margin-bottom: 1px;
	margin-right: 1px;
	vertical-align: text-bottom;
	width: 12px;
}

.hp-cust-number {
	color: #961a1d;
	font-weight: bold;
}

@media (max-width: 782px) {
	.pefree-features-list {
		grid-template-columns: 1fr;
	}
	
	.pefree-activation-actions {
		flex-direction: column;
	}
	
	.pefree-activation-actions .button {
		width: 100%;
		text-align: center;
	}
}
</style>

