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
				<label for="enable_terms_conditions"><?php esc_attr_e( 'Display Terms and Conditions', 'product-enquiry-for-woocommerce' ); ?></label>
			</th>
			<td class="forminp forminp-text">
				<input name="wdm_form_data[enable_terms_conditions]" type="checkbox" class="wdm_wpi_input wdm_wpi_checkbox terms-cond-checkbox" value="1" <?php checked( 1, isset( $form_data['enable_terms_conditions'] ) ? $form_data['enable_terms_conditions'] : 0 ); ?> id="enable_terms_conditions" />
				<input type="hidden" name="wdm_form_data[enable_terms_conditions]" value="<?php echo esc_attr( isset( $form_data['enable_terms_conditions'] ) && 1 === (int) $form_data['enable_terms_conditions'] ? $form_data['enable_terms_conditions'] : 0 ); ?>" />
				<span class="description"><?php esc_attr_e( 'To display \'Terms and Conditions\' checkbox on Enquiry form, you must enable this.', 'product-enquiry-for-woocommerce' ); ?></span>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row" class="titledesc">
				<label for="enquiry_privacy_policy_text"><?php esc_attr_e( 'Enquiry privacy policy', 'product-enquiry-for-woocommerce' ); ?></label>
			</th>
			<td class="forminp forminp-text">
				<?php
				$enquiry_privacy_policy = isset( $form_data['enquiry_privacy_policy_text'] ) ? $form_data['enquiry_privacy_policy_text'] : default_terms_cond_text();
				?>
				<textarea id="enquiry_privacy_policy_text" class="wdm_wpi_input term-cond-text pe-admin-required-text" name="wdm_form_data[enquiry_privacy_policy_text]" rows="3" placeholder="<?php echo esc_attr( default_terms_cond_text() ); ?>" ><?php echo esc_html( $enquiry_privacy_policy ); ?></textarea>
				<br>
				<span class='pe-admin-field-req-error pe-admin-field-err'><?php esc_html_e( 'Privacy policy is required.', 'product-enquiry-for-woocommerce' ); ?></span>
				<span class="description">
				<?php
				/* translators: search term, abc */
				echo esc_attr( sprintf( __( 'For WP 4.9.6 and above %1$s will get automatically replaced with Privacy Policy Page link. If your site runs on WP below 4.9.6, then replace %2$s here with link to your Privacy Policy Page.', 'product-enquiry-for-woocommerce' ), '[privacy_policy]', '[privacy_policy]' ) );
				?>
				</span>
			</td>
		</tr>
	</tbody>
</table>
