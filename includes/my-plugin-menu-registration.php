<?php
/** 
 * Registers Admin Menu and Sub Menus
 * 
 * Registered Menus:
 * - `myplugin-dashboard` - Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae, ratione.
 * 
 * @package 	MYPLUGIN
 * @subpackage 	MYPLUGIN/includes
 * @since 		1.0
 * @author 		JRETECH
 */

/**
 * ndf_menu_registration
 *
 * @return void
 */

function myplugin_menu_registration(){
	add_menu_page(
        'MYPLUGIN',
        'MYPLUGIN',
        'manage_options',
        'myplugin-dashboard',
        'my_plugin_dashboard_display',
        'dashicons-index-card',
        5
    );
    add_submenu_page( 'myplugin-dashboard', 'MP Dashboard', 'MP Dashboard', 'manage_options', 'myplugin-dashboard', NULL);
    add_submenu_page( 'myplugin-dashboard', 'Settings', 'Settings', 'manage_options', 'my-plugin-settings', 'my_plugin_settings');	


}
add_action( 'admin_menu', 'myplugin_menu_registration' );

function my_plugin_dashboard_display(){
    if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
    include( MY_PLUGIN_BASE_DIR . '/admin/dashboard.php' );
}
function my_plugin_settings(){
    if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
    include( MY_PLUGIN_BASE_DIR . '/admin/my-plugin-settings-display.php' );
}