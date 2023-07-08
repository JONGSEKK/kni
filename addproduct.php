<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_POST["submit"])) {
    $query = "INSERT INTO product(product_id,product_name,product_unitprice,product_availability) VALUES ('".$_POST["product_id"]."' ,'".$_POST["product_name"]."','".$_POST["price"]."','".$_POST["product_availability"]."')";
    $result = $db_handle->executeQuery($query);
	if(!$result){
		$message = "Problem in Editing! Please Retry!";
	} else {
		header("Location:inventory_report.php");
	}

}

?>
<link href="style.css" type="text/css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script>


	return valid;
}
</script>
<style>
* {
  box-sizing: border-box;
}

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}

label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}

input[type=submit] {
  background-color: #04AA6D;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}

.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
}

.col-75 {
  float: left;
  width: 75%;
  margin-top: 6px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}
</style>
<form name="frmToy" method="post" action="" id="frmToy">
<div id="mail-status"></div>
<div>
<label style="padding-top:20px;">Product Name</label>
<span id="name-info" class="info"></span><br/>
<input type="text" name="product_name" id="product_name" class="demoInputBox" value="" required/>
<label style="padding-top:20px;">Product ID</label>
<span id="name-info" class="info"></span><br/>
<input type="text" name="product_id" id="product_id" class="demoInputBox" value="" required/>
<label style="padding-top:20px;">Price</label>
<span id="name-info" class="info"></span><br/>
<input type="text" name="price" id="price" class="demoInputBox" value="" required/>
<label style="padding-top:20px;">Product Availability</label>
<span id="name-info" class="info"></span><br/>
<input type="text" name="product_availability" id="product_availability" class="demoInputBox" value="" required/>
</div>


<div>
<input type="submit" name="submit" id="btnAddAction" value="Add" />
</div>
</div>
<br><br>
