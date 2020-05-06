const OFFSET_TOP = 100;
const ANIMATION_TIME = 1000;

$(document).ready(function () {

    upButton();
    menubuttonAnimation();
    smoothTransitionToBlock();

});

function upButton() {
    const btn = $("#buttonTop");
    const show = 'show';

    $(window).scroll(function () {
        if ($(window).scrollTop() > OFFSET_TOP) {
            btn.addClass(show);
        } else {
            btn.removeClass(show);
        }
    });

    btn.on("click", function (e) {
        e.preventDefault();
        $("html").animate({scrollTop: 0}, ANIMATION_TIME);
    });
}

function menubuttonAnimation() {
    const menu = $('#menu');
    const hideItem = 'hide';

    menu.click(function () {
        $('.navigation--block').toggleClass(hideItem);
        $('.hiding--elements').toggleClass(hideItem);

        const element1 = [$('.element1'), 'starting--position', 'rotatable--top'];
        animateAnElement(element1);

        const element4 = [$('.element4'), 'starting--position', 'rotatable--bottom'];
        animateAnElement(element4);
    })
}

function animateAnElement(element) {
    if (element[0].hasClass(element[1])) {
        element[0].removeClass(element[1]).addClass(element[2]);
    } else {
        element[0].removeClass(element[2]).addClass(element[1]);
    }
}

function smoothTransitionToBlock() {
    $('.element--menu').click(function () {
        menu.click();
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
}