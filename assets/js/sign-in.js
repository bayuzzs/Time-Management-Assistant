const logIn = document.querySelector("section#register span.login");
const signUp = document.querySelector("section#login span.signup");
const sectionSignup = document.getElementById("register");
const sectionLogin = document.getElementById("login");
const illustration = document.getElementById("illustration");
logIn.addEventListener("click", function () {
    sectionSignup.classList.add("hide", "scale-down");
    sectionLogin.classList.remove("hide", "scale-down");

    illustration.classList.remove("swipe");
});
signUp.addEventListener("click", function () {
    sectionSignup.classList.remove("hide", "scale-down");
    sectionLogin.classList.add("hide", "scale-down");

    illustration.classList.add("swipe");
});
