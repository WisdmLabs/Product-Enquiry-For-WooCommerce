<?php
/**
 * AI Product Enquiry Assistant Tab Content
 *
 * @package PEFree/template
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$pew_ai_assistant_link = 'https://wordpress.org/plugins/ai-botkit-for-lead-generation/';
$pew_install_url       = admin_url( 'plugin-install.php?s=ai-botkit-for-lead-generation&tab=search&type=term' );
?>
<div class="pefree-ai-assistant-section">
	<ul class="pefree-extensions-list">
		<li class="pefree-extension-item featured">
			<div class="pefree-extension-image">
				<img
					src="<?php echo esc_url( WDM_PE_PLUGIN_URL . 'assets/admin/img/ai-quote-assistant.png' ); ?>"
					alt="<?php esc_attr_e( 'AI BotKit for Lead Generation', 'product-enquiry-for-woocommerce' ); ?>"
					class="pefree-extension-preview-image"
				/>
			</div>
			<div class="pefree-extension-info">
				<div class="pefree-extension-header">
					<h3><?php esc_html_e( 'AI Product Enquiry Assistant', 'product-enquiry-for-woocommerce' ); ?></h3>
					<span class="pefree-featured-badge"><?php esc_html_e( '⭐ Featured', 'product-enquiry-for-woocommerce' ); ?></span>
				</div>

				<p><?php esc_html_e( 'Transform your product enquiries with AI-powered responses. Automatically answer customer questions, suggest relevant products, and convert enquiries into sales with intelligent chat assistance.', 'product-enquiry-for-woocommerce' ); ?></p>

				<ul class="pefree-extension-features">
					<li><?php esc_html_e( 'Instant AI-powered product answers', 'product-enquiry-for-woocommerce' ); ?></li>
					<li><?php esc_html_e( 'Smart product recommendations', 'product-enquiry-for-woocommerce' ); ?></li>
					<li><?php esc_html_e( '24/7 automated enquiry handling', 'product-enquiry-for-woocommerce' ); ?></li>
					<li><?php esc_html_e( 'Seamless integration with enquiry inbox', 'product-enquiry-for-woocommerce' ); ?></li>
				</ul>

				<div class="pefree-extension-action">
					<?php if ( ! file_exists( WP_PLUGIN_DIR . '/ai-botkit-for-lead-generation/ai-botkit-for-lead-generation.php' ) ) : ?>
						<button type="button" class="button button-primary pefree-install-ai-plugin" data-plugin="ai-botkit-for-lead-generation" data-action="install">
							<?php esc_html_e( 'Install Now', 'product-enquiry-for-woocommerce' ); ?>
						</button>
					<?php elseif ( ! is_plugin_active( 'ai-botkit-for-lead-generation/ai-botkit-for-lead-generation.php' ) ) : ?>
						<button type="button" class="button button-primary pefree-install-ai-plugin" data-plugin="ai-botkit-for-lead-generation" data-action="activate">
							<?php esc_html_e( 'Activate', 'product-enquiry-for-woocommerce' ); ?>
						</button>
					<?php else : ?>
						<span class="button button-disabled">
							<?php esc_html_e( 'Installed', 'product-enquiry-for-woocommerce' ); ?>
						</span>
					<?php endif; ?>
				</div>
			</div>
		</li>
	</ul>
</div>

<style>
.pefree-ai-assistant-section {
	padding: 20px 0;
}

.pefree-extensions-list {
	margin: 0;
	padding: 0;
	list-style: none;
}

.pefree-extension-item {
	display: flex;
	gap: 25px;
	background: #fff;
	border: 1px solid #c3c4c7;
	border-radius: 4px;
	padding: 20px;
	box-shadow: 0 1px 1px rgba(0,0,0,.04);
	transition: all 0.3s ease;
}

.pefree-extension-item:hover {
	border-color: #1a5c45;
	box-shadow: 0 2px 8px rgba(26, 92, 69, 0.15);
}

/* Featured badge on list item */
.pefree-extension-item.featured {
	position: relative;
	border-left: 4px solid #1a5c45;
}

.pefree-extension-image {
	flex: 0 0 400px;
	max-width: 400px;
}

.pefree-extension-preview-image {
	display: block;
	width: 100%;
	height: auto;
	border-radius: 4px;
	transition: transform 0.3s ease;
}

.pefree-extension-image:hover .pefree-extension-preview-image {
	transform: scale(1.02);
}

.pefree-extension-info {
	flex: 1;
	min-width: 0;
}

.pefree-extension-header {
	display: flex;
	justify-content: space-between;
	align-items: center;
	margin-bottom: 15px;
	padding-bottom: 15px;
	border-bottom: 1px solid #f0f0f1;
}

.pefree-extension-header h3 {
	margin: 0;
	font-size: 18px;
	font-weight: 600;
	color: #1d2327;
}

.pefree-featured-badge {
	background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%);
	color: #fff;
	padding: 5px 12px;
	border-radius: 20px;
	font-size: 11px;
	font-weight: 700;
	text-transform: uppercase;
	letter-spacing: 0.5px;
}

.pefree-extension-info > p {
	margin: 0 0 15px;
	font-size: 14px;
	line-height: 1.6;
	color: #3c434a;
}

.pefree-extension-features {
	margin: 0 0 20px;
	padding: 0;
	list-style: none;
	display: grid;
	grid-template-columns: repeat(2, 1fr);
	gap: 8px 20px;
}

.pefree-extension-features li {
	padding: 5px 0 5px 22px;
	font-size: 13px;
	color: #3c434a;
	position: relative;
}

.pefree-extension-features li:before {
	content: '✓';
	position: absolute;
	left: 0;
	color: #1a5c45;
	font-weight: bold;
}

.pefree-extension-action {
	margin-top: 15px;
	display: flex;
	gap: 10px;
	flex-wrap: wrap;
}

.pefree-extension-action .button-primary {
	background-color: #1a5c45;
	border-color: #1a5c45;
	color: #fff;
	padding: 8px 20px;
	height: auto;
	line-height: 1.5;
	font-size: 13px;
}

.pefree-extension-action .button-primary:hover {
	background-color: #154a37;
	border-color: #154a37;
}

.pefree-extension-action .button-secondary {
	padding: 8px 20px;
	height: auto;
	line-height: 1.5;
	font-size: 13px;
}

.pefree-extension-action .button-disabled {
	background: #f0f0f1 !important;
	border: 1px solid #c3c4c7 !important;
	color: #3c434a !important;
	padding: 8px 20px;
	height: auto;
	line-height: 1.5;
	font-size: 13px;
	box-shadow: none !important;
	text-shadow: none !important;
	outline: none !important;
}

.pefree-extension-action button.processing {
	opacity: 0.7;
	cursor: wait;
}

/* Responsive */
@media (max-width: 782px) {
	.pefree-extension-item {
		flex-direction: column;
	}

	.pefree-extension-image {
		flex: 0 0 auto;
		max-width: 100%;
	}

	.pefree-extension-features {
		grid-template-columns: 1fr;
	}
}
</style>

<script type="text/javascript">
jQuery(document).ready(function($) {
	$('.pefree-install-ai-plugin').on('click', function(e) {
		e.preventDefault();
		var $button = $(this);
		var plugin = $button.data('plugin');
		var action = $button.data('action');

		if ($button.hasClass('processing')) {
			return;
		}

		$button.addClass('processing').text(action === 'install' ? 'Installing...' : 'Activating...');

		$.ajax({
			url: ajaxurl,
			type: 'POST',
			data: {
				action: 'pefree_install_ai_plugin',
				plugin: plugin,
				plugin_action: action,
				nonce: '<?php echo esc_js( wp_create_nonce( 'pefree_install_ai_plugin' ) ); ?>'
			},
			success: function(response) {
				if (response.success) {
					if (action === 'install') {
						$button.text('Activate').data('action', 'activate');
						location.reload();
					} else {
						$button.replaceWith('<span class="button button-disabled">Active</span>');
					}
				} else {
					alert(response.data.message || 'Installation failed. Please try again.');
					$button.removeClass('processing').text(action === 'install' ? 'Install Now' : 'Activate');
				}
			},
			error: function() {
				alert('An error occurred. Please try again.');
				$button.removeClass('processing').text(action === 'install' ? 'Install Now' : 'Activate');
			}
		});
	});
});
</script>
