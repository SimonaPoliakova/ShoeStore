<?php include("header.php"); ?>

<!--protection-->
<?php 
if(!isset($_SESSION["admin_logged_in"])) {
    header("location: login.php");
    exit;
}?>

<?php

 //get all products
 if(isset($_GET["product_id"])) {
        $product_id = $_GET["product_id"];
        $stmt = $conn->prepare("SELECT * FROM products WHERE product_id=?");
        $stmt->bind_param("i",$product_id);
        $stmt->execute();
        $products = $stmt->get_result();

 } else if(isset($_POST["edit_btn"])) {

        $product_id = $_POST["product_id"];
        $title = $_POST["title"];
        $description = $_POST["description"];
        $price = $_POST["price"];
        $color = $_POST["color"];

        $stmt = $conn->prepare("UPDATE products SET product_name=?, product_description=?, product_price=?, product_color=? WHERE product_id=?");
        $stmt->bind_param("ssssi",$title, $description, $price, $color, $product_id);

        if($stmt->execute()) {
            header("location: products.php?edit_success_message=Product has been updated successfully");
        } else {
            header("location: products.php?edit_failure_message=Error occured, try again");
        }

 } else {
        header("products.php");
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
      <h2 class="form-weight-bold">Edit Product</h2>
            <!--edit product form-->

                <form id="edit-product-form" method="POST" action="edit_product.php">
                   
                <?php foreach($products as $product) { ?>

                    <input type="hidden" name="product_id" value="<?php echo $product["product_id"];?>">
                    
                    <div class="form-group">
                        <label>Product Name</label>
                        <input type="text" class="form-control" id="product-name" name="title" placeholder="ProductName" value="<?php echo $product["product_name"]?>">
                    </div>

                    <div class="form-group">
                        <label>Product Description</label>
                        <input type="text" class="form-control" id="product-description" name="description" placeholder="ProductDescription" value="<?php echo $product["product_description"]?>">
                    </div>

                    <div class="form-group">
                        <label>Product Price</label>
                        <input type="text" class="form-control" id="product-price" name="price" placeholder="ProductPrice" value="<?php echo $product["product_price"]?>">
                    </div>

                    <div class="form-group">
                        <label>ProductColor</label>
                        <input type="text" class="form-control" id="product-color" name="color" placeholder="ProductColor" value="<?php echo $product["product_color"]?>">
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" id="edit-btn" value="Edit" name="edit_btn">
                    </div>

                    <?php } ?>

                </form>
          
            
       
    </main>
  </div>
</div>


      
  </body>
</html>