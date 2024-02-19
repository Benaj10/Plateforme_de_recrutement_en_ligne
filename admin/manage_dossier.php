<?php 
include('db_connect.php');

$id = isset($_GET['id']) ? $_GET['id'] : '';

if (!empty($id)) {
    // Si l'identifiant est fourni, récupérez les données du dossier existant
    $result = $conn->query("SELECT * FROM dossiers WHERE id = $id");
    $row = $result->fetch_assoc();
    $titre_dossier = $row['titre_dossier'];
    // Autres champs à récupérer selon votre structure de base de données
} else {
    // Si aucun identifiant n'est fourni, initialisez les variables
    $titre_dossier = '';
    // Autres champs à initialiser selon votre structure de base de données
}
?>

<div class="container-fluid">
    <form id="manage-dossier">
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <div class="form-group">
            <label for="titre_dossier">Titre du dossier :</label>
            <input type="text" class="form-control" name="titre_dossier" value="<?php echo $titre_dossier ?>" required>
        </div>
        <!-- Ajoutez d'autres champs du formulaire en fonction de votre structure de base de données -->
        
        <div class="form-group">
            <label for="fichiers">Fichiers PDF :</label>
            <?php
            if (!empty($id)) {
                // Récupérer les fichiers PDF associés à ce dossier
                $fichiers_pdf = $conn->query("SELECT nom_fichier FROM fichiers_dossier WHERE dossier_id = $id AND fichier_blob IS NOT NULL");
                while ($fichier_pdf = $fichiers_pdf->fetch_assoc()) {
                    echo '<p>Nom du fichier PDF : ' . $fichier_pdf['nom_fichier'] . '</p>';
                    // Vous pouvez ajouter des liens pour télécharger ou afficher ces fichiers si nécessaire
                }
            } else {
                echo '<p>Aucun dossier sélectionné</p>';
            }
            ?>
            <!-- Input pour ajouter de nouveaux fichiers PDF -->
            <input type="file" class="form-control-file" name="fichiers_pdf[]" multiple>
        </div>

        <div class="form-group">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>  
    </form>
</div>

<script>
    $(document).ready(function(){
        $('#manage-dossier').submit(function(e){
            e.preventDefault();
            start_load()
            $.ajax({
                url:'ajax.php?action=save_dossier',
                method:'POST',
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                success:function(resp){
                    if(resp==1){
                        alert_toast("Données enregistrées avec succès",'success')
                        setTimeout(function(){
                            location.reload()
                        },1500)
                    }
                }
            })
        })
    })
</script>
