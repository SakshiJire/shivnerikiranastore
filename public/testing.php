<?php

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$database = "kiranastore";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die(json_encode(array("error" => "Connection failed: " . $conn->connect_error)));
}

// Set UTF-8 character set
$conn->set_charset("utf8mb4");

    // Prepare SQL statement to fetch customer list based on username
    //$sql = "SELECT `id`,`category_name` FROM `tbl_product_category`";
   $sql = "SELECT `id`,`category_name` FROM `tbl_product_category`";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $categories = array();
    // Fetch data and store in array
    while($row = $result->fetch_assoc()) {
        $category_name = str_replace(" \ ", ",", $row["category_name"]);
       // print_r($category_name);
        $category = array(
            "id" => $row["id"],
            "category_name" => $row["category_name"]
        );
        $categories[] = $category;
    }
    // Output data as JSON
    echo json_encode(['status' => 'success','message' => 'Category list','data'=>$categories],JSON_UNESCAPED_UNICODE);
   // echo json_encode($categories, JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(array("message" => "No results found"));
}

// Close connection
$conn->close();
?>