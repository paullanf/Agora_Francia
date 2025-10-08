<?php
session_start();

if (isset($_POST['selection']) && !empty($_POST['selection']) && isset($_POST['moyen_paiement'])) {
    $annonces_selectionnees = $_POST['selection'];
    $moyen_paiement = $_POST['moyen_paiement'];
    $numero_carte = $_POST['numero_carte'] ?? null;
    $mois_exp = $_POST['mois_exp'] ?? null;
    $annee_exp = $_POST['annee_exp'] ?? null;
    $cvc = $_POST['cvc'] ?? null;
    $server_name = "localhost";
    $user_name = "root";
    $mot_de_passe = "";
    $dbname = "agora_francia";
    $conn = new mysqli($server_name, $user_name, $mot_de_passe, $dbname);
    if ($conn->connect_error) {
        die('Erreur de connexion à la base de données : ' . $conn->connect_error);
    }
    if ($moyen_paiement === 'MasterCard' || $moyen_paiement === 'Visa' || $moyen_paiement === 'Amex') {
        $stmt = $conn->prepare("SELECT solde FROM banque WHERE type_carte = ? AND numero_carte = ? AND mois_exp = ? AND annee_exp = ? AND cvc = ?");
        $stmt->bind_param("ssiii", $moyen_paiement, $numero_carte, $mois_exp, $annee_exp, $cvc);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows === 0) {
            die('Les informations de la carte sont incorrectes.');
        }
        $carte = $result->fetch_assoc();
        $solde = $carte['solde'];
        $montant_total = 0;
        foreach ($annonces_selectionnees as $id) {
            $montant_total += 1000;
        }
        if ($solde < $montant_total) {
            die('Solde insuffisant pour effectuer le paiement.');
        }
        $nouveau_solde = $solde - $montant_total;
        $stmt = $conn->prepare("UPDATE banque SET solde = ? WHERE numero_carte = ?");
        $stmt->bind_param("is", $nouveau_solde, $numero_carte);
        $stmt->execute();
    }
    $stmt = $conn->prepare("UPDATE panier SET status = 'payé', moyen_paiement = ? WHERE id_produit = ? AND id_acheteur = ?");
    foreach ($annonces_selectionnees as $id) {
        $stmt->bind_param("sii", $moyen_paiement, $id, $_SESSION['ID']);
        $stmt->execute();
    }
    echo "Paiement confirmé avec le moyen de paiement : " . htmlspecialchars($moyen_paiement);
    $stmt->close();
    $conn->close();
} else {
    echo "Aucune annonce sélectionnée ou moyen de paiement non spécifié.";
}
?>
