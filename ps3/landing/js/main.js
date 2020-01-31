const OFFSET_TOP = 100;
const ANIMATION_TIME = 300;

$(document).ready(function() {
  const btn = $("#button");
  $(window).scroll(function() {
    if ($(window).scrollTop() > OFFSET_TOP) {
      btn.addClass("show");
    } else {
      btn.removeClass("show");
    }
  });

  btn.on("click", function(e) {
    $("html").animate({ scrollTop: 0 }, ANIMATION_TIME);
  });

  $("#menu").on("click", ".menu__button", function(event) {
    event.preventDefault();
    const id = $(this).attr("href");
    const top = $(id).offset().top;
    const heightElement = $(id).outerHeight();
    const clientHeight = document.documentElement.clientHeight;
    $("body,html").animate(
      {
        scrollTop: top - clientHeight / 2 + heightElement / 2
      },
      1500
    );
  });
});
