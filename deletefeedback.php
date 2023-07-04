<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["contact_id"])) {
    $query = "DELETE FROM contactus WHERE contactID='".$_GET["contact_id"]."'";
    echo $query;
    $result = $db_handle->executeQuery($query);
	if(!empty($result)){
		header("Location:feedback.php");
	}
}
?>
