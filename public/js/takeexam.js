import { Student, Exam, Teacher } from "../../shared/core.js";

const inputKey = document.querySelector("#exam-key");
const enterBtn = document.querySelector("#enter-exam");
const examContainer = document.querySelector(".exam-container");
const studName = document.querySelector("#student-name");
const studEmail = document.querySelector("#student-email");
const studID = document.querySelector("#student-id");
const modal = document.querySelector(".modal");
const resultStudName = document.querySelector("#result-student-name");
const resultExamName = document.querySelector("#result-exam-name");
const score = document.querySelector("#score");
const resultMax = document.querySelector("#result-max");
const finishExam = document.querySelector("#finish-exam");
const warningModal = document.querySelector("#warning-modal");
const remainingSeconds = document.querySelector("#remainingSeconds");
const erorrLabel = document.getElementById("errorMsg");
const startExam = document.getElementById("startExam");
const overlay = document.querySelector(".overlay");
const pageContainer = document.querySelector(".container");
let ansContainer;
let inProgressExamID = null;

let leaveExamWarningTimeout = null;
let warningTimerInterval = null;
let warningSeconds = 11;

let student = new Student();
let currentExam;

// window.onload = function () {
//   reloadP();
//   var reloading = sessionStorage.getItem("reloading");
//   if (reloading) {
//     sessionStorage.removeItem("reloading");
//     window.open("/teyake/public/examinee-form.php", "_parent");
//   }
// };

// function reloadP() {
//   sessionStorage.setItem("reloading", "true");
//   document.location.reload();
// }

currentExam = JSON.parse(document.getElementById("current-exam").textContent);
let countdown;
if (remaining) {
  countdown = Math.floor(remaining / 1000);
} else {
  countdown = currentExam.duration * 60;
}
console.log(countdown);

function startTimer(duration, display) {
  var timer = duration,
    minutes,
    seconds;
  const countdown = setInterval(function () {
    minutes = parseInt(timer / 60, 10);
    seconds = parseInt(timer % 60, 10);

    minutes = minutes < 10 ? "0" + minutes : minutes;
    seconds = seconds < 10 ? "0" + seconds : seconds;

    display.textContent = minutes + ":" + seconds;

    if (--timer < 0) {
      clearInterval(countdown);
      document.querySelector("#submit-exam").click();
    }
  }, 1000);
}

function fullScreen() {
  document.documentElement.requestFullscreen();
  pageContainer.classList.remove("blur");
  overlay.classList.add("hidden");
}
startExam.addEventListener("click", (evt) => {
  fetch("/teyake/public/exam-progress.php", {
    method: "post",
    body: JSON.stringify({ ...userData, addEntry: true }),
  })
    .then((r) => r.json())
    .then((response) => {
      console.log(response);
      inProgressExamID = response.id;

      // console.log(JSON.stringify(allExams[0]));

      document.querySelector("#submit-exam").classList.remove("hidden");
      document.querySelector("main").classList.remove("hidden");
      showExam();
      fullScreen();
      startTimer(countdown, document.querySelector(".countdown"));
      if (answers) {
        ansContainer = document.querySelectorAll(".q-container");
        let ans = JSON.parse(answers);
        console.log(ans);
        ans.forEach((answer, i) => {
          if (answer == null) return;
          console.log(i);
          console.log(ansContainer[i]);
          ansContainer[i].childNodes[answer].childNodes[0].checked = true;
          // console.log(ansContainer[i]);
        });
        // }
      }
    });
});

// enterBtn.addEventListener("click", function (evt) {
//   evt.preventDefault();
//   let key = inputKey.value;

//   const emailPattern = new RegExp(/\w+@\w+.\w+(\.\w+)?$/);
//   const namePattern = new RegExp(/^\w+.[ ]\w+.$/);

//   if (!emailPattern.test(studEmail.value)) {
//     erorrLabel.innerText = "Invalid Email Address.";
//     studEmail.focus();
//     return;
//   }

//   if (!namePattern.test(studName.value)) {
//     erorrLabel.innerText = "Invalid Full Name";
//     studName.focus();
//     return;
//   }

//   if (
//     inputKey.value == "" ||
//     studName.value == "" ||
//     studEmail.value == "" ||
//     studID.value == ""
//   ) {
//     erorrLabel.innerText = "Empty Fields";
//     return;
//   }
//   // console.log(key);
//   // allExams.forEach((exam) => {
//   //   if (key === String(exam.key)) {
//   //   }
//   // });
//   // console.log(currentExam);
//   if (!currentExam) {
//     alert("Exam does not exist");
//   } else {
//     modal.classList.add("hidden");
//     document.querySelector("#submit-exam").classList.remove("hidden");
//     document.querySelector("main").classList.remove("hidden");
//     student.email = studEmail.value;
//     student.id = studID.value;
//     student.examkey = key;
//     student.name = studName.value;
//     student.answers = new Array(currentExam.questions.length).fill(0);
//     student.marked = new Array(currentExam.questions.length).fill(0);
//     showExam();
//     // document.documentElement.requestFullscreen();
//     // document.forms[0].submit();
//   }
// });

// document.querySelector("#back-to-exam").addEventListener("click", function () {
//   document.documentElement.requestFullscreen();
// });

// document.querySelector("#exit-exam").addEventListener("click", exitExam);

// function exitExam() {
//   hideModal();
//   console.log("exitting Exam");
//   document.querySelector("#submit-exam").click();
//   clearTimers();
// }

function hideModal() {
  warningModal.classList.add("hidden");
}

function showModal() {
  warningModal.classList.remove("hidden");
}

function clearTimers() {
  if (leaveExamWarningTimeout) {
    clearTimeout(leaveExamWarningTimeout);
  }
  if (warningTimerInterval) {
    clearInterval(warningTimerInterval);
  }
}

function showExam() {
  document.addEventListener("fullscreenchange", (event) => {
    if (document.fullscreenElement) {
      clearTimers();
      warningSeconds = 11;
      hideModal();
    } else {
      console.log("not full screen");
      remainingSeconds.textContent = 10;
      showModal();
      leaveExamWarningTimeout = setTimeout(() => {
        exitExam();
      }, warningSeconds * 1000);
      warningTimerInterval = setInterval(() => {
        warningSeconds--;
        remainingSeconds.textContent = warningSeconds;
      }, 1000);
    }
  });

  let examTitle = document.createElement("h1");
  examTitle.textContent = currentExam.name;
  examTitle.className = "exam-title";
  examContainer.appendChild(examTitle);

  currentExam.questions.forEach((question, i) => {
    var qcontainer = document.createElement("div");
    qcontainer.className = "q-container";
    let prompt = document.createElement("h2");
    prompt.id = "question-prompt";
    prompt.textContent = `${i + 1}.${question[0]}`;
    qcontainer.appendChild(prompt);

    for (let j = 1; j < question.length - 1 && question[j] != null; j++) {
      var choiceContainer = document.createElement("div");
      choiceContainer.className = "choice-container";
      let choice = document.createElement("input");
      choice.type = "radio";
      choice.name = `c${i}`;
      choice.id = `c${i}${j}`;
      let choiceText = document.createElement("p");
      let char = 64;
      choiceText.textContent = `${String.fromCharCode(char + j)}. ${
        question[j]
      }`;

      choice.addEventListener("input", function (evt) {
        const answers = [];

        let ansContainer = document.querySelectorAll(".q-container");
        ansContainer.forEach((question, i) => {
          question.childNodes.forEach((choice, j) => {
            if (choice.childNodes[0].checked) {
              answers[i] = j;
            }
          });
        });

        fetch("/teyake/public/exam-progress.php", {
          method: "post",
          body: JSON.stringify({
            examId: inProgressExamID,
            answers,
            trackProgress: true,
          }),
        });
      });

      choiceContainer.appendChild(choice);
      choiceContainer.appendChild(choiceText);
      // console.log(choiceContainer);
      qcontainer.appendChild(choiceContainer);
    }

    qcontainer.appendChild(choiceContainer);
    examContainer.appendChild(qcontainer);
  });
  console.log(student);
}

document
  .querySelector("#submit-exam")
  .addEventListener("click", function (evt) {
    evt.preventDefault();
    ansContainer = document.querySelectorAll(".q-container");
    ansContainer.forEach((question, i) => {
      question.childNodes.forEach((choice, j) => {
        if (choice.childNodes[0].checked) {
          student.answers[i] = j;
        }
      });
    });

    // fetch("/teyake/public/remove-progress.php", {
    //   method: "post",
    //   body: JSON.stringify({
    //     removeProgress: true,
    //     email: userData["email"],
    //     key: userData["key"],
    //   }),
    // })
    //   .then((r) => r.json())
    //   .then((response) => {});
    let currExaminee = 0;
    if (document.getElementById("current-examinee").textContent == 0) {
    }
    const ExamAnswer = [
      student.answers,
      currentExam.key,
      document.getElementById("current-examinee").textContent,
      userData["email"],
    ];
    console.log(ExamAnswer);
    document.getElementById("examineeAnswers").value =
      JSON.stringify(ExamAnswer);
    document.forms[0].submit();
    // showResult();
    // student = null;
  });
// function showResult() {
//   document.querySelector(".result").classList.remove("hidden");
//   resultStudName.textContent = student.name;
//   resultExamName.textContent = currentExam.name;
//   resultMax.textContent = student.marked.length;
//   score.textContent = student.marked.reduce((prev, next) => prev + next);
// }

`{"name":"The New Test","questions":[["What is one of the big differences between traditional media and social media?","participatory production","social media reaches only a few people at a time","the management structure of the companies","traditional media offers no way for audiences to communicate with media producers",null,2],["Which of the following is NOT a fundamental area of change regarding people's media habits?","conversation","collaboration","choice","communication","curation",3],["An important lesson learned in online political campaigns in recent years and other collaborative efforts that had online components is...","people much prefer to do their own thing and not work in groups","there is always a couple people who disrupt the work of others in the group","people need to be able to meet face to face at times as well as online","social media has still not lived up to its promise of helping people collaborate",null,4],["A portable chunk of code that can be embedded in Web pages to give extra functionality is known as a","folksonomy","widget","curator","wiki",null,2],["Creating a website or group that looks like it originated from concerned grassroots efforts of citizens is known as","lurking","trolling","phishing","astroturfing","puppeting",3],["A website that lets anyone add, edit, or delete pages of content is called a forum","True","False",null,null,null,1]],"key":903,"teacherID":1,"date":"2/8/2022","status":"open"}`;
