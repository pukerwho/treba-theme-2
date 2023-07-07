<?php get_header(); ?>

<?php 
  $currentId = get_the_ID();
  $countNumber = tutCount($currentId);
?>

<div class="container pt-8">
  <div class="flex flex-col-reverse lg:flex-row flex-wrap lg:-mx-5">
    <div class="w-full lg:w-1/4 lg:px-5">
      <?php get_template_part("template-parts/sidebar"); ?>
    </div>
    <div class="w-full lg:w-3/4 lg:px-5">
      <div class="bg-white dark:bg-slate-700 shadow-lg rounded-lg p-4 lg:p-8 mb-10">
        <h1 class="text-2xl uppercase font-bold border-b border-gray-200 dark:border-zinc-500 mb-5 pb-5"><?php the_title(); ?></h1>
        <div class="border-b border-gray-200 dark:border-zinc-500 mb-5 pb-5">
          <h2 class="text-xl uppercase font-bold mb-4"><?php _e("Опис", "treba-wp"); ?></h2>
          <div class="content">
            <?php the_content(); ?>
          </div>
        </div>
        <div class="mb-8">
          <h2 class="text-xl uppercase font-bold mb-4"><?php _e("Контакти", "treba-wp"); ?></h2>
          <div class="mb-2">
            <span class="font-medium"><?php _e("Сайт", "treba-wp"); ?></span>: <?php echo carbon_get_the_post_meta('crb_company_website'); ?>
          </div>
          <div class="mb-2">
            <span class="font-medium"><?php _e("Телефон", "treba-wp"); ?></span>: <?php echo carbon_get_the_post_meta('crb_company_phone'); ?>
          </div>
          <div>
            <span class="font-medium"><?php _e("Адреса", "treba-wp"); ?></span>: <?php echo carbon_get_the_post_meta('crb_company_address'); ?>
          </div>
        </div>
        <?php if (carbon_get_the_post_meta('crb_company_social')): ?>
        <div class="mb-8">
          <h2 class="text-xl uppercase font-bold mb-4"><?php _e("Соцмережі", "treba-wp"); ?></h2>
          <div>
            <?php 
              $social_string = carbon_get_the_post_meta('crb_company_social');
              $social_array = explode(';', $social_string );
              foreach ($social_array as $social): 
            ?>
              <ul class="ml-4">
                <li class="list-disc mb-2"><a href="<?php echo $social; ?>" class="text-indigo-500 border-b border-transparent hover:border-indigo-500"><?php echo $social; ?></a></li>
              </ul>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endif; ?>
        <table class="mb-8">
          <tbody class="border border-gray-300">
            <!-- Категорія -->
            <tr class="border-b border-gray-300">
              <td class="whitespace-nowrap px-2 py-3">
                <div class="font-medium"><?php _e("Категорія", "treba-wp"); ?></div>
              </td>
              <td class="whitespace-nowrap px-2 py-3">
                <div class="text-gray-500 dark:text-gray-300">
                  <?php 
                  $services_terms = wp_get_post_terms(  get_the_ID() , 'services', array( 'parent' => 0 ) );
                  foreach (array_slice($services_terms, 0,1) as $service_term):
                  ?>
                    <?php if ($service_term): ?>
                      <a href="<?php echo get_term_link($service_term->term_id, 'services') ?>" class="text-indigo-500 dark:text-indigo-400 border-b border-indigo-500 hover:border-b-4"><?php echo $service_term->name; ?></a> 
                    <?php endif; ?>
                  <?php endforeach; ?>
                </div>
              </td>
            </tr>
            <!-- END Категорія -->

            <!-- Країна -->
            <tr class="border-b border-gray-300">
              <td class="whitespace-nowrap px-2 py-3">
                <div class="font-medium"><?php _e("Країна", "treba-wp"); ?></div>
              </td>
              <td class="whitespace-nowrap px-2 py-3">
                <?php echo carbon_get_the_post_meta('crb_company_country'); ?>
              </td>
            </tr>
            <!-- END Країна -->

            <!-- Місто -->
            <tr class="border-b border-gray-300">
              <td class="whitespace-nowrap px-2 py-3">
                <div class="font-medium"><?php _e("Місто", "treba-wp"); ?></div>
              </td>
              <td class="whitespace-nowrap px-2 py-3">
                <?php echo carbon_get_the_post_meta('crb_company_city'); ?>
              </td>
            </tr>
            <!-- END Місто -->

            <!-- Вартість -->
            <tr class="border-b border-gray-300">
              <td class="whitespace-nowrap px-2 py-3">
                <div class="font-medium"><?php _e("Вартість роботи", "treba-wp"); ?></div>
              </td>
              <td class="whitespace-nowrap px-2 py-3">
                Від 20$/год.
              </td>
            </tr>
            <!-- END Вартість -->

            <!-- Співробітників -->
            <tr class="border-b border-gray-300">
              <td class="whitespace-nowrap px-2 py-3">
                <div class="font-medium"><?php _e("Співробітників", "treba-wp"); ?></div>
              </td>
              <td class="whitespace-nowrap px-2 py-3">
                <?php echo carbon_get_the_post_meta('crb_company_employees'); ?>
              </td>
            </tr>
            <!-- END Співробітників -->

            <!-- Заснована -->
            <tr class="border-b border-gray-300">
              <td class="whitespace-nowrap px-2 py-3">
                <div class="font-medium"><?php _e("Заснована", "treba-wp"); ?></div>
              </td>
              <td class="whitespace-nowrap px-2 py-3">
                <?php echo carbon_get_the_post_meta('crb_company_founded'); ?>
              </td>
            </tr>
            <!-- END Заснована -->
          </tbody>
        </table>
        <div class="mb-6">
          <h2 class="text-xl uppercase font-bold mb-4"><?php _e("Відгуки", "treba-wp"); ?></h2>
          <div class="content">
            <?php comments_template(); ?>
          </div>
        </div>
        <!-- Хлебные крошки -->
        <div class="breadcrumbs text-sm text-gray-800 dark:text-gray-200 " itemprop="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
          <ul class="flex items-center flex-wrap -mr-4">
            <li itemprop='itemListElement' itemscope itemtype='https://schema.org/ListItem' class="breadcrumbs_item px-4 pl-8">
              <a itemprop="item" href="<?php echo home_url(); ?>" class="text-indigo-400 dark:text-indigo-500">
                <span itemprop="name"><?php _e( 'Головна', 'treba-wp' ); ?></span>
              </a>                        
              <meta itemprop="position" content="1">
            </li>
            <li itemprop='itemListElement' itemscope itemtype='http://schema.org/ListItem' class="breadcrumbs_item px-4">
              <a itemprop="item" href="<?php echo get_post_type_archive_link('company'); ?>" class="text-indigo-400 dark:text-indigo-500">
                <span itemprop="name"><?php _e( 'Компанії', 'treba-wp' ); ?></span>
              </a>                        
              <meta itemprop="position" content="2">
            </li>
            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="breadcrumbs_item text-gray-600 dark:text-gray-400 px-4">
              <span itemprop="name"><?php the_title(); ?></span>
              <meta itemprop="position" content="3" />
            </li>
          </ul>
        </div>
        <!-- END Хлебные крошки -->
      </div>

      <div class="bg-white dark:bg-slate-700 shadow-lg rounded-lg p-4 lg:p-8 mb-10">
        <div class="flex items-center mb-8">
          <div class="bg-slate-800 text-gray-300 rounded-lg p-1 mr-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 lg:w-8 h-6 lg:h-8">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
            </svg>
          </div>
          <h2 class="text-3xl lg:text-4xl font-bold"><?php _e("Інші компанії", "treba-wp"); ?></h2>
        </div>
        <div class="flex flex-wrap lg:-mx-4 ">
          <?php 
            $getCurrentTermId = $service_term->term_id;
            $current_id = get_the_ID();
            $query = new WP_Query( array( 
              'post_type' => 'company', 
              'posts_per_page' => 4,
              'post__not_in' => array($current_id),
              'order'    => 'DESC',
              'tax_query' => array(
                array(
                  'taxonomy' => 'services',
                  'terms' => $getCurrentTermId,
                  'field' => 'term_id',
                  'include_children' => true,
                  'operator' => 'IN'
                )
              ),
            ) );
            if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); 
          ?>
            <div class="w-full lg:w-1/2 lg:px-4 mb-4">
              <?php echo get_template_part('template-parts/company-item'); ?>
            </div>
          <?php endwhile; endif; wp_reset_postdata(); ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>