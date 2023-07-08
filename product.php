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
// $products = json_decode('[{"id":100,"name":"Milk Chocolate","image":{"source":"https://user-images.githubusercontent.com/106356453/170603930-32abfddf-a435-4b9d-8941-2efaac24af36.jpg","width":250,"height":250},"Toppings":{"M&M":"M&M","Cadbury":"Cadbury","KitKat":"KitKat","Strawberry":"Strawberry","Milo Nugget":"Milo Nugget","Snickers":"Snickers","Oreo":"Oreo","Kinder Beuno":"Kinder Beuno","Marshmellow":"Marshmellow"},"desc":"Beryls brand is used","price":"18"},{"id":101,"name":"White Chocolate","image":{"source":"https://user-images.githubusercontent.com/106356453/170603977-fc0181f0-8c19-4d29-8ff7-e01545bd34cd.jpg","width":250,"height":250},"Toppings":{"M&M":"M&M","Cadbury":"Cadbury","KitKat":"KitKat","Strawberry":"Strawberry","Milo Nugget":"Milo Nugget","Snickers":"Snickers","Oreo":"Oreo","Kinder Beuno":"Kinder Beuno","Marshmellow":"Marshmellow"},"desc":"Beryls brand is used","price":"18"},{"id":102,"name":"Dark Chocolate","image":{"source":"https://user-images.githubusercontent.com/106356453/170603979-b4a08269-de13-4df2-9347-e1c99f5e80e5.jpg","width":250,"height":250},"Toppings":{"M&M":"M&M","Cadbury":"Cadbury","KitKat":"KitKat","Strawberry":"Strawberry","Milo Nugget":"Milo Nugget","Snickers":"Snickers","Oreo":"Oreo","Kinder Beuno":"Kinder Beuno","Marshmellow":"Marshmellow"},"desc":"Beryls brand is used","price":"18"},{"id":103,"name":"Strawberry Choco Milky","image":{"source":"https://user-images.githubusercontent.com/106356453/170603995-b17087b1-678f-4b63-8517-e1e77971aa07.jpg","width":250,"height":250},"Toppings":{"M&M":"M&M","Cadbury":"Cadbury","KitKat":"KitKat","Strawberry":"Strawberry","Milo Nugget":"Milo Nugget","Snickers":"Snickers","Oreo":"Oreo","Kinder Beuno":"Kinder Beuno","Marshmellow":"Marshmellow"},"desc":"The best you will ever taste","price":"18"},{"id":104,"name":"Red Velvet Choco","image":{"source":"https://user-images.githubusercontent.com/106356453/170604006-e2a86573-be0b-42df-889b-4d7234de1e89.PNG","width":250,"height":250},"Toppings":{"M&M":"M&M","Cadbury":"Cadbury","KitKat":"KitKat","Strawberry":"Strawberry","Milo Nugget":"Milo Nugget","Snickers":"Snickers","Oreo":"Oreo","Kinder Beuno":"Kinder Beuno","Marshmellow":"Marshmellow"},"desc":"Melts in your mouth","price":"18"},{"id":105,"name":"Sambal Hitam Pahang","image":{"source":"https://user-images.githubusercontent.com/106356453/170603971-80d782d0-7aa6-4550-ade8-b223ad5f9b51.jpeg","width":250,"height":250},"Toppings":{"M&M":"M&M","Cadbury":"Cadbury","KitKat":"KitKat","Strawberry":"Strawberry","Milo Nugget":"Milo Nugget","Snickers":"Snickers","Oreo":"Oreo","Kinder Beuno":"Kinder Beuno","Marshmellow":"Marshmellow"},"desc":"Melts in your mouth","price":"18"}]');



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

// if ($a == 'cart') {
//     // Retrieve cart items from session storage
//     $cartItems = json_decode($_SESSION['cartItems'], true);
    
//     // Check if cart items exist
//     if ($cartItems && !empty($cartItems)) {
//         echo '<h2>Cart Items</h2>';
        
//         // Loop through cart items and display them
//         foreach ($cartItems as $item) {
//             echo 'Product ID: ' . $item['id'] . '<br>';
//         }
//     } else {
//         echo '<p>Cart is empty.</p>';
//     }
// }

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
					<a href="index.php" class="navbar-brand"><img src="/images/mudah_small_resize.png" style="height: 40px; margin-top: -5px" alt=""></a>
					<button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>

				<div class="navbar-collapse collapse" id="navbar-main">
					<ul style="margin-left:885px;" class="nav navbar-nav">
						<li><a  style="font-size: 18px" href="addtocart.php" id="li-cart"><i style="font-size: 20px" class="fa fa-shopping-cart"></i> Cart</a></li>
					</ul>
				</div>
			</div>
		</div>

		<?php if ($a == 'cart'): ?>
			<div class="container">
				<h1>Shopping Cart</h1>
					 <script>
							// Retrieve the session storage data
						var cartItems = sessionStorage.getItem('cartItems');

						// Convert the JSON string to an object
						var cartItemsArray = JSON.parse(cartItems);

						// Display the cart items
						cartItemsArray.forEach(function(item) {
						console.log('Item ID: ' + item.id);
						});
				</script>
				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
						</div>
					</div>
				</div>
			</div>
		<?php else: ?>
			<div class="container" style="text-align: center;">
	<h1 style="font-size: 24px;">Products</h1>
	<div class="row" style="display: flex; flex-wrap: wrap; justify-content: center;">

		<?php
			$sql = "SELECT * FROM product";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
				// Loop through each row of data
				while ($row = $result->fetch_assoc()) {
					$id = $row['product_id'];
					$name = $row['product_name'];
					$price = $row['product_unitprice'];

					// Use the retrieved data as needed (e.g., display it)
					echo "<div style='margin: 10px; padding: 10px; border: 1px solid #ccc; width: 200px;'>";
					echo "ID: <span style='font-weight: bold;'>" . $id . "</span><br>";
					echo "Name: <span style='font-weight: bold;'>" . $name . "</span><br>";
					echo "Price: <span style='font-weight: bold;'>" . $price . "</span><br><br>";
					
					// Add to Cart button with JavaScript functionality
					echo '<button class="add-to-cart" data-id="' . $id . '" data-name="' . $name . '" data-price="' . $price . '" style="padding: 5px 10px; background-color: #4CAF50; color: white; border: none; cursor: pointer;">Add to Cart</button>';
					
					echo "</div>";
				}
			} else {
				echo "<p style='font-weight: bold;'>No results found.</p>";
			}
		?>
		
	</div>
</div>

		</div>
		<?php endif; ?>
		
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script>
    // Add event listener to all "Add to Cart" buttons
    var addToCartButtons = document.querySelectorAll('.add-to-cart');
    addToCartButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            // Get the product ID, name, and price from the data attributes
            var productId = this.getAttribute('data-id');
            var productName = this.getAttribute('data-name');
            var productPrice = this.getAttribute('data-price');

            // Retrieve existing cart items from session storage or create an empty array
            var cartItems = JSON.parse(sessionStorage.getItem('cartItems')) || [];

            // Check if the product is already in the cart
            var productExists = cartItems.some(function(item) {
                return item.id === productId;
            });

            if (!productExists) {
                // Add the product to the cart with ID, name, and price
                cartItems.push({ id: productId, name: productName, price: productPrice });

                // Update the cart items in session storage
                sessionStorage.setItem('cartItems', JSON.stringify(cartItems));

                // Create a form dynamically
                var $form = $('<form action="addtocart.php" method="post" />').html('<input type="hidden" name="add" value=""><input type="hidden" name="id" value="' + productId + '"><input type="hidden" name="name" value="' + productName + '"><input type="hidden" name="price" value="' + productPrice + '">');

                // Append the form to the document body
                $('body').append($form);

                // Submit the form
                $form.submit();
            } else {
                alert('Product is already in the cart!');
            }
        });
    });
</script>

		<!-- <script>
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
		</script> -->
		<br><br><br><br><br>
		<div style="position: absolute; width: 100%;">

  		</div>
	</body>
</html>
