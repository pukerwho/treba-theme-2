</div>
<!-- end wrap -->

<div class="bg-white dark:bg-slate-700 rounded-lg m-2 py-4 lg:py-8 lg:p-8">
  <div class="container">
    <div class="text-xl font-bold mb-4">🔍 <?php _e("Популярні запити", "treba-wp"); ?>:</div>
    <div class="flex flex-wrap lg:-mx-2 px-2 py-2">
      <?php 
        $current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $footer_links = footer_links($current_url);
        foreach ($footer_links as $footer_link):
      ?>
        <div class="w-full lg:w-1/2 xl:w-1/3 px-2 mb-2">
          <?php 
            echo $footer_link->top_links; 
          ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>

<footer class="bg-white dark:bg-slate-700 rounded-lg m-2 py-4 lg:py-8 lg:p-8">
  <div class="container">
    <div class="flex flex-col lg:flex-row lg:justify-between">
      <div class="mb-4 lg:mb-0">
        © Treba Solutions, 2023
      </div>
      <div class="flex items-center -mx-2">
        <div class="px-2">
          <a href="https://webgolovolomki.com/">
            <img src="https://treba-solutions.com/wp-content/uploads/2023/01/webg.jpg" alt="Web Головоломки" width="20">
          </a>
        </div>
        <div class="px-2">
          <a href="https://d-art.org.ua/">
            <img src="https://treba-solutions.com/wp-content/uploads/2023/05/dart-favicon.jpg" alt="D-Art" width="20">
          </a>
        </div>
      </div>
    </div>
  </div>
</footer>

<div class="mobile-menu w-full h-full fixed top-0 left-0 bg-gray-200 hidden">
  <div class="container">
    <div class="flex items-center justify-between py-4 mb-4">
      <div class="flex items-center text-xl relative px-2 mr-6">
        <a href="<?php echo get_home_url(); ?>" class="absolute-link"></a>
        <span class="inline-block w-[20px] h-[20px] bg-indigo-500 mr-2"></span>
        <span class="uppercase italic font-black">Treba</span>
      </div>
      <div class="flex items-center lg:hidden bg-slate-300 rounded px-2 py-1 menu-close-js">
        <div class="mr-2"><?php _e("Закрити", "treba-wp"); ?></div>
        <div>
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
          </svg>
        </div>
      </div>
    </div>
    <div class="mobile-nav">
      <?php wp_nav_menu([
        'theme_location' => 'header',
        'container' => 'div',
        'menu_class' => 'flex flex-col',
      ]); ?> 
    </div>
  </div>
</div>

<?php wp_footer(); ?>

</body>
</html>