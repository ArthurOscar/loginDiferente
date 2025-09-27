<?php
include '../includes/db.php';
include '../src/auth.php';
include '../src/user.php';

session_start();
$auth = new Auth();
$user = new User($conn);

if (!$auth->isLoggedIn()){
    header("location: login.php");
    exit();
}

$currentUser = $user -> getUserById($_SESSION['user_id']);

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Olá, <?php echo htmlspecialchars($_SESSION['username']);?>!</h1>

    <img src="../uploads/<?php echo htmlspecialchars($currentUser['foto_perfil']);?>" alt="foto de perfil" style="width: 150px; height: 150px; border-radius: 50%;">
    <div>
    <br>
    <a href="upload_foto.php">Insira sua foto aqui!</a><br>
    <a href="logout.php">Sair</a><br>
    <a href="index.php">Home</a>
    </div>
</body>
</html>