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
      $stmt = $conn->prepare("SELECT COUNT(*) AS total_records FROM orders");
      $stmt->execute();
      $stmt->bind_result($total_records);
      $stmt->store_result();
      $stmt->fetch();

      //products per page
      $total_records_per_page = 8;
      $offset = ($page_no-1) * $total_records_per_page;
      $total_no_of_pages = ceil($total_records / $total_records_per_page);

      $previous_page = $page_no - 1;
      $next_page = $page_no + 1;

      $neighbours = "2";

    

      //get all products
      $stmt2 = $conn->prepare("SELECT * FROM orders LIMIT $offset,$total_records_per_page");
      $stmt2->execute();
      $orders = $stmt2->get_result();
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
      
      <h2>Orders</h2>

      <div class="table-container">
        <div class="table-responsive">
          <table class="table table-striped table-sm">
            <thead>
            <tr>
              <th scope="col">Order Id</th>
              <th scope="col">Order Status</th>
              <th scope="col">User Id</th>
              <th scope="col">Order Date</th>
              <th scope="col">User Phone</th>
              <th scope="col">User Address</th>
              <th scope="col">Edit</th>
              <th scope="col">Delete</th>
            </tr>
            </thead>
            <tbody>
              <?php foreach($orders as $order) { ?>
                <tr>
        <td><?php echo $order["order_id"]; ?></td>
        <td><?php echo $order["order_status"]; ?></td>
        <td><?php echo $order["user_id"]; ?></td>
        <td><?php echo $order["order_date"]; ?></td>
        <td><?php echo $order["user_phone"]; ?></td>
        <td><?php echo $order["user_address"]; ?></td>
        <td><a id="orders" class="btn btn-primary">Edit</a></td>
        <td><a id="orders" class="btn btn-danger">Delete</a></td>
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