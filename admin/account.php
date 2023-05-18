<?php include("header.php"); ?>

<!--protection-->
<?php 
if(!isset($_SESSION["admin_logged_in"])) {
    header("location: login.php");
    exit;
}?>


<div class="container-fluid">
  <div class="row">
    <?php include("side_menu.php"); ?>

   <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">

        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
          </div>
        </div>
      </div>
      
      <div class="container">
      <h1 class="form-weight-bold">Admin Account</h1><br><br>
        <p><b>Id:</b> <?php echo $_SESSION["admin_id"];?></p>
        <p><b>Name:</b> <?php echo $_SESSION["admin_name"];?></p>
        <p><b>Email:</b> <?php echo $_SESSION["admin_email"];?></p>
      </div>

   </main>
  </div>
</div>

    
</body>
</html>