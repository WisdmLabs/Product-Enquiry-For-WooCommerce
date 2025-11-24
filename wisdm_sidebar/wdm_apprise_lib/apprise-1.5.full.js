// Apprise 1.5 by Daniel Raftery
// http://thrivingkings.com/apprise
//
// Button text added by Adam Bezulski
//

function apprise(string, args, callback)
	{
	var default_args =
		{
		'confirm'		:	false, 		// Ok and Cancel buttons
		'verify'		:	false,		// Yes and No buttons
		'input'			:	false, 		// Text input (can be true or string for default text)
		'animate'		:	false,		// Groovy animation (can true or number, default is 400)
		'textOk'		:	'Ok',		// Ok button default text
		'textCancel'	:	'Cancel',	// Cancel button default text
		'textYes'		:	'Yes',		// Yes button default text
		'textNo'		:	'No'		// No button default text
		}
	
	if(args) 
		{
		for(var index in default_args) 
			{ if(typeof args[index] == "undefined") args[index] = default_args[index]; } 
		}
	
	var aHeight = jQuery(document).height();
	var aWidth = jQuery(document).width();
	jQuery('body').append('<div class="appriseOverlay" id="aOverlay"></div>');
	jQuery('.appriseOverlay').css('height', aHeight).css('width', aWidth).fadeIn(100);
	jQuery('body').append('<div class="appriseOuter"></div>');
	jQuery('.appriseOuter').append('<div class="appriseInner"></div>');
	jQuery('.appriseInner').append(string);
    jQuery('.appriseOuter').css("left", ( jQuery(window).width() - jQuery('.appriseOuter').width() ) / 2+jQuery(window).scrollLeft() + "px");
    
    if(args)
		{
		if(args['animate'])
			{ 
			var aniSpeed = args['animate'];
			if(isNaN(aniSpeed)) { aniSpeed = 400; }
			jQuery('.appriseOuter').css('top', '-200px').show().animate({top:"100px"}, aniSpeed);
			}
		else
			{ jQuery('.appriseOuter').css('top', '100px').fadeIn(200); }
		}
	else
		{ jQuery('.appriseOuter').css('top', '100px').fadeIn(200); }
    
    if(args)
    	{
    	if(args['input'])
    		{
    		if(typeof(args['input'])=='string')
    			{
    			jQuery('.appriseInner').append('<div class="aInput"><input type="text" class="aTextbox" t="aTextbox" value="'+args['input']+'" /></div>');
    			}
    		else
    			{
				jQuery('.appriseInner').append('<div class="aInput"><input type="text" class="aTextbox" t="aTextbox" /></div>');
				}
			jQuery('.aTextbox').focus();
    		}
    	}
    
    jQuery('.appriseInner').append('<div class="aButtons"></div>');
    if(args)
    	{
		if(args['confirm'] || args['input'])
			{ 
			jQuery('.aButtons').append('<button value="ok">'+args['textOk']+'</button>');
			jQuery('.aButtons').append('<button value="cancel">'+args['textCancel']+'</button>'); 
			}
		else if(args['verify'])
			{
			jQuery('.aButtons').append('<button value="ok">'+args['textYes']+'</button>');
			jQuery('.aButtons').append('<button value="cancel">'+args['textNo']+'</button>');
			}
		else
			{ jQuery('.aButtons').append('<button value="ok">'+args['textOk']+'</button>'); }
		}
    else
    	{ jQuery('.aButtons').append('<button value="ok">Ok</button>'); }
	
	jQuery(document).keydown(function(e) 
		{
		if(jQuery('.appriseOverlay').is(':visible'))
			{
			if(e.keyCode == 13) 
				{ jQuery('.aButtons > button[value="ok"]').click(); }
			if(e.keyCode == 27) 
				{ jQuery('.aButtons > button[value="cancel"]').click(); }
			}
		});
	
	var aText = jQuery('.aTextbox').val();
	if(!aText) { aText = false; }
	jQuery('.aTextbox').keyup(function()
    	{ aText = jQuery(this).val(); });
   
    jQuery('.aButtons > button').click(function()
    	{
    	jQuery('.appriseOverlay').remove();
		jQuery('.appriseOuter').remove();
    	if(callback)
    		{
			var wButton = jQuery(this).attr("value");
			if(wButton=='ok')
				{ 
				if(args)
					{
					if(args['input'])
						{ callback(aText); }
					else
						{ callback(true); }
					}
				else
					{ callback(true); }
				}
			else if(wButton=='cancel')
				{ callback(false); }
			}
		});
	}
