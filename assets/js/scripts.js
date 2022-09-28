// dropdown icons header

(function ($) {
  let contentContact = $("#contact_header");
  let contentAdress = $("#address_header");
  let menuBurger = $(".header__items--mobile");
  let menuMobile = $(".main-navigation");

  if ($(window).width() <= 768) {
    $(".fa-location-dot").on("click", function () {
      contentAdress.slideToggle();
      if (contentContact.is(":visible")) {
        contentContact.slideUp();
      }
      if (menuMobile.is(":visible")) {
        menuMobile.removeClass("show_menu");
      }
    });
    $(".fa-phone-volume").on("click", function () {
      contentContact.slideToggle();

      if (contentAdress.is(":visible")) {
        contentAdress.slideUp();
      }
      if (menuMobile.is(":visible")) {
        menuMobile.removeClass("show_menu");
      }
    });
  }
  menuBurger.on("click", function () {
    menuMobile.toggleClass("show_menu");
    if (contentContact.is(":visible")) {
      contentContact.slideUp();
    }
    if (contentAdress.is(":visible")) {
      contentAdress.slideUp();
    }
  });
  $(".close_menu_burger").on("click", function () {
    menuMobile.removeClass("show_menu");
  });
})(jQuery);
console.log('coucou');