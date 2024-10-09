<!DOCTYPE html>
<html lang="en">
<head>
  <title>Todo - Task Manager</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

  <?php require_once "templates/topmenu.php"; ?>

  <div class="container mt-5">
    <h1 class="text-center mb-4">Task List</h1>

    <div id="listView">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Task</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Task Title 1</td>
                    <td>This is a brief description of task 1.</td>
                    <td><span class="badge" style="background-color: #28a745; color: white;">Completed</span></td> 
                    <td>
                        <button class="btn btn-primary btn-sm">Edit</button>
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>Task Title 2</td>
                    <td>This is a brief description of task 2.</td>
                    <td><span class="badge" style="background-color: #ffc107; color: black;">In Progress</span></td>
                    <td>
                        <button class="btn btn-primary btn-sm">Edit</button>
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
  </div>

</body>
</html>
