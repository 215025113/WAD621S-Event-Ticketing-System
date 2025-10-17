<?php
require 'config.php';
$result = $mysqli->query("SELECT * FROM events ORDER BY event_date ASC");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Campus Events</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="/">Campus Tickets</a>
    <div>
      <?php if(isset($_SESSION['user'])): ?>
        <a class="btn btn-outline-light btn-sm" href="my_tickets.php">My Tickets</a>
        <a class="btn btn-outline-light btn-sm" href="logout.php">Logout</a>
      <?php else: ?>
        <a class="btn btn-outline-light btn-sm" href="login.php">Login</a>
        <a class="btn btn-outline-light btn-sm" href="register.php">Register</a>
      <?php endif; ?>
    </div>
  </div>
</nav>
<div class="container py-4">
  <h1>Upcoming Events</h1>
  <div class="row">
    <?php while($row = $result->fetch_assoc()): ?>
    <div class="col-md-4">
      <div class="card mb-3">
        <div class="card-body">
          <h5 class="card-title"><?=htmlspecialchars($row['title'])?></h5>
          <p class="card-text"><?=nl2br(htmlspecialchars(substr($row['description'],0,150)))?></p>
          <p><strong>Date:</strong> <?=htmlspecialchars($row['event_date'])?></p>
          <a href="event.php?id=<?=$row['id']?>" class="btn btn-primary">View & Book</a>
        </div>
      </div>
    </div>
    <?php endwhile; ?>
  </div>
</div>
</body>
</html>
