<?php 
include('admin/db_connect.php');

$meta = array(); // Initialisation du tableau pour éviter les erreurs

if(isset($_GET['id'])){
    $user = $conn->query("SELECT * FROM users where id =" . $_GET['id']);
    if ($user) {
        $meta = $user->fetch_assoc(); // Utilisation de fetch_assoc() pour récupérer un tableau associatif directement
    }
}
?>
<header class="masthead">
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-10 align-self-end mb-4" style="background: #0000002e;">
                <h1 class="text-uppercase text-white font-weight-bold">Merci de vous inscrire</h1> <!-- Fermerture de la balise h1 manquante -->
                <hr class="divider my-4" />
            </div>
        </div>
    </div>
</header>
<div class="container-fluid">
    <form action="" id="manage-user">
        <input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id']: '' ?>">
        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" name="name" id="name" class="form-control" value="<?php echo isset($meta['name']) ? $meta['name']: '' ?>" required>
        </div>
        <div class="form-group">
            <label for="username">Email</label>
            <input type="email" name="username" id="username" class="form-control" value="<?php echo isset($meta['username']) ? $meta['username']: '' ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Mot de Passe</label>
            <input type="password" name="password" id="password" class="form-control" value="<?php echo isset($meta['password']) ? $meta['password']: '' ?>" required>
        </div>
             <div class="form-group d-none">
            <label for="type" class="d-none"> Type d'utilisateur</label>
            <select name="type" id="type" class="custom-select d-none" readonly>
                <option value="3" selected>Candidat</option>
            </select>
        </div>

        <div class="form-group">
               
                <a href="index.php?page=connexion" class="ml-2">J'ai déja un compte</a>
               
            </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Sauver</button>
            <button type="button" class="btn btn-secondary" onclick="cancelForm()">Annuler</button>
        </div>
    </form>
</div>
<script>
    $('#manage-user').submit(function(e){
        e.preventDefault();
        start_load()
        $.ajax({
            url:'admin/ajax.php?action=save_user',
            method:'POST',
            data:$(this).serialize(),
            success:function(resp){
                if(resp == 1){
                    alert_toast("Inscription réussie",'success')
                    location.reload()
                } else if (resp == 2) {
                    alert('L\'adresse e-mail existe déjà. Veuillez choisir une autre adresse e-mail');
                    location.reload()
                } else {
                    alert('Error saving data');
                }
            }
        })
    })
    
    function cancelForm() {
        window.location.href = 'index.php';
    }
</script>
