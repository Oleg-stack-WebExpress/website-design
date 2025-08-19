<?php

get_header();

?>
<section id="reviews" class="reviews-section">
    <div class="container">


        <div class="box-title">
            <h2 class="why-we__title"><a href="<?php echo esc_url(home_url('/')); ?>"
                    style="text-decoration: none; color: inherit;"><img
                        src="<?php echo esc_url(get_template_directory_uri() . '/assets/dist/images/My recent works.png'); ?>"
                        alt="SaulDesign Logo"></a></h2>
        </div>
    </div>
    <div class="container container-carousel">

        <!-- Вставляем шорткод с дополнительными классами стилизации -->
        <div class="reviews-carousel-wrapper" style="text-align: center">
            <?php echo do_shortcode('[review-list count="6"]'); ?>

        </div>
    </div>
</section>


<section class="block-form">
    <div class="container">
        <div class="row">
            <div class="col-6">
                <div class="why-we__title"><a href="<?php echo esc_url(home_url('/')); ?>"
                        style="text-decoration: none; color: inherit;"><img
                            src="<?php echo esc_url(get_template_directory_uri() . '/assets/dist/images/Got a project in mind_.png'); ?>"
                            alt="SaulDesign Logo"></a></div>
                <div class="why-we__title man"><a href="<?php echo esc_url(home_url('/')); ?>"
                        style="text-decoration: none; color: inherit;"><img
                            src="<?php echo esc_url(get_template_directory_uri() . '/assets/dist/images/Group 2372.png'); ?>"
                            alt="SaulDesign Logo"></a></div>
            </div>
            <div class="col-6">
                <?php
                echo do_shortcode('[contact-form-7 id="de14f34" title="Форма заявок"]');
                ?>
            </div>
        </div>
    </div>
</section>


</div>

<?php
get_footer();
