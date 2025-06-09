<?php
// failure.php

$payment_id = $_GET['payment_id'] ?? null;
$status = $_GET['status'] ?? null;
?>
<!DOCTYPE html>
<html>
<head><title>Payment Failed</title></head>
<body>
  <h1>Payment Unsuccessful</h1>
  <?php if ($payment_id): ?>
    <p>Transaction ID: <strong><?= htmlspecialchars($payment_id) ?></strong></p>
    <p>Status: <strong><?= htmlspecialchars($status ?: 'failed') ?></strong></p>
    <p>Please try again or contact support if this issue persists.</p>
  <?php else: ?>
    <p>An unknown error occurred. Please try again.</p>
  <?php endif; ?>
</body>
</html>
