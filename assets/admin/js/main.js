jQuery( window ).load(
	function() {

		// console.log(jQuery(".content-wrapper, .image-wrapper"));

		jQuery( ".content-wrapper, .image-wrapper" ).viewportChecker(
			{
				classToAdd: "visible",
				classToAddForFullView: "",
				offset: 150,
				invertBottomOffset: 0,
				repeat: false
			}
		);
	}
);
function scrollDown(){
	var nextElemTop = jQuery( '.add-enquiry' ).offset().top;
	jQuery( 'body' ).on(
		'click',
		'#scroll-down',
		function(){
			jQuery( 'html,body' ).animate( {scrollTop : nextElemTop},800 );
		}
	);
}
jQuery( document ).ready(
	function(){
		scrollDown();
	}
);
jQuery( window ).on( "debouncedresize", scrollDown );
