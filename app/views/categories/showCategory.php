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

<div class="container mt-5">
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
        <?php foreach ($categories as $category) :?>
        <tr>
            <td><?php echo $category['id']; ?></td>
            <td><?php echo $category['category_name']?></td>
            <td>
                <button class="btn btn-primary btn-sm">Edit</button>
                <button class="btn btn-danger btn-sm">Delete</button>
            </td>
        </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</div>

</body>
</html>
