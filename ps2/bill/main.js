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
showData(GOODS);

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
  const price = doc.querySelectorAll(".price");
  let sum = 0;
  price.forEach(element => {
    sum += Number(element.textContent);
  });
  doc.querySelector("tfoot>tr").lastElementChild.textContent = `${sum}$`;
}

let checksCategories = true;
doc.getElementById("sortingByCategories").onclick = function() {
  const newArr = GOODS.sort((a, b) => {
    return a.category > b.category ? 1 : -1;
  });
  if (checksCategories) {
    checksCategories = false;
    showData(newArr);
  } else {
    checksCategories = true;
    showData(newArr.reverse());
  }
};

let checksName = true;
doc.getElementById("sortByName").onclick = function() {
  const newArr = GOODS.sort((a, b) => {
    return a.name > b.name ? 1 : -1;
  });
  if (checksName) {
    checksName = false;
    showData(newArr);
  } else {
    checksName = true;
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

doc.getElementById("inputName").oninput = function() {
  doc.getElementById("selectCategory").selectedIndex = 0;
  const enteredName = doc.getElementById("inputName").value;
  showData(filterArr(GOODS, enteredName, "name"));
};

doc.getElementById("selectCategory").onchange = function() {
  doc.getElementById("inputName").value = "";
  const valueCategory = doc.getElementById("selectCategory").value;
  showData(filterArr(GOODS, valueCategory, "category"));
};
