<?php 
include("header.php");
?>

<?php
include("side_menu.php");
?>

<!--protection-->
<?php 
if(!isset($_SESSION["admin_logged_in"])) {
    header("location: login.php");
    exit;
}?>

    
  </body>
</html>