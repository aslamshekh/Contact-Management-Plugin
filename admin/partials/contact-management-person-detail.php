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
if ( isset($_GET[ 'post' ]) && !empty($_GET[ 'post' ]) ) {
	$action = 'edit';
	$action_id = $_GET[ 'post' ];
	$personData = get_post($action_id);
	$wp_person_post_id = $personData->ID;
	$person_id = get_post_meta($wp_person_post_id, "person_id", true);
	$person_name = get_post_meta($wp_person_post_id, "person_name", true);
	$person_email = get_post_meta($wp_person_post_id, "person_email", true);
	
	$getContactDetails = array(
		'author' => $wp_person_post_id,
		'post_type'   => 'cm_person_contact',
		'post_status'   => 'publish',
  
	);
	$contactData = get_posts($getContactDetails);
}

?>

<div class="wrap">
    <div id="icon-themes" class="icon32"></div>
    <h1 class="wp-heading-inline">Person Detail</h1>
    <table id="person_detail">
        <tr>
            <td>ID:</td>
            <td><?php echo $person_id; ?></td>
        </tr>
        <tr>
            <td>Name:</td>
            <td><?php echo $person_name; ?></td>
        </tr>
        <tr>
            <td>Email:</td>
            <td><?php echo $person_email; ?></td>
        </tr>
        <tr>
            <td>Contact:</td>
            <td colspan="5">
                <?php
                if(isset($contactData) && !empty($contactData)){
	                $wp_contact_post_id = $contactData[0]->ID;
	                $contact_id = get_post_meta($wp_contact_post_id, "contact_id", true);
	                $person_id = get_post_meta($wp_contact_post_id, "person_id", true);
	                $contact_number = get_post_meta($wp_contact_post_id, "contact_number", true);
	                $country_code = get_post_meta($wp_contact_post_id, "country_code", true);
                    ?>
                    <table>
                        <tr>
                            <td>Country Code</td>
                            <td>Contact Number</td>
                            <td>Action</td>
                        </tr>
                        <tr>
                            <td><?php echo $country_code; ?></td>
                            <td><?php echo $contact_number; ?></td>
                            <td>
                          <span class="edit">
                            <a href="<?php echo admin_url( '/admin.php?page=cm-person-add&cm_action='.$wp_person_post_id ); ?>">Edit</a> | </span>
                                <a href="<?php echo get_delete_post_link($wp_contact_post_id); ?>" class="submitdelete">Delete</a> </span>
                                </span>
                            </td>
                        </tr>
                    </table>
                    <?php
                }
                ?>
                
            </td>
        </tr>
    </table>

</div>