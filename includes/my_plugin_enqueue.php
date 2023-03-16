<?php
/**
 *  @since 1.0
 */
function my_plugin_enqueue(){
    // styles
    wp_register_style( 'my-plugin-styles',  MY_PLUGIN_BASE_URL . '/assets/styles.css', array(), '1.0', 'all' );
    wp_enqueue_style( 'my-plugin-styles' );
    //js
    wp_enqueue_script('my-plugin-js', MY_PLUGIN_BASE_URL . '/assets/app.js', array( 'jquery' ), '1.0', true );
}

add_action( 'wp_enqueue_scripts', 'my_plugin_enqueue');

/**
 * @since 1.0
 */
function my_plugin_admin_enqueue(){
    // styles
    wp_register_style( 'my-plugin-styles',  MY_PLUGIN_BASE_URL . '/admin/assets/admin.css', array(), '1.0', 'all' );
    wp_enqueue_style( 'my-plugin-styles' );
    //js
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script('my-admin-plugin-js', MY_PLUGIN_BASE_URL . '/admin/assets/admin.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script('my-plugin-chart', 'https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_style( 'wp-color-picker' );
    $chart_post_data = get_option( 'chart_post_data', 'post' );
    $mppost = get_posts([
        'post_type' => $chart_post_data
    ]);
    wp_localize_script( 'my-admin-plugin-js', 'mp_vars', 
		array( 
			'mp_ajax' => admin_url( 'admin-ajax.php' ),
			'mp_nonce' => wp_create_nonce('mp-nonce'),
			'mp_error_message' => __('Sorry, there was a problem processing your request.', ''),
            'posts' => $mppost,
		) 
	);
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_script( 'my-plugin-color-picker', MY_PLUGIN_BASE_URL . '/admin/assets/admin.js', array( 'wp-color-picker' ), false, true );
}
add_action( 'admin_enqueue_scripts', 'my_plugin_admin_enqueue');

