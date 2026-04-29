<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>AgroPark | Smart Agro E-Commerce</title>
  <link rel="stylesheet" href="assets/css/style.css" />
  <style>
    /* Hero Section */
    .hero {
      height: 90vh;
      background: linear-gradient(rgba(44, 95, 45, 0.65), rgba(44, 95, 45, 0.65)),
        url('assets/silo.jpg') center/cover no-repeat;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      text-align: center;
      color: #fff;
      animation: fadeIn 1.2s ease-in;
    }

    .hero h1 {
      font-size: 3rem;
      font-weight: 700;
      margin-bottom: 1rem;
      letter-spacing: 1px;
    }

    .hero p {
      font-size: 1.2rem;
      max-width: 600px;
      margin-bottom: 2rem;
      line-height: 1.6;
    }

    .hero .btn {
      background: #97bc62;
      color: white;
      padding: 0.8rem 1.5rem;
      border-radius: 50px;
      font-weight: 600;
      text-decoration: none;
      transition: background 0.3s ease, transform 0.2s;
    }

    .hero .btn:hover {
      background: #7fa14c;
      transform: scale(1.05);
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* About Section */
    .about {
      padding: 4rem 2rem;
      max-width: 1000px;
      margin: auto;
      text-align: center;
      animation: fadeIn 1s ease-in;
    }

    .about h2 {
      color: #2c5f2d;
      margin-bottom: 1rem;
      font-size: 2rem;
    }

    .about p {
      color: #444;
      line-height: 1.7;
      font-size: 1.1rem;
    }

    /* Featured Products Section */
    .featured {
      background: #f5f9f4;
      padding: 4rem 2rem;
    }

    .featured h2 {
      text-align: center;
      color: #2c5f2d;
      margin-bottom: 2rem;
    }

    /* Footer */
    footer {
      background: #2c5f2d;
      color: white;
      text-align: center;
      padding: 1.5rem;
      margin-top: 3rem;
    }
  </style>
</head>
<body>
  <!-- Header -->
  <header>
    <nav class="navbar">
      <div class="logo">🌾 AgroPark</div>
      <ul class="nav-links">
        <li><a href="index.php" class="active">Home</a></li>
        <li><a href="products.php">Products</a></li>
        <li><a href="cart.php">Cart 🛒</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="contact.php">Contact Us</a></li> <!-- Added Contact Us link -->
      </ul>
    </nav>
  </header>

  <!-- Hero Section -->
  <section class="hero">
    <h1>Welcome to AgroPark</h1>
    <p>Connecting farmers, suppliers, and customers in one smart marketplace for quality agricultural products.</p>
    <a href="products.php" class="btn">Shop Now</a>
  </section>

  <!-- About Section -->
  <section class="about">
    <h2>About AgroPark</h2>
    <p>
      AgroPark is a next-generation agro-industrial e-commerce platform dedicated to empowering local farmers and agri-suppliers. We make it easy to buy and sell seeds, fertilizers, livestock, and agricultural tools — helping grow your business sustainably and efficiently.
    </p>
  </section>

  <!-- Footer -->
  <footer>
    © 2025 Agro Industrial Park | All Rights Reserved
  </footer>
</body>
</html>