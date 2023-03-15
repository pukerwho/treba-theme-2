<?php get_header(); ?>
<div class="container pt-8">
  <div class="flex flex-col-reverse lg:flex-row flex-wrap lg:-mx-5">
    <div class="w-full lg:w-1/4 lg:px-5">
      <?php get_template_part("template-parts/sidebar"); ?>
    </div>
    <div class="w-full lg:w-3/4 lg:px-5">
      <div class="bg-white shadow-lg rounded-lg p-4 lg:p-8 mb-10">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
          <?php 
            $currentId = get_the_ID();

            $get_city = get_the_terms( $currentId, 'city' );
            $get_city_name = $get_city[0]->name;
            $get_city_id = $get_city[0]->term_id;

            $get_service = get_the_terms( $currentId, 'services' );
            $get_service_name = $get_service[0]->name;
            $get_service_id = $get_service[0]->term_id;

            $heading = $get_service_name . ' у місті ' . $get_city_name;
            $breadcrumbs_title = $get_service_name . ' у м.' . $get_city_name;

            $company_posts = new WP_Query( array( 
              'post_type' => 'company', 
              'posts_per_page' => 32,
              'order' => 'DESC',
              'tax_query' => array(
                'relation' => 'AND',
                array(
                  'taxonomy' => 'city',
                  'field' => 'id',
                  'terms' => $get_city_id
                ),
                array(
                  'taxonomy' => 'services',
                  'field' => 'id',
                  'terms' => $get_service_id
                )
              )
            ) );

            $company_array = get_posts(array(
              'post_type' => 'company', 
              'posts_per_page' => 32,
              'order' => 'DESC',
              'tax_query' => array(
                'relation' => 'AND',
                array(
                  'taxonomy' => 'city',
                  'field' => 'id',
                  'terms' => $get_city_id
                ),
                array(
                  'taxonomy' => 'services',
                  'field' => 'id',
                  'terms' => $get_service_id
                )
              )
            ));
          ?>
          <h1 class="text-2xl lg:text-3xl font-bold mb-8"><?php echo $heading; ?></h1>
          <table class="w-full border bg-gray-100 table-auto mb-8">
            <tbody>
              <tr class="border-b border-gray-300">
                <td class="font-semibold whitespace-nowrap px-2 py-3">📒 <?php _e("Кількість пропозицій", "treba-wp"); ?></td>
                <td class="whitespace-nowrap px-2 py-3"><?php echo $company_posts->post_count; ?></td>
              </tr>
              <tr class="border-b border-gray-300">
                <td class="font-semibold whitespace-nowrap px-2 py-3">💲 <?php _e("Середня вартість послуги", "treba-wp"); ?></td>
                <td class="whitespace-nowrap px-2 py-3">
                  20$/год.
                </td>
              </tr>
              <tr class="border-b border-gray-300">
                <td class="font-semibold whitespace-nowrap px-2 py-3">🚀 <?php _e("Конкуренція", "treba-wp"); ?></td>
                <td class="whitespace-nowrap px-2 py-3">
                  <?php if ($company_posts->post_count > 10) {
                    echo 'Висока';
                  } elseif ($company_posts->post_count < 4) {
                    echo 'Низька';
                  } else {
                    echo 'Середня';
                  }; ?>
                </td>
              </tr>
              <tr class="border-b border-gray-300">
                <td class="font-semibold whitespace-nowrap px-2 py-3">🕒 <?php _e("Інформація оновлена", "treba-wp"); ?></td>
                <td class="whitespace-nowrap px-2 py-3"><?php echo date('d.m.Y',strtotime("-1 days")); ?></td>
              </tr>
            </tbody>
          </table>
          <h2 class="text-2xl font-medium mb-4"><?php _e("Список компанії", "treba-wp"); ?></h2>
          <div class="flex flex-wrap lg:-mx-4 mb-8">
            <?php if ($company_posts->have_posts()) : while ($company_posts->have_posts()) : $company_posts->the_post(); ?>
              <div class="w-full lg:w-1/2 lg:px-4 mb-4">
                <?php echo get_template_part('template-parts/company-item'); ?>
              </div>
            <?php endwhile; endif; wp_reset_postdata(); ?>
          </div>
          <div class="mb-8">
            <h2 class="text-2xl font-medium mb-4"><?php _e("Яка ціна?", "treba-wp"); ?></h2>
            <table class="w-full border table-auto ">
							<thead>
								<tr class="bg-slate-200">
									<th class="py-2"><?php _e('Компанія', 'treba-wp'); ?></th>
									<th class="py-2"><?php _e('Ціна', 'treba-wp'); ?></th>
								</tr>
							</thead>
							<tbody>
								<?php foreach (array_slice($company_array, 0,5) as $post): ?>
								<tr class="border-b border-gray-300">
									<td class="p-2"><?php echo $post->post_title; ?></td>
									<td class="p-2"><?php _e("Від", "treba-wp"); ?> 20$/год.</td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
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
                <a itemprop="item" href="" class="text-indigo-400 dark:text-indigo-500">
                  <span itemprop="name"><?php _e( 'Послуги', 'treba-wp' ); ?></span>
                </a>                        
                <meta itemprop="position" content="2">
              </li>
              <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="breadcrumbs_item text-gray-600 px-4">
                <span itemprop="name"><?php echo $breadcrumbs_title; ?></span>
                <meta itemprop="position" content="3" />
              </li>
            </ul>
          </div>
          <!-- END Хлебные крошки -->
        <?php endwhile; endif; wp_reset_postdata(); ?>  
      </div>
      <div class="bg-white shadow-lg rounded-lg p-4 lg:p-8 mb-10">
        <div class="flex flex-wrap lg:-mx-6">
          <div class="w-full lg:w-1/2 lg:px-6 mb-6 lg:mb-0">
            <h2 class="inline-block text-2xl border-b-4 border-indigo-500 mb-4"><?php _e("Інші послуги", "treba-wp"); ?></h2>
            <div class="text-sm">
              <?php 
              $service_post = new WP_Query( array( 
                'post_type' => 'city-service', 
                'posts_per_page' => 20,
                'orderby'    => 'rand',
                'tax_query' => array(
                  array(
                    'taxonomy' => 'city',
                    'terms' => $get_city_id,
                    'field' => 'term_id',
                    'include_children' => true,
                    'operator' => 'IN'
                  )
                ),
              ) );
              if ($service_post->have_posts()) : while ($service_post->have_posts()) : $service_post->the_post(); ?>
                <?php 
                  $get_service = get_the_terms( get_the_ID(), 'services' );
                  $get_service_name = $get_service[0]->name;
                ?>
                <a href="<?php the_permalink(); ?>" class="block text-sm hover:text-indigo-500 mb-2">🔸 <?php echo $get_service_name; ?></a>
              <?php endwhile; endif; wp_reset_postdata(); ?>
            </div>
          </div>
          <div class="w-full lg:w-1/2 lg:px-6 mb-6 lg:mb-0">
            <h2 class="inline-block text-2xl border-b-4 border-indigo-500 mb-4"><?php _e("В іншіх містах", "treba-wp"); ?></h2>
            <div class="text-sm">
              <?php 
              $service_city_post = new WP_Query( array( 
                'post_type' => 'city-service', 
                'posts_per_page' => 20,
                'orderby'    => 'rand',
                'tax_query' => array(
                  array(
                    'taxonomy' => 'services',
                    'terms' => $get_service_id,
                    'field' => 'term_id',
                    'include_children' => true,
                    'operator' => 'IN'
                  )
                ),
              ) );
              if ($service_city_post->have_posts()) : while ($service_city_post->have_posts()) : $service_city_post->the_post(); ?>
                <?php 
                  $get_city = get_the_terms( get_the_ID(), 'city' );
                  $get_city_name = $get_city[0]->name;
                ?>
                <a href="<?php the_permalink(); ?>" class="block text-sm hover:text-indigo-500 mb-2">🔸 <?php echo $get_city_name; ?></a>
              <?php endwhile; endif; wp_reset_postdata(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>