<?php
// Get form data
$email = $_POST['email'];
$password = $_POST['password'];
// Query database to retrieve user's details
$stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Check if user exists and verify password
if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        // Password is correct, store user's details in local storage
        $user_details = array(
            'name' => $row['name'],
            'email' => $row['email'],
            'age' => $row['age'],
            'dob' => $row['dob'],
            'contact' => $row['contact']
        );
        echo json_encode($user_details);
    } else {
        // Password is incorrect
        http_response_code(401); // Unauthorized
        echo "Invalid password";
    }
} else {
    // User does not exist
    http_response_code(401); // Unauthorized
    echo "Invalid email";
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
