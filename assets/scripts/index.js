window.addEventListener('DOMContentLoaded', function () {
  'use strict';

  function setMaxHeightByClass(className) {
    var elements = document.getElementsByClassName(className);
    var maxHeight = 0;

    // Находим самый высокий элемент
    for (var i = 0; i < elements.length; i++) { 
      var elementHeight = elements[i].offsetHeight;
      if (elementHeight > maxHeight) {
        maxHeight = elementHeight;
      }
    }

    // Устанавливаем высоту для всех элементов
    for (var i = 0; i < elements.length; i++) {
      elements[i].style.minHeight = maxHeight + 'px !important';
    }
  }

  // Добавление owl-corusel в недавно просматривали

  if (document.querySelector('.recommendation2')) {
    document.querySelector('.recommendation2 .products').classList.add('owl-carousel');

    setTimeout(() => {
      setMaxHeightByClass('.recommendation2 .recommendation__items__item');
    }, 1000);
  }

  if(document.querySelector('.owl-product-img')){
    $('.owl-product-img').owlCarousel({
      items: 1,
      loop: false,
      nav: true,
      navText: [""],
      dots: true,
      autoplay: false,
      smartSpeed: 800,
    });
  }

  var links = document.getElementsByTagName('a');
  for (var i = 0; i < links.length; i++) {
    if (links[i].innerText === 'Instagram') {
      links[i].classList.add('instagram-link');
      links[i].setAttribute('target', '_blank');
      // Добавьте нужные стили для элемента "а" с классом "instagram-link"
    }
  }

  $('.image-link').magnificPopup({
    type: 'image',
    gallery: {
      enabled: true
    }
  });

  $('.owl-slider').owlCarousel({
    items: 1,
    loop: true,
    nav: false,
    dots: true,
    autoplay: true,
    autoplayTimeout: 5000,
    autoplayHoverPause: true,
    smartSpeed: 1800,
  });

  $('.ced .products').owlCarousel({
    items: 4,
    loop: false,
    nav: true,
    navText: [""],
    dots: true,
    autoplay: false,
    smartSpeed: 800,
    responsive: {
        0: {
            items: 2 // Для экранов шириной от 0 до 599px
        },
        600: {
            items: 4 // Для экранов шириной от 600px и больше
        }
    }
});

});