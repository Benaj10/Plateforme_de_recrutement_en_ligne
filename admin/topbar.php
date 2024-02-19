<style>
    .logo {
        margin: auto;
        background: white;
        padding: 7px;
        border-radius: 50%;
        color: #000000b3;
        width: 40px; /* Set the width of the logo */
        height: 40px; /* Set the height of the logo */
        overflow: hidden;
    }

    .logo img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Keep the image aspect ratio and cover the entire space */
    }
</style>

<nav class="navbar navbar-light fixed-top bg-primary" style="padding:0;">
    <div class="container-fluid mt-2 mb-2">
        <div class="col-lg-12">
            <div class="col-md-1 float-left" style="display: flex;">
                <div class="logo">
                    <img src="insd.png" alt="Logo Image">
                </div>
            </div>
            <div class="col-md-4 float-left text-white">
                <large><b>Gestion des Recrutement INSD</b></large>
            </div>
            <div class="col-md-2 float-right text-white">
                <a href="ajax.php?action=logout" class="text-white"><?php echo $_SESSION['login_name'] ?> <i class="fa fa-power-off"></i></a>
            </div>
        </div>
    </div>
</nav>
