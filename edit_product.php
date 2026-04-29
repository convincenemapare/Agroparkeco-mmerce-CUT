<?php
session_start();
if (!isset($_SESSION["admin_logged_in"]) || $_SESSION["admin_logged_in"] !== true) {
  header("Location: login.php");
  exit();
}

include 'db_connect.php';

$message = "";
$product = null;

// 1️⃣ Fetch product details
if (isset($_GET['id'])) {
  $id = intval($_GET['id']);
  $stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 1) {
    $product = $result->fetch_assoc();
  } else {
    die("Product not found.");
  }
  $stmt->close();
} else {
  die("Invalid request.");
}

// 2️⃣ Handle update submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name = trim($_POST['name']);
  $category = trim($_POST['category']);
  $price = floatval($_POST['price']);
  $image = trim($_POST['image']);
  $desc = trim($_POST['description']);

  $stmt = $conn->prepare("UPDATE products SET name=?, category=?, price=?, image=?, description=? WHERE id=?");
  $stmt->bind_param("ssdssi", $name, $category, $price, $image, $desc, $id);

  if ($stmt->execute()) {
    $message = "✅ Product updated successfully!";
    // Fetch updated data again
    $stmt2 = $conn->prepare("SELECT * FROM products WHERE id = ?");
    $stmt2->bind_param("i", $id);
    $stmt2->execute();
    $product = $stmt2->get_result()->fetch_assoc();
    $stmt2->close();
  } else {
    $message = "❌ Error updating product: " . $stmt->error;
  }

  $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Product | AgroPark</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    body { font-family:Poppins,sans-serif; padding:2rem; background:#f4f4f4; }
    form { background:white; padding:2rem; border-radius:10px; max-width:500px; margin:auto; box-shadow:0 2px 6px rgba(0,0,0,0.1); }
    input, textarea, select { width:100%; padding:0.6rem; margin:0.5rem 0; border:1px solid #ccc; border-radius:6px; }
    button { background:#2c5f2d; color:white; border:none; padding:0.7rem 1.5rem; border-radius:6px; cursor:pointer; }
    button:hover { background:#97bc62; }
    p { text-align:center; color:green; font-weight:bold; }
  </style>
</head>
<body>
  <h2 style="text-align:center;">✏ Edit Product</h2>

  <?php if ($product): ?>
  <form method="POST">
    <label>Name:</label>
    <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>

    <label>Category:</label>
    <select name="category" required>
      <option value="seeds" <?= $product['category']=='seeds'?'selected':'' ?>>Seeds</option>
      <option value="fertilizers" <?= $product['category']=='fertilizers'?'selected':'' ?>>Fertilizers</option>
      <option value="tools" <?= $product['category']=='tools'?'selected':'' ?>>Tools</option>
      <option value="processed" <?= $product['category']=='processed'?'selected':'' ?>>Processed Goods</option>
      <option value="cattle" <?= $product['category']=='cattle'?'selected':'' ?>>Cattle</option>
    </select>

    <label>Price ($):</label>
    <input type="number" step="0.01" name="price" value="<?= htmlspecialchars($product['price']) ?>" required>

    <label>Image Path:</label>
    <input type="text" name="image" value="<?= htmlspecialchars($product['image']) ?>" required>

    <label>Description:</label>
    <textarea name="description" rows="3" required><?= htmlspecialchars($product['description']) ?></textarea>

    <button type="submit">Update Product</button>
  </form>
  <?php endif; ?>

  <p><?= $message ?></p>

  <div style="text-align:center; margin-top:1rem;">
    <a href="manage_products.php" class="btn">⬅ Back to Products</a>
  </div>
</body>
</html>
