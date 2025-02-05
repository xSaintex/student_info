<?php
include "../database/database.php";

try {
  if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST['id'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE todo SET status = ? WHERE id = ?");
    $stmt->bind_param("ii", $status, $id);

    if ($stmt->execute()) {
      header("Location: ../index.php");
      exit;
    } else {
      echo "Operation failed";
    }
  }
} catch (\Exception $e) {
  echo "Error: " . $e;
}