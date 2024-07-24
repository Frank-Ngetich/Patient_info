<?php
// Start the session and connect to the database
session_start();
require 'includes/db.php';

// Process the form when submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $date_of_birth = $_POST['date_of_birth'];
    $age = $_POST['age'];
    $nationality = $_POST['nationality'];
    $residence = $_POST['residence'];
    $contact = $_POST['contact'];
    $allergies = $_POST['allergies'];
    $medical_history = $_POST['medical_history'];
    $current_medication = $_POST['current_medication'];
    $emergency_contact_name = $_POST['emergency_contact_name'];
    $emergency_contact_relation = $_POST['emergency_contact_relation'];
    $emergency_contact_phone = $_POST['emergency_contact_phone'];

    // Insert the patient data into the database
    $stmt = $pdo->prepare('INSERT INTO patients (first_name, last_name, date_of_birth, age, nationality, residence, contact, allergies, medical_history, current_medication, emergency_contact_name, emergency_contact_relation, emergency_contact_phone) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$first_name, $last_name, $date_of_birth, $age, $nationality, $residence, $contact, $allergies, $medical_history, $current_medication, $emergency_contact_name, $emergency_contact_relation, $emergency_contact_phone]);

    // Redirect to the dashboard
    header('Location: dashboard.php');
    exit;
}

// Include the header
include 'templates/header.php';
?>

<!-- HTML and CSS for the registration form -->
<link rel="stylesheet" href="css/styles.css">
<body class="register-page">
<div class="container mt-5">
    <h2>Register New Patient</h2>
    <form id="registrationForm" action="register_patient.php" method="post">
        <!-- Step 1: Personal Information -->
        <div class="form-step form-step-active">
            <h3>Personal Information</h3>
            <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" required>
            </div>
            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" required>
            </div>
            <div class="mb-3">
                <label for="date_of_birth" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">Age</label>
                <input type="number" class="form-control" id="age" name="age" required>
            </div>
            <div class="mb-3">
                <label for="nationality" class="form-label">Nationality</label>
                <input type="text" class="form-control" id="nationality" name="nationality" required>
            </div>
            <div class="mb-3">
                <label for="residence" class="form-label">Residence</label>
                <input type="text" class="form-control" id="residence" name="residence" required>
            </div>
            <div class="mb-3">
                <label for="contact" class="form-label">Contact Information</label>
                <input type="text" class="form-control" id="contact" name="contact" required>
            </div>
            <button type="button" class="btn btn-primary" onclick="nextStep()">Next</button>
            <a href="dashboard.php" class="btn btn-secondary mt-3">Back to Dashboard</a>
        </div>
        
        <!-- Step 2: Medical Records -->
        <div class="form-step">
            <h3>Medical Records</h3>
            <div class="mb-3">
                <label for="allergies" class="form-label">Allergies</label>
                <textarea class="form-control" id="allergies" name="allergies"></textarea>
            </div>
            <div class="mb-3">
                <label for="medical_history" class="form-label">Medical History</label>
                <textarea class="form-control" id="medical_history" name="medical_history"></textarea>
            </div>
            <div class="mb-3">
                <label for="current_medication" class="form-label">Current Medication</label>
                <textarea class="form-control" id="current_medication" name="current_medication"></textarea>
            </div>
            <button type="button" class="btn btn-secondary" onclick="prevStep()">Previous</button>
            <button type="button" class="btn btn-primary" onclick="nextStep()">Next</button>
        </div>
        
        <!-- Step 3: Emergency Contacts -->
        <div class="form-step">
            <h3>Emergency Contacts</h3>
            <div class="mb-3">
                <label for="emergency_contact_name" class="form-label">Contact Name</label>
                <input type="text" class="form-control" id="emergency_contact_name" name="emergency_contact_name" required>
            </div>
            <div class="mb-3">
                <label for="emergency_contact_relation" class="form-label">Relation</label>
                <input type="text" class="form-control" id="emergency_contact_relation" name="emergency_contact_relation" required>
            </div>
            <div class="mb-3">
                <label for="emergency_contact_phone" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="emergency_contact_phone" name="emergency_contact_phone" required>
            </div>
            <button type="button" class="btn btn-secondary" onclick="prevStep()">Previous</button>
            <button type="submit" class="btn btn-success">Submit</button>
        </div>
    </form>
</div>
</body>
<!-- Include the JavaScript for multistep form functionality -->
<script src="js/multistep.js"></script>

<!-- Include the footer -->
<?php include 'templates/footer.php'; ?>
