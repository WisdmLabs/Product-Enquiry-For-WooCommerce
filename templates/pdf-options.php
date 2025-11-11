<?php
/**
 * PDF Options
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
				<label for="enable_disable_quote_pdf">
				<?php esc_attr_e( 'Enable PDF', 'product-enquiry-for-woocommerce' ); ?></label>
			</th>
			<td class="forminp forminp-text">
				<?php
					$help_tip = __( 'You can enable/disable PDF.', 'product-enquiry-for-woocommerce' );
					echo wp_kses_post( pe_help_tip( $help_tip ) );
				?>
				<input type="checkbox" disabled class="wdm_wpi_input wdm_wpi_checkbox wdm_disabled" value="1" id="enable_disable_quote_pdf" />
				<!-- <span title='Pro Feature' class='pew_pro_txt'><?php echo esc_html( $available_in_pro ); ?></span> -->
			</td>
		</tr>
		<tr valign="top">
			<th scope="row" class="titledesc">
				<label for="company_name"><?php esc_attr_e( 'Company Name', 'product-enquiry-for-woocommerce' ); ?></label>
			</th>
			<td class="forminp forminp-text">
				<?php
					$help_tip = __( 'The company name will be added in the Quotation PDF generated for the user.', 'product-enquiry-for-woocommerce' );
					echo wp_kses_post( pe_help_tip( $help_tip ) );
				?>
				<input type="text" class="wdm_wpi_input wdm_wpi_text wdm_disabled" id="company_name" value="" disabled />
			</td>
		</tr>
		<tr valign="top">
			<th scope="row" class="titledesc">
				<label for="company_email"><?php esc_attr_e( 'Company Email', 'product-enquiry-for-woocommerce' ); ?></label>
			</th>
			<td class="forminp forminp-text">
				<?php
					$help_tip = __( 'The company email will be added in the Quotation PDF generated for the user.', 'product-enquiry-for-woocommerce' );
					echo wp_kses_post( pe_help_tip( $help_tip ) );
				?>
				<input type="text" class="wdm_wpi_input wdm_wpi_text wdm_disabled" id="company_email" value="" disabled />
			</td>
		</tr>
		<tr valign="top">
			<th scope="row" class="titledesc">
				<label for="company_address"><?php esc_attr_e( 'Company Address', 'product-enquiry-for-woocommerce' ); ?></label>
			</th>
			<td class="forminp forminp-text textarea-wrapper">
				<?php
					$help_tip = __( 'The company address will be added in the Quotation PDF generated for the user.', 'product-enquiry-for-woocommerce' );
					echo wp_kses_post( pe_help_tip( $help_tip ) );
				?>
				<textarea class="input-without-tip wdm_disabled" id="compny_address" rows="5" cols="40" disabled></textarea>
			</td>
		</tr>
	</tbody>
</table>
