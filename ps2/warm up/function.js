/**declaration of constants*/
const millisecondsInSecond = 1000;
const secondsInOneHour = 3600;
const secondsInOneMinute = 60;
const minutesInHour = 60;
const hourInDay = 24;
const dayInMonth = 30;
const monthsInYear = 12;

const doc = document;
const conteinerResult = doc.getElementById("formaResult");
const nameTask = doc.getElementById("nameTask");

/*Task 1*/
doc.getElementById("buttonTaskFirst").onclick = function() {
  const firstNumber = doc.getElementById("firstNumber-TaskFirst").value;
  const secondNumber = doc.getElementById("secondNumber-TaskFirst").value;

  conteinerResult.style.visibility = "visible";
  nameTask.textContent = doc.querySelector("#taskFirst h3").innerText;

  const regex = /^(-\d+)|(\d+)$/;

  if (!regex.test(firstNumber) || !regex.test(secondNumber)) {
    showResult("Enter two numbers from -100 to 100!", "");
    return;
  }

  let sum = 0;
  for (
    let number = Math.min(firstNumber, secondNumber);
    number <= Math.max(firstNumber, secondNumber);
    number++
  ) {
    const remainderDivision = Math.abs(number) % 10;
    if (
      remainderDivision === 2 ||
      remainderDivision === 3 ||
      remainderDivision === 7
    ) {
      sum += number;
    }
  }
  showResult(
    `You entered the first number: ${firstNumber} and the second: ${secondNumber}`,
    `The result of the calculation: ${sum}`
  );
};

/*Task 2-1*/
doc.getElementById("buttonFirstTaskSecond").onclick = function() {
  const timeInSeconds = doc.getElementById("firstNumber-TaskSecond").value;

  conteinerResult.style.visibility = "visible";
  nameTask.textContent = doc.querySelector("#taskSecond h3").innerText;

  const regex = /^\d+$/g;
  if (!regex.test(timeInSeconds)) {
    showResult("Enter the number of seconds", "");
    return;
  }
  const hour = getNumberOccurrences(timeInSeconds, secondsInOneHour);
  let minute = getNumberOccurrences(
    timeInSeconds - hour * secondsInOneHour,
    secondsInOneMinute
  );
  const seconds =
    timeInSeconds - hour * secondsInOneHour - minute * secondsInOneMinute;
  const time =
    (hour < 10 ? "0" + hour : hour) +
    ":" +
    (minute < 10 ? "0" + minute : minute) +
    ":" +
    (seconds < 10 ? "0" + seconds : seconds);
  showResult(
    `You entered the ${timeInSeconds} seconds.`,
    `The result of the calculation: ${time}`
  );
};

function getNumberOccurrences(number, multiplicity) {
  let count = 0;
  while (number >= multiplicity) {
    number -= multiplicity;
    count++;
  }
  return count;
}

/*Task 2-2*/
doc.getElementById("buttonSecondTaskSecond").onclick = function() {
  const time = doc.getElementById("secondNumber-TaskSecond").value;
  conteinerResult.style.visibility = "visible";
  nameTask.textContent = doc.querySelector("#taskSecond h3").innerText;

  const regex = /^([01]\d|2[0-3]):[0-5]\d:\d\d$/g;
  if (!regex.test(time)) {
    showResult("Enter the time in the form: hh:mm:ss", "");
    return;
  }

  const hour = Number(time.match(/^[01]\d|2[0-3](?=:)/g)[0]);
  const minute = Number(time.match(/(?<=:)[0-5]\d(?=:)/g)[0]);
  const seconds = Number(time.match(/(?<=:)[0-5]\d$/gm)[0]);
  showResult(
    "You entered " + time + " time.",
    "The result of the calculation: " +
      (hour * secondsInOneHour + minute * secondsInOneMinute + seconds)
  );
};

/*Task 3*/
doc.getElementById("buttonTaskThree").onclick = function() {
  conteinerResult.style.visibility = "visible";
  nameTask.textContent = doc.querySelector("#taskThree h3").innerText;

  const firstDateTime = doc.getElementById("firstNumber-TaskThree").value;
  const secondDateTime = doc.getElementById("secondNumber-TaskThree").value;
  const regex = /^\d{4}-\d{2}-\d{2}T([01]\d|2[0-3]):[0-5]\d$/;

  if (!regex.test(firstDateTime) || !regex.test(secondDateTime)) {
    showResult("The date and time are not correctly entered!", "");
    return;
  }

  let firstDate = new Date(firstDateTime);
  let secondDate = new Date(secondDateTime);
  if (firstDate < secondDate) {
    [firstDate, secondDate] = [secondDate, firstDate];
  }

  const resultDate = [];

  function getDate(first, second, coefficient, index) {
    if (first >= second) {
      return { value: Math.abs(first - second), coeff: coefficient };
    } else {
      if (resultDate[index].value === 0) {
        let i = index;
        do {
          resultDate[i].value += resultDate[i].coeff;
          resultDate[i - 1].value -= 1;
          i--;
        } while (resultDate[i].value <= 0);
      }
      resultDate[index].value -= 1;

      return {
        value: Math.abs(first + coefficient - second),
        coeff: coefficient
      };
    }
  }
  //year
  resultDate.push(
    getDate(firstDate.getFullYear(), secondDate.getFullYear(), 0, -1)
  );
  //month
  resultDate.push(
    getDate(firstDate.getMonth(), secondDate.getMonth(), monthsInYear, 0)
  );
  //days
  resultDate.push(
    getDate(firstDate.getDate(), secondDate.getDate(), dayInMonth, 1)
  );
  //hour
  resultDate.push(
    getDate(firstDate.getHours(), secondDate.getHours(), hourInDay, 2)
  );
  //minute
  resultDate.push(
    getDate(firstDate.getMinutes(), secondDate.getMinutes(), minutesInHour, 3)
  );
  //seconds
  resultDate.push(
    getDate(firstDate.getSeconds(), secondDate.getSeconds(), minutesInHour, 4)
  );
  showResult(
    `You entered the first date: ${firstDateTime}
    and the second date: ${secondDateTime}`,
    `The result of the calculation: 
  ${resultDate[0].value} year(s), ${resultDate[1].value} month(s), ${resultDate[2].value} day(s), ${resultDate[3].value} hour(s), ${resultDate[4].value} minute(s), ${resultDate[5].value} second(s)`
  );
};

/* Task 4 */
doc.getElementById("buttonTaskFour").onclick = function() {
  conteinerResult.style.visibility = "visible";
  nameTask.textContent = doc.querySelector("#taskFour h3").innerText;
  const sizeBoard = doc.getElementById("sizeBoard-TaskFour").value;
  const regex = /^([1-9]\d*)\*([1-9]\d*)$/gm;

  if (!regex.test(sizeBoard)) {
    showResult("Enter the size of the board according to the template.", "");
    return;
  }
  const row = Number(sizeBoard.match(/^([1-9]\d*)(?=\*)/gm)[0]);
  const colum = Number(sizeBoard.match(/(?<=\*)([1-9]\d*)$/gm)[0]);
  const width = doc.documentElement.clientWidth - 100;
  const height = doc.documentElement.clientHeight - 300;
  const sizeCell = Math.min(width / colum, height / row);

  let chessBoard = `<div class="chessBoard">`;
  for (let r = 0; r < row; r++) {
    chessBoard += `<div class="row--board">`;
    for (let c = 0; c < colum; c++) {
      chessBoard += `<div class="${
        (r + c) % 2 == 0 ? "white" : "black"
      }" style="width: ${sizeCell}px; height: ${sizeCell}px;"></div>`;
    }
    chessBoard += `</div>`;
  }
  chessBoard += `</div>`;

  showResult(`Checkerboard Size: ${sizeBoard}`, chessBoard);
};

/* Task 5 */
textAreaTaskFive.addEventListener("blur", () => {
  conteinerResult.style.visibility = "visible";
  nameTask.textContent = doc.querySelector("#taskFive h3").innerText;
  const text = doc.getElementById("textAreaTaskFive").value;
  const regLink = /((?<=http[s]*:\/{2})((w{3})?.[^,]+))|((w{3}).[^,]+)/g;
  const regIp = /(?<=\s|^)((25[0-5]|2[0-4]\d|[01]?\d\d?)\.){3}(25[0-5]|2[0-4]\d|[01]?\d\d?)(?=($|,))/g;
  const regIp6 = /((^|:|(?<=\s))([0-9a-fA-F]{0,4})){1,8}(?=($|,))/g;

  const arrLink = text.match(regLink);
  const arrIp = text.match(regIp);
  const arrIp6 = text.match(regIp6);

  if (arrLink == null && arrIp == null && arrIp6 == null) {
    showResult("No data to select.", "");
    return;
  }

  let list = `<ol class="list">`;
  if (arrLink != null) {
    arrLink.sort().forEach(element => {
      list += `<li><a href="http://${element}">${element}</a></li>`;
    });
  }
  if (arrIp != null) {
    arrIp.sort().forEach(element => {
      list += `<li><a href="http://${element}">${element}</a></li>`;
    });
  }
  if (arrIp6 != null) {
    arrIp6.sort().forEach(element => {
      list += `<li><a href="http://${element}">${element}</a></li>`;
    });
  }
  list += `</ol>`;

  showResult(`List of links and ip addresses:`, list);
});

/* Task 6 */
doc.getElementById("buttonTaskSixth").onclick = function() {
  conteinerResult.style.visibility = "visible";
  nameTask.textContent = doc.querySelector("#taskSixth h3").innerText;

  let text = doc.getElementById("textArea-taskSixth").value;
  const regex = doc.getElementById("input-TaskSixth").value;
  if (text == "") {
    showResult("No data to process.", "");
    return;
  }
  if (regex == "") {
    showResult("No regex", "");
    return;
  }
  const arr = text.match(regex);
  if (!(arr == null)) {
    arr.forEach(element => {
      text = text.replace(
        new RegExp(`(?<!(<mark>))${element}(?!</mark>)`, ""),
        `<mark>${element}</mark>`
      );
    });
  }

    showResult(` `, text);
};

/*Close result*/
doc.getElementById("close").onclick = function() {
  conteinerResult.style.visibility = "hidden";
};

/**Show result */

function showResult(message, result) {
  doc.getElementById("message").innerText = message;

  if (result.length == 0) {
    doc.getElementById("result").innerHTML = "";
    return;
  }
  doc.getElementById("result").innerHTML = result;
}
