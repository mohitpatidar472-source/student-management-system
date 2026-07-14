



const Registration = document.getElementById("registerForm");

let isSubmitted = false;



const name = document.getElementById("name");
const email = document.getElementById("email");
const mobile = document.getElementById("mobile");
const course = document.getElementById("course");
const password = document.getElementById("password");
const confirmPassword = document.getElementById("confirmPassword");
const city = document.getElementById('city');
const duration = document.getElementById('duration');
const image = document.getElementById("image");
const terms = document.getElementById("terms");

const nameError = document.getElementById("nameError");
const emailError = document.getElementById("emailError");
const mobileError = document.getElementById("mobileError");
const courseError = document.getElementById("courseError");
const passwordError = document.getElementById("passwordError");
const confirmError = document.getElementById("confirmError");
const cityError  = document.getElementById('cityError');
const durationError  = document.getElementById('durationError')
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
// Course Validation
//=============================

function validateCourse() {

    if (course.value.trim() === "") {
        courseError.innerHTML = "Select course!";
        course.parentElement.classList.add("error");
        return false;
    }

    courseError.innerHTML = "";
    course.parentElement.classList.remove("error");
    return true;
}



//=============================
// Password Validation
//=============================

function validatePassword() {
    const passwordPattern = /^[^\s]{5,30}$/;

    if (password.value.trim() === "") {
        passwordError.innerHTML = "Password is required";
        password.parentElement.classList.add("error");
        return false;
    } else if (!passwordPattern.test(password.value)) {
        passwordError.innerHTML = "Password must be 5  characters and cannot contain spaces.";
        password.parentElement.classList.add("error");
        return false;
    }

    passwordError.innerHTML = "";
    password.parentElement.classList.remove("error");
    return true;
}

//=============================
// Password Show Hide Function
//=============================

const showHide = document.getElementById("passwordshow");

showHide.addEventListener("click", function (e) {
    e.preventDefault();
    if (password.type === "password") {
        password.type = "text";
        showHide.classList.remove("fa-eye");
        showHide.classList.add("fa-eye-slash");
    } else {
        password.type = "password";
        showHide.classList.remove("fa-eye-slash");
        showHide.classList.add("fa-eye");
    }

});



//=============================
// Comefirm Password Validation
//=============================

function validateConfirmPassword() {

    if (confirmPassword.value.trim() === "") {

        confirmError.innerHTML = "Confirm Password is required";
        confirmPassword.parentElement.classList.add("error");
        return false;

    }
    else if (password.value.trim() !== confirmPassword.value.trim()) {

        confirmError.innerHTML = "Passwords do not match";
        confirmPassword.parentElement.classList.add("error");
        return false;

    }

    confirmError.innerHTML = "";
    confirmPassword.parentElement.classList.remove("error");
    return true;
}

//=============================
// Confirm Password Show Hide Function
//=============================

const comfirmpasswordshow = document.getElementById('comfirmpasswordshow');
comfirmpasswordshow.addEventListener('click', (e) => {
    e.preventDefault();
    if (confirmPassword.type === "password") {
        confirmPassword.type = "text";
        comfirmpasswordshow.classList.remove("fa-eye");
        comfirmpasswordshow.classList.add("fa-eye-slash");
    } else {
        confirmPassword.type = "password";
        comfirmpasswordshow.classList.remove("fa-eye-slash");
        comfirmpasswordshow.classList.add("fa-eye");
    }


})




//=============================
//  Session Year  Validation
//=============================

function validateDuration(){
    const durationPattern = /^\d{4}\s*-\s*\d{4}$/;
    const value = duration.value.trim();

if(value === ""){
    durationError.textContent = "Academic session is required";
    duration.parentElement.classList.add('error');
    return false;
}else if(!durationPattern.test(value)){
    durationError.textContent = "Format: 2025 - 2028";
    duration.parentElement.classList.add('error');
    return false;
}

durationError.textContent = "";
duration.parentElement.classList.remove("error");
return true;


}



//=============================
//  City  Validation
//=============================
function validateCity() {
    const cityPattern = /^[A-Za-z\s]{2,50}$/;

    if (city.value.trim() === "") {

        cityError.textContent = "Required City Name!";
        city.parentElement.classList.add("error");
        return false;

    } else if (!cityPattern.test(city.value.trim())) {

        cityError.textContent = "Enter valid city name";
        city.parentElement.classList.add("error");
        return false;

    }

    cityError.textContent = "";
    city.parentElement.classList.remove("error");
    return true;
}



//=============================
//  Photo Upload  Validation
//=============================


function validateImage() {

    if (image.files.length === 0) {
        imageError.innerHTML = "Image is required!";
        image.parentElement.classList.add("error");
        return false;
    }

    imageError.innerHTML = "";
    image.parentElement.classList.remove("error");
    return true

}


//=============================
//  trems check  Validation
//=============================


function validateTerms() {

    if (!terms.checked) {

        termsError.innerHTML = "Please accept the Terms & Conditions!";
        terms.classList.add("error");
        return false;

    }

    termsError.innerHTML = "";
    terms.classList.remove("error");
    return true;

}




//=============================
// Real Time Validation
//=============================

name.addEventListener("change", () => {

    if (isSubmitted) {
        validateName();
    }

});


email.addEventListener("change", () => {
    if (isSubmitted) {
        validateEmail();
    }
})


mobile.addEventListener("input", () => {
    if (isSubmitted) {
        validateMobile();
    }
});


course.addEventListener("input", () => {
    if (isSubmitted) {
        validateCourse();
    }
});


password.addEventListener("change", () => {
    if (isSubmitted) {
        validatePassword();
    }
});


confirmPassword.addEventListener("change", () => {

    if (isSubmitted) {
        validateConfirmPassword();
    }
});

city.addEventListener("change", () =>{
    if(isSubmitted){
        validateCity();
    }
})


duration.addEventListener("change", () =>{
    if(isSubmitted){
        validateDuration();
    }
})

image.addEventListener("input", () => {
    if (isSubmitted) {
        validateImage();
    }
});



terms.addEventListener("change", function () {
    if (isSubmitted) {
        validateTerms();
    }
});





//=============================
// Form Submit
//=============================
Registration.addEventListener("submit", function (e) {

    e.preventDefault();

    isSubmitted = true;

    let valid = true;

    valid = validateName() && valid;
    valid = validateEmail() && valid;
    valid = validateMobile() && valid;
    valid = validateCourse() && valid;
    valid = validatePassword() && valid;
    valid = validateConfirmPassword() && valid;
    valid = validateCity() && valid;
    valid = validateDuration() && valid;
    valid = validateImage() && valid;
    valid = validateTerms() && valid;

    if (valid) {

        const formData = new FormData(Registration);

        fetch("php/register.php", {
            method: "POST",
            body: formData
        })
            .then(res => res.text())
            .then(data => {

                if (data.trim() === "success") {
                    alert("Registration Successful");
                    window.location.href = "login.html";
                } else {
                    alert(data);
                }
            });

    }

    });


// const divs = document.querySelectorAll(".input");

// divs.forEach((div) => {
//     const input = div.querySelector("input");

//     div.addEventListener("click", function () {
//         input.focus();
//     });
// });


document.querySelectorAll(".input").forEach(box => {

    const field = box.querySelector("input, select");

    box.addEventListener("click", () => {
        if (field) {
            field.focus();
        }
    });

});