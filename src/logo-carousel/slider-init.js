function getDirection() {
  var windowWidth = window.innerWidth;
  var direction = window.innerWidth <= 479 ? "vertical" : "horizontal";

  return direction;
}

var swiper = new Swiper(".slider-dark .swiper", {
  slidesPerView: 3,
  spaceBetween: 16,
  loop: true,
  speed: 300,
  direction: getDirection(),
  navigation: {
    nextEl: ".slider-dark .custom-navigation-next",
    prevEl: ".slider-dark .custom-navigation-prev",
  },
  on: {
    resize: function () {
      swiper.changeDirection(getDirection());
    },
  },
  // Responsive breakpoints
  breakpoints: {
    // when window width is >= 320px
    320: {
      slidesPerView: 1,
      spaceBetween: 0,
    },
    // when window width is >= 480px
    480: {
      slidesPerView: 3,
      spaceBetween: 16,
    },
    // when window width is >= 640px
    640: {
      slidesPerView: 4,
      spaceBetween: 12,
    },
  },
});

var swiper_2 = new Swiper(".slider-light .swiper", {
  slidesPerView: 3,
  spaceBetween: 16,
  loop: true,
  speed: 300,
  direction: getDirection(),
  navigation: {
    nextEl: ".slider-light .custom-navigation-next",
    prevEl: ".slider-light .custom-navigation-prev",
  },
  on: {
    resize: function () {
      swiper.changeDirection(getDirection());
    },
  },
  // Responsive breakpoints
  breakpoints: {
    // when window width is >= 320px
    320: {
      slidesPerView: 1,
      spaceBetween: 0,
    },
    // when window width is >= 480px
    480: {
      slidesPerView: 3,
      spaceBetween: 16,
    },
    // when window width is >= 640px
    640: {
      slidesPerView: 4,
      spaceBetween: 12,
    },
  },
});

var swiper_3 = new Swiper(".slider-rounded .swiper", {
  slidesPerView: 3,
  spaceBetween: 16,
  loop: true,
  speed: 300,
  direction: getDirection(),
  navigation: {
    nextEl: ".slider-rounded .custom-navigation-next",
    prevEl: ".slider-rounded .custom-navigation-prev",
  },
  on: {
    resize: function () {
      swiper.changeDirection(getDirection());
    },
  },
  // Responsive breakpoints
  breakpoints: {
    // when window width is >= 320px
    320: {
      slidesPerView: 1,
      spaceBetween: 0,
    },
    // when window width is >= 480px
    480: {
      slidesPerView: 3,
      spaceBetween: 16,
    },
    // when window width is >= 640px
    640: {
      slidesPerView: 4,
      spaceBetween: 12,
    },
  },
});


var swiper_4 = new Swiper(".slider-square .swiper", {
  slidesPerView: 3,
  spaceBetween: 16,
  loop: true,
  speed: 300,
  direction: getDirection(),
  navigation: {
    nextEl: ".slider-square .custom-navigation-next",
    prevEl: ".slider-square .custom-navigation-prev",
  },
  pagination: {
    el: ".slider-square .swiper-pagination",
    type: 'bullets',
    clickable: true,
  },
  on: {
    resize: function () {
      swiper.changeDirection(getDirection());
    },
  },
  // Responsive breakpoints
  breakpoints: {
    // when window width is >= 320px
    320: {
      slidesPerView: 1,
      spaceBetween: 0,
    },
    // when window width is >= 480px
    480: {
      slidesPerView: 3,
      spaceBetween: 16,
    },
    // when window width is >= 640px
    640: {
      slidesPerView: 4,
      spaceBetween: 12,
    },
  },
});

var swiper_5 = new Swiper(".slider-square-bg .swiper", {
  slidesPerView: 3,
  spaceBetween: 16,
  loop: true,
  speed: 300,
  direction: getDirection(),
  navigation: {
    nextEl: ".slider-square-bg .custom-navigation-next",
    prevEl: ".slider-square-bg .custom-navigation-prev",
  },
  pagination: {
    el: ".slider-square-bg .swiper-pagination",
    type: 'bullets',
    clickable: true,
  },
  on: {
    resize: function () {
      swiper.changeDirection(getDirection());
    },
  },
  // Responsive breakpoints
  breakpoints: {
    // when window width is >= 320px
    320: {
      slidesPerView: 1,
      spaceBetween: 0,
    },
    // when window width is >= 480px
    480: {
      slidesPerView: 3,
      spaceBetween: 16,
    },
    // when window width is >= 640px
    640: {
      slidesPerView: 4,
      spaceBetween: 12,
    },
  },
});