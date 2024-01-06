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
