$(document).ready(function() {
    const signUpButton = $('#signUp');
    const signInButton = $('#signIn');
    const container = $('#container');
	const forgetPass_Buton = $('.forget-pass_button')
	const forget_pass_form = $('.forget_pass_form')
	const overlay = $('.overlay1')
    signUpButton.on('click', function() {
        container.addClass("right-panel-active");
    });
    signInButton.on('click', function() {
        container.removeClass("right-panel-active");
    });
	forgetPass_Buton.click(function() {
		overlay.show()
		forget_pass_form.show()

	})
	overlay.click(function() {
		forget_pass_form.hide()
		overlay.hide()

	})
	
});