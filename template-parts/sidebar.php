<div class="bg-white dark:bg-slate-700 rounded-lg mb-6">
  <div class="p-4 mb-4">
    <div class="text-xl font-bold mb-4"><?php _e("Популярні статті", "treba-wp"); ?></div>
    <div>
      <?php 
        $all_posts = new WP_Query( array( 
          'post_type' => 'post', 
          'posts_per_page' => 5,
          'orderby' => 'rand',
          'meta_query' => array(
            array(
              'key' => '_crb_post_mainhide',
              'value' => 'yes',
              'compare' => '!='
            ),
          ),
        ) );
        if ($all_posts->have_posts()) : while ($all_posts->have_posts()) : $all_posts->the_post(); 
      ?>
        <div class="flex relative border-b pb-3 mb-3 last-of-type:border-transparent dark:border-slate-400 dark:last-of-type:border-transparent last-of-type:mb-0 last-of-type:pb-0">
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
            <div class="text-sm font-medium text-gray-500 dark:text-gray-400"><?php _e("Переглядів", "treba-wp"); ?>: <?php echo get_post_meta( get_the_ID(), 'post_count', true ); ?>;</div>
          </div>
        </div>
      <?php endwhile; endif; wp_reset_postdata(); ?>
    </div>
  </div>
</div>

<div class="bg-white dark:bg-slate-700 rounded-lg mb-6">
  <div class="p-4 mb-4">
    <div class="text-xl font-bold mb-4"><?php _e("Скільки днів до", "treba-wp"); ?>...</div>
    <div>
      <?php
        $menu_name = 'countdown';
        $locations = get_nav_menu_locations();

        if( $locations && isset( $locations[ $menu_name ] ) ){
          $menu_items = wp_get_nav_menu_items( $locations[ $menu_name ] );

          $menu_list = '<ul id="menu-' . $menu_name . '" class="">';
          foreach ( (array) $menu_items as $key => $menu_item ){
            $menu_emoji = carbon_get_nav_menu_item_meta( $menu_item->ID, 'crb_menu_emoji' ); 
            $menu_list .= '<li class="flex items-center mb-2"><a href="' . $menu_item->url . '" class=""><span class="mr-2">' . $menu_emoji . '</span>' . $menu_item->title . '</a></li>';
          }
          $menu_list .= '</ul>';
        }
        else {
          $menu_list = '<ul><li>Меню "' . $menu_name . '" не определено.</li></ul>';
        }

        echo $menu_list;
      ?>
    </div>
  </div>
</div>

<div class="bg-white dark:bg-slate-700 rounded-lg mb-6">
  <div class="p-4 mb-4">
    <div class="text-center text-lg text-blue-600 mb-2"><?php _e("Опитування", "treba-wp"); ?></div>
    <div class="text-xl font-bold mb-4"><?php _e("Ваш улюблений напій", "treba-wp"); ?>?</div>
    <div class="mb-4">
      <?php $vote_count = get_option("vote_drink_count"); ?>
      <!-- Water --> 
      <?php 
        $water_count = get_option("vote_water");
        $water_width = ($water_count/$vote_count)*100;
      ?>
      <div class="flex items-center justify-between relative bg-gray-200 text-gray-600 dark:text-gray-200 dark:bg-slate-800 border border-transparent rounded  cursor-pointer px-4 py-2 mb-2 vote-item" data-name="water">
        <div class="item-show hidden h-full absolute bg-green-200 dark:bg-emerald-600 top-0 left-0" style="width:<?php echo $water_width; ?>%"></div>
        <div class="relative">Вода</div>
        <div class="item-show hidden relative vote-item-result"><?php echo get_option("vote_water"); ?></div>
      </div>

      <!-- juice --> 
      <?php 
        $juice_count = get_option("vote_juice");
        $juice_width = ($juice_count/$vote_count)*100;
      ?>
      <div class="flex items-center justify-between relative bg-gray-200 dark:text-gray-200 dark:bg-slate-800 border border-transparent rounded text-gray-600 cursor-pointer px-4 py-2 mb-2 vote-item" data-name="juice">
        <div class="item-show hidden h-full absolute bg-green-200 dark:bg-emerald-600 top-0 left-0" style="width:<?php echo $juice_width; ?>%"></div>
        <div class="relative">Сік</div>
        <div class="item-show hidden relative vote-item-result"><?php echo get_option("vote_juice"); ?></div>
      </div>

      <!-- beer --> 
      <?php 
        $beer_count = get_option("vote_beer");
        $beer_width = ($beer_count/$vote_count)*100;
      ?>
      <div class="flex items-center justify-between relative bg-gray-200 dark:text-gray-200 dark:bg-slate-800 border border-transparent rounded text-gray-600 cursor-pointer px-4 py-2 mb-2 vote-item" data-name="beer">
        <div class="item-show hidden h-full absolute bg-green-200 dark:bg-emerald-600 top-0 left-0" style="width:<?php echo $beer_width; ?>%"></div>
        <div class="relative">Пиво</div>
        <div class="item-show hidden relative vote-item-result"><?php echo get_option("vote_beer"); ?></div>
      </div>

      <!-- tea --> 
      <?php 
        $tea_count = get_option("vote_tea");
        $tea_width = ($tea_count/$vote_count)*100;
      ?>
      <div class="flex items-center justify-between relative bg-gray-200 dark:text-gray-200 dark:bg-slate-800 border border-transparent rounded text-gray-600 cursor-pointer px-4 py-2 mb-2 vote-item" data-name="tea">
        <div class="item-show hidden h-full absolute bg-green-200 dark:bg-emerald-600 top-0 left-0" style="width:<?php echo $tea_width; ?>%"></div>
        <div class="relative">Чай</div>
        <div class="item-show hidden relative vote-item-result"><?php echo get_option("vote_tea"); ?></div>
      </div>

      <!-- coffee --> 
      <?php 
        $coffee_count = get_option("vote_coffee");
        $coffee_width = ($coffee_count/$vote_count)*100;
      ?>
      <div class="flex items-center justify-between relative bg-gray-200 dark:text-gray-200 dark:bg-slate-800 border border-transparent rounded text-gray-600 cursor-pointer px-4 py-2 mb-2 vote-item" data-name="coffee">
        <div class="item-show hidden h-full absolute bg-green-200 dark:bg-emerald-600 top-0 left-0" style="width:<?php echo $coffee_width; ?>%"></div>
        <div class="relative">Кава</div>
        <div class="item-show hidden relative vote-item-result"><?php echo get_option("vote_coffee"); ?></div>
      </div>

      <!-- other --> 
      <?php 
        $other_count = get_option("vote_other");
        $other_width = ($other_count/$vote_count)*100;
      ?>
      <div class="flex items-center justify-between relative bg-gray-200 dark:text-gray-200 dark:bg-slate-800 border border-transparent rounded text-gray-600 cursor-pointer px-4 py-2 mb-2 vote-item" data-name="other">
        <div class="item-show hidden h-full absolute bg-green-200 dark:bg-emerald-600 top-0 left-0" style="width:<?php echo $other_width; ?>%"></div>
        <div class="relative">Інше</div>
        <div class="item-show hidden relative vote-item-result"><?php echo get_option("vote_other"); ?></div>
      </div>
    </div>
    <div class="text-center font-medium"><?php _e("Всього голосів", "treba-wp"); ?>: <span id="vote-count"><?php echo $vote_count; ?></span></div>
  </div>
</div>

<div class="bg-white dark:bg-slate-700 rounded-lg mb-6">
  <div class="p-4 mb-4">
    <div class="text-xl font-bold mb-4"><?php _e("Категорії в каталозі", "treba-wp"); ?></div>
    <div>
      <?php 
      $services = get_terms(array( 'taxonomy' => 'services', 'parent' => 0, 'hide_empty' => false ));
      foreach($services as $service): ?>
        <div class="text-base border-b dark:border-slate-400 dark:last-of-type:border-transparent pb-3 mb-3 last-of-type:border-transparent last-of-type:pb-0 last-of-type:mb-0">
          <a href="<?php echo get_term_link($service->term_id, 'services') ?>" class="text-gray-700 dark:text-gray-300 hover:text-blue-600"><?php echo $service->name; ?></a>
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
        <div class="border-b pb-3 mb-3 last-of-type:border-transparent dark:border-slate-400 dark:last-of-type:border-transparent last-of-type:mb-0 last-of-type:pb-0">
          <div class="text-base"><a href="<?php the_permalink(); ?>" class="hover:text-blue-500"><?php the_title(); ?></a></div>
          <div class="text-sm font-medium text-gray-500 dark:text-gray-400"><?php _e("Місто", "treba-wp"); ?>: <?php echo carbon_get_the_post_meta('crb_company_city'); ?></div>
        </div>
      <?php endwhile; endif; wp_reset_postdata(); ?>
    </div>
  </div>
</div>