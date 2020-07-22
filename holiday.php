<?php
/**
 * Plugin Name: Holiday
 * Plugin URI: http://www.ongraph.com/holiday
 * Description: Holiday plugin to give the functionality to admin to choose the holidays for a particular day.
 * Version: 1.0
 * Author: Ongraph
 * Author URI: http://www.ongraph.com
 */


// function to create the DB / Options / Defaults					
function holiday_options_install() {

    global $wpdb;
    
    $table_name = $wpdb->prefix . "holidays";
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table_name (
            `id` int  NOT NULL AUTO_INCREMENT,
            `holiday_name` varchar(255) CHARACTER SET utf8 NOT NULL,
			`date` date NOT NULL,
            PRIMARY KEY (`id`)
          ) $charset_collate; ";
		  

	          
require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    //$wpdb->query($sql);
    dbDelta($sql);
	
}

// run the install scripts upon plugin activation
register_activation_hook(__FILE__, 'holiday_options_install');

//menu items
add_action('admin_menu','holiday_modifymenu');
function holiday_modifymenu() {
	
	//this is the main item for the menu
	add_menu_page('Holidays', //page title
	'Holidays', //menu title
	'manage_options', //capabilities
	'holiday_list', //menu slug
	'holiday_list', //function
	'dashicons-heart'
	);
	
	//this is a submenu
	add_submenu_page('holiday_list', //parent slug
	'New Holiday', //page title
	'Add new', //menu title
	'manage_options', //capability
	'add_holiday', //menu slug
	'add_holiday'); //function
	/*
	
	//this is a submenu
	add_submenu_page('fabric_list', //parent slug
	'Fabric Bodices', //page title
	'Fabric Bodices', //menu title
	'manage_options', //capability
	'fabric_garments', //menu slug
	'fabric_garments'); //function
	
	

	add_submenu_page(fabric_list, //parent slug
	'Fabrics Sleeves', //page title
	'Fabric Sleeves', //menu title
	'manage_options', //capability
	'add_fabric_sleeves', //menu slug
	'add_fabric_sleeves'); //function

	
	add_submenu_page(fabric_list, //parent slug
	'Fabrics Skirts', //page title
	'Fabric Skirts', //menu title
	'manage_options', //capability
	'add_fabric_skirts', //menu slug
	'add_fabric_skirts'); //function


	add_submenu_page(NULL, //parent slug
	'Fabric Garments', //page title
	'Fabric Garments', //menu title
	'manage_options', //capability
	'add_fabric_garments', //menu slug
	'add_fabric_garments'); //function*/

	/*add_submenu_page(fabric_list, //parent slug
	'All Fabrics ', //page title
	'All Fabric', //menu title
	'manage_options', //capability
	'all_fabric', //menu slug
	'all_fabric'); //function*/


}

define('ROOTDIR', plugin_dir_path(__FILE__));
require_once(ROOTDIR . 'holiday-list.php');
require_once(ROOTDIR . 'add-holiday.php');
/*require_once(ROOTDIR . 'add-fabric-garments.php');
//require_once(ROOTDIR . 'fabric-garments.php');
//require_once(ROOTDIR . 'ajaxsave.php');
require_once(ROOTDIR . 'all-fabric.php');
require_once(ROOTDIR . 'add-fabric-sleeves.php');
require_once(ROOTDIR . 'add-fabric-skirts.php');*/