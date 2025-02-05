<?php
include 'database/database.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid student ID.");
}

$id = intval($_GET['id']);

// Prepare and execute query
$stmt = $conn->prepare("SELECT * FROM students WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// Check if student exists
if ($result->num_rows === 0) {
    die("Student not found.");
}

$student = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Update Student</h2>
        <form action="handlers/update_todo_handler.php" method="POST">
            <input type="hidden" name="id" value="<?= htmlspecialchars($student['id']) ?>">

            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($student['name']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Program</label>
                <input type="text" name="program" class="form-control" value="<?= htmlspecialchars($student['program']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">College</label>
                <input type="text" name="college" class="form-control" value="<?= htmlspecialchars($student['college']) ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Year</label>
                <select name="year" class="form-control" required>
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <option value="<?= $i ?>" <?= ($student['year'] == $i) ? 'selected' : '' ?>><?= $i ?></option>
                    <?php endfor; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Grade</label>
                <input type="number" step="0.01" name="grade" class="form-control" value="<?= htmlspecialchars($student['grade']) ?>" required>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Update Student</button>
                <a href="index.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
