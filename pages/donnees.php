<?php
// Paramètres de connexion à la base de données
$hote = "localhost";
$bd = "site_sae"; 
$login = "root"; 
$mdp = ""; 

try {
    $bdd = new PDO("mysql:host=$hote;dbname=$bd", $login, $mdp);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $fichierCSV = fopen("../pages/MOCK_DATA.csv", "r");

    if ($fichierCSV !== FALSE) {
        // Ignorer la première ligne (en-têtes)
        fgetcsv($fichierCSV, 1000, ",");

        // Traitement des lignes suivantes
        while (($ligne = fgetcsv($fichierCSV, 1000, ",")) !== FALSE) {
            $nom = $ligne[0];
            $prenom = $ligne[1];
            $email = $ligne[2];
            $DateNaissance = $ligne[3]; // Assurez-vous que cette date est au format YYYY-MM-DD
            $estAncienEtudiant = rand(0, 1); // Par exemple, aléatoire
            
            $motDePasse = bin2hex(random_bytes(4));
            $hashed_password = password_hash($motDePasse, PASSWORD_DEFAULT);

            // Préparation de la requête
            $sql = "INSERT INTO Utilisateur (Nom, Prenom, Email, MotDePasse, DateNaissance, EstAncienEtudiant) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $bdd->prepare($sql);

            // Exécution de la requête
            $stmt->execute([$nom, $prenom, $email, $hashed_password, $DateNaissance, $estAncienEtudiant]);
        }

        fclose($fichierCSV);
        echo "Insertion réussie des données depuis le fichier CSV.";
    }

} catch (PDOException $e) {
    die("Erreur lors de l'insertion des données : " . $e->getMessage());
}

?>
