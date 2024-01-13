<?php
// Connexion à la base de données (à adapter en fonction de votre configuration)
$host = "votre_hôte";
$utilisateur = "votre_utilisateur";
$mdp = "votre_mot_de_passe";
$base_de_donnees = "site_sae";

$connexion = new mysqli($host, $utilisateur, $mdp, $base_de_donnees);

// Vérifie la connexion
if ($connexion->connect_error) {
    die("La connexion à la base de données a échoué : " . $connexion->connect_error);
}

// Requête pour récupérer les URL des images
$resultat = $connexion->query("SELECT url FROM labase");

// Ferme la connexion à la base de données
$connexion->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-GLhlTQ8i6NDJLlMkg1eLcd5PJl3gfs9bT9SNA9p9N7U8T7Iep78IyJgFAW/dAiS6" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@1,300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/Galerie.css">
    <title>Galerie</title>
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-light " style="background-color: #d9d9d9;">
                <div class="container" >
                    <!-- Remplacez le texte par votre logo -->
                    <a class="navbar-brand" href="../SiteSae/index.html">
                        <img src="../assets/imgs/logoCID.png" alt="Logo" height="50">
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item active">
                                <a class="nav-link" href="../index.html">Accueil <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../pages/événements.html">événements</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Connexion
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="../pages/page connexion.html">Se connecter</a>
                                    <a class="dropdown-item" href="../pages/Inscription.html">S'inscrire</a>
                                </div>
                            </li>
                        </ul>
                        <form class="form-inline ml-auto">
                            <input class="form-control mr-sm-2" type="search" placeholder="Recherche" aria-label="search">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
                        </form>
                    </div>
                </div>
            </nav>

        <div class="cards" id="gallery">
            <?php
            // Affiche les images
            while ($row = $resultat->fetch_assoc()) {
                echo '<div class="card">';
                echo '<img src="' . $row['url'] . '" alt="">';
                echo '<div class="card-content">';
                echo '<h6>Nom de l\'article</h6>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>

        <footer class=" pt-4 pb-0" style="background-color: #d9d9d9;" > 
                <div class ="container text-center text-md-left"> 
                    <div class = " row text-center text-md-left"> 
                        <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-"> 
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
                                    <a href="../pages/Annuaire.html" class="" style="text-decoration : none;"> Annuaires </a>
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
            
             </footer>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>      
        <script src="./Galerie_files/app.js.téléchargement"></script>

</body>
</html>
