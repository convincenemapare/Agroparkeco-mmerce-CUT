<?php
session_start();
if (!isset($_SESSION["admin_logged_in"]) || $_SESSION["admin_logged_in"] !== true) {
  header("Location: login.php");
  exit();
}

include 'db_connect.php';
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name = trim($_POST['name']);
  $category = trim($_POST['category']);
  $price = floatval($_POST['price']);
  $image = trim($_POST['image']);
  $desc = trim($_POST['description']);

  $stmt = $conn->prepare("INSERT INTO products (name, category, price, image, description) VALUES (?, ?, ?, ?, ?)");
  $stmt->bind_param("ssdss", $name, $category, $price, $image, $desc);

  if ($stmt->execute()) {
    $message = "✅ Product added successfully!";
  } else {
    $message = "❌ Error adding product: " . $stmt->error;
  }

  $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Product | AgroPark</title>
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
  <h2 style="text-align:center;">➕ Add New Product</h2>
  <form method="POST">
    <label>Name:</label>
    <input type="text" name="name" required>

    <label>Category:</label>
    <select name="category" required>
      <option value="seeds">Seeds</option>
      <option value="fertilizers">Fertilizers</option>
      <option value="tools">Tools</option>
      <option value="processed">Processed Goods</option>
      <option value="cattle">Cattle</option>
    </select>

    <label>Price ($):</label>
    <input type="number" step="0.01" name="price" required>

    <label>Image Path (e.g., assets/seed.jpg):</label>
    <input type="text" name="image" required>

    <label>Description:</label>
    <textarea name="description" rows="3" required></textarea>

    <button type="submit">Add Product</button>
  </form>

  <p><?= $message ?></p>
  <div style="text-align:center; margin-top:1rem;">
    <a href="manage_products.php" class="btn">⬅ Back to Products</a>
  </div>
</body>
</html>
