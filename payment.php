<?php
include("server/connection.php");
session_start();

if(isset($_POST["order_pay_btn"])){
    $order_status = $_POST["order_status"];
    $total_order_price = $_POST["total_order_price"];
}

?>

<!--header-->
<?php include("layouts/header.php"); ?>

<!--payment-->
<section class="payment" class="my-5 py-5">
    <div class="text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Payment</h2>
    </div>
    <div class="mx-auto container text-center">

        <?php if(isset($_SESSION["total"]) && $_SESSION["total"] != 0){?>
        <p>Total payment: €<?php echo $_SESSION["total"]; ?></p>
        <input class="btn btn-primary" type="submit" value="Pay Now">

        <?php } else if(isset($_POST["order_status"]) && $_POST["order_status"] == "pending payment") {?>
            <p>Total payment: €<?php echo $_POST["total_order_price"]; ?></p>
            <input class="btn btn-primary" type="submit" value="Pay Now">
            <?php } else { ?>
                <p>Your cart is empty</p>
            <?php } ?>
        

    </div>
</section>

<!--footer-->
<?php include("layouts/footer.php"); ?>