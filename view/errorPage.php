<?php

require_once "ui-component/header.php";
require_once "ui-component/navbar.php";

?>
<div class="page-500">
    <div class="outer">
        <div class="middle">
            <div class="inner">
                <!--BEGIN CONTENT-->
                <div class="inner-circle"><i class="fa fa-cogs"></i><span>500</span></div>
                <span class="inner-status">Oops! Internal Server Error!</span>
                <span class="inner-detail">Unfortunately we're having trouble loading the page you are looking for. Please come back in a while.</span>
                <!--END CONTENT-->
            </div>
        </div>
    </div>
</div>
<?php require_once "ui-component/footer.php"; ?>