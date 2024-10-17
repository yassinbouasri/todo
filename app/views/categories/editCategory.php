<?php require_once __DIR__ . '/../layout.php';
require_once __DIR__ . "/../../models/categories.php";

/* @var string $alertMessage
 * @var int $categoryId
 * @var string $categoryName
 */
?>
<head>
    <title>Add Category - Todo App</title>
    <meta charset="utf-8">

    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php require_once __DIR__ . "/../topmenu.php"; ?>

<div class="container task-container">
    <?php if ($alertMessage) :?>
    <?php echo $alertMessage;?>
    <?php endif; ?>
    <h2 class="task-title">Edit Category</h2>
    <form action="?controller=categories&method=updateCategory" method="post">
        <div class="form-group">
            <label for="categoryName">Category Name</label>
            <input type="hidden" name="category_id" value="<?php echo $categoryId ; ?>">
            <input type="text" class="form-control" id="category_name" name="category_name" value="<?php echo $categoryName; ?>" required>
        </div>

        <button type="submit" name="update" class="btn btn-primary btn-block">Edit Category</button>
    </form>
</div>

</body>
</html>
