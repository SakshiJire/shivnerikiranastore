<?php

// Database configuration
$servername = "localhost"; // Change this to your database server name if it's not localhost
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$database = "kiranastore"; // Change this to your database name

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
