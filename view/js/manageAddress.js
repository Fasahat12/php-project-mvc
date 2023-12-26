$(document).ready(function() {
    $("#address-form #submitBtn").click(function(event) {
        let city = $("#city").val().trim();
        let zipCode = $("#zip_code").val().trim();
        let address = $("#address").val().trim();
        let errorCount = 0;

        if (city.length == 0) {
            errorCount++;
            displayError("#city", "#cityInvalid1");
        }

        if (zipCode.length == 0) {
            errorCount++;
            displayError("#zip_code", "#zipCodeInvalid1");
        }

        if (address.length == 0) {
            errorCount++;
            displayError("#address", "#addressInvalid1");
        }

        event.preventDefault();

        if (errorCount > 0) {
            return;
        }

        Swal.fire({
            title: "Are you sure?",
            text: "You want to add this address?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, save this!"
        }).then((result) => {
            if (result.isConfirmed) {
                $('#address-form').submit();
            }
        });


    });

    $('input').on('input', function(event) {
        hideError(this);
    });
});