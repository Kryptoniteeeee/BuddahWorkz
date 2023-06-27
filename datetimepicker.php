<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $datetime = $_POST['datetime'];

  $conn = new PDO("mysql:host=localhost;dbname=your_database", "username", "password");

  $stmt = $conn->prepare("INSERT INTO your_table (datetime_column) VALUES (?)");
  $stmt->execute([$datetime]);

  if ($stmt->rowCount() > 0) {
    echo 'Datetime inserted successfully!';
  } else {
    echo 'Error inserting datetime into the database.';
  }
} else {
  echo 'Invalid request';
}
?>
