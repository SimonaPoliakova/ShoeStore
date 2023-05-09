<?php

include("connection.php");

//it will show 4 featured products
$stmt = $conn->prepare("SELECT * FROM products LIMIT 4");

$stmt->execute();

$featured_products = $stmt->get_result();

?>