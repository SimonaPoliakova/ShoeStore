<?php 

session_start();

  //calculate total
  calculateTotalCart();

if(isset($_POST["add_to_cart"])) {

  //if product was already added to cart
  if(isset($_SESSION["cart"])) {

    $products_array_ids = array_column($_SESSION["cart"],"product_id");
    //if product has been added to cart or not
    if(!in_array($_POST["product_id"], $products_array_ids)) {
    
      $product_id = $_POST["product_id"];

        $product_array = array(
          "product_id" => $_POST["product_id"],
          "product_name" =>$_POST["product_name"],
          "product_price" => $_POST["product_price"],
          "product_image" => $_POST["product_image"],
          "product_quantity" => $_POST["product_quantity"]
      );
  
     $_SESSION["cart"][$_POST["product_id"]] = $product_array; 

      //if product has already been added
    } else {
      echo "<script>alert('Product was already added to cart');</script>";
    }
 
  //if this is the first product
  } else {

      $product_id = $_POST["product_id"];
      $product_name = $_POST["product_name"];
      $product_price = $_POST["product_price"];
      $product_image = $_POST["product_image"];
      $product_quantity = $_POST["product_quantity"];

      $product_array = array(
        "product_id" => $product_id,
        "product_name" => $product_name,
        "product_price" => $product_price,
        "product_image" => $product_image,
        "product_quantity" => $product_quantity
    );

   $_SESSION["cart"][$product_id] = $product_array; 
   // special id to each array
  }

//remove from cart
}else if(isset($_POST["remove_product"])){

  $product_id = $_POST["product_id"];
  unset($_SESSION["cart"][$product_id]);

  //calculate total
  calculateTotalCart();


}else if(isset($_POST["edit_quantity"])){ 
  //get id and quantity from the form
  $product_id = $_POST["product_id"];
  $product_quantity = $_POST["product_quantity"];
  
  //get product array from the session
  $product_array = $_SESSION["cart"][$product_id];

  //old_quantity = new quantity
  $product_array["product_quantity"] = $product_quantity;

  $_SESSION["cart"][$product_id] = $product_array; 

  //calculate total
  calculateTotalCart();


} else {
  header("location: index.php");
}

function calculateTotalCart(){

  $total = 0;
  foreach($_SESSION["cart"] as $key => $value){

    $product = $_SESSION["cart"][$key];
    
    $price = $product["product_price"];
    $quantity = $product["product_quantity"];

    $total = $total + ($price * $quantity);

  }

  $_SESSION["total"] = $total;
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <link rel="stylesheet" href="assets/css/style.css"/>
</head>
<body>

   <!--navbar-->
   <nav class="navbar navbar-expand-lg navbar-light bg-light py-3 fixed-top">
    <div class="container">
        <img src="assets/img/logo.png" height="40"/>
        <a class="navbar-brand" href="index.html">Shoe Store</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="text-center collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-1 my-2">
                <li class="nav-item">
                    <a class="nav-link" href="index.html">Home</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownShop" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Shop
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownShop">
                        <a class="dropdown-item" href="women.html">Women's shoes</a>
                        <a class="dropdown-item" href="men.html">Men's shoes</a>
                        <a class="dropdown-item" href="kids.html">Kids's shoes</a>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="bestsellers.html">Bestsellers</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="about.html">About</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="contact.html">Contact us</a>
                </li>

                <li class="nav-item">
                    <a href="cart.html"><i class="nav-btns fas fa-shopping-bag"></i></a>
                    <a href="account.html"><i class="nav-btns fas fa-user"></i></a>
                </li>

            </ul>
        </div>
    </div>
</nav>

<!--cart-->
<main>
<div class="cart" id="cart">
    <h2>Your Cart</h2>
     <div class="cart-items">

    <?php foreach($_SESSION["cart"] as $key => $value) { ?>

      <div class="cart-row">
        <div class="cart-item cart-column">
          <img class="cart-item-image" src="assets/img/<?php echo $value['product_image']; ?>" alt="item">
          <span class="cart-item-title"><?php echo $value['product_name']; ?></span>
        </div>
        <span class="cart-price cart-column">€<?php echo $value['product_price']; ?></span>
        <div class="cart-quantity cart-column">
         
          
          <form method="POST" action="cart.php">
           <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
           <input type="submit" name="remove_product" class="btn btn-danger" value="remove">
          </form> 

          <form method="POST" action="cart.php">
            <input class="btn-edit" value="edit" name="edit_quantity" class="btn btn-edit" type="submit">
            <input class="cart-quantity-input" name="product_quantity" type="number" value="<?php echo $value["product_quantity"];?>">
            <input type="hidden" name="product_id" value="<?php echo $value["product_id"]?>">
          </form>

        </div>
      </div>

      <?php } ?>
      
      <div class="cart-total">
        <strong class="cart-total-title">Total</strong>
        <span class="cart-total-price">€<?php echo $_SESSION["total"]; ?></span>
      </div>
      <form method="POST" action="checkout.php">
         <input class="btn btn-primary btn-purchase" type="submit" value="CHECKOUT" name="checkout">
      </form>
    </div>
  </div>
    </main>
  
    <!--footer-->
    <footer id="footer">
        <div class="container">
          <div class="row">
            <div class="col-md-3">
              <h6 class="footer-column-title">Shop</h6>
              <ul class="list-unstyled footer-links">
                <li><a href="women.html">Women's Shoes</a></li>
                <li><a href="men.html">Men's Shoes</a></li>
                <li><a href="kids.html">Kids' Shoes</a></li>
              </ul>
            </div>
            <div class="col-md-3">
              <h6 class="footer-column-title">Company</h6>
              <ul class="list-unstyled footer-links">
                <li><a href="about.html">About Us</a></li>
              </ul>
            </div>
            <div class="col-md-3">
              <h6 class="footer-column-title">Contact Us</h6>
              <ul class="list-unstyled footer-contact-info">
                <li><i class="fas fa-map-marker-alt"></i>123 Main St, Anytown USA</li>
                <li><i class="fas fa-phone"></i>(123) 456-7890</li>
                <li><i class="fas fa-envelope"></i><a href="mailto:info@example.com">email@example.com</a></li>
              </ul>
            </div>
            <div class="col-md-3">
              <h6 class="footer-column-title">Follow Us</h6>
              <ul class="list-unstyled footer-social-icons">
                <li><a href="https://www.facebook.com/"><i class="fab fa-facebook"></i></a></li>
                <li><a href="https://twitter.com/?lang=en"><i class="fab fa-twitter"></i></a></li>
                <li><a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
      
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>