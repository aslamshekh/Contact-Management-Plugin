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

<div class="wrap">
    <div id="icon-themes" class="icon32"></div>
    <h1 class="wp-heading-inline">
        <?php esc_html_e( 'Person List', 'contact_manager' ); ?>
    </h1>
    <table id="person_list">
        <tr>
            <th><?php esc_html_e( 'ID', 'contact_manager' ); ?></th>
            <th><?php esc_html_e( 'Name', 'contact_manager' ); ?></th>
            <th><?php esc_html_e( 'Email', 'contact_manager' ); ?></th>
            <th><?php esc_html_e( 'Contact', 'contact_manager' ); ?></th>
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
                            -
							<?php
						}
						?>
                    </td>
                </tr>
				<?php
			}
		}
		?>


    </table>

</div>