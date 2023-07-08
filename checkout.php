<?php
// Retrieve cart items from the form data
$cartItems = json_decode($_POST['cartItems'], true);

// Database connection configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kni_system";

// Create a new database connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Loop through each cart item and insert into the database
foreach ($cartItems as $item) {
    $id = $item['id'];
    $name = $item['name'];
    $price = $item['price'];
    $quantity = $item['quantity'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO order_details (product_id,product_name, total_amount, quantity) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("issi", $id,$name, $price, $quantity); 

    // Execute the statement
    $stmt->execute();
}

// Close the prepared statement
$stmt->close();

// Close the database connection
$conn->close();

// Clear the cart items from the session or session storage, depending on your implementation
session_start();
unset($_SESSION['cartItems']);

// Redirect back to the payment page or any other desired page
header("Location: payment.php");
exit();
?>
