const dropdown = "#dropdown";
const defaultContent = ".default--content";
const optionSelect = ".option--select";

const arrUser = [
  { avatar: "1.png", name: "Vasya" },
  { avatar: "2.png", name: "Tasya" },
  { avatar: "3.png", name: "Nasya" },
  { avatar: "4.png", name: "Asya" },
  { avatar: "5.png", name: "Kasya" },
  { avatar: "6.png", name: "Rasya" },
  { avatar: "7.png", name: "Petya" },
  { avatar: "8.png", name: "Katya" },
  { avatar: "9.png", name: "Sasha" },
  { avatar: "10.png", name: "Kasha" },
  { avatar: "11.png", name: "Vasha" },
  { avatar: "12.png", name: "Lasha" },
  { avatar: "13.png", name: "Tasha" },
  { avatar: "14.png", name: "Gasha" },
  { avatar: "15.png", name: "Hasha" },
  { avatar: "16.png", name: "Fasha" }
];

function dropdownSelect() {
  $("#dropDownSelect")
    .stop()
    .slideToggle("fast");
  $("#imgButton").attr(
    "src",
    `img/icon/${$(dropdown).hasClass("open") ? "low" : "row"}.png`
  );
  $(dropdown).toggleClass("open");
}

function fillDropdownList() {
  const option = `<div id="optionSelect" class="option--select ">`;
  let optionSelect = "";
  arrUser.forEach(function(el) {
    optionSelect += option;
    optionSelect += `<img src="img/avatar/${el.avatar}" class="avatar side--indent" alt="${el.name}" />`;
    optionSelect += `<div class="user--name side--indent">${el.name}</div>`;
    optionSelect += `</div>`;
  });
  document.getElementById("dropDownSelect").innerHTML = optionSelect;
}
fillDropdownList();

$(document).ready(function() {
  $(document).on("click", function(event) {
    const element = $(dropdown);
    const dropDownOpen = $(dropdown).hasClass("open");
    if (
      element.has(event.target).length === 1 ||
      (element.has(event.target).length === 0 && dropDownOpen)
    ) {
      dropdownSelect();
    }
  });

  $(`${optionSelect}>*`).click(function() {
    $(defaultContent).html($(this.parentNode).clone());
  });
  $(optionSelect).click(function() {
    $(defaultContent).html($(this).clone());
  });
});
