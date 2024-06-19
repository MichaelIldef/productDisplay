<?php

include_once 'connection.php';

if (isset($_POST['submit'])) {

  $productName = $_POST['productname'];
  $productPrice = $_POST['productprice'];
  $productDesc = $_POST['productdescription'];
  $stock = $_POST['stock'];

  $sql = "INSERT INTO products (productName, productPrice, productDesc, stock) VALUES (?, ?, ?, ?)";
  $stmt = mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "ssss", $productName, $productPrice, $productDesc, $stock);

  if (mysqli_stmt_execute($stmt)) {
    echo "Product added successfully!";
    header("location:display.php");
  } else {
    echo "Error adding product: " . mysqli_error($conn);
  }

  mysqli_stmt_close($stmt);
} else {
  echo "Unauthorized access";
}

mysqli_close($conn);

?>