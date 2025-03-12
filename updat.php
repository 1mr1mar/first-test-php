<?php
session_start();
if (!isset($_SESSION['email'])) header("location:login.php");

require "db.php";


if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    
    
    $query = "SELECT * FROM produit WHERE id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $product_name = $_POST["product_name"];
        $product_description = $_POST["product_description"];
        $product_price = $_POST["product_price"];
        $product_quantity = $_POST["product_quantity"];
        
        
        if (isset($_FILES["product_image"]) && $_FILES["product_image"]["error"] == 0) {
            $image_path = "uploads/" . basename($_FILES["product_image"]["name"]);
            move_uploaded_file($_FILES["product_image"]["tmp_name"], $image_path);
        } else {
            $image_path = $_POST['existing_image'];
        }
        
        
        $update_query = "UPDATE produit SET designation = ?, description = ?, prix = ?, qt = ?, image_path = ? WHERE id = ?";
        $stmt = $db->prepare($update_query);
        $stmt->bind_param("ssdssi", $product_name, $product_description, $product_price, $product_quantity, $image_path, $product_id);
        
        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Product updated successfully!</div>";
        } else {
            echo "<div class='alert alert-danger'>Error updating product!</div>";
        }
    }
} else {
    header("Location: product_list.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <title>Update Product</title>
</head>
<body>

<?php include "includes/navbar.php"; ?>

<div class="container mt-4">
  <h1>Update Product</h1>
  
  <form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="product_name">Product Name:</label>
      <input type="text" name="product_name" value="<?php echo $product['designation']; ?>" required class="form-control"><br>
    </div>
    
    <div class="form-group">
      <label for="product_description">Description:</label>
      <textarea name="product_description" required class="form-control"><?php echo $product['description']; ?></textarea><br>
    </div>
    
    <div class="form-group">
      <label for="product_price">Price:</label>
      <input type="number" name="product_price" value="<?php echo $product['prix']; ?>" required class="form-control"><br>
    </div>
    
    <div class="form-group">
      <label for="product_quantity">Quantity:</label>
      <input type="number" name="product_quantity" value="<?php echo $product['qt']; ?>" required class="form-control"><br>
    </div>
    
    <div class="form-group">
      <label for="product_image">Choose Product Image (Optional):</label>
      <input type="file" name="product_image" class="form-control"><br>
      <input type="hidden" name="existing_image" value="<?php echo $product['image_path']; ?>">
    </div>
    
    <input type="submit" value="Update Product" class="btn btn-info">
  </form>
</div>
<?php include "includes/footer.php"; ?>
</body>
</html>
