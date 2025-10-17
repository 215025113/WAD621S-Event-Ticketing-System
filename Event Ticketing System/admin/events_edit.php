<?php
require '../config.php';
if(empty($_SESSION['user']) || $_SESSION['user']['role']!=='admin'){ die('Access denied'); }
$id = intval($_GET['id'] ?? 0);
$stmt = $mysqli->prepare("SELECT * FROM events WHERE id=?"); $stmt->bind_param('i',$id); $stmt->execute();
$event = $stmt->get_result()->fetch_assoc();
if(!$event) die('Not found');
if($_SERVER['REQUEST_METHOD']==='POST'){
    $title = $mysqli->real_escape_string($_POST['title']);
    $desc = $mysqli->real_escape_string($_POST['description']);
    $venue = $mysqli->real_escape_string($_POST['venue']);
    $date = $_POST['event_date'];
    $cap = intval($_POST['capacity']);
    $up = $mysqli->prepare("UPDATE events SET title=?,description=?,venue=?,event_date=?,capacity=? WHERE id=?");
    $up->bind_param('ssssii',$title,$desc,$venue,$date,$cap,$id);
    if($up->execute()) header('Location: dashboard.php');
    else $error = $up->error;
}
?>
<!doctype html><html><head><meta charset="utf-8"><title>Edit Event</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="bg-light"><div class="container py-4"><h2>Edit Event</h2>
<?php if(!empty($error)): ?><div class="alert alert-danger"><?=$error?></div><?php endif; ?>
<form method="post">
  <div class="mb-3"><label>Title</label><input name="title" class="form-control" value="<?=htmlspecialchars($event['title'])?>" required></div>
  <div class="mb-3"><label>Description</label><textarea name="description" class="form-control"><?=htmlspecialchars($event['description'])?></textarea></div>
  <div class="mb-3"><label>Venue</label><input name="venue" class="form-control" value="<?=htmlspecialchars($event['venue'])?>"></div>
  <div class="mb-3"><label>Date</label><input type="date" name="event_date" class="form-control" value="<?=$event['event_date']?>" required></div>
  <div class="mb-3"><label>Capacity</label><input type="number" name="capacity" class="form-control" value="<?=$event['capacity']?>" required></div>
  <button class="btn btn-primary">Save</button>
</form></div></body></html>
