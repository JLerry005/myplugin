<?php
/**
 * @since 1.0
 */

if (!defined('MY_PLUGIN_BASE_DIR')) {
    define('MY_PLUGIN_BASE_DIR', dirname(__FILE__));
}
if (!defined('MY_PLUGIN_BASE_URL')) {
    define('MY_PLUGIN_BASE_URL', plugins_url('', MY_PLUGIN_BASE_DIR . '/myplugin.php'));
}
if (!defined('NDF_PLUGIN_BASENAME')) {
    define('NDF_PLUGIN_BASENAME', plugin_basename(MY_PLUGIN_BASE_DIR . '/myplugin.php'));
}
if (!defined('MY_PLUGIN_VERSION')) {
    define('MY_PLUGIN_VERSION', '');
}

/**
 * Register activation hook
 * @since 1.0
 */
function my_plugin_activate(){

}
register_activation_hook(MY_PLUGIN_BASE_DIR . '/myplugin.php', 'my_plugin_activate');

/**
 * Register deactivation hook
 * @since 1.0
 */
function my_plugin_deactivate(){

}
register_deactivation_hook(MY_PLUGIN_BASE_DIR . '/myplugin.php', 'my_plugin_deactivate');

/**
 * Require files
 */
require_once MY_PLUGIN_BASE_DIR . '/includes/my_plugin_enqueue.php';
require_once MY_PLUGIN_BASE_DIR . '/includes/my-plugin-menu-registration.php';
require_once MY_PLUGIN_BASE_DIR . '/admin/my-plugin-settings.php' ;
require_once MY_PLUGIN_BASE_DIR . '/create_custom_post_type.php' ;

/**
 * C
 * 
 */
add_filter( 'template_include', 'book_template', 99 );

function book_template( $template ) {
   if ( is_singular( 'book' ) ) {
      $template = plugin_dir_path( __FILE__ ) . 'templates/single-my_custom_post_type.php';
   }
   return $template;
}
