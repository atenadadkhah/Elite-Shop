//  Cart Open
function clickCart(){
    $('#cartOpen').on('click', function () {
        $('.cart-wrapper').addClass('open');
    });
    $('#cartClose').on('click', function () {
        $('.cart-wrapper').removeClass('open');
    });

}


(function ($) {
  'use strict';
  //Set year
    const myDate = new Date();
    $(".year").text(myDate.getFullYear())
  // Subscription Modal Show
  var show = function () {
    $('#subscriptionModal').modal('show');
  };
  // Preloader
  $(window).on('load', function () {
    $('.preloader').fadeOut('slow', function () {
      $(this).remove();
    });
    var timer = window.setTimeout(show, 2000);
  });

  // Background-images
  $('[data-background]').each(function () {
    $(this).css({
      'background-image': 'url(' + $(this).data('background') + ')'
    });
  });

  //  Search Form Open
  $('#searchOpen').on('click', function () {
    $('.search-wrapper').toggleClass('open');
    $('.search-btn').toggleClass('search-close');
  });

 clickCart()

  //Hero Slider
  $('.hero-slider').slick({
    autoplay: true,
    autoplaySpeed: 7500,
    lazyLoad: 'progressive',
    speed: 100,
     // dir:"rtl",
    pauseOnFocus: false,
    pauseOnHover: false,
    infinite: true,
    arrows: true,
    prevArrow: '<button type=\'button\' class=\'prevArrow\'></button>',
    nextArrow: '<button type=\'button\' class=\'nextArrow\'></button>',
    dots: false,
    responsive: [{
      breakpoint: 576,
      settings: {
        arrows: false
      }
    }]
  });
  $('.hero-slider').slickAnimation();

  // collection slider
  $('.collection-slider').slick({
    dots: true,
    speed: 300,
    autoplay: true,
    autoplaySpeed: 5000,
    arrows: false,
    slidesToShow: 4,
    slidesToScroll: 4,
    responsive: [{
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3
        }
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
    ]
  });

  //  collection item quick view
  $('.venobox').venobox({
    framewidth: '80%',
    frameheight: '100%'
  });

  // deal timer
  var dealYear = $('#simple-timer').attr('data-year');
  var dealMonth = $('#simple-timer').attr('data-month');
  var dealDay = $('#simple-timer').attr('data-day');
  var dealHour = $('#simple-timer').attr('data-hour');
  $('#simple-timer').syotimer({
        lang: 'fa',
        year: dealYear,
        month: dealMonth,
        day: dealDay,
        hour: dealHour,
        minute: 0
  });


  // sale timer
  var saleYear = $('#sale-timer').attr('data-year');
  var saleMonth = $('#sale-timer').attr('data-month');
  var saleDay = $('#sale-timer').attr('data-day');
  var saleHour = $('#sale-timer').attr('data-hour');
  $('#sale-timer').syotimer({
    year: saleYear,
    month: saleMonth,
    day: saleDay,
    hour: saleHour,
    minute: 0
  });

  // Count Down JS
  $('#comingSoon').syotimer({
    year: 2019,
    month: 5,
    day: 9,
    hour: 20,
    minute: 30
  });

  // instafeed
  if (($('#instafeed').length) !== 0) {
    var userId = $('#instafeed').attr('data-userId');
    var accessToken = $('#instafeed').attr('data-accessToken');
    var userFeed = new Instafeed({
      get: 'user',
      userId: userId,
      resolution: 'low_resolution',
      accessToken: accessToken,
      limit: 6,
      template: '<div class="col-lg-2 col-md-3 col-sm-4 col-6 px-0 mb-4"><div class="instagram-post mx-2"><img class="img-fluid w-100" src="{{image}}" alt="instagram-image"><ul class="list-inline text-center"><li class="list-inline-item"><a href="{{link}}" target="_blank" class="text-white"><i class="ti-heart mr-2"></i>{{likes}}</a></li><li class="list-inline-item"><a href="{{link}}" target="_blank" class="text-white"><i class="ti-comments mr-2"></i>{{comments}}</a></li></ul></div></div>'
    });
    userFeed.run();
  }

  // product Slider
  $('.product-slider').slick({
    autoplay: false,
    infinite: true,
    arrows: true,
    prevArrow: '<button type=\'button\' class=\'prevArrow\'><i class=\'ti-arrow-left\'></i></button>',
    nextArrow: '<button type=\'button\' class=\'nextArrow\'><i class=\'ti-arrow-right\'></i></button>',
    dots: true,
    customPaging: function (slider, i) {
      var image = $(slider.$slides[i]).data('image');
      return '<img class="img-fluid" src="' + image + '" alt="product-img">';
    }
  });

  // image zoom
  $('.image-zoom')
    .wrap('<span></span>')
    .css('display', 'block')
    .parent()
    .zoom({
      on: 'click',
      url: $(this).find('img').attr('data-zoom')
    });

  // touchspin
  $('input[name=\'quantity\']').TouchSpin({
      min:1,
    verticalbuttons: true,
    initval: 1,
    verticalupclass: 'angle-up',
    verticaldownclass: 'angle-down'
  });
  $('input[name=\'cart-quantity\']').TouchSpin({
      min:1,
    initval: 40
  });

  // nice select
  $('select').niceSelect();

  // checked
  $('.label').click(function () {
    $(this).find('.size-checkbox').toggleClass('checked');
  });

  // bootstrap slider range
  $('.range-track').slider({})

  // tooltip
  $(function () {
    $('[data-toggle="tooltip"]').tooltip();
  });

  // sticky-menu
  var navbar = $('#navbar');
  var mainWrapper = $('.main-wrapper');
  var sticky = navbar.offset().top;
  $(window).scroll(function () {
    if ($(document).scrollTop() >= sticky) {
      navbar.addClass('sticky');
      mainWrapper.addClass('main-wrapper-section');
    } else {
      navbar.removeClass('sticky');
      mainWrapper.removeClass('main-wrapper-section');
    }
  });




})(jQuery);
