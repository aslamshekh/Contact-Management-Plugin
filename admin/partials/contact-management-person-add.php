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

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
    <div id="icon-themes" class="icon32"></div>  
    <h2>Person Add</h2>  
                    
    <form method="post" action="<?php echo admin_url( 'admin-post.php' ); ?>">                   
        <table class="form-table">
            <tr valign="top">
            <th scope="row">Id</th>
            <td><input type="text" name="person_id" value="<?php echo esc_attr( get_option('new_option_name') ); ?>" required/></td>
            </tr>
            
            <tr valign="top">
            <th scope="row">Person Name</th>
            <td><input type="text" name="person_name" value="<?php echo esc_attr( get_option('some_other_option') ); ?>" required/></td>
            </tr>
            
            <tr valign="top">
            <th scope="row">Email</th>
            <td><input type="email" name="person_email" value="<?php echo esc_attr( get_option('option_etc') ); ?>" required/></td>
            </tr>
        </table>
        <?php wp_nonce_field( 'cm_person_add_form_data', 'cm_person_add_form_data_nonce' ); ?>
        <input type="hidden" name="action" value="cm_person_add">
        <?php submit_button(); ?>

    </form>
</div>