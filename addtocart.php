<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>Payment</title>

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

					</ul>
				</div>
			</div>
		</div>


		<div class="container">
    <h1>Cart Items</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="cartItemsTableBody"></tbody>
        <tfoot>
            <tr>
                <td colspan="4"></td>
                <td><strong>Total:</strong> <span id="totalPriceLabel"></span></td>
                <td></td>
            </tr>
        </tfoot>
    </table>

    <button id="checkoutButton" class="btn btn-success">Proceed to Payment</button>
    <button id="clearCartButton" class="btn btn-danger">Clear Cart</button>

    <script>
        // Retrieve cart items from session storage
        var cartItems = JSON.parse(sessionStorage.getItem('cartItems'));

        // Get the table body element
        var tableBody = document.getElementById('cartItemsTableBody');

        // Check if there are any cart items
        if (cartItems && cartItems.length > 0) {
            // Loop through each cart item and create a table row
            cartItems.forEach(function(item) {
                if (!item.quantity) {
                    item.quantity = 1; // Set default quantity to 1 if not defined
                }

                var row = document.createElement('tr');
                var idCell = document.createElement('td');
                var nameCell = document.createElement('td');
                var priceCell = document.createElement('td');
                var quantityCell = document.createElement('td');
                var quantityInput = document.createElement('input');
                var increaseButton = document.createElement('button');
                var decreaseButton = document.createElement('button');
                var totalPriceCell = document.createElement('td');
                var actionCell = document.createElement('td');
                var deleteButton = document.createElement('button');

                idCell.textContent = item.id;
                nameCell.textContent = item.name;
                priceCell.textContent = item.price;

                quantityInput.type = 'number';
                quantityInput.value = item.quantity;
                quantityInput.min = 1;
                quantityInput.addEventListener('change', function() {
                    item.quantity = parseInt(quantityInput.value);
                    updatePrice(item, totalPriceCell);
                    calculateTotalPrice();
                    sessionStorage.setItem('cartItems', JSON.stringify(cartItems));
                });

                increaseButton.textContent = '+';
                increaseButton.addEventListener('click', function() {
                    quantityInput.value = parseInt(quantityInput.value) + 1;
                    quantityInput.dispatchEvent(new Event('change'));
                });

                decreaseButton.textContent = '-';
                decreaseButton.addEventListener('click', function() {
                    if (parseInt(quantityInput.value) > 1) {
                        quantityInput.value = parseInt(quantityInput.value) - 1;
                        quantityInput.dispatchEvent(new Event('change'));
                    }
                });

                deleteButton.textContent = 'Delete';
                deleteButton.style.backgroundColor = '#f44336';
                deleteButton.style.color = 'white';
                deleteButton.style.border = 'none';
                deleteButton.style.borderRadius = '4px';
                deleteButton.style.padding = '6px 12px';
                deleteButton.style.cursor = 'pointer';
                deleteButton.addEventListener('click', function() {
                    var index = cartItems.indexOf(item);
                    if (index > -1) {
                        cartItems.splice(index, 1);
                        tableBody.removeChild(row);
                        calculateTotalPrice();
                        sessionStorage.setItem('cartItems', JSON.stringify(cartItems));
                    }
                });

                quantityCell.appendChild(decreaseButton);
                quantityCell.appendChild(quantityInput);
                quantityCell.appendChild(increaseButton);

                actionCell.appendChild(deleteButton);

                row.appendChild(idCell);
                row.appendChild(nameCell);
                row.appendChild(priceCell);
                row.appendChild(quantityCell);
                row.appendChild(totalPriceCell);
                row.appendChild(actionCell);

                updatePrice(item, totalPriceCell);

                tableBody.appendChild(row);
            });
        } else {
            var row = document.createElement('tr');
            var noItemsCell = document.createElement('td');
            noItemsCell.setAttribute('colspan', '6');
            noItemsCell.textContent = 'No items in the cart.';
            row.appendChild(noItemsCell);
            tableBody.appendChild(row);
        }

        function updatePrice(item, totalPriceCell) {
            var total = item.price * item.quantity;
            totalPriceCell.textContent = total.toFixed(2);
        }

        function calculateTotalPrice() {
            var totalPrice = 0;
            cartItems.forEach(function(item) {
                totalPrice += item.price * item.quantity;
            });
            document.getElementById('totalPriceLabel').textContent = totalPrice.toFixed(2);
        }

        // Checkout button click event
        var checkoutButton = document.getElementById('checkoutButton');
        checkoutButton.addEventListener('click', function() {
            // Clear session storage
            sessionStorage.removeItem('cartItems');
            
            // Redirect to payment page
            window.location.href = 'payment.php';
        });

        // Clear cart button click event
        var clearCartButton = document.getElementById('clearCartButton');
        clearCartButton.addEventListener('click', function() {
            // Clear the cartItems array and remove all table rows
            cartItems = [];
            tableBody.innerHTML = '<tr><td colspan="6">No items in the cart.</td></tr>';

            // Reset the total price
            document.getElementById('totalPriceLabel').textContent = '0.00';

            // Update session storage with the empty cartItems array
            sessionStorage.setItem('cartItems', JSON.stringify(cartItems));
        });
    </script>
</body>
</html>
