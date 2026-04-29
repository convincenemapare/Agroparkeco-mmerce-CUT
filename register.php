<?php
session_start();
include 'db_connect.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $full_name = trim($_POST['full_name'] ?? '');
  $username  = trim($_POST['username'] ?? '');
  $email     = trim($_POST['email'] ?? '');
  $password  = $_POST['password'] ?? '';
  $confirm   = $_POST['confirm_password'] ?? '';

  // Basic validation
  if ($username === '' || $email === '' || $password === '' || $confirm === '') {
    $message = "⚠️ Please fill all required fields.";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $message = "❌ Invalid email address.";
  } elseif ($password !== $confirm) {
    $message = "❌ Passwords do not match.";
  } elseif (strlen($password) < 6) {
    $message = "⚠️ Password should be at least 6 characters.";
  } else {
    // Hash with PHP's built-in secure function
    $hashed = password_hash($password, PASSWORD_DEFAULT);

    // Check if username or email exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
      $message = "⚠️ Username or email already exists.";
      $stmt->close();
    } else {
      $stmt->close();
      $insert = $conn->prepare("INSERT INTO users (full_name, username, email, password, role) VALUES (?, ?, ?, ?, 'customer')");
      $insert->bind_param("ssss", $full_name, $username, $email, $hashed);

      if ($insert->execute()) {
        // Successful registration -> redirect to login with a flag
        header("Location: login.php?registered=1");
        exit();
      } else {
        $message = "❌ Registration failed: " . htmlspecialchars($conn->error);
      }
      $insert->close();
    }
  }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Register | AgroPark</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    body { text-align:center; padding:40px; background:#f4f4f4; font-family:Poppins,sans-serif; }
    form { background:#fff; padding:2rem; border-radius:10px; display:inline-block; box-shadow:0 2px 6px rgba(0,0,0,0.08); }
    input { width:280px; padding:0.6rem; margin:0.4rem 0; border:1px solid #ccc; border-radius:6px; }
    button { background:#2c5f2d; color:white; border:none; padding:0.6rem 1.2rem; border-radius:6px; cursor:pointer; }
    button:hover { background:#97bc62; }
    .msg { margin-top:12px; color:#2c5f2d; font-weight:600; }
    .error { color:#d9534f; }
  </style>
</head>
<body>
  <h2>📝 Create Your Account</h2>
  <form method="POST" autocomplete="new-password">
    <input type="text" name="full_name" placeholder="Full name (optional)"><br>
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="password" name="password" placeholder="Password" required autocomplete="new-password"><br>
    <input type="password" name="confirm_password" placeholder="Confirm password" required autocomplete="new-password"><br>
    <button type="submit">Register</button>
  </form>

  <?php if ($message): ?>
    <p class="<?= strpos($message, '❌') === 0 ? 'error' : 'msg' ?>"><?= htmlspecialchars($message) ?></p>
  <?php endif; ?>

  <p>Already have an account? <a href="login.php">Login here</a></p>
</body>
</html>



