<?php

include("server/connection.php");

$stmt = $conn->prepare("SELECT * FROM products");

$stmt->execute();

$products = $stmt->get_result();

?>

<!--header-->
<?php include("layouts/header.php"); ?> 

<!--shop-->
     <section id="featured" class="my-5 pb-5">
        <div class="container text-center mt-5 py-5">
            <br>
            <h3>Bestsellers</h3>
            <hr>
                
        <div class="row mx-auto container-fluid">

        <?php while($row = $products->fetch_assoc()) {?>

            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3" src="assets/img/<?php echo $row["product_image"]; ?>"/>
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h5 class="p-name"><?php echo $row["product_name"]; ?></h5>
                <h4 class="p-price"><?php echo $row["product_price"]; ?></h4>
                <a class="btn buy-btn" href="single_product.php?product_id=<?php echo $row["product_id"];?>">Buy Now</a>
            </div>

            <?php } ?>

        </div>
        

        
        </div>
    </section>

<!--footer-->
 <?php include("layouts/footer.php"); ?>