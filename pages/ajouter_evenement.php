<?php

$mysqli = new mysqli("localhost", "root", "", "site_sae");

if ($mysqli->connect_error) {
    die("La connexion à la base de données a échoué: " . $mysqli->connect_error);
}

$titre = $_POST['nomEvenement'];
$description = $_POST['descriptionEvenement'];
$dateEvenement = $_POST['dateEvenement'];
$lieu = $_POST['lieuEvenement'];
$telephone = $_POST['telephoneEvenement'];
$email = $_POST['emailEvenement'];

// Gestion de l'upload de l'image
$targetDir = "Galerie_Files/";
$targetFile = $targetDir . basename($_FILES["imageEvenement"]["name"]);
move_uploaded_file($_FILES["imageEvenement"]["tmp_name"], $targetFile);

$stmt = $mysqli->prepare("INSERT INTO Evenements (Titre, Description, DateEvenement, Lieu, Image, Telephone, Email, Approuve) VALUES (?, ?, ?, ?, ?, ?, ?, 0)");
$stmt->bind_param("sssssss", $titre, $description, $dateEvenement, $lieu, $targetFile, $telephone, $email);

if ($stmt->execute()) {
    echo json_encode(['message' => 'Événement ajouté avec succès']);
} else {
    echo json_encode(['error' => 'Erreur lors de l\'ajout de l\'événement']);
}

$stmt->close();
$mysqli->close();
?>
