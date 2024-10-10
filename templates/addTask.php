<!DOCTYPE html>
<html lang="en">
<head>
  <title>Add Task - Todo App</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    .task-container {
      max-width: 500px;
      margin: 0 auto;
      margin-top: 50px;
      padding: 20px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
    }
    .task-title {
      text-align: center;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
    <?php require_once "topmenu.php"; ?>
  <div class="container task-container">
    <h2 class="task-title">Add Task</h2>
    <form action="save_task.php" method="post">
      <div class="form-group">
        <label for="taskTitle">Task Title</label>
        <input type="text" class="form-control" id="taskTitle" name="task_title" placeholder="Enter task title" required>
      </div>
      <div class="form-group">
        <label for="taskDescription">Task Description</label>
        <textarea class="form-control" id="taskDescription" name="task_description" rows="3" placeholder="Enter task description" required></textarea>
      </div>
      <div class="form-group">
        <label for="taskStatus">Task Status</label>
        <select class="form-control" id="taskStatus" name="task_status" required>
          <option value="in-progress">In Progress</option>
          <option value="completed">Completed</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary btn-block">Add Task</button>
    </form>
  </div>

</body>
</html>
