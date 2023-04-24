$(document).ready(function () {
    $('#registration-form').submit(function (event) {
        event.preventDefault(); // Prevent form submission
        var name = $('#name').val();
        var email = $('#email').val();
        var password = $('#password').val();
        // Validate form data
        if (name === '' || email === '' || password === '') {
            alert('Please enter all fields.');
            return;
        }
        // Submit form data using AJAX
        $.ajax({
            type: 'POST',
            url: 'register.php',
            data: { name: name, email: email, password: password },
            success: function (response) {
                // Handle successful registration
                alert('Registration successful!');
                window.location.href = 'login.php'; // Redirect to login page
            },
            // Handle error
            error: function (error) {
                alert('Registration failed: ' + error);
            }
        });
    });
});
