<?php 

include("server/connection.php");

//get single product php
if(isset($_GET["product_id"])){

    $product_id = $_GET["product_id"];
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i",$product_id);

    $stmt->execute();

    $product = $stmt->get_result();

} else { //when there is no id
    header("location: index.php");
}


?> 

<!--header-->
<?php include("layouts/header.php"); ?>

    <!--single product-->
<section class=" container single-product my-5 pt-5">
    <div class="row mt-5">

    <?php while($row = $product->fetch_assoc()){ ?>

        <div class="col-lg-5 col-md-6 col-sm-12">
            <img class="img-fluid w-100 pb-1" src="assets/img/<?php echo $row["product_image"]; ?>" id="mainImg">
            <div class="small-img-group">
                <div class="small-img-col">
                    <img src="assets/img/<?php echo $row["product_image"]; ?>" width="100%" class="small-img">
                </div>
                <div class="small-img-col">
                    <img src="assets/img/<?php echo $row["product_image2"]; ?>" width="100%" class="small-img">
                </div>
                <div class="small-img-col">
                    <img src="assets/img/<?php echo $row["product_image3"]; ?>" width="100%" class="small-img">
                </div>
                <div class="small-img-col">
                    <img src="assets/img/<?php echo $row["product_image4"]; ?>" width="100%" class="small-img">
                </div> 
            </div>
        </div>

        <div class="col-lg-6 col-md-12 col-12">
            <h6>Shoes</h6>
            <h3 class="py-4"><?php echo $row["product_name"]; ?></h3>
            <h2>€<?php echo $row["product_price"]; ?></h2>
            
            <form method="POST" action="cart.php">
                <input type="hidden" name="product_id" value="<?php echo $row["product_id"]; ?>">
                <input type="hidden" name="product_image" value="<?php echo $row["product_image"]; ?>">
                <input type="hidden" name="product_name" value="<?php echo $row["product_name"]; ?>">
                <input type="hidden" name="product_price" value="<?php echo $row["product_price"]; ?>">

            <input type="number" name="product_quantity" value="1" min="1">
            <button class="buy-btn" type="submit" name="add_to_cart">Add To Cart</button> 

            </form>

           
            <h4 class="mt-5 mb-5">Product details</h4>
            <span><?php echo $row["product_description"]; ?></span>
        </div>

        <?php } ?>
</div>
</section>

<!--related products-->
<section id="related-products" class="my-5 pb-5">
    <div class="container text-center mt-5 py-5">
        <h3>More products</h3>
        <hr class="mx-auto">
        
    <div class="row mx-auto container-fluid">

    <?php include("server/get_featured_products.php"); ?>

<?php while($row = $featured_products->fetch_assoc()){?>


        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img class="img-fluid mb-3" src="assets/img/<?php echo $row["product_image"]; ?>"/>
            <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name"><?php echo $row["product_name"] ?></h5>
            <h4 class="p-price">€<?php echo $row["product_price"] ?></h4>
        <a href="<?php echo "single_product.php?product_id=". $row["product_id"]; ?>"> <button class="buy-btn">Buy Now</button><a>
        </div>

        <?php } ?>

    </div>
    </div>
</section>

<!--footer-->
<footer id="footer">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <h6 class="footer-column-title">Shop</h6>
            <ul class="list-unstyled footer-links">
              <li><a href="shop.php">Shoes</a></li>
            </ul>
          </div>
          <div class="col-md-3">
            <h6 class="footer-column-title">Company</h6>
            <ul class="list-unstyled footer-links">
              <li><a href="about.php">About Us</a></li>
            </ul>
          </div>
          <div class="col-md-3">
            <h6 class="footer-column-title">Contact Us</h6>
            <ul class="list-unstyled footer-contact-info">
              <li><i class="fas fa-map-marker-alt"></i>123 Main St, Anytown USA</li>
              <li><i class="fas fa-phone"></i>(123) 456-7890</li>
              <li><i class="fas fa-envelope"></i><a href="mailto:info@example.com">email@example.com</a></li>
            </ul>
          </div>
          <div class="col-md-3">
            <h6 class="footer-column-title">Follow Us</h6>
            <ul class="list-unstyled footer-social-icons">
              <li><a href="https://www.facebook.com/"><i class="fab fa-facebook"></i></a></li>
              <li><a href="https://twitter.com/?lang=en"><i class="fab fa-twitter"></i></a></li>
              <li><a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
    
  
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script>

       var mainImg = document.getElementById("mainImg"); 
       var smallImg = document.getElementsByClassName("small-img")

       for(let i=0; i<4; i++){
       smallImg[i].onclick = function(){
        mainImg.src = smallImg[i].src;
       }
    }
    </script>

</body>
</html>