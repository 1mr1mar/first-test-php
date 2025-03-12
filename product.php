<?php
session_start();
if (!isset($_SESSION['email'])) header("location:login.php");

require "db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <title>Product List</title>
</head>
<body>

<?php include "includes/navbar.php"; ?>

<div class="container mt-4">
  <h1>Product List</h1>
  
  <a href="add-pro.php" class="btn btn-info float-right mb-5">Add New Product</a>

  <div class="row">
    <?php
    $st = "SELECT * FROM produit";
    $result = mysqli_query($db, $st) or die(mysqli_error($db));
    while ($row = mysqli_fetch_array($result)) {
    ?>
      <div class="col-md-4 mb-4">
        <div class="card">
          <img src="<?php echo $row['image_path']; ?>" class="card-img-top" alt="Product Image">
          <div class="card-body">
            <h5 class="card-title"><?php echo $row['designation']; ?></h5>
            <p class="card-text"><?php echo $row['description']; ?></p>
            <p><strong>Price:</strong> <?php echo $row['prix']; ?> DH</p>
            <p><strong>Quantity:</strong> <?php echo $row['qt']; ?></p>
            
            <!-- Link to update the product -->
            <a href="updat.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Update</a>
            
            <!-- Link to delete the product -->
            <a href="delet.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
          </div>
        </div>
      </div>
    <?php
    }
    ?>
  </div>
</div>
<?php include "includes/footer.php"; ?>
</body>
</html>
