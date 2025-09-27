<?php

class User {
    private $conn;

    public function __construct($db){
        $this-> conn = $db;
    }
    public function login($email, $password){
        $sql = "SELECT * FROM usuarios WHERE email= :email";
        $stmt = $this -> conn->prepare($sql);
        $stmt ->bindParam(":email", $email);
        $stmt->execute();
        $user = $stmt -> fetch(PDO::FETCH_ASSOC);

        if($user && password_verify($password, $user['senha'])){
            return $user;
        }
        return false;
    }
}

?>