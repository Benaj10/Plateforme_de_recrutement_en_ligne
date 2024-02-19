<?php 
include('db_connect.php');

if(isset($_GET['id'])){
    $id = $_GET['id'];

    // Vérifier si l'id correspond à une application
    $application_result = $conn->query("SELECT * FROM application WHERE id = $id");
    if ($application_result->num_rows > 0) {
        $row = $application_result->fetch_assoc();
        $file_path = 'assets/resume/' . $row['resume_path'];

        if(file_exists($file_path)){
            // Définir les en-têtes pour le téléchargement
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file_path));
            readfile($file_path);
            exit;
        } else {
            echo 'Fichier non trouvé.';
        }
    } else {
        // Vérifier si l'id correspond à un communiqué
        $communique_result = $conn->query("SELECT * FROM communiques1 WHERE id = $id");
        if ($communique_result->num_rows > 0) {
            $row = $communique_result->fetch_assoc();
            $file_path = 'assets/communique1/' . $row['fichier_pdf'];

            if(file_exists($file_path)){
                // Définir les en-têtes pour le téléchargement
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($file_path));
                readfile($file_path);
                exit;
            } else {
                echo 'Fichier non trouvé.';
            }
        } else {
            echo 'Aucun enregistrement trouvé avec cet identifiant.';
        }
    }
} else {
    echo 'Identifiant non fourni.';
}
?>
