// File: ./assets/admin/js/upsell.js
(function($){
	$(function(){
		// Append upsell modal once
		var modalHtml = `
			<div id="pefree-upsell-overlay" style="display:none;">
				<div id="pefree-upsell-modal" role="dialog" aria-modal="true" aria-labelledby="pefree-upsell-title">
					<button type="button" class="pefree-upsell-close" aria-label="Close">×</button>
					<div class="pefree-upsell-content">
						<h2 id="pefree-upsell-title">${(window.pefreeUpsell && pefreeUpsell.title ? pefreeUpsell.title : 'Unlock Pro Features')}</h2>
						<p>${(window.pefreeUpsell && pefreeUpsell.message ? pefreeUpsell.message : 'This is a Pro feature. Upgrade to Product Enquiry Pro to enable this setting and more.')}</p>
						<ul class="pefree-upsell-benefits">
							<li>Multi-product enquiries and quotes</li>
							<li>Quotation workflow with approval/rejection</li>
							<li>PDF quotes and email customization</li>
						</ul>
						<div class="pefree-upsell-actions">
							<a class="button button-primary" target="_blank" rel="noopener" href="${(window.pefreeUpsell && pefreeUpsell.proUrl ? pefreeUpsell.proUrl : '#')}">${(window.pefreeUpsell && pefreeUpsell.ctaText ? pefreeUpsell.ctaText : 'Get Pro')}</a>
							<a class="button" target="_blank" rel="noopener" href="${(window.pefreeUpsell && pefreeUpsell.demoUrl ? pefreeUpsell.demoUrl : '#')}">${(window.pefreeUpsell && pefreeUpsell.demoText ? pefreeUpsell.demoText : 'View Demo')}</a>
						</div>
					</div>
				</div>
			</div>`;

		if (!$('#pefree-upsell-overlay').length) {
			$('body').append(modalHtml);
		}

		function openUpsell(){
			$('#pefree-upsell-overlay').fadeIn(150);
		}
		function closeUpsell(){
			$('#pefree-upsell-overlay').fadeOut(150);
		}

		$(document).on('click', '.pefree-upsell-close, #pefree-upsell-overlay', function(e){
			if (e.target.id === 'pefree-upsell-overlay' || $(e.target).hasClass('pefree-upsell-close')) {
				e.preventDefault();
				closeUpsell();
			}
		});

		// Trigger modal for disabled (Pro) fields
		$(document).on('click focus keydown', '.wdm_disabled, .pew_pro_txt', function(){
			// Do not break default tooltips or links; just show the modal
			openUpsell();
		});

		// Also nudge when hovering Pro markers
		$(document).on('mouseenter', '.pew_pro_txt', function(){
			$(this).css('cursor','pointer');
		});
	});
})(jQuery);


