/**  Helper Functions **/

function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}

function displayError($inputFieldId, $feedBackId) {
    $($inputFieldId).addClass("is-invalid");
    $($feedBackId).removeClass("d-none");
}

function hideError($inputFieldId) {
    $($inputFieldId).removeClass("is-invalid");
    $($inputFieldId).siblings('.invalid-feedback').addClass("d-none");
}

function addUsersInPage(users) {
    $('tbody').empty();

    users.forEach((user, index) => {
        $('tbody').append(`
            <tr id="row-${user.id}">
                <td>${user.id}</td>
                <td>${user.email}</td>
                <td>${user.first_name}</td>
                <td>${user.last_name}</td>
                <td>
                    <a href="index.php?route=edit-user-page&id=${user.id}" class="btn btn-dark btn-sm">Edit</a>
                    <form id="delete-form-${user.id}" class="d-inline">
                        <input type="hidden" name="id" value="${user.id}">
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        `);
    });
}

function moveToPage(page) {       
    $.ajax({
        url: "index.php?route=get-users&page="+page,
        type: 'GET',
        contentType: "application/json",
        dataType: 'json',
        success: function(response) {
            if (response.status == 200) {
                addUsersInPage(response.data);
            } else {
                if (page == 1) {
                    Swal.fire({
                        icon: "error",
                        title: "No Users Found",
                        text: "No users exist.",
                        });                    
                } else {
                    moveToPage(page - 1);
                }
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