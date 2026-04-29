<?php
session_start();
if (!isset($_SESSION["admin_logged_in"]) || $_SESSION["admin_logged_in"] !== true) {
  header("Location: login.php");
  exit();
}

include 'db_connect.php';

// 🗓️ Handle date range filter
$startDate = $_GET['start'] ?? '';
$endDate = $_GET['end'] ?? '';

// Base query condition
$whereClause = "WHERE 1=1";

if (!empty($startDate) && !empty($endDate)) {
  $whereClause .= " AND DATE(order_date) BETWEEN '$startDate' AND '$endDate'";
}

// 📊 Total Sales (only successful payments)
$totalSalesQuery = $conn->query("SELECT SUM(total) AS total_sales FROM orders $whereClause AND payment_status='Success'");
$totalSales = $totalSalesQuery->fetch_assoc()['total_sales'] ?? 0;

// 🛍️ Total Orders
$totalOrdersQuery = $conn->query("SELECT COUNT(*) AS total_orders FROM orders $whereClause");
$totalOrders = $totalOrdersQuery->fetch_assoc()['total_orders'] ?? 0;

// ✅ Completed Orders
$completedOrdersQuery = $conn->query("SELECT COUNT(*) AS completed FROM orders $whereClause AND status='Delivered'");
$completedOrders = $completedOrdersQuery->fetch_assoc()['completed'] ?? 0;

// 🔝 Top-Selling Products (within date range)
$topProductsQuery = $conn->query("
  SELECT oi.product_name, SUM(oi.quantity) AS total_qty, SUM(oi.price * oi.quantity) AS total_revenue
  FROM order_items oi
  JOIN orders o ON oi.order_id = o.id
  $whereClause
  GROUP BY oi.product_name
  ORDER BY total_qty DESC
  LIMIT 5
");

// 📅 Monthly Sales (for the past 12 months)
$monthlySalesQuery = $conn->query("
  SELECT DATE_FORMAT(order_date, '%Y-%m') AS month, SUM(total) AS total
  FROM orders
  WHERE payment_status='Success'
  GROUP BY month
  ORDER BY month ASC
");
$monthlyLabels = [];
$monthlyTotals = [];
while ($row = $monthlySalesQuery->fetch_assoc()) {
  $monthlyLabels[] = $row['month'];
  $monthlyTotals[] = (float)$row['total'];
}

// 💳 Payment Method Distribution
$paymentQuery = $conn->query("
  SELECT payment_method, COUNT(*) AS count
  FROM orders
  WHERE payment_status='Success'
  GROUP BY payment_method
");
$paymentLabels = [];
$paymentCounts = [];
while ($row = $paymentQuery->fetch_assoc()) {
  $paymentLabels[] = $row['payment_method'];
  $paymentCounts[] = (int)$row['count'];
}

// 📦 Order Status Distribution
$statusQuery = $conn->query("
  SELECT status, COUNT(*) AS count
  FROM orders
  GROUP BY status
");
$statusLabels = [];
$statusCounts = [];
while ($row = $statusQuery->fetch_assoc()) {
  $statusLabels[] = $row['status'];
  $statusCounts[] = (int)$row['count'];
}

$topProducts = $topProductsQuery->fetch_all(MYSQLI_ASSOC);

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sales Reports | AgroPark Admin</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body { font-family: Poppins, sans-serif; padding: 2rem; background: #f5f5f5; }
    h2 { color: #2c5f2d; margin-bottom: 1rem; }
    form.filter-form {
      display: flex; gap: 1rem; justify-content: center;
      margin-bottom: 2rem; align-items: center;
    }
    input[type="date"] {
      padding: 0.5rem; border: 1px solid #ccc; border-radius: 6px;
    }
    button.filter-btn {
      background: #2c5f2d; color: white; padding: 0.5rem 1rem;
      border: none; border-radius: 6px; cursor: pointer;
    }
    button.filter-btn:hover { background: #97bc62; }
    .stats { display: flex; flex-wrap: wrap; gap: 1.5rem; justify-content: center; margin-bottom: 2rem; }
    .card { background: white; padding: 1.5rem; border-radius: 10px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1); width: 250px; text-align: center; }
    .card h3 { color: #2c5f2d; margin-bottom: 0.5rem; }
    table {
      width: 100%; border-collapse: collapse; background: white;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    th, td { padding: 10px; border-bottom: 1px solid #ddd; text-align: left; }
    th { background: #2c5f2d; color: white; }
    .chart-container { max-width: 700px; margin: 2rem auto; }
    a.btn { background:#2c5f2d; color:#fff; padding:0.6rem 1.2rem; border-radius:6px; text-decoration:none; }
    a.btn:hover { background:#97bc62; }
  </style>
</head>
<body>
  <h2>📊 Sales Reports Dashboard</h2>
  <a href="admin_dashboard.php" class="btn">⬅ Back to Dashboard</a>

  <!-- 🔍 Date Range Filter -->
  <form method="GET" class="filter-form" action="reports.php">
  <label>From:</label>
  <input type="date" name="start" value="<?= htmlspecialchars($startDate) ?>">
  <label>To:</label>
  <input type="date" name="end" value="<?= htmlspecialchars($endDate) ?>">
  <button type="submit" class="filter-btn">Filter</button>
  <a href="reports.php" class="btn" style="background:#ccc;color:black;">Reset</a>
  <a href="export_report.php?start=<?= urlencode($startDate) ?>&end=<?= urlencode($endDate) ?>" class="btn" style="background:#007bff;">⬇ Export CSV</a>
</form>


  <div class="stats">
    <div class="card">
      <h3>Total Revenue</h3>
      <p><strong>$<?= number_format($totalSales, 2) ?></strong></p>
    </div>
    <div class="card">
      <h3>Total Orders</h3>
      <p><strong><?= $totalOrders ?></strong></p>
    </div>
    <div class="card">
      <h3>Delivered Orders</h3>
      <p><strong><?= $completedOrders ?></strong></p>
    </div>
  </div>

  <h3>🏆 Top Selling Products</h3>
  <table>
    <tr>
      <th>Product</th>
      <th>Quantity Sold</th>
      <th>Total Revenue ($)</th>
    </tr>
    <?php foreach ($topProducts as $product): ?>
    <tr>
      <td><?= htmlspecialchars($product['product_name']) ?></td>
      <td><?= $product['total_qty'] ?></td>
      <td><?= number_format($product['total_revenue'], 2) ?></td>
    </tr>
    <?php endforeach; ?>
  </table>
  
<h3>🏅 Top Products Summary</h3>
<div class="chart-container">
  <canvas id="salesChart"></canvas>
</div>

  <h3>📈 Monthly Sales Overview</h3>
<div class="chart-container">
  <canvas id="monthlySalesChart"></canvas>
</div>

<h3>💳 Payment Methods Breakdown</h3>
<div class="chart-container">
  <canvas id="paymentChart"></canvas>
</div>

<h3>📦 Order Status Summary</h3>
<div class="chart-container">
  <canvas id="statusChart"></canvas>
</div>


  <script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: <?= json_encode(array_column($topProducts, 'product_name')) ?>,
        datasets: [{
          label: 'Units Sold',
          data: <?= json_encode(array_column($topProducts, 'total_qty')) ?>,
          backgroundColor: '#97bc62'
        }]
      },
      options: {
        scales: { y: { beginAtZero: true } },
        plugins: { legend: { display: false } }
      }
    });
    // --- Monthly Sales Chart ---
  new Chart(document.getElementById('monthlySalesChart'), {
    type: 'line',
    data: {
      labels: <?= json_encode($monthlyLabels) ?>,
      datasets: [{
        label: 'Monthly Sales ($)',
        data: <?= json_encode($monthlyTotals) ?>,
        borderColor: '#2c5f2d',
        backgroundColor: 'rgba(151, 188, 98, 0.3)',
        fill: true,
        tension: 0.3
      }]
    },
    options: { responsive: true, scales: { y: { beginAtZero: true } } }
  });

  // --- Payment Methods Pie Chart ---
  new Chart(document.getElementById('paymentChart'), {
    type: 'pie',
    data: {
      labels: <?= json_encode($paymentLabels) ?>,
      datasets: [{
        data: <?= json_encode($paymentCounts) ?>,
        backgroundColor: ['#97bc62', '#2c5f2d', '#7fa14c', '#b5e48c']
      }]
    },
    options: { responsive: true }
  });

  // --- Order Status Doughnut Chart ---
  new Chart(document.getElementById('statusChart'), {
    type: 'doughnut',
    data: {
      labels: <?= json_encode($statusLabels) ?>,
      datasets: [{
        data: <?= json_encode($statusCounts) ?>,
        backgroundColor: ['#f4a261', '#2a9d8f', '#e76f51', '#264653']
      }]
    },
    options: { responsive: true }
  });
  </script>
  <pre>


</body>
</html>

