// preloader
jQuery(window).on('load', function() {
  jQuery('#status').fadeOut();
  jQuery('#preloader').delay(350).fadeOut('slow');
  jQuery('body').delay(350).css({'overflow':'visible'});
})

// toggle button
jQuery(function($){
  $( '.toggle-nav button' ).click( function(e){
    $( 'body' ).toggleClass( 'show-main-menu' );
    var element = $( '.sidenav' );
    affiliate_store_trapFocus( element );
  });

  $( '.close-button' ).click( function(e){
    $( '.toggle-nav button' ).click();
    $( '.toggle-nav button' ).focus();
  });
  $( document ).on( 'keyup',function(evt) {
    if ( $( 'body' ).hasClass( 'show-main-menu' ) && evt.keyCode == 27 ) {
      $( '.toggle-nav button' ).click();
      $( '.toggle-nav button' ).focus();
    }
  });
});

function affiliate_store_trapFocus( element, namespace ) {
  var affiliate_store_focusableEls = element.find( 'a, button' );
  var affiliate_store_firstFocusableEl = affiliate_store_focusableEls[0];
  var affiliate_store_lastFocusableEl = affiliate_store_focusableEls[affiliate_store_focusableEls.length - 1];
  var KEYCODE_TAB = 9;

  element.keydown( function(e) {
    var isTabPressed = ( e.key === 'Tab' || e.keyCode === KEYCODE_TAB );

    if ( !isTabPressed ) {
      return;
    }

    if ( e.shiftKey ) /* shift + tab */ {
      if ( document.activeElement === affiliate_store_firstFocusableEl ) {
        affiliate_store_lastFocusableEl.focus();
        e.preventDefault();
      }
    } else /* tab */ {
      if ( document.activeElement === affiliate_store_lastFocusableEl ) {
        affiliate_store_firstFocusableEl.focus();
        e.preventDefault();
      }
    }
  });
}

// scroll to top
jQuery(document).ready(function () {
  jQuery(window).scroll(function () {
    if (jQuery(this).scrollTop() > 0) {
      jQuery('#button').fadeIn();
    } else {
      jQuery('#button').fadeOut();
    }
  });
  jQuery('#button').click(function () {
    jQuery("html, body").animate({
      scrollTop: 0
    }, 600);
    return false;
  });
});

// Slider
jQuery(document).ready(function() {
  jQuery('.slider-cat .owl-carousel').owlCarousel({
    loop: true,
    margin: 0,
    nav: false,
    dots: true,
    rtl: false,
    items: 1,
    autoplay: true,
  });
});

// Category Slider
jQuery(document).ready(function() {
  jQuery('.product-cat .owl-carousel').owlCarousel({
    loop: true,
    margin: 20,
    nav:true,
    navText: ["<i class='fa-solid fa-arrow-left-long'></i>", "<i class='fa-solid fa-arrow-right-long'></i>"], 
    dots:false,
    rtl:false,
    responsive: {
      0: {
        items: 1
      },
      768: {
        items: 2
      },
      1000: {
        items: 3
      },
      1200: {
        items: 7
      }
    },
    autoplay:true,
  });
});

// Trending products
jQuery(document).ready(function() {
  jQuery('#trending-section .owl-carousel').owlCarousel({
    loop: true,
    margin: 20,
    nav:true,
    navText: ["<i class='fa-solid fa-arrow-left-long'></i>", "<i class='fa-solid fa-arrow-right-long'></i>"], 
    dots:false,
    rtl:false,
    responsive: {
      0: {
        items: 1
      },
      768: {
        items: 2
      },
      1000: {
        items: 3
      },
      1200: {
        items: 5
      }
    },
    autoplay:true,
  });
});

// product cat
jQuery(document).ready(function(){
  jQuery(".product-categories").hide();
  jQuery("button.product-btn").click(function(){
    jQuery(".product-categories").toggle();
  });
  jQuery(document).click(function(event) {
    if (!jQuery(event.target).closest('.product-categories, .product-btn').length) {
      jQuery(".product-categories").hide();
    }
  });
});

// Affiliate Product
jQuery(document).ready(function($) {
  $('.single_add_to_cart_button').click(function(e) {
    e.preventDefault();
    var formAction = $(this).closest('form').attr('action');
    window.open(formAction, '_blank');
  });
});
