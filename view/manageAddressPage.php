<?php

require_once "ui-component/header.php";
require_once "ui-component/navbar.php";

$errors = [];

if (isset($_SESSION['address-errors'])) {
    $errors = $_SESSION['address-errors'];
    unset($_SESSION['address-errors']);
}

?>
<div class="row my-5">
    <div class="col-10 col-md-5 col-lg-4 col-xl-4 m-auto">
        <div class="card p-3 shadow-lg bg-body rounded border-white mb-5">
            <div class="card-body">
                <h4 class="fw-light text-center mb-3">Add / Edit Delivery Address</h4>
                <form id="address-form" action="index.php?route=add-update-address" method="POST">
                    <?php if ($address) : ?>
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="id" value="<?= $address['id'] ?>">
                    <?php endif; ?>
                    <div class="mb-3">
                        <label for="city" class="form-label">City</label>
                        <input name="city" value="<?= $address['city'] ?>" type="text" placeholder="Enter city..." class="form-control  <?= (isset($errors['100']) ? "is-invalid" : "") ?>" id="city">
                        <div id="cityInvalid1" class="invalid-feedback d-none">
                            Please enter a valid city
                        </div>
                        <?php if (isset($errors['100'])) : ?>
                            <div id="cityInvalid2" class="invalid-feedback">
                                Please enter a valid city
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="zip_code" class="form-label">Postal / Zip Code</label>
                        <input name="zip_code" value="<?= $address['zip_code'] ?>" type="text" placeholder="Enter code..." class="form-control <?= (isset($errors['101']) ? "is-invalid" : "") ?>" id="zip_code">
                        <div id="zipCodeInvalid1" class="invalid-feedback d-none">
                            Please enter a valid zip code
                        </div>
                        <?php if (isset($errors['101'])) : ?>
                            <div id="zipCodeInvalid2" class="invalid-feedback">
                                Please enter a valid zip code
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">address</label>
                        <input name="address" value="<?= $address['address'] ?>" type="address" placeholder="Enter address..." class="form-control <?= (isset($errors['102']) ? "is-invalid" : "") ?>" id="address">
                        <div id="addressInvalid1" class="invalid-feedback d-none">
                            Please enter a valid address
                        </div>
                        <?php if (isset($errors['102'])) : ?>
                            <div id="addressInvalid2" class="invalid-feedback">
                                Please enter a valid address
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="d-grid gap-2">
                        <button id="submitBtn" type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- <script src="view/js/manageAddress.js"></script> -->
<?php require_once "ui-component/footer.php"; ?>