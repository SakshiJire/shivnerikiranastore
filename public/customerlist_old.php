<?php
// Include the database configuration
include '../app/config.php';

// Function to sanitize user input to prevent SQL injection
function sanitize($conn, $input) {
    return mysqli_real_escape_string($conn, $input);
} 
// Check if username is provided via POST
if(isset($_POST['username'])) {
    $username = $_POST['username'];
    
    // Prepare SQL statement to fetch customer list based on username
    $sql = "SELECT * FROM tbl_user WHERE username = '".$username."'";
    $result = $conn->query($sql);
    //print_r($result);exit;
    
    // Check if there are any rows returned
    if ($result->num_rows > 0) {
        // Fetch data and return as JSON
        $customer_list = array();
        while ($row = $result->fetch_assoc()) {
            $customer_list[] = $row;
        }
        echo json_encode(array('status' => 'success','message' => 'customerlist','data'=>$customer_list));
    } else {
        // If no matching rows found
        echo json_encode(array('status' => 'error','message' => 'No customers found for the provided username.'));
    }
    
    } else {
    // If username is not provided
    echo json_encode(array('status' => 'error','message' => 'Please provide a username.'));
}

// Close connection
$conn->close();
?>