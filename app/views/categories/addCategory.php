<?php require_once '../layout.php'; ?>
<head>
    <title>Add Category - Todo App</title>
    <meta charset="utf-8">

    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php require_once "../topmenu.php"; ?>

<div class="container task-container">
    <h2 class="task-title">Add Category</h2>
    <form action="save_category.php" method="post">
        <div class="form-group">
            <label for="categoryName">Category Name</label>
            <input type="text" class="form-control" id="categoryName" name="category_name" placeholder="Enter category name" required>
        </div>

        <div class="form-group">
            <label for="categoryDescription">Category Description</label>
            <textarea class="form-control" id="categoryDescription" name="category_description" rows="3" placeholder="Enter category description"></textarea>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Add Category</button>
    </form>
</div>

</body>
</html>
