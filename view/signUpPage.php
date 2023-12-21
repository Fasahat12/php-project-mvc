<?php

require_once "ui-component/header.php";

session_start();

if (isset($_SESSION['sign-up-errors'])) {
    $errors = $_SESSION['sign-up-errors'];
    unset($_SESSION['sign-up-errors']);
}

?>

<div class="row my-5">
    <div class="col-6 m-auto">
        <h1 class="display-6 text-center">Sign Up</h1>
        <form id="sign-up-form" action="index.php?route=register-user" method="POST">
            <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input name="first_name" type="text" placeholder="Enter first name..." class="form-control <?=(isset($errors['100']) ? "is-invalid" : "")?>" id="first_name">
                <div id="firstNameInvalid1" class="invalid-feedback d-none">
                    Please enter a valid first name
                </div>
                <?php if (isset($errors['100'])) : ?>
                <div id="firstNameInvalid2" class="invalid-feedback">
                    Please enter a valid first name
                </div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input name="last_name" type="text" placeholder="Enter last name..." class="form-control  <?=(isset($errors['101']) ? "is-invalid" : "")?>" id="last_name">
                <div id="lastNameInvalid1" class="invalid-feedback d-none">
                    Please enter a valid last name
                </div>
                <?php if (isset($errors['101'])) : ?>
                    <div id="lastNameInvalid2" class="invalid-feedback">
                    Please enter a valid last name
                </div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input name="email" type="email" placeholder="Enter email..." class="form-control <?=(isset($errors['102']) ? "is-invalid" : "")?>" id="email">
                <div id="emailInvalid1" class="invalid-feedback d-none">
                    Please enter a valid email address
                </div>
                <?php if (isset($errors['102'])) : ?>
                <div id="emailInvalid2" class="invalid-feedback">
                    Please enter a valid email address
                </div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">Age</label>
                <input name="age" type="number" placeholder="Enter age..." class="form-control  <?=(isset($errors['104']) ? "is-invalid" : "")?>" id="age">
                <div id="ageInvalid1" class="invalid-feedback d-none">
                    Please enter a valid age
                </div>
                <?php if (isset($errors['104'])) : ?>
                <div id="ageInvalid2" class="invalid-feedback">
                    Please enter a valid age
                </div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="profession" class="form-label">Profession</label>
                <input name="profession" type="text" placeholder="Enter profession..." class="form-control <?=(isset($errors['103']) ? "is-invalid" : "")?>" id="profession">
                <div id="professionInvalid1" class="invalid-feedback d-none">
                    Please enter a valid profession
                </div>
                <?php if (isset($errors['103'])) : ?>
                <div id="professionInvalid2" class="invalid-feedback">
                    Please enter a valid profession
                </div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input name="address" type="text" placeholder="Enter address..." class="form-control <?=(isset($errors['106']) ? "is-invalid" : "")?>" id="address">
                <div id="addressInvalid1" class="invalid-feedback d-none">
                    Please enter a valid address
                </div>
                <?php if (isset($errors['106'])) : ?>
                <div id="addressInvalid2" class="invalid-feedback">
                    Please enter a valid address
                </div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input name="password" type="password" placeholder="Enter password..." class="form-control  <?=(isset($errors['105']) ? "is-invalid" : "")?>" id="password">
                <div id="passwordInvalid1" class="invalid-feedback d-none">
                    Please enter a valid password (8 characters)
                </div>
                <?php if (isset($errors['105'])) : ?>
                <div id="passwordInvalid2" class="invalid-feedback">
                    Please enter a valid password (8 characters)
                </div>
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <div class="mt-2">Already have an account? <a href="index.php?route=login-page" class="text-decoration-none">Sign in</a></div>
        </form>

    </div>
</div>
<script>
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
</script>
<?php require_once "ui-component/footer.php"; ?>