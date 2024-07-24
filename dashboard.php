<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require 'includes/db.php';
$stmt = $pdo->prepare('SELECT * FROM healthcare_providers WHERE id = ?');
$stmt->execute([$_SESSION['user_id']]);
$provider = $stmt->fetch();

include 'templates/header.php';
?>
<link rel="stylesheet" href="css/styles.css">

<div class="jumbotron text-center bg-primary text-white">
    <h1 class="display-4">Welcome, <?php echo htmlspecialchars($provider['username']); ?>!</h1>
</div>

<div class="dashboard">
    <div class="card">
        <img src="images/patient_management.jpg" class="card-img-top" alt="Patient Management">
        <div class="card-body">
            <h2 class="card-title">Patient Management</h2>
            <a href="register_patient.php" class="btn btn-primary mb-2">Register New Patient</a>
            <a href="retrieve_patient.php" class="btn btn-primary">Retrieve Patient Information</a>
        </div>
    </div>
    <div class="card">
        <img src="images/healthcare_tips.jpg" class="card-img-top" alt="Healthcare Tips">
        <div class="card-body">
            <h2 class="card-title">Healthcare Tips</h2>
            <ul>
                <li>Stay hydrated by drinking plenty of water.</li>
                <li>Eat a balanced diet rich in fruits and vegetables.</li>
                <li>Exercise regularly to maintain physical fitness.</li>
            </ul>
        </div>
    </div>
    <div class="card">
        <img src="images/did_you_know.jpg" class="card-img-top" alt="Did You Know">
        <div class="card-body">
            <h2 class="card-title">Did You Know?</h2>
            <ul>
                <li>The human body has 206 bones.</li>
                <li>Heart disease is the leading cause of death worldwide.</li>
                <li>A healthy diet can boost your immune system.</li>
            </ul>
        </div>
    </div>
</div>

<nav class="navbar fixed-bottom navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Dashboard</a>
        <form class="d-flex" action="logout.php" method="post">
            <button class="btn btn-danger" type="submit">Logout</button>
        </form>
    </div>
</nav>

<?php include 'templates/footer.php'; ?>
