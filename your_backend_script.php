<?php
// Access control
$allowed_emails = ['authorized_user@example.com']; // Add the allowed email(s) here
if (!in_array($_POST['email'], $allowed_emails)) {
  die("Unauthorized access.");
}

// Database connection (replace with your details)
$servername = "localhost";
$username = "your_db_user";
$password = "your_db_password";
$dbname = "your_database_name";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Prepare data
$incidentID = $_POST['incidentID'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$description = $_POST['description'];

// Insert data into database
$sql = "INSERT INTO contacts (incidentID, name, email, phone, description) VALUES ('$incidentID', '$name', '$email', '$phone', '$description')";
if ($conn->query($sql) === TRUE) {
  echo "Record saved successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

// Send email notification
$to = "your_email@example.com";
$subject = "New Contact Form Submission - ID: $incidentID";
$message = "Incident ID: $incidentID\nName: $name\nEmail: $email\nPhone: $phone\nDescription:\n$description";
$headers = "From: no-reply@yourwebsite.com";

mail($to, $subject, $message, $headers);

$conn->close();
?>
