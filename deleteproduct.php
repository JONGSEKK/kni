<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["product_id"])) {
    $query = "DELETE FROM product WHERE product_id='".$_GET["product_id"]."'";
    echo $query;
    $result = $db_handle->executeQuery($query);
	if(!empty($result)){
		header("Location:inventory_report.php");
	}
}
?>
