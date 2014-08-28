<?php
add_theme_support( 'post-thumbnails' );

function add_pages_meta_boxes() {
add_meta_box(   'tagsdiv-post_tag', __('Page Tags'), 'post_tags_meta_box', 'page', 'side', 'low');
add_meta_box(   'categorydiv', __('Categories'), 'post_categories_meta_box', 'page', 'normal', 'core');
}
add_action('add_meta_boxes', 'add_pages_meta_boxes');
 
add_action('init','attach_category_to_page');
function attach_category_to_page() {
    register_taxonomy_for_object_type('category','page');
}

function register_my_menus() {
  register_nav_menus(
    array('footer-menu' => __( 'Footer Menu' ) )
  );
}

add_action( 'init', 'register_my_menus' );


function thanhduyen_widgets_init() {
    register_sidebar( array(
    'name' => __( 'Home Page Content', 'Theme' ),
    'id' => 'home_page_content',
    'description' => __( 'the content home page', 'mytheme' ),
    'before_widget' => '<div>',
    'after_widget' => '</div>',
    'before_title' => '<h2>',
    'after_title' => '</h2>',
    ));
    
    register_sidebar( array(
    'name' => __( 'Sidebar Right', 'Theme' ),
    'id' => 'sidebar-right',
    'description' => __( 'Sidebar Right', 'mytheme' ),
    'before_widget' => '<div>',
    'after_widget' => '</div>',
    'before_title' => '<h2>',
    'after_title' => '</h2>',
    ));

}
add_action( 'widgets_init', 'thanhduyen_widgets_init' );


