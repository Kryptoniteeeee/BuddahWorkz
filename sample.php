<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Retrieve the selected date from the form
  $selectedDate = $_POST['selected_date'];

  // Send confirmation email
  $to = 'example@example.com'; // Set the recipient email address
  $subject = 'Appointment Confirmation';
  $message = "Thank you for selecting the date: $selectedDate. Please log in to complete the process."; // Customize the email message
  $headers = "From: your_email@example.com"; // Set the sender email address
  mail($to, $subject, $message, $headers);

  // Redirect to the login page
  header("Location: login.php");
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Date Selection</title>
</head>
<body>
  <h2>Select a Date</h2>
  <form method="POST" action="">
    <label for="selected_date">Date:</label>
    <input type="date" name="selected_date" id="selected_date" required>
    <br>
    <button type="submit">Submit</button>
  </form>
</body>
</html>
