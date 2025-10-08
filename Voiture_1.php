<?php
	session_start();
	// Connexion à la base de données pour la recherche
    $server_name = "localhost";
    $user_name = "root";
    $mot_de_passe = "";
    $dbname = "Agora_francia";
    $verifier = new mysqli($server_name, $user_name, $mot_de_passe, $dbname);
    // Vérifiez la connexion
    if ($verifier->connect_error) {
        die("La connexion a échoué : " . $verifier->connect_error);
    }
    // Initialiser la variable de recherche
    $resultats_recherche = [];
    if (isset($_GET['query'])) {
        $query = $verifier->real_escape_string($_GET['query']); // Échapper les caractères spéciaux pour éviter les injections SQL

        // Requête SQL pour rechercher dans la base de données
        $sql = "SELECT * FROM voiture WHERE modele LIKE '%$query%' OR marque LIKE '%$query%'";
        $resultat = $verifier->query($sql);

        if ($resultat->num_rows > 0) {
            // Stocker les résultats dans un tableau
            while ($row = $resultat->fetch_assoc()) {
                $resultats_recherche[] = $row;
            }
        } else {
            $resultats_recherche = "Aucun résultat trouvé pour \"$query\"";
        }
    }
    // Connexion à la base de données
	$conn = new mysqli($server_name, $user_name, $mot_de_passe, $dbname);

	// Vérification de la connexion
	if ($conn->connect_error) {
    	die('Erreur de connexion à la base de données : ' . $conn->connect_error);
	}

	// Récupération des données de la voiture (exemple avec une seule voiture)
	$sql = "SELECT * FROM voiture WHERE id = 1"; // Changez l'ID selon votre base
	$result = $conn->query($sql);

	// Vérifiez si une voiture est trouvée
	if ($result->num_rows > 0) {
		$voiture = $result->fetch_assoc();
	} else {
		die('Aucune voiture trouvée.');
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
	<script type="text/javascript" src="JS/negociation.js"></script>
	<style type="text/css">
		#section{ /* Ajustement de la logueur de la section */
			width: auto;
			height: 1700px; /* Longueur a adapter */
			padding-top: 5px;
		}
		.logo {
            margin-left: 25px;
            width: 30px;
            height: 30px;
        }
	</style>
</head>
<body>
	<!-- En tete a ne pas modifier -->
	<div id="top" style="position: relative; top: -50px; border-right: 8px solid #262524; border-left: 8px solid #262524;">
		<div id = top_id> <!-- zone de connexion -->
			<h4 id="login">
					<?php if (isset($_SESSION['ID'])): ?>
					    Bienvenue, <?php echo "<a href='moncompte.php'>" . $_SESSION['prenom'] . ' ' . $_SESSION['nom'] . " (" . $_SESSION['role'] . ")</a>"; ?> | 
					    <a href="deconnexion.php">Se déconnecter</a>
					<?php else: ?>
					    <a href="connexionpage.php">Connectez-vous / Inscrivez-vous</a>
					<?php endif; ?>
				</h4>
		</div>
		<div id = "logo"> <!-- logo -->
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

	<!-- Affichage des résultats --> 
	<div id="resultat">
		<?php
    // Connexion à la base de données pour la recherche
		$server_name = "localhost";
		$user_name = "root";
		$mot_de_passe = "";
		$dbname = "Agora_francia";
		$verifier = new mysqli($server_name, $user_name, $mot_de_passe, $dbname);
    // Vérifiez la connexion
		if ($verifier->connect_error) {
			die("La connexion a échoué : " . $verifier->connect_error);
		}
    // Initialiser la variable de recherche
		$resultats_recherche = [];
		if (isset($_GET['query'])) {
        $query = $verifier->real_escape_string($_GET['query']); // Échapper les caractères spéciaux pour éviter les injections SQL

        // Requête SQL pour rechercher dans la base de données
        $sql = "SELECT * FROM voiture WHERE modele LIKE '%$query%' OR marque LIKE '%$query%'";
        $resultat = $verifier->query($sql);

        if ($resultat->num_rows > 0) {
            // Stocker les résultats dans un tableau
        	while ($row = $resultat->fetch_assoc()) {
        		$resultats_recherche[] = $row;
        	}
        } else {
        	$resultats_recherche = "Aucun résultat trouvé pour \"$query\"";
        }
    }
?><!-- Affichage des résultats --> 
<div id="resultat">
	<?php
	if (!empty($resultats_recherche) && is_array($resultats_recherche)) {
		foreach ($resultats_recherche as $resultat) {
            // Récupérer le nom du fichier associé à cette voiture
            $modele_voiture = htmlspecialchars($resultat['modele']); // Modèle de la voiture
            echo "<div class='result_item'>";
            // Lien vers le fichier spécifique de la voiture
            echo "<h3><a href='voiture_" . htmlspecialchars($resultat['ID']) . ".php'>$modele_voiture<img class='logo' src='Images/loupe.png' alt='Loupe'></a></h3>"; // Lien vers la page de détail de la voiture
            echo "<p>" . htmlspecialchars($resultat['marque']) . "</p>";
            echo "</div>";
        }
    } elseif (is_string($resultats_recherche)) {
    	echo "<p>$resultats_recherche</p>";
    }
    ?>
</div>

	<div id="section">
		<div class="container">
			<div id="carrousel" align="center">
				<div class = "photo">
					<ul>
						<li><img src="Images/Voitures/clio/clio.jpg" alt = "Renault Clio " width="700" height="400"/></li>
						<li><img src="Images/Voitures/clio/clio_2.png" alt = "Renault Clio "  width="700" height="400"/></li>
						<li><img src="Images/Voitures/clio/clio_3.png" alt = "Renault Clio "  width="700" height="400"/></li>
						<li><img src="Images/Voitures/clio/clio_4.png" alt = "Renault Clio "  width="700" height="400"/></li>
					</ul>
				</div>
			</div>
			<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
			<?php
			if (isset($_SESSION['ID'])) {
				echo '<div class="details">
				<h1><?php echo htmlspecialchars($voiture["modele"]); ?></h1>
				<p class="price">' . number_format($voiture["Prix"], 0, ",", " ") .'€</p>
				<a href="tel:+33615087505" class="button phone">📞 N° téléphone</a>
				<a href="mailto: vendeurclio@agorafrancia.fr" class="button message">💬 Message</a>
				<a href = "#" class="button nego" onclick="negociation_client()">Négociations 🧑‍💼</a>
				<a href = "#" class="button phone" onclick="achat_direct()">Achat Direct 💰💸</a>
				<form id="formulaire_proposition" action = "panier.php" method="POST" style="display:none;">
					<input type="hidden" name="proposition" id="prix_propose">
					<input type="hidden" name="modele" value="Clio 4">
					<input type="hidden" name="id" value = "1">
					<input type="hidden" name="modeAchat" value = "Par négociations">
				</form>
				</div>';
			} else {
				echo "<div class='price'>Veuillez vous connecter pour voir les informations de la voiture</div>";
			}
			?>
			<div class="points-forts">
				<h2 class="section-title">Points forts</h2>
				<ul>
					<?php
					$pointsForts = explode(',', $voiture['Points_forts']);
					foreach ($pointsForts as $point) {
						echo '<li>' . htmlspecialchars($point) . '</li>';
					}
					?>
				</ul>
			</div>
			<div class="caracteristiques">
				<h2 class="section-title">Caractéristiques</h2>
				<ul>
					<li><strong>Année :</strong> <?php echo htmlspecialchars($voiture['année']); ?></li>
					<li><strong>Kilométrage :</strong> <?php echo number_format($voiture['Kilometre'], 0, ',', ' '); ?> km</li>
					<li><strong>Boîte de vitesse :</strong> <?php echo htmlspecialchars($voiture['Boite_de_vitesse']); ?></li>
					<li><strong>Énergie :</strong> <?php echo htmlspecialchars($voiture['moteur']); ?></li>
					<li><strong>Puissance fiscale :</strong> <?php echo htmlspecialchars($voiture['puissance_fiscale']); ?></li>
					<li><strong>Puissance DIN :</strong> <?php echo htmlspecialchars($voiture['puissance_moteur']); ?></li>
					<li><strong>Consommation :</strong> <?php echo htmlspecialchars($voiture['consommation']); ?></li>
				</ul>
			</div>
			<div class="equipements">
				<h2 class="section-title">Équipements & options</h2>
				<ul>
					<?php
					$equipements = explode(',', $voiture['equipements']);
					foreach ($equipements as $equipement) {
						echo '<li>' . htmlspecialchars($equipement) . '</li>';
					}
					?>
				</ul>
			</div>
		</div>		
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