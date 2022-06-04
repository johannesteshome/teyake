("use strict");
import { Exam } from "./shared/core.js";

const dashboardHome = document.querySelector(".dashboard-home");
const examListPage = document.querySelector(".exam-list");
const addExamContainer = document.querySelector(".add-exam-container");
const addExamPage = document.querySelector(".add-exam");
const writeExamPage = document.querySelector(".write-exam");
const resultPage = document.querySelector(".results-page");
const examNameInput = document.querySelector("#add-exam-name");
const questionPrompt = document.querySelector("#question-prompt");
const editQuestionPrompt = document.querySelector("#edit-question-prompt");
const links = document.querySelectorAll(".list-item");
const choiceList = document.querySelector(".choice-container");
const editChoiceList = document.querySelector(".edit-choice-container");
const previewQuestionList = document.querySelector(".preview-question-list");
const previewContainer = document.querySelector(".preview-content");
const editModal = document.querySelector(".edit-modal");
const logoutBtn = document.querySelector("#logout");
const examList = document.getElementById("all-exams");
const examBankSearch = document.getElementById("exam-bank-search");
let pages = [dashboardHome, examListPage, addExamContainer, resultPage];

let allExams = [];
if (!!localStorage.getItem("exams")) {
  allExams = JSON.parse(localStorage.getItem("exams"));
}

let myExam = allExams[0];
let test = new Exam();

test.name = myExam.name;
test.date = myExam.date;
test.duration = 30;
test.key = myExam.key;
test.questions = myExam.questions;
test.status = myExam.status;
test.teacherID = myExam.teacherID;

// console.log(test);

document.getElementById("finalize-btn").addEventListener("click", previewExam);
document.getElementById("finalize-btn").click();
//
//Exam Preview After writing
//
var toBeEdited = 0;
function previewExam() {
  // console.log(test);
  document.querySelector(".preview-exam").classList.remove("hidden");
  previewContainer.classList.toggle("hidden");
  editModal.classList.toggle("hidden");
  previewQuestionList.innerHTML = "";
  if (!!document.querySelector(".exam-title")) {
    document.querySelector(".exam-title").remove();
  }
  let examTitle = document.createElement("h1");
  examTitle.textContent = test.name;
  examTitle.className = "exam-title";
  previewQuestionList.parentElement.insertBefore(
    examTitle,
    previewQuestionList
  );

  test.questions.forEach((question, i) => {
    var qcontainer = document.createElement("div");
    qcontainer.className = "q-container";
    qcontainer.id = `${i}`;
    let prompt = document.createElement("h2");
    prompt.id = "question-prompt";
    // console.log(question[0]);
    prompt.textContent = `${i + 1}.${question[0]}`;
    qcontainer.appendChild(prompt);
    let edit = document.createElement("button");
    edit.classList.add("edit-question", "transition");
    edit.textContent = "Edit Question";
    let del = document.createElement("button");
    del.classList.add("delete-question", "transition");
    del.textContent = "Delete Question";

    let qBtns = document.createElement("div");
    qBtns.classList.add("flex", "flex-end");

    qBtns.appendChild(edit);
    qBtns.appendChild(del);
    qcontainer.appendChild(qBtns);

    let choiceContainer = document.createElement("div");
    choiceContainer.className = "choice-container";

    for (let j = 1; j < question.length - 1 && !!question[j]; j++) {
      let choiceText = document.createElement("p");
      if (j == question[6]) choiceText.classList.add("selected-answer");
      let char = 64;
      choiceText.textContent = `${String.fromCharCode(char + j)}. ${
        question[j]
      }`;
      choiceContainer.appendChild(choiceText);
    }
    edit.addEventListener("click", (evt) => {
      editQuestion(evt);
    });
    del.addEventListener("click", (evt) => {
      delQuestion(evt);
    });
    qcontainer.appendChild(choiceContainer);
    previewQuestionList.appendChild(qcontainer);
  });
}

function delQuestion(evt) {
  let toBeDeleted = Number(evt.target.parentElement.parentElement.id);
  evt.target.parentElement.parentElement.remove();
  test.questions.splice(toBeDeleted, 1);
  previewExam();
}
let totalChoice = 0;
function editQuestion(evt) {
  totalChoice = 0;
  toBeEdited = Number(evt.target.parentElement.parentElement.id);
  console.log(toBeEdited);
  previewContainer.classList.add("hidden");
  editModal.classList.remove("hidden");
  document.querySelector(".edit-choice-list").innerHTML = "";
  editQuestionPrompt.value = test.questions[toBeEdited][0];
  for (
    let j = 1;
    j < test.questions[toBeEdited].length - 1 &&
    !!test.questions[toBeEdited][j];
    j++
  ) {
    totalChoice++;
    let cont = document.createElement("div");
    cont.classList.add(
      "choice-item",
      "flex",
      "items-center",
      "edit-choice-item"
    );

    let btn = document.createElement("input");
    btn.type = "radio";
    btn.className = "select-choice";
    btn.name = "choice";
    if (j == test.questions[toBeEdited][6]) {
      btn.checked = true;
    }

    let inp = document.createElement("input");
    inp.type = "text";
    inp.placeholder = "Enter Choice";
    inp.className = "choice-input";
    inp.id = "edit-choice-input";
    inp.value = test.questions[toBeEdited][j];

    let del = document.createElement("button");
    del.id = "remove-choice";
    del.type = "button";
    del.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="" viewBox="0 0 20 20" fill="currentColor">
    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v   5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"
    />
  </svg>`;
    cont.appendChild(btn);
    cont.appendChild(inp);
    cont.appendChild(del);
    document.querySelector(".edit-choice-list").appendChild(cont);
  }
  document.querySelectorAll("#remove-choice").forEach((btn) => {
    btn.addEventListener("click", () => {
      totalChoice--;
      btn.parentElement.remove();
    });
  });
}

//
//Editing Exams Section
//Adding choice

document
  .querySelector("#add-choice-edit")
  .addEventListener("click", function () {
    let cont = document.createElement("div");
    cont.classList.add(
      "choice-item",
      "flex",
      "items-center",
      "edit-choice-item"
    );

    let btn = document.createElement("input");
    btn.type = "radio";
    btn.className = "select-choice";
    btn.name = "choice";

    let inp = document.createElement("input");
    inp.type = "text";
    inp.placeholder = "Enter Choice";
    inp.className = "choice-input";
    inp.id = "edit-choice-input";

    let del = document.createElement("button");
    del.id = "remove-choice";
    del.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" class="" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"
        />
      </svg>`;

    document.querySelectorAll("#remove-choice").forEach((btn) => {
      btn.addEventListener("click", () => {
        totalChoice--;
        btn.parentElement.remove();
      });
    });
    cont.appendChild(btn);
    cont.appendChild(inp);
    cont.appendChild(del);
    document.querySelector(".edit-choice-list").appendChild(cont);
  });

//
//Saving Edited questions
//
document.querySelector("#done-edit").addEventListener("click", function () {
  // console.log("clicked");
  test.questions[toBeEdited][0] = editQuestionPrompt.value;
  for (let x = 1; x < 6; x++) {
    test.questions[toBeEdited][x] = null;
  }
  for (
    let k = 1;
    k <= document.querySelector(".edit-choice-list").childNodes.length;
    k++
  ) {
    test.questions[toBeEdited][k] =
      document.querySelector(".edit-choice-list").childNodes[
        k - 1
      ].childNodes[1].value;
  }
  document.querySelector(".edit-choice-list").childNodes.forEach((item, i) => {
    if (item.childNodes[0].checked) {
      test.questions[toBeEdited][6] = i + 1;
    }
  });
  previewExam();
});

//Cancelling edit
document.querySelector("#cancel-edit").addEventListener("click", function () {
  previewExam();
});
//
//FINALIZING THE EXAM
//
document.querySelector("#done-preview").addEventListener("click", function () {
  allExams.push(test);
  currentTeacher.exams.push(test.key);
  localStorage.setItem("teachers", JSON.stringify(allTeachers));
  localStorage.setItem("exams", JSON.stringify(allExams));
  document.getElementById("finishedTest").value = JSON.stringify(test);
  test = null;
  window.open("../dashboard.php", "_parent");
  document.newExam.submit();
});
//Close Preview
document
  .querySelector("#cancel-preview")
  .addEventListener("click", function (evt) {
    //   document.querySelector(".preview-exam").classList.remove("hidden");
    // previewContainer.classList.toggle("hidden");
    // editModal.classList.toggle("hidden");
    evt.preventDefault();
    test = null;
    window.open("./dashboard.php", "_parent");
  });
// // Cancel the Written Exam
// document
//   .querySelector("#cancel-exam")
//   .addEventListener("click", function (evt) {
//     evt.preventDefault();
//     window.open("./dashboard.php", "_parent");
//   });
