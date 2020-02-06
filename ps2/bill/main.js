const GOODS = [
  {
    category: "furniture",
    name: "Chair",
    amount: 1,
    price: 20
  },
  {
    category: "supplies",
    name: "Gel Pen",
    amount: 20,
    price: 2
  },
  {
    category: "other",
    name: "Trash Bin",
    amount: 1,
    price: 5
  },
  {
    category: "furniture",
    name: "Sofa",
    amount: 1,
    price: 50
  },
  {
    category: "supplies",
    name: "Notebook",
    amount: 3,
    price: 3
  },
  {
    category: "other",
    name: "Calendar 2019",
    amount: 1,
    price: 3
  }
];

const doc = document;
let filteredArray = GOODS;
const hideBlock = "hide--block";
const block = "block";
const selectCategory = "selectCategory";
const inputName = "inputName";

showData(filteredArray);

function showData(arr) {
  let dataTable = "";

  arr.forEach(obj => {
    dataTable += "<tr>";
    for (let element in obj) {
      dataTable += `<td class="${element}">${obj[element]}</td>`;
    }
    dataTable += "</tr>";
  });
  doc.querySelector("tbody").innerHTML = dataTable;
  getOrderValue();
}

function getOrderValue() {
  const price = doc.querySelectorAll("tbody>tr");
  let sum = 0;
  price.forEach(node => {
    sum +=
      Number(node.querySelector(".amount").textContent) *
      Number(node.querySelector(".price").textContent);
  });
  doc.querySelector("tfoot>tr").lastElementChild.textContent = `${sum}$`;
}

let checksCategories = true;
doc.getElementById("sortingByCategories").onclick = function() {
  const newArr = filteredArray.sort((a, b) => {
    return a.category > b.category ? 1 : -1;
  });
  nameMin.className = hideBlock;
  nameMax.className = hideBlock;
  if (checksCategories) {
    checksCategories = false;
    categoryMin.className = hideBlock;
    categoryMax.className = "";
    showData(newArr);
  } else {
    checksCategories = true;
    categoryMin.className = "";
    categoryMax.className = hideBlock;
    showData(newArr.reverse());
  }
};

let checksName = true;
doc.getElementById("sortByName").onclick = function() {
  const newArr = filteredArray.sort((a, b) => {
    return a.name > b.name ? 1 : -1;
  });
  categoryMin.className = hideBlock;
  categoryMax.className = hideBlock;
  if (checksName) {
    checksName = false;
    nameMin.className = hideBlock;
    nameMax.className = "";
    showData(newArr);
  } else {
    checksName = true;
    nameMin.className = "";
    nameMax.className = hideBlock;
    showData(newArr.reverse());
  }
};

function filterArr(obj, value, property) {
  return obj.filter(function(el) {
    if (property == "name") {
      return el.name.toLowerCase().indexOf(value.toLowerCase()) > -1;
    } else if (property == "category") {
      return el.category.toLowerCase().indexOf(value.toLowerCase()) > -1;
    }
  });
}

doc.getElementById(inputName).oninput = function() {
  const enteredName = doc.getElementById(inputName).value;
  const valueCategory = doc.getElementById(selectCategory).value;

  filteredArray = filterArr(
    valueCategory.length > 0
      ? filterArr(GOODS, valueCategory, "category")
      : GOODS,
    enteredName,
    "name"
  );

  showData(filteredArray);
  showBloks();
};

doc.getElementById(selectCategory).onchange = function() {
  const valueCategory = doc.getElementById(selectCategory).value;
  const enteredName = doc.getElementById(inputName).value;

  filteredArray = filterArr(
    enteredName.length > 0 ? filterArr(GOODS, enteredName, "name") : GOODS,
    valueCategory,
    "category"
  );

  showData(filteredArray);
  showBloks();
};

function showBloks() {
  categoryMin.className = block;
  categoryMax.className = block;
  nameMin.className = block;
  nameMax.className = block;
}
