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

  const regex = /^[-\d]\d+$/gm;
  if (!regex.test(firstNumber) && !regex.test(secondNumber)) {
    doc.getElementById("message").innerText =
      "Enter two numbers from -100 to 100!";
  } else {
    let sum = 0;
    for (let number = firstNumber; number <= secondNumber; number++) {
      if (
        Math.abs(number) % 10 === 2 ||
        Math.abs(number) % 10 === 3 ||
        Math.abs(number) % 10 === 7
      ) {
        sum += number;
      }
    }

    doc.getElementById("message").innerText =
      " You entered the first number: " +
      firstNumber +
      " and the second: " +
      secondNumber;

    doc.getElementById("result").innerText =
      "The result of the calculation: " + sum;
  }
};

/*Task 2-1*/
doc.getElementById("buttonFirstTaskSecond").onclick = function() {
  const timeInSeconds = doc.getElementById("firstNumber-TaskSecond").value;

  conteinerResult.style.visibility = "visible";
  nameTask.textContent = doc.querySelector("#taskSecond h3").innerText;

  const regex = /^\d+$/g;
  if (!regex.test(timeInSeconds)) {
    doc.getElementById("message").innerText = "Enter the number of seconds";
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
  doc.getElementById("message").innerText =
    "You entered the " + timeInSeconds + " seconds.";
  doc.getElementById("result").innerText =
    "The result of the calculation: " + time;
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
    doc.getElementById("message").innerText =
      "Enter the time in the form: hh:mm:ss";
    return;
  }

  let hour = Number(time.match(/^[01]\d|2[0-3](?=:)/g)[0]);
  let minute = Number(time.match(/(?<=:)[0-5]\d(?=:)/g)[0]);
  let seconds = Number(time.match(/(?<=:)[0-5]\d$/gm)[0]);

  doc.getElementById("message").innerText = "You entered " + time + " time.";
  doc.getElementById("result").innerText =
    "The result of the calculation: " +
    (hour * secondsInOneHour + minute * secondsInOneMinute + seconds);
};

/*Task 3*/
doc.getElementById("buttonTaskThree").onclick = function() {
  conteinerResult.style.visibility = "visible";
  nameTask.textContent = doc.querySelector("#taskThree h3").innerText;

  const firstDateTime = doc.getElementById("firstNumber-TaskThree").value;
  const secondDateTime = doc.getElementById("secondNumber-TaskThree").value;
  const regex = /^\d{4}-\d{2}-\d{2}T([01]\d|2[0-3]):[0-5]\d$/gm;

  if (!regex.test(firstDateTime) && !regex.test(secondDateTime)) {
    doc.getElementById("message").innerText =
      "The date and time are not correctly entered!";
    return;
  }

  let dateDiffInSeconds = Math.abs(
    (new Date(firstDateTime) - new Date(secondDateTime)) / millisecondsInSecond
  );

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

  doc.getElementById(
    "message"
  ).innerText = `You entered the first date: ${firstDateTime}
    and the second date: ${secondDateTime}`;

  doc.getElementById("result").innerText = `The result of the calculation: 
  ${year} year(s), ${month} month(s), ${days} day(s), ${hour} hour(s), ${minute} minute(s), ${(dateDiffInSeconds -=
    minute * secondsInOneMinute)} second(s)`;
};

/* Task 4 */
doc.getElementById("buttonTaskFour").onclick = function() {
  conteinerResult.style.visibility = "visible";
  nameTask.textContent = doc.querySelector("#taskFour h3").innerText;
  const sizeBoard = doc.getElementById("sizeBoard-TaskFour").value;
  const regex = /^([1-9]\d*)\*([1-9]\d*)$/gm;

  if (!regex.test(sizeBoard)) {
    doc.getElementById("message").innerText =
      "Enter the size of the board according to the template.The date and time are not correctly entered!";
    return;
  }
  const row = Number(sizeBoard.match(/^([1-9]\d*)(?=\*)/gm)[0]);

  const colum = Number(sizeBoard.match(/(?<=\*)([1-9]\d*)$/gm)[0]);
  const height = doc.documentElement.clientHeight - 200;
  const width = doc.documentElement.clientWidth - 200;
  const sizeCell = height > width ? width / colum : height / row;

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

  doc.getElementById("message").innerText = `Checkerboard Size: ${sizeBoard}`;
  doc.getElementById("result").innerHTML = chessBoard;
};

/* Task 5 */
textAreaTaskFive.addEventListener("blur", () => {
  conteinerResult.style.visibility = "visible";
  nameTask.textContent = doc.querySelector("#taskFive h3").innerText;
  const text = doc.getElementById("textAreaTaskFive").value;
  const regLink = /(?<=http[s]*:\/{2})(w{3})?.+\..+(?=(,|$))/g;
  const regIp = /((25[0-5]|2[0-4]\d|[01]?\d\d?)\.){3}(25[0-5]|2[0-4]\d|[01]?\d\d?)(?=($|,))/gm;

  if (!regLink.test(text) || !regIp.test(text)) {
    doc.getElementById("message").innerText = "No data to select.";
    return;
  }
  const arrLink = text.match(regLink);
  const arrIp = text.match(regIp);
  let list = `<ol class="list">`;
  arrIp.forEach(element => {
    list += `<li><a href="">${element}</a></li>`;
  });
  arrLink.forEach(element => {
    list += `<li><a href="">${element}</a></li>`;
  });

  list += `</ol>`;
  doc.getElementById("message").innerText = `List of links and ip addresses:`;
  doc.getElementById("result").innerHTML = list;
});

/* Task 6 */
doc.getElementById("buttonTaskSixth").onclick = function() {
  conteinerResult.style.visibility = "visible";
  nameTask.textContent = doc.querySelector("#taskSixth h3").innerText;

  let text = doc.getElementById("textArea-taskSixth").value;
  const regex = doc.getElementById("input-TaskSixth").value;
  const arr = new Set(
    text.match(new RegExp(regex, "g")).sort(function(a, b) {
      return b - a;
    })
  );

  arr.forEach(element => {
    console.log(element);
    console.log(text);
    text = text.replace(
      new RegExp(`(?<!(<mark>))${element}(?!</mark>)`, "g"),
      `<mark>${element}</mark>`
    );
  });

  doc.getElementById("message").innerText = ` `;
  doc.getElementById("result").innerHTML = text;
};

/*Close result*/
doc.getElementById("close").onclick = function() {
  conteinerResult.style.visibility = "hidden";
};
