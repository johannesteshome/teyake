let currentTeacher;

const fullName = document.getElementById("name");
const username = document.getElementById("username");
const phoneNo = document.getElementById("phone");
const email = document.getElementById("email");
const instit = document.getElementById("institution");

const save = document.getElementById("save-edit-btn");
const changepassbtn = document.getElementById("changepass-btn");
const passContainer = document.querySelector(".password-changer");

const erorrLabel = document.getElementById("errorMsg");

save.addEventListener("click", () => {
  const phonePattern = new RegExp(
    /^(\+\d{1,3}\s?)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{3,4}$/
  );
  const emailPattern = new RegExp(/\w+@\w+.\w+(\.\w+)?$/);
  const namePattern = new RegExp(/^\w+.[ ]\w+.$/);
  const usernamePattern = new RegExp(/\s/);

  if (!phonePattern.test(phoneNo.value)) {
    erorrLabel.innerText = "Invalid phone Number.";
    phoneNo.focus();
    return;
  }

  if (!emailPattern.test(email.value)) {
    erorrLabel.innerText = "Invalid Email Address.";
    email.focus();
    return;
  }

  if (!namePattern.test(fullName.value)) {
    erorrLabel.innerText = "Invalid Name";
    fullName.focus();
    return;
  }
  if (usernameTaken(username.value)) {
    erorrLabel.innerText =
      "username is Already taken Please choose another one.";
    username.autofocus();
    return;
  }

  if (usernamePattern.test(username.value)) {
    erorrLabel.innerText = "Invalid Username spaces are not allowed.";
    username.autofocus();
    return;
  } else if (username.value.length < 6) {
    erorrLabel.innerText =
      "Invalid Username minimum of 6 characters required for valid username.";
    username.autofocus();
    return;
  } else if (username.value.length > 25) {
    erorrLabel.innerText =
      "Invalid Username maximum of 25 characters required for a valid username.";
    username.autofocus();
    return;
  }

  if (
    phoneNo.value === "" ||
    email.value === "" ||
    instit.value === "" ||
    fullName.value === "" ||
    username.value === ""
  ) {
    erorrLabel.innerText = "please Fill in All the Fields";
    return;
  }

  teacher.name = fullName.value;
  teacher.username = username.value;
  teacher.email = email.value;
  teacher.phone = phoneNo.value.replace(/[^0-9+]/g, "");
  teacher.institution = instit.value;

  localStorage.setItem("teachers", JSON.stringify(allTeachers));
  console.log(allTeachers);

  window.open("../dashboard.php", "_parent");
});

function usernameTaken(uname) {
  if (allTeachers.length == 0) {
    return false;
  }

  for (let i = 0; i < allTeachers.length; i++) {
    if (allTeachers[i] == uname && i != currentTeacher) return true;
  }
  return false;
}

// changepassbtn.addEventListener("click", () => {
//   passContainer.classList.toggle("hidden");
// });

document.getElementById("back-btn").addEventListener("click", () => {
  window.open("./dashboard.php", "_parent");
});

document.getElementById("save-pass").addEventListener("click", () => {
  const pass = document.getElementById("prev-password-input");
  const newpass = document.getElementById("password-input");
  const comfirmPass = document.getElementById("password-input");
  const error = document.getElementById("PasserrorMsg");
  let passwordVerified;
  fetch("/teyake/public/update-password.php", {
    method: "post",
    body: JSON.stringify({
      userID: userID,
      verifyPass: true,
      pass: pass.value,
    }),
  })
    .then((r) => r.json())
    .then((response) => {
      if (!response) {
        error.innerText = "Invalid password";
        return;
      }
    });
  if (newpass.value.length < 6) {
    error.innerText =
      "Invalid password minimum of 6 characters required for valid password.";
    return;
  } else if (newpass.value.length > 25) {
    error.innerText =
      "Invalid password maximum of 25 characters required for a valid username.";
    return;
  }

  if (newpass.value != comfirmPass.value) {
    console.log(password.value, comfirmPass.value);
    error.innerText = "Password Does Not Match.";
    return;
  }

  fetch("/teyake/public/update-password.php", {
    method: "post",
    body: JSON.stringify({
      userID: userID,
      pass: comfirmPass.value,
      updatePass: true,
    }),
  });
  error.innerText = "";
});

let showingCourseOverlay = false;
document.getElementById("add-new-course").addEventListener("click", () => {
  showingCourseOverlay = true;
  document.querySelector(".add-course-window").classList.remove("hidden");
  document.querySelector("html").classList.add("no-overflow");
});
document.querySelector(".course-overlay").addEventListener("click", () => {
  document.querySelector(".add-course-window").classList.add("hidden");
  document.querySelector("html").classList.remove("no-overflow");
});
window.addEventListener("keydown", (evt) => {
  if (evt.key == "Escape" && showingCourseOverlay) {
    document.querySelector(".add-course-window").classList.add("hidden");
    document.querySelector("html").classList.remove("no-overflow");
  }
});

let showingDeptOverlay = false;
document.getElementById("add-new-dep").addEventListener("click", () => {
  showingDeptOverlay = true;
  document.querySelector(".add-dep-window").classList.remove("hidden");
  document.querySelector("html").classList.add("no-overflow");
});
document.querySelector(".dep-overlay").addEventListener("click", () => {
  document.querySelector(".add-dep-window").classList.add("hidden");
  document.querySelector("html").classList.remove("no-overflow");
});
window.addEventListener("keydown", (evt) => {
  if (evt.key == "Escape" && showingDeptOverlay) {
    document.querySelector(".add-dep-window").classList.add("hidden");
    document.querySelector("html").classList.remove("no-overflow");
  }
});

let showingInstOverlay = false;
document.getElementById("add-new-inst").addEventListener("click", () => {
  showingInstOverlay = true;
  document.querySelector(".add-inst-window").classList.remove("hidden");
  document.querySelector("html").classList.add("no-overflow");
});
document.querySelector(".inst-overlay").addEventListener("click", () => {
  document.querySelector(".add-inst-window").classList.add("hidden");
  document.querySelector("html").classList.remove("no-overflow");
});
window.addEventListener("keydown", (evt) => {
  if (evt.key == "Escape" && showingInstOverlay) {
    document.querySelector(".add-inst-window").classList.add("hidden");
    document.querySelector("html").classList.remove("no-overflow");
  }
});

document.getElementById("add-dep").addEventListener("click", () => {
  if (document.getElementById("dep-input").value == "") {
    console.log("err");
    return;
  }

  fetch("/teyake/public/add-dep-course.php", {
    method: "post",
    body: JSON.stringify({
      addDep: true,
      dep: document.getElementById("dep-input").value,
    }),
  })
    // .then((r) => r.json())
    .then((response) => {
      if (response) {
        window.open("./my_profile.php", "_parent");
      }
    });
});
document.getElementById("add-course").addEventListener("click", () => {
  if (document.getElementById("course-input").value == "") {
    console.log("err");
    return;
  }

  fetch("/teyake/public/add-dep-course.php", {
    method: "post",
    body: JSON.stringify({
      addCourse: true,
      course: document.getElementById("course-input").value,
    }),
  })
    // .then((r) => r.json())
    .then((response) => {
      if (response) {
        window.open("./my_profile.php", "_parent");
      }
    });
});
document.getElementById("add-inst").addEventListener("click", () => {
  if (document.getElementById("institution-input").value == "") {
    console.log("err");
    return;
  }

  fetch("/teyake/public/add-dep-course.php", {
    method: "post",
    body: JSON.stringify({
      addInst: true,
      institution: document.getElementById("institution-input").value,
    }),
  })
    // .then((r) => r.json())
    .then((response) => {
      if (response) {
        window.open("./my_profile.php", "_parent");
      }
    });
});
