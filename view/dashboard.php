<?php

require_once "ui-component/header.php";
require_once "ui-component/navbar.php";

session_start();
$user = $_SESSION['result'];

if (isset($_SESSION['update-user-errors'])) {
    $errors = $_SESSION['update-user-errors'];
    unset($_SESSION['update-user-errors']);
}

require_once "ui-component/editUserForm.php";
require_once "ui-component/footer.php";

?>

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
<?php if (isset($_SESSION['address-success-message'])) : ?>
    <script>
        Swal.fire({
            title: "Address Saved",
            text: "<?= $_SESSION['address-success-message'] ?>",
            icon: "success"
        });
    </script>
    <?php unset($_SESSION['address-success-message']); ?>
<?php endif; ?>