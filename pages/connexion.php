<?php

$hote = "localhost"; 
$bd = "site_sae"; 
$login = "root"; 
$mdp = ""; 

try {
    $bdd = new PDO("mysql:host=$hote;dbname=$bd", $login, $mdp);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM Utilisateur WHERE Email = :email";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($utilisateur && password_verify($password, $utilisateur['MotDePasse'])) {
        session_start();
        $_SESSION['user_id'] = $utilisateur['IDUtilisateur'];
        $_SESSION['user_name'] = $utilisateur['Nom'];
        // Redirection vers la page d'accueil ou le tableau de bord de l'utilisateur
        header("Location: index_connect.php");
    } else {
        // Échec de la connexion, renvoyer un message d'erreur
        echo "Adresse e-mail ou mot de passe incorrect.";
    }

} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>
