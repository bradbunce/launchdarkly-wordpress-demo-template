function uni_course_openNav() {
  jQuery(".sidenav").addClass('show');
}
function uni_course_closeNav() {
  jQuery(".sidenav").removeClass('show');
}

( function( window, document ) {
  function uni_course_keepFocusInMenu() {
    document.addEventListener( 'keydown', function( e ) {
      const uni_course_nav = document.querySelector( '.sidenav' );

      if ( ! uni_course_nav || ! uni_course_nav.classList.contains( 'show' ) ) {
        return;
      }

      const elements = [...uni_course_nav.querySelectorAll( 'input, a, button' )],
        uni_course_lastEl = elements[ elements.length - 1 ],
        uni_course_firstEl = elements[0],
        uni_course_activeEl = document.activeElement,
        tabKey = e.keyCode === 9,
        shiftKey = e.shiftKey;

      if ( ! shiftKey && tabKey && uni_course_lastEl === uni_course_activeEl ) {
        e.preventDefault();
        uni_course_firstEl.focus();
      }

      if ( shiftKey && tabKey && uni_course_firstEl === uni_course_activeEl ) {
        e.preventDefault();
        uni_course_lastEl.focus();
      }
    } );
  }
  uni_course_keepFocusInMenu();
} )( window, document );

var btn = jQuery('#button');

jQuery(window).scroll(function() {
  if (jQuery(window).scrollTop() > 300) {
    btn.addClass('show');
  } else {
    btn.removeClass('show');
  }
});

jQuery(document).ready(function() {
window.addEventListener('load', (event) => {
    jQuery(".loading").delay(2000).fadeOut("slow");
  });
})

btn.on('click', function(e) {
  e.preventDefault();
  jQuery('html, body').animate({scrollTop:0}, '300');
});

jQuery(document).ready(function() {
  var owl = jQuery('#top-slider .owl-carousel');
    owl.owlCarousel({
      margin: 0,
      nav: false,
      autoplay:true,
      autoplayTimeout:3000,
      autoplayHoverPause:true,
      loop: true,
      dots:false,
      rtl:true,
      navText : ['<i class="fa fa-lg fa-chevron-left" aria-hidden="true"></i>','<i class="fa fa-lg fa-chevron-right" aria-hidden="true"></i>'],
      responsive: {
        0: {
          items: 1
        },
        600: {
          items: 1
        },
        1024: {
          items: 1
      }
    }
  })
})

jQuery(window).scroll(function() {
  var data_sticky = jQuery('.navigation_header').attr('data-sticky');

  if (data_sticky == "true") {
    if (jQuery(this).scrollTop() > 1){
      jQuery('.navigation_header').addClass("stick_header");
    } else {
      jQuery('.navigation_header').removeClass("stick_header");
    }
  }
});
