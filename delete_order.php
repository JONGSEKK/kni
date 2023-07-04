<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["order_id"])) {
    $query = "DELETE FROM orders WHERE order_id='".$_GET["order_id"]."'";
    echo $query;
    $result = $db_handle->executeQuery($query);
    $query = "DELETE FROM order_details WHERE order_id='".$_GET["order_id"]."'";
    echo $query;
    $result = $db_handle->executeQuery($query);
    $query = "DELETE FROM payment WHERE payment_id='".$_GET["order_id"]."'";
    echo $query;
    $result = $db_handle->executeQuery($query);
    $query = "DELETE FROM invoice WHERE invoice_id='".$_GET["order_id"]."'";
    echo $query;
    $result = $db_handle->executeQuery($query);
    $query = "DELETE FROM shipping_information WHERE shipping_id='".$_GET["order_id"]."'";
    echo $query;
    $result = $db_handle->executeQuery($query);
	if(!empty($result)){
		header("Location:orderlist.php");
	}
}
?>
