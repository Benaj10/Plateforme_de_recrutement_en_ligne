<?php
include('db_connect.php'); // Inclure votre fichier de connexion à la base de données

// Récupérer les candidats retenus avec les champs spécifiques
$query = "SELECT u.username, u.type, a.firstname, a.middlename, a.lastname, a.gender, a.email
          FROM users u 
          INNER JOIN application a ON u.username = a.email 
          WHERE u.type = 3";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Afficher la liste des candidats retenus avec les champs spécifiques dans un tableau Bootstrap
    echo '<div class="container mt-4">';
    echo '<h3>Liste des candidats retenus</h3>';
    echo '<div class="table-responsive">';
    echo '<table class="table table-striped">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Nom</th>';
    echo '<th>Prénom</th>';
    echo '<th>Surnom</th>';
    echo '<th>Genre</th>';
    echo '<th>Email</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['lastname'] . '</td>';
        echo '<td>' . $row['firstname'] . '</td>';
        echo '<td>' . $row['middlename'] . '</td>';
        echo '<td>' . $row['gender'] . '</td>';
        echo '<td>' . $row['email'] . '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
    echo '</div>';
    echo '</div>';
} else {
    // Si aucun candidat n'est retenu
    echo '<div class="container mt-4">';
    echo '<p>Aucun candidat retenu pour le moment.</p>';
    echo '</div>';
}
?>
