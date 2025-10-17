<?php
require '../config.php';
if(empty($_SESSION['user']) || $_SESSION['user']['role']!=='admin'){ die('Access denied'); }
$events = $mysqli->query("SELECT * FROM events ORDER BY event_date DESC");
?>
<!doctype html><html><head><meta charset="utf-8"><title>Admin Dashboard</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="bg-light">
<div class="container py-4">
  <h1>Admin Dashboard</h1>
  <a class="btn btn-primary" href="events_add.php">Add Event</a>
  <table class="table mt-3">
    <thead><tr><th>Title</th><th>Date</th><th>Capacity</th><th>Actions</th></tr></thead>
    <tbody>
    <?php while($e = $events->fetch_assoc()): ?>
      <tr>
        <td><?=htmlspecialchars($e['title'])?></td>
        <td><?=$e['event_date']?></td>
        <td><?=$e['capacity']?></td>
        <td>
          <a class="btn btn-sm btn-secondary" href="events_edit.php?id=<?=$e['id']?>">Edit</a>
          <a class="btn btn-sm btn-danger" href="events_delete.php?id=<?=$e['id']?>" onclick="return confirm('Delete?')">Delete</a>
        </td>
      </tr>
    <?php endwhile; ?>
    </tbody>
  </table>
</div>
</body></html>
