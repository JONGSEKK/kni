<?php

function product($productimg,$productname,$productdesc,$productprice,$productid){
	$element="

		<div class=\"col-4\">
    <form action=\"product.php\" method=\"post\">
        <article class=\"productInfo\"><!-- Each individual product description -->
          <div class=\"col-mx-auto\"><img class=\"imgproduct\" alt=\"sample\" src=\"$productimg\"></div>
          <p class=\"productName\">$productname</p>
          <p class=\"productprice\">RM $productprice</p>
          <p class=\"productdesc\">$productdesc</p><br>
          <button type=\"submit\" class=\"cart\" name=\"add\"><span>Add to Cart</span><i class=\"fa fa-shopping-cart\" aria-hidden=\"true\"></i></button>
          <input type='hidden' name='product_id' value='$productid'>
        </article>
        </form>
        </div>
";
echo $element;
}

function cartElement($productimg, $productname ,$productprice , $productdesc, $productid){
    $element = "

    <form action=\"shoppingcart.php?action=remove&id=$productid\" method=\"post\"class=\"cart-items\">
        <div class=\"border rounded\">
            <div class=\"row bg-white\">
                <div class=\"col-md-3 pl-0\">
                    <img src=$productimg alt=\"Image1\" class=\"img-fluid\">
                    </div>
                    <div class=\"col-md-6\">
                    <h5 class=\"pt-2\">$productname</h5>
                    <small class=\"text-secondary\">$productdesc</small>
                    <h5 class=\"pt-2\">RM $productprice</h5>
                    <button type=\"submit\" class=\"btn btn-danger mx-2\" name=\"remove\">Remove</button>
                    </div>
                    <div class=\"col-md-3 py-5\">
                    <div>
                    <button type=\"button\" class=\"btn bg-light border rounded-circle\"><i class=\"fas fa-minus\"></i></button>
                    <input type=\"text\" value=\"1\" class=\"form-control w-25 d-inline\">
                    <button type=\"button\" class=\"btn bg-light border rounded-circle\"><i class=\"fas fa-plus\"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </form>

";
echo  $element;
}

function topping($toppingimg,$toppingname,$toppingprice){
	$element="

	<div class=\"col-4\">
	<article class=\"productInfo\"> <!-- Each individual product description -->
          <div class=\"col-mx-auto\"><img class=\"imgproduct\" alt=\"sample\" src=\"$toppingimg\"></div>
          <p class=\"productName\">$toppingname</p>
          <p class=\"productprice\">RM $toppingprice</p><br>
        </article>
        </div>

";
echo $element;
}

function footer(){
	$element="

	<!-- info section -->
    <section class=\"info_section layout_padding2\">
      <div class=\"container\">
        <div class=\"row info_form_social_row\">
          <div class=\"col-md-8 col-lg-9\">
            <div class=\"info_form\">
              <form action=\"\">
                <input style=\"color: black;\" type=\"email\" placeholder=\"Enter your email\">
                <button>
                  <i class=\"fa fa-arrow-right\" aria-hidden=\"true\"></i>
                </button>
              </form>
            </div>
          </div>
          <div class=\"col-md-4 col-lg-3\">

            <div class=\"social_box\">
              <a href=\"\">
                <i class=\"fa fa-facebook\" aria-hidden=\"true\"></i>
              </a>
              <a href=\"https://www.instagram.com/kni.sh0p/\">
                <i class=\"fa fa-instagram\" aria-hidden=\"true\"></i>
              </a>
              <a href=\"\">
                <i class=\"fa fa-linkedin\" aria-hidden=\"true\"></i>
              </a>
            </div>
          </div>
        </div>
        <div class=\"row info_main_row\">
          <div class=\"col-md-6 col-lg-3\">
            <div class=\"info_links\">
              <h4>
                Menu
              </h4>
              <div class=\"info_links_menu\">
                <a href=\"index.php\">
                  Home
                </a>
                <a href=\"about.php\">
                  About
                </a>
                <a href=\"product.php\">
                  Product
                </a>
                <a href=\"\">
                  Testimonial
                </a>
                <a href=\"contact.php\">
                  Contact us
                </a>
              </div>
            </div>
          </div>
          <div class=\"col-md-6 col-lg-3\">
            <div class=\"info_detail\">
              <h4>
                Company
              </h4>
              <p class=\"mb-0\">
                KNI Crunchy Enterprise </p>
            </div>
          </div>
          <div class=\"col-md-6 col-lg-3\">
            <h4>
              Contact Us
            </h4>
            <div class=\"info_contact\">
              <a href=\"\">
                <i class=\"fa fa-map-marker\" aria-hidden=\"true\"></i>
                <span>
                  Location: No 182, Felda Krau Satu, 27607 Raub, Pahang.
                </span>
              </a>
              <a href=\"\">
                <i class=\"fa fa-phone\" aria-hidden=\"true\"></i>
                <span>
                  Call +0169985744
                </span>
              </a>
              <a href=\"\">
                <i class=\"fa fa-envelope\"></i>
                <span>
                  kni01@gmail.com
                </span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
<!-- end info_section -->

  <!-- jQery -->
  <script  src=\"js/jquery-3.4.1.min.js\"></script>
  <!-- bootstrap js -->
  <script  src=\"js/bootstrap.js\"></script>
  <!-- slick slider -->
  <script  src=\"https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.5.9/slick.min.js\"></script>
  <!-- custom js -->
  <script  src=\"js/custom.js\"></script>
  <!-- Google Map -->
  <script src=\"https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap\"></script>
  <!-- End Google Map -->

";
echo $element;
}

function headerkni(){
	$element="

  <!-- bootstrap core css -->
  <link rel=\"stylesheet\" type=\"text/css\" href=\"css/bootstrap.css\" />
  <!-- Custom styles for this template -->
  <link href=\"css/style.css\" rel=\"stylesheet\" />

  <div class=\"main_body_content\">
  <!-- header section strats -->
  <header class=\"header_section\">
    <div class=\"container-fluid\">
          <nav class=\"navbar navbar-expand-lg custom_nav-container\">
            <a class=\"navbar-brand\" href=\"index.php\">KNI Shop</a>
            <div class=\"collapse navbar-collapse\" id=\"navbarSupportedContent\">
         <div class=\"quote_btn-container\">
                  <li style=\"color:black;\" class=\"fa fa-user\" aria-hidden=\"true\">
            <li class=\"dropdown\">
            <button class=\"dropbtn\">▼</button>
          <ul class=\"dropdown-content\">
            <a href=\"index.html\">LOGOUT</a>
          </ul>
          </li>
          </li>
      </div>
        <ul class=\"navbar-nav ml-auto\">
          <li class=\"nav-item active\"> <a class=\"nav-link\" href=\"index.php\">Home <span class=\"sr-only\">(current)</span></a>
          </li>
          <li class=\"nav-item\"><a class=\"nav-link\" href=\"about.php\"> About</a>
          </li>
          <li class=\"nav-item\">
            <a class=\"nav-link\" href=\"product1.php\">PRODUCT</a>
          </li>
          <li class=\"nav-item\">
           <a class=\"nav-link\" href=\"index.php\">Testimonial</a>
          </li>
          <li class=\"nav-item\">
            <a class=\"nav-link\" href=\"contact.html\">Contact Us</a>
          </li>
        </ul>
    </div>
  </nav>
</header>
</div>

";
echo $element;
}
?>
