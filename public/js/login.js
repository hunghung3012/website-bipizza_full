const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');
const signUpButton_main = document.querySelector('.sign-up-container button');
const signInButton_main = document.querySelector('.sign-in-container button');
const signIn_email = document.querySelector('.sign-in-container .email_input');
const signIn_pass = document.querySelector('.sign-in-container .password_input');
const nameInputsu = document.querySelector('.name_input_signup');
const emailInputsu = document.querySelector('.email_input_signup');
const passInputsu = document.querySelector('.pass_input_signup');
const error1 = document.querySelector('.error1');
const error2 = document.querySelector('.error2');

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});






