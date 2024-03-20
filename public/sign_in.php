<?php

// Include the database configuration
include '../app/server_config.php';

// Function to sanitize user input to prevent SQL injection
function sanitize($conn, $input) {
    return mysqli_real_escape_string($conn, $input);
}

// Get the username and password from the request body
$username = sanitize($conn, $_POST['username']);
$password = sanitize($conn, $_POST['password']);

// SQL query to check if the username and password match
 $sql = "SELECT * FROM tbl_user WHERE BINARY username = '".$username."' AND BINARY password = '".$password."' ";
 $result = $conn->query($sql);

// Check if a row is returned
if ($result->num_rows == 1) {
    // Username and password match
    echo json_encode(['status' => 'success','message' => 'Login successful' ]);
    http_response_code(200);
} else {
    // Username and password do not match
    echo json_encode([, 'status' => 'error','message' => 'Invalid username or password']);
    http_response_code(401);
}

// Close the database connection
$conn->close();
?>