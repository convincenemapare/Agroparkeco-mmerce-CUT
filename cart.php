<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Your Cart</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <!----navigation bar----->
    <header>
    <nav class="navbar">
      <div class="logo">🌾 AgroPark</div>
      <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="products.php" class="active">Products</a></li>
        <li><a href="cart.php">Cart 🛒</a></li>
        <li><a href="login.php">Login</a></li>
      </ul>
    </nav>
  </header>
  <!----your shoppoing cart--->
  <h1>🛒 Your Shopping Cart</h1>

  <div id="cartContainer"></div>
   <div class="cart-summary">
      <h3>Total: $<span id="cartTotal">0.00</span></h3>
      <!--<a href="checkout.php" class="checkout-btn">Proceed to Checkout</a>-->
      <a href="register.php" class="checkout-btn">Register to go Checkout</a>
   </div>



  <script src="assets/js/script.js"></script>
 

  
</body>
</html>

