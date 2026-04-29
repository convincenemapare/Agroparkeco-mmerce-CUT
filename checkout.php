<?php
include 'db_connect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name = trim($_POST['name']);
  $email = trim($_POST['email']);
  $phone = trim($_POST['phone']);
  $address = trim($_POST['address']);
  $payment_method = trim($_POST['payment_method']);
  $payment_status = $_POST['payment_status'] ?? 'Pending';
  $cart = json_decode($_POST['cart'], true);

  $total = 0;
  foreach ($cart as $item) {
    $total += $item['price'] * $item['quantity'];
  }

  // Insert order
  $stmt = $conn->prepare("INSERT INTO orders (customer_name, email, phone, address, total, payment_method, payment_status) VALUES (?, ?, ?, ?, ?, ?, ?)");
  $stmt->bind_param("ssssiss", $name, $email, $phone, $address, $total, $payment_method, $payment_status);
  $stmt->execute();
  $order_id = $stmt->insert_id;
  $stmt->close();

  // Insert order items
  $itemStmt = $conn->prepare("INSERT INTO order_items (order_id, product_name, quantity, price) VALUES (?, ?, ?, ?)");
  foreach ($cart as $item) {
    $itemStmt->bind_param("isid", $order_id, $item['name'], $item['quantity'], $item['price']);
    $itemStmt->execute();
  }
  $itemStmt->close();

  // Success message
  echo "<script>
    localStorage.removeItem('cart');
    alert('✅ Payment Successful! Your Order #$order_id has been placed.');
    window.location.href = 'index.php';
  </script>";
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout | AgroPark</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    body { font-family: Poppins, sans-serif; padding:2rem; background:#f4f4f4; }
    form { background:white; padding:2rem; border-radius:10px; max-width:600px; margin:auto; box-shadow:0 2px 6px rgba(0,0,0,0.1); }
    input, textarea, select { width:100%; padding:0.6rem; margin:0.5rem 0; border:1px solid #ccc; border-radius:6px; }
    button { background:#2c5f2d; color:white; border:none; padding:0.8rem 1.5rem; border-radius:6px; cursor:pointer; font-weight:600; }
    button:hover { background:#97bc62; }
    h2 { text-align:center; color:#2c5f2d; }
    .payment-options { display:flex; flex-direction:column; gap:0.5rem; margin:1rem 0;}
  </style>
</head>
<body>
  <h2>🧾 Checkout</h2>
  <form method="POST" id="checkoutForm">
    <label>Full Name:</label>
    <input type="text" name="name" required>

    <label>Email:</label>
    <input type="email" name="email" required>

    <label>Phone:</label>
    <input type="text" name="phone" required>

    <label>Delivery Address:</label>
    <textarea name="address" rows="3" required></textarea>

    <label>Choose Payment Method:</label>
      <div class="payment-options">
      <label><input type="radio" name="payment_method" value="PayPal" required> PayPal (Simulated)</label>
      <label><input type="radio" name="payment_method" value="EcoCash" required> EcoCash (Simulated)</label>
      <label><input type="radio" name="payment_method" value="OneMoney" required> OneMoney (Simulated)</label>
      <label><input type="radio" name="payment_method" value="TestCard" required> Debit/Credit Card (Simulated)</label>
    </div>

    <input type="hidden" name="cart" id="cartData">
    <input type="hidden" name="payment_status" id="paymentStatus" value="Pending">

    <button type="button" id="payBtn">Proceed to Payment</button>
  </form>

 <script>
    // Load cart data
    const cart = JSON.parse(localStorage.getItem('cart') || '[]');
    if (cart.length === 0) {
      alert("Your cart is empty. Please add items first!");
      window.location.href = "products.php";
    }
    document.getElementById('cartData').value = JSON.stringify(cart);

    // Payment simulation
    const payBtn = document.getElementById('payBtn');
    payBtn.addEventListener('click', () => {
      const method = document.querySelector('input[name="payment_method"]:checked');
      if (!method) return alert("Please select a payment method.");
      
      const confirmPay = confirm(`Simulate payment with ${method.value}?`);
      if (!confirmPay) return;

      // Random payment outcome (success/failure)
      const success = Math.random() > 0.2; // 80% chance success
      document.getElementById('paymentStatus').value = success ? 'Success' : 'Failed';

      if (success) {
        alert(`✅ ${method.value} payment successful!`);
        document.getElementById('checkoutForm').submit();
      } else {
        alert(`❌ ${method.value} payment failed. Try again.`);
      }
    });
  </script>

<!-- Add this before </body> -
<script src="https://www.paypal.com/sdk/js?client-id=AZw-icHxB4ou9t4NF0gIGggUE9lXKmg43VbzMoAEG9OHq1gyeuXmsL6Lwp-uP6SnI-Hj7VuivXDQvEQ6&currency=USD"></script>

<div id="paypal-button-container" style="max-width:400px;margin:2rem auto;"></div>

<script>
  const cart = JSON.parse(localStorage.getItem('cart') || '[]');
  let total = 0;
  cart.forEach(item => total += item.price * item.quantity);

  document.getElementById('cartData').value = JSON.stringify(cart);

  paypal.Buttons({
    createOrder: (data, actions) => {
      return actions.order.create({
        purchase_units: [{
          amount: { value: total.toFixed(2) }
        }]
      });
    },
    onApprove: (data, actions) => {
      return actions.order.capture().then(details => {
        // mark payment success and submit form
        document.getElementById('paymentStatus').value = 'Success';
        alert(`✅ Payment completed by ${details.payer.name.given_name}`);
        document.getElementById('checkoutForm').submit();
      });
    },
    onError: (err) => {
      alert('❌ Payment error: ' + err);
      document.getElementById('paymentStatus').value = 'Failed';
    }
  }).render('#paypal-button-container');
</script>-->


</body>
</html>


