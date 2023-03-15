<?php 
$current_cat_id = get_queried_object_id();
$taxonomyName = "services";
$term = get_term_by('slug', get_query_var('term'), $taxonomyName);
?>

<?php get_header(); ?>

<div class="container pt-8">
  <div class="flex flex-col-reverse lg:flex-row flex-wrap lg:-mx-5">
    <div class="w-full lg:w-1/4 lg:px-5">
      <?php get_template_part("template-parts/sidebar"); ?>
    </div>
    <div class="w-full lg:w-3/4 lg:px-5">
      <div class="bg-white shadow-lg rounded-lg p-4 lg:p-8 mb-10">
        <h1 class="text-3xl lg:text-4xl font-bold mb-8"><?php single_term_title(); ?></h1>
        <div class="flex flex-wrap lg:-mx-4 mb-2">
          <?php 
            $current_page = !empty( $_GET['page'] ) ? $_GET['page'] : 1;
            $query = new WP_Query( array( 
              'post_type' => 'company', 
              'posts_per_page' => 20,
              'order'    => 'DESC',
              'paged' => $current_page,
              'tax_query' => array(
                array(
                  'taxonomy' => 'services',
                  'terms' => $current_cat_id,
                  'field' => 'term_id',
                  'include_children' => true,
                  'operator' => 'IN'
                )
              ),
            ) );
          if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
            <div class="w-full lg:w-1/2 lg:px-4 mb-4">
              <?php get_template_part('template-parts/company-item'); ?>
            </div>
          <?php endwhile; endif; wp_reset_postdata(); ?>
        </div>
        <div class="b_pagination text-center ">
          <?php 
            $big = 9999999991; // уникальное число
            echo paginate_links( array(
              'format' => '?page=%#%',
              'total' => $query->max_num_pages,
              'current' => $current_page,
              'prev_next' => true,
              'next_text' => (''),
              'prev_text' => (''),
            )); 
          ?>
        </div>
        <?php $categoryText = carbon_get_term_meta($current_cat_id, 'crb_category_content');
        if ($categoryText): ?>
        <div class="content mb-10">
          <?php echo apply_filters( 'the_content', $categoryText  ); ?>
        </div>
        <?php endif; ?>
      </div>

      <div class="bg-white shadow-lg rounded-lg p-4 lg:p-8 mb-10">
        <div class="flex flex-wrap lg:-mx-6">
          <div class="w-full lg:w-1/2 lg:px-6 mb-6 lg:mb-0">
            <h2 class="inline-block text-2xl border-b-4 border-indigo-500 mb-4"><?php _e("Інші категорії", "treba-wp"); ?></h2>
            <div class="text-sm">
              <?php if((int)$term->parent) {
                $parent_term = get_term( $term->parent, $taxonomyName );
                $parent_id = $parent_term->term_id; 
              } else {
                $parent_id = get_queried_object_id();
              }
              $child_terms = get_terms($taxonomyName, array('parent' => $parent_id, 'hide_empty' => false ));
              shuffle($child_terms);
              foreach ( $child_terms as $child ): ?>
                <a href="<?php echo get_term_link($child->term_id, 'services') ?>" class="block hover:text-indigo-500 mb-2">🔸 <?php echo $child->name; ?></a>
              <?php endforeach; ?>
            </div>
          </div>
          <div class="w-full lg:w-1/2 lg:px-6">
            <h2 class="inline-block text-2xl border-b-4 border-indigo-500 mb-4"><?php _e("В інших містах", "treba-wp"); ?></h2>
            <?php 
            $service_city_post = new WP_Query( array( 
              'post_type' => 'city-service', 
              'posts_per_page' => 20,
              'orderby'    => 'rand',
              'tax_query' => array(
                array(
                  'taxonomy' => 'services',
                  'terms' => $current_cat_id,
                  'field' => 'term_id',
                  'include_children' => true,
                  'operator' => 'IN'
                )
              ),
            ) );
            if ($service_city_post->have_posts()) : while ($service_city_post->have_posts()) : $service_city_post->the_post(); ?>
              <?php 
                $get_city = get_the_terms( get_the_ID(), 'city' );
                $get_city_name = $get_city[0]->name;
              ?>
              <a href="<?php the_permalink(); ?>" class="block text-sm hover:text-indigo-500 mb-2">🔸 <?php echo $get_city_name; ?></a>
            <?php endwhile; endif; wp_reset_postdata(); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>