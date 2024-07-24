<?php
session_start();
require 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare('SELECT * FROM admins WHERE username = ?');
    $stmt->execute([$username]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin_id'] = $admin['id'];
        header('Location: admin_approve.php');
        exit;
    } else {
        $error_message = 'Invalid login credentials.';
    }
}
?>

<?php include 'templates/header.php'; ?>
<h2>Admin Login</h2>
<form action="admin_login.php" method="post">
    <input type="text" name="username" placeholder="Username" value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>
<?php
if (isset($error_message)) {
    echo '<p style="color: red;">' . $error_message . '</p>';
}
?>
<?php include 'templates/footer.php'; ?>
