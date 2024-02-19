<?php include 'db_connect.php' ?>
<style>
   
</style>

<div class="containe-fluid">

	<div class="row">
		<div class="col-lg-12">
			
		</div>
	</div>

	<div class="row mt-3 ml-3 mr-3">
			<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
				<?php echo "Bienvenu ". $_SESSION['login_name']."!"  ?>
									
				</div>
				<hr>
				<div class="row ml-2 mr-2">
                      <div class="col-md-3">
                  <div class="card bg-warning text-white mb-3">
                    
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="text-white-75 small"><a href="../index.php">Accueil Principal</a></div>
                                </div>
                            </div>
                            
                    </div>
              </div>
				<div class="col-md-3 offset-md-3">
                        <div class="card bg-primary text-white mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="mr-3">
                                        <div class="text-white-75 small">Nouvelles Candidatures</div>
                                        <div class="text-lg font-weight-bold">
                                        	<?php 
                                    $user_email = $_SESSION['login_username'];
                                    $user_type = $_SESSION['login_type'];

                                    // Requête SQL pour compter les candidatures en fonction du type d'utilisateur
                                    if ($user_type == 3) {
                                        $query = "SELECT COUNT(*) AS num_applications
                                                  FROM application a
                                                  INNER JOIN users u ON a.email = u.username
                                                  WHERE u.username = '$user_email' AND a.process_id = 0";
                                    } else {
                                        $query = "SELECT COUNT(*) AS num_applications
                                                  FROM application a
                                                  WHERE a.process_id = 0";
                                    }

                                    $result = $conn->query($query);

                                    if ($result) {
                                        $row = $result->fetch_assoc();
                                        $num_applications = $row['num_applications'];
                                        echo $num_applications;
                                    } else {
                                        echo "Erreur dans la requête : " . $conn->error;
                                    }
                                    ?>

                                        		
                                    	</div>
                                    </div>
                                    <i class="fa fa-user-tie"></i>
                                </div>
                            </div>
                            
                    </div>
		      </div>
              <div class="col-md-3">
                  <div class="card bg-warning text-white mb-3">

                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="mr-3">
                                        <div class="text-white-75 small">Poste Active</div>
                                        <div class="text-lg font-weight-bold">
                                            <?php 
                                            $vacancies = $conn->query("SELECT * FROM vacancy where status = 1  ");
                                            echo $vacancies->num_rows;
                                             ?>
                                                
                                        </div>
                                    </div>
                                    <i class="fa fa-search"></i>
                                </div>
                            </div>
                            
                    </div>
              </div>
		</div>
    </div>
	</div>

</div>
<script>
	
</script>