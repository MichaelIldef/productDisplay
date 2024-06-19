<?php
error_reporting(E_ALL); ini_set('display_errors', 1);
include_once 'connection.php';
session_start();

if (isset($_POST['delete'])) {
  $productId = $_POST['product_id'];
  $deleteSql = "DELETE FROM products WHERE productId = '$productId'";
  if (mysqli_query($conn, $deleteSql)) {
      echo "Product deleted successfully.";
  } else {
      echo "Error deleting product: " . mysqli_error($conn);
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>product list</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body class="dsp">

  <h2>Product List</h2>

  <?php
  $sql = "SELECT productId, productName, productPrice, productDesc, stock  FROM products";

  $result = mysqli_query($conn, $sql);

  if ($result) {
    if (mysqli_num_rows($result) > 0) {
      ?> 
      <div id = "div1">
      <?php
      while($row = mysqli_fetch_assoc($result)) {
      ?>
        <form method="post">
        <input type="hidden" name="product_id" value='<?php echo $row['productId']; ?>'>
      
        <div class='prod'>
          <h3><?php echo $row["productName"]?></h3>
          <p><?php echo $row["productPrice"]; ?></p>
          <p class='desc'>Description:</p>
          <p class='desc'><?php echo $row["productDesc"]; ?></p>
          <p>Stocks: <?php echo $row["stock"]; ?></p>
          <button type='submit' name='delete' id = 'delBtn' value="delete">Delete</button> 
        </div>
        </form> <?php //DELETE BUTTON STILL NOT WORKING
        
        // echo "
        // <div class = 'prod'>
        //   <h3>" . $row["productName"] . "</h3>
          
          
        //   <p>". "&#8369;" . $row["productPrice"] . "</p>
          
        //   <p class = 'desc'>" . "Description:" . "</p>
        //   <p class = 'desc'>" . $row["productDesc"] . "</p>
          
        //   <p>" . "Stocks:  " . $row["stock"] . "</p>
        //   <button id = 'delBtn' type='submit'>Delete</button>
          
          
        // </div>
        
        // ";
        
      }
      ?>
      </div>
       <?php
    } else {
      echo "No products found.";
    }
  } else {
    echo "Error executing query: " . mysqli_error($conn);
  }
  mysqli_close($conn);
  ?>
</body>
</html>