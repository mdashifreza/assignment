$(document).ready(function() {
	$('#login-form').submit(function(event) {
		event.preventDefault();
		var email = $('input[name="email"]').val();
		var password = $('input[name="password"]').val();
		$.ajax({
			url: 'login.php',
			type: 'POST',
			data: {email: email, password: password},
			dataType: 'json',
			success: function(data) {
				// Store user's details in local storage
				localStorage.setItem('user', JSON.stringify(data));
				// Redirect to profile page
				window.location.href = 'profile.php';
			},
			error: function(xhr, status, error) {
				// Display error message
				var errorMessage = xhr.responseText;
				$('#login-error').text(errorMessage);
			}
		});
	});
});
