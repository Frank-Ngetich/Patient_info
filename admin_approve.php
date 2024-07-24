<?php
session_start();
require 'includes/db.php';

// Check if the logged-in user is an admin
if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit;
}

// Fetch all healthcare providers
$stmt = $pdo->prepare('SELECT * FROM healthcare_providers');
$stmt->execute();
$healthcare_providers = $stmt->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['approve_user_id'])) {
        // Approve user
        $user_id = $_POST['approve_user_id'];
        $stmt = $pdo->prepare('UPDATE healthcare_providers SET approved = 1 WHERE id = ?');
        $stmt->execute([$user_id]);
    } elseif (isset($_POST['delete_user_id'])) {
        // Delete user
        $user_id = $_POST['delete_user_id'];
        $stmt = $pdo->prepare('DELETE FROM healthcare_providers WHERE id = ?');
        $stmt->execute([$user_id]);
    }
    header('Location: admin_approve.php');
    exit;
}

include 'templates/header.php';
?>
<h2>Manage Healthcare Providers</h2>
<div class="provider-list">
    <?php foreach ($healthcare_providers as $provider) : ?>
        <div class="provider-item">
            <span><?php echo htmlspecialchars($provider['username']) . ' (Medical No: ' . htmlspecialchars($provider['medical_no']) . ')'; ?></span>
            <div class="provider-actions">
                <form action="admin_approve.php" method="post" class="inline-form">
                    <?php if ($provider['approved'] == 0) : ?>
                        <input type="hidden" name="approve_user_id" value="<?php echo $provider['id']; ?>">
                        <button type="submit" class="approve-button">Approve</button>
                    <?php endif; ?>
                </form>
                <form action="admin_approve.php" method="post" class="inline-form">
                    <input type="hidden" name="delete_user_id" value="<?php echo $provider['id']; ?>">
                    <button type="submit" class="delete-button">Delete</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</div>
<?php include 'templates/footer.php'; ?>
