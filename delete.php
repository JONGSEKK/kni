<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["customer_id"])) {
    $query = "DELETE FROM customer WHERE customer_id='".$_GET["customer_id"]."'";
    echo $query;
    $result = $db_handle->executeQuery($query);
	if(!empty($result)){
		header("Location:admin_cust.php");
	}
}
?>
