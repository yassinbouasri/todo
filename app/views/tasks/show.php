<?php
require_once __DIR__ . "/../layout.php";
require_once __DIR__ . "/../topmenu.php";

$taskModels = new TaskController();
$taskModel = $taskModels->show();


?>
  <style>
    .task-container {
      margin-top: 50px;
    }
    .task-title {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 20px;
    }
    .task-info {
      font-size: 18px;
      margin-bottom: 15px;
    }
    .status {
      font-weight: bold;
    }
    .completed {
      color: green;
    }
    .in-progress {
      color: orange;
    }
    .btn-back {
      margin-top: 20px;
    }
  </style>
</head>
<body>


<div class="container task-container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Task Details</h3>
        </div>
        <div class="panel-body">
          <!-- Task Title -->
          <div class="task-title"><?php echo $taskModel['task_title']; ?></div>
          
          <!-- Task Information -->
          <div class="task-info">
            <strong>Description: </strong> <br>
            This task involves completing the frontend and backend for the Todo List application, ensuring all features like adding, editing, and deleting tasks work properly.
          </div>
          
          <!-- Task Status -->
          <div class="task-info">
            <strong>Status: </strong> 
            <span class="status completed">Completed</span>
          </div>
          
   
          <div class="task-info">
            <strong>Due Date: </strong> October 15, 2024
          </div>
          
      
          <div class="task-info">
            <strong>Category: </strong> Web Development
          </div>
          
    
          <div class="task-info">
            <strong>Priority: </strong> High
          </div>
        </div>
  
        <div class="panel-footer">
          <a href="../home.php" class="btn btn-primary btn-back">Back to Task List</a>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>
