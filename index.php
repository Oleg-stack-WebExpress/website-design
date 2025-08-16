<?php

get_header();

?>

<div class="container">
    <section id="reviews" class="reviews-section">
        <div class="container">
            <div class="box-title">
                <h2 class="why-we__title">My recent works</h2>
            </div>

            <div class="row">
                <div class="col-12">
                    <!-- Вставляем шорткод с дополнительными классами стилизации -->
                    <div class="reviews-carousel-wrapper">
                        <?php echo do_shortcode('[review-list count="6"]'); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <?php
    echo do_shortcode('[contact-form-7 id="de14f34" title="Форма заявок"]');
    ?>


</div>

<?php
get_footer();
