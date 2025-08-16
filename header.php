<!DOCTYPE html>
<html lang="<?php bloginfo('language'); ?>">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php bloginfo('name'); ?></title>
  <?php wp_head(); ?>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

</head>

<body>
<section class="menu">
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #222831;">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                <?php
                wp_nav_menu([
                    'theme_location' => 'top',
                    'depth' => 2,
                    'container' => false,
                    'menu_class' => 'navbar-nav gap-lg-5 gap-3',
                    'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
                    'walker' => new WP_Bootstrap_Navwalker(),
                    'link_class' => 'nav-link px-3 py-2 rounded' // Добавляем классы для ссылок
                ]);
                ?>
            </div>
        </div>
    </nav>
</section>


  </div>
  </div>
  </nav>