<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <!-- Formulaire pour ajouter un nouveau dossier -->
            <div class="card">
                <div class="card-header">
                    <h4><b>Ajouter un nouveau dossier de candidature</b></h4>
                </div>
                <div class="card-body">
                    <form id="form_add_dossier" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="titre_dossier">Titre du dossier :</label>
                            <input type="text" class="form-control" id="titre_dossier" name="titre_dossier" required>
                        </div>
                        <div id="fichiers_container">
                            <div class="form-group fichier-group">
                                <label for="nom_fichier_1">Nom du fichier :</label>
                                <input type="text" class="form-control" name="noms_fichiers[]" required>
                                <label for="fichier_1">Fichier :</label>
                                <input type="file" class="form-control-file" name="fichiers[]" required>
                                <button type="button" class="btn btn-danger mt-2 remove_file">Retirer</button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-success mt-2 add_file">Ajouter un fichier</button>
                        <button type="submit" class="btn btn-primary mt-2">Enregistrer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Ajouter un champ de fichier supplémentaire
        $('.add_file').click(function() {
            var fileGroup = $('.fichier-group').first().clone();
            fileGroup.find("input[type='text']").val('');
            fileGroup.find("input[type='file']").val('');
            $('#fichiers_container').append(fileGroup);
            updateRemoveButtons();
        });

        // Retirer un champ de fichier
        $('#fichiers_container').on('click', '.remove_file', function() {
            $(this).parent('.fichier-group').remove();
            updateRemoveButtons();
        });

        // Mettre à jour l'affichage des boutons "Retirer"
        function updateRemoveButtons() {
            var fileGroups = $('.fichier-group');
            fileGroups.each(function(index) {
                if (index > 0) {
                    $(this).find('.remove_file').show();
                } else {
                    $(this).find('.remove_file').hide();
                }
            });
        }

        // Initialisation : cacher le bouton "Retirer" pour le premier champ
        $('.fichier-group:first').find('.remove_file').hide();

        // Soumettre le formulaire pour ajouter un nouveau dossier
        $('#form_add_dossier').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: 'ajax.php?action=save_dossier.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                     if(resp==1){
                    alert_toast("Données supprimées avec succès",'success')
                    setTimeout(function(){
                        location.reload()
                    },1500)
                }
                    // Traiter la réponse après l'enregistrement du dossier
                    // Afficher une notification, recharger la page, etc.
                }
            });
        });
    });
</script>
