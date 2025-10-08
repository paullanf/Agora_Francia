function negociation_client() {
    var prix = prompt("Quel prix voulez-vous proposer au vendeur ?");
    if (prix == null || prix == "") {
        alert("Attention, prix non renseigné, veuillez recommencer.");
    } else {
        alert("Demande enregistrée, merci de bien valider votre panier pour finaliser votre demande.");
    }
    var prixElement = document.getElementsByName('proposition')[0]; 
    var modeleVoiture = document.getElementsByName('modele')[0];
    var idAnnonce = document.getElementsByName('id')[0];
    if (prixElement) {
        prixElement.value = prix;
    } else {
        console.error("L'élément avec le name 'proposition' n'existe pas.");
    }
    var formulaire = document.getElementById('formulaire_proposition');
    if (formulaire) {
        formulaire.submit();
    } else {
        console.error("Le formulaire avec l'ID 'formulaire_proposition' n'existe pas.");
    }
}

function achat_direct() {
    console.log("Bouton 'Achat Direct' cliqué");
    if (!confirm("Voulez-vous vraiment procéder à l'achat direct de cette voiture ?")) {
        alert("Achat direct annulé.");
        return;
    }
    console.log("Confirmation acceptée");
    var formulaire = document.getElementById('formulaire_proposition');
    if (formulaire) {
        var modeAchatElement = document.getElementsByName('modeAchat')[0];
        var prix = "10";
        if (modeAchatElement) {
            modeAchatElement.value = "Achat Direct";
            console.log("Mode d'achat défini sur 'Achat Direct'");
        } else {
            console.error("L'élément 'modeAchat' est introuvable.");
            return;
        }
        formulaire.submit();
        console.log("Formulaire soumis");
    } else {
        console.error("Le formulaire avec l'ID 'formulaire_proposition' n'existe pas.");
    }
}

