<?php
// Assurez-vous que la session est démarrée
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Connectez-vous à la base de données (vous pouvez utiliser votre propre code ici)
$hote = "localhost";
$bd = "site_sae";
$login = "root";
$mdp = "";

try {
    $bdd = new PDO("mysql:host=$hote;dbname=$bd", $login, $mdp);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Sélectionnez les informations de l'utilisateur à partir de la base de données
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM Utilisateur WHERE IDUtilisateur = :user_id";
    $stmt = $bdd->prepare($sql);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();

    // Récupérez les données de l'utilisateur
    $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Incluez votre structure HTML et affichez les informations de l'utilisateur
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annuaire des Utilisateurs</title>
    <link rel="stylesheet" href="../css/profil.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="../assets/imgs/logoCID.png" alt="Logo" height="80">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="../pages/index_connect.php">Accueil <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../pages/événements.html">Événement</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../index.html">Déconnexion</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
   

    <?php if ($utilisateur): ?>
        <div class="card">
        <h1>Profil de l'utilisateur</h1>
            <p><strong>Nom:</strong> <?php echo $utilisateur['Nom']; ?></p>
            <p><strong>Prénom:</strong> <?php echo $utilisateur['Prenom']; ?></p>
            <p><strong>Email:</strong> <?php echo $utilisateur['Email']; ?></p>
            <a href="../index.html">Déconnexion</a>
        </div>
    <?php else: ?>
        <p>Aucune information d'utilisateur trouvée.</p>
    <?php endif; ?>
    

    <footer class=" pt-4 pb-0" style="background-color: #d9d9d9;"> 
        <div class ="container text-center text-md-left"> 
            <div class = " row text-center text-md-left"> 
                <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3"> 
                    <h5 class="text-uppercase mb-4 font-weight-bold ">Notre site</h5>
                        <p>
                            <a href="#" class="" style="text-decoration : none;"> Le blog </a>
                        </p>
                        <p>
                            <a href="../pages/événements.html" class="" style="text-decoration : none;"> Les événements </a>
                        </p>
                        <p>
                            <a href="../pages/Calendrier.html" class="" style="text-decoration : none;"> Calendrier </a>
                        </p>
                        <p>
                            <a href="../pages/Annuaire.php" class="" style="text-decoration : none;"> Annuaires </a>
                        </p>
                        <p>
                            <a href="../pages/Galerie.html" class="" style="text-decoration : none;"> Galerie </a>
                        </p>
                    
                </div>
                <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4  font-weight-bold">A propos</h5>
                        <p><a href="../pages/Contacter.html" class="" style="text-decoration : none;"> Nous joindre </a></p>
                        <p><a href="../pages/Inscription.html" class="" style="text-decoration : none;"> Inscription </a></p>
                        <p><a href="#" class="" style="text-decoration : none;"> L'association </a></p> 
                        <p><a href="../pages/page connexion.html" class="" style="text-decoration : none;"> Se connecter </a></p>
                        <p><a href="#" class="" style="text-decoration : none;"> Médias Sociaux </a></p>
                </div>

                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-4">
                    <h5 class="text-uppercase mb-4 font-weight-bold ">Contact</h5>
                        <p>
                            <i class="fas fa-home mr-3 "></i>Avenue des Facultés, Le Bailly, 80025 Amiens
                        </p>
                        <p>
                            <i class="fas fa-phone mr-3 "></i>Tél. +33(0)3.22.53.40.40
                        </p>
                        <p>
                            <i class="fas fa-printer mr-3 "></i>Fax. +33(0)3.22.89.66.33
                        </p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
