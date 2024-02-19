<?php
include('db_connect.php'); // Inclure votre fichier de connexion à la base de données

// Récupérer les candidats par type d'offres
$query = "SELECT u.username, u.type, a.firstname, a.middlename, a.lastname, a.gender, a.email, v.position AS nom_offre
          FROM users u 
          INNER JOIN application a ON u.username = a.email 
          INNER JOIN vacancy v ON a.position_id = v.id";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Initialiser un tableau pour regrouper les candidats par type d'offres
    $candidats_par_offre = array();

    // Regrouper les candidats par type d'offres
    while ($row = $result->fetch_assoc()) {
        $nom_offre = $row['nom_offre'];

        // Vérifier si l'offre existe dans le tableau
        if (!isset($candidats_par_offre[$nom_offre])) {
            $candidats_par_offre[$nom_offre] = array();
        }

        // Ajouter les détails du candidat dans le tableau correspondant à l'offre
        $candidats_par_offre[$nom_offre][] = $row;
    }

    // Afficher la liste des candidats par type d'offres
    echo '<div class="container mt-4">';
    echo '<h3>Liste des candidats retenus par type d\'offres</h3>';

    foreach ($candidats_par_offre as $nom_offre => $candidats) {
        echo '<h4>' . $nom_offre . '</h4>';
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
        foreach ($candidats as $candidat) {
            echo '<tr>';
            echo '<td>' . $candidat['firstname'] . '</td>';
            echo '<td>' . $candidat['middlename'] . '</td>';
            echo '<td>' . $candidat['lastname'] . '</td>';
            echo '<td>' . $candidat['gender'] . '</td>';
            echo '<td>' . $candidat['email'] . '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
        echo '</div>';
    }

    // Boutons pour télécharger et imprimer la liste
    echo '<form method="POST">';
    echo '<button type="submit" name="download_pdf" class="btn btn-primary">Télécharger la liste au format PDF</button>';
    echo '</form>';
    echo '<button onclick="window.print()" class="btn btn-primary">Imprimer la liste</button>';
    echo '</div>'; // Fermeture de la div container
} else {
    // Si aucun candidat n'est retenu
    echo '<div class="container mt-4">';
    echo '<p>Aucun candidat retenu pour le moment.</p>';
    echo '</div>';
}

if (isset($_POST['download_pdf'])) {
    require('../fpdf/fpdf.php'); // Assurez-vous d'avoir correctement inclus FPDF dans votre projet

    // Création du fichier PDF
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(40, 10, 'Liste des Candidats', 0, 1); // Titre

    $pdf->SetFont('Arial', '', 12);
    foreach ($candidats as $candidat) {
        $pdf->Cell(0, 10, 'Nom: ' . $candidat['firstname'], 0, 1);
        $pdf->Cell(0, 10, 'Surnom: ' . $candidat['middlename'], 0, 1);
        $pdf->Cell(0, 10, 'Prénom: ' . $candidat['lastname'], 0, 1);
        $pdf->Cell(0, 10, 'Genre: ' . $candidat['gender'], 0, 1);
        $pdf->Cell(0, 10, 'Email: ' . $candidat['email'], 0, 1);
        $pdf->Ln(5); // Saut de ligne entre chaque candidat
    }
    // Générez le fichier PDF téléchargeable
    $pdf->Output('liste_candidats.pdf', 'D');
}
?>
