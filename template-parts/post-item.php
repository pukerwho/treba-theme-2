
<div class="mb-4">  
  <?php 
    $medium_thumb = get_the_post_thumbnail_url(get_the_ID(), 'medium');
    $large_thumb = get_the_post_thumbnail_url(get_the_ID(), 'large');
  ?>
  <img 
  class="w-full h-[160px] object-cover rounded-lg" 
  alt="<?php the_title(); ?>" 
  src="<?php echo $medium_thumb; ?>" 
  srcset="<?php echo $medium_thumb; ?> 1024w, <?php echo $large_thumb; ?> 1536w" 
  loading="lazy" 
  data-src="<?php echo $medium_thumb; ?>" 
  data-srcset="<?php echo $medium_thumb; ?> 1024w, <?php echo $large_thumb; ?> 1536w">
</div>
<div class="mb-2"><?php echo get_the_modified_time('F j, Y'); ?></div>
<div class="font-bold"><a href="<?php the_permalink(); ?>" class="hover:text-blue-500"><?php the_title(); ?></a></div>