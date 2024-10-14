<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <title><?php echo isset($title) ? $title : 'Todo - Task Manager'; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
<style>.badge-high {
        background-color: #dc3545;
        color: white;
    }
    .badge-medium {
        background-color: #ffc107;
        color: black;
    }
    .badge-success {
        background-color: #198754;
        color: white;
    }
    .task-container {
        max-width: 500px;
        margin: 0 auto;
        margin-top: 50px;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }
    .task-title {
        text-align: center;
        margin-bottom: 20px;
    }</style>

</head>
<body>
<script src="js/script.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>