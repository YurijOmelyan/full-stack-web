const arrayKeys = new Map([
    ['name', ['#userName', '#errorUserName']],
    ['pass', ['#userPass', '#errorPass']]
]);
const LOGIN_URL = 'authorization';

$(document).ready(function () {
    $('form').submit(function (e) {
        e.preventDefault();
        const data = {
            'user': {
                'name': $(arrayKeys.get('name')[0]).val(),
                'pass': $(arrayKeys.get('pass')[0]).val()
            }
        };
        request(LOGIN_URL, data)
    })
})

function responseProcessing(res) {
    hideErrors();
    if ('error' in res) {
        let isError = true;
        if (res.error instanceof Object) {
            for (let key of arrayKeys.keys()) {

                if (key in res.error) {
                    isError = false;
                    showError(arrayKeys.get(key)[0], arrayKeys.get(key)[1], res.error, key)
                }
            }
        }

        if (isError) {
            $('#other-errors').html(res.error).addClass(redBorder);
        }
    } else if ('nameForm' in res) {
        request(FORM_URL, {'formName': res.nameForm});
    } else if ('form' in res) {
        $('div .logout').css('visibility', 'visible');
        $(content).html(res.form);
    }
}

function request(url, data) {
    $.post(url, data).done(function (res) {
        try {
            responseProcessing(JSON.parse(res));
        } catch (e) {

        }
    });
}

function hideErrors() {
    for (let key of arrayKeys.keys()) {
        hideError(arrayKeys.get(key)[0], arrayKeys.get(key)[1]);
    }
    $('#other-errors').html('').removeClass(redBorder);
}

const redBorder = 'red--border';
const error = 'hide--error';

function showError(element, errorContainer, obj, key) {
    $(element).addClass(redBorder);
    $(errorContainer).removeClass(error);
    $(errorContainer).html(obj[key]);
}

function hideError(element, errorContainer) {
    $(element).removeClass(redBorder);
    $(errorContainer).addClass(error);
}
