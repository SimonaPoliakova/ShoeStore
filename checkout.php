<?php

session_start();
if(!empty($_SESSION["cart"])){ //if cart is not empty, let user in

    //send user to homepage
}else{
    header("location: index.php"); 
}

?>

<!--header-->
<?php include("layouts/header.php"); ?>

<!--checkout-->
<section class="my-5 py-5">
    <div class="text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Checkout</h2>

    </div>

    <div class="mx-auto container">
        <form id="checkout-form" method="POST" action="server/place_order.php">
        <p class="text-center" style="color: red;"><?php if(isset($_GET["message"])){ echo $_GET["message"]; }?>
            
            </p>

            <div class="form-group checkout-small-element">
                <label>Name</label>
                <input type="text" class="form-control" id="checkout-name" name="name" placeholder="Name" required>
            </div>

            <div class="form-group checkout-small-element">
                <label>Email</label>
                <input type="text" class="form-control" id="checkout-email" name="email" placeholder="Email" required>
            </div>

            <div class="form-group checkout-small-element">
                <label>Phone</label>
                <input type="tel" class="form-control" id="checkout-phone" name="phone" placeholder="Phone" required>
            </div>

            <div class="form-group checkout-small-element">
                <label>City</label>
                <input type="text" class="form-control" id="checkout-city" name="city" placeholder="City" required>
            </div>

            <div class="form-group checkout-large-element">
                <label>Address</label>
                <input type="text" class="form-control" id="checkout-address" name="address" placeholder="Address" required>
            </div>

            <div class="form-group checkout-btn-container">
                <p>Total amount: € <?php echo $_SESSION["total"]?> </p>
                <input type="submit" class="btn" id="checkout-btn" name="place_order" value="Place Order">
            </div>

        </form>
    </div>
</section>

<!--footer-->
<?php include("layouts/footer.php"); ?>