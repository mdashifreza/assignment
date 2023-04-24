<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "guviData";
// Create a new MySQLi object
$conn = new mysqli($servername, $username, $password, $dbname);
// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Prepare the SQL statement with parameterized queries
$sql = "INSERT INTO guvirecord (username, email, password) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
// Bind the parameters with the user input data
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
// Check if the password and confirm password match
if ($password != $confirm_password) {
    die("Password and confirm password do not match");
}
// Hash the password
$password_hashed = password_hash($password, PASSWORD_DEFAULT);
// Bind the parameters with the sanitized user input data
$stmt->bind_param("sss", $username, $email, $password_hashed);
// Execute the prepared statement
if ($stmt->execute()) {
    echo "Data inserted successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
// Close the prepared statement and the database connection
$stmt->close();
$conn->close();
?>
