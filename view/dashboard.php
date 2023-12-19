<?php require_once "ui-component/header.php"; ?>
<?php
    session_start();
    $row = $_SESSION['result'];

    foreach ($row as $key => $value) {
        echo "$key: $value<br>";
    }

?>
<?php require_once "ui-component/footer.php"; ?>


    