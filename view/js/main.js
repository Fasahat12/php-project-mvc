/**  Helper Functions **/

function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

function displayError($inputFieldId, $feedBackId) {
    $($inputFieldId).addClass("is-invalid");
    $($feedBackId).removeClass("d-none");
}

function hideError($inputFieldId) {
    $($inputFieldId).removeClass("is-invalid");
    $($inputFieldId).siblings('.invalid-feedback').addClass("d-none");
}