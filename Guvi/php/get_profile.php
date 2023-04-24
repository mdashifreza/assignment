<?php
// Connect to MongoDB
$mongo = new MongoDB\Client('mongodb://localhost:27017');
// Select the database and collection
$db = $mongo->selectDatabase('mydb');
$coll = $db->selectCollection('users');
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
// Return profile information as JSON object
echo json_encode($profile);
?>
