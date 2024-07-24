<?php
// Start the session and connect to the database
session_start();
require 'includes/db.php';

// Check if search form submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];

    // Query to retrieve patient information based on first name, last name, and phone number
    $stmt = $pdo->prepare('SELECT * FROM patients WHERE first_name = ? AND last_name = ? AND contact = ?');
    $stmt->execute([$first_name, $last_name, $phone_number]);
    $patient = $stmt->fetch(PDO::FETCH_ASSOC);

    // Display retrieved patient information
    if ($patient) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Patient Information</title>
            <link rel="stylesheet" href="css/styles.css">
            <!-- Include any additional stylesheets or libraries for styling -->
        </head>
        <body class="retrieve-page">
            <div class="container mt-5">
                <h2>Patient Information</h2>
                <div class="patient-info">
                    <p><strong>First Name:</strong> <?php echo $patient['first_name']; ?></p>
                    <p><strong>Last Name:</strong> <?php echo $patient['last_name']; ?></p>
                    <p><strong>Date of Birth:</strong> <?php echo $patient['date_of_birth']; ?></p>
                    <p><strong>Age:</strong> <?php echo $patient['age']; ?></p>
                    <p><strong>Nationality:</strong> <?php echo $patient['nationality']; ?></p>
                    <p><strong>Residence:</strong> <?php echo $patient['residence']; ?></p>
                    <p><strong>Contact Information:</strong> <?php echo $patient['contact']; ?></p>
                    <p><strong>Allergies:</strong> <?php echo $patient['allergies']; ?></p>
                    <p><strong>Medical History:</strong> <?php echo $patient['medical_history']; ?></p>
                    <p><strong>Current Medication:</strong> <?php echo $patient['current_medication']; ?></p>
                    <p><strong>Emergency Contact Name:</strong> <?php echo $patient['emergency_contact_name']; ?></p>
                    <p><strong>Emergency Contact Relation:</strong> <?php echo $patient['emergency_contact_relation']; ?></p>
                    <p><strong>Emergency Contact Phone:</strong> <?php echo $patient['emergency_contact_phone']; ?></p>
                </div>
                <!-- Back to Dashboard Button -->
<a href="dashboard.php" class="btn btn-secondary mt-3">Back to Dashboard</a>
            </div>
        </body>
        </html>
        <?php
    } else {
        echo "Patient not found.";
    }

    // You can redirect or show other content after displaying the patient information
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Patient</title>
    <link rel="stylesheet" href="css/styles.css">
    <!-- Include any additional stylesheets or libraries for styling -->
</head>
<body class="retrieve-page">
    <div class="container mt-5">
        <h2>Search Patient</h2>
        <form id="searchForm" action="retrieve_patient.php" method="post">
            <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" required>
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" required>
            </div>
            <div class="mb-3">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" required>
            </div>
            <button type="submit" name="search" class="btn btn-primary">Search</button>
            <a href="dashboard.php" class="btn btn-secondary mt-3">Back to Dashboard</a>
        </form>
    </div>
</body>
</html>
