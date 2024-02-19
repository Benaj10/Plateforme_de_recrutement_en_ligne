<?php
session_start();
include 'admin/db_connect.php';

if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $qry = $conn->query("SELECT * FROM users WHERE username = '$username' AND password = '$password' ");
    if($qry->num_rows > 0){
        $user = $qry->fetch_assoc();

        // Enregistrement des données de l'utilisateur dans la session
        $_SESSION['login_id'] = $user['id'];
        $_SESSION['login_username'] = $user['username'];
        $_SESSION['login_nom'] = $user['name'];
        // Enregistrez d'autres données d'utilisateur que vous souhaitez stocker dans la session

        echo 1; // Utilisateur connecté
    }else{
        echo 0; // Identifiants incorrects
    }
}else{
    echo 0; // Données manquantes
}
?>
