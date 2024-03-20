<?php
include '../app/config.php';

// Function to sanitize user input to prevent SQL injection
function sanitize($conn, $input) {
    return mysqli_real_escape_string($conn, $input);
} 
//print_r($_POST);exit;
// Check if required fields are provided via POST
if(isset($_POST['user_name']) && isset($_POST['mobile_number']) && isset($_POST['address'])) 
{
    $user_name = $_POST['user_name'];
    $mobile_number = $_POST['mobile_number'];
    $address = $_POST['address'];

    // Check if mobile number is already registered
    $check_mobile_query = "SELECT * FROM tbl_user WHERE mobile_number = '".$mobile_number."'";
    $result_mobile = $conn->query($check_mobile_query);
    
    // Check if username is already registered
    $check_username_query = "SELECT * FROM tbl_user WHERE BINARY user_name = '".$user_name."'";
    $result_username = $conn->query($check_username_query);

    
    // Check if mobile number or username already exist
    if ($result_mobile->num_rows > 0) {
        // Mobile number already registered
        echo json_encode(array("status" =>"error",'message' => 'Mobile number already registered.'));
    } elseif ($result_username->num_rows > 0) {
        // Username already registered
        echo json_encode(array("status" =>"error",'message' => 'Username already registered.'));
    }
     else
    {
    
        // Prepare SQL statement to insert new customer
        $sql = "INSERT INTO tbl_user (user_name, mobile_number, address) VALUES ('".$user_name."', '".$mobile_number."', '".$address."')";
        $result = $conn->query($sql);
        
        // Execute query
        if ($result === TRUE) {
            // Registration successful
            echo json_encode(array("status" =>"success",'message' => 'Customer registered successfully.'));
        } else {
            // Registration failed

            echo json_encode(array("status" =>"error",'message' => 'Error registering customer.'));
            }
          
    }
}
else {
        // If required fields are not provided
        echo json_encode(array('message' => 'Please provide user_name, mobile_number, and address.'));
        }
// Close connection
$conn->close();
?>
