<?php include("header.php"); ?>

<!--protection-->
<?php 
if(!isset($_SESSION["admin_logged_in"])) {
    header("location: login.php");
    exit;
}?>

<?php
//get all products
 if(isset($_GET["order_id"])) {
        $order_id = $_GET["order_id"];
        $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id=?");
        $stmt->bind_param("i",$order_id);
        $stmt->execute();
        $orders = $stmt->get_result();

 } else if(isset($_POST["edit_order"])) {

    $order_status = $_POST["order_status"];
    $order_id = $_POST["order_id"];

    $stmt = $conn->prepare("UPDATE orders SET order_status=? WHERE order_id=?");
    $stmt->bind_param("si",$order_status, $order_id);

    if($stmt->execute()) {
        header("location: admin.php?order_edit_success=Order has been updated successfully");
    } else {
        header("location: admin.php?order_edit_failure_message=Error occured, try again");
    }

} else {
    header("admin.php");
    exit; 
}

 ?>

<div class="container-fluid">
  <div class="row">
    <?php include("side_menu.php"); ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <h1 class="h1">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
          </div>
        </div>
      </div>
      <h2 class="form-weight-bold">Edit Order</h2>

            <!--edit order form-->

                <form id="edit-order-form" method="POST" action="edit_order.php">

                <?php foreach($orders as $order) { ?>
                    
                    <div class="form-group my-3">
                        <label><b>Order Id</b></label>
                        <p class=my-4><?php echo $order["order_id"]?></p>
                    </div>

                    <div class="form-group my-3">
                        <label><b>Order Price</b></label>
                        <p class=my-4><?php echo $order["order_cost"]?></p>
                    </div>

                    <input type="hidden" name="order_id" value="<?php echo $order["order_id"];?>">
                    <div class="form-group my-3">
                        <label><b>Order Status</b></label>
                        <br><br>
                        <select class="form-select" required name="order_status">
                        
                            <option value="pending payment" >Pending Payment</option>
                            <option value="paid" <?php if($order["order_status"]=="paid"){ echo "selected";} ?>>Paid</option>
                            <option value="shipped" <?php if($order["order_status"]=="shipped"){ echo "selected";} ?>>Shipped</option>
                            <option value="delivered" <?php if($order["order_status"]=="delivered"){ echo "selected";} ?>>Delivered</option>
                        </select>
                    </div>

                    <div class="form-group my-3">
                        <br><label><b>Order Date</b></label>
                        <p class=my-4><?php echo $order["order_date"]?></p>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" id="edit-btn" value="Edit" name="edit_order">
                    </div>

                    <?php } ?>

                </form>
          
            
       
    </main>
  </div>
</div>


      
  </body>
</html>