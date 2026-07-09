const form = document.getElementById("registerForm");

const name = document.getElementById("name");
const email = document.getElementById("email");
const mobile = document.getElementById("mobile");
const course = document.getElementById("course");
const password = document.getElementById("password");
const confirmPassword = document.getElementById("confirmPassword");
const image = document.getElementById("image");
const terms = document.getElementById("terms");

const nameError = document.getElementById("nameError");
const emailError = document.getElementById("emailError");
const mobileError = document.getElementById("mobileError");
const courseError = document.getElementById("courseError");
const passwordError = document.getElementById("passwordError");
const confirmError = document.getElementById("confirmError");
const imageError = document.getElementById("imageError");
const termsError = document.getElementById("termsError");


//=============================
// Name Validation
//=============================

function validateName() {

    const namePattern = /^[A-Za-z ]+$/;

    if (name.value.trim() == "") {
        nameError.innerHTML = "Name is required";
        name.parentElement.classList.add("error");
        return false;
    }

    if (name.value.trim().length < 3) {
        nameError.innerHTML = "Minimum 3 characters required";
        name.parentElement.classList.add("error");
        return false;
    }

    if (name.value.trim().length > 30) {
        nameError.innerHTML = "Maximum 30 characters allowed";
        name.parentElement.classList.add("error");
        return false;
    }

    if (!namePattern.test(name.value.trim())) {
        nameError.innerHTML = "Only letters and spaces allowed";
        name.parentElement.classList.add("error");
        return false;
    }

    nameError.innerHTML = "";
    name.parentElement.classList.remove("error");
    return true;

}


//=============================
// Email Validation
//=============================

function validateEmail() {

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (email.value.trim() == "") {
        emailError.innerHTML = "Email is required";
        email.parentElement.classList.add("error");
        return false;
    }

    if (!emailPattern.test(email.value.trim())) {
        emailError.innerHTML = "Enter valid email";
        email.parentElement.classList.add("error");
        return false;
    }

    emailError.innerHTML = "";
    email.parentElement.classList.remove("error");
    return true;

}


function validateMobile() {

    

    const mobilePattern = /^[6-9]\d{9}$/;

    
    if (mobile.value.trim() === "") {

        mobileError.innerHTML = "Mobile Number is required";
        mobile.parentElement.classList.add("error");
        return false;

    } else if (!mobilePattern.test(mobile.value.trim())) {

        mobileError.innerHTML = "Enter a valid 10-digit mobile number";
        mobile.parentElement.classList.add("error");
        return false;

    }
mobileError.innerHTML = "";
    mobile.parentElement.classList.remove("error");
    return true;
}


//=============================
// Real Time Validation
//=============================

name.addEventListener("input", validateName);
email.addEventListener("input", validateEmail);
mobile.addEventListener("input", validateMobile);

//=============================
// Form Submit
//=============================

form.addEventListener("submit", function (e) {

    e.preventDefault();

    let valid = true;

    valid = validateName() && valid;
    valid = validateEmail() && valid;
    valid = validateMobile() && valid;

    if (valid) {

        alert("Registration Successful");

        window.location.href = "login.html";

    }

});


