<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add Student</title>
  <link href="../statics/css/bootstrap.min.css" rel="stylesheet">
  <script src="../statics/js/bootstrap.js"></script>
</head>

<body>
  <div class="container d-flex justify-content-center mt-5">
    <div class="col-6">
      <div class="row">
        <p class="display-5 fw-bold">Add Student</p>
      </div>
      <div class="row">
        <form class="form" action="../handlers/add_todo_handler.php" method="POST">
          <div class="my-3">
            <label>Name</label>
            <input class="form-control" type="text" name="name" required />
          </div>
          <div class="my-3">
            <label>Program</label>
            <input class="form-control" type="text" name="program" required />
          </div>
          <div class="my-3">
            <label>College</label>
            <input class="form-control" type="text" name="college" required />
          </div>
          <div class="my-3">
            <label>Year</label>
            <input class="form-control" type="number" name="year" required />
          </div>
          <div class="my-3">
            <label>Grade</label>
            <input class="form-control" type="text" name="grade" required />
          </div>
          <div class="my-3">
            <button type="submit" class="btn btn-outline-dark">Add Student</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>
