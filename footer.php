<?php wp_footer(); ?>

<section class="menu">
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #222831;">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
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
<div>
    <ul class="footer-item-menu"
        style="display: flex; justify-content: center; align-items: center; gap: 20px; list-style: none; padding: 0; margin: 0;">
        <li><a href="<?php echo esc_url(home_url('/')); ?>" style="text-decoration: none; color: inherit;"><img
                    src="<?php echo esc_url(get_template_directory_uri() . '/assets/dist/images/Frame 24.png'); ?>"
                    alt="SaulDesign Logo"></a></li>
        <li><a href="<?php echo esc_url(home_url('/')); ?>" style="text-decoration: none; color: inherit;"><img
                    src="<?php echo esc_url(get_template_directory_uri() . '/assets/dist/images/Frame 26.png'); ?>"
                    alt="SaulDesign Logo"></a></li>
        <li><a href="<?php echo esc_url(home_url('/')); ?>" style="text-decoration: none; color: inherit;"><img
                    src="<?php echo esc_url(get_template_directory_uri() . '/assets/dist/images/Frame 27.png'); ?>"
                    alt="SaulDesign Logo"></a></li>
        <li><a href="<?php echo esc_url(home_url('/')); ?>" style="text-decoration: none; color: inherit;"><img
                    src="<?php echo esc_url(get_template_directory_uri() . '/assets/dist/images/Frame 25.png'); ?>"
                    alt="SaulDesign Logo"></a></li>
    </ul>
</div>
<div>
    <p style="text-align: right; margin: 0 15px 0 0; padding: 8px 0; font-family: Arial, sans-serif; color: #EEEEEEBF;"> Terms of Service - Privacy Policy</p>
</div>
</body>

</html>