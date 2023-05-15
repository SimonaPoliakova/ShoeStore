<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoe Store</title>
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
                  <a class="nav-link" href="bestsellers.php">Bestsellers</a>
              </li>

              <li class="nav-item">
                  <a class="nav-link" href="about.php">About</a>
              </li>

              <li class="nav-item">
                  <a class="nav-link" href="contact.php">Contact us</a>
              </li>

              <li class="nav-item">
                  <a href="cart.php"><i class="nav-btns fas fa-shopping-bag">
                    <?php if(isset($_SESSION["quantity"]) && $_SESSION["quantity"] != 0){ ?>
                        <span class="cart_quantity"><?php echo $_SESSION["quantity"]; ?></span>
                    <?php } ?>
                </i></a>
                  <a href="account.php"><i class="nav-btns fas fa-user"></i></a>
              </li>

          </ul>
      </div>
  </div>
</nav>
