<?php 
include('db_connect.php');?>
<?php 
$id = isset($_GET['id']) ? $_GET['id'] : '';

if (!empty($id)) {
    // Si l'identifiant est fourni, récupérez les données du communiqué existant
    $result = $conn->query("SELECT * FROM communiques WHERE id = $id");
    $row = $result->fetch_assoc();
    $titre = $row['titre'];
     $fichier_pdf = $row['fichier_pdf'];
    // Autres champs à récupérer selon votre structure de base de données
} else {
    // Si aucun identifiant n'est fourni, initialisez les variables
    $titre = '';
    $fichier_pdf = '';
    // Autres champs à initialiser selon votre structure de base de données
}
?>

<div class="container-fluid">
    <form id="manage-communique">
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <div class="form-group">
            <label for="titre">Titre :</label>
            <input type="text" class="form-control" name="titre" value="<?php echo $titre ?>" required>
        </div>
        <!-- Ajoutez d'autres champs du formulaire en fonction de votre structure de base de données -->
        
        <div class="form-group">
            <label for="fichier_pdf">Fichier PDF :</label>
            <input type="file" class="form-control" name="fichier_pdf">
            <?php if (!empty($row['fichier_pdf'])): ?>
                <small>Fichier actuel : <a href="assets/communique/<?php echo $row['fichier_pdf'] ?>" target="_blank">Voir le PDF</a></small>
            <?php endif; ?>
        </div>

       <div class="form-group">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>  
    </form>
</div>

<script>
    $(document).ready(function(){
        $('#manage-communique').submit(function(e){
            e.preventDefault();
            start_load()
            $.ajax({
                url:'ajax.php?action=save_communique',
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
