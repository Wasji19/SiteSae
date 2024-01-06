function ajouterEvenement() {
    if (!validerChamps()) {
        alert("Veuillez remplir tous les champs.");
        return;
    }

    var nouvelEvenement = {
        nom: document.getElementById('nomEvenement').value,
        description: document.getElementById('descriptionEvenement').value,
        image: document.getElementById('imageEvenement').value
    };

    // Appeler la fonction d'ajout d'événement de la page événements.html
    window.opener.ajouterEvenementALaListeEvenements(nouvelEvenement);

    // Fermer la fenêtre actuelle
    window.close();
}

// Liste des événements existants (à remplacer par des données provenant du serveur)
var evenementsExistants = [
    { nom: 'Événement 1', description: 'Description de l\'événement 1', image: 'image1.jpg' },
    { nom: 'Événement 2', description: 'Description de l\'événement 2', image: 'image2.jpg' },
    // Ajoutez d'autres événements si nécessaire
];

// Fonction pour afficher uniquement les événements ajoutés
function afficherEvenements() {
    // Effacer la liste actuelle des événements
    document.getElementById('listeEvenements').innerHTML = '';

    // Boucle à travers les événements existants
    for (var i = 0; i < evenementsExistants.length; i++) {
        var evenement = evenementsExistants[i];

        // Créer une nouvelle carte d'événement
        var nouvelleCarte = `
            <div class="col-md-6">
                <div class="card mb-4">
                    <img src="${evenement.image}" class="card-img-top" alt="${evenement.nom}">
                    <div class="card-body">
                        <h5 class="card-title">${evenement.nom}</h5>
                        <p class="card-text">${evenement.description}</p>
                        <a href="#" class="btn btn-primary">En savoir plus</a>
                    </div>
                </div>
            </div>
        `;

        // Ajouter la nouvelle carte à la liste des événements
        document.getElementById('listeEvenements').innerHTML += nouvelleCarte;
    }
}

// Fonction pour ajouter un événement à la liste dans la page événements.html
function ajouterEvenementALaListeEvenements(nouvelEvenement) {
    evenementsExistants.push(nouvelEvenement);
    afficherEvenements();
}
