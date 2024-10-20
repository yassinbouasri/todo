<!DOCTYPE html>
<html lang="en">
<head>
    <title>Todo - Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        .signup-container {
            max-width: 400px;
            margin: 0 auto;
            margin-top: 50px;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .signup-title {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container signup-container">
    <h2 class="signup-title">Login</h2>
    <?php if (!empty($alertMessage)): ?>
        <?php echo $alertMessage; ?>
    <?php endif; ?>
    <form action="?controller=users&method=login" method="post">
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
        </div>
        <p class="mt-3"> <a href="?controller=users&method=forgotPassword">Forgot password?</a></p>
        <button type="submit" class="btn btn-primary btn-block">Login</button>
        <p class="text-center mt-3">Don't have an account? <a href="?controller=users&method=register">Sign Up</a></p>
    </form>
</div>

</body>
</html>
