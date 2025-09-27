<?php
include '../includes/db.php';
include '../src/auth.php';
include '../src/user.php';

session_start();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $user = new User($conn);
    $auth = new Auth();
    $loggedInUser = $user->login($_POST['email'], $_POST['password']);
    if($loggedInUser){
        $auth -> loginUser($loggedInUser);
        header("location: dashboard.php");
    } else{
        echo "<script>alert('Login Falhou!')</script>";
    }
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../assects/css/style.css">
</head>
<body>
    <form method="POST" action="login.php">
        <input type="email" name="email" required placeholder="Email"><br>
        <input type="password" name="senha" required placeholder="Senha"><br>
        <button type="submit" name="enviar">Login</button>
    </form>
</body>
</html>