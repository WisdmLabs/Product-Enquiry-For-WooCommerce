// File: ./assets/admin/js/activation-popup.js
(function($){
	// Function to initialize popup
	function initActivationPopup() {
		// Check if activation banner should be shown
		// Handle both boolean true and string '1' or 'true'
		var shouldShow = typeof window.pefreeActivationPopup !== 'undefined' && 
			(window.pefreeActivationPopup.showPopup === true || 
			 window.pefreeActivationPopup.showPopup === '1' || 
			 window.pefreeActivationPopup.showPopup === 1 ||
			 window.pefreeActivationPopup.showPopup === 'true');
		
		if (shouldShow) {
			
			// Get popup data
			var popupData = window.pefreeActivationPopup;
			var proUrl = popupData.proUrl || '#';
			var demoUrl = popupData.demoUrl || '#';
			var ratingText = popupData.ratingText || '';
			var customersText = popupData.customersText || '';
			
			// Build HTML using string concatenation to avoid CSP issues with template literals
			var modalHtml = '<div id="pefree-activation-popup-overlay" style="display:none;">' +
				'<div id="pefree-activation-popup-modal" role="dialog" aria-modal="true" aria-labelledby="pefree-activation-popup-title">' +
					'<button type="button" class="pefree-activation-popup-close" aria-label="Close">' +
						'<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">' +
							'<path d="M18 6L6 18M6 6L18 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>' +
						'</svg>' +
					'</button>' +
					'<div class="pefree-activation-popup-content">' +
						'<div class="pefree-activation-popup-header">' +
							'<div class="pefree-activation-popup-icon">' +
								'<svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">' +
									'<circle cx="32" cy="32" r="32" fill="#961a1d" opacity="0.1"/>' +
									'<path d="M32 20V32L40 40M32 44C38.6274 44 44 38.6274 44 32C44 25.3726 38.6274 20 32 20C25.3726 20 20 25.3726 20 32C20 38.6274 25.3726 44 32 44Z" stroke="#961a1d" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>' +
								'</svg>' +
							'</div>' +
							'<h2 id="pefree-activation-popup-title">🎉 Welcome to Product Enquiry for WooCommerce!</h2>' +
							'<p class="pefree-activation-popup-subtitle">Unlock powerful Pro features to enhance your enquiry & quotation system</p>' +
						'</div>' +
						'<div class="pefree-activation-popup-features">' +
							'<h3>Pro Features Include:</h3>' +
							'<div class="pefree-features-grid">' +
								'<div class="pefree-feature-item">' +
									'<div class="pefree-feature-icon">📱</div>' +
									'<div class="pefree-feature-text">' +
										'<strong>WhatsApp Button Integration</strong>' +
										'<span>Enable WhatsApp enquiries directly from product pages</span>' +
									'</div>' +
								'</div>' +
								'<div class="pefree-feature-item">' +
									'<div class="pefree-feature-icon">📦</div>' +
									'<div class="pefree-feature-text">' +
										'<strong>Out of Stock Enquiry</strong>' +
										'<span>Show enquiry button only when product is out of stock</span>' +
									'</div>' +
								'</div>' +
								'<div class="pefree-feature-item">' +
									'<div class="pefree-feature-icon">🎨</div>' +
									'<div class="pefree-feature-text">' +
										'<strong>Drag and Drop Form Builder</strong>' +
										'<span>Create custom enquiry forms with ease</span>' +
									'</div>' +
								'</div>' +
								'<div class="pefree-feature-item">' +
									'<div class="pefree-feature-icon">📄</div>' +
									'<div class="pefree-feature-text">' +
										'<strong>Auto PDF Quote Generation</strong>' +
										'<span>Automatically generate professional PDF quotes</span>' +
									'</div>' +
								'</div>' +
								'<div class="pefree-feature-item">' +
									'<div class="pefree-feature-icon">✅</div>' +
									'<div class="pefree-feature-text">' +
										'<strong>Quotation Workflow</strong>' +
										'<span>Approval/rejection workflow for quotes</span>' +
									'</div>' +
								'</div>' +
								'<div class="pefree-feature-item">' +
									'<div class="pefree-feature-icon">🛒</div>' +
									'<div class="pefree-feature-text">' +
										'<strong>Multi-Product Enquiries</strong>' +
										'<span>Handle multiple products in single enquiry</span>' +
									'</div>' +
								'</div>' +
								'<div class="pefree-feature-item">' +
									'<div class="pefree-feature-icon">⚙️</div>' +
									'<div class="pefree-feature-text">' +
										'<strong>Advanced Button Options</strong>' +
										'<span>Customize enquiry button display settings</span>' +
									'</div>' +
								'</div>' +
								'<div class="pefree-feature-item">' +
									'<div class="pefree-feature-icon">🌐</div>' +
									'<div class="pefree-feature-text">' +
										'<strong>WPML Translation Support</strong>' +
										'<span>Fully translation-ready with WPML</span>' +
									'</div>' +
								'</div>' +
							'</div>' +
						'</div>' +
						'<div class="pefree-activation-popup-actions">' +
							'<a href="' + proUrl + '" target="_blank" rel="noopener" class="pefree-activation-btn-primary">' +
								'<span>Upgrade to Pro</span>' +
								'<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">' +
									'<path d="M6 12L10 8L6 4" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>' +
								'</svg>' +
							'</a>' +
							'<a href="' + demoUrl + '" target="_blank" rel="noopener" class="pefree-activation-btn-secondary">' +
								'View Demo' +
							'</a>' +
						'</div>' +
						'<div class="pefree-activation-popup-footer">' +
							(ratingText !== '' ? '<div class="pefree-activation-rating">' + ratingText + '</div>' : '') +
							(customersText !== '' ? '<div class="pefree-activation-customers">' + customersText + '</div>' : '') +
						'</div>' +
					'</div>' +
				'</div>' +
			'</div>';

			// Append modal to body if it doesn't exist
			if (!$('#pefree-activation-popup-overlay').length) {
				$('body').append(modalHtml);
			}

			// Function to open popup
			function openActivationPopup(){
				$('#pefree-activation-popup-overlay').fadeIn(300);
				$('body').css('overflow', 'hidden');
				$('#pefree-activation-popup-modal').addClass('pefree-popup-active');
			}

			// Function to close popup
			function closeActivationPopup(){
				$('#pefree-activation-popup-modal').removeClass('pefree-popup-active');
				$('#pefree-activation-popup-overlay').fadeOut(300);
				$('body').css('overflow', '');
				
				// Dismiss banner via AJAX
				if (window.pefreeActivationPopup.dismissNonce) {
					var data = {
						'action': 'pe_notice_dismiss',
						'notice_id': 'wdm_pefree_activation_banner_dismissed',
						'notice_nonce': window.pefreeActivationPopup.dismissNonce,
					};

					$.ajax({
						type: 'POST',
						url: ajaxurl,
						data: data
					});
				}
			}

			// Close on overlay or close button click
			$(document).on('click', '.pefree-activation-popup-close, #pefree-activation-popup-overlay', function(e){
				if (e.target.id === 'pefree-activation-popup-overlay' || $(e.target).closest('.pefree-activation-popup-close').length) {
					e.preventDefault();
					closeActivationPopup();
				}
			});

			// Prevent modal content clicks from closing
			$(document).on('click', '#pefree-activation-popup-modal', function(e){
				e.stopPropagation();
			});

			// Close on ESC key
			$(document).on('keydown', function(e){
				if (e.keyCode === 27 && $('#pefree-activation-popup-overlay').is(':visible')) {
					closeActivationPopup();
				}
			});

			// Auto-open popup on page load
			setTimeout(function(){
				openActivationPopup();
			}, 500);
		} else {
			// Retry after a short delay in case data loads late
			if (typeof window.pefreeActivationPopup === 'undefined') {
				setTimeout(function() {
					var retryShouldShow = typeof window.pefreeActivationPopup !== 'undefined' && 
						(window.pefreeActivationPopup.showPopup === true || 
						 window.pefreeActivationPopup.showPopup === '1' || 
						 window.pefreeActivationPopup.showPopup === 1 ||
						 window.pefreeActivationPopup.showPopup === 'true');
					if (retryShouldShow) {
						initActivationPopup();
					}
				}, 500);
			}
		}
	}
	
	// Try to initialize when DOM is ready
	$(document).ready(function(){
		initActivationPopup();
	});
	
	// Also try on window load as fallback
	$(window).on('load', function(){
		var loadShouldShow = typeof window.pefreeActivationPopup !== 'undefined' && 
			(window.pefreeActivationPopup.showPopup === true || 
			 window.pefreeActivationPopup.showPopup === '1' || 
			 window.pefreeActivationPopup.showPopup === 1 ||
			 window.pefreeActivationPopup.showPopup === 'true');
		if (loadShouldShow) {
			if (!$('#pefree-activation-popup-overlay').length) {
				initActivationPopup();
			}
		}
	});
})(jQuery);

