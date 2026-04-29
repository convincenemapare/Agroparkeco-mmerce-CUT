<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Products | AgroPark</title>
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
        <!--<li><a href="login.php">Login</a></li>-->
      </ul>
    </nav>
  </header>

  <!-- Product Page -->
  <main class="product-page">
    <h1>Our Products</h1>

    <!-- Search and Filter Section -->
    <div class="filters">
      <input type="text" id="searchInput" placeholder="🔍 Search products..." />
      <select id="categoryFilter">
        <option value="all">All Categories</option>
        <option value="seeds">Seeds</option>
        <option value="fertilizers">Fertilizers</option>
        <option value="tools">Tools</option>
        <option value="processed">Processed Goods</option>
        <option value="cattle">Cattle</option>
      </select>
    </div>

    <!-- Product Grid -->
    <div class="product-grid" id="productGrid">
      <?php include 'fetch_products.php'; ?>
    </div>
  </main>

  <!-- Footer -->
  <footer>
    <p>© 2025 Agro Industrial Park | All Rights Reserved</p>
  </footer>

  <script src="assets/js/script.js"></script>
</body>
</html>

