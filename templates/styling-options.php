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
				<label for="user_custom_css"><?php esc_attr_e( 'Add custom CSS', 'product-enquiry-for-woocommerce' ); ?></label>
			</th>
			<td class="forminp forminp-text">
				<?php
				$user_custom_css = '';
				if ( isset( $form_data['user_custom_css'] ) ) {
					$user_custom_css = $form_data['user_custom_css'];
				}
				?>
				<textarea class="input-without-tip" id="user_custom_css" name="wdm_form_data[user_custom_css]" rows="10" cols="42"><?php echo esc_attr( $user_custom_css ); ?></textarea>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row" class="titledesc">
				<label><?php esc_attr_e( 'Custom styling', 'product-enquiry-for-woocommerce' ); ?></label>
			</th>
			<td class="forminp forminp-text">
				<input type="radio" class="wdm_wpi_input wdm_wpi_checkbox" value="theme_css" name="wdm_form_data[button_CSS]" id="theme_css" checked />
				<label for="theme_css"><?php esc_attr_e( 'Use activated theme\'s styling', 'product-enquiry-for-woocommerce' ); ?></label><br>
				<input type="radio" class="wdm_wpi_input wdm_wpi_checkbox" value="manual_css" name="wdm_form_data[button_CSS]" id="manual_css" />        
				<label for="manual_css"><?php esc_attr_e( 'Manually specify color settings', 'product-enquiry-for-woocommerce' ); ?></label>

				<div name="Other_Settings" id="Other_Settings" style="display: none;">
					<fieldset style="padding: 0;">
						<div class="layer_parent">
							<div class="pew_upgrade_layer">
								<div class="pew_uptp_cont">
									<p><?php esc_attr_e( ' This feature is available in the PRO version. Click below to know more. ', 'product-enquiry-for-woocommerce' ); ?></p>
									<a class="wdm_view_det_link" href="https://wisdmlabs.com/woocommerce-quotation-and-inquiry/?utm_source=pefreepremiumtab&utm_medium=pefreepremiumtab&utm_campaign=pefreepremiumtab&utm_term=pefreepremiumtab&utm_content=pefreepremiumtab" target="_blank"><?php esc_attr_e( 'View Details ', 'product-enquiry-for-woocommerce' ); ?> </a>
								</div>
							</div>
							<img src="<?php echo esc_attr( plugins_url( '../assets/admin/img/buttons-css.png', __FILE__ ) ); ?>" />
						</div>
					</fieldset>
				</div>

			</td>
		</tr>
	</tbody>
</table>
