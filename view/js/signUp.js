$(document).ready(function() {
    $("#sign-up-form").submit(function(event) {
        let firstName = $("#first_name").val().trim();
        let lastName = $("#last_name").val().trim();
        let email = $("#email").val().trim();
        let age = $("#age").val().trim();
        let profession = $("#profession").val().trim();
        let address = $("#address").val().trim();
        let password = $("#password").val();
        let errorCount = 0;

        if (!isEmail(email)) {
            errorCount++;
            displayError("#email", "#emailInvalid1");
        }

        if (password.length < 8) {
            errorCount++;
            displayError("#password", "#passwordInvalid1");
        }

        if (firstName.length == 0) {
            errorCount++;
            displayError("#first_name", "#firstNameInvalid1");
        }

        if (lastName.length == 0) {
            errorCount++;
            displayError("#last_name", "#lastNameInvalid1");
        }

        if (age.length == 0 || age <= 0) {
            errorCount++;
            displayError("#age", "#ageInvalid1");
        }

        if (address.length == 0) {
            errorCount++;
            displayError("#address", "#addressInvalid1");
        }

        if (profession.length == 0) {
            errorCount++;
            displayError("#profession", "#professionInvalid1");
        }

        if (errorCount > 0) {
            event.preventDefault();
        }

    });

    $('input').on('input', function(event) {
        hideError(this);
    });
});