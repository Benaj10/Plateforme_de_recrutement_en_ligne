<?php 
include('db_connect.php');
if(isset($_GET['id'])){
    $id = $_GET['id'];

    // Vérifier si l'id correspond à un dossier
    $dossier_result = $conn->query("SELECT * FROM dossiers WHERE id = $id");
    if ($dossier_result->num_rows > 0) {
        $row = $dossier_result->fetch_assoc();
        $dossier_name = $row['titre_dossier']; // Utilisez le nom du dossier comme base pour le nom du fichier ZIP
        $zip = new ZipArchive();
        $zipFileName = $dossier_name . '_files.zip'; // Nom du fichier ZIP
        
        if ($zip->open($zipFileName, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            // Récupérer les chemins des fichiers associés à ce dossier
            $files_result = $conn->query("SELECT * FROM fichiers WHERE dossier_id = $id");
            while ($file_row = $files_result->fetch_assoc()) {
                $file_path = 'admin/assets/dossier_candidature' . $file_row['nom_fichier']; // Adapter le chemin selon votre structure de stockage des fichiers
                if(file_exists($file_path)){
                    // Ajouter chaque fichier au fichier ZIP
                    $zip->addFile($file_path, basename($file_path));
                }
            }
            $zip->close();

            // Définir les en-têtes pour le téléchargement du fichier ZIP
            header('Content-Type: application/zip');
            header('Content-Disposition: attachment; filename="' . $zipFileName . '"');
            header('Content-Length: ' . filesize($zipFileName));
            readfile($zipFileName);
            
            // Supprimer le fichier ZIP une fois téléchargé
            unlink($zipFileName);
            exit;
        } else {
            echo 'Erreur lors de la création du fichier ZIP.';
        }
    } else {
        echo 'Aucun enregistrement trouvé avec cet identifiant.';
    }
} else {
    echo 'Identifiant non fourni.';
}
?>
