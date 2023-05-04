<!doctype html>
<html <?php language_attributes(); ?>>
<head>
  <?php 
    $current_title = wp_get_document_title();

    // FOR Main Page
    if ( is_home() ) {
      $home_title = crb_get_i18n_theme_option('crb_seo_mainpage_title'); 
      $home_description = crb_get_i18n_theme_option('crb_seo_mainpage_description'); 
      if ($home_title) {
        $current_title = $home_title;
      }
      if ($home_description) {
        $current_description = $home_description;
      }
    }

    if ( is_singular( 'post' ) ) {
      if (carbon_get_the_post_meta('crb_post_title')) {
        $current_title = carbon_get_the_post_meta('crb_post_title');
      }
      if (carbon_get_the_post_meta('crb_post_description')) {
        $current_description = carbon_get_the_post_meta('crb_post_description');
      }
    }
  ?>
  <title><?php echo $current_title; ?></title>
  <?php if ($current_description): ?>
    <meta name="description" content="<?php echo $current_description; ?>" />
  <?php endif; ?>

  <?php if (get_the_post_thumbnail_url()): ?>
    <meta property="og:image" content="<?php echo get_the_post_thumbnail_url(); ?>">
  <?php else: ?>
    <meta property="og:image" content="https://treba-solutions.com/wp-content/uploads/2023/05/treba.png">
  <?php endif; ?>
  <?php if (is_singular()): ?>
    <meta property="og:title" content="<?php echo $current_title; ?>" />
    <?php if ($current_description): ?>
      <meta property="og:description" content="<?php echo $current_description; ?>" />
    <?php else: ?>
      <?php 
        $content_text_for_description = wp_strip_all_tags( get_the_content() );
      ?>
      <meta property="og:description" content="<?php echo mb_strimwidth($content_text_for_description, 0, 150, '...'); ?>" />
    <?php endif; ?>
    <?php $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>
    <meta property="og:url" content="<?php echo $actual_link; ?>" />
    <meta property="og:article:published_time" content="<?php echo get_post_time('Y/n/j'); ?>" />
    <meta property="og:article:article:modified_time" content="<?php echo get_the_modified_time('Y/n/j'); ?>" />
    
    <?php if (carbon_get_the_post_meta('crb_post_author')): ?>
      <meta property="og:article:author" content="<?php echo carbon_get_the_post_meta('crb_post_author'); ?>" />
    <?php else: ?>
      <meta property="og:article:author" content="<?php echo get_the_author(); ?>" />
    <?php endif; ?>
  <?php endif; ?>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#1D1E22" />
	<link rel="profile" href="https://gmpg.org/xfn/11">
  
	<?php wp_head(); ?>
	<?php echo carbon_get_theme_option('crb_google_analytics'); ?>

</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
  <header>
    <div class="header-top border-b border-gray-300 py-4 mb-0 lg:mb-4">
      <div class="container">
        <div class="flex justify-between items-center">
          <div class="flex items-center">
            <div class="flex items-center text-xl relative px-2 mr-6">
              <a href="<?php echo get_home_url(); ?>" class="absolute-link"></a>
              <span class="inline-block w-[20px] h-[20px] bg-indigo-500 mr-2"></span>
              <span class="uppercase italic font-black">Treba</span>
            </div>
            <div class="header-menu hidden lg:block">
              <?php wp_nav_menu([
                'theme_location' => 'header',
                'container' => 'div',
                'menu_class' => 'flex',
              ]); ?> 
            </div>
          </div>
          <div class="flex items-center">
            <div class="flex items-center lg:hidden bg-slate-300 rounded px-2 py-1 mr-4 menu-open-js">
              <div class="mr-2"><?php _e("Меню", "treba-wp"); ?></div>
              <div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
              </div>
            </div>
            <div class="flex items-center text-slate-700 lg:border-r lg:border-gray-400 lg:mr-4 lg:pr-4">
              <div class="mr-3">
                <svg enable-background="new 0 0 24 24" viewBox="0 0 24 24" class="h-4 w-4" xmlns="http://www.w3.org/2000/svg"><path fill="currentColor" d="m9.417 15.181-.397 5.584c.568 0 .814-.244 1.109-.537l2.663-2.545 5.518 4.041c1.012.564 1.725.267 1.998-.931l3.622-16.972.001-.001c.321-1.496-.541-2.081-1.527-1.714l-21.29 8.151c-1.453.564-1.431 1.374-.247 1.741l5.443 1.693 12.643-7.911c.595-.394 1.136-.176.691.218z"/></svg>
              </div>
              <div>
                <svg enable-background="new 0 0 24 24" viewBox="0 0 24 24" class="h-4 w-4" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="m15.997 3.985h2.191v-3.816c-.378-.052-1.678-.169-3.192-.169-3.159 0-5.323 1.987-5.323 5.639v3.361h-3.486v4.266h3.486v10.734h4.274v-10.733h3.345l.531-4.266h-3.877v-2.939c.001-1.233.333-2.077 2.051-2.077z"/></svg>
              </div>
            </div>
            <div class="hidden lg:block">
              <?php echo date('d.m.Y'); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="header-bottom hidden lg:block pb-4">
      <div class="container">
        <div class="flex items-center -mx-4">
          <?php $all_cats = get_terms( array( 
            'taxonomy' => 'category', 
            'parent' => 0, 
            'hide_empty' => false,
            'exclude'  => 1,
          ));
          foreach ( array_slice($all_cats, 0, 9) as $all_cat ): ?>
            <div class="px-4">
              <a href="<?php echo get_term_link($all_cat); ?>" class="uppercase text-sm text-gray-700 font-semibold hover:text-blue-600"><?php echo $all_cat->name ?></a>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </header>
  <div class="wrap">