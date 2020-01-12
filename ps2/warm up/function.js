/**declaration of constants*/
const millisecondsInSecond = 1000;
const secondsInOneHour = 3600;
const secondsInOneMinute = 60;
const minutesInHour = 60;
const hourInDay = 24;
const dayInMonth = 30.41;
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

  if (!regex.test(firstNumber)) {
    showResult("Enter two numbers from -100 to 100!", "");
    return;
  }

  if (!regex.test(secondNumber)) {
    showResult("Enter two numbers from -100 to 100!", "");
    return;
  }

  let sum = 0;
  for (
    let number = Math.min(firstNumber, secondNumber);
    number <= Math.max(firstNumber, secondNumber);
    number++
  ) {
    if (
      Math.abs(number) % 10 === 2 ||
      Math.abs(number) % 10 === 3 ||
      Math.abs(number) % 10 === 7
    ) {
      sum += number;
    }
  }
  showResult(
    " You entered the first number: " +
      firstNumber +
      " and the second: " +
      secondNumber,
    "The result of the calculation: " + sum
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
  let hour = getNumberOccurrences(timeInSeconds, secondsInOneHour);
  let minute = getNumberOccurrences(
    timeInSeconds - hour * secondsInOneHour,
    secondsInOneMinute
  );
  let seconds =
    timeInSeconds - hour * secondsInOneHour - minute * secondsInOneMinute;
  let time =
    (hour < 10 ? "0" + hour : hour) +
    ":" +
    (minute < 10 ? "0" + minute : minute) +
    ":" +
    (seconds < 10 ? "0" + seconds : seconds);
  showResult(
    "You entered the " + timeInSeconds + " seconds.",
    "The result of the calculation: " + time
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

  let hour = Number(time.match(/^[01]\d|2[0-3](?=:)/g)[0]);
  let minute = Number(time.match(/(?<=:)[0-5]\d(?=:)/g)[0]);
  let seconds = Number(time.match(/(?<=:)[0-5]\d$/gm)[0]);
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
  const regex = /^\d{4}-\d{2}-\d{2}T([01]\d|2[0-3]):[0-5]\d$/gm;

  if (!regex.test(firstDateTime) && !regex.test(secondDateTime)) {
    showResult("The date and time are not correctly entered!", "");
    return;
  }

  let dateDiffInSeconds = Math.abs(
    (new Date(firstDateTime) - new Date(secondDateTime)) / millisecondsInSecond
  );

  console.log(dateDiffInSeconds);
  let secondsInDay = secondsInOneMinute * minutesInHour * hourInDay;
  let secondsInMonth = secondsInDay * dayInMonth;
  let secondsInYear = secondsInMonth * monthsInYear;

  /* year */
  let year =
    dateDiffInSeconds >= secondsInYear
      ? Math.floor(dateDiffInSeconds / secondsInYear)
      : 0;
  dateDiffInSeconds -= year * secondsInYear;

  /* month*/
  let month =
    dateDiffInSeconds >= secondsInMonth
      ? Math.floor(dateDiffInSeconds / secondsInMonth)
      : 0;
  dateDiffInSeconds -= month * secondsInMonth;

  /* days*/
  let days =
    dateDiffInSeconds >= secondsInDay
      ? Math.floor(dateDiffInSeconds / secondsInDay)
      : 0;
  dateDiffInSeconds -= days * secondsInDay;

  /*hour */
  let hour =
    dateDiffInSeconds >= secondsInOneHour
      ? Math.floor(dateDiffInSeconds / secondsInOneHour)
      : 0;
  dateDiffInSeconds -= hour * secondsInOneHour;

  /*minute */
  let minute =
    dateDiffInSeconds >= secondsInOneMinute
      ? Math.floor(dateDiffInSeconds / secondsInOneMinute)
      : 0;

  showResult(
    `You entered the first date: ${firstDateTime}
    and the second date: ${secondDateTime}`,
    `The result of the calculation: 
  ${year} year(s), ${month} month(s), ${days} day(s), ${hour} hour(s), ${minute} minute(s), ${(dateDiffInSeconds -=
      minute * secondsInOneMinute)} second(s)`
  );
};

/* Task 4 */
doc.getElementById("buttonTaskFour").onclick = function() {
  conteinerResult.style.visibility = "visible";
  nameTask.textContent = doc.querySelector("#taskFour h3").innerText;
  const sizeBoard = doc.getElementById("sizeBoard-TaskFour").value;
  const regex = /^([1-9]\d*)\*([1-9]\d*)$/gm;

  if (!regex.test(sizeBoard)) {
    showResult(
      "Enter the size of the board according to the template. " +
        "The date and time are not correctly entered!",
      ""
    );
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
    arrLink.forEach(element => {
      list += `<li><a href="http://${element}">${element}</a></li>`;
    });
  }
  if (arrIp != null) {
    arrIp.forEach(element => {
      list += `<li><a href="http://${element}">${element}</a></li>`;
    });
  }
  if (arrIp6 != null) {
    arrIp6.forEach(element => {
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
  const arr = new Set(
    text.match(new RegExp(regex, "g")).sort(function(a, b) {
      return b - a;
    })
  );

  arr.forEach(element => {
    text = text.replace(
      new RegExp(`(?<!(<mark>))${element}(?!</mark>)`, "g"),
      `<mark>${element}</mark>`
    );
  });
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
