<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login | AgroPark</title>
  <link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>
  <!-- Header -->
  <header>
    <nav class="navbar">
      <div class="logo">🌾 AgroPark</div>
      <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="products.php">Products</a></li>
        <li><a href="cart.php">Cart 🛒</a></li>
        <li><a href="login.php" class="active">Login</a></li>
        <li><a href="contact.php">Contact Us</a></li>
      </ul>
    </nav>
  </header>

  <!-- Login Section -->
  <section class="login">
    <h2>Login to Your Account</h2>
    <form action="login_process.php" method="POST">
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required />
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required />
      </div>
      <button type="submit" class="btn">Login</button>
    </form>
    <p>Don't have an account? <a href="register.php">Register here</a></p>
  </section>

  <!-- Footer -->
  <footer>
    © 2025 Agro Industrial Park | All Rights Reserved
  </footer>
</body>
</html>