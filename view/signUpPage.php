<?php

require_once "ui-component/header.php";
require_once "ui-component/navbar.php";

session_start();

if (isset($_SESSION['sign-up-errors'])) {
    $errors = $_SESSION['sign-up-errors'];
    unset($_SESSION['sign-up-errors']);
}

?>

<div class="row my-5">
    <div class="col-10 col-md-5 col-lg-4 col-xl-4 m-auto">
        <div class="card p-3 shadow-lg bg-body rounded border-white mb-5">
            <div class="card-body">
                <h1 class="display-6 text-center">Sign Up</h1>
                <form id="sign-up-form" action="index.php?route=register-user" method="POST">
                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input name="first_name" type="text" placeholder="Enter first name..." class="form-control <?= (isset($errors['100']) ? "is-invalid" : "") ?>" id="first_name">
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
                        <input name="last_name" type="text" placeholder="Enter last name..." class="form-control  <?= (isset($errors['101']) ? "is-invalid" : "") ?>" id="last_name">
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
                        <input name="email" type="email" placeholder="Enter email..." class="form-control <?= (isset($errors['102']) ? "is-invalid" : "") ?>" id="email">
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
                        <input name="age" type="number" placeholder="Enter age..." class="form-control  <?= (isset($errors['104']) ? "is-invalid" : "") ?>" id="age">
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
                        <input name="profession" type="text" placeholder="Enter profession..." class="form-control <?= (isset($errors['103']) ? "is-invalid" : "") ?>" id="profession">
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
                        <input name="address" type="text" placeholder="Enter address..." class="form-control <?= (isset($errors['106']) ? "is-invalid" : "") ?>" id="address">
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
                        <input name="password" type="password" placeholder="Enter password..." class="form-control  <?= (isset($errors['105']) ? "is-invalid" : "") ?>" id="password">
                        <div id="passwordInvalid1" class="invalid-feedback d-none">
                            Please enter a valid password (8 characters)
                        </div>
                        <?php if (isset($errors['105'])) : ?>
                            <div id="passwordInvalid2" class="invalid-feedback">
                                Please enter a valid password (8 characters)
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <div class="mt-2">Already have an account? <a href="index.php?route=login-page" class="text-decoration-none">Sign in</a></div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="view/js/signUp.js"></script>
<?php require_once "ui-component/footer.php"; ?>