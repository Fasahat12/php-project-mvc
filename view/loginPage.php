<?php require_once "ui-component/header.php"; ?>
<div class="row my-5">
    <div class="col-6 m-auto">
        <h1 class="display-6 text-center">Login</h1>
        <form action="../index.php?route=login" method="POST">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input name="email" type="email" placeholder="Enter email..." class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input name="password" type="password" placeholder="Enter password..." class="form-control" id="exampleInputPassword1">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <div class="mt-2">Don't have an account? <a href="../index.php" class="text-decoration-none">Sign up</a></div>
        </form>
    </div>
</div>    
<?php require_once "ui-component/footer.php"; ?>