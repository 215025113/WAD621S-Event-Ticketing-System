<?php
require 'config.php';
if(!isset($_SESSION['user'])){ header('Location: login.php'); exit; }
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $user_id = $_SESSION['user']['id'];
    $event_id = intval($_POST['event_id']);
    $seat = $mysqli->real_escape_string($_POST['seat'] ?? '');
    // simple ticket code: user-event-timestamp-rand
    $ticket_code = bin2hex(random_bytes(8));
    $stmt = $mysqli->prepare("INSERT INTO bookings (user_id,event_id,seat_number,ticket_code) VALUES (?,?,?,?)");
    $stmt->bind_param('iiss',$user_id,$event_id,$seat,$ticket_code);
    if($stmt->execute()){
        header('Location: my_tickets.php');
        exit;
    } else {
        die('Booking failed: ' . $stmt->error);
    }
}
header('Location: index.php');
exit;
?>
