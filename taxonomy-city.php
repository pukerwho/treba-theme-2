<?php 
$current_cat_id = get_queried_object_id();
$taxonomyName = "city";
$term = get_term_by('slug', get_query_var('term'), $taxonomyName);
?>

<?php get_header(); ?>

<?php echo get_template_part('template-parts/menu'); ?>

<main>
  <div class="container mx-auto">
    <h1 class="text-2xl lg:text-4xl uppercase font-bold mb-6">
      <?php _e("Всі компанії у місті", "treba-wp"); ?> <?php single_term_title(); ?>
    </h1>
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
              'taxonomy' => 'city',
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
    <div class="b_pagination text-center mb-12">
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
    <div class="content mb-10">
      <?php 
        $categoryText = carbon_get_term_meta($current_cat_id, 'crb_category_content');
        echo apply_filters( 'the_content', $categoryText  ); 
      ?>
    </div>
    <div>
      <h2 class="inline-block text-2xl border-b-4 border-indigo-500 mb-4"><?php _e("Категорії", "treba-wp"); ?></h2>
      <div class="flex flex-wrap text-sm lg:-mx-6">
        <?php 
        $service_post = new WP_Query( array( 
          'post_type' => 'city-service', 
          'posts_per_page' => -1,
          'orderby'    => 'rand',
          'tax_query' => array(
            array(
              'taxonomy' => 'city',
              'terms' => $current_cat_id,
              'field' => 'term_id',
              'include_children' => true,
              'operator' => 'IN'
            )
          ),
        ) );
        if ($service_post->have_posts()) : while ($service_post->have_posts()) : $service_post->the_post(); ?>
          <?php 
            $get_service = get_the_terms( get_the_ID(), 'services' );
            $get_service_name = $get_service[0]->name;
          ?>
          <div class="w-full lg:w-1/2 lg:px-6 mb-6 lg:mb-0">
            <a href="<?php the_permalink(); ?>" class="block text-sm hover:text-indigo-500 mb-2">🔸 <?php echo $get_service_name; ?></a>
          </div>
        <?php endwhile; endif; wp_reset_postdata(); ?>
      </div>
    </div>
    
  </div>
</main>

<?php get_footer(); ?>