const API_URL = 'https://picsum.photos/';
const BIG_SIZE = '600/400';
const SMALL_SIZE = '60';

const IMAGES = [
    '?image=1080',
    '?image=1079',
    '?image=1069',
    '?image=1063',
    '?image=1050',
    '?image=1039'
];
const DOC = document;
const SLIDER_PREVIEWS = '.slider-previews';
const CURRENT = 'current';
const SLIDER_CURRENT = '.slider-' + CURRENT;
const CLASS_NAME_IMAGE = 'image';
const SELECTOR_NAME_IMAGE = '.' + CLASS_NAME_IMAGE;
const CLASS_NAME_CURRENT_IMAGE = CURRENT + '--' + CLASS_NAME_IMAGE;
const SELECTOR_CURRENT_IMAGE = '.' + CLASS_NAME_CURRENT_IMAGE;

let currentIndex = 0;

$(DOC).ready(function () {
    displayImageGallery();
    selectedCurrentImage();
    setEventListener();
})

function displayImageGallery() {
    $(IMAGES).each(function (index, img) {
        let tegLi = `<li data-value="${index}"><img src="${API_URL + BIG_SIZE + img}" alt="${img}"></li>`;
        $(SLIDER_PREVIEWS).append(tegLi)
    });
}

function selectedCurrentImage() {
    $(`[data-value="${currentIndex}"]`).addClass(CURRENT);
    $(`[data-value!="${currentIndex}"]`).removeClass(CURRENT);
}

function setEventListener() {
    $(DOC).keydown(function (e) {
        if (e.keyCode === 39) {
            currentIndex++;
            showImage();
        }
        if (e.keyCode === 37) {
            currentIndex--;
            showImage();
        }
    })

    $('li>*').click(function () {
        currentIndex = $(this.parentNode)[0]['attributes']['data-value']['value'];
        showImage();
    })
}

function showImage() {
    $(SELECTOR_CURRENT_IMAGE).finish();
    let arrayLength = IMAGES.length - 1;
    if (currentIndex > arrayLength) {
        currentIndex = 0;
    }
    if (currentIndex < 0) {
        currentIndex = arrayLength;
    }
    let tegImg = `<img class="${CLASS_NAME_IMAGE}" src="https://picsum.photos/600/400/${IMAGES[currentIndex]}" alt="0">`;
    $(tegImg).appendTo(SLIDER_CURRENT);
    $(SELECTOR_CURRENT_IMAGE).fadeOut(
        {
            'complete': () => {
                $(SELECTOR_CURRENT_IMAGE).remove();
                $(SELECTOR_NAME_IMAGE).addClass(CLASS_NAME_CURRENT_IMAGE);
            }
        }
    );
    selectedCurrentImage();
}

