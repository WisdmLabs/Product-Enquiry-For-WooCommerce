<?php

//WisdLabs Sidebar

function pew_create_wisdm_sidebar($plugin_name, $wdm_plugin_slug)
{
   wp_enqueue_script('wdm_banner_fade_script',plugins_url('js/bjqs-1.3.min.js', __FILE__),array('jquery'));
   wp_enqueue_style('wisdm_sidebar_css', plugins_url('wisdm_sidebar.css', __FILE__));
   wp_enqueue_script('wdm_apprise_script',plugins_url('wdm_apprise_lib/apprise-1.5.full.js',__FILE__),array('jquery'));
   wp_enqueue_style('wdm_apprise_style',plugins_url('wdm_apprise_lib/apprise.css',__FILE__));
   
   ?>

   <!--main starts-->
   <div id="wisdm_main_content">
   
    <!--container starts-->
    <div id="wisdm_container">
        <p>This plugin is brought to you by</p>
        
        <!--logo starts-->
        <a href="http://wisdmlabs.com" target="_blank"><div id="wdm-logo"></div></a> <!--logo ends-->
        
        <div class="hr"></div>
        
        <p>Rate this plugin</p>
        <a href="http://wordpress.org/support/view/plugin-reviews/<?php echo $wdm_plugin_slug; ?>" target="_blank"><div id="rating-stars"></div></a>
        
        <div class="hr"></div>
        
        <ul id="left-list">
	 <li><a href="http://profiles.wordpress.org/WisdmLabs/" target="_blank">More Plugins</a></li>
            <li><a href="http://wisdmlabs.com" target="_blank">At WisdmLabs</a></li>
        </ul>
        
        <ul id="right-list">
            <li><a href="http://wordpress.org/support/plugin/<?php echo $wdm_plugin_slug; ?>" target="_blank">Support</a></li>
	    <li><a href="http://wisdmlabs.com/services/" target="_blank">Services</a></li>
        </ul>
        
        <div class="clear"></div>
        <div class="hr"></div>
        
        <p id="text-left-align">Help improve this plugin by donating</p>
        <div id="wdm-donate">
	 <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
	 <input type="hidden" name="cmd" value="_donations">
	 <input type="hidden" name="business" value="info@wisdmlabs.com">
	 <input type="hidden" name="lc" value="US">
	 <input type="hidden" name="item_name" value="WisdmLabs Plugin Donation">
	 <input type="hidden" name="no_note" value="0">
	 <input type="hidden" name="currency_code" value="USD">
	 <input type="hidden" name="bn" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHostedGuest">
	 <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
	 <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
	 </form>
	 
	</div>
        
        <div class="clear"></div>
        <div class="hr"></div>
        
        <div id="ad">
            <!--  Outer wrapper for presentation only, this can be anything you like -->
      <div id="banner-fade">

        <!-- start Basic Jquery Slider -->
        <ul class="bjqs">
          <li><img src="<?php echo plugins_url('images/wp-plugin-specialists.jpg', __FILE__); ?>"></li>
          <li><img src="<?php echo plugins_url('images/api-programming.jpg', __FILE__); ?>"></li>
          <li><img src="<?php echo plugins_url('images/eCommerce-solutions.jpg', __FILE__); ?>"></li>
          <li><img src="<?php echo plugins_url('images/responsive-design.jpg', __FILE__); ?>"></li>
        </ul>
        <!-- end Basic jQuery Slider -->

      </div>
      <!-- End outer wrapper -->
        </div> <!--ad ends-->
        
        <div class="hr"></div>
        
        <p> <a id="enquiry-form"> Make Custom Development Enquiry </a> </p>
        
        <form id="cde-form" method="post" action="">
            <input type="text" name="cde-full-name" id="cde-full-name" placeholder="Full Name" class="required" />
            <input type="email" name="cde-email" id="cde-email" placeholder="Email" class="required email" />
	    <input type="text" name="cde-site-url" id="cde-site-url" placeholder="Site URL" class="url" value="<?php echo get_bloginfo('wpurl');?>" /> 
            <textarea id="cde-message" name="cde-message" placeholder="Message" class="required" ></textarea>
            <input type="submit" id="cde-submit" name="cde-submit" value="Send" />
        </form>
        
    </div> <!--container ends-->
   </div> <!--main ends-->

<script type="text/javascript">

jQuery(document).ready(function(){
   
   jQuery("#cde-form").hide();
   
   jQuery("#enquiry-form").click(function () {
   jQuery('#cde-form').slideToggle();
      jQuery('html, body').animate({scrollTop:jQuery(document).height()}, 'slow');
        return false;
});
});
</script>

<script class="secret-source">
        jQuery(document).ready(function($) {

          $('#banner-fade').bjqs({
            height      : 152,
            width       : 220,
            automatic : true,
            animtype : 'fade',
            animduration : 1250, // how fast the animation are
            animspeed : 3000, // the delay between each slide
            responsive  : true,
            showcontrols : false,
            showmarkers : false, // Show individual slide markers
            centermarkers : true // Center markers horizontally
          });

        });
      </script>

<?php
    wp_enqueue_script('wdm_cde_validation', plugins_url('js/wdm-validate.js',__FILE__), array('jquery'));
?>

<script type='text/javascript'>
jQuery(document).ready(function()
		       {
			
			//jQuery('#cde-form').validate();
			
			jQuery('#cde-submit').click(
						function()
						    {
				    if(jQuery('#cde-form').valid() == true)
					jQuery('#cde-submit').val('Sending ...');
					
				else
					jQuery('#cde-submit').val('Send');
			
		       }
		       );
			}
			);
</script>

<?php     
   if(isset($_POST["cde-submit"]))
   {
      $to = 'support@wisdmlabs.com';
      
      $site_url = !empty($_POST["cde-site-url"]) ? '<a href="'. $_POST["cde-site-url"] .'">'. $_POST["cde-site-url"] .'</a>' : 'Not specified';
      $user_name = isset($_POST["cde-full-name"]) ? $_POST["cde-full-name"] : 'Not specified';
      $user_email = isset($_POST["cde-email"]) ? $_POST["cde-email"] : 'Not specified';
      $enquiry_message = isset($_POST["cde-message"]) ? $_POST["cde-message"] : 'Not specified';
      $subject = 'CDE for '.$plugin_name;
      
      $message = '';
      $message .= '<strong>Name:</strong> '. $user_name .'<br />';
      $message .= '<strong>Email:</strong> '. $user_email .'<br />';
      $message .= '<strong>Website URL:</strong> ' . $site_url.'<br />';
      $message .= '<strong>Referring Plugin:</strong> '. $plugin_name .'<br /><br />';
      $message .= '<strong>Enquiry message:</strong><br />' . $enquiry_message ;
      
      add_filter( 'wp_mail_from', 'pew_wdm_mail_from' );
      add_filter( 'wp_mail_from_name', 'pew_wdm_mail_from_name' );
      add_filter('wp_mail_content_type','pew_cde_set_contenttype');
      
      if(wp_mail( $to, $subject, $message, '', ''))
      {
	?>
	<script type="text/javascript">
	       jQuery(document).ready(
	       function()
		  {
		     apprise("Thank you for your enquiry. We'll get back to you soon. <br /><br /> <div class='wdm_cheers' style='float:left;'> Cheers! <br /> WisdmLabs Team </div>");
		  }
	       );
	</script>
	<?php
      }
      
      else
      {
	 ?>
	<script type="text/javascript">
	       jQuery(document).ready(
	       function()
		  {
		     apprise("Sorry, Your enquiry could not be sent.");
		  }
	       );
	</script>
	<?php
      }
      remove_filter( 'wp_mail_from', 'pew_wdm_mail_from' );
      remove_filter( 'wp_mail_from_name', 'pew_wdm_mail_from_name' );
      remove_filter('wp_mail_content_type','pew_cde_set_contenttype');
   }
}

function pew_cde_set_contenttype()
{
   return 'text/html';
}

function pew_wdm_mail_from($email)
{
   $email = isset($_POST["cde-email"]) ? $_POST["cde-email"] : '';
   return $email;
}

function pew_wdm_mail_from_name($name)
{
   $name = isset($_POST["cde-full-name"]) ? $_POST["cde-full-name"] : '';
   return $name;
}
?>