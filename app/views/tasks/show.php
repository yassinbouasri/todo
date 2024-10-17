<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Task Details</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
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

<?php require_once __DIR__ . "/../topmenu.php"; ?>
<div class="container task-container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Task Details</h3>
        </div>
        <div class="panel-body">
          <!-- Task Title -->
          <div class="task-title"><?php echo htmlspecialchars( $tasksModel["task_title"], ENT_QUOTES, "UTF-8"); ?></div>
          
          <!-- Task Information -->
          <div class="task-info">
            <strong>Description: </strong> <br>
              <?php echo htmlspecialchars( $tasksModel["task_description"], ENT_QUOTES, "UTF-8"); ?>
          </div>
          
          <!-- Task Status -->
          <div class="task-info">
            <strong>Status: </strong> 
            <span class="<?php echo htmlspecialchars( $color, ENT_QUOTES, "UTF-8"); ?>"><?php echo htmlspecialchars( $tasksModel["status"], ENT_QUOTES, "UTF-8"); ?></span>
          </div>
          
   
          <div class="task-info">
            <strong>Due Date: </strong> <?php echo htmlspecialchars( $tasksModel["due_date"], ENT_QUOTES, "UTF-8"); ?>
          </div>
          
      
          <div class="task-info">
            <strong>Category: </strong> <?php echo htmlspecialchars( $category["category_name"], ENT_QUOTES, "UTF-8"); ?>
          </div>
          
    
          <div class="task-info">
            <strong>Priority: </strong> <?php echo htmlspecialchars( $tasksModel["priority"], ENT_QUOTES, "UTF-8"); ?>
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
