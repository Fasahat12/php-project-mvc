<?php

session_start();

require_once "ui-component/header.php";
require_once "ui-component/navbar.php";

?>
<div class="row my-5">
    <div class="col-8 m-auto">
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
                <tr id="row-<?=$user['id']?>">
                    <td><?=$user['id']?></td>
                    <td><?=$user['email']?></td>
                    <td><?=$user['first_name']?></td>
                    <td><?=$user['last_name']?></td>
                    <td>
                        <a href="index.php?route=edit-user-page&id=<?=$user['id']?>" class="btn btn-dark btn-sm">Edit</a>
                        <form id="delete-form-<?=$user['id']?>" class="d-inline">
                            <input type="hidden" name="id" value="<?=$user['id']?>">
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function() {

        $('form[id^="delete-form-"]').on('submit', function(event) {
            event.preventDefault();
            let userId = $(this).children("input[name=id]").val();

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "index.php?route=delete-user&id="+userId,
                        type: 'DELETE',
                        contentType: "application/json",
                        dataType: 'json',
                        success: function(response) {
                            if (response.status == 200) {
                                Swal.fire({
                                title: "User Deleted",
                                text: "User deleted successfully.",
                                icon: "success"
                                });

                                $(`#row-${userId}`).remove();
                            } else {
                                Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: response.message,
                                });
                            }
                        },
                        error: function(error) {
                            Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Something went wrong!",
                            });
                        }
                    });
                }
            });
            
        });
    });
</script>
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
