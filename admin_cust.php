<?php
	require_once("perpage.php");
	require_once("dbcontroller.php");
	$db_handle = new DBController();

	$first_name = "";

	$queryCondition = "";
	if(!empty($_POST["search"])) {
		foreach($_POST["search"] as $k=>$v){
			if(!empty($v)) {

				$queryCases = array("customer_firstname");
				if(in_array($k,$queryCases)) {
					if(!empty($queryCondition)) {
						$queryCondition .= " AND ";
					} else {
						$queryCondition .= " WHERE ";
					}
				}
				switch($k) {
					case "customer_firstname":
						$name = $v;
						$queryCondition .= "customer_firstname LIKE '" . $v . "%'";
						break;
				}
			}
		}
	}
	$orderby = " ORDER BY customer_id desc";
	$sql = "SELECT * FROM customer " . $queryCondition;
	$href = 'admin_cust.php';

	$perPage = 10;
	$page = 1;
	if(isset($_POST['page'])){
		$page = $_POST['page'];
	}
	$start = ($page-1)*$perPage;
	if($start < 0) $start = 0;

	$query =  $sql . $orderby .  " limit " . $start . "," . $perPage;
	$result = $db_handle->runQuery($query);

	if(!empty($result)) {
		$result["perpage"] = showperpage($sql, $perPage, $href);
	}
?>



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
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class=""> </span>
            </button>

            <div class="collapse navbar-collapse " id="navbarSupportedContent">
              <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                  <a class="nav-link" href="admin_cust.php"> Customers</a>
                </li>
								<li class="nav-item">
                  <a class="nav-link" href="inventory_report.php"> Product</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="feedback.php">Inquiry</a>
                </li>
              </ul>
              <div class="quote_btn-container">
                <form class="form-inline">

                </form>

              </div>
            </div>
          </nav>
        </div>
      </header>
      <!-- end header section -->

    <article>

		<div style="text-align:right;margin:20px 0px 10px;">

		</div>
    <div id="toys-grid">
			<form name="frmSearch" method="post" action="admin_cust.php">
			<div class="search-box">
			<p><input type="text" placeholder="First Name" name="search[customer_firstname]" class="demoInputBox" value="<?php echo $first_name; ?>"/>

			<input type="submit" name="go" class="btnSearch" value="Search">
			<input type="reset" class="btnSearch" value="Reset" onclick="window.location='admin_cust.php'"></p>
			</div>

			<table cellpadding="10" cellspacing="1">
        <thead>
					<tr>
          <th><strong>First Name</strong></th>
          <th><strong>Last Name</strong></th>
          <th><strong>User Name</strong></th>
					<th><strong>Phone Number</strong></th>
					<th><strong>User Email</strong></th>
					<th><strong>Action</strong></th>

					</tr>
				</thead>
				<tbody>
					<?php
					if(!empty($result)) {
						foreach($result as $k=>$v) {
						  if(is_numeric($k)) {
					?>
          <tr>
					<td><?php echo $result[$k]["customer_firstname"]; ?></td>
          <td><?php echo $result[$k]["customer_lastname"]; ?></td>
					<td><?php echo $result[$k]["customer_id"]; ?></td>
					<td><?php echo $result[$k]["customer_phonenumber"]; ?></td>
					<td><?php echo $result[$k]["customer_email"]; ?></td>
					<td>
						<a class="btnEditAction" href="edit.php?customer_id=<?php echo $result[$k]["customer_id"]; ?>">Edit</a>
					  <a class="btnDeleteAction" href="delete.php?action=delete&customer_id=<?php echo $result[$k]["customer_id"];?>" onclick="return confirm('Are you sure you want to delete this customer?')">Delete</a>
					</td>
					</tr>
					<?php
						  }
					   }
                    }
					if(isset($result["perpage"])) {
					?>
					<tr>
					<td colspan="6" align=right> <?php echo $result["perpage"]; ?></td>
					</tr>
					<?php } ?>
				<tbody>
			</table>
			</form>
		</div>




    </article>






</body>
</html>
