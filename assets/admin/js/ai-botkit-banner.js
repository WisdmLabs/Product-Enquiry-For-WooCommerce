/**
 * AI BotKit Banner Dismissal Handler
 */
(function($) {
	'use strict';

	$(document).ready(function() {
		// Handle AI BotKit banner dismissal.
		$(document).on('click', '.mmrm-ai-botkit-banner .mmrm-ai-banner-close', function(e) {
			e.preventDefault();

			var $banner = $(this).closest('.mmrm-ai-botkit-banner');
			var nonce = $banner.data('nonce');

			// Hide banner immediately for better UX.
			$banner.fadeOut(300, function() {
				$(this).remove();
			});

			// Send AJAX request to dismiss banner.
			$.ajax({
				type: 'POST',
				url: pefreeAIBanner.ajaxUrl,
				data: {
					action: 'pefree_dismiss_ai_banner',
					nonce: nonce
				},
				success: function(response) {
					if (!response.success) {
						console.error('Failed to dismiss banner:', response.data);
					}
				},
				error: function(xhr, status, error) {
					console.error('AJAX error:', error);
				}
			});
		});
	});
})(jQuery);

