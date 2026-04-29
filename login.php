<?php
session_start();
include 'db_connect.php';

$error ="";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $username = trim($_POST["username"] ?? '');
  $password = $_POST["password"] ?? '';

  if ($username === '' || $password === '') {
    $error = "⚠️ Please enter username and password.";
  } else {
    $stmt = $conn->prepare("SELECT id, username, password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
      $user = $result->fetch_assoc();
      // Verify hashed password (works with password_hash)
      if (password_verify($password, $user['password'])) {
        // Successful login
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["username"];
        $_SESSION["role"] = $user["role"];

        if ($user['role'] === 'admin') {
          $_SESSION['admin_logged_in']=true;
          header("Location: admin_dashboard.php");

        } /*else if($user["role"]==='customer'){
          $_SESSION['customer_logged_in']=true;
          header(header:'Location:customer_order.php');
          if($user['role']==='customer')
          header('Location:checkout.php');
        }*/
        
        else {
          $_SESSION['customer_logged_in']=true;
          header("Location: checkout.php");
      
        }
        exit();
      } else {
        $error = "❌ Invalid password.";
      }
    } else {
      // No user found -> offer registration
      $error = "⚠️ No account found. Please register.";
    }
    $stmt->close();
  }
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Login | AgroPark</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    body { text-align:center; padding:40px; background:#f4f4f4; font-family:Poppins,sans-serif; }
    form { background:#fff; padding:2rem; border-radius:10px; display:inline-block; box-shadow:0 2px 6px rgba(0,0,0,0.08); }
    input { width:280px; padding:0.6rem; margin:0.4rem 0; border:1px solid #ccc; border-radius:6px; }
    button { background:#2c5f2d; color:white; border:none; padding:0.6rem 1.2rem; border-radius:6px; cursor:pointer; }
    button:hover { background:#97bc62; }
    .error { color:#d9534f; font-weight:600; margin-top:10px; }
    .success { color:green; font-weight:600; margin-top:10px; }
  </style>
</head>
<body>
  <h2>🔐 Login</h2>
  <form method="POST">
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Login</button>
  </form>

  <?php if (isset($_GET['registered'])): ?>
    <p class="success">✅ Registration successful. Please log in.</p>
  <?php endif; ?>

  <?php if ($error): ?>
    <p class="error"><?= htmlspecialchars($error) ?></p>
  <?php endif; ?>

  <p>Don't have an account? <a href="register.php">Register here</a></p>
</body>
</html>



