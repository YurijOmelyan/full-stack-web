const doc = document;
const widthPerent = doc.getElementById("chessBoard").offsetWidth;
const sizeBox =
    widthPerent /
    doc.querySelector('input[name = "firstNumberTaskFourth"]').value;
const nodeList = doc.querySelectorAll(".cells");

nodeList.forEach(element => {
    element.style.height = `${sizeBox}px`;
});
