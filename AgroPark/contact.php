<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact Us | AgroPark</title>
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
        <li><a href="login.php">Login</a></li>
        <li><a href="contact.php" class="active">Contact Us</a></li>
      </ul>
    </nav>
  </header>

  <!-- Contact Us Section -->
  <section class="contact">
    <h2>Contact Us</h2>
    <p>If you have any questions or feedback, please fill out the form below:</p>
    <form action="submit_contact.php" method="POST">
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" required />

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required />

      <label for="message">Message:</label>
      <textarea id="message" name="message" rows="5" required></textarea>

      <button type="submit" class="btn">Send Message</button>
    </form>
  </section>

  <!-- Footer -->
  <footer>
    © 2025 Agro Industrial Park | All Rights Reserved
  </footer>
</body>
</html>