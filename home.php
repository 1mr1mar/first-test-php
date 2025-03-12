<?php
    session_start();
    if(!isset($_SESSION['email'])) header("location:login.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pizza Store - Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <style>
    .hero {
      background-image: url('./uploads/background.png');
      background-size: cover;
      background-position: center;
      color: white;
     height: 300px;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
    }
    .hero h1 {
      font-size: 4rem;
      font-weight: bold;
    }
    .category-card img {
      max-height: 200px;
      object-fit: cover;
    }
  </style>
</head>
<body>
  <?php include "includes/navbar.php"; ?>

  <!-- Hero Section -->
  <div class="hero">
    <h1 class="text-warning">Welcome to Pizza Delight</h1>
  </div>

  <!-- Main Content -->
  <div class="container mt-5">
    <h2>Hello, <?php echo $_SESSION['email']; ?>! Welcome to your pizza shop.</h2>
    <p>Explore our delicious pizzas and categories below:</p>

    <!-- Pizza Categories -->
    <div class="row">
      <!-- Category 1: Margherita -->
      <div class="col-md-4 mb-4">
        <div class="card category-card">
          <img src="./uploads/focaccia.jpg" class="card-img-top" alt="Margherita Pizza">
          <div class="card-body">
            <h5 class="card-title">Margherita</h5>
            <p class="card-text">Classic Margherita pizza with fresh tomatoes and mozzarella.</p>
            <a href="product.php" class="btn btn-primary">View Menu</a>
          </div>
        </div>
      </div>

      <!-- Category 2: Pepperoni -->
      <div class="col-md-4 mb-4">
        <div class="card category-card">
          <img src="./uploads/salamino.jpg" class="card-img-top" alt="Pepperoni Pizza">
          <div class="card-body">
            <h5 class="card-title">Pepperoni</h5>
            <p class="card-text">Delicious pepperoni pizza with mozzarella and marinara sauce.</p>
            <a href="product.php" class="btn btn-primary">View Menu</a>
          </div>
        </div>
      </div>

      <!-- Category 3: Veggie -->
      <div class="col-md-4 mb-4">
        <div class="card category-card">
          <img src="./uploads/spinaci.jpg" class="card-img-top" alt="Veggie Pizza">
          <div class="card-body">
            <h5 class="card-title">Veggie</h5>
            <p class="card-text">Loaded with fresh vegetables, perfect for vegetarians.</p>
            <a href="product.php" class="btn btn-primary">View Menu</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include "includes/footer.php"; ?>
</body>
</html>
