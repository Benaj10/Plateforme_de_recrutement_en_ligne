
<style>
</style>
<nav id="sidebar" class='mx-lt-5 bg-dark' >
		
		<div class="sidebar-list">

				<a href="index.php?page=home" class="nav-item nav-home"><span class='icon-field'><i class="fa fa-home"></i></span> Accueil</a>
				
				<a href="index.php?page=applications" class="nav-item nav-applications"><span class='icon-field'><i class="fa fa-user-tie"></i></span> Profil</a>	
				<?php if($_SESSION['login_type'] == 3): ?>
					<a href="index.php?page=applications" class="nav-item nav-applications"><span class='icon-field'><i class="fa fa-file"></i></span> Candidatures</a>	
					<a href="index.php?page=communique1" class="nav-item nav-site_settings"><span class='icon-field'><i class="fa fa-archive"></i></span> Composer mon dossier</a>
				
					<?php endif; ?>	
				<?php if($_SESSION['login_type'] == 2): ?>
				
				<a href="index.php?page=applications" class="nav-item nav-applications"><span class='icon-field'><i class="fa fa-file"></i></span> Candidatures</a>	
				<a href="index.php?page=recruitment_status" class="nav-item nav-recruitment_status"><span class='icon-field'><i class="fa fa-th-list"></i></span> Categories de Statuts</a>	
				<a href="index.php?page=communiques" class="nav-item nav-criteres">
 			   <span class='icon-field'>
   		     <i class="fa fa-list"></i> </span>  Critères</a>
   		     <a href="index.php?page=communique1" class="nav-item nav-site_settings"><span class='icon-field'><i class="fa fa-archive"></i></span> Gestion des dossiers</a>
   		     <a href="index.php?page=liste1" class="nav-item nav-criteres">
 			   <span class='icon-field'>
   		     <i class="fa fa-list"></i> </span> Liste</a>
				
				<?php endif; ?>	
				<?php if($_SESSION['login_type'] == 1): ?>
				<a href="index.php?page=vacancy" class="nav-item nav-vacancy"><span class='icon-field'><i class="fa fa-list-alt"></i></span> Offres</a>	
				<a href="index.php?page=communiques" class="nav-item nav-communiques"><span class='icon-field'><i class="fa fa-bullhorn"></i></span> Communiqués</a>
				<a href="index.php?page=users" class="nav-item nav-users"><span class='icon-field'><i class="fa fa-users"></i></span> Utilisateurs</a>
				<a href="index.php?page=site_settings" class="nav-item nav-site_settings"><span class='icon-field'><i class="fa fa-archive"></i></span> Archive</a>
				<a href="index.php?page=site_settings" class="nav-item nav-site_settings"><span class='icon-field'><i class="fa fa-cogs"></i></span> Parametres</a>
				
			<?php endif; ?>
		</div>

</nav>
<script>
	$('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>
