<?php
session_start();
require 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $medical_no = $_POST['medical_no'] ?? ''; // Check if the key exists and provide a default value
    $password = $_POST['password'] ?? ''; // Check if the key exists and provide a default value

    // Fetch the healthcare provider by medical number
    $stmt = $pdo->prepare('SELECT * FROM healthcare_providers WHERE medical_no = ? AND approved = 1');
    $stmt->execute([$medical_no]);
    $provider = $stmt->fetch();

    if ($provider && password_verify($password, $provider['password'])) {
        $_SESSION['user_id'] = $provider['id'];
        header('Location: dashboard.php');
        exit;
    } else {
        $error_message = 'Invalid login credentials or not yet approved.';
    }
}

include 'templates/header.php';
?>
<link rel="stylesheet" href="css/styles.css">
<body class="login-page">
<div class="login-container">
    <h2>Login</h2>
    <form action="login.php" method="post">
        <div class="form-group">
            <label for="medical_no">Medical Number</label>
            <input type="text" id="medical_no" name="medical_no" placeholder="Enter your medical number" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
    <?php
    if (isset($error_message)) {
        echo '<p class="error-message">' . $error_message . '</p>';
    }
    ?>
    <p class="register-link">Don't have an account? <a href="register.php">Register here</a></p>
</div>
</body>
<?php include 'templates/footer.php'; ?>
