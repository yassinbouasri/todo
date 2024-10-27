<?php
/* @var string $token
 * @var array $user
 * */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Todo - New Password</title>
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
    <h2 class="signup-title">Rest Password.</h2>
    <?php if (!empty($alertMessage)): ?>
        <?php echo $alertMessage; ?>
    <?php endif; ?>
    <form action="/user/resetPasswordByToken/<?php echo $token; ?>" method="post">
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email'];?>" readonly>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter password" required>
        </div>
        <div class="form-group">
            <label for="confirm-password">Confirm Password</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Reset Your Password</button><br>
        <p>Try to <a href="/login">Login.</a></p>
    </form>
</div>

</body>
</html>
