<?php 
session_start();
include("../server/connection.php");
?>

<!--protection-->
<?php 
if(!isset($_SESSION["admin_logged_in"])) {
    header("location: login.php");
    exit;
}?>

<?php 
if(isset($_GET["order_id"])) {
    $order_id = $_GET["order_id"];
    $stmt = $conn->prepare("DELETE FROM orders WHERE order_id=?");
    $stmt->bind_param("i",$order_id);

    if($stmt->execute()) {

        header("location: admin.php?order_delete_success=Order has been deleted successfully");

    }else {

        header("location: admin.php?order_delete_failure=Could not delete order");
    }
}
?>