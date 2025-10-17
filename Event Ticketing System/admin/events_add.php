<?php
require '../config.php';
if(empty($_SESSION['user']) || $_SESSION['user']['role']!=='admin'){ die('Access denied'); }
if($_SERVER['REQUEST_METHOD']==='POST'){
    $title = $mysqli->real_escape_string($_POST['title']);
    $desc = $mysqli->real_escape_string($_POST['description']);
    $venue = $mysqli->real_escape_string($_POST['venue']);
    $date = $_POST['event_date'];
    $cap = intval($_POST['capacity']);
    $stmt = $mysqli->prepare("INSERT INTO events (title,description,venue,event_date,capacity) VALUES (?,?,?,?,?)");
    $stmt->bind_param('ssssi',$title,$desc,$venue,$date,$cap);
    if($stmt->execute()) header('Location: dashboard.php');
    else $error = $stmt->error;
}
?>
<!doctype html><html><head><meta charset="utf-8"><title>Add Event</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="bg-light"><div class="container py-4"><h2>Add Event</h2>
<?php if(!empty($error)): ?><div class="alert alert-danger"><?=$error?></div><?php endif; ?>
<form method="post">
  <div class="mb-3"><label>Title</label><input name="title" class="form-control" required></div>
  <div class="mb-3"><label>Description</label><textarea name="description" class="form-control"></textarea></div>
  <div class="mb-3"><label>Venue</label><input name="venue" class="form-control"></div>
  <div class="mb-3"><label>Date</label><input type="date" name="event_date" class="form-control" required></div>
  <div class="mb-3"><label>Capacity</label><input type="number" name="capacity" class="form-control" required></div>
  <button class="btn btn-success">Create</button>
</form></div></body></html>
