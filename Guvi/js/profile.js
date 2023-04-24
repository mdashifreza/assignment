$(document).ready(function () {
    // Get user's profile information
    $.ajax({
        url: 'get_profile.php',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            // Fill in form fields with user's current information
            $('#name').val(data.name);
            $('#age').val(data.age);
            $('#dob').val(data.dob);
            $('#contact').val(data.contact);
        },
        error: function (xhr, status, error) {
            console.log(error);
        }
    });

    // Handle form submission
    $('#update-form').submit(function (event) {
        // Stop the form from submitting normally
        event.preventDefault();

        // Get form data
        var formData = $(this).serialize();

        // Send form data to server for processing
        $.ajax({
            url: 'update_profile.php',
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function (data) {
                // Display success message
                $('#update-message').html('<div class="alert alert-success">' + data.message + '</div>');
            },
            error: function (xhr, status, error) {
                // Display error message
                $('#update-message').html('<div class="alert alert-danger">' + error + '</div>');
            }
        });
    });
});
