</div>
<!-- end wrap -->

<footer>
  <div class="container">
    <div class="flex flex-col lg:flex-row lg:justify-between">
      <div class="mb-4 lg:mb-0">
        © Treba Solutions, 2023
      </div>
      <div>
        <a href="https://webgolovolomki.com/">
          <img src="https://treba-solutions.com/wp-content/uploads/2023/01/webg.jpg" alt="Web Головоломки" width="20">
        </a>
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