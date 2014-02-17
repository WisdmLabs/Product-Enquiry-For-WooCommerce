<?php
/*
Plugin Name: Product Enquiry for WooCommerce
Description: Allows prospective customers or visitors to make enquiry about a product, right from within the product listing page.
Version: 0.2.9
Author: WisdmLabs
Author URI: http://wisdmlabs.com
License: GPL2
*/

$form_init_data = get_option( 'wdm_form_data');

if(!empty($form_init_data))
{
    if($form_init_data['show_after_summary'] == 1)
    {
	//show ask button after a single product summary
        add_action('woocommerce_after_single_product_summary', 'ask_about_product');
    }

    if($form_init_data['show_at_page_end'] == 1)
    {
	//show ask button at the end of the page of a single product
        add_action('woocommerce_after_single_product', 'ask_about_product');
    }
}
else
{
    //show ask button after a single product summary as default
    add_action('woocommerce_after_single_product_summary', 'ask_about_product');
}

function ask_about_product()
{
    $form_data = get_option( 'wdm_form_data');
    ?>
     <br />
     <!-- Page styles -->
     <?php
            wp_enqueue_style("wdm-contact-css", plugins_url("css/contact.css", __FILE__));
     ?>

    <div id="contact-form">
            <input type="button" name="contact" value="<?php echo empty($form_data['custom_label']) ? 'Make an enquiry for this product' : $form_data['custom_label'];?>" class="contact wpi-button" />
    </div>		
		<!-- preload the images -->
		<div style='display:none'>
			<img src='<?php echo plugins_url("img/contact/loading.gif", __FILE__)?>' alt='' />
		</div>
   
    <!-- Load JavaScript files -->
   <?php
        wp_enqueue_script("wdm-simple-modal", plugins_url("js/jquery.simplemodal.js", __FILE__), array("jquery"));
        wp_enqueue_script("wdm-contact", plugins_url("js/contact.js", __FILE__), array("jquery"));
        
	//pass parameters to contact.php file
        $wdm_translation_array = array( 'product_name'=>get_the_title(), 'contact_url' => plugins_url("data/contact.php", __FILE__), 'form_dataset' => $form_data, 'admin_email' => get_option('admin_email'), 'site_name' => get_bloginfo('name'));
        wp_localize_script( 'wdm-contact', 'object_name', $wdm_translation_array );

}

add_action('admin_menu', 'create_ask_product_menu');

function create_ask_product_menu()
{
    //create a submenu under Woocommerce 'Products' menu
    add_submenu_page('edit.php?post_type=product', 'Product Enquiry', 'Product Enquiry', 'manage_options', 'product-enquiry-for-woocommerce', 'add_ask_product_settings' );
}

add_action('admin_init', 'reg_form_setting' );

function reg_form_setting()
{
    //register plugin settings
    register_setting('wdm_form_options','wdm_form_data');
}

function add_ask_product_settings()
{
    //settings page
    
    wp_enqueue_script('wdm_wpi_validation', plugins_url("js/wdm-jquery-validate.js", __FILE__), array('jquery'));
    
    ?>
      <div class="wrap wdm_leftwrap">
        <h2>Product Enquiry</h2>

     <form name="ask_product_form" id="ask_product_form" method="POST" action="options.php">
        <?php
            settings_fields('wdm_form_options');
            $default_vals =   array('show_after_summary'=>1        
                                    );
            $form_data = get_option( 'wdm_form_data', $default_vals);
            ?>
            
      <div id="ask_abt_product_panel">
        <p>
            <label for="wdm_user_email"> Recipient's Email </label> <br />
        <input type="text" class="wdm_wpi_input wdm_wpi_text email" name="wdm_form_data[user_email]" id="wdm_user_email" value="<?php echo empty($form_data['user_email']) ? get_option('admin_email') : $form_data['user_email'];?>" />
        </p>
        
        <p>
            <label for="wdm_default_sub"> Default Subject (<em> will be used if the customer does not enter a subject </em>)</label> <br />
        <input type="text" class="wdm_wpi_input wdm_wpi_text" name="wdm_form_data[default_sub]" id="wdm_default_sub" value="<?php echo empty($form_data['default_sub']) ? 'Enquiry for a product from '.get_bloginfo('name') : $form_data['default_sub'];?>"  />
        </p>
        
	<p>
            <label for="custom_label"> Label for enquiry button </label> <br />
            <input type="text" class="wdm_wpi_input wdm_wpi_text" name="wdm_form_data[custom_label]" value="<?php echo empty($form_data['custom_label']) ? 'Make an enquiry for this product' : $form_data['custom_label'];?>" id="custom_label"  />
        </p>
	
        <p>
            <input type="checkbox" class="wdm_wpi_input wdm_wpi_checkbox" name="wdm_form_data[show_after_summary]" value="1" <?php checked( 1, $form_data["show_after_summary"] );?> id="show_after_summary" />
	    <label for="show_after_summary"> Show ask button after single product summary </label>
        </p>
        
        <p>
            <input type="checkbox" class="wdm_wpi_input wdm_wpi_checkbox" name="wdm_form_data[show_at_page_end]" value="1" <?php checked( 1, $form_data["show_at_page_end"] );?> id="show_at_page_end" />
	    <label for="show_at_page_end"> Show ask button at the end of single product page </label>
        </p>
	
        <p>
            <input type="checkbox" class="wdm_wpi_input wdm_wpi_checkbox" name="wdm_form_data[enable_send_mail_copy]" value="1" <?php checked( 1, $form_data["enable_send_mail_copy"] );?> id="enable_send_mail_copy" />
	    <label for="enable_send_mail_copy"> Enable option on the enquiry form to send an email copy to customer </label>
        </p>
	
        <p>
            <input type="submit" class="wdm_wpi_input button-primary" value="Save changes" id="wdm_ask_button" />
        </p>
        </div>
      
    </form>

    </div>
      
    <script type="text/javascript">
	jQuery(document).ready(
			       function()
			       {
					jQuery("#ask_product_form").validate();	
				}
				);
    </script>
    
      <?php
      //add styles for settings page
      wp_enqueue_style("wdm-admin-css", plugins_url("css/wpi_admin.css", __FILE__));
      
      //include WisdmLabs sidebar
    
    $plugin_data  = get_plugin_data(__FILE__);
    $plugin_name = $plugin_data['Name'];
    $wdm_plugin_slug = 'product-enquiry-for-woocommerce';
    
    include_once('wisdm_sidebar/wisdm_sidebar.php');
    pew_create_wisdm_sidebar($plugin_name, $wdm_plugin_slug);
}

function pew_appeal_notice()
{
    if((isset($_REQUEST['page']) && $_REQUEST['page'] == 'product-enquiry-for-woocommerce') && (isset($_REQUEST['settings-updated']) && $_REQUEST['settings-updated'] == true))
    {
	$wdm_plugin_slug = 'product-enquiry-for-woocommerce';
    
	?>
    
	<div class="wdm_appeal_text" style="background-color:#FFE698;padding:10px;margin-right:10px;">
	    <strong>An Appeal:</strong>
	    We strive hard to bring you useful, high quality plugins for FREE and to provide prompt responses to all your support queries.
	    If you are happy with our work, please consider making a good faith donation, here -
	    <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=info%40wisdmlabs%2ecom&lc=US&item_name=WisdmLabs%20Plugin%20Donation&no_note=0&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHostedGuest" target="_blank"> Donate now</a> 
	    and do post an encouraging review, here - <a href="http://wordpress.org/support/view/plugin-reviews/<?php echo $wdm_plugin_slug; ?>" target="_blank"> Review this plugin</a>.
	</div>
    
	<?php
    }
}

add_action('admin_notices', 'pew_appeal_notice');
?>
