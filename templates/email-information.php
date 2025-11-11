<?php
/**
 * Email information
 *
 *  @package  PEFree/template
 */

$form_data = Product_Enquiry_For_Woocommerce::pe_settings();

?>
<table class="form-table">
	<tbody>
		<tr valign="top">
			<th scope="row" class="titledesc">
				<label for="wdm_user_email"><?php esc_attr_e( "Recipient's email", 'product-enquiry-for-woocommerce' ); ?></label>
			</th>
			<td class="forminp forminp-text">
				<input type="text" class="wdm_wpi_input wdm_wpi_text pe-admin-required-text" name="wdm_form_data[user_email]" id="wdm_user_email" value="<?php echo esc_attr( empty( $form_data['user_email'] ) ? get_option( 'admin_email' ) : $form_data['user_email'] ); ?>" />
				<span class='pe-admin-field-err pe-admin-field-req-error'><?php esc_html_e( 'Email is required.', 'product-enquiry-for-woocommerce' ); ?></span>
				<span class='pe-admin-field-err email-invalid-error'><?php esc_html_e( 'Please enter valid Email address.', 'product-enquiry-for-woocommerce' ); ?></span>
				<span class="description"><?php esc_attr_e( 'You can add multiple email addresses separated by comma.', 'product-enquiry-for-woocommerce' ); ?></span>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row" class="titledesc">
				<label for="wdm_default_sub"><?php esc_attr_e( 'Default subject ', 'product-enquiry-for-woocommerce' ); ?></label>
			</th>
			<td class="forminp forminp-text">
				<input type="text" class="wdm_wpi_input wdm_wpi_text pe-admin-required-text" name="wdm_form_data[default_sub]" id="wdm_default_sub" value="<?php echo esc_attr( empty( $form_data['default_sub'] ) ? __( 'Enquiry for a product from ', 'product-enquiry-for-woocommerce' ) . get_bloginfo( 'name' ) : $form_data['default_sub'] ); ?>"  />
				<span class='default-subject-error pe-admin-field-err pe-admin-field-req-error'><?php esc_html_e( 'Default subject field is required.', 'product-enquiry-for-woocommerce' ); ?></span>
				<span class="description"><?php esc_attr_e( 'Subject to be used if customer leaves subject field blank.', 'product-enquiry-for-woocommerce' ); ?></span>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row" class="titledesc">
				<label for="send-mail-to-admin"><?php esc_attr_e( 'Send mail to Admin ', 'product-enquiry-for-woocommerce' ); ?></label>
			</th>
			<td class="forminp forminp-text">
				<input name="wdm_form_data[send_mail_to_admin]" type="checkbox" class="wdm_wpi_input wdm_wpi_checkbox" value="1" 
							<?php
							checked( 1, isset( $form_data['send_mail_to_admin'] ) ? $form_data['send_mail_to_admin'] : 0 );
							?>
							id="send-mail-to-admin" />
				<input type="hidden" name="wdm_form_data[send_mail_to_admin]" value="<?php echo esc_attr( isset( $form_data['send_mail_to_admin'] ) && 1 === (int) $form_data['send_mail_to_admin'] ? $form_data['send_mail_to_admin'] : 0 ); ?>" /> 
				<span class="description"><?php esc_attr_e( 'When checked, sends the enquiry email to the Admin email address specified under Settings -> General.', 'product-enquiry-for-woocommerce' ); ?></span>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row" class="titledesc">
				<label for="send-mail-to-product-author"><?php esc_attr_e( 'Send mail to Product Author ', 'product-enquiry-for-woocommerce' ); ?></label>
			</th>
			<td class="forminp forminp-text">
				<input name="wdm_form_data[send_mail_to_author]" type="checkbox" class="wdm_wpi_input wdm_wpi_checkbox" value="1" <?php checked( 1, isset( $form_data['send_mail_to_author'] ) ? $form_data['send_mail_to_author'] : 0 ); ?> id="send-mail-to-product-author" />
				<input type="hidden" name="wdm_form_data[send_mail_to_author]" value="<?php echo esc_attr( isset( $form_data['send_mail_to_author'] ) && 1 === (int) $form_data['send_mail_to_author'] ? $form_data['send_mail_to_author'] : 0 ); ?>" /> 
				<span class="description"><?php esc_attr_e( 'When checked, sends enquiry email to author/owner of the Product.', 'product-enquiry-for-woocommerce' ); ?></span>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row" class="titledesc">
				<label for="deactivate-nonce"><?php esc_attr_e( 'Disable nonce ', 'product-enquiry-for-woocommerce' ); ?></label>
			</th>
			<td class="forminp forminp-text">
				<input name="wdm_form_data[deactivate_nonce]" type="checkbox" class="wdm_wpi_input wdm_wpi_checkbox" value="1" <?php checked( 1, isset( $form_data['deactivate_nonce'] ) ? $form_data['deactivate_nonce'] : 0 ); ?> id="deactivate-nonce" />
				<input type="hidden" name="wdm_form_data[deactivate_nonce]" value="<?php echo esc_attr( isset( $form_data['deactivate_nonce'] ) && 1 === (int) $form_data['deactivate_nonce'] ? $form_data['deactivate_nonce'] : 0 ); ?>" /> 
				<span class="description"><?php esc_attr_e( 'Check this option if your enquiry system does not work properly or displays an "Unauthorised Enquiry" error. Note: In all other cases, we advise you to keep it  unchecked.', 'product-enquiry-for-woocommerce' ); ?></span>
			</td>
		</tr>
	</tbody>
</table>

