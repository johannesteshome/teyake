(function () {
  "use strict";

  function Pagination() {
    let allExams;
    allExams = JSON.parse(document.getElementById("all-exams").textContent);
    let tempQuestions = new Set();
    allExams.forEach((exam) => {
      exam.questions.forEach((question) => {
        tempQuestions.add(question);
      });
    });
    let allQuestions = [...tempQuestions];
    console.log(allQuestions);

    const prevButton = document.getElementById("button_prev");
    const nextButton = document.getElementById("button_next");
    const clickPageNumber = document.querySelectorAll(".clickPageNumber");
    const listingTable = document.getElementById("listingTable");

    let current_page = 1;
    let records_per_page = 2;

    this.init = function () {
      addElements();
      changePage(1);
      pageNumbers();
      selectedPage();
      clickPage();
      addEventListeners();
    };

    let addEventListeners = function () {
      prevButton.addEventListener("click", prevPage);
      nextButton.addEventListener("click", nextPage);
    };

    let addElements = function () {
      //   listingTable.innerHTML = "";
      for (let i = 0; i < allQuestions.length; i++) {
        let count = 0;
        listingTable.innerHTML += `<div class="question-preview">
          <div class="question-tile">
              <input type="checkbox" name="" id="${i}">
              <p class="question-item">${allQuestions[i][0]}</p>
          </div>
          <div class="question-description hidden">
              ${allQuestions[i][++count] == null ? "" : allQuestions[i][count]}
              ${allQuestions[i][++count] == null ? "" : allQuestions[i][count]}
              ${allQuestions[i][++count] == null ? "" : allQuestions[i][count]}
              ${allQuestions[i][++count] == null ? "" : allQuestions[i][count]}
              ${allQuestions[i][++count] == null ? "" : allQuestions[i][count]}
          </div>
      </div>`;
      }
    };

    let selectedPage = function () {
      let page_number = document
        .getElementById("page_number")
        .getElementsByClassName("clickPageNumber");
      for (let i = 0; i < page_number.length; i++) {
        if (i == current_page - 1) {
          page_number[i].style.opacity = "1.0";
        } else {
          page_number[i].style.opacity = "0.5";
        }
      }
    };

    let checkButtonOpacity = function () {
      current_page == 1
        ? prevButton.classList.add("opacity")
        : prevButton.classList.remove("opacity");
      current_page == numPages()
        ? nextButton.classList.add("opacity")
        : nextButton.classList.remove("opacity");
    };

    let changePage = function (page) {
      if (page < 1) {
        page = 1;
      }
      if (page > numPages() - 1) {
        page = numPages();
      }
      listingTable.childNodes.forEach((child, i) => {
        if (i == 0) {
          return;
        }
        if (!child.classList.contains("hidden")) {
          child.classList.add("hidden");
        }
      });
      // listingTable.childNodes[0].classList.add("test");

      for (
        var i = (page - 1) * records_per_page;
        i < page * records_per_page && i < allQuestions.length;
        i++
      ) {
        listingTable.childNodes[i + 1].classList.remove("hidden");
      }

      checkButtonOpacity();
      selectedPage();
    };

    let prevPage = function () {
      if (current_page > 1) {
        current_page--;
        changePage(current_page);
      }
    };

    let nextPage = function () {
      if (current_page < numPages()) {
        current_page++;
        changePage(current_page);
      }
    };

    let clickPage = function () {
      document.addEventListener("click", function (e) {
        if (
          e.target.nodeName == "SPAN" &&
          e.target.classList.contains("clickPageNumber")
        ) {
          current_page = e.target.textContent;
          changePage(current_page);
        }
      });
    };

    let pageNumbers = function () {
      let pageNumber = document.getElementById("page_number");
      pageNumber.innerHTML = "";

      for (let i = 1; i < numPages() + 1; i++) {
        pageNumber.innerHTML +=
          "<span class='clickPageNumber'>" + i + "</span>";
      }
    };

    let numPages = function () {
      return Math.ceil(allQuestions.length / records_per_page);
    };
  }
  let pagination = new Pagination();
  pagination.init();
})();

const questionItems = document.querySelectorAll(".question-item");

questionItems.forEach((item) => {
  item.addEventListener("click", (e) => {
    showDescription(e);
  });
});

function showDescription(e) {
  e.target.parentNode.nextElementSibling.classList.toggle("hidden");
}
