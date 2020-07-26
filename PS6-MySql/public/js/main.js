const topBlock = '.top--block';
const content = '.content';
const FORM_URL = 'form';

$(document).ready(function () {

    /*
    * load the top block
    * */
    request({'formName': 'topBlock'}, topBlock);

    /*
    * load authorization form
    * */
    request({'formName': 'authForm'}, content);
});

function request(data, box) {
    $.post(FORM_URL, data).done(function (res) {
        try {
            $(box).html(JSON.parse(res).form);
        } catch (e) {
        }
    });
}