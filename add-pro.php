<?php
require "db.php"; 


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["product_image"])) {
    $product_name = $_POST["product_name"];
    $product_description = $_POST["product_description"];
    $product_price = $_POST["product_price"];
    $product_quantity = $_POST["product_quantity"];
    $image_path = "uploads/" . basename($_FILES["product_image"]["name"]);
    
    if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $image_path)) {
        
        $stmt = $db->prepare("INSERT INTO produit (designation, description, prix, qt, image_path) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdss", $product_name, $product_description, $product_price, $product_quantity, $image_path);
        
  
        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>تم إضافة المنتج بنجاح!</div>";
        } else {
            echo "<div class='alert alert-danger'>حدث خطأ أثناء إضافة المنتج!</div>";
        }
        
        $stmt->close();
    } else {
        echo "<div class='alert alert-danger'>حدث خطأ أثناء رفع الصورة!</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <title>إضافة منتج</title>
</head>
<body>

<?php include "includes/navbar.php"; ?>

<div class="container mt-4">
  <h1>إضافة منتج جديد</h1>
  
  
  <form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="product_name">اسم المنتج:</label>
      <input type="text" name="product_name" required class="form-control"><br>
    </div>
    
    <div class="form-group">
      <label for="product_description">الوصف:</label>
      <textarea name="product_description" required class="form-control"></textarea><br>
    </div>
    
    <div class="form-group">
      <label for="product_price">السعر:</label>
      <input type="number" name="product_price" required class="form-control"><br>
    </div>
    
    <div class="form-group">
      <label for="product_quantity">الكمية:</label>
      <input type="number" name="product_quantity" required class="form-control"><br>
    </div>
    
    <div class="form-group">
      <label for="product_image">اختر صورة المنتج:</label>
      <input type="file" name="product_image" required class="form-control"><br>
    </div>
    
    <input type="submit" value="إضافة المنتج" class="btn btn-info">
  </form>

  <hr>


  <h2>produuct-list</h2>
  <div class="row">
    <?php
    $st = "SELECT * FROM `produit`";
    $result = mysqli_query($db, $st) or die(mysqli_error($db));
    while($row = mysqli_fetch_array($result)){
    ?>
      <div class="col-md-4 mb-4">
        <div class="card">
          <img src="<?php echo $row['image_path']; ?>" class="card-img-top" alt="صورة المنتج">
          <div class="card-body">
            <h5 class="card-title"><?php echo $row['designation']; ?></h5>
            <p class="card-text"><?php echo $row['description']; ?></p>
            <p><strong>السعر:</strong> <?php echo $row['prix']; ?> DH</p>
            <p><strong>الكمية:</strong> <?php echo $row['qt']; ?></p>
            <a href="#" class="btn btn-primary">تحديث</a>
            <a href="#" class="btn btn-danger">حذف</a>
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
