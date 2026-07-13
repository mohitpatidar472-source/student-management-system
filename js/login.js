document.querySelectorAll(".input").forEach(box => {

    box.addEventListener("click", () => {
        box.querySelector("input").focus();
    });

});



const loginForm = document.getElementById("loginForm");

const email = document.getElementById("email");
const password = document.getElementById("password");

const emailError = document.getElementById("emailError");
const passwordError = document.getElementById("passwordError");

let isSubmitted = false;

//=============================
// Email Validation
//=============================

function validateEmail() {

    const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (email.value.trim() == "") {

        emailError.innerHTML = "Email is required";
        email.parentElement.classList.add('error')
        return false;

    }

    if (!pattern.test(email.value.trim())) {

        emailError.innerHTML = "Enter valid email";
        email.parentElement.classList.add('error')

        return false;

    }

    emailError.innerHTML = "";
    email.parentElement.classList.remove('error');

    return true;
}

//=============================
// Password Validation
//=============================
function validatePassword() {

    if (password.value.trim() == "") {

        passwordError.innerHTML = "Password is required";
        password.parentElement.classList.add("error");
        return false;

    }

    passwordError.innerHTML = "";
    password.parentElement.classList.remove("error");

    return true;
}
//=============================
// Real Time Validation
//=============================

email.addEventListener("input", () => {

    if (isSubmitted) {

        validateEmail();

    }

});

password.addEventListener("input", () => {

    if (isSubmitted) {

        validatePassword();

    }

});

//=============================
// Login Submit
//=============================

loginForm.addEventListener("submit", function (e) {

    e.preventDefault();

    isSubmitted = true;

    let valid = true;

    valid = validateEmail() && valid;
    valid = validatePassword() && valid;

    if (valid) {

        const formData = new FormData(loginForm);

        fetch("php/login.php", {

            method: "POST",
            body: formData

        })
            .then(response => response.text())
            .then(data => {

                data = data.trim();

                if (data === "success") {

                    window.location.href = "dashboard.php";

                }

                else if (data === "Email not found") {

                    emailError.innerHTML = data;
                    email.parentElement.classList.add("error");

                    passwordError.innerHTML = "";
                    password.parentElement.classList.remove("error");

                }

                else if (data === "Wrong password") {

                    passwordError.innerHTML = data;
                    password.parentElement.classList.add("error");

                    emailError.innerHTML = "";
                    email.parentElement.classList.remove("error");

                }

                else {

                    alert(data);

                }

            })

    }

});

//=============================
// Show / Hide Password
//=============================

const eye = document.getElementById("eye");

eye.addEventListener("click", () => {

    if (password.type === "password") {

        password.type = "text";
        eye.classList.replace("fa-eye", "fa-eye-slash");

    } else {

        password.type = "password";
        eye.classList.replace("fa-eye-slash", "fa-eye");

    }

});