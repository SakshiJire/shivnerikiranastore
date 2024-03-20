<?php
include '../app/config.php';
function sanitize($conn, $input) {
    return mysqli_real_escape_string($conn, $input);
} 
// SQL query to fetch product data
$query = "SELECT id, product_name_eng, min_qty, no_pack, sell_price_cash_per_box, sell_price_cash_per_pack 
          FROM tbl_product_master";
//print_r($query);exit;

$result = $conn->query($query);
//print_r($result);exit;
// Check if there are any results
if ($result) {
    // Array to hold the fetched products
    $products = array();
    
    // Fetch each row and add it to the products array
    while ($row = $result->fetch_assoc()) {
        // Determine whether to use box or packet prices based on quantity
        if ($row['min_qty'] >= $row['no_pack']) {
            $price_per_unit = $row['sell_price_cash_per_pack'];
            $unit_type = "Packet";
        } else {
            $price_per_unit = $row['sell_price_cash_per_box'];
            $unit_type = "Box";
        }

        // Calculate total price
        $total_price = $row['min_qty'] * $price_per_unit;

        // Format the product data
        $product = array(
            "product_id" => $row['id'],
            "product_name_eng" => $row['product_name_eng'],
            "unit_type" => $unit_type,
            "price_per_unit" => $price_per_unit,
            "quantity" => $row['min_qty'],
            "total_price" => $total_price
        );
        
        // Add the formatted product to the products array
        $products[] = $product;
    }

    // Close the database connection
    //$db->close();

    // Return the products as JSON
    echo json_encode(['status' => 'success','message' => 'Product list','data'=>$products]);
} else {
    // If there are no results, return an empty JSON array
       echo json_encode(['status' => 'error','message' => 'No data found','data'=>$products]);

}

?>
