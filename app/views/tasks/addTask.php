<?php require_once '../layout.php'; ?>
<head>
    <title>Add Task - Todo App</title>
    <meta charset="utf-8">

    <!-- Flatpickr CSS for DateTime Picker -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

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
            <label for="taskCategory">Category</label>
            <select class="form-control" id="taskCategory" name="task_category" required>
                <option value="">Select Category</option>
                <option value="work">Work</option>
                <option value="personal">Personal</option>
                <option value="school">School</option>
                <option value="fitness">Fitness</option>
                <option value="shopping">Shopping</option>
            </select>
        </div>

        <div class="form-group">
            <label for="taskPriority">Priority</label>
            <select class="form-control" id="taskPriority" name="task_priority" required>
                <option value="">Select Priority</option>
                <option value="high">High</option>
                <option value="medium">Medium</option>
                <option value="low">Low</option>
            </select>
        </div>

        <div class="form-group">
            <label for="dueDate">Due Date</label>
            <input type="text" class="form-control" id="dueDate" name="due_date" placeholder="Select due date" required>
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

<!-- Include Flatpickr JS for DateTime Picker -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<!-- Initialize Flatpickr -->
<script>
    $(document).ready(function(){
        flatpickr("#dueDate", {
            enableTime: true,
            dateFormat: "Y-m-d H:i", // Customize the date-time format
        });
    });
</script>
</body>
</html>
