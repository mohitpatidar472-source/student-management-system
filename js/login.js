document.querySelectorAll(".input").forEach(box => {

box.addEventListener("click", () => {
    box.querySelector("input").focus();
});

});

let isSubmitted = true;

const email = document.getElementById("email");
const password = document.getElementById("password");



const emailError = document.getElementById("emailError");
const passwordError = document.getElementById("passwordError");



const validateEmail( () => {
    
})
