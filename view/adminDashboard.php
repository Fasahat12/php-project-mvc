<?php

session_start();

require_once "ui-component/header.php";
require_once "ui-component/navbar.php";

?>
<div class="row my-5">
    <div class="col-8 m-auto">
        <table class="table">
        <thead class="table-dark">
            <th>#</th>
            <th>Email Address</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Manage</th>
        </thead>
        <tbody>
            <?php $count = 0; ?>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?=(++$count)?></td>
                    <td><?=$user['email']?></td>
                    <td><?=$user['first_name']?></td>
                    <td><?=$user['last_name']?></td>
                    <td>
                        <button class="btn btn-dark btn-sm">Edit</button>
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        </table>
    </div>
</div>
<?php require_once "ui-component/footer.php"; ?>