<?php include 'database/database.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Information</title>
    <link href="statics/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            font-weight: bold;
            color: #333;
        }

        .btn {
            padding: 8px 15px;
            border-radius: 4px;
            font-weight: bold;
        }

        .btn-add {
            background: #28a745;
            color: #fff;
        }

        .form-group {
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
        }

        th {
            background: #007bff;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php if (isset($_GET['update_success'])): ?>
            <div class="alert alert-success">Student updated successfully!</div>
        <?php elseif (isset($_GET['update_error'])): ?>
            <div class="alert alert-danger">Failed to update student.</div>
        <?php endif; ?>

        <h1>Class Information</h1>

        <form id="studentForm">
            <div class="form-group">
                <input type="text" name="name" placeholder="Student Name" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="text" name="program" placeholder="Program" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="text" name="college" placeholder="College" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="year">Year</label>
                <select name="year" id="year" class="form-control" required>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            <div class="form-group">
                <input type="number" step="0.01" name="grade" placeholder="Grade" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-add">Add Student</button>
        </form>

        <table id="studentTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Program</th>
                    <th>College</th>
                    <th>Year</th>
                    <th>Grade</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include "database/database.php";
                $result = $conn->query("SELECT * FROM students ORDER BY id DESC");
                while ($row = $result->fetch_assoc()) {
                    echo "<tr data-id='{$row['id']}'>
                        <td>{$row['name']}</td>
                        <td>{$row['program']}</td>
                        <td>{$row['college']}</td>
                        <td>{$row['year']}</td>
                        <td>{$row['grade']}</td>
                        <td>
                            <button class='btn btn-warning btn-sm updateBtn' 
                            data-id='{$row['id']}'
                            data-name='{$row['name']}'
                            data-program='{$row['program']}'
                            data-college='{$row['college']}'
                            data-year='{$row['year']}'
                            data-grade='{$row['grade']}'>
                        Update
                    </button>

                            <button class='btn btn-danger btn-sm deleteBtn' data-id='{$row['id']}'>Delete</button>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Update Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Update Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="updateForm" action="handlers/update_todo_handler.php" method="POST">
                        <input type="hidden" name="id" id="updateId">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" id="updateName" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Program</label>
                            <input type="text" name="program" id="updateProgram" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">College</label>
                            <input type="text" name="college" id="updateCollege" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Year</label>
                            <select name="year" id="updateYear" class="form-control" required>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Grade</label>
                            <input type="number" step="0.01" name="grade" id="updateGrade" class="form-control"
                                required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Student</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function () {
            $("#studentForm").submit(function (event) {
                event.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "handlers/add_todo_handler.php",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function (response) {
                        if (response.success) {
                            updateTable(response.students);
                            $("#studentForm")[0].reset();
                        } else {
                            alert("Failed to add student!");
                        }
                    }
                });
            });

            function updateTable(students) {
                let tbody = $("#studentTable tbody");
                tbody.empty();
                students.forEach(student => {
                    tbody.append(`
                        <tr data-id="${student.id}">
                            <td>${student.name}</td>
                            <td>${student.program}</td>
                            <td>${student.college}</td>
                            <td>${student.year}</td>
                            <td>${student.grade}</td>
                            <td>
                                <a href='views/update_todo.php?id=${student.id}' class='btn btn-warning btn-sm'>Update</a>
                                <button class="btn btn-danger btn-sm deleteBtn" data-id="${student.id}">Delete</button>
                            </td>
                        </tr>
                    `);
                });
            }

            $(document).on("click", ".deleteBtn", function () {
                let studentId = $(this).data("id");
                $.ajax({
                    type: "GET",
                    url: `handlers/delete_todo_handler.php?id=${studentId}`,
                    success: function () {
                        $(`tr[data-id="${studentId}"]`).remove();
                    },
                    error: function () {
                        alert("Failed to delete student.");
                    }
                });
            });

            // **INSERT THE UPDATE MODAL SCRIPT HERE**
            $(document).on("click", ".updateBtn", function () {
                let studentId = $(this).data("id");
                let studentName = $(this).data("name");
                let studentProgram = $(this).data("program");
                let studentCollege = $(this).data("college");
                let studentYear = $(this).data("year");
                let studentGrade = $(this).data("grade");

                $("#updateId").val(studentId);
                $("#updateName").val(studentName);
                $("#updateProgram").val(studentProgram);
                $("#updateCollege").val(studentCollege);
                $("#updateYear").val(studentYear);
                $("#updateGrade").val(studentGrade);

                $("#updateModal").modal("show"); // This triggers the modal
            });
        });
    </script>
</body>

</html>