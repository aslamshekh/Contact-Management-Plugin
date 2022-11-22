<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://https://profiles.wordpress.org/wpboss/
 * @since      1.0.0
 *
 * @package    Contact_Management
 * @subpackage Contact_Management/admin/partials
 */
?>
<?php
if(isset($_GET['cm_action']) && !empty($_GET['cm_action'])){
	$action = 'edit';
	$action_id = $_GET['cm_action'];
    $personData = get_post($action_id);
	$wp_person_post_id = $personData->ID;
	$contact_id = get_post_meta($wp_person_post_id, "contact_id", true);
	$person_id = get_post_meta($wp_person_post_id, "person_id", true);
	$contact_number = get_post_meta($wp_person_post_id, "contact_number", true);
	$country_code = get_post_meta($wp_person_post_id, "country_code", true);
} else {
    if(isset($_GET['post']) && !empty($_GET['post'])){
	    $action = 'Add';
	    $person_id = $_GET['post'];
	    $contact_id = '';
	    $country_code = '';
	    $contact_number = "";
    }
    
}

$url = 'https://restcountries.com/v2/all';
$response = wp_remote_get( $url  );
if( is_array($response) ) {
	$header = $response['headers'];
	$body = $response['body'];
	$country_code_list = json_decode($body);
}
?>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
    <div id="icon-themes" class="icon32"></div>  
    <h2>Person Contact</h2>
                    
    <form method="post" class="wp-core-ui" action="<?php echo admin_url( 'admin-post.php' ); ?>">
        <table class="form-table">
            <tr valign="top">
            <th scope="row">ID</th>
            <td><input type="text" name="contact_id" value="<?php echo esc_attr( $contact_id ); ?>" required/></td>
            </tr>
            
            <tr valign="top">
            <th scope="row">Country Code</th>
            <td>
                <select class="cm_country_code" name="country_code">
                    <?php
                    if(isset($country_code_list) && !empty($country_code_list)){
                        foreach ($country_code_list as $countryData){
                            $countryCode = "(". $countryData->callingCodes[0] .")";
                            $countryName = $countryData->name;
                            ?>
                                <option value="<?php echo $countryName." ". $countryCode;  ?>"><?php echo $countryName." ". $countryCode;  ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </td>
            </tr>
            
            <tr valign="top">
            <th scope="row">Contact</th>
            <td><input type="text" name="contact_number" value="<?php echo esc_attr( $contact_number ); ?>" required/></td>
            </tr>
        </table>
        <?php wp_nonce_field( 'cm_person_add_form_data', 'cm_person_add_form_data_nonce' ); ?>
        <input type="hidden" name="cm_action" value="<?php if(isset($action_id) && !empty($action_id)){ echo $action_id; } ?>">
        <input type="hidden" name="person_id" value="<?php if(isset($person_id) && !empty($person_id)){ echo $person_id; } ?>">
        <input type="hidden" name="action" value="cm_person_contact_add">
        <?php submit_button(); ?>

    </form>
</div>