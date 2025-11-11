<?php
/**
 * PEFree Admin Functions
 *
 * @package  PEFree/admin
 */

?>
<div id="wdm-subme-form" class=""> 
	<form method="post" action="">
		<!-- <span class='instruction-span'>Enter your email and get 20% discount on our premium products</span> -->
		<p class="wdm_enter_email_para">
			<label id="enter-email-label">
				<input type="email" id="wdm_subme_email_field" name="wdm_subme_email_field" placeholder="Enter your email & get 20% off on products"/>
				<span id="wdm_subme_error" style="display:none;"></span>
			</label>
			<button disabled="disabled" class="wdm_sub_me_link disabled_button" type="text" id="wdm_subme_submit" name="wdm_subme_submit" value="Subscribe" title="Please opt-in for email subscription">Subscribe</button>
		</p>
		<p class="wdm_agree_para">
			<span id="wdm_agree_span" style="color:#961914;">
				<label>
					<input name="wdm-agree" type="checkbox" value="1" /> Yes! I'd like to hear about important updates, exclusive offers, and informative content
				</label>
			</span>
		</p>
		<input type="text" id="wdm_honeypot" name="company_name" value="wdm_honeypot" style="display:none;"/>
		<?php wp_nonce_field( 'wdm_pe_subscriber', 'wdm_pe_subscriber' ); ?>
	</form>
</div>
