<!DOCTYPE html>
<html>

<head>

<style>

	#toys-grid {
    margin-top: 20px;
	width: 95%;
	margin-left:40px;
}

#toys-grid .txt-heading {
    background-color: #D3F5B8;
}

#toys-grid table {
    width: 100%;
    background-color: #F0F0F0;
}

#toys-grid table td {
    background-color: #FFFFFF;
}

.search-box {
    border: 1px solid #F0F0F0;
    background-color: #C8EEFD;
    margin: 2px 0px;
}

.demoInputBox {
    padding: 10px;
    border: #F0F0F0 1px solid;
    border-radius: 4px;
    margin: 0px 5px
}

.btnSearch {
    padding: 10px;
    border: #F0F0F0 1px solid;
    border-radius: 4px;
    margin: 0px 5px;
}

.perpage-link {
    padding: 5px 10px;
    border: #C8EEFD 2px solid;
    border-radius: 4px;
    margin: 0px 5px;
    background: #FFF;
    cursor: pointer;
}

.current-page {
    padding: 5px 10px;
    border: #C8EEFD 2px solid;
    border-radius: 4px;
    margin: 0px 5px;
    background: #C8EEFD;
}

.btnEditAction {
    background-color: #2FC332;
    padding: 2px 5px;
    color: #FFF;
    text-decoration: none;
}

.btnDeleteAction {
    background-color: #D60202;
    padding: 2px 5px;
    color: #FFF;
    text-decoration: none;
}

#btnAddAction {
    background-color: #0000FF;
    border: 0;
    padding: 20px 50px;
    color: #FFF;
    text-decoration: none;

}

#frmToy {
    border-top: #F0F0F0 2px solid;
    background: #FAF8F8;
    padding: 10px;
}

#frmToy div {
    margin-bottom: 15px
}

#frmToy div label {
    margin-left: 5px
}

.error {
    background-color: #FF6600;
    border: #AA4502 1px solid;
    padding: 5px 10px;
    color: #FFFFFF;
    border-radius: 4px;
}

.info {
    font-size: .8em;
    color: #FF6600;
    letter-spacing: 2px;
    padding-left: 5px;
}
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
  <!-- slick slider stylesheet -->
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
       	    <h2>Payment Report</h2>
       	    <p>&nbsp;</p>
       	  </center>
			<center>
        	  	<table width="680px" cellspacing="0" cellpadding="5">
                   	  <tr bgcolor="#46200B" >
                        <th align="center" style="color: #ffffff" width="140" >Payment ID</th>
                       	<th style="color: #ffffff" width="179" align="center">Customer</th>
                   	  	<th style="color: #ffffff" width="134" align="center">Payment Date</th>
						 <center><th align="center" style="color: #ffffff" width="96" >Total Payment</th></center>
					    <td width="79"></span>

              </tr>
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

              $sql = "SELECT CONCAT(C.customer_firstname,' ',C.customer_lastname)AS name,P.payment_id,P.payment_date,P.total_payment  FROM payment P
              LEFT JOIN orders O
              ON O.payment_id = P.payment_id
              LEFT JOIN customer C
              ON O.customer_id = C.customer_id";
              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                  // output data of each row
                  while($row = $result->fetch_assoc()) {
                    $name=$row["name"];
                      echo  "<tr>
                          	  <td><left>".$row["payment_id"]."</left></td>
                           	<td><left>".$row["name"]."</left></td>
   							<td><left>".$row["payment_date"]."</left></td>
                               <td align='center'> ".$row["total_payment"]." </a> </td>
                               <td align='center'> <a class='btnEditAction' > PAID </a> </td>
   						</tr>";
                }
              } else {
                //echo "Error in ".$sql."<br>".$conn->error;
                  //echo "0 results";
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
