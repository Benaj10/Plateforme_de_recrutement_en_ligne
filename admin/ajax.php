<?php
ob_start();
$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();

if($action == 'login'){
	$login = $crud->login();
	if($login)
		echo $login;
}
if($action == 'login2'){
	$login = $crud->login2();
	if($login)
		echo $login;
}
if($action == 'logout'){
	$logout = $crud->logout();
	if($logout)
		echo $logout;
}
if($action == 'logout2'){
	$logout = $crud->logout2();
	if($logout)
		echo $logout;
}
if($action == 'save_user'){
	$save = $crud->save_user();
	if($save)
		echo $save;
}
if($action == 'delete_user'){
	$save = $crud->delete_user();
	if($save)
		echo $save;
}
if($action == 'signup'){
	$save = $crud->signup();
	if($save)
		echo $save;
}
if($action == "save_settings"){
	$save = $crud->save_settings();
	if($save)
		echo $save;
}
if($action == "save_recruitment_status"){
	$save = $crud->save_recruitment_status();
	if($save)
		echo $save;
}
if($action == "delete_recruitment_status"){
	$save = $crud->delete_recruitment_status();
	if($save)
		echo $save;
}
if($action == "save_vacancy"){
	$save = $crud->save_vacancy();
	if($save)
		echo $save;
}
if($action == "delete_vacancy"){
	$save = $crud->delete_vacancy();
	if($save)
		echo $save;
}
if($action == "save_application"){
	$save = $crud->save_application();
	if($save)
		echo $save;
}
if($action == "delete_application"){
	$save = $crud->delete_application();
	if($save)
		echo $save;
}
if($action == "save_communique"){
	$save = $crud->save_communique();
	if($save)
		echo $save;
}
if($action == "delete_communique"){
	$save = $crud->delete_communique();
	if($save)
		echo $save;
}

if($action == "save_communique1"){
	$save = $crud->save_communique1();
	if($save)
		echo $save;
}
if($action == "delete_communique1"){
	$save = $crud->delete_communique1();
	if($save)
		echo $save;
}

if($action == "save_dossier"){
	$save = $crud->save_dossier();
	if($save)
		echo $save;
}
if($action == "delete_dossier"){
	$save = $crud->delete_dossier();
	if($save)
		echo $save;
}

// Dans votre fichier ajax.php

if ($_GET['action'] == 'forgot_password') {
    // Récupérer l'adresse e-mail du formulaire
    $username = $_POST['username'];

    // Valider et récupérer l'utilisateur par son adresse e-mail (selon votre logique de gestion des utilisateurs)
    $user = $your_user_model->getUserByUsername($username);

    if ($user) {
        // Générer un jeton unique pour la réinitialisation du mot de passe
        $reset_token = generateUniqueToken();

        // Stocker le jeton dans la base de données avec une expiration (par exemple, dans une table reset_tokens)
        $your_user_model->storeResetToken($user['id'], $reset_token);

        // Envoyer un e-mail avec un lien contenant le jeton pour la réinitialisation du mot de passe
        $reset_link = 'https://votre-site.com/reset_password.php?token=' . $reset_token;
        $email_subject = 'Instructions de récupération du mot de passe';
        $email_body = 'Cliquez sur le lien suivant pour réinitialiser votre mot de passe : ' . $reset_link;

        mail($user['email'], $email_subject, $email_body);

        // Indiquer le succès de l'envoi des instructions
        echo 1;
    } else {
        // L'adresse e-mail n'existe pas dans la base de données
        echo 0;
    }
}

