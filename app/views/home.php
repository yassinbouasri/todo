<?php require_once "layout.php"; ?>
<?php require_once "topmenu.php"; ?>

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
                <tr>
                    <td>Task Title 1</td>
                    <td>This is a brief description of task 1.</td>
                    <td>Web Development</td>
                    <td>October 15, 2024</td>
                    <td><span class="badge badge-high">High</span></td>
                    <td><span class="badge badge-success">Completed</span></td>
                    <td>
                        <a href="tasks/show.php" class="btn btn-primary btn-sm">Edit</a>
                        <a href="tasks/show.php" class="btn btn-info btn-back btn-sm">View</a>
                        <a href="tasks/show.php" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
                <tr>
                    <td>Task Title 2</td>
                    <td>This is a brief description of task 2.</td>
                    <td>Marketing</td>
                    <td>October 18, 2024</td>
                    <td><span class="badge badge-medium">Medium</span></td>
                    <td><span class="badge badge-warning">In Progress</span></td> 
                    <td>
                        <a href="tasks/show.php" class="btn btn-primary btn-sm">Edit</a>
                        <a href="tasks/show.php" class="btn btn-info btn-back btn-sm">View</a>
                        <a href="tasks/show.php" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
                <tr>
                    <td>Task Title 3</td>
                    <td>This is a brief description of task 3.</td>
                    <td>Design</td>
                    <td>October 20, 2024</td>
                    <td><span class="badge badge-high">High</span></td>
                    <td><span class="badge badge-success">Complete</span></td>
                    <td>
                        <a href="tasks/show.php" class="btn btn-primary btn-sm">Edit</a>
                        <a href="tasks/show.php" class="btn btn-info btn-back btn-sm">View</a>
                        <a href="tasks/show.php" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
  </div>