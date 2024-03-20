<?php

// Database configuration

// Database configuration
$servername = "demo.raviscyber.in"; // Change this to your database server name if it's not localhost
$username = "kiranastore"; // Change this to your database username
$password = "a8B=#~m5>C#~"; // Change this to your database password
$database = "u997151991_kiranastore"; // Change this to your database name


// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
