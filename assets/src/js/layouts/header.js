document.addEventListener('DOMContentLoaded', function () {

  var header = document.querySelector('header');

  header.addEventListener('click', () => {
    console.log('click');
  });
});

jQuery.noConflict();
(function ($) {
  // Теперь $ доступен
  $(function () {
    console.log('jQuery works!');
  });
})(jQuery);

jQuery(document).ready(function ($) {
    $(".owl-carousel").owlCarousel({
        loop: true,
        autoplay: true,
        interval: 3000,
        margin: 10,
        mouseDrag: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            600: {
                items: 3,
                nav: false
            },
            1000: {
                items: 5,
                nav: true,
                loop: false
            }
        }
    });

    $('.post-popup-link').magnificPopup({
        type: 'image',
        gallery: {
            enabled: true // Создаёт галерею из всех изображений поста
        },
        image: {
            titleSrc: function (item) {
                // Берём заголовок из alt или title изображения
                return item.el.find('img').attr('alt') ||
                    item.el.find('img').attr('title') ||
                    'Изображение ' + (this.currItem.index + 1);
            }
        },
        callbacks: {
            elementParse: function (item) {
                // Для изображений без ссылки - используем src изображения
                if (!item.el.hasClass('post-popup-link')) {
                    item.src = item.el.find('img').attr('src');
                }
            }
        }
    });



    $('.open-popup-link').magnificPopup({
        type: 'inline',
        midClick: true
    });
});