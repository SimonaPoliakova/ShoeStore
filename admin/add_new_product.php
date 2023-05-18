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
        <h1 class="h1">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
          </div>
        </div>
      </div>
      <h2 class="form-weight-bold">Add Product</h2>

           <!--addproduct form-->

           <form id="add-product-form" enctype="multipart/form-data" method="POST" action="add_product.php">
                       
                       <div class="form-group">
                           <label><b>Product Name</b></label>
                           <input type="text" class="form-control" id="product-name" name="product_name" placeholder="ProductName" value="">
                       </div>
   
                       <div class="form-group">
                           <label><b>Product Description</></label>
                           <input type="text" class="form-control" id="product-description" name="product_description" placeholder="ProductDescription" value="">
                       </div>
   
                       <div class="form-group">
                           <label><b>Product Price</b></label>
                           <input type="text" class="form-control" id="product-price" name="product_price" placeholder="ProductPrice" value="">
                       </div>
   
                       <div class="form-group">
                           <label><b>Product Color</b></label>
                           <input type="text" class="form-control" id="product-color" name="product_color" placeholder="ProductColor" value="">
                       </div>

                       <div class="form-group">
                           <label><b>Product Image 1</b></label>
                           <input type="file" class="form-control" id="product-image1" name="image1" placeholder="ProductColor" value="">
                       </div>

                       <div class="form-group">
                           <label><b>Product Image 2 </b></label>
                           <input type="file" class="form-control" id="product-image2" name="image2" placeholder="ProductColor" value="">
                       </div>

                       <div class="form-group">
                           <label><b>Product Image 3</b></label>
                           <input type="file" class="form-control" id="product-image3" name="image3" placeholder="ProductColor" value="">
                       </div>

                       <div class="form-group">
                           <label><b>Product Image 4</b></label>
                           <input type="file" class="form-control" id="product-image4" name="image4" placeholder="ProductColor" value="">
                       </div>
   
                       <div class="form-group">
                           <input type="submit" class="btn btn-primary" value="Add Product" name="add_product">
                       </div>

                       

             </form>
    </main>
  </div>
</div>


      
  </body>
</html>