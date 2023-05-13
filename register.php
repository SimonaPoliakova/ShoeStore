<?php 

session_start();
include("server/connection.php");

//if user is already registered, take him to account page
if(isset($_SESSION["logged_in"])){
    header("location: account.php");
    exit;
}

if(isset($_POST["register"])){

        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirmPassword"];

        //if passwords match
        if($password !== $confirmPassword){
            header("location: register.php?error=Passswords do not match");
        }

        //if the  password is shorter than 6
        else if(strlen($password) < 6){
            header("location: register.php?error=Password must be at least 6 characters long");
    }

//if there is no error
else {
        //check if there is user with this email or not
        $stmt1 = $conn->prepare("SELECT count(*) FROM users WHERE user_email=?");
        $stmt1->bind_param("s", $email);
        $stmt1->execute();
        $stmt1->bind_result($num_rows);
        $stmt1->store_result();
        $stmt1->fetch();

        if($num_rows != 0){
            header("location: register.php?error=User with this email already exists");
        }

        else{
            //create new user
            $stmt = $conn->prepare("INSERT INTO users(user_name, user_email, user_password)
            VALUES(?, ?, ?)");

            $stmt->bind_param("sss", $name, $email, md5($password));

            //account was created
            if($stmt->execute()){
                $_SESSION["user_email"] = $email;
                $_SESSION["user_name"] = $name;
                $_SESSION["logged_in"] = true;
                header("location: account.php?register_success=Registration was successful");
            //account could not be created
            }else{
                header("location: register.php?error=Could not create an account");
            }
        }      
    }
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
                    <a href="cart.php"><i class="nav-btns fas fa-shopping-bag"></i></a>
                    <a href="account.html"><i class="nav-btns fas fa-user"></i></a>
                </li>

            </ul>
        </div>
    </div>
</nav>

<!--register-->
<section class="my-5 py-5">
    <div class="text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Register</h2>

    </div>

    <div class="mx-auto container">
        <form id="register-form" method="POST" action="register.php">
            <p style="color: red;"><?php if(isset($_GET["error"])){ echo $_GET["error"]; }?></p>

            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" id="register-name" name="name" placeholder="Name" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" id="register-email" name="email" placeholder="Email" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" id="register-password" name="password" placeholder="Password" required>
            </div>

            <div class="form-group">
                <label>Confirm password</label>
                <input type="password" class="form-control" id="register-confirm-password" name="confirmPassword" placeholder="ConfirmPassword" required>
            </div>

            <div class="form-group">
                <input type="submit" class="btn" id="register-btn" value="Register" name="register">
            </div>

            <div class="form-group">
               <a id="login-url" href="login.php" class="btn">Do you have an account? Log in</a>
            </div>

        </form>
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