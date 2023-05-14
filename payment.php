<?php

session_start();

?>

<!--header-->
<?php include("layouts/header.php"); ?>

<!--payment-->
<section class="my-5 py-5">
    <div class="text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Payment</h2>
    </div>
    <div class="mx-auto container text-center">
        <p><?php if(isset($_GET["order_status"])){echo $_GET["order_status"];}?></p>
        <p>Total payment: €<?php if (isset($_SESSION["total"])) {echo $_SESSION["total"];}?></p>

        <?php if(isset($_SESSION["total"])) { ?>
             <input class="btn btn-primary" type="submit" value="Pay Now">
        <?php } ?>

        <?php if(isset($_GET["order_status"]) && $_GET["order_status"] == "pending payment") { ?>
             <input class="btn btn-primary" type="submit" value="Pay Now">
        <?php } ?>

    </div>
</section>

<!--footer-->
<?php include("layouts/footer.php"); ?>