<?php

$product_name = $_GET['product_name'];
$product_availability = $_GET['product_availability'];
echo $product_availability;
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kni_system";

// Create connection
$conn = new mysqli($servername,$username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: "
        . $conn->connect_error);
}

if($product_availability==0)
{
  $product_availability=1;
  echo $product_availability;
}
else if($product_availability==1)
{
  $product_availability=0;
  echo $product_availability;
}

$sqlquery = "UPDATE product SET product_availability=$product_availability WHERE product_name='$product_name'";

if ($conn->query($sqlquery) === TRUE) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . $conn->error;
}

header("Location: inventory_report.php");

?>
