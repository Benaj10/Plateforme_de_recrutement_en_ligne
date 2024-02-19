<?php
session_start();
ini_set('display_errors', 1);
Class Action {
	private $db;

	public function __construct() {
		ob_start();
   	include 'db_connect.php';
    
    $this->db = $conn;
	}
	function __destruct() {
	    $this->db->close();
	    ob_end_flush();
	}

	function login(){
		extract($_POST);
		$qry = $this->db->query("SELECT * FROM users where username = '".$username."' and password = '".$password."' ");
		if($qry->num_rows > 0){
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'passwors' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
				return 1;
		}else{
			return 3;
		}
	}
	function login2(){
		extract($_POST);
		$qry = $this->db->query("SELECT * FROM users where username = '".$email."' and password = '".md5($password)."' ");
		if($qry->num_rows > 0){
			foreach ($qry->fetch_array() as $key => $value) {
				if($key != 'passwors' && !is_numeric($key))
					$_SESSION['login_'.$key] = $value;
			}
				return 1;
		}else{
			return 3;
		}
	}
	function logout(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:../index.php");
	}
	function logout2(){
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:../index.php");
	}

	function save_user(){
		extract($_POST);
		$data = " name = '$name' ";
		$data .= ", username = '$username' ";
		$data .= ", password = '$password' ";
		$data .= ", type = '$type' ";
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users set ".$data);
		}else{
			$save = $this->db->query("UPDATE users set ".$data." where id = ".$id);
		}
		if($save){
			return 1;
		}
	}

	function delete_user(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM users where id = ".$id);
		if($delete)
			return 1;
		}
	function signup(){
		extract($_POST);
		$data = " name = '$name' ";
		$data .= ", contact = '$contact' ";
		$data .= ", address = '$address' ";
		$data .= ", username = '$email' ";
		$data .= ", password = '".md5($password)."' ";
		$data .= ", type = 3";
		$chk = $this->db->query("SELECT * FROM users where username = '$email' ")->num_rows;
		if($chk > 0){
			return 2;
			exit;
		}
			$save = $this->db->query("INSERT INTO users set ".$data);
		if($save){
			$qry = $this->db->query("SELECT * FROM users where username = '".$email."' and password = '".md5($password)."' ");
			if($qry->num_rows > 0){
				foreach ($qry->fetch_array() as $key => $value) {
					if($key != 'passwors' && !is_numeric($key))
						$_SESSION['login_'.$key] = $value;
				}
			}
			return 1;
		}
	}

	function save_settings(){
		extract($_POST);
		$data = " name = '".str_replace("'","&#x2019;",$name)."' ";
		$data .= ", email = '$email' ";
		$data .= ", contact = '$contact' ";
		$data .= ", about_content = '".htmlentities(str_replace("'","&#x2019;",$about))."' ";
		if($_FILES['img']['tmp_name'] != ''){
						$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
						$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/img/'. $fname);
					$data .= ", cover_img = '$fname' ";

		}
		
		// echo "INSERT INTO system_settings set ".$data;
		$chk = $this->db->query("SELECT * FROM system_settings");
		if($chk->num_rows > 0){
			$save = $this->db->query("UPDATE system_settings set ".$data);
		}else{
			$save = $this->db->query("INSERT INTO system_settings set ".$data);
		}
		if($save){
		$query = $this->db->query("SELECT * FROM system_settings limit 1")->fetch_array();
		foreach ($query as $key => $value) {
			if(!is_numeric($key))
				$_SESSION['setting_'.$key] = $value;
		}

			return 1;
				}
	}

	
	function save_recruitment_status(){
		extract($_POST);
		$data = " status_label = '$status_label' ";
		if(empty($id)){
			$save = $this->db->query("INSERT INTO recruitment_status set ".$data);
		}else{
			$save = $this->db->query("UPDATE recruitment_status set ".$data." where id=".$id);
		}
		if($save)
			return 1;
	}
	function delete_recruitment_status(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM recruitment_status where id = ".$id);
		if($delete)
			return 1;
	}
	function save_vacancy(){
		extract($_POST);
		$data = " position = '$position' ";
		$data .= ", availability = '$availability' ";
		$data .= ", description = '".htmlentities(str_replace("'","&#x2019;",$description))."' ";
		if(isset($status))
		$data .= ", status = '$status' ";
		
		if(empty($id)){
			
			$save = $this->db->query("INSERT INTO vacancy set ".$data);
		}else{
			$save = $this->db->query("UPDATE vacancy set ".$data." where id=".$id);
		}
		if($save)
			return 1;
	}

	function delete_vacancy(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM vacancy where id = ".$id);
		if($delete)
			return 1;
	}
	function save_application(){
		extract($_POST);
		$data = " lastname = '$lastname' ";
		$data .= ", firstname = '$firstname' ";
		$data .= ", middlename = '$middlename' ";
		$data .= ", address = '$address' ";
		$data .= ", contact = '$contact' ";
		$data .= ", email = '$email' ";
		$data .= ", gender = '$gender' ";
		$data .= ", cover_letter = '".htmlentities(str_replace("'","&#x2019;",$cover_letter))."' ";
		$data .= ", position_id = '$position_id' ";
		if(isset($status))
		$data .= ", process_id = '$status' ";

		if($_FILES['resume']['tmp_name'] != ''){
						$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['resume']['name'];
						$move = move_uploaded_file($_FILES['resume']['tmp_name'],'assets/resume/'. $fname);
					$data .= ", resume_path = '$fname' ";

		}
		if(empty($id)){
			// echo "INSERT INTO application set ".$data;
			// exit;
			$save = $this->db->query("INSERT INTO application set ".$data);
		}else{
			$save = $this->db->query("UPDATE application set ".$data." where id=".$id);
		}
		if($save)
			return 1;
	}
	function delete_application(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM application where id = ".$id);
		if($delete)
			return 1;
	}
	
function save_communique() {
    $conn = new mysqli("localhost", "root", "", "recrutement_insd");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $id = $_POST['id'];
    $titre = $_POST['titre'];

    // Gestion de l'upload du fichier PDF
    $fichier_pdf = '';
    if (!empty($_FILES['fichier_pdf']['name'])) {
        $upload_dir = 'assets/communique/';
        $fichier_pdf = uniqid() . '_' . basename($_FILES['fichier_pdf']['name']);
        move_uploaded_file($_FILES['fichier_pdf']['tmp_name'], $upload_dir . $fichier_pdf);
    }

    if (!empty($id)) {
        // Mettez à jour le communiqué existant
        // Supprimez l'ancien fichier si un nouveau fichier est téléchargé
        $old_file = $conn->query("SELECT fichier_pdf FROM communiques WHERE id = $id")->fetch_assoc()['fichier_pdf'];
        if (!empty($old_file)) {
            unlink($upload_dir . $old_file);
        }

        $conn->query("UPDATE communiques SET titre='$titre', fichier_pdf='$fichier_pdf' WHERE id=$id");
    } else {
        // Insérez un nouveau communiqué
        $conn->query("INSERT INTO communiques (titre, fichier_pdf) VALUES ('$titre', '$fichier_pdf')");
    }

 
    return 1;
}

function delete_communique() {
    // Établissez une connexion à la base de données (assurez-vous de remplacer ces informations par vos propres paramètres de connexion)
     $conn = new mysqli("localhost", "root", "", "recrutement_insd");

    // Vérifiez la connexion
    if ($conn->connect_error) {
        die("La connexion à la base de données a échoué : " . $conn->connect_error);
    }

    $id = $_POST['id'];

    // Récupérez le nom du fichier PDF associé
    $file_to_delete = $conn->query("SELECT fichier_pdf FROM communiques WHERE id = $id")->fetch_assoc()['fichier_pdf'];

    // Supprimez le fichier PDF associé si nécessaire
    if (!empty($file_to_delete)) {
        $upload_dir = 'assets/communique/';
        unlink($upload_dir . $file_to_delete);
    }

    // Supprimez le communiqué
    $conn->query("DELETE FROM communiques WHERE id=$id");

    // Fermez la connexion à la base de données
    $conn->close();

    return 1;
}

function save_dossier($user_email, $titre_dossier, $files) {
    global $conn;

    $insert_dossier_query = "INSERT INTO dossiers (user_email, titre_dossier, etat, created_at) VALUES ('$user_email', '$titre_dossier', 'En cours', NOW())";

    if ($conn->query($insert_dossier_query) === TRUE) {
        $dossier_id = $conn->insert_id;

        foreach ($files['name'] as $key => $file_name) {
            $file_tmp = $files['assets/dossier_candidature'][$key];
            $file_blob = file_get_contents($file_tmp);

            $insert_file_query = "INSERT INTO fichiers_dossier (dossier_id, nom_fichier, fichier_blob) VALUES ('$dossier_id', '$file_name', '$file_blob')";
            $conn->query($insert_file_query);
        }

        return true; // Succès
    } else {
        return "Erreur : " . $conn->error;
    }
}
function delete_dossier($dossier_id) {
    $conn = new mysqli("localhost", "root", "", "votre_base_de_donnees");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Supprimer les fichiers du dossier dans la table 'fichiers_dossier'
    $delete_files_query = "DELETE FROM fichiers_dossier WHERE dossier_id = $dossier_id";
    if ($conn->query($delete_files_query) === TRUE) {
        // Supprimer le dossier de la table 'dossiers'
        $delete_dossier_query = "DELETE FROM dossiers WHERE id = $dossier_id";
        if ($conn->query($delete_dossier_query) === TRUE) {
            return 1; // Suppression réussie
        } else {
            return "Erreur lors de la suppression du dossier : " . $conn->error;
        }
    } else {
        return "Erreur lors de la suppression des fichiers : " . $conn->error;
    }
}
function save_communique1() {
    $conn = new mysqli("localhost", "root", "", "recrutement_insd");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $id = $_POST['id'];
    $titre = $_POST['titre'];
    $statut = $_POST['statut'];
    // Gestion de l'upload du fichier PDF
    $fichier_pdf = '';
    if (!empty($_FILES['fichier_pdf']['name'])) {
        $upload_dir = 'assets/communique1/';
        $fichier_pdf = uniqid() . '_' . basename($_FILES['fichier_pdf']['name']);
        move_uploaded_file($_FILES['fichier_pdf']['tmp_name'], $upload_dir . $fichier_pdf);
    }

    if (!empty($id)) {
        // Mettez à jour le communiqué existant
        // Supprimez l'ancien fichier si un nouveau fichier est téléchargé
        $old_file = $conn->query("SELECT fichier_pdf FROM communiques1 WHERE id = $id")->fetch_assoc()['fichier_pdf'];
        if (!empty($old_file)) {
            unlink($upload_dir . $old_file);
        }

        $conn->query("UPDATE communiques1 SET titre='$titre',statut='$statut', fichier_pdf='$fichier_pdf' WHERE id=$id");
    } else {
        // Insérez un nouveau communiqué
        $conn->query("INSERT INTO communiques1 (titre, statut, fichier_pdf) VALUES ('$titre','$statut', '$fichier_pdf')");
    }

 
    return 1;
}

function delete_communique1() {
    // Établissez une connexion à la base de données (assurez-vous de remplacer ces informations par vos propres paramètres de connexion)
     $conn = new mysqli("localhost", "root", "", "recrutement_insd");

    // Vérifiez la connexion
    if ($conn->connect_error) {
        die("La connexion à la base de données a échoué : " . $conn->connect_error);
    }

    $id = $_POST['id'];

    // Récupérez le nom du fichier PDF associé
    $file_to_delete = $conn->query("SELECT fichier_pdf FROM communiques1 WHERE id = $id")->fetch_assoc()['fichier_pdf'];

    // Supprimez le fichier PDF associé si nécessaire
    if (!empty($file_to_delete)) {
        $upload_dir = 'assets/communique1/';
        unlink($upload_dir . $file_to_delete);
    }

    // Supprimez le communiqué
    $conn->query("DELETE FROM communiques1 WHERE id=$id");

    // Fermez la connexion à la base de données
    $conn->close();

    return 1;
}

}