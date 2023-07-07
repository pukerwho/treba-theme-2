<?php get_header(); ?>

<div class="container pt-8">
  <div class="flex flex-col-reverse lg:flex-row flex-wrap lg:-mx-5">
    <div class="w-full lg:w-1/4 lg:px-5">
      <?php get_template_part("template-parts/sidebar"); ?>
    </div>
    <div class="w-full lg:w-3/4 lg:px-5">
      <div class="bg-white dark:bg-slate-700 shadow-lg rounded-lg p-4 lg:p-8 mb-10">
        <div class="flex items-center mb-8">
          <div class="bg-slate-800 text-gray-300 rounded-lg p-1 mr-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 lg:w-8 h-6 lg:h-8">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
            </svg>
          </div>
          <h1 class="text-3xl lg:text-4xl font-bold"><?php the_archive_title(); ?></h1>
        </div>
        <div class="flex flex-wrap lg:-mx-4 mb-4">
          <?php 
            global $wp_query, $wp_rewrite;  
            $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
            $new_dictionary = new WP_Query( array( 
              'post_type' => 'dictionary', 
              'posts_per_page' => 32,
              'paged' => $current, 
              'order' => 'DESC'
            ) );
            if ($new_dictionary->have_posts()) : while ($new_dictionary->have_posts()) : $new_dictionary->the_post(); 
          ?>
            <?php echo get_template_part('template-parts/dictionary-item'); ?>
          <?php endwhile; endif; wp_reset_postdata(); ?>
        </div>
        <div class="b_pagination text-center">
          <?php 
            $big = 9999999991; // уникальное число
            echo paginate_links( array(
              'format' => '?page=%#%',
              'total' => $new_dictionary->max_num_pages,
              'current' => $current,
              'prev_next' => true,
              'next_text' => (''),
              'prev_text' => (''),
            )); 
          ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>