<?php
include "../database/database.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = intval($_POST['id']);
    $name = trim($_POST['name']);
    $program = trim($_POST['program']);
    $college = trim($_POST['college']);
    $year = intval($_POST['year']);
    $grade = floatval($_POST['grade']);

    $stmt = $conn->prepare("UPDATE students SET name = ?, program = ?, college = ?, year = ?, grade = ? WHERE id = ?");
    $stmt->bind_param("sssidi", $name, $program, $college, $year, $grade, $id);

    if ($stmt->execute()) {
        // Redirect back to index.php with a success message
        header("Location: ../index.php?update_success=1");
        exit;
    } else {
        // Redirect back with an error message
        header("Location: ../index.php?update_error=1");
        exit;
    }
}
?>
