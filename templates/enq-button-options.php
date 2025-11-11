<?php
/**
 * Enquiry Button Options
 *
 *  @package  PEFree/template
 */

$form_data = Product_Enquiry_For_Woocommerce::pe_settings();
?>
<table class="form-table">
	<tbody>
		<tr valign="top">
			<th scope="row" class="titledesc">
				<label for="custom_label"><?php esc_attr_e( 'Enquiry button label', 'product-enquiry-for-woocommerce' ); ?></label>
			</th>
			<td class="forminp forminp-text">
				<input type="text" class="wdm_wpi_input wdm_wpi_text pe-admin-required-text" name="wdm_form_data[custom_label]" value="<?php echo esc_attr( empty( $form_data['custom_label'] ) ? __( 'Make an enquiry for this product', 'product-enquiry-for-woocommerce' ) : $form_data['custom_label'] ); ?>" id="custom_label"s />
				<span class='pe-admin-field-req-error pe-admin-field-err'><?php esc_html_e( 'Enquiry button label is required.', 'product-enquiry-for-woocommerce' ); ?></span>
				<span class="description"><?php esc_attr_e( 'Add custom label for enquiry button.', 'product-enquiry-for-woocommerce' ); ?></span>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row" class="titledesc">
				<label><?php esc_attr_e( 'Enquiry button location', 'product-enquiry-for-woocommerce' ); ?></label>
			</th>
			<td class="forminp forminp-text">
				<input type='radio' id="show_after_product_summary" class='wdm_wpi_input wdm_wpi_checkbox input-without-tip' value='after_add_cart' name='wdm_form_data[pos_radio]' <?php echo esc_attr( ( isset( $form_data['pos_radio'] ) && ( $form_data['pos_radio'] ) === 'after_add_cart' ) ? ' checked="checked" ' : '' ); ?> />
				<label for="show_after_product_summary"><?php esc_attr_e( ' After add to cart button', 'product-enquiry-for-woocommerce' ); ?></label>
				<br />
				<input type='radio' id="show_after_cart" class='wdm_wpi_input wdm_wpi_checkbox input-without-tip' value='after_product_summary' name='wdm_form_data[pos_radio]' 
				<?php
				echo esc_attr( ( ( isset( $form_data['pos_radio'] ) && 'after_product_summary' === $form_data['pos_radio'] ) ? ' checked="checked" ' : '' ) );
				?>
					/>
				<label for="show_after_cart"><?php esc_attr_e( ' After single product summary ', 'product-enquiry-for-woocommerce' ); ?></label>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row" class="titledesc">
				<label for="show_button_as_link"><?php esc_attr_e( 'Display Enquiry Button As A Link', 'product-enquiry-for-woocommerce' ); ?></label>
			</th>
			<td class="forminp forminp-text">
				<input type="checkbox" class="wdm_wpi_input wdm_wpi_checkbox" name="wdm_form_data[show_button_as_link]" value="1" <?php checked( 1, isset( $form_data['show_button_as_link'] ) ? $form_data['show_button_as_link'] : 0 ); ?> id="show_button_as_link" />
				<input type="hidden" name="wdm_form_data[show_button_as_link]" value="<?php echo esc_attr( isset( $form_data['show_button_as_link'] ) && 1 === (int) $form_data['show_button_as_link'] ? $form_data['show_button_as_link'] : 0 ); ?>" /> 
				<span class="description"><?php esc_attr_e( 'Displays Enquiry Button as a link on the single product page.', 'product-enquiry-for-woocommerce' ); ?></span>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row" class="titledesc">
				<label for="enable_for_out_stock">
				<?php esc_attr_e( 'Show enquiry button only when product is out of stock', 'product-enquiry-for-woocommerce' ); ?></label>
			</th>
			<td class="forminp forminp-text">
				<input type="checkbox" disabled class="wdm_wpi_input wdm_wpi_checkbox" value="1" id="enable_for_out_stock" />
				<span title='Pro Feature' class='pew_pro_txt'><?php esc_html_e( '[Available in PRO]', 'product-enquiry-for-woocommerce' ); ?></span>
				<span class="description"><?php esc_html_e( 'Show enquiry button only when product is out of stock.', 'product-enquiry-for-woocommerce' ); ?></span>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row" class="titledesc">
				<label for="enable_whatsapp_button">
				<?php esc_attr_e( 'Enable WhatsApp Button', 'product-enquiry-for-woocommerce' ); ?></label>
			</th>
			<td class="forminp forminp-text">
				<input type="checkbox" disabled class="wdm_wpi_input wdm_wpi_checkbox" value="1" id="enable_whatsapp_button" />
				<span title='Pro Feature' class='pew_pro_txt'><?php esc_html_e( '[Available in PRO]', 'product-enquiry-for-woocommerce' ); ?></span>
				<span class="description"><?php esc_html_e( 'Enable WhatsApp button for product enquiries.', 'product-enquiry-for-woocommerce' ); ?></span>
			</td>
		</tr>
	</tbody>
</table>
