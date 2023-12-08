<?php
session_start();

// Vérifier si la variable de session pour l'identification de l'utilisateur existe
if (!isset($_SESSION['user_id'])) {
    // Rediriger l'utilisateur vers la page de connexion s'il n'est pas connecté
    header("Location: ../SiteSae/pages/page_connexion.html");
    exit; // Arrêter l'exécution du reste du code
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="../SiteSae/css/style.css">
   
    <title>Site</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <!-- Remplacez le texte par votre logo -->
            <a class="navbar-brand" href="../SiteSae/index.html">
                <img src="../SiteSae/assets/imgs/logoCID.png" alt="Logo" height="50">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="../SiteSae/index.html">Accueil <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../SiteSae/pages/apropos.html">À Propos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../SiteSae/pages/services.html">Services</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Connexion
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="../SiteSae/pages/page connexion.html">Se connecter</a>
                            <a class="dropdown-item" href="../SiteSae/pages/Inscription.html">S'inscrire</a>
                        </div>
                    </li>
                </ul>
                <form class="form-inline ml-auto">
                    <input class="form-control mr-sm-2" type="search" placeholder="Recherche" aria-label="Recherche">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
                </form>
            </div>
        </div>
    </nav>
    


<main>

    <section class="accueil bg-dark d-flex w-100 h-150vh flex-column justify-content-center align-items-center">
        <!-- Contenu de la section -->
        <h1 class="display-1 text-white text-center"><img src="../SiteSae/assets/imgs/logoCID.png" alt="Logo" height="140"></h1>
    </section>

    <!-- Section Présentation du CID -->
    <section class="container py-5 bg-light mt-4">
        <h1 class="text-center">Présentation du CID</h1>
        <div class="row">
            <!-- Mot du Président -->
            <div class="col-md-4">
                <h2>Mot du Président</h2>
                <p>Texte de remerciement du président du CID</p>
            </div>

            <!-- Liste des membres du bureau -->
            <div class="col-md-4">
                <h2>Membres du Bureau</h2>
                <ul>
                    <li>Président:</li>
                    <li>Trésorier:</li>
                    <li>Admin du site:</li>
                </ul>
            </div>

            <!-- Mission du CID -->
            <div class="col-md-4">
                <h2>Mission du CID</h2>
                <p>Bref aperçu de la mission du CID</p>
                <a href="URL_PAGE_PLUS_DETAILS" class="btn btn-primary">En savoir plus</a>
            </div>
        </div>
    </section>
    

    <div class="container py-5 bg-light mt-4">
        <div class="row">    
                <!-- Section Événements -->
                
                <section class="container py-5 bg-light mt-4">
                    <h1 class="text-center mb-4">Événements</h1>
                    <div class="row" id="eventsPreview">
                        <!-- Ici sera chargé dynamiquement l'aperçu des événements les plus récents -->
                    </div>
                    <div class="text-center mt-3">
                        <a href="URL_PAGE_EVENEMENTS" class="btn btn-primary">Voir tous les événements</a>
                    </div>
                </section>

        </div>
        
    </div>
    <div class="container py-5 bg-light mt-4">
    <section class="connexion-section">
        <div class="container">
                <!-- Partie "Connectez-vous" -->
                <div class="col-md-6">
                    <h2>Vous etes connecté</h2>
                    <p>Profitez de vos acces et ...</p>
                    <a href="page_connexion.html" class="btn btn-primary">Connexion</a>
                </div>
            </div>
        </div>
    </section>
        
    </div>
    <footer class=" pt-4 pb-0" style="background-color: #E4E4E4;" > 
        <div class ="container text-center text-md-left"> 
            <div class = " row text-center text-md-left"> 
                <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-"> 
                    <h5 class="text-uppercase mb-4 font-weight-bold ">Notre site</h5>
                        <p>
                            <a href="#" class="" style="text-decoration : none;"> Le blog </a>
                        </p>
                        <p>
                            <a href="#" class="" style="text-decoration : none;"> Les événements </a>
                        </p>
                        <p>
                            <a href="#" class="" style="text-decoration : none;"> Actualités </a>
                        </p>
                        <p>
                            <a href="../SiteSae/pages/Annuaire.html" class="" style="text-decoration : none;"> Annuaires </a>
                        </p>
                        <p>
                            <a href="../SiteSae/pages/Galerie.html" class="" style="text-decoration : none;"> Galerie </a>
                        </p>
                        <p>
                            <a href="#" class="" style="text-decoration : none;"> Médias Sociaux </a>
                        </p>
                </div>
<div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                    <h5 class="text-uppercase mb-4  font-weight-bold">A propos</h5>
                        <p><a href="#" class="" style="text-decoration : none;"> Nous joindre </a></p>
                        <p><a href="#" class="" style="text-decoration : none;"> Inscription </a></p>
                        <p><a href="#" class="" style="text-decoration : none;"> L'association </a></p> 
                        <p><a href="#" class="" style="text-decoration : none;"> Se connecter </a></p>
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

    

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const eventsPreview = document.getElementById("eventsPreview");
    
            // Exemple de données factices pour les événements avec des images
            const recentEvents = [
                {
                    title: "Événement 1",
                    description: "Description de l'événement 1",
                    image: "../SiteSae/assets/imgs/logoCID.png"
                },
                {
                    title: "Événement 2",
                    description: "Description de l'événement 2",
                    image: "../assets/imgs/logoIUT.jpg"
                },
                
                // Ajoutez d'autres événements avec des images ici...
            ];
    
            // Création des éléments HTML pour les événements récents avec images
            recentEvents.forEach(event => {
                const eventElement = document.createElement("div");
                eventElement.classList.add("col-md-4");
                eventElement.innerHTML = `
                    <div class="card mb-4 shadow-sm">
                        <img src="${event.image}" class="card-img-top" alt="${event.title}">
                        <div class="card-body">
                            <h3>${event.title}</h3>
                            <p class="card-text">${event.description}</p>
                            <a href="URL_DETAIL_EVENEMENT_${event.id}" class="btn btn-sm btn-outline-secondary">En savoir plus</a>
                        </div>
                    </div>
                `;
                eventsPreview.appendChild(eventElement);
            });
        });
    </script>
    
</body>
</html>
