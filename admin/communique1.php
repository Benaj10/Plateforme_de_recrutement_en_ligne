<?php include('db_connect.php');?>

<div class="container-fluid">
    <div class="col-lg-12">
        <div class="row">
            <!-- Table Panel -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-12">
                                <span><large><b>Liste des dossiers</b></large></span>
                                <button class="btn btn-sm btn-block btn-primary btn-sm col-md-2 float-right" type="button" id="new_communique"><i class="fa fa-plus"></i> Nouveau dossier</button>
                            </div>
                        </div>
                    </div>
              <div class="container mt-4">
                <?php 

if($_SESSION['login_type'] == 3): ?>
    <div class="alert alert-info">
        <h4 class="alert-heading">Complétez votre candidature</h4>
        <p>Pour finaliser votre candidature, veuillez compiler tous les fichiers requis en un seul fichier et l'uploader ici.</p>
        <hr>
        <p class="mb-0">Assurez-vous d'inclure tous les documents nécessaires pour votre candidature dans un seul fichier compressé (par exemple, ZIP ou RAR).</p>
    </div>

    <!-- Ajoutez ici la liste des dossiers ou d'autres éléments de votre interface -->
</div>
<?php endif; ?> 
                    <div class="card-body">
                        <table class="table table-bordered table-hover">
                            <colgroup>
                                <col width="10%">
                                <col width="40%">
                                <col width="20%">
                                <col width="30%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Titre</th>
                                     <th class="text-center">Statut</th>
                                    <th class="text-center">Fichier PDF</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i = 1;
                                $communiques = $conn->query("SELECT * FROM communiques1 order by id asc");
                                while($row=$communiques->fetch_assoc()):
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $i++ ?></td>
                                    <td class="text-center"><?php echo $row['titre'] ?></td>
                                     <td class="text-center"><?php echo $row['statut'] ?></td>
                                    <td class="text-center">
                                        <a href="assets/communique1/<?php echo $row['fichier_pdf'] ?>" target="_blank">Voir le PDF</a>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-primary view_communique" type="button" data-id="<?php echo $row['id'] ?>" >Voir</button>
                                        <button class="btn btn-sm btn-primary edit_communique" type="button" data-id="<?php echo $row['id'] ?>" >Editer</button>
                                        <button class="btn btn-sm btn-danger delete_communique" type="button" data-id="<?php echo $row['id'] ?>">Supprimer</button>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Table Panel -->
        </div>
    </div>  
</div>

<style>
    td{
        vertical-align: middle !important;
    }
    td p{
        margin: unset
    }
    img{
        max-width:100px;
        max-height: :150px;
    }
</style>

<script>
    $('table').dataTable()
    $("#new_communique").click(function(){
        uni_modal("Nouveau Dossier","manage_communique1.php","mid-large")
    })
    $(".edit_communique").click(function(){
        uni_modal("Editer Dossier","manage_communique1.php?id="+$(this).attr('data-id'),"mid-large")
    })
    $(".view_communique").click(function(){
        uni_modal("Voir Dossier","view_communique1.php?id="+$(this).attr('data-id'),"mid-large")
    })

    $('.delete_communique').click(function(){
        _conf("Êtes-vous sûr de vouloir supprimer ce Dossier?","delete_communique1",[$(this).attr('data-id')])
    })

    function delete_communique1($id){
        start_load()
        $.ajax({
            url:'ajax.php?action=delete_communique1',
            method:'POST',
            data:{id:$id},
            success:function(resp){
                if(resp==1){
                    alert_toast("Données supprimées avec succès",'success')
                    setTimeout(function(){
                        location.reload()
                    },1500)
                }
            }
        })
    }
</script>
