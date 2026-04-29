<?php
session_start();
if (!isset($_SESSION["admin_logged_in"]) || $_SESSION["admin_logged_in"] !== true) {
  header("Location: login.php");
  exit();
}

include 'db_connect.php';

// Handle deletion
if (isset($_GET['delete'])) {
  $id = intval($_GET['delete']);
  $conn->query("DELETE FROM products WHERE id = $id");
  header("Location: manage_products.php");
  exit();
}

// Fetch all products
$result = $conn->query("SELECT * FROM products ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Products | AgroPark Admin</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    body { font-family:Poppins,sans-serif; padding:2rem; background:#f5f5f5; }
    table { width:100%; border-collapse:collapse; background:#fff; box-shadow:0 2px 6px rgba(0,0,0,0.1); }
    th, td { padding:12px; text-align:left; border-bottom:1px solid #ddd; }
    th { background:#2c5f2d; color:white; }
    tr:hover { background:#f9f9f9; }
    a.btn { background:#2c5f2d; color:white; padding:6px 12px; text-decoration:none; border-radius:4px; }
    a.btn:hover { background:#97bc62; }
    .add-btn { display:inline-block; margin-bottom:15px; }
    img { width:60px; height:60px; object-fit:cover; border-radius:4px; }
  </style>
</head>
<body>
  <h2>🛠 Manage Products</h2>
  <a href="admin_dashboard.php" class="btn">⬅ Back to Dashboard</a>
  <a href="add_product.php" class="btn add-btn">➕ Add New Product</a>

  <table>
    <tr>
      <th>ID</th>
      <th>Image</th>
      <th>Name</th>
      <th>Category</th>
      <th>Price ($)</th>
      <th>Actions</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?= htmlspecialchars($row['id']) ?></td>
      <td><img src="<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>"></td>
      <td><?= htmlspecialchars($row['name']) ?></td>
      <td><?= htmlspecialchars($row['category']) ?></td>
      <td><?= number_format($row['price'], 2) ?></td>
      <td>
        <a href="edit_product.php?id=<?= $row['id'] ?>" class="btn">✏ Edit</a>
        <a href="manage_products.php?delete=<?= $row['id'] ?>" class="btn" onclick="return confirm('Delete this product?');">🗑 Delete</a>
      </td>
    </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>
