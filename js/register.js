let form = document.getElementById('registerForm');
form.addEventListener('submit', function (e) {
    e.preventDefault();


let valid = true;

    const name = document.getElementById("name");
    const nameError = document.getElementById('nameError')


    const email = document.getElementById("email");
    const emailError = document.getElementById('emailError')


    const mobile = document.getElementById("mobile");
    const mobileError = document.getElementById('mobileError')


    const course = document.getElementById("course");
    const courseError = document.getElementById('courseError')

    const password = document.getElementById("password");
    const passwordError = document.getElementById('passwordError')

    const confirm = document.getElementById("confirmPassword");
    const confirmError = document.getElementById('confirmError')

    const image = document.getElementById("image");
    const imageError = document.getElementById('imageError')

    const terms = document.getElementById("terms");
    const termsError = document.getElementById('termsError')


// NAME VALIDATION

const namePattern = /^[A-Za-z ]+$/;

if (name.value.trim() == "") {

    nameError.innerHTML = "Name is required";
    name.parentElement.classList.add("error");
    valid = false;

}
else if (name.value.trim().length < 3) {

    nameError.innerHTML = "Name must be at least 3 characters";
    name.parentElement.classList.add("error");
    valid = false;

}
else if (name.value.trim().length > 30) {

    nameError.innerHTML = "Name must not exceed 30 characters";
    name.parentElement.classList.add("error");
    valid = false;

}
else if (!namePattern.test(name.value.trim())) {

    nameError.innerHTML = "Only letters and spaces are allowed";
    name.parentElement.classList.add("error");
    valid = false;

}
else {

    nameError.innerHTML = "";
    name.parentElement.classList.remove("error");

}


// Email VALIDATION


if(email.value.trim() == ""){

    emailError.innerHTML = "Email is required";
    email.parentElement.classList.add("error")
        valid=false;

}else{
    email.parentElement.classList.remove("error");

}


if(valid){
    alert("Registration Successfull     ")
    window.location.href = "login.html"
}


})