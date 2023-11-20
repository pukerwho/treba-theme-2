<?php get_header(); ?>

<div class="container pt-8">
  <div class="flex flex-col-reverse lg:flex-row flex-wrap lg:-mx-5">
    <div class="w-full lg:w-1/4 lg:px-5">
      <?php get_template_part("template-parts/sidebar"); ?>
    </div>
    <div class="w-full lg:w-3/4 lg:px-5">
      <div class="bg-white dark:bg-slate-700 shadow-lg rounded-lg p-8 mb-10">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>  
          <h1 class="text-2xl uppercase font-bold border-b border-gray-200 pb-4 mb-4"><?php the_title(); ?></h1>
          <?php if (get_the_post_thumbnail_url()): ?>
            <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" class="w-full h-80 xl:h-full object-cover rounded-lg mb-6">
          <?php endif; ?>
          <div class="content" >
            <?php the_content(); ?>
          </div>
          <?php if (carbon_get_the_post_meta('crb_similar_links')): ?>
          <div class="pt-6">
            <div class="text-2xl mb-4"><?php _e("Схожі сторінки", "treba-wp"); ?></div>
            <?php 
            $similar_links = carbon_get_the_post_meta('crb_similar_links');
            foreach ($similar_links as $link):
            ?>
              <?php $link_id = $link['id']; ?>
              <div class="flex text-xl text-blue-800 dark:text-blue-400 font-light mb-4 last-of-type:mb-0">
                <div class="w-4 min-w-[1rem] h-4 min-h-4 rounded-full bg-gray-400 mr-4 translate-y-[0.4rem]"></div>
                <a href="<?php echo get_the_permalink($link_id); ?>" class=""><?php echo get_the_title($link_id); ?></a>
              </div>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>
        <?php endwhile; endif; wp_reset_postdata(); ?>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>