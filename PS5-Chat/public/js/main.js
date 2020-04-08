let user = '';
const PATH_MAIN_CONTROLLER = 'mainController.php';
const topBlock = '.top--block';
const content = '.content';

$(document).ready(function () {

    /*
    * load the top block
    * */
    request({'form': 'topBlock'}, topBlock);

    /*
    * load authorization form
    * */
    request({'form': 'authForm'}, content);
});

function request(data, box) {
    $.post(PATH_MAIN_CONTROLLER, data).done(function (res) {
        $(box).html(res);
    });
}