<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>AgroPark | Products</title>
  <link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>
  <!-- Header -->
  <header>
    <nav class="navbar">
      <div class="logo">🌾 AgroPark</div>
      <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="products.php" class="active">Products</a></li>
        <li><a href="cart.php">Cart 🛒</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="contact.php">Contact Us</a></li>
      </ul>
    </nav>
  </header>

  <!-- Products Section -->
  <section class="products">
    <h2>Available Products</h2>
    <div class="product-list">
      <?php
      include 'db_connect.php';
      $res = $conn->query("SELECT id, name, price, image, description FROM products");
      if ($res && $res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
          $title = htmlspecialchars($row['name']);
          $price = number_format((float)$row['price'], 2);
          $img = htmlspecialchars($row['image']);
          echo "
            <div class='product'>
              <img src='assets/$img' alt='$title' />
              <h3>$title</h3>
              <p>Price: \$$price</p>
              <p>" . htmlspecialchars($row['description']) . "</p>
              <a href='cart.php?id={$row['id']}' class='btn'>Add to Cart</a>
            </div>
          ";
        }
      } else {
        echo "<p>No products available at the moment.</p>";
      }
      ?>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    © 2025 Agro Industrial Park | All Rights Reserved
  </footer>
</body>
</html>