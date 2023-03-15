<?php

if ( ! defined( 'TREBAWP_VERSION' ) ) {
	define( 'TREBAWP_VERSION', '1.0.0' );
}

if ( ! function_exists( 'treba_wp_setup' ) ) :
	function treba_wp_setup() {
		load_theme_textdomain( 'treba-wp', get_template_directory() . '/languages' );

		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );

		register_nav_menus(
			array(
				'header' => esc_html__( 'Header', 'treba-wp' ),
        'mobile' => esc_html__( 'Mobile', 'treba-wp' ),
        'lang_header' => esc_html__( 'Lang', 'treba-wp' ),
			)
		);

		add_theme_support(
			'html5',
			array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script')
		);
	}
endif;
add_action( 'after_setup_theme', 'treba_wp_setup' );

include('inc/enqueues.php');
include('inc/share-social.php');
include('inc/comments-functions.php');
include('inc/create-custom-posts.php');
include('inc/create-custom-taxonomy.php');
include('inc/seo-functions.php');

use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Carbon_Fields\Block;

add_action( 'after_setup_theme', 'crb_load' );
function crb_load() {
    require_once __DIR__ . '/vendor/autoload.php';
    \Carbon_Fields\Carbon_Fields::boot();
    require_once get_template_directory() . '/inc/carbon-fields/carbon-fields-plugin.php';
    require_once get_template_directory() . '/inc/custom-fields/settings-meta.php';
    require_once get_template_directory() . '/inc/custom-fields/post-meta.php';
    require_once get_template_directory() . '/inc/custom-fields/page-meta.php';
    require_once get_template_directory() . '/inc/custom-fields/term-meta.php';
}

remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

function itsme_disable_feed() {
 wp_die( __( 'No feed available, please visit the <a href="'. esc_url( home_url( '/' ) ) .'">homepage</a>!' ) );
}

add_action('do_feed', 'itsme_disable_feed', 1);
add_action('do_feed_rdf', 'itsme_disable_feed', 1);
add_action('do_feed_rss', 'itsme_disable_feed', 1);
add_action('do_feed_rss2', 'itsme_disable_feed', 1);
add_action('do_feed_atom', 'itsme_disable_feed', 1);
add_action('do_feed_rss2_comments', 'itsme_disable_feed', 1);
add_action('do_feed_atom_comments', 'itsme_disable_feed', 1);
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );

/**
 * Enqueue scripts and styles.
 */
function trebawp_scripts() {
	wp_enqueue_style( 'tailwind', get_stylesheet_directory_uri() . '/build/tailwind.css', false, time() );
	wp_enqueue_style( 'styles', get_stylesheet_directory_uri() . '/build/style.css', false, time() );
	
	wp_enqueue_script( 'all-scripts', get_template_directory_uri() . '/build/scripts.js', '','',true);

	// if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	// 	wp_enqueue_script( 'comment-reply' );
	// }
}
add_action( 'wp_enqueue_scripts', 'trebawp_scripts' );

// Создаем счетчик для записей
function tutCount($post_id) {
  
  if ( metadata_exists( 'post', $post_id, 'post_count' ) ) {
    $count_value = get_post_meta( $post_id, 'post_count', true );
    $count_value = $count_value + 1;
    update_post_meta( $post_id, 'post_count', $count_value );
  } else {
    $rand_post_count = mt_rand(50, 144);
    add_post_meta( $post_id, 'post_count', $rand_post_count, true);
  }
  $post_count = get_post_meta( $post_id, 'post_count', true );
  return $post_count;
  
}

function get_page_url($template_name) {
  $pages = get_posts([
    'post_type' => 'page',
    'post_status' => 'publish',
    'meta_query' => [
      [
        'key' => '_wp_page_template',
        'value' => $template_name.'.php',
        'compare' => '='
      ]
    ]
  ]);
  if(!empty($pages))
  {
    foreach($pages as $pages__value)
    {
      return get_permalink($pages__value->ID);
    }
  }
  return get_bloginfo('url');
}

//Add Ajax
add_action('wp_head', 'myplugin_ajaxurl');
function myplugin_ajaxurl() {
  echo '<script type="text/javascript">
    var ajaxurl = "' . admin_url('admin-ajax.php') . '";
  </script>';
}

//Update TimeToRead 
function update_time_read( ) {
  //Get data
  $post_id = stripslashes_deep($_POST['post_id']);
  $time_var = stripslashes_deep($_POST['time_var']);
  update_post_meta( $post_id, 'post_time_read', $time_var );
  wp_die();
}
add_action( 'wp_ajax_nopriv_update_time_read_action', 'update_time_read' );
add_action( 'wp_ajax_update_time_read_action', 'update_time_read' );

add_filter('get_the_archive_title', function ($title) {
  if (is_category()) {
    $title = single_cat_title('', false);
  } elseif (is_tag()) {
    $title = single_tag_title('', false);
  } elseif (is_author()) {
    $title = '<span class="vcard">' . get_the_author() . '</span>';
  } elseif (is_tax()) { //for custom post types
    $title = sprintf(__('%1$s'), single_term_title('', false));
  } elseif (is_post_type_archive()) {
    $title = post_type_archive_title('', false);
  }
  return $title;
});


function get_min_price($post_id) {
  if ( metadata_exists( 'post', $post_id, 'hotel_min_price' ) ) {
    $hotel_min_price = get_post_meta( $post_id, 'hotel_min_price', true );
    return $hotel_min_price;
  } else {
    $rand_min_price = mt_rand(1, 5);
    add_post_meta( $post_id, 'hotel_min_price', $rand_min_price, true);
    $hotel_min_price = get_post_meta( $post_id, 'hotel_min_price', true );
    return $hotel_min_price;
  }
}
function get_max_price($post_id) {
  if ( metadata_exists( 'post', $post_id, 'hotel_max_price' ) ) {
    $hotel_max_price = get_post_meta( $post_id, 'hotel_max_price', true );
    return $hotel_max_price;
  } else {
    $rand_max_price = mt_rand(5, 9);
    add_post_meta( $post_id, 'hotel_max_price', $rand_max_price, true);
    $hotel_max_price = get_post_meta( $post_id, 'hotel_max_price', true );
    return $hotel_max_price;
  }
}

// Insert the post into the database
add_action( 'created_services', 'add_new_post_service_city', $service_id );
add_action( 'created_city', 'add_new_post_city_service', $city_id );

function add_new_post_service_city($service_id) {
  $service_name = get_term( $service_id )->name;
  $all_cities = get_terms( array( 'taxonomy' => 'city', 'hide_empty' => false));
  foreach ($all_cities as $city) {
    $city_id = $city->term_id;
    $city_name = get_term( $city_id )->name;
    $title_post = $service_name . ' - ' . $city_name;
    $my_post = array(
      'post_title'    => $title_post,
      // 'post_content'  => "Content",
      'post_status'   => 'publish',
      'post_type' => 'city-service',
      'post_author'   => 1,
      'tax_input'    => array(
        'city' => array($city_id),
        'services' => array($service_id),
      ),
      // wp_set_object_terms($post_id, $termObj, $taxonomy);
      // 'post_category' => array( $service_id,$city_id )
    );
    if ( get_page_by_title( $my_post['name'] ) == null ) {
      wp_insert_post( $my_post );
    }
  }
}
