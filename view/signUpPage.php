<?php require_once "ui-component/header.php"; ?>
<div class="row my-5">
    <div class="col-6 m-auto">
        <h1 class="display-6 text-center">Sign Up</h1>
        <form action="../index.php?route=register-user" method="POST">
            <div class="mb-3">
                <label for="exampleInputFirstName1" class="form-label">First Name</label>
                <input name="first_name" type="text" placeholder="Enter first name..." class="form-control" id="exampleInputFirstName1">
            </div>
            <div class="mb-3">
                <label for="exampleInputLastName1" class="form-label">Last Name</label>
                <input name="last_name" type="text" placeholder="Enter last name..." class="form-control" id="exampleInputLastName1">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input name="email" type="email" placeholder="Enter email..." class="form-control" id="exampleInputEmail1">
            </div>
            <div class="mb-3">
                <label for="exampleInputNumber1" class="form-label">Age</label>
                <input name="age" type="number" placeholder="Enter age..." class="form-control" id="exampleInputNumber1">
            </div>
            <div class="mb-3">
                <label for="exampleInputProfession1" class="form-label">Profession</label>
                <input name="profession" type="text" placeholder="Enter profession..." class="form-control" id="exampleInputProfession1">
            </div>
            <div class="mb-3">
                <label for="exampleInputAddress1" class="form-label">Address</label>
                <input name="address" type="text" placeholder="Enter address..." class="form-control" id="exampleInputAddress1">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input name="password" type="password" placeholder="Enter password..." class="form-control" id="exampleInputPassword1">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <div class="mt-2">Already have an account? <a href="../index.php?route=login-page" class="text-decoration-none">Sign in</a></div>
        </form>

    </div>
</div>
<?php require_once "ui-component/footer.php"; ?>