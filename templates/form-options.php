<?php
/**
 * Form Options
 *
 *  @package  PEFree/template
 */

$form_data = Product_Enquiry_For_Woocommerce::pe_settings();
?>
<table class="form-table">
	<tbody>
		<tr valign="top">
			<th scope="row" class="titledesc">
				<label for="enable_send_mail_copy"><?php esc_attr_e( 'Send me a copy', 'product-enquiry-for-woocommerce' ); ?></label>
			</th>
			<td class="forminp forminp-text">
				<input type="checkbox" id="enable_send_mail_copy" class="wdm_wpi_input wdm_wpi_checkbox" name="wdm_form_data[enable_send_mail_copy]" value="1" <?php echo checked( 1, isset( $form_data['enable_send_mail_copy'] ) ? $form_data['enable_send_mail_copy'] : 0 ); ?> id="enable_send_mail_copy" />
				<input type="hidden" name="wdm_form_data[enable_send_mail_copy]" value="<?php echo esc_attr( isset( $form_data['enable_send_mail_copy'] ) && 1 === (int) $form_data['enable_send_mail_copy'] ? $form_data['enable_send_mail_copy'] : 0 ); ?>" /> 
				<span class="description"><?php esc_attr_e( 'This will display \'send me a copy\' checkbox on enquiry form to send an email copy to the customer.', 'product-enquiry-for-woocommerce' ); ?></span>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row" class="titledesc">
				<label for="enable_telephone_no_txtbox"><?php esc_attr_e( "Display 'Telephone Number Field'", 'product-enquiry-for-woocommerce' ); ?></label>
			</th>
			<td class="forminp forminp-text">
				<input type="checkbox" class="wdm_wpi_input wdm_wpi_checkbox" name="wdm_form_data[enable_telephone_no_txtbox]" value="1" <?php echo checked( 1, isset( $form_data['enable_telephone_no_txtbox'] ) ? $form_data['enable_telephone_no_txtbox'] : 0 ); ?> id="enable_telephone_no_txtbox" />
				<input type="hidden" name="wdm_form_data[enable_telephone_no_txtbox]" value="<?php echo esc_attr( isset( $form_data['enable_telephone_no_txtbox'] ) && 1 === (int) $form_data['enable_telephone_no_txtbox'] ? $form_data['enable_telephone_no_txtbox'] : 0 ); ?>" /> 
				<span class="description"><?php esc_attr_e( 'Displays telephone number field on the enquiry form.', 'product-enquiry-for-woocommerce' ); ?></span>
			</td>
		</tr>
		<tr valign="top" style="<?php echo esc_attr( isset( $form_data['enable_telephone_no_txtbox'] ) ? '' : 'display:none;' ); ?>">
			<th scope="row" class="titledesc">
				<label for="make_phone_mandatory_chkbox"><?php esc_attr_e( 'Make \'Telephone Number\' field mandatory', 'product-enquiry-for-woocommerce' ); ?></label>
			</th>
			<td class="forminp forminp-text">
				<input type="checkbox" class="wdm_wpi_input wdm_wpi_checkbox" name="wdm_form_data[make_phone_mandatory]" value="1" <?php echo checked( 1, isset( $form_data['make_phone_mandatory'] ) ? $form_data['make_phone_mandatory'] : 0 ); ?> id="make_phone_mandatory_chkbox" />
				<input type="hidden" name="wdm_form_data[make_phone_mandatory]" value="<?php echo esc_attr( isset( $form_data['make_phone_mandatory'] ) && 1 === (int) $form_data['make_phone_mandatory'] ? $form_data['make_phone_mandatory'] : 0 ); ?>" /> 
				<span class="description"><?php esc_attr_e( 'Make telephone number field mandatory while submitting the form.', 'product-enquiry-for-woocommerce' ); ?></span>
			</td>
		</tr>
	</tbody>
</table>
