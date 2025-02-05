<?php
include "../database/database.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $program = $_POST['program'];
    $college = $_POST['college'];
    $year = $_POST['year'];
    $grade = $_POST['grade'];

    $stmt = $conn->prepare("INSERT INTO students (name, program, college, year, grade) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssd", $name, $program, $college, $year, $grade);

    if ($stmt->execute()) {
        // Fetch all records after inserting the new one
        $result = $conn->query("SELECT * FROM students ORDER BY id DESC");
        $students = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode(["success" => true, "students" => $students]);
    } else {
        echo json_encode(["success" => false, "message" => "Operation failed"]);
    }
}
?>
