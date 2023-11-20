<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'crb_page_theme_options' );
function crb_page_theme_options() {
  Container::make( 'post_meta', 'More' )
    ->where( 'post_type', '=', 'page' )
    ->add_fields( array(
      Field::make( 'association', 'crb_similar_links', 'Похожие ссылки')
      ->set_types( array(
        array(
          'type'      => 'post',
          'post_type' => 'page',
        )
      ) )
  ) );
}

?>