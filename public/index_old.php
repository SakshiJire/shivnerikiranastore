<?php

include '../app/config.php';

// Set the content type to JSON
header('Content-Type: application/json');
// echo"hi";die();
// Simulated user data (replace with database implementation in a real project)
$users = [
    'user1' => 'password1',
    'user2' => 'password2'
];

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // print_r($_REQUEST['username']);exit();
    // print_r($_REQUEST['password']);exit();
    // Get the username and password from the request body
    //$data = json_decode(file_get_contents('php://input'), true);
    $username =$_REQUEST['username']?? '';
    $password =$_REQUEST['password'] ?? '';

    // Check if the provided username exists and the password matches
    print_r($users);exit();
    //print_r() "$password";exit();
    if (array_key_exists($username, $users) && $users[$username] === $password) {
        // Authentication successful
        echo json_encode(['message' => 'Login successful', 'status' => 'success']);
        http_response_code(200);
    } else {
        // Authentication failed
        echo json_encode(['message' => 'Invalid username or password', 'status' => 'error']);
        http_response_code(401);
    }
} else {
    // Method not allowed
    echo json_encode(['message' => 'Method not allowed', 'status' => 'error']);
    http_response_code(405);
}
