$(document).ready(function() {
    $("#login-form").submit(function(event) {
        let email = $("#email").val();
        let password = $("#password").val();

        if (!isEmail(email)) {
            event.preventDefault();
            displayError("#email", "#emailInvalid2");
        }

        if (password.length === 0) {
            event.preventDefault();
            displayError("#password", "#passwordInvalid2");
        }
    });

    $('input').on('input', function(event) {
        $(this).removeClass("is-invalid");
        $(this).siblings('.invalid-feedback').addClass("d-none");
    });
});