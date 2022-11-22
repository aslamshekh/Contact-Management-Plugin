<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://https://profiles.wordpress.org/wpboss/
 * @since      1.0.0
 *
 * @package    Contact_Management
 * @subpackage Contact_Management/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Contact_Management
 * @subpackage Contact_Management/admin
 * @author     Aslam Shekh <info.aslamshekh@gmail.com>
 */
class Contact_Management_Admin
{
	
	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;
	
	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;
	
	/**
	 * Initialize the class and set its properties.
	 *
	 * @param string $plugin_name The name of this plugin.
	 * @param string $version The version of this plugin.
	 * @since    1.0.0
	 */
	public function __construct( $plugin_name, $version )
	{
		
		$this->plugin_name = $plugin_name;
		$this->version = $version;
		
	}
	
	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{
		
		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Contact_Management_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Contact_Management_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		
		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/contact-management-admin.css', array(), $this->version, 'all');
		wp_register_style( $this->plugin_name . '_chosen_core_css', plugin_dir_url( __FILE__ ) . '/css/chosen.min.css' );
		wp_enqueue_style( $this->plugin_name . '_chosen_core_css' );
	}
	
	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{
		
		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Contact_Management_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Contact_Management_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		
		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/contact-management-admin.js', array( 'jquery' ), $this->version, false);
		wp_register_script( $this->plugin_name . '_chosen_core_js', plugin_dir_url( __FILE__ ) . '/js/chosen.jquery.min.js', array( 'jquery' ), 1.0, false );
		wp_enqueue_script( $this->plugin_name . '_chosen_core_js' );
	}
	
	/**
	 * Function for  reguster custom post type
	 */
	public function cm_create_custom_post_type()
	{
		/*Person POST TYPE REGISTER*/
		
		$personPostLabels = array(
			'name'               => _x('Person', 'Person', 'contact_manager'),
			'singular_name'      => _x('cm-person', 'cm_person', 'contact_manager'),
			'menu_name'          => _x('Person', 'Person', 'contact_manager'),
			'name_admin_bar'     => _x('Person', 'Person', 'contact_manager'),
			'add_new'            => _x('Add New', 'Person', 'contact_manager'),
			'add_new_item'       => __('Add New Person', 'contact_manager'),
			'new_item'           => __('New Person', 'contact_manager'),
			'edit_item'          => __('Edit Person', 'contact_manager'),
			'view_item'          => __('View Person', 'contact_manager'),
			'all_items'          => __('All Person', 'contact_manager'),
			'search_items'       => __('Search Person', 'contact_manager'),
			'parent_item_colon'  => __('Parent Person:', 'contact_manager'),
			'not_found'          => __('No Person found.', 'contact_manager'),
			'not_found_in_trash' => __('No Person found in Trash.', 'contact_manager'),
			'featured_image'     => __('Cover image', 'contact_manager'),
			'set_featured_image' => __('Set cover image', 'contact_manager')
		);
		$personPostData = array(
			'labels'             => $personPostLabels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => false,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'cm_person' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 5,
			'supports'           => array( 'title', 'thumbnail' )
		);
		register_post_type('cm_person', $personPostData);
		
		$personContactPostLabels = array(
			'name'               => _x('Person Contact', 'Person', 'contact_manager'),
			'singular_name'      => _x('cm-person-contact', 'cm-person-contact', 'contact_manager'),
			'menu_name'          => _x('Person Contact', 'Person Contact', 'contact_manager'),
			'name_admin_bar'     => _x('Person Contact', 'Person Contact', 'contact_manager'),
			'add_new'            => _x('Add New', 'Person Contact', 'contact_manager'),
			'add_new_item'       => __('Add New Person Contact', 'contact_manager'),
			'new_item'           => __('New Person Contact', 'contact_manager'),
			'edit_item'          => __('Edit Person Contact', 'contact_manager'),
			'view_item'          => __('View Person Contact', 'contact_manager'),
			'all_items'          => __('All Person Contact', 'contact_manager'),
			'search_items'       => __('Search Person Contact', 'contact_manager'),
			'parent_item_colon'  => __('Parent Person Contact:', 'contact_manager'),
			'not_found'          => __('No Person Person Contact.', 'contact_manager'),
			'not_found_in_trash' => __('No Person Contact found in Trash.', 'contact_manager'),
			'featured_image'     => __('Cover image', 'contact_manager'),
			'set_featured_image' => __('Set cover image', 'contact_manager')
		);
		$personContactPostData = array(
			'labels'             => $personContactPostLabels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => false,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'cm_person_contact' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 6,
			'supports'           => array( 'title', 'thumbnail' )
		);
		register_post_type('cm_person_contact', $personContactPostData);
	}
	
	/**
	 * Function for create admin menu for person page
	 */
	public function cm_create_admin_menu()
	{
		add_menu_page($this->plugin_name, 'Person', 'administrator', 'cm-person-list', array( $this, 'cm_person_list' ), 'dashicons-businessperson', 26);
		add_submenu_page(null, 'Person Add', 'Person Add', 'administrator', 'cm-person-add', array( $this, 'cm_person_add' ));
		add_submenu_page(null, 'Person Detail', 'Person Detail', 'administrator', 'cm-person-detail', array( $this, 'cm_person_detail' ));
		add_submenu_page(null, 'Person Contact', 'Person Contact', 'administrator', 'cm-person-contact', array( $this, 'cm_person_contact' ));
		
	}
	
	/**
	 * Add page for person list
	 * @return void
	 */
	public function cm_person_list()
	{
		require plugin_dir_path(__FILE__) . 'partials/contact-management-person-list.php';
	}
	
	/**
	 * Add page for person Add
	 * @return void
	 */
	public function cm_person_add()
	{
		require plugin_dir_path(__FILE__) . 'partials/contact-management-person-add.php';
	}
	
	/**
	 * Add page for person Details
	 * @return void
	 */
	public function cm_person_detail()
	{
		require plugin_dir_path(__FILE__) . 'partials/contact-management-person-detail.php';
	}
	
	/**
	 * Add page for person contact add
	 * @return void
	 */
	public function cm_person_contact()
	{
		require plugin_dir_path(__FILE__) . 'partials/contact-management-person-contact.php';
	}
	
	/**
	 * callback function for add person.
	 * @return void
	 */
	public function cm_person_add_callback()
	{
		$person_id = filter_input(INPUT_POST, 'person_id', FILTER_SANITIZE_NUMBER_INT);
		$person_name = filter_input(INPUT_POST, 'person_name', FILTER_SANITIZE_STRING);
		$person_email = filter_input(INPUT_POST, 'person_email', FILTER_SANITIZE_STRING);
		$cm_action = filter_input(INPUT_POST, 'cm_action', FILTER_SANITIZE_STRING);
		
		if(isset($cm_action) && !empty($cm_action)){
			$personData = array(
				'ID'  => $cm_action,
				'post_title'  => $person_name,
			);
			wp_update_post( $personData );
			$rtn_post_id = $cm_action;
		} else {
			$emailExits = $this->checkEmailExists($person_email);
			if($emailExits == false){
				set_transient( 'cm_error_message', esc_html__( 'This email address already used, Please try other email.', 'contact_manager' ), 45 );
				wp_safe_redirect( admin_url( '/admin.php?page=cm-person-add' ) );
				exit();
			} else {
				$personData = array(
					'post_title'  => $person_name,
					'post_status' => 'publish',
					'post_type'   => 'cm_person',
				);
				$rtn_post_id = wp_insert_post($personData);
			}
		}
		
		update_post_meta($rtn_post_id, "person_id", $person_id);
		update_post_meta($rtn_post_id, "person_name", $person_name);
		update_post_meta($rtn_post_id, "person_email", $person_email);
		
		wp_safe_redirect( admin_url( '/admin.php?page=cm-person-list' ) );
	}
	
	/**
	 * Function to check email exits or not
	 * @param $person_email
	 * @return bool
	 */
	public function checkEmailExists($person_email){
		
		$checkEmailExists = get_posts( array(
			'posts_per_page' => -1,
			'meta_key' => 'person_email',
			'meta_value' => $person_email,
			'fields' => 'ids',
			'post_type'   => 'cm_person',
		) );
		if ( count( $checkEmailExists ) ) {
			return false;
		}
		return true;
	}
	
	/**
	 * Callback function for add contact details
	 * @return void
	 */
	public function cm_person_contact_add_callback()
	{
		$person_id = filter_input(INPUT_POST, 'person_id', FILTER_SANITIZE_NUMBER_INT);
		$contact_id = filter_input(INPUT_POST, 'contact_id', FILTER_SANITIZE_NUMBER_INT);
		$country_code = filter_input(INPUT_POST, 'country_code', FILTER_SANITIZE_STRING);
		$contact_number = filter_input(INPUT_POST, 'contact_number', FILTER_SANITIZE_STRING);
		$cm_action = filter_input(INPUT_POST, 'cm_action', FILTER_SANITIZE_STRING);
		
		if(isset($cm_action) && !empty($cm_action)){
			$personData = array(
				'ID'  => $cm_action,
				'post_title'  => $contact_number,
			);
			wp_update_post( $personData );
			$rtn_post_id = $cm_action;
		} else {
			$personContactData = array(
				'post_title'  => $contact_number,
				'post_status' => 'publish',
				'post_type'   => 'cm_person_contact',
				'post_author' => $person_id,
			);
			$rtn_post_id = wp_insert_post($personContactData);
		}
		update_post_meta($rtn_post_id, "person_id", $person_id);
		update_post_meta($rtn_post_id, "contact_id", $contact_id);
		update_post_meta($rtn_post_id, "country_code", $country_code);
		update_post_meta($rtn_post_id, "contact_number", $contact_number);
		update_post_meta($person_id, "contact_id", $rtn_post_id);
		
		wp_safe_redirect( admin_url( '/admin.php?page=cm-person-list' ) );
		
	}
}
