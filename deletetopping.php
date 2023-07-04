<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["topping_id"])) {
    $query = "DELETE FROM toppings WHERE topping_id='".$_GET["topping_id"]."'";
    echo $query;
    $result = $db_handle->executeQuery($query);
	if(!empty($result)){
		header("Location:topping_report.php");
	}
}
?>
