<?php 
include('db_connect.php');

$id = isset($_GET['id']) ? $_GET['id'] : '';

if (!empty($id)) {
    // Récupérez les données du communiqué en fonction de l'identifiant fourni
    $result = $conn->query("SELECT * FROM communiques WHERE id = $id");
    $row = $result->fetch_assoc();
    $titre = $row['titre'];
    // Autres champs à récupérer selon votre structure de base de données
}
?>

<div class="container-fluid">
    <h2>Détails du Communiqué</h2>
    <hr>
    <div class="row">
        <div class="col-md-6">
            <strong>Titre:</strong> <?php echo $titre; ?>
            <!-- Affichez d'autres champs du communiqué en fonction de votre structure de base de données -->
        </div>
        <!-- Ajoutez d'autres colonnes pour afficher les détails du communiqué -->

        <div class="col-md-6">
            <strong>Fichier PDF:</strong> 
            <?php if (!empty($row['fichier_pdf'])): ?>
                <a href="download.php?id=<?php echo $row['fichier_pdf'] ?>" target="_blank">Voir le PDF</a>
            <?php else: ?>
                Aucun fichier PDF associé.
            <?php endif; ?>
        </div>
        <div class="col-md-6">
    <strong>Fichier PDF:</strong> 
    <?php if (!empty($row['fichier_pdf'])): ?>
        <a href="download.php?id=<?php echo $id; ?>" target="_blank">Télécharger le PDF</a>
    <?php else: ?>
        Aucun fichier PDF associé.
    <?php endif; ?>
</div>
    </div>
    <!-- Ajoutez d'autres sections pour afficher d'autres détails du communiqué -->
</div>
