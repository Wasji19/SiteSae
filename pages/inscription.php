<?php

$hote = "localhost"; 
$bd = "site_sae"; 
$login = "root"; 
$mdp = ""; 

try {
    $bdd = new PDO("mysql:host=$hote;dbname=$bd", $login, $mdp);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($nom) || empty($prenom) || empty($email) || empty($password)) {
        die('Veuillez remplir tous les champs.');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die('Adresse email invalide.');
    }

    if ($password !== $confirm_password) {
        die('Les mots de passe ne correspondent pas.');
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO Utilisateur (Nom, Prenom, Email, MotDePasse) VALUES (?, ?, ?, ?)";
    $stmt = $bdd->prepare($sql);

    try {
        $stmt->execute([$nom, $prenom, $email, $hashed_password]);
        echo "<!DOCTYPE html>
              <html>
              <head>
                  <meta charset='UTF-8'>
                  <title>Inscription Réussie</title>
                  <meta http-equiv='refresh' content='4;url=page connexion.html'>
              </head>
              <body>
                  <p>Inscription réussie! Vous allez être redirigé vers la page de connexion.</p>
              </body>
              </html>";
    } catch(PDOException $e) {
        die("Erreur lors de l'inscription : " . $e->getMessage());
    }

    $stmt = null;
}

$bdd = null;
?>
