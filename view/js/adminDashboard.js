var currentPage = document.currentScript.getAttribute('currentPage');
var totalPages = document.currentScript.getAttribute('totalPages');
console.log(currentPage);
const itemsPerPage = 5;

$(document).ready(function () {

    $('.table').on('submit', 'form[id^="delete-form-"]', function (event) {
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
                    url: "index.php?route=delete-user&id=" + userId,
                    type: 'DELETE',
                    contentType: "application/json",
                    dataType: 'json',
                    success: function (response) {
                        if (response.status == 200) {
                            Swal.fire({
                                title: "User Deleted",
                                text: "User deleted successfully.",
                                icon: "success"
                            });

                            totalPages = response.pages;

                            $(`#row-${userId}`).remove();

                            $('.pagination').empty();

                            $('.pagination').append(`
                            <li class="page-item  ${parseInt(currentPage) == 1 ? 'disabled' : ''}"><a class="page-link previous text-dark" href="index.php?route=admin-dashboard&page=${parseInt(currentPage) - 1}">Previous</a></li>
                            `);

                            for (let i = 0; i < response.pages; i++) {
                                $('.pagination').append(`
                                    <li class="page-item text-dark page-no">
                                        <a class="page-link" href="index.php?route=admin-dashboard&page=${i + 1}">${i + 1}</a>
                                    </li>
                                `);
                            }

                            $('.pagination').append(`
                                <li class="page-item ${parseInt(currentPage) == parseInt(totalPages) ? 'disabled' : ''}"><a class="page-link next text-dark" href="index.php?route=admin-dashboard&page=${parseInt(currentPage) + 1}">Next</a></li>
                            `);

                            moveToPage(currentPage);
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Oops...",
                                text: response.message,
                            });
                        }
                    },
                    error: function (error) {
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