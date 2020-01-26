$(document).ready(function() {
  const btn = $("#button");
  $(window).scroll(function() {
    if ($(window).scrollTop() > 100) {
      btn.addClass("show");
    } else {
      btn.removeClass("show");
    }
  });

  btn.on("click", function(e) {
    $("html, body").animate({ scrollTop: 0 }, "300");
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
