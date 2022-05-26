import { Student, Teacher, Exam } from "../../shared/core.js";

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

let studKey = "-1";
if (!!localStorage.getItem("studKey")) {
  studKey = localStorage.getItem("studKey");
}

if (studKey == "-1") {
  alert("no key");
  console.log("no key");
}

if (studKey != "-1") {
  document.querySelector("#exam-key").value = studKey;
}
let student = new Student();

enterBtn.addEventListener("click", function (evt) {
  evt.preventDefault();
  let key = inputKey.value;
  let isValid = false;
  const emailPattern = new RegExp(/\w+@\w+.\w+(\.\w+)?$/);
  const namePattern = new RegExp(/^\w+.[ ]\w+.$/);

  if (!emailPattern.test(studEmail.value)) {
    erorrLabel.innerText = "Invalid Email Address.";
    studEmail.focus();
    return;
  }

  if (!namePattern.test(studName.value)) {
    erorrLabel.innerText = "Invalid Full Name";
    studName.focus();
    return;
  }

  if (
    inputKey.value == "" ||
    studName.value == "" ||
    studEmail.value == "" ||
    studID.value == ""
  ) {
    erorrLabel.innerText = "Empty Fields";
    return;
  }
  document.forms[0].submit();
});
