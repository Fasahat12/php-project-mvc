<?php 
    require_once "ui-component/header.php";
    require_once "ui-component/navbar.php";

    session_start();
    $user = $_SESSION['result'];


    session_start();

    if (isset($_SESSION['update-user-errors'])) {
        $errors = $_SESSION['update-user-errors'];
        unset($_SESSION['update-user-errors']);
    } elseif (isset($_SESSION['update-success-message'])) {
        echo "<script>alert('{$_SESSION['update-success-message']}');</script>";
        unset($_SESSION['update-success-message']);
    }
?>

<div class="row my-5">
    <div class="col-6 m-auto">
        <h1 class="display-6 text-center">Edit User Details</h1>
        <form id="edit-form" action="index.php?route=update-user-info" method="POST">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="id" value="<?=$user['id']?>">
            <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input name="first_name" value="<?=$user['first_name']?>" type="text" placeholder="Enter first name..." class="form-control  <?=(isset($errors['100']) ? "is-invalid" : "")?>" id="first_name">
                <div id="firstNameInvalid1" class="invalid-feedback">
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
                <input name="last_name" value="<?=$user['last_name']?>" type="text" placeholder="Enter last name..." class="form-control <?=(isset($errors['101']) ? "is-invalid" : "")?>" id="last_name">
                <div id="lastNameInvalid1" class="invalid-feedback">
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
                <input name="email" value="<?=$user['email']?>" type="email" placeholder="Enter email..." class="form-control <?=(isset($errors['102']) ? "is-invalid" : "")?>" id="email">
                <div id="emailInvalid1" class="invalid-feedback">
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
                <input name="age" value="<?=$user['age']?>" type="number" placeholder="Enter age..." class="form-control <?=(isset($errors['104']) ? "is-invalid" : "")?>" id="age">
                <div id="ageInvalid1" class="invalid-feedback">
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
                <input name="profession" value="<?=$user['profession']?>" type="text" placeholder="Enter profession..." class="form-control <?=(isset($errors['103']) ? "is-invalid" : "")?>" id="profession">
                <div id="professionInvalid1" class="invalid-feedback">
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
                <input name="address" value="<?=$user['address']?>" type="text" placeholder="Enter address..." class="form-control <?=(isset($errors['106']) ? "is-invalid" : "")?>" id="address">
                <div id="addressInvalid1" class="invalid-feedback">
                    Please enter a valid address
                </div>
                <?php if (isset($errors['106'])) : ?>
                <div id="addressInvalid2" class="invalid-feedback">
                    Please enter a valid address
                </div>
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>

    </div>
</div>
<script>
    $(document).ready(function() {
        $("#edit-form").submit(function(event) {
            let firstName = $("#first_name").val().trim();
            let lastName = $("#last_name").val().trim();
            let email = $("#email").val().trim();
            let age = $("#age").val().trim();
            let profession = $("#profession").val().trim();
            let address = $("#address").val().trim();
            let errorCount = 0;

            if (!isEmail(email)) {
                errorCount++;
                displayError("#email", "#emailInvalid1");
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


    