<?php 

session_start();

// function to calculate total
function calculateTotalCart(){
  $total = 0;
  foreach($_SESSION["cart"] as $key => $value){
    $product = $_SESSION["cart"][$key];
    $price = $product["product_price"];
    $quantity = $product["product_quantity"];
    $total = $total + ($price * $quantity);
  }
  $_SESSION["total"] = $total;
}

if(isset($_POST["add_to_cart"])) {

  // if product was already added to cart
  if(isset($_SESSION["cart"])) {
    $products_array_ids = array_column($_SESSION["cart"],"product_id");

    // if product has been added to cart or not
    if(!in_array($_POST["product_id"], $products_array_ids)) {
      $product_id = $_POST["product_id"];
      $product_array = array(
        "product_id" => $product_id,
        "product_name" => $_POST["product_name"],
        "product_price" => $_POST["product_price"],
        "product_image" => $_POST["product_image"],
        "product_quantity" => $_POST["product_quantity"]
      );
      $_SESSION["cart"][$product_id] = $product_array; 

    } else {
      echo "<script>alert('Product was already added to cart');</script>";
    }
    // calculate total
    calculateTotalCart();
  } else {
    $product_id = $_POST["product_id"];
    $product_name = $_POST["product_name"];
    $product_price = $_POST["product_price"];
    $product_image = $_POST["product_image"];
    $product_quantity = $_POST["product_quantity"];
    $product_array = array(
      "product_id" => $product_id,
      "product_name" => $product_name,
      "product_price" => $product_price,
      "product_image" => $product_image,
      "product_quantity" => $product_quantity

    );
    $_SESSION["cart"][$product_id] = $product_array; 

    // calculate total
    calculateTotalCart();
  }

} else if(isset($_POST["remove_product"])){

  // remove product from cart
  $product_id = $_POST["product_id"];
  unset($_SESSION["cart"][$product_id]);

  // calculate total
  calculateTotalCart();

} else if(isset($_POST["edit_quantity"])){ 

  // edit product quantity
  $product_id = $_POST["product_id"];
  $product_quantity = $_POST["product_quantity"];
  $product_array = $_SESSION["cart"][$product_id];
  $product_array["product_quantity"] = $product_quantity;
  $_SESSION["cart"][$product_id] = $product_array; 

  // calculate total
  calculateTotalCart();

} else {
  //header("location: index.php");
}

?>

<!--header-->
<?php include("layouts/header.php"); ?>

<!--cart-->
<main>
<div class="cart" id="cart">
    <h2>Your Cart</h2>
     <div class="cart-items">

    <?php foreach($_SESSION["cart"] as $key => $value) { ?>

      <div class="cart-row">
        <div class="cart-item cart-column">
          <img class="cart-item-image" src="assets/img/<?php echo $value['product_image']; ?>" alt="item">
          <span class="cart-item-title"><?php echo $value['product_name']; ?></span>
        </div>
        <span class="cart-price cart-column">€<?php echo $value['product_price']; ?></span>
        <div class="cart-quantity cart-column">
         
          
          <form method="POST" action="cart.php">
           <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
           <input type="submit" name="remove_product" class="btn btn-danger" value="remove">
          </form> 

          <form method="POST" action="cart.php">
            <input class="btn-edit" value="edit" name="edit_quantity" class="btn btn-edit" type="submit">
            <input class="cart-quantity-input" name="product_quantity" type="number" value="<?php echo $value["product_quantity"];?>">
            <input type="hidden" name="product_id" value="<?php echo $value["product_id"]?>">
          </form>

        </div>
      </div>

      <?php } ?>
      
      <div class="cart-total">
        <strong class="cart-total-title">Total</strong>
        <span class="cart-total-price">€<?php echo $_SESSION["total"]; ?></span>
      </div>
      <form method="POST" action="checkout.php">
         <input class="btn btn-primary btn-purchase" type="submit" value="CHECKOUT" name="checkout">
      </form>
    </div>
  </div>
    </main>

  <!--footer-->
   <?php include("layouts/footer.php"); ?>