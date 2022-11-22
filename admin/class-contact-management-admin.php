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
class Contact_Management_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/contact-management-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/contact-management-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Function for  reguster custom post type
	 */
	public function cm_create_custom_post_type(){
		/*Person POST TYPE REGISTER*/

		$customLabels = array(
		   'name'               => _x( 'Person', 'Person', 'contact_manager' ),
		   'singular_name'      => _x( 'cm-person', 'cm-person', 'contact_manager' ),
		   'menu_name'          => _x( 'Person', 'Person', 'contact_manager' ),
		   'name_admin_bar'     => _x( 'Person', 'Person', 'contact_manager' ),
		   'add_new'            => _x( 'Add New', 'Person', 'contact_manager' ),
		   'add_new_item'       => __( 'Add New Person', 'contact_manager' ),
		   'new_item'           => __( 'New Person', 'contact_manager' ),
		   'edit_item'          => __( 'Edit Person', 'contact_manager' ),
		   'view_item'          => __( 'View Person', 'contact_manager' ),
		   'all_items'          => __( 'All Person', 'contact_manager' ),
		   'search_items'       => __( 'Search Person', 'contact_manager' ),
		   'parent_item_colon'  => __( 'Parent Person:', 'contact_manager' ),
		   'not_found'          => __( 'No Person found.', 'contact_manager' ),
		   'not_found_in_trash' => __( 'No Person found in Trash.', 'contact_manager' ),
		   'featured_image'     => __( 'Cover image', 'contact_manager' ),
		   'set_featured_image' => __( 'Set cover image', 'contact_manager' )
	   );
	   $personPostData = array(
		   'labels'             => $customLabels,
		   'public'             => true,
		   'publicly_queryable' => true,
		   'show_ui'            => true,
		   'show_in_menu'       => false,
		   'query_var'          => true,
		   'rewrite'            => array( 'slug' => 'cm-person' ),
		   'capability_type'    => 'post',
		   'has_archive'        => true,
		   'hierarchical'       => false,
		   'menu_position'      => 5,
		   'supports'           => array( 'title', 'thumbnail')
	   );
	   register_post_type( 'cm-person', $personPostData);
	}

	/**
	 * Function for create admin menu for person page
	 */
	public function cm_create_admin_menu(){		
		add_menu_page(  $this->plugin_name, 'Person', 'administrator', $this->plugin_name, array( $this, 'cm_person_list' ), 'dashicons-businessperson', 26 );		
		add_submenu_page( $this->plugin_name , 'Add Person', 'administrator', $this->plugin_name, array($this,'cm_person_add') );
		//add_submenu_page( 'dashicons-businessperson', 'Registrations', 'Registrations', 'manage_options', 'woo-wholesale-registrations', 'wwpr_page_call' ); 

	}

	public function cm_person_list(){
		require_once '/partials/contact-management-person-list.php';
	}

	public function cm_person_add(){
		require_once '/partials/contact-management-person-add.php';
	}

	public function cm_person_add_callback(){


		if ( 1 ) {

			$person_id = filter_input(INPUT_POST, 'person_id', FILTER_SANITIZE_NUMBER_INT);
			$person_name = filter_input(INPUT_POST, 'person_name', FILTER_SANITIZE_STRING);
			
			$person_email = filter_input(INPUT_POST, 'person_email', FILTER_SANITIZE_STRING);
			
			$personData = array(
                'post_status' => 'publish',
                'post_type' => 'cm-person',
            );

            $rtn_post_id = wp_insert_post($personData);

			update_post_meta($rtn_post_id,"person_id",$person_id);
			update_post_meta($rtn_post_id,"person_name",$person_name);
			update_post_meta($rtn_post_id,"person_email",$person_email);
		}
	}
}
