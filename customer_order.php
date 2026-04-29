<?php
session_start();
include 'db_connect.php';

// 🔐 Ensure the user is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'customer') {
  header("Location: login.php");
  exit();
}

$username = $_SESSION['username'];

// 🧾 Fetch orders for this customer (join orders + order_items)
$query = $conn->prepare("
  SELECT o.id, o.total, o.order_date, o.status, o.payment_method, o.payment_status
  FROM orders o
  JOIN users u ON o.email = u.email
  WHERE u.username = ?
  ORDER BY o.order_date DESC
");
$query->bind_param("s", $username);
$query->execute();
$result = $query->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Orders | AgroPark</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    body { font-family: Poppins, sans-serif; background: #f5f5f5; padding: 2rem; }
    h2 { color: #2c5f2d; margin-bottom: 1rem; text-align:center; }
    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    th, td {
      padding: 12px;
      border-bottom: 1px solid #ddd;
      text-align: left;
    }
    th { background: #2c5f2d; color: white; }
    tr:hover { background: #f9f9f9; }
    .btn {
      background: #2c5f2d;
      color: #fff;
      padding: 6px 12px;
      border-radius: 6px;
      text-decoration: none;
    }
    .btn:hover { background: #97bc62; }
    .status {
      font-weight: bold;
      padding: 5px 10px;
      border-radius: 4px;
    }
    .Pending { background: #f4a261; color: white; }
    .Processing { background: #2a9d8f; color: white; }
    .Shipped { background: #457b9d; color: white; }
    .Delivered { background: #2c5f2d; color: white; }
    .Cancelled { background: #e63946; color: white; }
    .logout { float:right; }
  </style>
</head>
<body>
  <header style="display:flex; justify-content:space-between; align-items:center; margin-bottom:2rem;">
    <h2>👤 Welcome, <?= htmlspecialchars($username) ?></h2>
    <a href="logout.php" class="btn logout">Logout</a>
  </header>

  <h2>📦 My Orders</h2>

  <?php if ($result->num_rows > 0): ?>
    <table>
      <tr>
        <th>Order ID</th>
        <th>Date</th>
        <th>Total ($)</th>
        <th>Payment</th>
        <th>Status</th>
        <th>View</th>
      </tr>
      <?php while ($order = $result->fetch_assoc()): ?>
        <tr>
          <td>#<?= htmlspecialchars($order['id']) ?></td>
          <td><?= htmlspecialchars($order['order_date']) ?></td>
          <td><?= number_format($order['total'], 2) ?></td>
          <td><?= htmlspecialchars($order['payment_method']) ?> (<?= htmlspecialchars($order['payment_status']) ?>)</td>
          <td><span class="status <?= htmlspecialchars($order['status']) ?>"><?= htmlspecialchars($order['status']) ?></span></td>
          <td><a href="view_customer_order.php?id=<?= $order['id'] ?>" class="btn">View Details</a></td>
        </tr>
      <?php endwhile; ?>
    </table>
  <?php else: ?>
    <p style="text-align:center; margin-top:2rem;">You have not placed any orders yet.</p>
  <?php endif; ?>
</body>
</html>
