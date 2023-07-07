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
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
            </svg>
          </div>
          <h1 class="text-3xl lg:text-4xl font-bold"><?php the_archive_title(); ?></h1>
        </div>

        <div class="flex flex-wrap items-center text-sm -mx-1 mb-4">
          <?php 
          $services = get_terms(array( 'taxonomy' => 'services', 'parent' => 0 ));
          foreach($services as $service): ?>
            <div class="mb-2 px-1">
              <div class="relative bg-zinc-200 dark:bg-slate-800 hover:bg-white dark:hover:bg-slate-900 border border-zinc-200 dark:border-transparent rounded-lg px-4 py-2">
                <a href="<?php echo get_term_link($service->term_id, 'services') ?>" class="absolute-link"></a>
                <div><span class=""><?php echo $service->name; ?></span></div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
        <div class="flex flex-wrap lg:-mx-4 mb-2">
          <?php 
            global $wp_query, $wp_rewrite;  
            $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
            $all_company = new WP_Query( array( 
              'post_type' => 'company',
              'paged' => $current, 
              'posts_per_page' => 20,
              'order' => 'DESC'
            ) );
            if ($all_company->have_posts()) : while ($all_company->have_posts()) : $all_company->the_post(); 
          ?>
            <div class="w-full lg:w-1/2 lg:px-4 mb-4">
              <?php get_template_part('template-parts/company-item'); ?>
            </div>
          <?php endwhile; endif; wp_reset_postdata(); ?>
        </div>
        <div class="b_pagination text-center">
          <?php 
            $big = 9999999991; // уникальное число
            echo paginate_links( array(
              'format' => '?page=%#%',
              'total' => $all_company->max_num_pages,
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