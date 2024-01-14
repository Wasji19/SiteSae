<?php

$mysqli = new mysqli("localhost", "root", "", "site_sae");

// Vérifier la connexion
if ($mysqli->connect_error) {
    die("La connexion à la base de données a échoué: " . $mysqli->connect_error);
}

// Récupérer les données du formulaire
$titre = $_POST['nomEvenement'];
$description = $_POST['descriptionEvenement'];
$dateEvenement = $_POST['dateEvenement'];
$lieu = $_POST['lieuEvenement'];

// Préparer la requête SQL
$stmt = $mysqli->prepare("INSERT INTO Evenements (Titre, Description, DateEvenement, Lieu, Approuve) VALUES (?, ?, ?, ?,0)");
$stmt->bind_param("ssss", $titre, $description, $dateEvenement, $lieu);

// Exécuter la requête
if ($stmt->execute()) {
    echo json_encode(['message' => 'Événement ajouté avec succès']);
} else {
    echo json_encode(['error' => 'Erreur lors de l\'ajout de l\'événement']);
}

// Fermer la connexion et libérer les ressources
$stmt->close();
$mysqli->close();
?>
