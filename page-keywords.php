<?php
/*
Template Name: Get keywords
*/
?>
<?php get_header(); ?>

<div class="container">
  <table class="min-w-full bg-white rounded-lg">
    <tbody>
      <?php
      $service_city_post = new WP_Query( array( 
        'post_type' => 'city-service', 
        'posts_per_page' => -1,
      ) );
      if ($service_city_post->have_posts()) : while ($service_city_post->have_posts()) : $service_city_post->the_post(); ?>  
        <?php 
        $currentId = get_the_ID();
        $get_city = get_the_terms( $currentId, 'city' );
        $get_city_name = $get_city[0]->name;
        $get_city_id = $get_city[0]->term_id;
        $get_service = get_the_terms( $currentId, 'services' );
        $get_service_name = $get_service[0]->name;
        $get_service_id = $get_service[0]->term_id;
        $heading = $get_service_name . ' у місті ' . $get_city_name;
        ?>
        <tr class="border-b">
          <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900"><?php echo $heading; ?></td>
          <td class="text-gray-900 font-light px-6 py-4 whitespace-nowrap"><?php echo get_the_permalink(); ?></td>
        </tr>
      <?php endwhile; endif; wp_reset_postdata(); ?>
    </tbody>
  </table>
</div>

<?php get_footer(); ?>