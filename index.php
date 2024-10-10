<!DOCTYPE html>
<html lang="en">
<head>
  <title>Todo - Task Manager</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    .badge-completed {
      background-color: #28a745;
      color: white;
    }
    .badge-in-progress {
      background-color: #ffc107;
      color: black;
    }
  </style>
</head>
<body>

  <?php require_once "templates/topmenu.php"; ?>

  <div class="container mt-5">
    <h1 class="text-center mb-4">Tasks List</h1>

    
    <div class="row mb-4">
      <div class="col-md-3 col-sm-6 col-xs-12 ml-auto">
        <input type="text" id="searchBar" class="form-control" placeholder="Search tasks">
      </div>
    </div>

    <!-- List View -->
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
            <tbody id="taskTable">
                <tr>
                    <td>Task Title 1</td>
                    <td>This is a brief description of task 1.</td>
                    <td><span class="badge badge-completed">Completed</span></td>
                    <td>
                        <button class="btn btn-primary btn-sm">Edit</button>
                        <button type="button" class="btn btn-info btn-sm">View</button>
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
                <tr>
                    <td>Task Title 2</td>
                    <td>This is a brief description of task 2.</td>
                    <td><span class="badge badge-in-progress">In Progress</span></td>
                    <td>
                        <button class="btn btn-primary btn-sm">Edit</button>
                        <button type="button" class="btn btn-info btn-sm">View</button>
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
  </div>

<script>
  // JS function to filter tasks
  document.getElementById('searchBar').addEventListener('keyup', function() {
      let searchValue = this.value.toLowerCase();
      let tasks = document.getElementById('taskTable').getElementsByTagName('tr');
      
      for (let i = 0; i < tasks.length; i++) {
          let taskTitle = tasks[i].getElementsByTagName('td')[0].textContent.toLowerCase();
          let taskDescription = tasks[i].getElementsByTagName('td')[1].textContent.toLowerCase();
          
          if (taskTitle.includes(searchValue) || taskDescription.includes(searchValue)) {
              tasks[i].style.display = "";
          } else {
              tasks[i].style.display = "none";
          }
      }
  });
</script>

</body>
</html>
