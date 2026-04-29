<?php
// fetch_products.php
// Outputs HTML product cards from the database

require_once __DIR__ . '/db_connect.php';

// Optional: handle filtering or search (future enhancement)
$category = isset($_GET['category']) ? trim($_GET['category']) : '';
$search   = isset($_GET['search'])   ? trim($_GET['search'])   : '';

$sql = "SELECT id, name, category, price, image, description FROM products WHERE 1=1";
$params = [];

// Optional filters
if ($category !== '' && $category !== 'all') {
  $sql .= " AND category = ?";
  $params[] = $category;
}
if ($search !== '') {
  $sql .= " AND (name LIKE ? OR description LIKE ?)";
  $searchTerm = "%" . $search . "%";
  $params[] = $searchTerm;
  $params[] = $searchTerm;
}

$sql .= " ORDER BY id DESC";

$stmt = $conn->prepare($sql);

if ($params) {
  // Dynamically bind parameters (all strings)
  $types = str_repeat("s", count($params));
  $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $id = htmlspecialchars($row['id']);
    $name = htmlspecialchars($row['name']);
    $category = htmlspecialchars($row['category']);
    $price = number_format((float)$row['price'], 2);
    $image = htmlspecialchars($row['image']);
    $desc = htmlspecialchars($row['description']);

    echo "
      <div class='product-card' data-category='{$category}' data-id='{$id}'>
        <img src='{$image}' alt='{$name}' />
        <h3>{$name}</h3>
        <p class='price' data-price='{$price}'>\${$price}</p>
        <button class='add-to-cart'>Add to Cart</button>
      </div>
    ";
  }
} else {
  echo "<p>No products available.</p>";
}

$stmt->close();
$conn->close();
?>


