<?php
session_start();
if (!isset($_SESSION["admin_logged_in"])) {
  header("Location: login.php");
  exit();
}

include 'db_connect.php';

$id = intval($_GET['id'] ?? 0);

$order = $conn->query("SELECT * FROM orders WHERE id = $id")->fetch_assoc();
$items = $conn->query("SELECT * FROM order_items WHERE order_id = $id");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Details | AgroPark Admin</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <h2>🧾 Order #<?= $id ?> Details</h2>
  <p><strong>Customer:</strong> <?= htmlspecialchars($order['customer_name']) ?></p>
  <p><strong>Email:</strong> <?= htmlspecialchars($order['email']) ?></p>
  <p><strong>Phone:</strong> <?= htmlspecialchars($order['phone']) ?></p>
  <p><strong>Address:</strong> <?= htmlspecialchars($order['address']) ?></p>
  <p><strong>Total:</strong> $<?= number_format($order['total'], 2) ?></p>
  <p><strong>Status:</strong> <?= htmlspecialchars($order['status']) ?></p>

  <h3>🛒 Items</h3>
  <table border="1" cellpadding="8" cellspacing="0">
    <tr><th>Product</th><th>Qty</th><th>Price</th><th>Subtotal</th></tr>
    <?php while ($i = $items->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($i['product_name']) ?></td>
        <td><?= $i['quantity'] ?></td>
        <td>$<?= number_format($i['price'], 2) ?></td>
        <td>$<?= number_format($i['price'] * $i['quantity'], 2) ?></td>
      </tr>
    <?php endwhile; ?>
  </table>

  <br>
  <a href="manage_orders.php" class="btn">⬅ Back to Orders</a>
</body>
</html>
