<?php
include '../includes/db.php';
include '../src/auth.php';
include '../src/user.php';

session_start();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $user = new User($conn);
    
    $user->register($_POST['nome'], $_POST['email'], $_POST['senha']);
    header("location: login.php");
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar</title>
    <link rel="stylesheet" href="../assects/css/style.css">
</head>
<body>
    <form method="POST" action="register.php">
        <input type="text" name="nome" required placeholder="Seu Nome"><br>
        <input type="email" name="email" required placeholder="Email"><br>
        <input type="password" name="senha" required placeholder="Senha"><br>
        <button type="submit" name="enviar">Registrar</button>
    </form>
</body>
</html>