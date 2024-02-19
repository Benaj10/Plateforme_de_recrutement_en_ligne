<?php 
include 'admin/db_connect.php'; 
?>

<style>
    .dossier {
        cursor: pointer;
    }
</style>

<?php 
include 'admin/db_connect.php'; 

// Récupérer le nombre total de dossiers en cours
$totalDossiers = $conn->query("SELECT COUNT(*) as total FROM dossiers")->fetch_assoc()['total'];

// Récupérer le nombre de dossiers conformes
$conformes = $conn->query("SELECT COUNT(*) as conformes FROM dossiers WHERE etat = 'conforme'")->fetch_assoc()['conformes'];

// Récupérer le nombre de dossiers non conformes
$nonConformes = $conn->query("SELECT COUNT(*) as non_conformes FROM dossiers WHERE etat = 'non conforme'")->fetch_assoc()['non_conformes'];
?>

<header class="masthead">
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-10 align-self-end mb-4" style="background: #0000002e;">
                <h1 class="text-uppercase text-white font-weight-bold">Dossiers en cours...</h1>
                <hr class="divider my-4" />

                <div class="row">
                    <div class="col-md-4">
                        <h4>Total : <?php echo $totalDossiers; ?></h4>
                    </div>
                    <div class="col-md-4">
                        <h4>Conformes : <?php echo $conformes; ?></h4>
                    </div>
                    <div class="col-md-4">
                        <h4>Non conformes : <?php echo $nonConformes; ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>


<section id="list">
    <div class="container mt-3 pt-2">
        <h4 class="text-center">Liste des Dossiers</h4>
        <hr class="divider">
        <?php
        $dossiers = $conn->query("SELECT * FROM dossiers ORDER BY created_at DESC");
        while ($row = $dossiers->fetch_assoc()):
        ?>
            <div class="card dossier" data-id="<?php echo $row['id'] ?>" data-fichier-pdf="<?php echo $row['fichier_pdf'] ?>">
                <div class="card-body">
                    <h3><?php echo $row['titre_dossier'] ?></h3>
                    <span><small>Date de création : <?php echo $row['created_at'] ?></small></span>
                    <hr>
                    <br>
                    <a href="admin/download_dossier.php?id=<?php echo $row['id']; ?>" class="btn btn-primary" target="_blank">Télécharger le Dossier</a>
                    <!-- Vous pouvez également ajouter un bouton pour ouvrir une page de consultation détaillée -->
                </div>
            </div>
            <br>
        <?php endwhile; ?>
    </div>
</section>

<script>
    $('.card.dossier').click(function () {
        var dossierId = $(this).attr('data-id');
        
        // Obtenez le nom du fichier PDF directement depuis l'élément de la carte
        var fileName = $(this).data('fichier-pdf');

        // Créez un lien temporaire
        var downloadLink = document.createElement('a');
        downloadLink.href = 'admin/dowload.php?filename=' + encodeURIComponent(fileName);
        downloadLink.download = fileName;

        // Ajoutez le lien au document
        document.body.appendChild(downloadLink);

        // Déclenchez le téléchargement
        downloadLink.click();

        // Supprimez le lien du document
        document.body.removeChild(downloadLink);
    });
</script>
