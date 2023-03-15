<?php get_header(); ?>

<div class="welcome bg-slate-800 py-8 mb-8">
  <div class="container">
    <div class="mb-8">
      <?php 
        $new_post = new WP_Query( array( 
          'post_type' => 'post', 
          'posts_per_page' => 1,
          'order' => 'DESC'
        ) );
        if ($new_post->have_posts()) : while ($new_post->have_posts()) : $new_post->the_post(); 
      ?>
        <div class="flex flex-wrap items-center lg:-mx-6">
          <div class="w-full lg:w-1/2 lg:px-6">
            <div class="mb-8">
              <?php
              $post_categories = get_the_terms( $new_posts->ID, 'category' );
              foreach ($post_categories as $post_category){ ?>
                <a href="<?php echo get_term_link($post_category->term_id, 'category') ?>" class="text-lg bg-black/50 hover:bg-black/75 rounded text-gray-300 px-4 py-2"><?php echo $post_category->name; ?></a> 
              <?php } ?>
            </div>
            <div class="mb-8"><a href="<?php the_permalink(); ?>" class="text-4xl text-white hover:underline"><?php the_title(); ?></a></div>
            <div class="flex flex-col lg:flex-row lg:items-center text-gray-400 mb-8 lg:mb-0">
              <div class="mr-4"><?php echo get_the_date('d.m.Y'); ?></div>
              <div class="hidden lg:block mr-4">|</div>
              <div class="mr-4">
                <?php _e("Комментарів", "treba-wp"); ?>: <?php echo get_comments_number(); ?>
              </div>
              <div class="hidden lg:block mr-4">|</div>
              <div>
                <?php _e("Переглядів", "treba-wp"); ?>: <?php echo get_post_meta( get_the_ID(), 'post_count', true ); ?>;
              </div>            
            </div>
          </div>
          <div class="w-full lg:w-1/2 lg:px-6">
            <?php 
              $medium_thumb = get_the_post_thumbnail_url(get_the_ID(), 'medium');
              $large_thumb = get_the_post_thumbnail_url(get_the_ID(), 'large');
            ?>
            <img 
            class="w-full object-cover rounded-lg" 
            alt="<?php the_title(); ?>" 
            src="<?php echo $medium_thumb; ?>" 
            srcset="<?php echo $medium_thumb; ?> 1024w, <?php echo $large_thumb; ?> 1536w" 
            loading="lazy" 
            data-src="<?php echo $medium_thumb; ?>" 
            data-srcset="<?php echo $medium_thumb; ?> 1024w, <?php echo $large_thumb; ?> 1536w">
          </div>
        </div>
      <?php endwhile; endif; wp_reset_postdata(); ?>
    </div>

    <div class="flex flex-wrap lg:-mx-4">
      <?php 
        $new_posts = new WP_Query( array( 
          'post_type' => 'post', 
          'posts_per_page' => 4,
          'order' => 'DESC',
          'offset' => 1,
        ) );
        if ($new_posts->have_posts()) : while ($new_posts->have_posts()) : $new_posts->the_post(); 
      ?>
        <div class="w-full lg:w-1/4 lg:px-4 mb-4 last-of-type:mb-0 lg:mb-0">
          <div class="relative flex items-center bg-slate-700 hover:bg-slate-900/50 rounded-lg p-2">
            <a href="<?php the_permalink(); ?>" class="absolute-link"></a>
            <div class="mr-2">
              <?php 
                $medium_thumb = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                $large_thumb = get_the_post_thumbnail_url(get_the_ID(), 'large');
              ?>
              <img 
              class="w-[64px] min-w-[64px] h-[64px] min-h-[64px] object-cover rounded-lg" 
              alt="<?php the_title(); ?>" 
              src="<?php echo $medium_thumb; ?>" 
              srcset="<?php echo $medium_thumb; ?> 1024w, <?php echo $large_thumb; ?> 1536w" 
              loading="lazy" 
              data-src="<?php echo $medium_thumb; ?>" 
              data-srcset="<?php echo $medium_thumb; ?> 1024w, <?php echo $large_thumb; ?> 1536w">
            </div>
            <div class="text-gray-300"><?php the_title(); ?></div>
          </div>    
        </div>
      <?php endwhile; endif; wp_reset_postdata(); ?>
    </div>
  </div>
</div>

<div class="container">
  <div class="flex flex-col-reverse lg:flex-row flex-wrap lg:-mx-5">
    <div class="w-full lg:w-1/4 lg:px-5">
      <?php get_template_part("template-parts/sidebar"); ?>
    </div>
    <div class="w-full lg:w-3/4 lg:px-5">
      <div class="bg-white shadow-lg rounded-lg p-4 lg:p-8 mb-10">
        <div class="flex items-center mb-8">
          <div class="bg-slate-800 text-gray-300 rounded-lg p-1 mr-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 lg:w-8 h-6 lg:h-8">
              <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
            </svg>
          </div>
          <h2 class="text-3xl lg:text-4xl font-bold"><?php _e("Нові публікації", "treba-wp"); ?></h2>
        </div>
        <div class="flex flex-wrap lg:-mx-5 mb-4">
          <?php 
            $all_posts = new WP_Query( array( 
              'post_type' => 'post', 
              'posts_per_page' => 9,
              'order' => 'DESC',
              // 'offset' => 5,
            ) );
            if ($all_posts->have_posts()) : while ($all_posts->have_posts()) : $all_posts->the_post(); 
          ?>
            <div class="w-full lg:w-1/3 lg:px-5 mb-5">
              <?php get_template_part("template-parts/post-item"); ?>
            </div>
          <?php endwhile; endif; wp_reset_postdata(); ?>
        </div>
        <div class="inline-flex items-center relative hover:text-blue-500">
          <a href="<?php echo get_page_url('page-blog'); ?>" class="absolute-link"></a>
          <div class="mr-2"><?php _e("Більше дописів", "treba-wp"); ?></div>
          <div>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
            </svg>
          </div>
        </div>
      </div>

      <div class="bg-white shadow-lg rounded-lg p-4 lg:p-8 mb-10">
        <div class="flex items-center mb-8">
          <div class="bg-slate-800 text-gray-300 rounded-lg p-1 mr-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 lg:w-8 h-6 lg:h-8">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
            </svg>
          </div>
          <h2 class="text-3xl lg:text-4xl font-bold"><?php _e("Додані компанії", "treba-wp"); ?></h2>
        </div>
        <div class="flex flex-wrap lg:-mx-4 mb-4">
          <?php 
            $all_posts = new WP_Query( array( 
              'post_type' => 'company', 
              'posts_per_page' => 6,
              'order' => 'DESC',
              // 'offset' => 5,
            ) );
            if ($all_posts->have_posts()) : while ($all_posts->have_posts()) : $all_posts->the_post(); 
          ?>
            <div class="w-full lg:w-1/2 lg:px-4 mb-4">
              <?php echo get_template_part('template-parts/company-item'); ?>
            </div>
          <?php endwhile; endif; wp_reset_postdata(); ?>
        </div>
        <div class="flex items-center relative hover:text-blue-500">
          <a href="<?php echo get_post_type_archive_link('company'); ?>" class="absolute-link"></a>
          <div class="mr-2"><?php _e("Всі компанії", "treba-wp"); ?></div>
          <div>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
            </svg>
          </div>
        </div>
      </div>

      <div class="bg-white shadow-lg rounded-lg p-4 lg:p-8 mb-10">
        <div class="flex items-center mb-8">
          <div class="bg-slate-800 text-gray-300 rounded-lg p-1 mr-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 lg:w-8 h-6 lg:h-8">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5m.75-9l3-3 2.148 2.148A12.061 12.061 0 0116.5 7.605" />
            </svg>
          </div>
          <h2 class="text-3xl lg:text-4xl font-bold"><?php _e("Кейси", "treba-wp"); ?></h2>
        </div>
        <div class="flex flex-wrap">
          <?php 
            $all_posts = new WP_Query( array( 
              'post_type' => 'cases', 
              'posts_per_page' => 5,
              'order' => 'DESC',
              // 'offset' => 5,
            ) );
            if ($all_posts->have_posts()) : while ($all_posts->have_posts()) : $all_posts->the_post(); 
          ?>
            <div class="w-full border-b last-of-type:border-none border-gray-200 dark:border-zinc-500 pb-4 mb-4">
              <?php echo get_template_part('template-parts/case-item'); ?>
            </div>
          <?php endwhile; endif; wp_reset_postdata(); ?>
        </div>
        <div class="flex items-center relative hover:text-blue-500">
          <a href="<?php echo get_post_type_archive_link('cases'); ?>" class="absolute-link"></a>
          <div class="mr-2"><?php _e("Більше кейсів", "treba-wp"); ?></div>
          <div>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
            </svg>
          </div>
        </div>
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
        <div class="flex flex-wrap">
          <?php 
            $all_posts = new WP_Query( array( 
              'post_type' => 'dictionary', 
              'posts_per_page' => 5,
              'order' => 'DESC',
              // 'offset' => 5,
            ) );
            if ($all_posts->have_posts()) : while ($all_posts->have_posts()) : $all_posts->the_post(); 
          ?>
            <?php echo get_template_part('template-parts/dictionary-item'); ?>
          <?php endwhile; endif; wp_reset_postdata(); ?>
        </div>
      </div>

    </div>
  </div>
</div>

<?php get_footer(); ?>