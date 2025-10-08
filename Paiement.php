<?php
	session_start();
	if (isset($_POST['selection']) && !empty($_POST['selection'])) {
	    $annonces_selectionnees = $_POST['selection'];
	} else {
	    die("Aucune annonce sélectionnée. Retournez au panier pour sélectionner une annonce.");
	}
	$server_name = "localhost";
	$user_name = "root";
	$mot_de_passe = "";
	$dbname = "Agora_francia";
	$conn = new mysqli($server_name, $user_name, $mot_de_passe, $dbname);
	if ($conn->connect_error) {
	    die('Erreur de connexion à la base de données : ' . $conn->connect_error);
	}
	$ids = implode(',', array_map('intval', $annonces_selectionnees));
	$sql = "SELECT * FROM panier WHERE id_produit IN ($ids) AND id_acheteur = '" . $_SESSION['ID'] . "' AND status = 'en attente'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	    $annonces = $result->fetch_all(MYSQLI_ASSOC);
	} else {
	    die('Aucune annonce trouvée.');
	}
	$conn->close();
?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Agora Francia</title>
	<link rel="stylesheet" type="text/css" href="CSS/style_page.css">
	<link rel="stylesheet" type="text/css" href="CSS/search_bar.css">
	<link rel="stylesheet" type="text/css" href="CSS/Annonces.css">
	<link rel="stylesheet" type="text/css" href="CSS/Carousel_annonce.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript" src="JS/Carousel_annonce.js"></script>
	<style type="text/css">
		#section{ 
			width: auto;
			height: 1700px;
			padding-top: 5px;
		}
	</style>
</head>
<body>
	<div id = "top"style="position: relative; top: -50px;">
		<div id = top_id>
			<h4 id="login">
					<?php if (isset($_SESSION['ID'])): ?>
					    Bienvenue, <?php echo "<a href='moncompte.php'>" . $_SESSION['prenom'] . ' ' . $_SESSION['nom'] . " (" . $_SESSION['role'] . ")</a>"; ?> | 
					    <a href="deconnexion.php">Se déconnecter</a>
					<?php else: ?>
					    <a href="connexionpage.php">Connectez-vous / Inscrivez-vous</a>
					<?php endif; ?>
				</h4>
		</div>
		<div id = "logo">
			<img class="img_top" src="Images/logo.jpg" alt="Logo.jpg" width="50%">
		</div>
		<div id="recherche" style="position: relative; top: 30px;">
			<form method="GET" action="">
				<input type="text" name="query" placeholder="Rechercher..." value="<?php echo isset($_GET['query']) ? htmlspecialchars($_GET['query']) : ''; ?>" width="12%" height="80%">
				<button type="submit">Rechercher</button>
			</form>
					</div>
					<div id= "menu"style="position: relative; top: 40px;"> <!-- zone des boutons de navigation -->
						<a href="homepage.php"><img class="nav_bouton" src="Images/Boutons/accueil.jpg" alt="Accueil" ></a>
						<a href="tout_parcourir_choix.php"><img class="nav_current_bouton" src="Images/Boutons/toutParcourir.jpg" alt="Tout parcourir"></a>
						<a href="notification.php"><img class="nav_bouton" src="Images/Boutons/notification.jpg" alt="Notifications"></a>
						<a href="panier.php"><img class="nav_bouton" src="Images/Boutons/panier.jpg" alt="Panier"></a>
						<a href="moncompte.php"><img class="nav_bouton" src="Images/Boutons/votreCompte.jpg" alt="Mon compte"></a>
					</div>
				</div>
				<div id="section">
					<div class="container">
						<h2 style='text-align: center;'>Récapitulatif des Annonces Sélectionnées</h2>
						<form method='POST' action='traitementPaiement.php'>
						    <?php foreach ($annonces_selectionnees as $id): ?>
						        <input type='hidden' name='selection[]' value='<?php echo htmlspecialchars($id); ?>'>
						    <?php endforeach; ?>
						    <table border='1' align='center'>
						        <tr>
						            <th>Numéro de l'annonce</th>
						            <th>Prix</th>
						            <th>Date de commande</th>
						            <th>Type d'achat</th>
						            <th>Lien vers l'annonce</th>
						        </tr>
						        <?php foreach ($annonces as $data): ?>
						            <tr>
						                <td><?php echo htmlspecialchars($data['id_produit']); ?></td>
						                <td><?php echo htmlspecialchars($data['prix_achat']); ?>€</td>
						                <td><?php echo htmlspecialchars($data['date_achat']); ?></td>
						                <td><?php echo htmlspecialchars($data['mode_achat']); ?></td>
						                <td><?php echo htmlspecialchars($data['annonce']); ?></td>
						            </tr>
						        <?php endforeach; ?>
						    </table>
						    <div style='text-align: center; margin-top: 20px;'>
						        <h3>Choisissez votre moyen de paiement :</h3>
						        <select name='moyen_paiement' id='moyenPaiement' required>
						            <option value=''>-- Sélectionnez un moyen de paiement --</option>
						            <option value='MasterCard'>MasterCard</option>
						            <option value='Visa'>Visa</option>
						            <option value='Amex'>American Express</option>
						            <option value='PayPal'>PayPal</option>
						        </select>
						    </div>
						    <div id='carteCreditFields' style='display: none; margin-top: 20px;'>
						        <table border='1' align='center'>
						            <tr>
						                <td>Numéro de carte de crédit :</td>
						                <td><input type='text' name='numero_carte' maxlength='16' pattern='[0-9]{16}' placeholder='1234567891011121'></td>
						            </tr>
						            <tr>
						                <td>Mois d'expiration :</td>
						                <td><input type='number' name='mois_exp' min='1' max='12' placeholder='MM'></td>
						            </tr>
						            <tr>
						                <td>Année d'expiration :</td>
						                <td><input type='number' name='annee_exp' min='<?php echo date("Y"); ?>' placeholder='YYYY'></td>
						            </tr>
						            <tr>
						                <td>CVC :</td>
						                <td><input type='password' name='cvc' maxlength='3' pattern='[0-9]{3}' placeholder='123'></td>
						            </tr>
						        </table>
						    </div>
						    <div style='text-align: center; margin-top: 20px;'>
						        <input type='submit' value='Confirmer le paiement'>
						    </div>
						</form>
	<script>
	document.getElementById('moyenPaiement').addEventListener('change', function () {
	    var selectedPayment = this.value;
	    var creditCardFields = document.getElementById('carteCreditFields');

	    if (selectedPayment === 'MasterCard' || selectedPayment === 'Visa' || selectedPayment === 'Amex') {
	        creditCardFields.style.display = 'block';
	    } else {
	        creditCardFields.style.display = 'none';
	    }
	});
	</script>

		</div>
	</div>
		
	<div id="footer">
		<footer>
			<p> Agora Francia: <br>
				Achat revente de vehicules neuf et d'occasion, comptant et aux enchères<br>
				Copyright &copy; 2024
			<a href = "mailto:contact@agorafrancia.fr">Contactez nous par mail! </a>
			</p>
		</footer>
	</div>
</body>
</html>