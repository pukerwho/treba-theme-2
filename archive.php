<?php get_header(); ?>

<div class="container pt-8">
  <div class="flex flex-wrap lg:-mx-5">
    <div class="w-full lg:w-1/4 lg:px-5">
      <?php get_template_part("template-parts/sidebar"); ?>
    </div>
    <div class="w-full lg:w-3/4 lg:px-5">
      <div class="bg-white dark:bg-slate-700 shadow-lg rounded-lg p-4 lg:p-8 mb-10">
        <div class="flex items-center mb-8">
          <div class="bg-slate-800 text-gray-300 rounded-lg p-1 mr-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 lg:w-8 h-6 lg:h-8">
              <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
            </svg>
          </div>
          <h1 class="text-3xl lg:text-4xl font-bold"><?php the_archive_title(); ?></h1>
        </div>
        <div class="flex flex-wrap lg:-mx-5 mb-4">
          <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <!-- Post item -->
            <div class="w-full lg:w-1/3 lg:px-5 mb-5">
              <?php get_template_part('template-parts/post-item'); ?>
            </div>
            <!-- END Post item -->
          <?php endwhile; endif; wp_reset_postdata(); ?>
        </div>
        <div>
          <?php posts_nav_link(); ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>
