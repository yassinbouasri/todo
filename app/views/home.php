<?php
require_once "layout.php";
require_once "topmenu.php";
/* @var array $tasks
 * @var array $categoriesModels
 * @var array $taskController
 */
?>


  <div class="container mt-5">
    <h1 class="text-center mb-4">Tasks List</h1>

    <div class="row mb-4">
      <div class="col-md-3 col-sm-6 col-xs-12 ml-auto">
        <input type="text" id="searchBar" class="form-control" placeholder="Search tasks">
      </div>
    </div>

    <!-- List View with Responsive Table -->
    <div id="listView" class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Task</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Due Date</th>
                    <th>Priority</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="taskTable">
            <?php foreach ($tasks as $task): ?>
                <tr>
                    <td><?php echo htmlspecialchars($task['task_title']); ?></td>
                    <td><?php echo htmlspecialchars($task['task_description']); ?></td>
                    <?php $category = $categoriesModels->getCategoryById($task['category_id']); ?>
                    <td><?php echo htmlspecialchars($category['category_name']); ?></td>
                    <td><?php echo htmlspecialchars($task['due_date']); ?></td>
                    <td><span class="<?php echo htmlspecialchars($taskController->badge($task['priority'])); ?>"> <?php echo htmlspecialchars($task['priority']); ?></span></td>
                    <td><span class="<?php echo htmlspecialchars($taskController->badge($task['status'])); ?>"><?php echo htmlspecialchars($task['status']); ?></span></td>
                    <td>
                        <a href="tasks/show.php" class="btn btn-primary btn-sm">Edit</a>
                        <a href="tasks/show.php" class="btn btn-info btn-back btn-sm">View</a>
                        <a href="tasks/show.php" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                    <?php endforeach;?>
                </tr>
            </tbody>
        </table>
    </div>
  </div>