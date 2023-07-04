<?php
include('server.php')?>
<?php
require_once('./php/comp.php');
$i = 0;
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kni_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM ORDERS";
$result = $conn->query($sql);

$order_id = $result->num_rows +1;
// A collection of sample products
$products = json_decode('[{"id":100,"name":"Milk Chocolate","image":{"source":"https://user-images.githubusercontent.com/106356453/170603930-32abfddf-a435-4b9d-8941-2efaac24af36.jpg","width":250,"height":250},"Toppings":{"M&M":"M&M","Cadbury":"Cadbury","KitKat":"KitKat","Strawberry":"Strawberry","Milo Nugget":"Milo Nugget","Snickers":"Snickers","Oreo":"Oreo","Kinder Beuno":"Kinder Beuno","Marshmellow":"Marshmellow"},"desc":"Beryls brand is used","price":"18"},{"id":101,"name":"White Chocolate","image":{"source":"https://user-images.githubusercontent.com/106356453/170603977-fc0181f0-8c19-4d29-8ff7-e01545bd34cd.jpg","width":250,"height":250},"Toppings":{"M&M":"M&M","Cadbury":"Cadbury","KitKat":"KitKat","Strawberry":"Strawberry","Milo Nugget":"Milo Nugget","Snickers":"Snickers","Oreo":"Oreo","Kinder Beuno":"Kinder Beuno","Marshmellow":"Marshmellow"},"desc":"Beryls brand is used","price":"18"},{"id":102,"name":"Dark Chocolate","image":{"source":"https://user-images.githubusercontent.com/106356453/170603979-b4a08269-de13-4df2-9347-e1c99f5e80e5.jpg","width":250,"height":250},"Toppings":{"M&M":"M&M","Cadbury":"Cadbury","KitKat":"KitKat","Strawberry":"Strawberry","Milo Nugget":"Milo Nugget","Snickers":"Snickers","Oreo":"Oreo","Kinder Beuno":"Kinder Beuno","Marshmellow":"Marshmellow"},"desc":"Beryls brand is used","price":"18"},{"id":103,"name":"Strawberry Choco Milky","image":{"source":"https://user-images.githubusercontent.com/106356453/170603995-b17087b1-678f-4b63-8517-e1e77971aa07.jpg","width":250,"height":250},"Toppings":{"M&M":"M&M","Cadbury":"Cadbury","KitKat":"KitKat","Strawberry":"Strawberry","Milo Nugget":"Milo Nugget","Snickers":"Snickers","Oreo":"Oreo","Kinder Beuno":"Kinder Beuno","Marshmellow":"Marshmellow"},"desc":"The best you will ever taste","price":"18"},{"id":104,"name":"Red Velvet Choco","image":{"source":"https://user-images.githubusercontent.com/106356453/170604006-e2a86573-be0b-42df-889b-4d7234de1e89.PNG","width":250,"height":250},"Toppings":{"M&M":"M&M","Cadbury":"Cadbury","KitKat":"KitKat","Strawberry":"Strawberry","Milo Nugget":"Milo Nugget","Snickers":"Snickers","Oreo":"Oreo","Kinder Beuno":"Kinder Beuno","Marshmellow":"Marshmellow"},"desc":"Melts in your mouth","price":"18"},{"id":105,"name":"Sambal Hitam Pahang","image":{"source":"https://user-images.githubusercontent.com/106356453/170603971-80d782d0-7aa6-4550-ade8-b223ad5f9b51.jpeg","width":250,"height":250},"Toppings":{"M&M":"M&M","Cadbury":"Cadbury","KitKat":"KitKat","Strawberry":"Strawberry","Milo Nugget":"Milo Nugget","Snickers":"Snickers","Oreo":"Oreo","Kinder Beuno":"Kinder Beuno","Marshmellow":"Marshmellow"},"desc":"Melts in your mouth","price":"18"}]');

$topping_display = json_decode('[{"id":200,"name":"M&M","image":{"source":"https://user-images.githubusercontent.com/106356453/170604064-e888b043-763d-45a4-a19f-8c8a1f74ed82.jpg","width":200,"height":200}},{"id":201,"name":"Cadbury","image":{"source":"images/Cadbury.png","width":200,"height":200}},{"id":202,"name":"KitKat","image":{"source":"https://user-images.githubusercontent.com/106356453/170604057-b379efab-46d1-4a53-bc1a-57e4e886beb6.jpg","width":200,"height":200}},{"id":203,"name":"Strawberry","image":{"source":"images/strawberry.jpg","width":200,"height":200}},{"id":204,"name":"Milo Nugget","image":{"source":"https://user-images.githubusercontent.com/106356453/170604071-64bb7b8c-7057-489e-a4ec-27cf17164519.jpg","width":200,"height":200}},{"id":205,"name":"Snickers","image":{"source":"https://user-images.githubusercontent.com/106356453/170603963-e9d1207a-b9ab-469d-af42-053e2dd56dca.jpg","width":200,"height":200}},{"id":206,"name":"Oreo","image":{"source":"https://user-images.githubusercontent.com/106356453/170604074-600e22bb-8ce7-4cb9-a540-b647228d6086.jpg","width":200,"height":200}},{"id":207,"name":"Kinder Beuno","image":{"source":"https://user-images.githubusercontent.com/106356453/170604053-8e678c3b-3a75-47bd-86ef-9eb9356fef5f.jpg","width":200,"height":200}},{"id":208,"name":"Marshmellow","image":{"source":"https://user-images.githubusercontent.com/106356453/170604066-b8330754-014d-4744-8eaa-3c4837d569c2.jpg","width":200,"height":200}}]');

$Toppings = [
	'M&M'      => 'M&M',
	'Cadbury' => 'Cadbury',
	'KitKat'  => 'KitKat',
	'Strawberry' => 'Strawberry',
	'Milo Nugget'       => 'Milo Nugget',
	'Snickers'  => 'Snickers',
	'Oreo' => 'Oreo',
	'Kinder Beuno' => 'Kinder Beuno',
	'Marshmellow' => 'Marshmellow',
];

// Page
$a = (isset($_GET['a'])) ? $_GET['a'] : 'home';

require_once 'php/class.Cart.php';

// Initialize cart object
$cart = new Cart([
	// Maximum item can added to cart, 0 = Unlimited
	'cartMaxItem' => 0,

	// Maximum quantity of a item can be added to cart, 0 = Unlimited
	'itemMaxQuantity' => 0,

	// Do not use cookie, cart items will gone after browser closed
	'useCookie' => false,
]);

// Shopping Cart Page
if ($a == 'cart') {
	$cartContents = '
	<div class="alert alert-warning">
		<i class="fa fa-info-circle"></i> There are no items in the cart.
	</div>';

	// Empty the cart
	if (isset($_POST['empty'])) {
		$cart->clear();
	}

	// Add item
	if (isset($_POST['add'])) {
		foreach ($products as $product) {
			if ($_POST['id'] == $product->id) {
				break;
			}
		}

		$cart->add($product->id, $_POST['qty'], [
			'price' => $product->price,
			'Toppings' => (isset($_POST['Toppings'])) ? $_POST['Toppings'] : '',
		]);

	}

	// Update item
	if (isset($_POST['update'])) {
		foreach ($products as $product) {
			if ($_POST['id'] == $product->id) {
				break;
			}
		}

		$cart->update($product->id, $_POST['qty'], [
			'price' => $product->price,
			'Toppings' => (isset($_POST['Toppings'])) ? $_POST['Toppings'] : '',
		]);
	}

	// Remove item
	if (isset($_POST['remove'])) {
		foreach ($products as $product) {
			if ($_POST['id'] == $product->id) {
				break;
			}
		}

		$cart->remove($product->id, [
			'price' => $product->price,
			'Toppings' => (isset($_POST['Toppings'])) ? $_POST['Toppings'] : '',
		]);
	}

	if (!$cart->isEmpty()) {
		$allItems = $cart->getItems();

		$cartContents = '
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th class="col-md-7">Product</th>
					<th class="col-md-3 text-center">Quantity</th>
					<th class="col-md-2 text-right">Price</th>
				</tr>
			</thead>
			<tbody>';

		foreach ($allItems as $id => $items) {
			foreach ($items as $item) {
				foreach ($products as $product) {
					if ($id == $product->id) {
						break;
					}
				}

				$cartContents .= '
				<tr>
					<td>' . $product->name . ((isset($item['attributes']['Toppings'])) ? ('<p><strong>Toppings: </strong>' . $Toppings[$item['attributes']['Toppings']] . '</p>') : '') . '</td>
					<td class="text-center"><div class="form-group"><input type="number" value="' . $item['quantity'] . '"class="form-control quantity pull-left" style="width:100px">
				<div class="pull-right"><button class="btn btn-default btn-update" data-id="' . $id . '" data-Toppings="' . ((isset($item['attributes']['Toppings'])) ? $item['attributes']['Toppings'] : '') . '">
					<i class="fa fa-refresh"></i> Update</button><button class="btn btn-danger btn-remove" data-id="' . $id . '" data-Toppings="' . ((isset($item['attributes']['Toppings'])) ? $item['attributes']['Toppings'] : '') . '">
					<i class="fa fa-trash"></i></button></div></div></td>
					<td class="text-right">RM ' . $item['attributes']['price'] . '</td>
				</tr>';

				if (isset($_GET['payment'])) {
					if($product->name == 'Milk Chocolate')
					{
						$product_id = 1;
					}
					else if($product->name == 'White Chocolate')
					{
						$product_id = 2;
					}
					else if($product->name == 'Dark Chocolate')
					{
						$product_id = 3;
					}
					else if($product->name == 'Strawberry Choco Milky')
					{
						$product_id = 4;
					}
					else if($product->name == 'Red Velvet Choco')
					{
						$product_id = 5;
					}
					else if($product->name == 'Sambal Hitam Pahang')
					{
						$product_id = 6;
					}

					if($item['attributes']['Toppings']=='M&M')
					{
						$topping_id = 1;
					}
					else if($item['attributes']['Toppings']=='Cadbury')
					{
						$topping_id = 2;
					}
					else if($item['attributes']['Toppings']=='KitKat')
					{
						$topping_id = 3;
					}
					else if($item['attributes']['Toppings']=='Strawberry')
					{
						$topping_id = 4;
					}
					else if($item['attributes']['Toppings']=='Milo Nugget')
					{
						$topping_id = 5;
					}
					else if($item['attributes']['Toppings']=='Snickers')
					{
						$topping_id = 6;
					}
					else if($item['attributes']['Toppings']=='Oreo')
					{
						$topping_id = 7;
					}
					else if($item['attributes']['Toppings']=='Kinder Beuno')
					{
						$topping_id = 8;
					}
					else if($item['attributes']['Toppings']=='Marshmellow')
					{
						$topping_id = 9;
					}

					$servername = "localhost";
					$username = "root";
					$password = "";
					$dbname = "kni_system";

					// Create connection
					$conn = new mysqli($servername, $username, $password, $dbname);
					// Check connection
					if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					}
					$sql = "SELECT * FROM ORDERS";
					$result = $conn->query($sql);
					$sql2 = "SELECT * FROM ORDER_DETAILS";
					$result2 = $conn->query($sql2);
					$sql3 = "SELECT * FROM SHIPPING_INFORMATION";
					$result3 = $conn->query($sql3);
					$sql4 = "SELECT * FROM INVOICE";
					$result4 = $conn->query($sql4);
					$sql5 = "SELECT * FROM PAYMENT";
					$result5 = $conn->query($sql5);
					$orderdetail_id = $result2->num_rows +1;
				  //$order_id = $result->num_rows +1;
					$shipping_information = $result3->num_rows +1;
					$invoice = $result4->num_rows +1;
					$payment = $result5->num_rows +1;
					$sql = "INSERT INTO ORDER_DETAILS (orderdetail_id, product_id, order_id,topping_id,order_quantity)
					VALUES ('$orderdetail_id','$product_id', '$order_id','$topping_id', ".$item['quantity'].")";

					if ($conn->query($sql) === TRUE) {
						if($i == 0)
						{
							$sql2 = "INSERT INTO SHIPPING_INFORMATION (shipping_id, shipment_date, company_name,phone_number)
							VALUES ('$shipping_information','". date("Y-m-d") ."', 'J&T Express', '0182648274')";
							$sql3 = "INSERT INTO PAYMENT (payment_id, payment_date,payment_type,total_payment)
							VALUES ('$payment', '". date("Y-m-d") ."','Online Banking', ". number_format($cart->getAttributeTotal('price'), 2, '.', ',') .")";
							$sql4 = "INSERT INTO INVOICE (invoice_id, issue_date, invoice_due,status)
							VALUES ('$invoice','". date("Y-m-d") ."','". date("Y-m-d") ."', '1')";
							$sql5 = "INSERT INTO ORDERS (order_id, customer_id, invoice_id,shipping_id,payment_id,total_amount,status)
							VALUES ('$order_id','".$_SESSION['username']."','$invoice', '$shipping_information','$payment', ". number_format($cart->getAttributeTotal('price'), 2, '.', ',') .",'1')";
							$i = 1;
					  	$conn->query($sql2);
							$conn->query($sql3);
							$conn->query($sql4);
							$conn->query($sql5);
							$cart->clear();
							header("Location: payment.php");
				}
					} else {
						echo "Error: " . $sql . "<br>" . $conn->error;
					}
					$conn->close();
				}


			}
		}

		$cartContents .= '
			</tbody>
		</table>
		<form METHOD=POST>
		<div class="text-right">
		<div class="form-group"> <label>Have coupon?</label>
		<div style="margin-left:900px;" class="input-group">
		<input type="text" class="form-control coupon" name="name" placeholder="Coupon code"><span class="input-group-append"> <button class="btn btn-danger btn-apply coupon">Apply</button> </span> </div></div></div>

		</form>
		<div class="text-right">
			<h3>Total:<br />RM ' . number_format($cart->getAttributeTotal('price'), 2, '.', ',') . '</h3>
		</div>

		<p>
			<div class="pull-left">
				<button class="btn btn-danger btn-empty-cart">Empty Cart</button>
			</div>
			<div class="pull-right text-right">
				<a href="?a=home" class="btn btn-default">Continue Shopping</a>
				<a href="product.php?a=cart&payment=true" class="btn btn-danger">Checkout</a>
			</div>
		</p>';
	}
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>Product</title>

		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
		<link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/cosmo/bootstrap.min.css" rel="stylesheet">
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  		<link href="css/style.css" rel="stylesheet" />
  		<link rel="stylesheet" href="css/cart.css">

		<style>
			body{margin-top:50px;margin-bottom:200px}
		</style>
	</head>

	<body style="background-color: #fcf7f6; font-color:black;">
		<div class="navbar navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<a href="index.php" class="navbar-brand">KNI Shop</a>
					<button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>

				<div class="navbar-collapse collapse" id="navbar-main">
					<ul style="margin-left:885px;" class="nav navbar-nav">
						<li><a  style="font-size: 18px" href="?a=cart" id="li-cart"><i style="font-size: 20px" class="fa fa-shopping-cart"></i> Cart (<?php echo $cart->getTotalItem(); ?>)</a></li>
					</ul>
				</div>
			</div>
		</div>

		<?php if ($a == 'cart'): ?>
		<div class="container">
			<h1>Shopping Cart</h1>

			<div class="row">
				<div class="col-md-12">
					 <div class="table-responsive">
						<?php echo $cartContents; ?>
					 </div>
				</div>
			</div>
		</div>
		<?php else: ?>
		<div class="container">
			<h1>Products</h1>
			<div class="row">
				<?php
				foreach ($products as $product) {
					echo '
					<div class="col-md-6">
						<h3>' . $product->name . '</h3>

						<div>
							<div class="pull-left">
								<img src="' . $product->image->source . '" border="0" width="' . $product->image->width . '" height="' . $product->image->height . '" title="' . $product->name . '" />
							</div>
							<div class="pull-right">
								<h4><b>RM ' . $product->price . '</b></h4>
								<h5><i style="font-weight:400;">' . $product->desc . '</i></h5>
								<form>
									<input type="hidden" value="' . $product->id . '" class="product-id" />';

					if ($product->Toppings) {
						echo '
										<div class="form-group">
											<label>Toppings:</label>
											<select class="form-control Toppings">';

						foreach ($product->Toppings as $key => $value) {
							echo '
												<option value="' . $key . '"> ' . $value . '</option>';
						}

						echo '
											</select>
										</div>';
					}

					echo '

									<div class="form-group">
										<label>Quantity:</label>
										<input type="number" value="1" class="form-control quantity" />
									</div>
									<div class="form-group cart">
										<button class="btn btn-danger add-to-cart "><i class="fa fa-shopping-cart"></i><span>Add to Cart</span></button>
									</div>
								</form>
							</div>
							<div class="clearfix"></div>
						</div>
					</div>';
				}
				?>
			</div>
		</div>
		<?php endif; ?>
		<div  class="container"><br>
			<h1>Toppings</h1>
			<div style="margin-left: 120px;">
				<?php
				foreach ($topping_display as $topping_display) {
					echo '
					<div class="col-md-4">
						<h3>' . $topping_display->name . '</h3>


						<div class="col-4">
							<div class="pull-left">
							<article>
							<div>
								<img src="' . $topping_display->image->source . '" border="0" width="' . $topping_display->image->width . '" height="' . $topping_display->image->height . '" title="' . $topping_display->name . '" />
							</div>


								<form>
									<input type="hidden" value="' . $topping_display->id . '" class="product-id" />
									</form>
									</article>
									</div>
									</div>
									</div>
									';
				}
				?>
			</div>
		</div>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

		<script>
			$(document).ready(function(){
				$('.add-to-cart').on('click', function(e){
					e.preventDefault();

					var $btn = $(this);
					var id = $btn.parent().parent().find('.product-id').val();
					var Toppings = $btn.parent().parent().find('.Toppings').val() || '';
					var qty = $btn.parent().parent().find('.quantity').val();

					var $form = $('<form action="?a=cart" method="post" />').html('<input type="hidden" name="add" value=""><input type="hidden" name="id" value="' + id + '"><input type="hidden" name="Toppings" value="' + Toppings + '"><input type="hidden" name="qty" value="' + qty + '">');

					$('body').append($form);
					$form.submit();
				});

				$('.btn-update').on('click', function(){
					var $btn = $(this);
					var id = $btn.attr('data-id');
					var qty = $btn.parent().parent().find('.quantity').val();
					var Toppings = $btn.attr('data-Toppings');

					var $form = $('<form action="?a=cart" method="post" />').html('<input type="hidden" name="update" value=""><input type="hidden" name="id" value="'+id+'"><input type="hidden" name="qty" value="'+qty+'"><input type="hidden" name="Toppings" value="'+Toppings+'">');

					$('body').append($form);
					$form.submit();
				});

				$('.btn-remove').on('click', function(){
					var $btn = $(this);
					var id = $btn.attr('data-id');
					var Toppings = $btn.attr('data-Toppings');

					var $form = $('<form action="?a=cart" method="post" />').html('<input type="hidden" name="remove" value=""><input type="hidden" name="id" value="'+id+'"><input type="hidden" name="Toppings" value="'+Toppings+'">');

					$('body').append($form);
					$form.submit();
				});

				$('.btn-empty-cart').on('click', function(){
					var $form = $('<form action="?a=cart" method="post" />').html('<input type="hidden" name="empty" value="">');

					$('body').append($form);
					$form.submit();
				});

			});
		</script>
		<br><br><br><br><br>
		<div style="position: absolute; width: 100%;">
		<?php
 		footer();
  		?>
  		</div>
	</body>
</html>
