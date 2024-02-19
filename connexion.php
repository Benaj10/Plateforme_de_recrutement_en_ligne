
<?php  
include('admin/header.php'); 
include('admin/db_connect.php'); ?>
<body>
    <header class="masthead">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center text-center">
                <div class="col-lg-10 align-self-end mb-4" style="background: #0000002e;">
                    <h1 class="text-uppercase text-white font-weight-bold">Connectez-vous</h1>
                    <hr class="divider my-4" />
                </div>
            </div>
        </div>
    </header>
    
    <div class="container-fluid">
        <form action="" id="login-form">
            <div class="form-group">
                <label for="username">Email</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de Passe</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Se Connecter</button>
                
                <a href="#" onclick="forgotPassword()">Mot de Passe Oublié?</a>
            </div>
            <div class="form-group">
               
                <a href="index.php?page=add_inscrit" class="ml-2">Je n'ai pas de compte</a>
               
            </div>
        </form>
    </div>

    <script>
            function forgotPassword() {
            alert('Instruction de récupération du mot de passe envoyée à votre adresse e-mail.');
            // Vous pouvez ajouter du code pour gérer l'envoi d'instructions de récupération du mot de passe ici
                var username = $('#username').val();

    if (username.trim() === "") {
        alert('Veuillez entrer votre adresse e-mail pour la récupération du mot de passe.');
        return;
    }

    $.ajax({
        url: 'admin/ajax.php?action=forgot_password',
        method: 'POST',
        data: { username: username },
        success: function (resp) {
            if (resp == 1) {
                alert('Instructions de récupération du mot de passe envoyées à votre adresse e-mail.');
            } else {
                alert('Échec de l\'envoi des instructions de récupération du mot de passe.');
            }
        }
    });


        }
        $('#login-form').submit(function(e){
        e.preventDefault()
        $('#login-form button[type="button"]').attr('disabled',true).html('Logging in...');
        if($(this).find('.alert-danger').length > 0 )
            $(this).find('.alert-danger').remove();
        $.ajax({
            url:'admin/ajax.php?action=login',
            method:'POST',
            data:$(this).serialize(),
            error:err=>{
                console.log(err)
        $('#login-form button[type="button"]').removeAttr('disabled').html('Login');

            },
            success:function(resp){
                if(resp == 1){
                     location.href ='index.php';
                    alert('Connexion réussie.');
                }else if(resp == 3){
                    location.href ='admin/loging.php';
                }else{
                    $('#login-form').prepend('<div class="alert alert-danger">e-mail ou mot de passe incorrect.</div>')
                    $('#login-form button[type="button"]').removeAttr('disabled').html('Login');
                }
            }
        })
    })
     </script>