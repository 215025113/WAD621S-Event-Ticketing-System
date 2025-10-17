<?php
require 'config.php';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = $mysqli->real_escape_string($_POST['name']);
    $email = $mysqli->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt = $mysqli->prepare("INSERT INTO users (name,email,password) VALUES (?,?,?)");
    $stmt->bind_param('sss',$name,$email,$password);
    if($stmt->execute()){
        header('Location: login.php');
        exit;
    } else {
        $error = 'Registration failed: ' . $stmt->error;
    }
}
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Register</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="bg-light">
<div class="container py-5">
  <h2>Register</h2>
  <?php if(!empty($error)): ?><div class="alert alert-danger"><?=htmlspecialchars($error)?></div><?php endif; ?>
  <form method="post">
    <div class="mb-3"><label class="form-label">Name</label><input class="form-control" name="name" required></div>
    <div class="mb-3"><label class="form-label">Email</label><input type="email" class="form-control" name="email" required></div>
    <div class="mb-3"><label class="form-label">Password</label><input type="password" class="form-control" name="password" required></div>
    <button class="btn btn-primary">Create account</button>
  </form>
</div>
</body></html>
