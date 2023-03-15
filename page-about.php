<?php
/*
Template Name: About
*/
?>
<?php get_header(); ?>

<div class="container pt-8">
  <div class="flex flex-col-reverse lg:flex-row flex-wrap lg:-mx-5">
    <div class="w-full lg:w-1/4 lg:px-5">
      <?php get_template_part("template-parts/sidebar"); ?>
    </div>
    <div class="w-full lg:w-3/4 lg:px-5">
      <div class="bg-white shadow-lg rounded-lg p-8 mb-10">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>  
          <h1 class="text-2xl uppercase font-bold mb-4"><?php the_title(); ?></h1>
          <div class="text-sm opacity-75 border-b border-gray-200 mb-3 pb-3">
            <div><span class="italic"><?php _e("Дата", "treba-wp"); ?></span>: <?php echo get_the_date('d.m.Y'); ?></div>
          </div>
          <?php if (get_the_post_thumbnail_url()): ?>
            <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" class="w-full h-80 xl:h-full object-cover rounded-lg mb-6">
          <?php endif; ?>
          <div class="content" >
            <?php the_content(); ?>
          </div>
        <?php endwhile; endif; wp_reset_postdata(); ?>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>