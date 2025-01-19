<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="<?php bloginfo( 'charset' ); ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
	<link rel="stylesheet"
		href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" />
	<link rel="stylesheet"	href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
	<link rel="stylesheet"	href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
  
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <?php wp_body_open(); ?>
  <header class="header section" id="header">
		<div class="section__content">
      <div class="header__items">
        <div class="header__logo">
          <a href="<?php echo get_home_url(); ?>">
            <img src="<?php echo get_template_directory_uri() . "/assets/public/imgs/" . "logo.svg" ?>" alt="Логотип NullsCode">
          </a>
        </div>
        <div class="header__menu">
          <?php 
            wp_nav_menu( 
              array(
                'theme_location' => 'top-menu',
              )
            );
          ?>  
        </div>
      </div>
    </div>    
  </header>