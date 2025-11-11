<?php
/**
 * Quotation tab
 *
 *  @package  PEFree/template
 */

?>
<form name="ask_product_form" id="ask_product_form" method="POST" action="options.php">
	<div id="ask_abt_product_panel">
		<?php
		add_meta_box( 'meta-box-pdf_options', esc_attr( __( 'PDF Settings', 'product-enquiry-for-woocommerce' ) ), 'render_meta_box_markup_pdf_options', 'product-enquiry-for-woocommerce', 'normal', 'low' );

		add_meta_box( 'meta-box-quote_approval_rej_options', esc_attr( __( 'Quotation Approval/Rejection', 'product-enquiry-for-woocommerce' ) ), 'render_meta_box_markup_quote_approval_rej_options', 'product-enquiry-for-woocommerce', 'normal', 'low' );

		add_meta_box( 'meta-box-custom_form_builder_gif', esc_attr( __( 'Custom Form Builder', 'product-enquiry-for-woocommerce' ) ), 'render_meta_box_custom_form_builder_gif', 'product-enquiry-for-woocommerce', 'normal', 'low' );

		do_meta_boxes( 'product-enquiry-for-woocommerce', 'normal', '' );
		?>
	</div>
</form>
