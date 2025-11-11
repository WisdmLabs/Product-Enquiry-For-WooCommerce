<?php
/**
 * Quote Options
 *
 *  @package  PEFree/template
 */

$form_data        = Product_Enquiry_For_Woocommerce::pe_settings();
$available_in_pro = __( '[These settings are available in PRO]', 'product-enquiry-for-woocommerce' );

?>
<table class="form-table">
	<tbody>
		<tr>
			<th colspan="2">
			<span title='Pro Feature' class='pew_pro_txt'><?php echo esc_html( $available_in_pro ); ?></span>
			</th>
		</tr>
		<tr valign="top">
			<th scope="row" class="titledesc">
				<label for="approval_rejection_page"><?php esc_attr_e( 'Approval/Rejection Page', 'product-enquiry-for-woocommerce' ); ?></label>
			</th>
			<td class="forminp forminp-text">
				<?php
					$help_tip = __( 'Select the page where the user can approve or reject the Quotation on the frontend generated for him/her. The user will be redirected to checkout page after Quotation approval.', 'product-enquiry-for-woocommerce' );
					echo wp_kses_post( pe_help_tip( $help_tip ) );
				?>
				<select name="wdm_form_data[approval_rejection_page]" class="wdm_quoteup_pages_list wdm_disabled" id="wdm_form_data[approval_rejection_page]" disabled>
					<option value=""><?php echo esc_attr( __( 'Select Page', 'product-enquiry-for-woocommerce' ) ); ?></option>
				</select>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row" class="titledesc">
				<label for="approve_custom_label"> <?php esc_attr_e( 'Approve Button Label', 'product-enquiry-for-woocommerce' ); ?></label>
			</th>
			<td class="forminp forminp-text">
				<?php
					$help_tip = __( 'The label (text) for approve button. Add custom label for approve quotation button.', 'product-enquiry-for-woocommerce' );
					echo wp_kses_post( pe_help_tip( $help_tip ) );
				?>
				<input type="text" class="wdm_wpi_input wdm_wpi_text wdm_disabled" id="approve_custom_label" value="" disabled />
			</td>
		</tr>
		<tr valign="top">
			<th scope="row" class="titledesc">
				<label for="reject_custom_label"> <?php esc_attr_e( 'Reject Button Label', 'product-enquiry-for-woocommerce' ); ?></label>
			</th>
			<td class="forminp forminp-text">
				<?php
					$help_tip = __( 'The label (text) for reject button. Add custom label for reject quotation button.', 'product-enquiry-for-woocommerce' );
					echo wp_kses_post( pe_help_tip( $help_tip ) );
				?>
				<input type="text" class="wdm_wpi_input wdm_wpi_text wdm_disabled" id="reject_custom_label" value="" disabled />
			</td>
		</tr>
		<tr valign="top">
			<th scope="row" class="titledesc">
				<label for="reject_message"> <?php esc_attr_e( 'Reject Message', 'product-enquiry-for-woocommerce' ); ?></label>
			</th>
			<td class="forminp forminp-text">
				<?php
					$help_tip = __( 'Add custom message to display when customer rejects quote.', 'product-enquiry-for-woocommerce' );
					echo wp_kses_post( pe_help_tip( $help_tip ) );
				?>
				<input type="text" class="wdm_wpi_input wdm_wpi_text wdm_disabled" id="reject_message" value="" disabled />
			</td>
		</tr>
		<tr valign="top">
			<th scope="row" class="titledesc">
				<label for="replace_quote"> <?php esc_attr_e( 'Alternate word for Quote', 'product-enquiry-for-woocommerce' ); ?></label>
			</th>
			<td class="forminp forminp-text">
				<?php
					$help_tip = __( 'Alternate word for Quote and Quotation. The Quote and Quotation texts will get replaced by this text.', 'product-enquiry-for-woocommerce' );
					echo wp_kses_post( pe_help_tip( $help_tip ) );
				?>
				<input type="text" class="wdm_wpi_input wdm_wpi_text wdm_disabled" id="replace_quote" value="" disabled />
			</td>
		</tr>
	</tbody>
</table>
