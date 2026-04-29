<?php
session_start();
if (!isset($_SESSION["admin_logged_in"]) || $_SESSION["admin_logged_in"] !== true) {
  header("Location: login.php");
  exit();
}

include 'db_connect.php';

// Get filters from query string
$startDate = $_GET['start'] ?? '';
$endDate = $_GET['end'] ?? '';

$whereClause = "WHERE 1=1";
if (!empty($startDate) && !empty($endDate)) {
  $whereClause .= " AND DATE(order_date) BETWEEN '$startDate' AND '$endDate'";
}

// Fetch order data
$sql = "SELECT id, customer_name, email, phone, address, total, status, payment_method, payment_status, order_date 
        FROM orders $whereClause ORDER BY order_date DESC";
$result = $conn->query($sql);

// Set headers to download CSV
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="sales_report_' . date('Y-m-d') . '.csv"');

// Open output buffer
$output = fopen('php://output', 'w');

// Add CSV header row
fputcsv($output, ['Order ID', 'Customer Name', 'Email', 'Phone', 'Address', 'Total ($)', 'Order Status', 'Payment Method', 'Payment Status', 'Order Date']);

// Add rows
while ($row = $result->fetch_assoc()) {
  fputcsv($output, [
    $row['id'],
    $row['customer_name'],
    $row['email'],
    $row['phone'],
    $row['address'],
    number_format($row['total'], 2),
    $row['status'],
    $row['payment_method'],
    $row['payment_status'],
    $row['order_date']
  ]);
}

fclose($output);
exit;
?>
