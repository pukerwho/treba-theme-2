<?php get_header(); ?>

<div class="container pt-8">
  <div class="flex flex-col-reverse lg:flex-row flex-wrap lg:-mx-5">
    <div class="w-full lg:w-1/4 lg:px-5">
      <?php get_template_part("template-parts/sidebar"); ?>
    </div>
    <div class="w-full lg:w-3/4 lg:px-5">
      <div class="bg-white shadow-lg rounded-lg p-4 lg:p-8 mb-10">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <article itemscope itemtype="http://schema.org/Article">
          
          <h1 class="text-2xl uppercase font-bold mb-4" itemprop="headline"><?php the_title(); ?></h1>
          <div class="content mb-6" itemprop="articleBody">
            <?php the_content(); ?>
          </div>
          <!-- Хлебные крошки -->
          <div class="breadcrumbs text-sm text-gray-800 dark:text-gray-200" itemprop="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
            <ul class="flex items-center flex-wrap -mr-4">
              <li itemprop='itemListElement' itemscope itemtype='https://schema.org/ListItem' class="breadcrumbs_item px-4 pl-8">
                <a itemprop="item" href="<?php echo home_url(); ?>" class="text-indigo-400 dark:text-indigo-500">
                  <span itemprop="name"><?php _e( 'Головна', 'treba-wp' ); ?></span>
                </a>                        
                <meta itemprop="position" content="1">
              </li>
              <li itemprop='itemListElement' itemscope itemtype='http://schema.org/ListItem' class="breadcrumbs_item px-4">
                <a itemprop="item" href="<?php echo get_post_type_archive_link('dictionary'); ?>" class="text-indigo-400 dark:text-indigo-500">
                  <span itemprop="name"><?php _e( 'Словник', 'treba-wp' ); ?></span>
                </a>                        
                <meta itemprop="position" content="2">
              </li>
              <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="breadcrumbs_item text-gray-600 px-4">
                <span itemprop="name"><?php the_title(); ?></span>
                <meta itemprop="position" content="3" />
              </li>
            </ul>
          </div>
          <!-- END Хлебные крошки -->
        <article>
        <?php endwhile; endif; wp_reset_postdata(); ?>
      </div>
      <div class="bg-white shadow-lg rounded-lg p-4 lg:p-8 mb-10">
        <div class="flex items-center mb-8">
          <div class="bg-slate-800 text-gray-300 rounded-lg p-1 mr-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 lg:w-8 h-6 lg:h-8">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
            </svg>
          </div>
          <h2 class="text-3xl lg:text-4xl font-bold"><?php _e("Словник", "treba-wp"); ?></h2>
        </div>
        <?php 
          $current_id = get_the_ID();
          $other_dictionary = new WP_Query( array( 
            'post_type' => 'dictionary', 
            'posts_per_page' => 20,
            'order' => 'DESC',
            'post__not_in' => array($current_id),
          ) );
          if ($other_dictionary->have_posts()) : while ($other_dictionary->have_posts()) : $other_dictionary->the_post(); 
        ?>
          <?php echo get_template_part('template-parts/dictionary-item'); ?>
        <?php endwhile; endif; wp_reset_postdata(); ?>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>