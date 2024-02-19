
<?php
include('db_connect.php');

// Supposons que vous stockiez le nom d'utilisateur (adresse e-mail) dans une variable de session
$user_email = $_SESSION['login_username'];;

// Récupérer le type d'utilisateur à partir de la base de données
$user_type = $_SESSION['login_type'];  // Par défaut, s'il n'est pas trouvé dans la base de données

$qry = $conn->query("SELECT * FROM vacancy ");
while ($row = $qry->fetch_assoc()) {
    $pos[$row['id']] = $row['position'];
}

$pid = 'all';
if (isset($_GET['pid']) && $_GET['pid'] >= 0) {
    $pid = $_GET['pid'];
}

$position_id = 'all';
if (isset($_GET['position_id']) && $_GET['position_id'] >= 0) {
    $position_id = $_GET['position_id'];
}

?>
<div class="container-fluid">
    <!-- Le reste de votre code reste inchangé... -->
    <div class="col-lg-12">
        <div class="row">

            <!-- Table Panel -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-12">
                                <span><large><b>Liste des Candidatures</b></large></span>
                                <button class="btn btn-sm btn-block btn-primary btn-sm col-md-2 float-right" type="button" id="new_application"><i class="fa fa-plus"></i> Nouvelle Candidature</button>
                            </div>
                        </div>
                        
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-md-2 offset-md-2 text-right">Poste :</div>
                                    <div class="col-md-5">
                                        <select name="" class="custom-select browser-default select2" id="position_filter">
                                            <option value="all"  <?php echo isset($position_id) && $position_id == "all" ? "selected" : '' ?>>Tout</option>
                                            <?php foreach($pos as $k => $v): ?>
                                                <option value="<?php echo $k ?>" <?php echo isset($position_id) && $position_id == $k ? "selected" : '' ?>><?php echo $v ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr><br>
                        <table class="table table-bordered table-hover">
                            <colgroup>
                                <col width="10%">
                                <col width="30%">
                                <col width="20%">
                                <col width="30%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Information sur la Candidature</th>
                                    <th class="text-center">Statut</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i = 1;
                                $stats = $conn->query("SELECT * FROM recruitment_status order by id asc");
                                $stat_arr[0] = "New";
                                while ($row = $stats->fetch_assoc()) {
                                    $stat_arr[$row['id']] = $row['status_label'];
                                }
                                $awhere = '';
                                if(isset($_GET['pid']) && $_GET['pid'] >= 0){
                                    $awhere = " where a.process_id = '".$_GET['pid']."' ";
                                }
                                if(isset($_GET['position_id']) && $_GET['position_id'] > 0){
                                    if(empty($awhere))
                                    $awhere = " where a.position_id = '".$_GET['position_id']."' ";
                                    else
                                    $awhere = " and a.position_id = '".$_GET['position_id']."' ";

                                }
                                $application = '';
                                if ($user_type == 3) {
                                    // Si le type d'utilisateur est 3, récupérez uniquement les candidatures pour lesquelles il a postulé
                                    $application = $conn->query("SELECT a.*, v.position FROM application a INNER JOIN vacancy v ON v.id = a.position_id WHERE a.email = '$user_email' ORDER BY a.id ASC");
                                } else {
                                    // Pour les types 1 et 2, récupérez toutes les candidatures
                                    $application = $conn->query("SELECT a.*, v.position FROM application a INNER JOIN vacancy v ON v.id = a.position_id ORDER BY a.id ASC");
                                }
                                while($row=$application->fetch_assoc()):
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $i++ ?></td>
                                    <td class="">
                                        <p>Nom : <b><?php echo ucwords($row['lastname'].', '.$row['firstname'].' '.$row['middlename']) ?></b></p>
                                        <p>Postuler Pour : <b><?php echo $row['position'] ?></b></p>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $stat_arr[$row['process_id']] ?>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-primary view_application" type="button" data-id="<?php echo $row['id'] ?>" >Voir</button>
                                        <button class="btn btn-sm btn-primary edit_application" type="button" data-id="<?php echo $row['id'] ?>" >Editer</button>
                                        <button class="btn btn-sm btn-danger delete_application" type="button" data-id="<?php echo $row['id'] ?>">Supprimer</button>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 form-group">Statut :</div>
                            <div class="col-md-12 form-group">
                                <button class="btn-block btn-sm btn filter_status" type="button" data-id="all">Tout</button>
                            </div>
                        </div>
                        <?php foreach ($stat_arr as $key => $value): ?>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <button class="btn-block btn-sm btn filter_status" type="button" data-id="<?php echo $key ?>" ><?php echo $value ?></button>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <!-- Table Panel -->
        </div>
    </div>  
    <!-- ... (votre code existant pour l'affichage des candidatures) ... -->
</div>

<style>
    td {
        vertical-align: middle !important;
    }

    td p {
        margin: unset
    }

    img {
        max-width: 100px;
        max-height: :150px;
    }
</style>

<script>
    $('.filter_status').each(function () {
        if ($(this).attr('data-id') == '<?php echo $pid ?>')
            $(this).addClass('btn-primary')
        else
            $(this).addClass('btn-info')

    })
    $('table').dataTable()
    $("#new_application").click(function () {
        uni_modal("New Application", "manage_application.php", "mid-large")
    })
    $(".edit_application").click(function () {
        uni_modal("Edit Application", "manage_application.php?id=" + $(this).attr('data-id'), "mid-large")
    })
    $(".view_application").click(function () {
        uni_modal("", "view_application.php?id=" + $(this).attr('data-id'), "mid-large")
    })

    $('.delete_application').click(function () {
        _conf("Are you sure to delete this Applicant?", "delete_application", [$(this).attr('data-id')])
    })

    function displayImg(input, _this) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#cimg').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $('.filter_status').click(function () {
        location.href = "index.php?page=applications&pid=" + $(this).attr('data-id') + '&position_id=<?php echo $position_id ?>'
    })

    $('#position_filter').change(function () {
        location.href = "index.php?page=applications&position_id=" + $(this).val() + '&pid=<?php echo $pid ?>'
    })

    function delete_application($id) {
        start_load()
        $.ajax({
            url: 'ajax.php?action=delete_application',
            method: 'POST',
            data: { id: $id },
            success: function (resp) {
                if (resp == 1) {
                    alert_toast("Data successfully deleted", 'success')
                    setTimeout(function () {
                        location.reload()
                    }, 1500)

                }
            }
        })
    }
</script>
