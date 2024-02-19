<?php 
include 'admin/db_connect.php'; 
?>

<style>
    .communique {
        cursor: pointer;
    }
</style>

 <header class="masthead">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-10 align-self-end mb-4" style="background: #0000002e;">
                    <h1 class="text-uppercase text-white font-weight-bold">Avis et communiqués en cours ...</h1>
                    <hr class="divider my-4" />
                </div>
            </div>
        </div>
    </header>

<section id="list">
    <div class="container mt-3 pt-2">
        <h4 class="text-center">Liste des Communiqués</h4>
        <hr class="divider">
        <?php
        $communiques = $conn->query("SELECT * FROM communiques ORDER BY date(created_at) DESC");
        while ($row = $communiques->fetch_assoc()):
        ?>
            <div class="card communique" data-id="<?php echo $row['id'] ?>">
                <div class="card-body">
                    <h3><?php echo $row['titre'] ?></h3>
                    <span><small>Date de publication : <?php echo $row['created_at'] ?></small></span>
                    <hr>
                    <br>
                    <a href="admin/download.php?id=<?php echo $row['id']; ?>" class="btn btn-primary" target="_blank">Télécharger le Communiqué</a>
                    <!-- Vous pouvez également ajouter un bouton pour ouvrir une page de consultation détaillée -->
                </div>
            </div>
            <br>
        <?php endwhile; ?>
    </div>
</section>

<script>
    $('.card.communique').click(function () {
        var communiqueId = $(this).attr('data-id');
        
        // Obtenez le nom du fichier directement depuis l'élément de la carte
        var fileName = $(this).data('fichier-pdf');

        // Créez un lien temporaire
        var downloadLink = document.createElement('a');
        downloadLink.href = 'admin/download.php?filename=' + encodeURIComponent(fileName);
        downloadLink.download = fileName;

        // Ajoutez le lien au document
        document.body.appendChild(downloadLink);

        // Déclenchez le téléchargement
        downloadLink.click();

        // Supprimez le lien du document
        document.body.removeChild(downloadLink);
    });
</script>

