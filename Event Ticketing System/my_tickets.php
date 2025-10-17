<?php
require 'config.php';
if(!isset($_SESSION['user'])){ header('Location: login.php'); exit; }
$uid = $_SESSION['user']['id'];
$stmt = $mysqli->prepare("SELECT b.*, e.title, e.event_date FROM bookings b JOIN events e ON b.event_id=e.id WHERE b.user_id=? ORDER BY b.created_at DESC");
$stmt->bind_param('i',$uid);
$stmt->execute();
$res = $stmt->get_result();
?>
<!doctype html><html><head><meta charset="utf-8"><title>My Tickets</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="bg-light">
<div class="container py-4">
  <h1>My Tickets</h1>
  <?php while($row = $res->fetch_assoc()): ?>
    <div class="card mb-3">
      <div class="card-body">
        <h5><?=htmlspecialchars($row['title'])?></h5>
        <p><strong>Date:</strong> <?=htmlspecialchars($row['event_date'])?></p>
        <p><strong>Seat:</strong> <?=htmlspecialchars($row['seat_number'])?></p>
        <p><strong>Ticket code:</strong> <?=htmlspecialchars($row['ticket_code'])?></p>
        <p><strong>QR:</strong><br>
          <!-- Uses Google Chart API to render QR. Replace with server-side lib if needed. -->
          <img src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=<?=urlencode($row['ticket_code'])?>" alt="QR">
        </p>
      </div>
    </div>
  <?php endwhile; ?>
</div>
</body></html>
