<?php require_once "ui-component/header.php"; ?>
<div class="row my-5">
    <div class="col-6 m-auto">
        <h1 class="display-6 text-center">Login</h1>
        <form action="index.php?route=login" method="POST">
            <?php if ($_GET['error_code'] == "103") : ?>
                <div class="alert alert-warning" role="alert">
                    Invalid Credentials
                </div>
            <?php endif; ?>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input name="email" type="email" placeholder="Enter email..." class="form-control <?= (($_GET['error_code'] == "100" || $_GET['error_code'] == "101") ? "is-invalid" : "") ?>" id="email" aria-describedby="emailHelp">
                <?php if ($_GET['error_code'] == "100" || $_GET['error_code'] == "101") : ?>
                    <div id="emailInvalid1" class="invalid-feedback">
                        Please enter a valid email address
                    </div>
                <?php endif; ?>
                <div id="emailInvalid2" class="invalid-feedback d-none">
                    Please enter a valid email address
                </div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input name="password" type="password" placeholder="Enter password..." class="form-control <?= ($_GET['error_code'] == "102" ? "is-invalid" : "") ?>" id="password"> 
                <?php if ($_GET['error_code'] == "102") : ?>
                    <div id="passwordInvalid1" class="invalid-feedback">
                        Please enter a password
                    </div>
                <?php endif; ?>
                <div id="passwordInvalid2" class="invalid-feedback d-none">
                    Please enter a password
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <div class="mt-2">Don't have an account? <a href="index.php" class="text-decoration-none">Sign up</a></div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("form").submit(function(event) {
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
</script>
<?php require_once "ui-component/footer.php"; ?>