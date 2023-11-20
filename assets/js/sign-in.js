const logIn = document.querySelector('section#register span.login');
const signUp = document.querySelector('section#login span.signup');
const sectionSignup = document.getElementById('register');
const sectionLogin = document.getElementById('login');
const illustration = document.getElementById('illustration');

logIn.addEventListener('click', function () {
  sectionSignup.classList.add('hide', 'scale-down');
  sectionLogin.classList.remove('hide', 'scale-down');

  illustration.classList.remove('swipe');
});
signUp.addEventListener('click', function () {
  sectionSignup.classList.remove('hide', 'scale-down');
  sectionLogin.classList.add('hide', 'scale-down');

  illustration.classList.add('swipe');
});

function toggleRegisterPassword() {
  const register = document.getElementById('register-password');
  const toggle = document.querySelector('.toggle-password-register');
  register.value
    ? toggle.classList.add('active')
    : toggle.classList.remove('active');
}
// toggle password in login form
function togglePasswordRegister() {
  const passwordRegister = document.getElementById('register-password');
  const toggleIcon = document.querySelector('.toggle-password-register img');
  if (passwordRegister.type === 'password') {
    toggleIcon.src = '/assets/images/sign-in/eye-slashed.svg';
    passwordRegister.type = 'text';
    passwordRegister.focus();
  } else {
    toggleIcon.src = '/assets/images/sign-in/eye.svg';
    passwordRegister.type = 'password';
    passwordRegister.focus();
  }
}

function toggleLoginPassword() {
  const password = document.getElementById('login-password');
  const toggle = document.querySelector('.toggle-password-login');
  password.value
    ? toggle.classList.add('active')
    : toggle.classList.remove('active');
}
// toggle password in login form
function togglePasswordLogin() {
  const passwordLogin = document.getElementById('login-password');
  const toggleIcon = document.querySelector('.toggle-password-login img');
  if (passwordLogin.type === 'password') {
    toggleIcon.src = '/assets/images/sign-in/eye-slashed.svg';
    passwordLogin.type = 'text';
    passwordLogin.focus();
  } else {
    toggleIcon.src = '/assets/images/sign-in/eye.svg';
    passwordLogin.type = 'password';
    passwordLogin.focus();
  }
}

// if the browser has render the page
document.addEventListener('DOMContentLoaded', function () {
  // for alert
  const message = document.querySelector('.alert');
  if (message) {
    setTimeout(function () {
      message.classList.add('alert-hide');
    }, 2500);
  }
});
