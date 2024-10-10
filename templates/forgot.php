<!DOCTYPE html>
<html lang="en">
<head>
  <title>Todo - Forgot Password</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    .forgot-container {
      max-width: 400px;
      margin: 0 auto;
      margin-top: 50px;
      padding: 20px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
    }
    .forgot-title {
      text-align: center;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>

  <div class="container forgot-container">
    <h2 class="forgot-title">Forgot Password</h2>
    <p class="text-center">Enter your email address and we'll send you a link to reset your password.</p>
    <form action="send_reset_link.php" method="post">
      <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
      </div>
      <button type="submit" class="btn btn-primary btn-block">Send Reset Link</button>
      <p class="text-center mt-3"><a href="login.php">Back to Login</a></p>
    </form>
  </div>

</body>
</html>
