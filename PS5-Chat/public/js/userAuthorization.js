const arrayKeys = new Map([
    ['name', ['#userName', '#errorUserName']],
    ['pass', ['#userPass', '#errorPass']]
]);

$(document).ready(function () {
    $('form').submit(function (e) {

        e.preventDefault();
        user = $(arrayKeys.get('name')[0]).val();
        const data = {
            'authorization': 'user',
            'user': {
                'name': user,
                'pass': $(arrayKeys.get('pass')[0]).val()
            }
        };

        $.post(PATH_MAIN_CONTROLLER, data).done(function (res) {
            let obj = JSON.parse(res);

            let isErrorInDataForm = false;
            for (let key of arrayKeys.keys()) {
                if (key in obj) {
                    showError(arrayKeys.get(key)[0], arrayKeys.get(key)[1], obj, key)
                    isErrorInDataForm = true;
                } else {
                    hideError(arrayKeys.get(key)[0], arrayKeys.get(key)[1]);
                }
            }
            if (!isErrorInDataForm && 'form' in obj) {
                $(content).html(obj['form']);
            }
        })
    })
});

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
