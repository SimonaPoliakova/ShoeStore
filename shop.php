<?php

include("server/connection.php");

$stmt = $conn->prepare("SELECT * FROM products");

$stmt->execute();

$products = $stmt->get_result();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Women</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <link rel="stylesheet" href="assets/css/style.css"/>
</head>
<body>

   <!--navbar-->
<nav class="navbar navbar-expand-lg navbar-light bg-light py-3 fixed-top">
    <div class="container">
        <img src="assets/img/logo.png" height="40"/>
        <a class="navbar-brand" href="index.php">Shoe Store</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="text-center collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-1 my-2">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
  
                <li class="nav-item">
                    <a class="nav-link" href="shop.php">Shop</a>
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
                    <a href="cart.php"><i class="nav-btns fas fa-shopping-bag"></i></a>
                    <a href="account.html"><i class="nav-btns fas fa-user"></i></a>
                </li>
  
            </ul>
        </div>
    </div>
  </nav>
  

     <!--shop-->
     <section id="featured" class="my-5 pb-5">
        <div class="container text-center mt-5 py-5">
            <br>
            <h3>Shop</h3>
            <hr>
                
        <div class="row mx-auto container-fluid">

        <?php while($row = $products->fetch_assoc()) {?>

            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3" src="assets/img/<?php echo $row["product_image"]; ?>"/>
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h5 class="p-name"><?php echo $row["product_name"]; ?></h5>
                <h4 class="p-price"><?php echo $row["product_price"]; ?></h4>
                <a class="btn buy-btn" href="single_product.php?product_id=<?php echo $row["product_id"];?>">Buy Now</a>
            </div>

            <?php } ?>

        </div>
        

        
        </div>
    </section>

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