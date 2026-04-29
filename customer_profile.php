<?php
session_start();
include 'db_connect.php';

// 🔒 Make sure customer is logged in
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'customer') {
  header("Location: login.php");
  exit();
}

$user_id = $_SESSION['user_id'];
$message = "";

// Fetch current profile info
$stmt = $conn->prepare("SELECT full_name, username, email FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();

// 📝 Handle updates
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $full_name = trim($_POST["full_name"]);
  $email = trim($_POST["email"]);
  $password = $_POST["password"];
  $confirm = $_POST["confirm_password"];

  if ($full_name === "" || $email === "") {
    $message = "⚠️ Full name and email are required.";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $message = "❌ Invalid email address.";
  } elseif (!empty($password) && $password !== $confirm) {
    $message = "❌ Passwords do not match.";
  } else {
    // Check if email already exists for another user
    $check = $conn->prepare("SELECT id FROM users WHERE email = ? AND id != ?");
    $check->bind_param("si", $email, $user_id);
    $check->execute();
    $check->store_result();
    if ($check->num_rows > 0) {
      $message = "⚠️ Email is already in use.";
    } else {
      // Update query
      if (!empty($password)) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $update = $conn->prepare("UPDATE users SET full_name=?, email=?, password=? WHERE id=?");
        $update->bind_param("sssi", $full_name, $email, $hashed, $user_id);
      } else {
        $update = $conn->prepare("UPDATE users SET full_name=?, email=? WHERE id=?");
        $update->bind_param("ssi", $full_name, $email, $user_id);
      }

      if ($update->execute()) {
        $message = "✅ Profile updated successfully!";
        $_SESSION["username"] = $user["username"]; // keep same username
      } else {
        $message = "❌ Update failed: " . htmlspecialchars($conn->error);
      }

      $update->close();
    }
    $check->close();
  }
}

// Refresh user info after update
$stmt = $conn->prepare("SELECT full_name, username, email FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->close();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Profile | AgroPark</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    body { font-family: Poppins, sans-serif; background:#f5f5f5; padding:2rem; }
    form { background:white; padding:2rem; max-width:500px; margin:auto; border-radius:10px; box-shadow:0 2px 6px rgba(0,0,0,0.1); }
    input { width:100%; padding:0.6rem; margin:0.5rem 0; border:1px solid #ccc; border-radius:6px; }
    button { background:#2c5f2d; color:white; border:none; padding:0.7rem 1.5rem; border-radius:6px; cursor:pointer; }
    button:hover { background:#97bc62; }
    h2 { text-align:center; color:#2c5f2d; }
    .msg { text-align:center; font-weight:600; margin:1rem 0; }
    .success { color:green; }
    .error { color:#d9534f; }
  </style>
</head>
<body>
  <h2>👤 My Profile</h2>

  <form method="POST">
    <label>Full Name:</label>
    <input type="text" name="full_name" value="<?= htmlspecialchars($user['full_name']) ?>" required>

    <label>Username:</label>
    <input type="text" value="<?= htmlspecialchars($user['username']) ?>" disabled>

    <label>Email:</label>
    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

    <label>New Password (optional):</label>
    <input type="password" name="password" placeholder="Enter new password">

    <label>Confirm Password:</label>
    <input type="password" name="confirm_password" placeholder="Confirm new password">

    <button type="submit">Update Profile</button>
  </form>

  <?php if ($message): ?>
    <p class="msg <?= strpos($message, '✅') === 0 ? 'success' : 'error' ?>">
      <?= htmlspecialchars($message) ?>
    </p>
  <?php endif; ?>

  <div style="text-align:center; margin-top:1rem;">
    <a href="customer_orders.php" class="btn">⬅ Back to My Orders</a>
  </div>
</body>
</html>
