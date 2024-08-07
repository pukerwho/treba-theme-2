<?php 
get_header(); 
$countNumber = tutCount(get_the_ID()); 
?>

<div class="container pt-8">
  <div class="flex flex-col-reverse lg:flex-row flex-wrap lg:-mx-5">
    <div class="w-full lg:w-1/4 lg:px-5">
      <?php get_template_part("template-parts/sidebar"); ?>
    </div>
    <div class="w-full lg:w-3/4 lg:px-5">
      <div class="bg-white dark:bg-slate-700 shadow-lg rounded-lg p-4 lg:p-8 mb-10">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <article itemscope itemtype="http://schema.org/Article">
          <h1 class="text-2xl uppercase font-bold border-b border-gray-200 dark:border-slate-400 pb-4 mb-4" itemprop="headline"><?php the_title(); ?></h1>
          <div class="flex flex-col xl:flex-row xl:-mx-4 mb-6">
            <div class="w-full xl:w-3/4 xl:px-4 xl:mb-0">
              <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" class="w-full object-cover rounded-lg border shadow-xl mr-4 mb-6 lg:mb-0" itemprop="image">
            </div>
            <div class="w-full xl:w-1/4 xl:px-4">
              <div class="sticky top-4">
                <div class="text-sm opacity-75 border-b border-gray-200 dark:border-slate-400 mb-3 pb-3">
                  <div>
                    <span class="font-medium"><?php _e("Автор", "treba-wp"); ?></span>: 
                    <?php if (carbon_get_the_post_meta('crb_post_author')): ?>
                      <span class="italic"><?php echo carbon_get_the_post_meta('crb_post_author'); ?></span>
                      <div class="flex items-center text-sm">
                        <!-- instagram -->
                        <?php if (carbon_get_the_post_meta('crb_post_author_instagram')): ?>
                          <div class="italic pb-2 pr-3"><a href="<?php echo carbon_get_the_post_meta('crb_post_author_instagram'); ?>" class="text-indigo-500">Instagram</a></div>
                        <?php endif; ?>
                        <!-- facebook --> 
                        <?php if (carbon_get_the_post_meta('crb_post_author_facebook')): ?>
                          <div class="italic pb-2"><a href="<?php echo carbon_get_the_post_meta('crb_post_author_facebook'); ?>" class="text-indigo-500">Facebook</a></div>
                        <?php endif; ?>
                      </div>

                    <?php else: ?>
                      <?php echo get_the_author(); ?>
                    <?php endif; ?>
                  </div>
                  <?php if (carbon_get_the_post_meta('crb_post_editor')): ?>
                    <div><span class="font-medium"><?php _e("Редактор", "treba-wp"); ?></span>: <span class="italic"><?php echo carbon_get_the_post_meta('crb_post_editor'); ?></span></div>
                  <?php endif; ?>
                  
                </div>
                <div class="border-b border-gray-200 dark:border-slate-400 pb-4 mb-4">
                  <div class="text-lg mb-2">📎 <?php _e("Поділитися", "treba-wp"); ?></div>
                  <div>
                    <?php do_action('show_social_share_buttons'); ?>
                  </div>
                </div>
                <div class="flex items-center mb-2">
                  <div class="mr-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                      <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                  </div>
                  <div>
                    <span class="italic"><?php _e("Переглядів", "treba-wp"); ?></span>: <?php echo $countNumber; ?>
                  </div>
                </div>
                <div class="flex items-center">
                  <div class="mr-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                    </svg>
                  </div>
                  <span class="italic"><?php _e("Дата", "treba-wp"); ?></span>: <?php echo get_the_date('d.m.Y'); ?>
                </div>
              </div>
            </div>
          </div>
          <div class="content mb-8" itemprop="articleBody">
            <div class="single-subjects hidden mb-5">
              <div class="text-2xl text-slate-800 dark:text-gray-300 font-black uppercase mb-4">
                <?php if (carbon_get_the_post_meta('crb_post_moskal')): ?>
                  <?php _e("Содержание", "treba-wp"); ?>
                <?php else: ?>
                  <?php _e("Зміст", "treba-wp"); ?>
                <?php endif; ?>
              </div>
              <div class="single-subjects-inner"></div>
            </div>
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
                <a itemprop="item" href="<?php echo get_page_url('page-blog'); ?>" class="text-indigo-400 dark:text-indigo-500">
                  <span itemprop="name"><?php _e( 'Блог', 'treba-wp' ); ?></span>
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
        <article>
        <?php endwhile; endif; wp_reset_postdata(); ?>
      </div>
      
      <div class="bg-white dark:bg-slate-700 shadow-lg rounded-lg p-4 lg:p-8 mb-10">
        <div class="flex items-center mb-8">
          <div class="bg-slate-800 text-gray-300 rounded-lg p-1 mr-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 lg:w-8 h-6 lg:h-8">
              <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
            </svg>
          </div>
          <h2 class="text-3xl lg:text-4xl font-bold"><?php _e("Схожі статті", "treba-wp"); ?></h2>
        </div>
        <div class="flex flex-wrap lg:-mx-4 mb-0 lg:mb-4">
          <?php 
            $all_posts = new WP_Query( array( 
              'post_type' => 'post', 
              'posts_per_page' => 6,
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
      </div>

      <div class="bg-white dark:bg-slate-700 shadow-lg rounded-lg p-4 lg:p-8 mb-10">
        <div class="flex items-center mb-8">
          <div class="bg-slate-800 text-gray-300 rounded-lg p-1 mr-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 lg:w-8 h-6 lg:h-8">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6.633 10.25c.806 0 1.533-.446 2.031-1.08a9.041 9.041 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282m0 0h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H13.48c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23H5.904m10.598-9.75H14.25M5.904 18.5c.083.205.173.405.27.602.197.4-.078.898-.523.898h-.908c-.889 0-1.713-.518-1.972-1.368a12 12 0 0 1-.521-3.507c0-1.553.295-3.036.831-4.398C3.387 9.953 4.167 9.5 5 9.5h1.053c.472 0 .745.556.5.96a8.958 8.958 0 0 0-1.302 4.665c0 1.194.232 2.333.654 3.375Z" />
            </svg>
          </div>
          <h2 class="text-3xl lg:text-4xl font-bold"><?php _e("Наш вибір", "treba-wp"); ?></h2>
        </div>
        <div class="flex flex-wrap lg:-mx-4 mb-0 lg:mb-4">
          <?php 
            $all_posts = new WP_Query( array( 
              'post_type' => 'post', 
              'posts_per_page' => 9,
              'orderby' => 'rand',
              'meta_query' => array(
                array(
                  'key' => '_crb_post_keywords',
                  'value' => '',
                  'compare' => '='
                ),
              ),
              'tax_query' => array(
                array(
                  'taxonomy'  => 'category',
                  'field'     => 'term_id',
                  'terms'     => array( 373, 369, 382),
                )
              ),
              
            ) );
            if ($all_posts->have_posts()) : while ($all_posts->have_posts()) : $all_posts->the_post(); 
          ?>
            <div class="w-full lg:w-1/3 lg:px-5 mb-5">
              <?php get_template_part("template-parts/post-item"); ?>
            </div>
          <?php endwhile; endif; wp_reset_postdata(); ?>
        </div>
      </div>

    </div>
  </div>
</div>

<?php get_footer(); ?>