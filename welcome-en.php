<!DOCTYPE html>
<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login-en.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
        <h1>Welcome <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>, to the volunteer platform!</h1>
    </div>
    <p>
        <a href="reset-password-en.php" class="btn btn-warning">Reset password</a>
        <a href="logout-en.php" class="btn btn-danger">Log out</a>
    </p>
</body>
</html>