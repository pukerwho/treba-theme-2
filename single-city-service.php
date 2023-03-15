<?php get_header(); ?>

<?php echo get_template_part('template-parts/menu'); ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<main>
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
  ?>
  <div class="container mx-auto">
    <h1 class="text-2xl uppercase font-bold mb-3"><?php echo $heading; ?></h1>
    
    
    <!-- Хлебные крошки -->
    <div class="breadcrumbs text-sm text-gray-800 dark:text-gray-200 mb-12" itemprop="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
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

    <div class="flex flex-wrap lg:-mx-4 mb-2">
      <?php 
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
        if ($company_posts->have_posts()) : while ($company_posts->have_posts()) : $company_posts->the_post(); 
      ?>
        <div class="w-full lg:w-1/2 lg:px-4 mb-4">
          <?php echo get_template_part('template-parts/company-item'); ?>
        </div>
      <?php endwhile; endif; wp_reset_postdata(); ?>
    </div>
    <div class="content mb-10">
      <?php the_content(); ?>
    </div>
    <div>
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
</main>
<?php endwhile; endif; wp_reset_postdata(); ?>

<?php get_footer(); ?>