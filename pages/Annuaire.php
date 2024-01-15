<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "site_sae";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

// Récupérer la valeur de recherche
$recherche = isset($_POST['recherche']) ? $_POST['recherche'] : '';

// Récupérer le critère de tri et l'ordre
$tri = isset($_GET['tri']) ? $_GET['tri'] : 'Nom';
$ordre = isset($_GET['ordre']) ? $_GET['ordre'] : 'ASC';

// Tri
$sql = "SELECT * FROM Utilisateur WHERE Nom LIKE '%$recherche%' OR Prenom LIKE '%$recherche%' ORDER BY $tri $ordre";

// Exécuter la requête SQL
$result = $conn->query($sql);
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
    <link rel="stylesheet" href="../css/Annuaire.css">
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

<h1>Annuaire des Utilisateurs</h1>

<form method="POST" action="annuaire.php">
    <label for="recherche">Recherche :</label>
    <input type="text" name="recherche" id="recherche" value="<?php echo $recherche; ?>">
    <input type="submit" value="Rechercher">
</form>

<form method="GET" action="annuaire.php">
    <label for="tri">Trier par :</label>
    <select name="tri" id="tri">
        <option value="Nom" <?php echo ($tri == 'Nom') ? 'selected' : ''; ?>>Nom</option>
        <option value="Prenom" <?php echo ($tri == 'Prenom') ? 'selected' : ''; ?>>Prénom</option>
        <option value="DateNaissance" <?php echo ($tri == 'DateNaissance') ? 'selected' : ''; ?>>Date de Naissance</option>
        <option value="IDPromotion" <?php echo ($tri == 'IDPromotion') ? 'selected' : ''; ?>>Promotion</option>
    </select>

    <label for="ordre">Ordre :</label>
    <select name="ordre" id="ordre">
        <option value="ASC" <?php echo ($ordre == 'ASC') ? 'selected' : ''; ?>>Croissant</option>
        <option value="DESC" <?php echo ($ordre == 'DESC') ? 'selected' : ''; ?>>Décroissant</option>
    </select>

    <input type="submit" value="Appliquer le tri">
</form>

<!-- Afficher les résultats sous forme de cartes -->
<div class="card-container">

    <?php
    // Afficher les résultats
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='card'>
                    <h3>{$row['Prenom']} {$row['Nom']}</h3>
                    <p>Date de Naissance: {$row['DateNaissance']}</p>
                    <p>Promotion: {$row['IDPromotion']}</p>
                </div>";
        }
    } else {
        echo "<p>Aucun résultat trouvé.</p>";
    }
    ?>

</div>


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

<?php
// Fermer la connexion
$conn->close();
?>


