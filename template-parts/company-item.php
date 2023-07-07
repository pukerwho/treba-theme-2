<div class="bg-blue-50 dark:bg-slate-800 rounded-lg px-4 py-3">
  <div class="text-xl font-medium border-b border-gray-200 dark:border-zinc-500 truncate pb-2 mb-2"><a href="<?php the_permalink(); ?>" class="dark:text-blue-600 hover:text-indigo-500 dark:hover:text-blue-500"><?php the_title(); ?></a></div>
  <div class="mb-2">
    <span class="font-medium"><?php _e("Країна", "treba-wp"); ?></span>: <?php echo carbon_get_the_post_meta('crb_company_country'); ?>
  </div>
  <div class="mb-2">
    <span class="font-medium"><?php _e("Категорія", "treba-wp"); ?></span>: 
    <?php 
    $services_terms = wp_get_post_terms(  get_the_ID() , 'services', array( 'parent' => 0 ) );
    foreach (array_slice($services_terms, 0,1) as $service_term):
    ?>
      <?php if ($service_term): ?>
        <a href="<?php echo get_term_link($service_term->term_id, 'services') ?>" class="text-slate-800 border-b border-slate-800 hover:border-b-4"><?php echo $service_term->name; ?></a> 
      <?php endif; ?>
    <?php endforeach; ?>
  </div>
  <div class="mb-2">
    <span class="font-medium"><?php _e("Вартість роботи", "treba-wp"); ?></span>: Від 20$/год.
  </div>
  <div class="mb-4">
    <span class="font-medium"><?php _e("Співробітників", "treba-wp"); ?></span>: <?php echo carbon_get_the_post_meta('crb_company_employees'); ?>
  </div>
  <div class="mb-2">
    <a href="<?php the_permalink(); ?>" class="font-medium border-b-4 border-slate-800"><?php _e("Детальніше", "treba-wp"); ?></a>
  </div>
</div>