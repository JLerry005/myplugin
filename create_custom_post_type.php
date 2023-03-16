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
                                'revisions',
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
        'name'               => 'Types',
        'singular_name'      => 'Type',
        'search_items'       => 'Search Types',
        'all_items'          => 'All Types',
        'parent_item'        => 'Parent Type',
        'parent_item_colon'  => 'Parent Type:',
        'edit_item'          => 'Edit Type',
        'update_item'        => 'Update Type',
        'add_new_item'       => 'Add New Chart Type',
        'new_item_name'      => 'New Type Name',
        'menu_name'          => 'Types'
    );

    $args = array (
        'hierarchical'       => true,
        'labels'             => $labels,
        'show_ui'            => true,
        'show_admin_column'  => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'type' )
    );

    register_taxonomy( 'type' , array('chart'), $args);


    // Post Tag Taxonomy

    register_taxonomy('keyword', 'chart', array (
        'label'         => 'Keywords',
        'rewrite'       => array( 'slug' => 'keyword' ),
        'hierarchical'  => false
    ) );

}

add_action('init','chart_custom_taxonomies');
