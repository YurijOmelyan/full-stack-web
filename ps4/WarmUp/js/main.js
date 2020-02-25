const doc = document;
const widthPerent = doc.getElementById("chessBoard").offsetWidth;
console.log(widthPerent);
const sizeBox =
  widthPerent /
  doc.querySelector('input[name = "firstNumberTaskFourth"]').value;
const nodeList = doc.querySelectorAll(".cells");
nodeList.forEach(element => {
  element.style.height = `${sizeBox}px`;
});
