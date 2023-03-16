<?php
/**
 * Create your custom post type and taxonomy here.
 * add a wordpress function to create your custom post type, you can use any name.
 */

// CUSTOM POST TYPE

function chart_custom_post_type () {

    $labels = array (
        'name'               => 'Chart',
        'singular_name'      => 'Chart',
        'add_new'            => 'Add Item',
        'all_items'          => 'All Items',
        'edit_item'          => 'Edit Item',
        'new_item'           => 'New Item',
        'view_item'          => 'View Item',
        'search_item'        => 'Search Chart',
        'not_found'          => 'No items found',
        'not_found_in_trash' => 'No items found in trash',
        'parent_item_colon'  => 'Parent Item'
    );

    $args = array (
        'labels'              => $labels,
        'public'              => true,
        'has_archive'         => true,
        'publicy_queryable'   => true,
        'query_var'           => true,
        'rewrite'             => true,
        'capability_type'     => 'post',
        'hierarchical'        => false,
        'supports'            => array (
                                'title',
                                'editor',
                                'thumbnail',
                                // 'revisions',
                                'custom-fields',
                                'post-formats',
                                'comments'
                                ),
        'menu_position'       => 5,
        'exclude_from_search' => false,
        'show_ui'             => true,
        'menu_icon'           => 'dashicons-chart-pie'
    );
    register_post_type( 'chart', $args );
}

add_action('init','chart_custom_post_type');

// TAXONOMY

function chart_custom_taxonomies() {

    // Category Taxonomy

    $labels = array (
        'name'               => 'Categories',
        'singular_name'      => 'Category',
        'search_items'       => 'Search Categories',
        'all_items'          => 'All Categories',
        'parent_item'        => 'Parent Category',
        'parent_item_colon'  => 'Parent Category:',
        'edit_item'          => 'Edit Category',
        'update_item'        => 'Update Category',
        'add_new_item'       => 'Add New Chart Category',
        'new_item_name'      => 'New Category Name',
        'menu_name'          => 'Categories'
    );

    $args = array (
        'hierarchical'       => true,
        'labels'             => $labels,
        'show_ui'            => true,
        'show_admin_column'  => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'category' )
    );

    register_taxonomy( 'category' , array('chart'), $args);


    // Post Tag Taxonomy

    register_taxonomy('tag', 'chart', array (
        'label'         => 'Tags',
        'rewrite'       => array( 'slug' => 'tag' ),
        'hierarchical'  => false
    ) );

}

add_action('init','chart_custom_taxonomies');

add_action('add_meta_boxes', 'chart_data_box');

function chart_data_box() {
    add_meta_box(
        'chart_data_box',
    __( 'Chart Data and Color', 'myplugin_textdomain' ),
    'chart_data_box_content',
    'chart',
    'normal',
    'high'
    );
}

function chart_data_box_content($post) {

    wp_nonce_field( plugin_basename( __FILE__ ), 'chart_data_box_content_nonce' );
    echo '<label for="chart_data">Data: </label>';
    echo '<input type="text" id="chart_data" name="chart_data" placeholder="Enter the data of chart"> ';
    echo '<p>=== and ===</p>';
    echo '<label for="chart_color">Color: </label> ';
    echo '<input type="text" id="chart_color" name="chart_color" placeholder="Enter color">';
}

add_action( 'save_post', 'chart_data_box_save' );

function chart_data_box_save( $post_id ) {
    if( defined('DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return;
    if( !wp_verify_nonce( $_POST['chart_data_box_content_nonce'], plugin_basename( __FILE__ ) ) )
        return;
    if( 'page' == $_POST['post_type'] ) {
        if( !current_user_can( 'edit_page', $post_id))
            return;
    } else {
        if ( !current_user_can( 'edit_page', $post_id) )
            return;
    }

    $chart_data = $_POST['chart_data'];
    update_post_meta( $post_id, 'chart_data', $chart_data );
    $chart_color = $_POST['chart_color'];
    update_post_meta( $post_id, 'chart_color', $chart_color);
}