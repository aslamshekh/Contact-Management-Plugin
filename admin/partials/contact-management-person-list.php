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
$personArgs = array(
	'post_type'   => 'cm_person',
	'numberposts' => -1,
	'post_status' => 'publish'
);
$personList = get_posts($personArgs);

?>
<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
    .submitdelete{
        color: #b32d2e;
    }
    #person_list {
        margin-top: 20px
    }
</style>
<div class="wrap">
    <div id="icon-themes" class="icon32"></div>
    <h1 class="wp-heading-inline"><?php esc_html_e( 'Person List', 'contact_manager' ); ?></h1>
    <a href="<?php echo admin_url( '/admin.php?page=cm-person-add' ); ?>" class="page-title-action">
	    <?php esc_html_e( 'ADD PERSON', 'contact_manager' ); ?>
    </a>
    
    <table id="person_list">
        <tr>
            <th><?php esc_html_e( 'ID', 'contact_manager' ); ?></th>
            <th><?php esc_html_e( 'Name', 'contact_manager' ); ?></th>
            <th><?php esc_html_e( 'Email', 'contact_manager' ); ?></th>
            <th><?php esc_html_e( 'Contact', 'contact_manager' ); ?></th>
            <th><?php esc_html_e( 'Action', 'contact_manager' ); ?></th>
        </tr>
        <?php
            if(isset($personList) && !empty($personList)){
                foreach ($personList as $personData){
	                $wp_person_post_id = $personData->ID;
	                $person_id = get_post_meta($wp_person_post_id, "person_id", true);
	                $person_name = get_post_meta($wp_person_post_id, "person_name", true);
	                $person_email = get_post_meta($wp_person_post_id, "person_email", true);
	
	                $person_contact = array();
	                $getContactDetails = array(
		                'author' => $wp_person_post_id,
		                'post_type'   => 'cm_person_contact',
		                'post_status'   => 'publish',
	                );
	                $person_contact = get_posts($getContactDetails);
	                ?>
                    <tr>
                        <td><?php echo $person_id; ?></td>
                        <td><?php echo $person_name; ?></td>
                        <td><?php echo $person_email; ?></td>
                        <td>
                            <?php
                                if(isset($person_contact) && !empty($person_contact)) {
	                                $wp_contact_post_id = $person_contact[0]->ID;
	                                $contact_number = get_post_meta($wp_contact_post_id, "contact_number", true);
	                                $country_code = get_post_meta($wp_contact_post_id, "country_code", true);
                                    echo $country_code . " " . $contact_number;
                                } else {
                                    ?>
                                    <span class="edit">
                                        <a class="page-title-action" href="<?php echo admin_url( '/admin.php?page=cm-person-contact&post='.$wp_person_post_id ); ?>">
                                            <?php esc_html_e( 'ADD CONTACT', 'contact_manager' ); ?>
                                        </a></span>
                                    </span>
                                    <?php
                                }
                            ?>
                        </td>
                        
                        <td>
                          <span class="edit">
                            <a href="<?php echo admin_url( '/admin.php?page=cm-person-detail&post='.$wp_person_post_id ); ?>"><?php esc_html_e( 'Detail', 'contact_manager' ); ?></a> | </span>
                            <a href="<?php echo admin_url( '/admin.php?page=cm-person-add&cm_action='.$wp_person_post_id ); ?>"><?php esc_html_e( 'Edit', 'contact_manager' ); ?></a> | </span>
                            <a href="<?php echo get_delete_post_link($wp_person_post_id); ?>" class="submitdelete"><?php esc_html_e( 'Delete', 'contact_manager' ); ?></a> </span>
                          </span>
                        </td>
                    </tr>
                    <?php
                }
            }
        ?>
        
        
    </table>

</div>