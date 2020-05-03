const messageInputField = '#messageInputField';
const messageList = '#messageList';
const smileArr = new Map([
    [':)', 'https://twemoji.maxcdn.com/2/72x72/1f600.png'],
    [':(', 'https://twemoji.maxcdn.com/2/72x72/1f620.png']
]);
const indexColor = [2, 3, 5];
let index = 0;

let listMessage = [];

$(document).ready(function () {
    showGreeting();
    getMessagesFromServer();
    sendMessageToServer();
});

function showGreeting() {
    addMessage(`<div class="box--message header content bg--color--${indexColor[index]}">Welcome to easy chat</div>`)
}

function getMessagesFromServer() {

    let idMessage = listMessage.length === 0 ? -1 : listMessage[listMessage.length - 1].id;
    let data = {
        'messenger': 'getting',
        'data': {
            'id': idMessage
        }
    };

    executeServerRequest(data);
    setTimeout(getMessagesFromServer, 3000);
}

function sendMessage() {
    let data = {
        'messenger': 'sending',
        'data': {
            'message': $(messageInputField).val()
        }
    };
    $(messageInputField).val('');
    executeServerRequest(data);
}

function sendMessageToServer() {
    $('form').submit(function (e) {
        e.preventDefault();
        sendMessage();
    });
    document.onkeypress = function (event) {
        if (event.keyCode === 13 && $(messageInputField).val().length !== 0) {
            sendMessage();
        }
    }
}


function executeServerRequest(data) {

    $.post(PATH_MAIN_CONTROLLER, data, 'json').done(function (json) {
        const res = JSON.parse(json);

        if (data.messenger === 'getting') {
            if (!('count' in res) || (res.count === 0)) {
                return
            }
            showMessage(res.list);
        }
    });
}

function showMessage(messageArray) {
    for (let obj in messageArray) {
        listMessage.push(messageArray[obj]);
        const time = getTime(messageArray[obj].time);
        const userName = `<div class="user--name">${messageArray[obj].name}:</div>`;
        const message = `<div class="message">${getMessage(messageArray[obj].message)}</div>`;

        addMessage(`<div class="box--message bg--color--${indexColor[index]}">${time}${userName}${message}</div>`);
        scrollLastPost();
    }

}

function addMessage(string) {
    $(messageList).append(string);
    index++;
    if (index === 3) {
        index = 0
    }
}

function scrollLastPost() {
    const lastMessage = document.querySelector(messageList);
    lastMessage.scrollTop = lastMessage.scrollHeight;
}

function getMessage(msg) {

    for (let key of smileArr.keys()) {
        msg = msg.replace(key, `<img class="size--smile" src="${smileArr.get(key)}" >`);
    }
    return msg;
}

function getTime(time) {

    const date = new Date(time * 1000);

    const hours = String(date.getHours());
    const minutes = String(date.getMinutes());
    const seconds = String(date.getSeconds());

    let result = '<div class="time">[';
    result += `${hours.padStart(2, '0')}:${minutes.padStart(2, '0')}:${seconds.padStart(2, '0')}`;
    result += ']</div>';
    return result;
}