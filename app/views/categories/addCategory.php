<?php require_once __DIR__ .  '/../layout.php'; ?>
<head>
    <title>Add Category - Todo App</title>
    <meta charset="utf-8">


    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php require_once __DIR__ . "/../topmenu.php"; ?>

<div class="container task-container">
    <?php if (!empty($alertMessage)):?>
        <?php echo $alertMessage; ?>
    <?php endif; ?>
    <h2 class="task-title">Add Category</h2>
    <form action="?controller=categories&method=saveCategory" method="post">
        <div class="form-group">
            <label for="categoryName">Category Name</label>
            <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Enter category name" required>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Add Category</button>
    </form>
</div>

</body>

