// =============================
// Focus Input on Container Click
// =============================
document.querySelectorAll(".input").forEach((box) => {
    const field = box.querySelector("input, select");

    if (field) {
        box.addEventListener("click", () => field.focus());
    }
});

// =============================
// Elements
// =============================
const loginForm = document.getElementById("loginForm");

const email = document.getElementById("email");
const password = document.getElementById("password");

const emailError = document.getElementById("emailError");
const passwordError = document.getElementById("passwordError");

let isSubmitted = false;

// =============================
// Clear Errors
// =============================

function clearErrors() {
    emailError.textContent = "";
    passwordError.textContent = "";

    email.parentElement.classList.remove("error");
    password.parentElement.classList.remove("error");
}

// =============================
// Validation
// =============================
function validateEmail() {

    const value = email.value.trim();
    const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!value) {
        emailError.textContent = "Email is required";
        email.parentElement.classList.add("error");
        return false;
    }

    if (!pattern.test(value)) {
        emailError.textContent = "Enter valid email";
        email.parentElement.classList.add("error");
        return false;
    }

    emailError.textContent = "";
    email.parentElement.classList.remove("error");
    return true;
}

function validatePassword() {

    if (!password.value.trim()) {
        passwordError.textContent = "Password is required";
        password.parentElement.classList.add("error");
        return false;
    }

    passwordError.textContent = "";
    password.parentElement.classList.remove("error");
    return true;
}

// =============================
// Real Time Validation
// =============================
email.addEventListener("input", () => {
    if (isSubmitted) validateEmail();
});

password.addEventListener("input", () => {
    if (isSubmitted) validatePassword();
});

// =============================
// Form Submit
// =============================
loginForm.addEventListener("submit", (e) => {

    e.preventDefault();

    isSubmitted = true;

    clearErrors();

    const emailValid = validateEmail();
    const passwordValid = validatePassword();

    if (!emailValid || !passwordValid) {
        return;
    }

    fetch("php/login.php", {
        method: "POST",
        body: new FormData(loginForm)
    })
        .then(response => response.text())
        .then(data => {

            data = data.trim();

            clearErrors();

            switch (data) {

                case "admin":
                    window.location.href = "admin/dashboard.php";
                    break;

                case "student":
                    window.location.href = "php/dashboard.php";
                    break;

                case "Email not found":
                    emailError.textContent = data;
                    email.parentElement.classList.add("error");
                    break;

                case "Wrong password":
                    passwordError.textContent = data;
                    password.parentElement.classList.add("error");
                    break;

                default:
                    console.error("Unexpected Response:", data);
                    passwordError.textContent = data;
            }

        });
           (error => {
            console.error(error);
            passwordError.textContent = "Server error. Please try again.";
        });

});






// =============================
// Show / Hide Password
// =============================
const eye = document.getElementById("eye");

if (eye) {

    eye.addEventListener("click", () => {

        const show = password.type === "password";

        password.type = show ? "text" : "password";

        eye.classList.toggle("fa-eye");
        eye.classList.toggle("fa-eye-slash");

    });

}