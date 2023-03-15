<div class="relative">
  <div class="mb-4"><a href="<?php the_permalink(); ?>" class="text-xl lg:text-2xl text-blue-600 hover:text-blue-500 hover:border-b-2 border-blue-500 font-bold"><?php the_title(); ?></a></div>
  <div class="text-sm font-medium opacity-75 mb-4"><?php echo carbon_get_the_post_meta('crb_case_description'); ?></div>
  <div class="text-sm opacity-75"><?php echo get_the_date('M Y'); ?></div>
</div>