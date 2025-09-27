<?php
include '../includes/db.php';
include '../src/user.php';

session_start();

if (!isset($_SESSION['user_id'])){
    header("location: login.php");
    exit();
}

$user = new User($conn);
$currentUser = $user -> getUserById($_SESSION['user_id']);

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['foto_perfil'])){
    $target_dir = '../uploads/';
    $target_file = $target_dir . basename($_FILES['foto_perfil']['name']);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES['foto_perfil']['tmp_name']);
    if ($check !== false){
        $uploadOk = 1;
    } else{
        echo "O arquivo não é uma imagem.";
        $uploadOk = 0;
    }

    if($_FILES['foto_perfil']['size'] > 500000){
        echo "Imagem muito pesada para o sistema";
        $uplaodOk = 0;
    }

    if ($uploadOk == 0){
        echo "Desculpe seu arquivo não foi enviado.";
    } else{
        if(move_uploaded_file($_FILES['foto_perfil']["tmp_name"], $target_file)){
            $user -> updateProfilePic($_SESSION['user_id'], basename($_FILES['foto_perfil']['name']));
            header("location: dashboard.php");
        }
    }
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de foto</title>
</head>
<body>
    <form action="upload_foto.php" method="POST" enctype="multipart/form-data">
        <h3>Upload da foto:</h3>
        <input type="file" name="foto_perfil" required><br>
        <button type="submit">Upload</button>
    </form>
    <br>
    <a href="index.php">Home</a>
</body>
</html>