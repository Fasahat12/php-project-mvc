<?php

session_start();

require_once "ui-component/header.php";
require_once "ui-component/navbar.php";

?>
<div class="row my-5">
    <div id='manage-users' class="col-8 m-auto">
        <table class="table">
            <thead class="table-dark">
                <th>Id</th>
                <th>Email Address</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Manage</th>
            </thead>
            <tbody>
                <?php foreach ($users as $user) : ?>
                    <tr id="row-<?= $user['id'] ?>">
                        <td><?= $user['id'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td><?= $user['first_name'] ?></td>
                        <td><?= $user['last_name'] ?></td>
                        <td>
                            <a href="index.php?route=edit-user-page&id=<?= $user['id'] ?>" class="btn btn-dark btn-sm"><i class="fa-regular fa-pen-to-square fa-sm"></i> Edit</a>
                            <form id="delete-form-<?= $user['id'] ?>" class="d-inline">
                                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can fa-sm"></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php if ($totalPages > 1) : ?>
            <nav aria-label="...">
                <ul class="pagination">
                    <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                        <li class="page-item text-dark page-no">
                            <a class="page-link" href="#"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
</div>
<script src="view/js/adminDashboard.js"></script>
<?php require_once "ui-component/footer.php"; ?>
<?php if (isset($_SESSION['update-success-message'])) : ?>
    <script>
        Swal.fire({
            title: "User Updated",
            text: "User information has been updated successfully.",
            icon: "success"
        });
    </script>
    <?php unset($_SESSION['update-success-message']); ?>
<?php endif; ?>