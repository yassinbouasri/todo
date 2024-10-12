<?php require_once '../layout.php'; ?>
<head>
    <title>Show Categories - Todo App</title>
    <meta charset="utf-8">

    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../../public/css/style.css">
</head>
<body>
<?php require_once "../topmenu.php"; ?>

<div class="container mt-5">
    <h2 class="text-center">Categories List</h2>

    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th>Category Name</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody id="categoryTable">

        <tr>
            <td>Web Development</td>
            <td>All tasks related to web development.</td>
            <td>
                <button class="btn btn-primary btn-sm">Edit</button>
                <button class="btn btn-danger btn-sm">Delete</button>
            </td>
        </tr>
        <tr>
            <td>Mobile Development</td>
            <td>Tasks related to mobile app development.</td>
            <td>
                <button class="btn btn-primary btn-sm">Edit</button>
                <button class="btn btn-danger btn-sm">Delete</button>
            </td>
        </tr>
        <tr>
            <td>Design</td>
            <td>Tasks related to graphic design and UI/UX.</td>
            <td>
                <button class="btn btn-primary btn-sm">Edit</button>
                <button class="btn btn-danger btn-sm">Delete</button>
            </td>
        </tr>
        </tbody>
    </table>
</div>

</body>
</html>
