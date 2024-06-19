<?php
error_reporting(E_ALL); ini_set('display_errors', 1);
include_once 'connection.php';


if (isset($_POST['delete'])) {
  $productId = $_POST['product_id'];
  $deleteSql = "DELETE FROM products WHERE productId = '$productId'";
  if (mysqli_query($conn, $deleteSql)) {
      echo "Product deleted successfully.";
      header("Location: display.php");
      exit();
  } else {
      echo "Error deleting product: " . mysqli_error($conn);
  }
}