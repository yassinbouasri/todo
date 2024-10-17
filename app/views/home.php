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
                        <a href="?controller=task&method=show&id=<?php echo htmlspecialchars($task['id'], ENT_QUOTES, 'UTF-8'); ?>" class="btn btn-info btn-back btn-sm">View</a>
                        <form action="?controller=task&method=remove" method="post" onsubmit="return confirmDelete()" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($task['id'], ENT_QUOTES, 'UTF-8'); ?>">
                            <button type="submit" class="btn btn-danger btn-sm" >Delete</button>
                        </form>
                    </td>
                    <?php endforeach;?>
                </tr>
            </tbody>
        </table>
    </div>
  </div>
<script>// JS function to filter tasks
    document.getElementById('searchBar').addEventListener('keyup', function () {
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

        function confirmDelete(){
            return "Are you sure you want to delete this Task?";
        }
    });</script>