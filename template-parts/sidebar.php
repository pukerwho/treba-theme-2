<div class="bg-white rounded-lg ">
  <div class="p-4 mb-4">
    <div class="text-xl font-bold mb-4"><?php _e("Категорії в каталозі", "treba-wp"); ?></div>
    <div>
      <?php 
      $services = get_terms(array( 'taxonomy' => 'services', 'parent' => 0, 'hide_empty' => false ));
      foreach($services as $service): ?>
        <div class="text-base border-b pb-3 mb-3 last-of-type:border-transparent last-of-type:pb-0 last-of-type:mb-0">
          <a href="<?php echo get_term_link($service->term_id, 'services') ?>" class="text-gray-700 hover:text-blue-600"><?php echo $service->name; ?></a>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  <div class="p-4 mb-4">
    <div class="text-xl font-bold mb-4"><?php _e("Популярні компанії", "treba-wp"); ?></div>
    <div>
      <?php 
        $all_posts = new WP_Query( array( 
          'post_type' => 'company', 
          'posts_per_page' => 5,
          'orderby' => 'rand',
        ) );
        if ($all_posts->have_posts()) : while ($all_posts->have_posts()) : $all_posts->the_post(); 
      ?>
        <div class="border-b pb-3 mb-3 last-of-type:border-transparent last-of-type:mb-0 last-of-type:pb-0">
          <div class="text-base"><a href="<?php the_permalink(); ?>" class="hover:text-blue-500"><?php the_title(); ?></a></div>
          <div class="text-sm font-medium text-gray-500"><?php _e("Місто", "treba-wp"); ?>: <?php echo carbon_get_the_post_meta('crb_company_city'); ?></div>
        </div>
      <?php endwhile; endif; wp_reset_postdata(); ?>
    </div>
  </div>

  <div class="p-4 mb-4">
    <div class="text-xl font-bold mb-4"><?php _e("Популярні статті", "treba-wp"); ?></div>
    <div>
      <?php 
        $all_posts = new WP_Query( array( 
          'post_type' => 'post', 
          'posts_per_page' => 5,
          'orderby' => 'rand',
        ) );
        if ($all_posts->have_posts()) : while ($all_posts->have_posts()) : $all_posts->the_post(); 
      ?>
        <div class="flex relative border-b pb-3 mb-3 last-of-type:border-transparent last-of-type:mb-0 last-of-type:pb-0">
          <a href="<?php the_permalink(); ?>" class="absolute-link"></a>
          <div class="mr-2">
            <?php 
              $medium_thumb = get_the_post_thumbnail_url(get_the_ID(), 'medium');
              $large_thumb = get_the_post_thumbnail_url(get_the_ID(), 'large');
            ?>
            <img 
            class="w-[65px] min-w-[65px] h-[65px] min-h-[65px] object-cover rounded-lg" 
            alt="<?php the_title(); ?>" 
            src="<?php echo $medium_thumb; ?>" 
            srcset="<?php echo $medium_thumb; ?> 1024w, <?php echo $large_thumb; ?> 1536w" 
            loading="lazy" 
            data-src="<?php echo $medium_thumb; ?>" 
            data-srcset="<?php echo $medium_thumb; ?> 1024w, <?php echo $large_thumb; ?> 1536w">
          </div>
          <div>
            <div class="text-base mb-1"><?php the_title(); ?></div>
            <div class="text-sm font-medium text-gray-500"><?php _e("Переглядів", "treba-wp"); ?>: <?php echo get_post_meta( get_the_ID(), 'post_count', true ); ?>;</div>
          </div>
        </div>
      <?php endwhile; endif; wp_reset_postdata(); ?>
    </div>
  </div>
</div>