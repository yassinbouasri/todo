<?php require_once '../layout.php'; ?>
<head>
  <title>Add Task - Todo App</title>
  <meta charset="utf-8">

    <link rel="stylesheet" href="../../../public/css/style.css">
</head>
<body>
    <?php require_once "../topmenu.php"; ?>
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
