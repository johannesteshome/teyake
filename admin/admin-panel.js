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
const allExamsItems = document.querySelectorAll(".all-exam-item");
const examBankSearch = document.getElementById("exam-bank-search");
let pages = [dashboardHome, examListPage, addExamContainer, resultPage];

window.onload = function () {
  links[0].click();
  console.log("sth");
};

links.forEach((link, i) => {
  link.addEventListener("click", function () {
    links.forEach((el) => {
      el.classList.remove("active");
    });
    pages.forEach((page) => {
      page.classList.add("hidden");
    });
    pages[i].classList.remove("hidden");
    link.classList.add("active");
  });
});
