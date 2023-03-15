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
          <div class="text-sm opacity-75 border-b border-gray-200 mb-3 pb-3">
            <div><span class="italic"><?php _e("Автор", "treba-wp"); ?></span>: <?php echo get_the_author(); ?></div>
            <div><span class="italic"><?php _e("Дата", "treba-wp"); ?></span>: <?php echo get_the_date('d.m.Y'); ?></div>
          </div>
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
                <a itemprop="item" href="<?php echo get_post_type_archive_link('cases'); ?>" class="text-indigo-400 dark:text-indigo-500">
                  <span itemprop="name"><?php _e( 'Кейси', 'treba-wp' ); ?></span>
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
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5m.75-9l3-3 2.148 2.148A12.061 12.061 0 0116.5 7.605" />
            </svg>
          </div>
          <h2 class="text-3xl lg:text-4xl font-bold"><?php _e("Інші кейси", "treba-wp"); ?></h2>
        </div>
        <div class="flex flex-wrap">
          <?php 
            $current_id = get_the_ID();
            $other_cases = new WP_Query( array( 
              'post_type' => 'cases', 
              'posts_per_page' => 3,
              'post__not_in' => array($current_id),
              'order'    => 'DESC',
            ) );
            if ($other_cases->have_posts()) : while ($other_cases->have_posts()) : $other_cases->the_post(); 
          ?>
            <div class="w-full border-b last-of-type:border-none border-gray-200 dark:border-zinc-500 pb-4 mb-4 last-of-type:mb-0 last-of-type:pb-0">
              <?php echo get_template_part('template-parts/case-item'); ?>
            </div>
          <?php endwhile; endif; wp_reset_postdata(); ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>