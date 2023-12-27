<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "l3_web";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("La connexion à la base de données a échoué : " . $conn->connect_error);
}

//récupération et protection des données envoyées
$Id_Module = isset($_POST['Id_Module']) ? $_POST['Id_Module'] : null;
$Nom_Module = isset($_POST['Nom_Module']) ? $_POST['Nom_Module'] : null;
$Cle_Module = isset($_POST['Cle_Module']) ? $_POST['Cle_Module'] : null;
$Semestre = isset($_POST['Semestre']) ? $_POST['Semestre'] : null;
$Public_Cible = isset($_POST['Public_Cible']) ? $_POST['Public_Cible'] : null;
$Id_Cour = isset($_POST['Id_Cour']) ? $_POST['Id_Cour'] : null;
// Récupérer la spécialité depuis la requête GET
$Public_cible = $_GET['Public_Cible'];
$Nom_Module = $_GET['Nom_Module'];
$Cle_Module = $_GET['Cle_Module'];
$Semestre = $_GET['Semestre'];
$Id_Cour = $_GET['Id_Cour'];
// Désactiver temporairement la vérification des clés étrangères
$connexion->query("SET foreign_key_checks = 0");

// Votre requête d'insertion ici

// Réactiver la vérification des clés étrangères
$connexion->query("SET foreign_key_checks = 1");

// Requête SQL pour trier les modules par spécialité
$requete = "SELECT * FROM module WHERE Public_Cible = '$Public_Cible' ORDER BY Nom_Module";
$resultat = $connexion->query($requete);

// Afficher les résultats
if ($resultat) {
    while ($row = $resultat->fetch_assoc()) {
        echo $row['Nom_Module'] . '<br>';
    }

    // Libérer la mémoire du résultat
    $resultat->free();
} else {
    // Afficher une erreur si la requête a échoué
    echo "Erreur dans la requête : " . $connexion->error;
}

// Fermer la connexion à la base de données
$connexion->close();
