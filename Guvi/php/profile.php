<?php
// Start session and check if user is logged in
session_start();
if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}
// Connect to MongoDB
$mongo = new MongoDB\Client('mongodb://localhost:27017');
// Select the database and collection
$db = $mongo->selectDatabase('mydb');
$coll = $db->selectCollection('users');

// Handle form submission
if (isset($_POST['submit'])) {
  // Get form data
    $name = $_POST['name'];
    $age = $_POST['age'];
    $dob = $_POST['dob'];
    $contact = $_POST['contact'];

  // Update user's profile information in database
    $coll->updateOne(
        ['email' => $_SESSION['email']],
        ['$set' => [
        'name' => $name,
        'age' => $age,
        'dob' => $dob,
        'contact' => $contact
        ]]
    );
  // Reload page to display updated profile information
    header('Location: profile.php');
    exit();
}
// Get user's profile information from database
$profile = $coll->findOne(['email' => $_SESSION['email']], [
    'projection' => [
        '_id' => 0,
        'name' => 1,
        'age' => 1,
        'dob' => 1,
        'contact' => 1
    ]
]);