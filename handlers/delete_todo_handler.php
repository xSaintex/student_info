<?php
include "../database/database.php";

$id = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM students WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
  header("Location: ../index.php");
  exit;
} else {
  echo "Operation failed";
}
?>