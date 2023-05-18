<?php include("../server/connection.php"); ?>

<?php

//if button has been clicked
if(isset($_POST["add_product"])) {
    $product_name = $_POST["product_name"];
    $product_description = $_POST["product_description"];
    $product_price = $_POST["product_price"];
    $product_color = $_POST["product_color"];
    
    //images
    $image1 = $_FILES["image1"]["tmp_name"];
    $image2 = $_FILES["image2"]["tmp_name"];
    $image3 = $_FILES["image3"]["tmp_name"];
    $image4 = $_FILES["image4"]["tmp_name"];
    //$file_name = $_FILES["image1"]["name"];

    // names for images
    $image_name1 = $product_name."1.jpg";
    $image_name2 = $product_name."2.jpg";
    $image_name3 = $product_name."3.jpg";
    $image_name4 = $product_name."4.jpg";

    //upload images
    move_uploaded_file($image1,"../assets/img/".$image_name1);
    move_uploaded_file($image2,"../assets/img/".$image_name2);
    move_uploaded_file($image3,"../assets/img/".$image_name3);
    move_uploaded_file($image4,"../assets/img/".$image_name4);
   
    //create new user
    $stmt = $conn->prepare("INSERT INTO products (product_name, product_description, product_price, product_color,
                             product_image, product_image2, product_image3, product_image4)
                             VALUES (?,?,?,?,?,?,?,?)");

    $stmt->bind_param("ssssssss", $product_name, $product_description, $product_price, $product_color, $image_name1, $image_name2, $image_name3, $image_name4);

    if($stmt->execute()){
        header("location: products.php?product_added=Product has been added successfully");
    } else {
        header("location: products.php?product_not_added=Error occured, try again");
    }
}
?>