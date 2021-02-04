<!DOCTYPE html>
<?php
session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login-fr.php");
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
        <h1>Bienvenue <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>, sur la page des bénévoles!</h1>
    </div>
    <p>
        <a href="reset-password-fr.php" class="btn btn-warning">Réinitialiser le mot de passe</a>
        <a href="logout-fr.php" class="btn btn-danger">Se déconnecter</a>
    </p>
</body>
</html>