<?php 
include("header.php");
?>

<?php 

      //determine page number
      if(isset($_GET["page_no"]) && $_GET["page_no"] != ""){
        //the page number is the one user selected
        $page_no = $_GET["page_no"];
      } else {
        //default page is 1
        $page_no = 1;
      }

      //return number of orders
      $stmt = $conn->prepare("SELECT COUNT(*) AS total_records FROM products");
      $stmt->execute();
      $stmt->bind_result($total_records);
      $stmt->store_result();
      $stmt->fetch();

      //products per page
      $total_records_per_page = 5;
      $offset = ($page_no-1) * $total_records_per_page;
      $total_no_of_pages = ceil($total_records / $total_records_per_page);

      $previous_page = $page_no - 1;
      $next_page = $page_no + 1;

      //get all products
      $stmt2 = $conn->prepare("SELECT * FROM products LIMIT $offset,$total_records_per_page");
      $stmt2->execute();
      $products = $stmt2->get_result();
?>

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
      
      <h2>Products</h2>
      <?php if(isset($_GET["edit_success_message"])) { ?>
        <p class="text-center" style="color: green;"><?php echo $_GET["edit_success_message"]; ?></p>
      <?php } ?>

      <?php if(isset($_GET["edit_failure_message"])) { ?>
        <p class="text-center" style="color: red;"><?php echo $_GET["edit_failure_message"]; ?></p>
      <?php } ?>

      <div class="table-container">
        <div class="table-responsive">
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th scope="col">Product Id</th>
                <th scope="col">Product Image</th>
                <th scope="col">Product Name</th>
                <th scope="col">Product Price</th>
                <th scope="col">Product Color</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach($products as $product) { ?>
                <tr>
                  <td><?php echo $product["product_id"]; ?></td>
                  <td><img src="<?php echo '../assets/img/'.$product["product_image"]; ?>" style="width: 70px; height: 70px;"></td>
                  <td><?php echo $product["product_name"]; ?></td>
                  <td><?php echo "€".$product["product_price"]; ?></td>
                  <td><?php echo $product["product_color"]; ?></td>
                  <td><a class="btn btn-primary" href="edit_product.php?product_id=<?php echo $product["product_id"];?>">Edit</a></td>
                  <td><a class="btn btn-danger">Delete</a></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>

        <nav aria-label="Page navigation example" class="mx-auto">
          <ul class="pagination mt-3 mx-auto">
          <li class="page-item <?php if ($page_no <= 1) {
                    echo "disabled";
                } ?>">
                    <a class="page-link"
                        href="<?php if ($page_no <= 1) {
                            echo "#";
                        } else {
                            echo "?page_no=" . ($page_no - 1);
                        } ?>">Previous</a>
                </li>
                <?php
                for ($i = 1; $i <= $total_no_of_pages; $i++) {
                    if ($i == $page_no) {
                        echo "<li class='page-item active'><a class='page-link' href='?page_no=$i'>$i</a></li>";
                    } else {
                        echo "<li class='page-item'><a class='page-link' href='?page_no=$i'>$i</a></li>";
                    }
                }
                ?>
        
                <li class="page-item <?php if ($page_no >= $total_no_of_pages) {
                    echo "disabled";
                } ?>">
                    <a class="page-link"
                        href="<?php if ($page_no >= $total_no_of_pages) {
                            echo "#";
                        } else {
                            echo "?page_no=" . ($page_no + 1);
                        } ?>">Next</a>
                </li>
          </ul>
        </nav>
        
      </div>
    </main>
  </div>
</div>

             



  </body>
</html>