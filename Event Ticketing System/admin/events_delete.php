<?php
require '../config.php';
if(empty($_SESSION['user']) || $_SESSION['user']['role']!=='admin'){ die('Access denied'); }
$id = intval($_GET['id'] ?? 0);
$mysqli->query("DELETE FROM events WHERE id=$id");
header('Location: dashboard.php');
exit;
?>
