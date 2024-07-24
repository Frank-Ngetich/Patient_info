<?php
session_start();
require 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $medical_no = $_POST['medical_no'];

    // Check if medical number is unique
    $stmt = $pdo->prepare('SELECT * FROM healthcare_providers WHERE medical_no = ?');
    $stmt->execute([$medical_no]);
    if ($stmt->fetch()) {
        $error_message = 'Medical number already exists.';
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert the new healthcare provider into the database
        $stmt = $pdo->prepare('INSERT INTO healthcare_providers (username, password, medical_no, approved) VALUES (?, ?, ?, 0)');
        $stmt->execute([$username, $hashed_password, $medical_no]);

        echo 'Registration successful. Please wait for admin approval.';
        exit;
    }
}

include 'templates/header.php';
?>
<link rel="stylesheet" href="css/styles.css">
<div class="register-container">
    <h2>Register</h2>
    <form action="register.php" method="post">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Enter your username" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
        </div>
        <div class="form-group">
            <label for="medical_no">Medical Number</label>
            <input type="text" id="medical_no" name="medical_no" placeholder="Enter your medical number" required>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
    <?php
    if (isset($error_message)) {
        echo '<p class="error-message">' . $error_message . '</p>';
    }
    ?>
    <p class="login-link">Already have an account? <a href="login.php">Login here</a></p>
</div>
<?php include 'templates/footer.php'; ?>
