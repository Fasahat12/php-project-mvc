<div class="row my-5">
    <div class="col-4 m-auto">
      <div class="card p-3 shadow-lg bg-body rounded border-white">
       <div class="card-body">
        <h1 class="display-6 text-center">Edit User Details</h1>
        <form id="edit-form" action="index.php?route=update-user-info" method="POST">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="id" value="<?=$user['id']?>">
            <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input name="first_name" value="<?=$user['first_name']?>" type="text" placeholder="Enter first name..." class="form-control  <?=(isset($errors['100']) ? "is-invalid" : "")?>" id="first_name">
                <div id="firstNameInvalid1" class="invalid-feedback d-none">
                    Please enter a valid first name
                </div>
                <?php if (isset($errors['100'])) : ?>
                <div id="firstNameInvalid2" class="invalid-feedback">
                    Please enter a valid first name
                </div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input name="last_name" value="<?=$user['last_name']?>" type="text" placeholder="Enter last name..." class="form-control <?=(isset($errors['101']) ? "is-invalid" : "")?>" id="last_name">
                <div id="lastNameInvalid1" class="invalid-feedback d-none">
                    Please enter a valid last name
                </div>
                <?php if (isset($errors['101'])) : ?>
                <div id="lastNameInvalid2" class="invalid-feedback">
                    Please enter a valid last name
                </div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input name="email" value="<?=$user['email']?>" type="email" placeholder="Enter email..." class="form-control <?=(isset($errors['102']) ? "is-invalid" : "")?>" id="email">
                <div id="emailInvalid1" class="invalid-feedback d-none">
                    Please enter a valid email address
                </div>
                <?php if (isset($errors['102'])) : ?>
                <div id="emailInvalid2" class="invalid-feedback">
                    Please enter a valid email address
                </div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">Age</label>
                <input name="age" value="<?=$user['age']?>" type="number" placeholder="Enter age..." class="form-control <?=(isset($errors['104']) ? "is-invalid" : "")?>" id="age">
                <div id="ageInvalid1" class="invalid-feedback d-none">
                    Please enter a valid age
                </div>
                <?php if (isset($errors['104'])) : ?>
                <div id="ageInvalid2" class="invalid-feedback">
                    Please enter a valid age
                </div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="profession" class="form-label">Profession</label>
                <input name="profession" value="<?=$user['profession']?>" type="text" placeholder="Enter profession..." class="form-control <?=(isset($errors['103']) ? "is-invalid" : "")?>" id="profession">
                <div id="professionInvalid1" class="invalid-feedback d-none">
                    Please enter a valid profession
                </div>
                <?php if (isset($errors['103'])) : ?>
                <div id="professionInvalid2" class="invalid-feedback">
                    Please enter a valid profession
                </div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input name="address" value="<?=$user['address']?>" type="text" placeholder="Enter address..." class="form-control <?=(isset($errors['106']) ? "is-invalid" : "")?>" id="address">
                <div id="addressInvalid1" class="invalid-feedback d-none">
                    Please enter a valid address
                </div>
                <?php if (isset($errors['106'])) : ?>
                <div id="addressInvalid2" class="invalid-feedback">
                    Please enter a valid address
                </div>
                <?php endif; ?>
            </div>
            <div class="d-grid gap-2">
                <button id="submitBtn" type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
    $(document).ready(function() {
        $("#edit-form #submitBtn").click(function(event) {
            let firstName = $("#first_name").val().trim();
            let lastName = $("#last_name").val().trim();
            let email = $("#email").val().trim();
            let age = $("#age").val().trim();
            let profession = $("#profession").val().trim();
            let address = $("#address").val().trim();
            let errorCount = 0;

            if (!isEmail(email)) {
                errorCount++;
                displayError("#email", "#emailInvalid1");
            }

            if (firstName.length == 0) {
                errorCount++;
                displayError("#first_name", "#firstNameInvalid1");
            }

            if (lastName.length == 0) {
                errorCount++;
                displayError("#last_name", "#lastNameInvalid1");
            }

            if (age.length == 0 || age <= 0) {
                errorCount++;
                displayError("#age", "#ageInvalid1");
            }

            if (address.length == 0) {
                errorCount++;
                displayError("#address", "#addressInvalid1");
            }

            if (profession.length == 0) {
                errorCount++;
                displayError("#profession", "#professionInvalid1");
            }

            event.preventDefault();

            if (errorCount > 0) {
                return;
            }

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, update this!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#edit-form').submit();
                }
            });
        

        });

        $('input').on('input', function(event) {
            hideError(this);
        });
    });
</script>