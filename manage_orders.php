<?php
session_start();
if (!isset($_SESSION["admin_logged_in"]) || $_SESSION["admin_logged_in"] !== true) {
  header("Location: login.php");
  exit();
}

include 'db_connect.php';

// ✅ Handle order status update
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['order_id'], $_POST['status'])) {
  $id = intval($_POST['order_id']);
  $status = $_POST['status'];

  $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE id = ?");
  if ($stmt) {
    $stmt->bind_param("si", $status, $id);
    $stmt->execute();
    $stmt->close();
  }
}

// ✅ Fetch orders
$result = $conn->query("SELECT * FROM orders ORDER BY order_date DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Orders | AgroPark Admin</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    body {
      font-family: Poppins, sans-serif;
      padding: 2rem;
      background: #f5f5f5;
    }
    h2 { color: #2c5f2d; margin-bottom: 1rem; }
    table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    th, td {
      padding: 12px;
      border-bottom: 1px solid #ddd;
      text-align: left;
    }
    th {
      background: #2c5f2d;
      color: #fff;
    }
    tr:hover {
      background: #f9f9f9;
    }
    select, button {
      padding: 6px 8px;
      border-radius: 6px;
      border: 1px solid #ccc;
    }
    button {
      background: #97bc62;
      color: white;
      border: none;
      cursor: pointer;
    }
    button:hover {
      background: #7fa14c;
    }
    a.btn {
      background: #2c5f2d;
      color: #fff;
      padding: 6px 12px;
      border-radius: 6px;
      text-decoration: none;
    }
    a.btn:hover { background: #97bc62; }
    .success-message {
      color: green;
      font-weight: bold;
      margin-bottom: 1rem;
    }
  </style>
</head>
<body>
  <h2>📦 Manage Orders</h2>
  <a href="admin_dashboard.php" class="btn">⬅ Back to Dashboard</a>
  <br><br>

  <?php if ($_SERVER["REQUEST_METHOD"] === "POST"): ?>
    <div class="success-message">✅ Order status updated successfully!</div>
  <?php endif; ?>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Customer</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Total ($)</th>
        <th>Date</th>
        <th>Status</th>
        <th>Action</th>
        <th>Payment Method</th>
        <th>Payment Status</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= $row['id'] ?></td>
          <td><?= htmlspecialchars($row['customer_name']) ?></td>
          <td><?= htmlspecialchars($row['email']) ?></td>
          <td><?= htmlspecialchars($row['phone']) ?></td>
          <td><?= number_format($row['total'], 2) ?></td>
          <td><?= $row['order_date'] ?></td>
          <td><?= htmlspecialchars($row['status']) ?></td>
          <td><?= htmlspecialchars($row['payment_method']) ?></td>
          <td><?= htmlspecialchars($row['payment_status']) ?></td>
          <td>
            <form method="POST" style="display:flex;gap:8px;align-items:center;">
              <input type="hidden" name="order_id" value="<?= $row['id'] ?>">
              <select name="status">
                <?php
                  $statuses = ['Pending','Processing','Shipped','Delivered','Cancelled'];
                  foreach ($statuses as $s) {
                    $selected = ($s === $row['status']) ? 'selected' : '';
                    echo "<option value='$s' $selected>$s</option>";
                  }
                ?>
              </select>
              <button type="submit">Update</button>
            </form>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</body>
</html>
