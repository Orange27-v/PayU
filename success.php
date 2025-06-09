<?php
// success.php

// Expected query params: payment_id, status, (maybe authorization_id)
$payment_id = $_GET['payment_id'] ?? null;
$status = $_GET['status'] ?? null;

?>
<!DOCTYPE html>
<html>
<head><title>Payment Success</title></head>
<body>
  <h1>Thank you! 🎉</h1>
  <?php if ($payment_id && $status): ?>
    <p>Your transaction ID: <strong><?= htmlspecialchars($payment_id) ?></strong></p>
    <p>Current status: <strong><?= htmlspecialchars($status) ?></strong></p>
    <p>Note: Final status will be confirmed via webhook—it may change if async processing is needed.</p>
  <?php else: ?>
    <p>Return parameters missing or invalid. Please contact support if your payment was successful.</p>
  <?php endif; ?>
</body>
</html>
