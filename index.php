<?php

include_once 'connection.php';

session_start();

if (isset($_POST['submit'])) {

  $productName = $_POST['productname'];
  $productPrice = $_POST['productprice'];
  $productDesc = $_POST['productdescription'];
  $stock  = $_POST['stock'];

  $query = "INSERT INTO products (productName, productPrice, productDesc, stock) VALUES (?, ?, ?, ?, ?)";

  $stmt = $conn->prepare($query);

  if (!$stmt) {
    echo "Error preparing statement: " . mysqli_error($conn);
    exit();
  }

  $stmt->bind_param("sssii", $productName, $productPrice, $productDesc, $stock);

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product listing</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <div class="form-container">
        <form method="post" action="process.php">
            <h1>List your Product</h1>
            <div class="form-group">
                <label for="productname">Product name:</label>
                <input type="text" id="productname" name="productname" required>
            </div>
            <div class="form-group">
                <label for="productdescription">Product description:</label>
                <textarea id="description" name="productdescription" required></textarea>
            </div>
            <div class="form-group">
                <label for="productprice">Product price:</label>
                <input type="number" id="productprice" name="productprice" required>
            </div>
            <div class="form-group">
                <label for="stock">Product stock:</label>
                <input type="number" id="stock" name="stock" required> 
            </div>
            <button type="submit" name="submit" id="btn">Add Product</button>
        </form>
    </div>
</body>
</html>


