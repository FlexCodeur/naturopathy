
(function ($) {
  let contentContact  = $("#contact_header");
  let contentAdress   = $("#address_header");
  let menuBurger      = $(".header__items--mobile");
  let menuMobile      = $(".main-navigation");
  let subMenu         = $('.dropdown_menu');

  if ($(window).width() <= 768) {
    $(".fa-location-dot").on("click", function () {
      contentAdress.slideToggle();
      if (
          contentContact.is(":visible")
          ||
          subMenu.is(":visible")
          ||
          menuMobile.is(":visible")
      ) {
        contentContact.slideUp();
        subMenu.slideUp();
        menuMobile.removeClass("show_menu");
      }
    });
    $(".fa-phone-volume").on("click", function () {
      contentContact.slideToggle();
      if (contentAdress.is(":visible") || subMenu.is(":visible") || menuMobile.is(":visible")){
        contentAdress.slideUp();
        subMenu.slideUp();
        menuMobile.removeClass("show_menu");
      }

    });
  }
  $(".dropdown").on("click", function () {
    subMenu.slideToggle();
    if ($(window).width() <= 768) {
      if (
          contentAdress.is(":visible")
          ||
          contentContact.is(":visible")
          ||
          menuMobile.is(":visible")
      ){
        contentAdress.slideUp();
        contentContact.slideUp();
        menuMobile.removeClass("show_menu");
      }
    }
  });
  menuBurger.on("click", function () {
    menuMobile.toggleClass("show_menu");
    if (
        contentContact.is(":visible")
        ||
        contentAdress.is(":visible")
        ||
        subMenu.is(":visible")
    ) {
      contentContact.slideUp();
      contentAdress.slideUp();
      subMenu.slideUp();
    }
  });
  $(".close_menu_burger").on("click", function () {
    menuMobile.removeClass("show_menu");
  });
  $('.nav__bar--link').each(function () {
    if (this.href === window.location.href) {
      $(this).addClass('current_item_active');
    }
  })

  let topWindow = $('#backToTop');
  $(window).scroll(function() {
    if ($(this).scrollTop() > 400) {
      topWindow.addClass('show');
    }
    else {
      topWindow.removeClass('show');
    }
  });
  topWindow.on('click',function(){
    $('html, body').animate({scrollTop:0}, 'slow');
  });
})(jQuery);

const closeMessage = document.querySelector('.close_message');
const flashContent = document.querySelector('.flash_content');

closeMessage.addEventListener('click', ()=>{
  console.log(flashContent);
  flashContent.classList.add('hide');
})