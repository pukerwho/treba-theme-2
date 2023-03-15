<?php

function create_post_type() {
  register_post_type( 'company',
    array(
      'labels' => array(
          'name' => __( 'Компанії' ),
          'singular_name' => __( 'Компанія' )
      ),
      'public' => true,
      'has_archive' => true,
      'hierarchical' => true,
      'show_in_rest' => false,
      'menu_icon' => 'dashicons-feedback',
      'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields', 'revisions', 'page-attributes' ),
    )
  );

  register_post_type( 'cases',
    array(
      'labels' => array(
          'name' => __( 'Кейси' ),
          'singular_name' => __( 'Кейс' )
      ),
      'public' => true,
      'has_archive' => true,
      'hierarchical' => true,
      'show_in_rest' => true,
      'menu_icon' => 'dashicons-feedback',
      'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields', 'revisions', 'page-attributes' ),
    )
  );
  register_post_type( 'dictionary',
    array(
      'labels' => array(
          'name' => __( 'Словник' ),
          'singular_name' => __( 'Словник' )
      ),
      'public' => true,
      'has_archive' => true,
      'hierarchical' => true,
      'show_in_rest' => true,
      'menu_icon' => 'dashicons-feedback',
      'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields', 'revisions', 'page-attributes' ),
    )
  );
  register_post_type( 'city-service',
    array(
      'labels' => array(
          'name' => __( 'Послуги в місті' ),
          'singular_name' => __( 'Послуга в місті' )
      ),
      'public' => true,
      'has_archive' => true,
      'hierarchical' => true,
      'show_in_rest' => true,
      'menu_icon' => 'dashicons-feedback',
      'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields', 'revisions', 'page-attributes' ),
    )
  );
  
}
add_action( 'init', 'create_post_type' );