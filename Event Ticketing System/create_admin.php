<?php
require 'config.php';

$name = 'System Admin';
$email = 'junias@byteboxtechnologie.com';
$password_plain = 'Admin0000'; 

$hash = password_hash($password_plain, PASSWORD_DEFAULT);

// Check if admin already exists
$check = $mysqli->prepare("SELECT id FROM users WHERE email=?");
$check->bind_param('s', $email);
$check->execute();
$res = $check->get_result();

if ($res->num_rows > 0) {
    echo "<h3>Admin already exists!</h3>";
} else {
    $stmt = $mysqli->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'admin')");
    $stmt->bind_param('sss', $name, $email, $hash);
    if ($stmt->execute()) {
        echo "<h3> Admin created successfully!</h3>";
        echo "<p>Email: <strong>$email</strong><br>Password: <strong>$password_plain</strong></p>";
        echo "<p>You can now <a href='login.php'>log in here</a>.</p>";
    } else {
        echo "<h3> Error creating admin: " . htmlspecialchars($stmt->error) . "</h3>";
    }
}
?>
