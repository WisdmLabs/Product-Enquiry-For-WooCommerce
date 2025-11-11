<?php
/**
 * Display Premium tab contents
 *
 * @package PEFREE/Menu
 */

global $is_product;
if ( $is_product ) {
	$product_title = get_the_title();
	?>
	<div id="contact-form" title="<?php
	/* translators: product title */
	echo esc_html( sprintf( __( 'Enquiry for %s', 'product-enquiry-for-woocommerce' ), $product_title ) );
	?>" style="display:none;">
		<form id="enquiry-form" action="#" method="POST">
			<?php do_action( 'pefree_before_enquiry_form' ); ?>
			<div class="wdm-pef-form-row">
				<input type="hidden" name="wdm_product_name" value="<?php echo esc_attr( $product_title ); ?>" />
				<input type="hidden" name="wdm_product_id" value="<?php echo esc_attr( $post->ID ); ?>" />
				<input type="hidden" name="author_email" id="author_email" value="<?php echo esc_attr( $author_email ); ?>" />
				<input type="text" id="contact-name" class="contact-input ptl" name="wdm_customer_name" value="" placeholder=" " />
				<label for="contact-name">* <?php esc_html_e( 'Name', 'product-enquiry-for-woocommerce' ); ?></label>
			</div>
			<div class="wdm-pef-form-row">
				<input type="text" id="contact-email" class="contact-input ptl" name="wdm_customer_email" value="" placeholder="" />
				<label for="contact-email">* <?php esc_html_e( 'Email', 'product-enquiry-for-woocommerce' ); ?></label>
			</div>
			<!-- Phone number field -->
			<?php if ( ! empty( $form_data['enable_telephone_no_txtbox'] ) ) { ?>
			<div class="wdm-pef-form-row">
				<input type="text" name="wdm_txtphone" id="wdm_txtphone" class="contact-input phone-field ptl" value="" placeholder=""
				<?php
				if ( ! empty( $form_data['make_phone_mandatory'] ) ) {
					echo 'required';
				}
				?> />
				<label for="wdm_txtphone">
				<?php
				$wdm_phone_required = '';
				if ( ! empty( $form_data['make_phone_mandatory'] ) ) {
					$wdm_phone_required = 'required';
					?>
				*
					<?php
				}
				esc_attr_e( 'Phone No', 'product-enquiry-for-woocommerce' );
				?>
				</label>
			</div>
			<?php } ?>
			<!-- Subject Field -->
			<div class="wdm-pef-form-row">
				<input type="text" id="contact-subject" class="contact-input ptl" name="wdm_subject" value="" placeholder="" />
				<label for="contact-subject"><?php esc_attr_e( 'Subject', 'product-enquiry-for-woocommerce' ); ?></label>
			</div>
			<div class="wdm-pef-form-row">
				<textarea id="contact-message" class="contact-input ptl" name="wdm_enquiry" cols="40" rows="2" style="resize:none" placeholder=""></textarea>
				<label class="textarea-label" for="contact-message">* <?php esc_attr_e( 'Enquiry', 'product-enquiry-for-woocommerce' ); ?></label>
			</div>
			<?php if ( ! empty( $form_data['enable_send_mail_copy'] ) ) { ?>
			<div class="wdm-pef-send-copy">
				<label class="contact-cc">
					<input type="checkbox" id="contact-cc" name="cc" value="1" />
					<?php esc_attr_e( 'Send me a copy', 'product-enquiry-for-woocommerce' ); ?>
				</label>
			</div>
			<?php } ?>
			<!-- Enquiry Terms and Conditions Checkbox -->
			<?php if ( should_display_terms_cond() ) { ?>
			<div class="wdm-terms-cond-cb">
				<input type="checkbox" id="terms-cond-cb" name="enable_terms_conditions" required data-msg-required="<?php esc_attr_e( 'Please select terms and conditions', 'product-enquiry-for-woocommerce' ); ?>" />
				<span class="terms-cond-text">
					<?php echo wp_kses_post( get_terms_conditions_text() ); ?>
				</span>
			</div>
			<?php } ?>
			<div class="wdm-enquiry-action-btns">
				<?php
				$buttonClass = 'contact-send contact-button button alt';
				/**
				 * Use the filter to add/ alter the class applied to the
				 * 'Send' button on the enquiry form.
				 *
				 * @since 3.1.3
				 *
				 * @param  string  $buttonClass  Class to applied on the
				 * 						         'Send' button.
				 */
				$buttonClass = apply_filters('pefree_enq_send_btn_class', $buttonClass);
				?>
				<button id="send-btn" type="submit" class="<?php echo esc_attr( $buttonClass ); ?>"><?php esc_attr_e( 'Send', 'product-enquiry-for-woocommerce' ); ?></button>
			</div>
			<?php
			wp_nonce_field( 'enquiry_action', 'product_enquiry' );
			?>
			<?php do_action( 'pefree_after_enquiry_form' ); ?>
		</form>

		<!-- preload the images -->    
		<div id="loading" style="display: none;">
			<div id="send_mail">
				<p><?php esc_attr_e( 'Sending...', 'product-enquiry-for-woocommerce' ); ?></p>
				<img src="<?php echo esc_attr( plugins_url( '../assets/common/images/contact/loading.gif', __FILE__ ) ); ?>" alt="" />
			</div>
		</div>
		<div id="pe-enquiry-result" style="display: none;" class="ui-dialog-content ui-widget-content"></div>
		<?php
		unset( $is_product );
		?>
	</div>
<?php
}
?>
