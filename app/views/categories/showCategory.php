<?php require_once __DIR__ .  '/../layout.php';

/* @var array $categories */

?>
<head>
    <title>Show Categories - Todo App</title>
    <meta charset="utf-8">

    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php require_once __DIR__ . "/../topmenu.php"; ?>

<div class="container mt-2">
    <h2 class="text-center">Categories List</h2>

    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>Id</th>
            <th>Category Name</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody id="categoryTable">
        <?php if (!empty($alertMessage)) : ?>
        <?php echo $alertMessage; ?>
        <?php endif; ?>
        <?php $i = 1; foreach ($categories as $category) :?>
        <tr>
            <td> <?php echo $i ;?></td>
            <td><?php echo $category['category_name']?></td>
            <td>
                    <a href="?controller=categories&method=updateCategory&category_id=<?php echo $category['id']; ?>"class="btn btn-primary btn-sm">Edit</a>
                </form>
                <form action="?controller=categories&method=removeCategory" method="post" onsubmit="return confirmDelete();" style="display:inline;">
                    <input type="hidden" name="category_id" value="<?php echo htmlspecialchars($category['id'], ENT_QUOTES, 'UTF-8'); ?>">
                    <button type="submit" class="btn btn-danger btn-sm" >Delete</button>
                </form>
            </td>
        </tr>
        <?php $i++; endforeach;?>
        </tbody>
    </table>
</div>

<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this Category?");
    }
</script>
</body>
</html>
