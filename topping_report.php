<!DOCTYPE html>
<html>

<head>

<style>
	.dropbtn {
  background-color: white;
  color: black;
  padding: 9px;
  font-size: 17px;
  border: none;
  cursor: none;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown:hover {
  background-color: #3e8e41;
}

	</style>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>KNI SHOP</title>


  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  <!--slick slider stylesheet -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick-theme.min.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700&display=swap" rel="stylesheet" />
  <!-- slick slider -->

  <link rel="stylesheet" href="css/slick-theme.css" />
  <!-- font awesome style -->
  <link href="css/font-awesome.min.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />

</head>

<body>

  <div class="main_body_content">

    <div class="hero_area">
      <!-- header section strats -->
      <header class="header_section">
        <div class="container-fluid">
          <nav class="navbar navbar-expand-lg custom_nav-container ">
            <a class="navbar-brand" href="index.html">
              KNI Shop
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class=""> </span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
				 <div class="quote_btn-container">
                  <li class="fa fa-user" aria-hidden="true">
					  <li class="dropdown">
					  <button class="dropbtn">▼</button>
					<ul class="dropdown-content">
					  <a href="index.html">LOGOUT</a>
					</ul>
				  </li>
				  </li>

              </div>

            <div class="collapse navbar-collapse " id="navbarSupportedContent">
              <ul class="navbar-nav ml-auto">
								<li class="nav-item">
                  <a class="nav-link" href="admin_cust.php"> Customers</a>
                </li>
								<li class="nav-item">
                  <a class="nav-link" href="inventory_report.php"> Product</a>
                </li>
								<li class="nav-item">
                  <a class="nav-link" href="orderlist.php"> Order</a>
                </li>
								<li class="nav-item">
                  <a class="nav-link" href="payment_report.php"> Payment</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="feedback.php">Inquiry</a>
                </li>
              </ul>
			  </div>
            </div>
			</nav>
        </div>
      </header>

	  <div id="sales_report" class="float_r" style="margin-top: 100px">

       	  <center>
       	    <h2>Toppings</h2>
			  <p>&nbsp;</p>
       	  </center>
			<center>
        	  	<table width="780px" cellspacing="0" cellpadding="5">
                   	  <tr bgcolor="#46200B" >
                        <th style="color: #ffffff" width="170" align="center">Product Image </th>
                       	<th style="color: #ffffff" width="162" align="center">Product Name</th>
                   	  	<th style="color: #ffffff" width="82" align="center">Unit Price</th>
						  <span><td width="105"> </td></span>

              </tr>
                    	<tr>
												<?php
												$host = "localhost";
												$user = "root";
												$password = "";
												$database = "kni_system";

												$conn = new mysqli($host, $user, $password, $database);
												// Check connection
												if ($conn->connect_error) {
												    die("Connection failed: " . $conn->connect_error);
												}

												$sql = "SELECT * FROM toppings";
												$result = $conn->query($sql);

												if ($result->num_rows > 0) {
												    // output data of each row
												    while($row = $result->fetch_assoc()) {
                              $image_data = $row["picture"];
                              $encoded_image = base64_encode($image_data);
                              $product_name=$row["topping_name"];
                              $product_unitprice=$row["price"];

												        echo "<td align='left'><img src='data:image/jpeg;base64,{$encoded_image}' width='50' /></td><td><p>"
                                 . $row["topping_name"]. "</p></td><td>"
                                  . $row["price"]. "</td>
																	<td align='center'> <a href='addtopping.php'>
																	Add</a><a href='edittopping.php?topping_id=",urlencode($row["topping_id"]),"'>
																	Edit</a><a href='deletetopping.php?topping_id=",urlencode($row["topping_id"]),"'>
																	Delete</a> </td>
                                   </tr>";
												    }
												} else {
												    echo "0 results";
												}

												$conn->close();
												?>
		  </table>
       	  <div style="float:center; width: 215px; margin-top: 20px;">


            </div>
		  </center>
       	  <div style="float:center; width: 215px; margin-top: 20px;">
          </div>
	  </div>
	</div>
	</div>



</body>

</html>
