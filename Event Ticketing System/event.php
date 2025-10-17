<?php
require 'config.php';
$id = intval($_GET['id'] ?? 0);
$stmt = $mysqli->prepare("SELECT * FROM events WHERE id=?");
$stmt->bind_param('i',$id);
$stmt->execute();
$event = $stmt->get_result()->fetch_assoc();
if(!$event){ die('Event not found'); }
?>
<!doctype html><html><head><meta charset="utf-8"><title><?=htmlspecialchars($event['title'])?></title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="bg-light">
<div class="container py-4">
  <a href="index.php">&laquo; Back</a>
  <h1><?=htmlspecialchars($event['title'])?></h1>
  <p><?=nl2br(htmlspecialchars($event['description']))?></p>
  <p><strong>Date:</strong> <?=$event['event_date']?></p>
  <p><strong>Capacity:</strong> <?=$event['capacity']?></p>
  <?php if(isset($_SESSION['user'])): ?>
    <form method="post" action="book.php">
      <input type="hidden" name="event_id" value="<?=$event['id']?>">
      <div class="mb-3"><label>Seat (optional)</label><input name="seat" class="form-control"></div>
      <button class="btn btn-success">Book Ticket</button>
    </form>
  <?php else: ?>
    <p><a href="login.php" class="btn btn-primary">Login to book</a></p>
  <?php endif; ?>
</div>
</body></html>
