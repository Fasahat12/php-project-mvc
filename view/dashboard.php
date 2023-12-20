<?php 
    require_once "ui-component/header.php";
    require_once "ui-component/navbar.php";

    session_start();
    $user = $_SESSION['result'];
?>

<div class="row my-5">
    <div class="col-6 m-auto">
        <h1 class="display-6 text-center">Edit User Details</h1>
        <form action="../index.php?route=update-user-info" method="POST">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="id" value="<?=$user['id']?>">
            <div class="mb-3">
                <label for="exampleInputFirstName1" class="form-label">First Name</label>
                <input name="first_name" value="<?=$user['first_name']?>" type="text" placeholder="Enter first name..." class="form-control" id="exampleInputFirstName1">
            </div>
            <div class="mb-3">
                <label for="exampleInputLastName1" class="form-label">Last Name</label>
                <input name="last_name" value="<?=$user['last_name']?>" type="text" placeholder="Enter last name..." class="form-control" id="exampleInputLastName1">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input name="email" value="<?=$user['email']?>" type="email" placeholder="Enter email..." class="form-control" id="exampleInputEmail1">
            </div>
            <div class="mb-3">
                <label for="exampleInputNumber1" class="form-label">Age</label>
                <input name="age" value="<?=$user['age']?>" type="number" placeholder="Enter age..." class="form-control" id="exampleInputNumber1">
            </div>
            <div class="mb-3">
                <label for="exampleInputProfession1" class="form-label">Profession</label>
                <input name="profession" value="<?=$user['profession']?>" type="text" placeholder="Enter profession..." class="form-control" id="exampleInputProfession1">
            </div>
            <div class="mb-3">
                <label for="exampleInputAddress1" class="form-label">Address</label>
                <input name="address" value="<?=$user['address']?>" type="text" placeholder="Enter address..." class="form-control" id="exampleInputAddress1">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>

    </div>
</div>

<?php require_once "ui-component/footer.php"; ?>


    