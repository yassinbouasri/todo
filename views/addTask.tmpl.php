<?php
require_once 'layout.php';
require_once "topmenu.php";

/** @var array $categories */
/** @var string $alertMessage */
?>
<head>
    <title>Add Task - Todo App</title>
    <meta charset="utf-8">

    <!-- Flatpickr CSS for DateTime Picker -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container task-container">
    <h2 class="task-title">Add Task</h2>

    <!-- Display the alert message here before the form -->
    <?php if (!empty($alertMessage)): ?>
        <?php echo $alertMessage; ?>
    <?php endif; ?>

    <form action="/task/create" method="post">
        <div class="form-group">
            <label for="taskTitle">Task Title</label>
            <input type="text" class="form-control" id="task_title" name="task_title" placeholder="Enter task title" required>
        </div>

        <div class="form-group">
            <label for="taskDescription">Task Description</label>
            <textarea class="form-control" id="task_description" name="task_description" rows="3" placeholder="Enter task description" required></textarea>
        </div>

        <div class="form-group">
            <label for="taskCategory">Category</label>
            <select class="form-control" id="category_id" name="category_id" required>
                <option value="">Select Category</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo htmlspecialchars($category->id, HTML_ENTITIES, 'UTF-8') ?>"><?php echo htmlspecialchars($category->category_name, HTML_ENTITIES, 'UTF-8') ?></option>
                <?php endforeach;?>
            </select>
        </div>

        <div class="form-group">
            <label for="taskPriority">Priority</label>
            <select class="form-control" id="priority" name="priority" required>
                <option value="">Select Priority</option>
                <option value="high">High</option>
                <option value="medium">Medium</option>
                <option value="low">Low</option>
            </select>
        </div>

        <div class="form-group">
            <label for="due_date">Due Date</label>
            <input type="text" class="form-control" id="due_date" name="due_date" placeholder="Select due date" required>
        </div>

        <div class="form-group">
            <label for="taskStatus">Task Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="In Progress">In Progress</option>
                <option value="Completed">Completed</option>
                <option value="Pending">Pending</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Add Task</button>
    </form>
</div>

<!-- Include Flatpickr JS for DateTime Picker -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<!-- Initialize Flatpickr -->
<script>
    $(document).ready(function(){
        flatpickr("#due_date", {
            enableTime: true,
            dateFormat: "Y-m-d H:i", // Customize the date-time format
        });
    });
</script>
</body>
</html>