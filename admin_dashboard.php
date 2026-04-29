<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  header("Location: login.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard | AgroPark</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: #f4f6f5;
      margin: 0;
      padding: 0;
    }

    header {
      background: #2c5f2d;
      color: white;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1rem 2rem;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
    }

    header h2 {
      font-size: 1.5rem;
      margin: 0;
    }

    a.btn {
      background: #97bc62;
      color: white;
      text-decoration: none;
      padding: 0.6rem 1.2rem;
      border-radius: 6px;
      font-weight: 500;
      transition: 0.3s;
    }

    a.btn:hover {
      background: #7fa14c;
    }

    main {
      padding: 2rem;
      max-width: 1200px;
      margin: auto;
    }

    h3 {
      color: #2c5f2d;
      margin-bottom: 1rem;
      text-align: center;
    }

    .welcome {
      text-align: center;
      color: #333;
      margin-bottom: 2rem;
      font-size: 1.1rem;
    }

    .dashboard-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 2rem;
    }

    .card {
      background: white;
      padding: 1.5rem;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      text-align: center;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .card h4 {
      color: #2c5f2d;
      margin-bottom: 0.8rem;
      font-size: 1.2rem;
    }

    .card a {
      display: inline-block;
      background: #97bc62;
      color: white;
      padding: 0.5rem 1rem;
      border-radius: 5px;
      text-decoration: none;
      font-weight: 500;
      transition: 0.3s;
    }

    .card a:hover {
      background: #7fa14c;
    }

    .card i {
      font-size: 2rem;
      color: #2c5f2d;
      margin-bottom: 0.8rem;
    }

    footer {
      text-align: center;
      background: #2c5f2d;
      color: white;
      padding: 1rem;
      margin-top: 3rem;
    }
  </style>
  <script src="https://cdn.jsdelivr.net/npm/lucide@latest"></script>
</head>
<body>
  <header>
    <h2>🌾 AgroPark Admin Dashboard</h2>
    <a href="logout.php" class="btn">Logout</a>
  </header>

  <main>
    <div class="welcome">
      Welcome back, <strong><?= htmlspecialchars($_SESSION["admin_name"] ?? 'Admin') ?></strong> 👋
    </div>

    <h3>📋 Manage Your Platform</h3>

    <div class="dashboard-grid">
      <div class="card">
        <i data-lucide="package"></i>
        <h4>Manage Products</h4>
        <a href="manage_products.php">Go to Products</a>
      </div>

      <div class="card">
        <i data-lucide="shopping-cart"></i>
        <h4>View Orders</h4>
        <a href="manage_orders.php">Go to Orders</a>
      </div>

      <div class="card">
        <i data-lucide="bar-chart-3"></i>
        <h4>Sales Reports</h4>
        <a href="reports.php">View Reports</a>
      </div>

      <!--<div class="card">
        <i data-lucide="users"></i>
        <h4>Manage Users</h4>
        <a href="#">Coming Soon</a>
      </div>-->
    </div>
  </main>

  <footer>
    © 2025 Agro Industrial Park | Admin Dashboard
  </footer>

  <script>
    lucide.createIcons();
  </script>
</body>
</html>

