<!--header-->
<?php include("layouts/header.php"); ?>

    <!--Home-->
    <section id="home">
        <div class="container">
            <h5>NEW ARRIVALS</h5>
            <h1><span>Best Prices</span> This Season</h1>
            <p>Eshop offers the best products for the most afforable prices</p>
            <a href="bestsellers.html"><button class="btn">Shop now</button></a>
        </div>
    </section>

    <!--Brands-->
    <section id="brand" class="container">
        <div class="row justify-content-center">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <img class="img-fluid" src="assets/img/brand1.png">
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <img class="img-fluid" src="assets/img/brand2.jpg">
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <img class="img-fluid" src="assets/img/brand3.jpg">
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <img class="img-fluid" src="assets/img/brand4.jpg">
            </div>
        </div>
    </section>

    <!--New-->
    <section id="new" class="w-100">
        <div class="row p-0 m-0">
            <!--One-->
            <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img class="img-fluid" src="assets/img/11.jpg"/>
                <div class="details">
                    <h2>'One Piece' x Vans Sneaker Collaboration</h2>
                    <a href="vans_onepiece.html" title="Čítať viac">
                        Read more >
                        <i class="icon-right-open"></i>
                    </a>
                </div>
            </div>

            <!--Two-->
            <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img class="img-fluid" src="assets/img/22.jpg"/>
                <div class="details">
                    <h2>FILA Drops Footwear to Celebrate 'Rocko's Modern Life'</h2>
                    <a href="fila_rocko.html" title="Čítať viac">
                        Read more >
                        <i class="icon-right-open"></i>
                    </a>
                </div>
            </div>

            <!--Three -->
            <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
                <img class="img-fluid" src="assets/img/33.jpg"/>
                <div class="details">
                    <h2>adidas x Arsenal release French collection to mark 20 years since Invincibles season</h2>
                    <a href="adidas_arsenal.html" title="Čítať viac">
                        Read more >
                        <i class="icon-right-open"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!--Featured-->
    <section id="featured" class="my-5 pb-5">
        <div class="container text-center mt-5 py-5">
            <h3>Featured</h3>
            <hr class="mx-auto">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam nisi sapiente iure consequuntur, aspernatur culpa optio iusto distinctio itaque nostrum obcaecati laborum? Distinctio quia, adipisci officiis inventore a placeat sunt.</p>
        <div class="row mx-auto container-fluid">

        <?php include("server/get_featured_products.php"); ?>

        <?php while($row = $featured_products->fetch_assoc()){?>


            <div class="product text-center col-lg-3 col-md-4 col-sm-12">
                <img class="img-fluid mb-3" src="assets/img/<?php echo $row["product_image"] ?>"/>
                <div class="star">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <h5 class="p-name"> <?php echo $row["product_name"] ?> </h5>
                <h4 class="p-price"> <?php echo $row["product_price"] ?> </h4>
                <a href="<?php echo "single_product.php?product_id=". $row["product_id"]; ?>"><button class="buy-btn">Buy Now</button></a>
            </div>

            <?php } ?>

        </div>
        </div>
    </section>

    <!--Banner-->
    <section id="banner" class="my-5 py-5">
        <div class="container">
            <h4>SEASON'S SALE</h4>
            <h1>Spring Collection <br> UP to 30% OFF</h1>
            <a href="bestsellers.html"><button class="text-uppercase">shop now</button></a>
        </div>
    </section>

<!--footer-->
 <?php include("layouts/footer.php"); ?>