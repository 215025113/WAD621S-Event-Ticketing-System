<?php
require 'config.php';
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = $mysqli->real_escape_string($_POST['email']);
    $password = $_POST['password'];
    $stmt = $mysqli->prepare("SELECT id,name,password,role FROM users WHERE email=? LIMIT 1");
    $stmt->bind_param('s',$email);
    $stmt->execute();
    $res = $stmt->get_result();
    if($user = $res->fetch_assoc()){
        if(password_verify($password, $user['password'])){
            $_SESSION['user'] = ['id'=>$user['id'],'name'=>$user['name'],'role'=>$user['role']];
            header('Location: index.php');
            exit;
        } else $error = 'Invalid credentials';
    } else $error = 'User not found';
}
?>
<!doctype html><html><head><meta charset="utf-8"><title>Login</title><link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"></head>
<body class="bg-light">
<div class="container py-5">
  <h2>Login</h2>
  <?php if(!empty($error)): ?><div class="alert alert-danger"><?=htmlspecialchars($error)?></div><?php endif; ?>
  <form method="post">
    <div class="mb-3"><label>Email</label><input type="email" name="email" class="form-control" required></div>
    <div class="mb-3"><label>Password</label><input type="password" name="password" class="form-control" required></div>
    <button class="btn btn-primary">Login</button>
  </form>
</div>
</body></html>
