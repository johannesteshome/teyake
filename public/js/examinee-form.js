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
const errorLabel = document.getElementById("errorMsg");
const inProgressLink = document.getElementById("in-progress-link");
const institutionSelect = document.getElementById("institution");
const sexSelect = document.getElementById("sex");

let studKey = "-1";
if (!!localStorage.getItem("studKey")) {
  studKey = localStorage.getItem("studKey");
}

if (studKey != "-1") {
  document.querySelector("#exam-key").value = studKey;
}

enterBtn.addEventListener("click", function (evt) {
  evt.preventDefault();
  let key = inputKey.value;
  let isValid = false;
  const emailPattern = new RegExp(/\w+@\w+.\w+(\.\w+)?$/);
  const namePattern = new RegExp(/^\w+.[ ]\w+.$/);

  if (!emailPattern.test(studEmail.value)) {
    errorLabel.innerText = "Invalid Email Address.";
    studEmail.focus();
    return;
  }

  if (!namePattern.test(studName.value)) {
    errorLabel.innerText = "Invalid Full Name";
    studName.focus();
    return;
  }

  if (sexSelect.value === "") {
    errorLabel.innerText = "Please select a Gender";
    return;
  }

  if (institutionSelect.value === "") {
    errorLabel.innerText = "Please select an Institution";
    return;
  }

  if (
    inputKey.value == "" ||
    studName.value == "" ||
    studEmail.value == "" ||
    studID.value == ""
  ) {
    errorLabel.innerText = "Empty Fields";
    return;
  }

  fetch("/teyake/public/check-existing-examinee.php", {
    method: "post",
    body: JSON.stringify({ email: studEmail.value, examKey: inputKey.value }),
  })
    .then((r) => r.json())
    .then((response) => {
      if (response) {
        errorLabel.innerText = "You have already taken this exam!";
      } else {
        document.forms[0].submit();
        // console.log(entering);
      }
    });
});
inProgressLink.addEventListener("click", () => {
  document.querySelector(".in-progress-window").classList.remove("hidden");
});

let isShowingOverlay = false;
document.querySelector(".overlay").addEventListener("click", () => {
  isShowingOverlay = true;
  document.querySelector(".in-progress-window").classList.add("hidden");
});
window.addEventListener("keydown", (evt) => {
  if (evt.key == "Escape" && isShowingOverlay) {
    document.querySelector(".in-progress-window").classList.add("hidden");
  }
});
