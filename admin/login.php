<?php 

include("header.php");
include("../server/connection.php");

if(isset($_SESSION["admin_logged_in"])){
  header("location: admin.php");
  exit;
}

if(isset($_POST["login_btn"])){

  $email = $_POST["email"];
  $password = md5($_POST["password"]);

  $stmt = $conn->prepare("SELECT admin_id, admin_name, admin_email, admin_password FROM admins WHERE admin_email=? AND admin_password=? LIMIT 1");

  $stmt->bind_param("ss", $email, $password);

  if($stmt->execute()){
    $stmt->bind_result($admin_id,$admin_name,$admin_email,$admin_password);
    $stmt->store_result();

    if($stmt->num_rows()==1){
     $stmt->fetch();

     $_SESSION["admin_id"] = $admin_id;
     $_SESSION["admin_name"] = $admin_name;
     $_SESSION["admin_email"] = $admin_email;
     $_SESSION["admin_logged_in"] = true;

     header("location: admin.php?login_success=Logged in successfully");

    }else{
      header("location: login.php?error=Could not verify your account");
    }

  }else{
    //error
    header("location: login.php?error=Something went wrong");

  }
}

?>


<!--login-->
<section class="my-5 py-5">
    <div class="text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Admin Login</h2>

    </div>

    <div class="mx-auto container">
        <form id="login-form" action="login.php" method="POST">
        <p style="color:red" class="text-center"><?php if(isset($_GET["error"])){echo $_GET["error"];} ?></p>

            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" id="login-email" name="email" placeholder="Email" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" id="login-password" name="password" placeholder="Password" required>
            </div>

            <div class="form-group">
                <input type="submit" class="btn" name="login_btn" id="login-btn" value="Login ">
            </div>

        </form>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>