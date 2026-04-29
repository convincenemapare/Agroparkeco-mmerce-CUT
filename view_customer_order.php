<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'customer') {
  header("Location: login.php");
  exit();
}

$order_id = intval($_GET['id'] ?? 0);
$username = $_SESSION['username'];

// Get order info (secure check)
$query = $conn->prepare("
  SELECT o.* 
  FROM orders o
  JOIN users u ON o.email = u.email
  WHERE o.id = ? AND u.username = ?
");
$query->bind_param("is", $order_id, $username);
$query->execute();
$order = $query->get_result()->fetch_assoc();

if (!$order) {
  die("<p>⚠️ Order not found or access denied.</p>");
}

// Fetch order items
$items = $conn->query("SELECT * FROM order_items WHERE order_id = $order_id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Order #<?= $order_id ?> | AgroPark</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    body { font-family:Poppins,sans-serif; padding:2rem; background:#f9f9f9; }
    h2 { color:#2c5f2d; }
    table { width:100%; border-collapse:collapse; background:white; margin-top:1rem; }
    th,td { padding:10px; border-bottom:1px solid #ddd; text-align:left; }
    th { background:#2c5f2d; color:white; }
    .btn { background:#2c5f2d; color:#fff; padding:6px 12px; border-radius:6px; text-decoration:none; }
    .btn:hover { background:#97bc62; }
  </style>
</head>
<body>
  <h2>🧾 Order #<?= htmlspecialchars($order_id) ?> Details</h2>
  <p><strong>Date:</strong> <?= htmlspecialchars($order['order_date']) ?></p>
  <p><strong>Total:</strong> $<?= number_format($order['total'], 2) ?></p>
  <p><strong>Payment Method:</strong> <?= htmlspecialchars($order['payment_method']) ?> (<?= htmlspecialchars($order['payment_status']) ?>)</p>
  <p><strong>Status:</strong> <?= htmlspecialchars($order['status']) ?></p>

  <h3>Items</h3>
  <table>
    <tr><th>Product</th><th>Qty</th><th>Price</th><th>Subtotal</th></tr>
    <?php while ($i = $items->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($i['product_name']) ?></td>
        <td><?= $i['quantity'] ?></td>
        <td>$<?= number_format($i['price'], 2) ?></td>
        <td>$<?= number_format($i['quantity'] * $i['price'], 2) ?></td>
      </tr>
    <?php endwhile; ?>
  </table>

  <br>
  <a href="customer_orders.php" class="btn">⬅ Back to My Orders</a>
</body>
</html>
