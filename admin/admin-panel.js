("use strict");

const dashboardHome = document.querySelector(".dashboard-home");
const examListPage = document.querySelector(".exam-list");
const addExamContainer = document.querySelector(".add-exam-container");
const requiredPage = document.querySelector(".required-page");
const resultPage = document.querySelector(".results-page");
const links = document.querySelectorAll(".list-item");
const logoutBtn = document.querySelector("#logout");
const request = document.getElementById("request-type");
let pages = [
  dashboardHome,
  examListPage,
  addExamContainer,
  resultPage,
  requiredPage,
];

// let testExam = new Exam("testing");

//
// Grabbing all the necessary data from local storage
//
let currentSignin = -1;
if (!!localStorage.getItem("current"));
currentSignin = localStorage.getItem("current");
if (currentSignin === -1 || currentSignin === 0) {
  alert("please login");
  console.log("not logged in");
}

let allExams = [];
if (!!localStorage.getItem("exams")) {
  allExams = JSON.parse(localStorage.getItem("exams"));
}
let allStudents = [];
if (!!localStorage.getItem("students")) {
  allStudents = JSON.parse(localStorage.getItem("students"));
}
let allTeachers = [];
if (!!localStorage.getItem("teachers")) {
  allTeachers = JSON.parse(localStorage.getItem("teachers"));
}

//Selecting the current logged in teacher
let currentTeacher = allTeachers[1];
console.log(allTeachers);
console.log(currentTeacher);
let currentTeacherStudents = allStudents.filter((student) => {
  return currentTeacher.exams.includes(student.examkey);
});
//
//Functions executed at page load
//
window.onload = function () {
  links[0].click();
  console.log("sth");
};
//
//event handlers for all navigation links
//
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
logoutBtn.addEventListener("click", function () {
  localStorage.setItem("current", -1);
});

request.addEventListener("change", (evt) => {
  const type = evt.target.value;
  switch (type) {
    case "D":
      fetch("/teyake/admin/handle-request.php", {
        method: "post",
        body: JSON.stringify({
          displayDep: true,
        }),
      })
        .then((r) => r.json())
        .then((response) => {
          loadRequest(response);
          loadReference("D");
        });
      break;
    case "I":
      fetch("/teyake/admin/handle-request.php", {
        method: "post",
        body: JSON.stringify({
          displayInst: true,
        }),
      })
        .then((r) => r.json())
        .then((response) => {
          loadRequest(response);
          loadReference("I");
        });
      break;
    case "C":
      fetch("/teyake/admin/handle-request.php", {
        method: "post",
        body: JSON.stringify({
          displayCourse: true,
        }),
      })
        .then((r) => r.json())
        .then((response) => {
          loadRequest(response);
          loadReference("C");
        });
      break;
  }
});

function loadRequest(data) {
  const request = document.getElementById("request-table-body");
  if ("status" in data) {
    request.innerHTML = "";
    request.innerHTML = `<tr><td>No Result</td></tr>`;
    return;
  }
  document.querySelectorAll(".request-item").forEach((item) => {
    item.innerHTML = "";
  });
  let display = "";
  data.forEach((str) => {
    display += `<tr class="request-item"><td>${str}</td>
             <td class="table-btn"><button class="table-btn-appr"><svg width="24px" height="24px"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                            aria-labelledby="verifiedIconTitle" stroke="#000000" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round" fill="none" color="#000000">
                            <title id="verifiedIconTitle">Verified</title>
                            <path d="M8 12.5L10.5 15L16 9.5" />
                            <path
                                d="M12 22C13.2363 22 14.2979 21.2522 14.7572 20.1843C14.9195 19.8068 15.4558 19.5847 15.8375 19.7368C16.9175 20.1672 18.1969 19.9453 19.0711 19.0711C19.9452 18.1969 20.1671 16.9175 19.7368 15.8376C19.5847 15.4558 19.8068 14.9195 20.1843 14.7572C21.2522 14.2979 22 13.2363 22 12C22 10.7637 21.2522 9.70214 20.1843 9.24282C19.8068 9.08046 19.5847 8.54419 19.7368 8.16246C20.1672 7.08254 19.9453 5.80311 19.0711 4.92894C18.1969 4.05477 16.9175 3.83286 15.8376 4.26321C15.4558 4.41534 14.9195 4.1932 14.7572 3.8157C14.2979 2.74778 13.2363 2 12 2C10.7637 2 9.70214 2.74777 9.24282 3.81569C9.08046 4.19318 8.54419 4.41531 8.16246 4.26319C7.08254 3.83284 5.80311 4.05474 4.92894 4.92891C4.05477 5.80308 3.83286 7.08251 4.26321 8.16243C4.41534 8.54417 4.1932 9.08046 3.8157 9.24282C2.74778 9.70213 2 10.7637 2 12C2 13.2363 2.74777 14.2979 3.81569 14.7572C4.19318 14.9195 4.41531 15.4558 4.26319 15.8375C3.83284 16.9175 4.05474 18.1969 4.92891 19.0711C5.80308 19.9452 7.08251 20.1671 8.16243 19.7368C8.54416 19.5847 9.08046 19.8068 9.24282 20.1843C9.70213 21.2522 10.7637 22 12 22Z" />
                        </svg></button>
          <button class="table-btn-disappr"><svg width="24px" height="24px" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M12,2 C17.5228475,2 22,6.4771525 22,12 C22,17.5228475 17.5228475,22 12,22 C6.4771525,22 2,17.5228475 2,12 C2,6.4771525 6.4771525,2 12,2 Z M12,4 C7.581722,4 4,7.581722 4,12 C4,16.418278 7.581722,20 12,20 C16.418278,20 20,16.418278 20,12 C20,7.581722 16.418278,4 12,4 Z M7.29325,7.29325 C7.65417308,6.93232692 8.22044527,6.90456361 8.61296051,7.20996006 L8.70725,7.29325 L12.00025,10.58625 L15.29325,7.29325 C15.68425,6.90225 16.31625,6.90225 16.70725,7.29325 C17.0681731,7.65417308 17.0959364,8.22044527 16.7905399,8.61296051 L16.70725,8.70725 L13.41425,12.00025 L16.70725,15.29325 C17.09825,15.68425 17.09825,16.31625 16.70725,16.70725 C16.51225,16.90225 16.25625,17.00025 16.00025,17.00025 C15.7869167,17.00025 15.5735833,16.9321944 15.3955509,16.796662 L15.29325,16.70725 L12.00025,13.41425 L8.70725,16.70725 C8.51225,16.90225 8.25625,17.00025 8.00025,17.00025 C7.74425,17.00025 7.48825,16.90225 7.29325,16.70725 C6.93232692,16.3463269 6.90456361,15.7800547 7.20996006,15.3875395 L7.29325,15.29325 L10.58625,12.00025 L7.29325,8.70725 C6.90225,8.31625 6.90225,7.68425 7.29325,7.29325 Z" />
                        </svg></button>
                </td></tr>`;
  });

  request.innerHTML = display;

  RequestHandle();
}

function RequestHandle() {
  document.querySelectorAll(".table-btn-appr").forEach((item) => {
    console.log(item);
    item.addEventListener("click", (evt) => {
      let ExtractedData =
        document.querySelector(".table-btn-appr").parentElement.parentElement
          .firstChild.innerHTML;

      let Rtype = document.querySelector("#request-type").value;

      fetch("/teyake/admin/handle-request.php", {
        method: "post",
        body: JSON.stringify({
          type: Rtype,
          approve: true,
          data: ExtractedData,
        }),
      })
        .then((r) => r.json())
        .then((response) => {
          document.querySelector(
            ".table-btn-appr"
          ).parentElement.parentElement.innerHTML = "";

          loadReference(Rtype);
        });
    });
  });
  document.querySelectorAll(".table-btn-disappr").forEach((item) => {
    console.log(item);
    item.addEventListener("click", (evt) => {
      let ExtractedData =
        document.querySelector(".table-btn-appr").parentElement.parentElement
          .firstChild.innerHTML;

      let Rtype = document.querySelector("#request-type").value;

      fetch("/teyake/admin/handle-request.php", {
        method: "post",
        body: JSON.stringify({
          type: Rtype,
          drop: true,
          data: ExtractedData,
        }),
      })
        .then((r) => r.json())
        .then((response) => {
          document.querySelector(
            ".table-btn-appr"
          ).parentElement.parentElement.innerHTML = "";
        });
    });
  });
}

RequestHandle();

function loadReference(str) {
  switch (str) {
    case "D":
      fetch("/teyake/admin/handle-reference.php", {
        method: "post",
        body: JSON.stringify({
          displayDep: true,
        }),
      })
        .then((r) => r.json())
        .then((response) => {
          alterReferenceView(response);
        });
      break;
    case "I":
      fetch("/teyake/admin/handle-reference.php", {
        method: "post",
        body: JSON.stringify({
          displayInst: true,
        }),
      })
        .then((r) => r.json())
        .then((response) => {
          alterReferenceView(response);
        });
      break;
    case "C":
      fetch("/teyake/admin/handle-reference.php", {
        method: "post",
        body: JSON.stringify({
          displayCourse: true,
        }),
      })
        .then((r) => r.json())
        .then((response) => {
          alterReferenceView(response);
        });
      break;
  }
}

function alterReferenceView(data) {
  const req = document.getElementById("reference-body");
  document.querySelectorAll("reference-item").forEach((item) => {
    item.innerHTML = "";
  });
  if ("status" in data) {
    req.innerHTML = "";
    req.innerHTML = `<tr><td>No Result</td></tr>`;
    return;
  }
  req.innerHTML = "";
  let display = "";
  data.forEach((str, i) => {
    display += `<tr class="reference-item"><td>${i + 1}</td><td>${
      str[0]
    }</td></tr>`;
  });

  req.innerHTML = display;
}
