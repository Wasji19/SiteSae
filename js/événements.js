

function ajouterEvenement() {
    var nomEvenement = document.getElementById('nomEvenement').value;
    var descriptionEvenement = document.getElementById('descriptionEvenement').value;
    var imageEvenement = document.getElementById('imageEvenement').value;

    // Validation des champs
    if (!nomEvenement || !descriptionEvenement || !imageEvenement) {
        alert("Veuillez remplir tous les champs.");
        return;
    }

    // Créer un nouvel événement
    var nouvelEvenement = {
        nom: nomEvenement,
        description: descriptionEvenement,
        image: imageEvenement
    };

    // Envoyer l'événement à la page principale
    window.opener.ajouterEvenement(nouvelEvenement);

    // Fermer la fenêtre actuelle
    window.close();
}




function validerChamps() {
    var nomEvenement = document.getElementById('nomEvenement').value;
    var descriptionEvenement = document.getElementById('descriptionEvenement').value;
    var imageEvenement = document.getElementById('imageEvenement').value;

    return nomEvenement && descriptionEvenement && imageEvenement;
}

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

    window.opener.ajouterEvenement(nouvelEvenement);
    window.close();
}
