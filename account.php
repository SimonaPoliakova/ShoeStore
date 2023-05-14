<?php

session_start();
include("server/connection.php");

if(!isset($_SESSION["logged_in"])){
    header("location: login.php");
    exit;
}

if(ISSET($_GET["logout"])){
    if(isset($_SESSION["logged_in"])){
        unset($_SESSION["logged_in"]);
        unset($_SESSION["user_email"]);
        unset($_SESSION["user_name"]);
        header("location: login.php");
        exit;    
    }
}

//change password 
if(isset($_POST["change_password"])){

        $password = $_POST["password"];
        $confirmPassword = $_POST["confirmPassword"];
        $user_email = $_POST["user_email"];

        //if passwords match
        if($password !== $confirmPassword){
            header("location: account.php?error=Passswords do not match");
        }

        //if the  password is shorter than 6
        else if(strlen($password) < 6){
            header("location: account.php?error=Password must be at least 6 characters long");

        //no errors
        } else {
        
            $stmt = $conn->prepare("UPDATE users SET user_password=? WHERE user_email=?");
            $stmt->bind_param("ss",md5($password),$user_email);

            if($stmt->execute()){
                header("location: account.php?message=Password has been changed successfully");
            }else{
                header("location: account.php?error=Could not change the password");
            }
        }

}

//orders
if(isset($_SESSION["logged_in"])){

    $user_id = $_SESSION["user_id"];
    $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id=?");
    $stmt->bind_param("i",$user_id);
    $stmt->execute();
    $orders = $stmt->get_result();

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
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

<!--account-->
<section class="my-5 py-5">
    <div class="row container mx-auto">
        <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
        <p class="text-center" style="color:green"><?php if(isset($_GET["register_success"])){ echo $_GET["register_success"];} ?></p>
        <p class="text-center" style="color:green"><?php if(isset($_GET["login_success"])){ echo $_GET["login_success"];} ?></p> 
            <h3 class="font-weight-bold">Account info</h3>
            <hr class="mx-auto">
            <div class="account-info">
                <p>Name: <span><?php if(isset($_SESSION["user_name"])){echo $_SESSION["user_name"];} ?></span></p>
                <p>Email: <span><?php if(isset($_SESSION["user_email"])){echo $_SESSION["user_email"];} ?></span></p>
                <p><a href="#orders" id="orders-btn">Your orders</a></p>
                <p><a href="account.php?logout=1" id="logout-btn">Logout</a></p>
            </div>
        </div>

        <div class="col-lg-6 col-md-12 col-sm-12">
            <form id="account-form" method="POST" action="account.php">
                <p class="text-center" style="color:red"><?php if(isset($_GET["error"])){ echo $_GET["error"];} ?></p>
                <p class="text-center" style="color:green"><?php if(isset($_GET["message"])){ echo $_GET["message"];} ?>
                <h3>Change Password</h3>
                <hr class="mx-auto">
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" id="account-password" name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" id="account-password-confirm" name="confirmPassword" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <input type="submit" value="Change Password" class="btn" id="change-pass-btn" name="change_password">
                </div>
            </form>
        </div>
    </div>
</section>

<!--orders-->
<main>
<section id="orders" class="orders container my-5 py-3">
    <div class=" orders_h2 container mt-2">
        <h2 class="font-weight-bold text-center">Your Orders</h2>
</div>

<table class="mt-5 pt-5">
    <tr>
        <th>Order id</th>
        <th>Order cost</th>
        <th>Order status</th>
        <th>Order date</th>
        <th>Order details</th>
    </tr>
    
    <?php while($row = $orders->fetch_assoc()){?>
            <tr>
            <td>
                <div class="product-info">
                    <div>
                        <p class="mt-3"><?php echo $row["order_id"]; ?></p>
                    </div>
                </div>
            </td>

            <td>
                <span><?php echo $row["order_cost"]; ?></span>
            </td>

            <td>
                <span><?php echo $row["order_status"]; ?></span>
            </td>

            <td>
                <span><?php echo $row["order_date"]; ?></span>
            </td>

            <td>
                <form method="POST" action="order_details.php">
                    <input type="hidden" value="<?php echo $row["order_status"]; ?>" name="order_status">
                    <input type="hidden" value="<?php echo $row["order_id"]; ?>" name="order_id">
                    <input class="btn order-details-btn" name="order_details_btn" type="submit" value="details">
                </form>
            </td>

        </tr>
    <?php } ?>

</table>
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