<?php
require 'includes/db.php';

$username = 'frank';
$password = 'Frank254';
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$stmt = $pdo->prepare('INSERT INTO admins (username, password) VALUES (?, ?)');
$stmt->execute([$username, $hashed_password]);

echo 'Admin account created.';
?>
