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
	<style type="text/css">
		#section{ /* Ajustement de la logueur de la section */
			width: auto;
			height: 1700px; /* Longueur a adapter */
			padding-top: 5px;
		}
	</style>
</head>
<body>
	<!-- En tete a ne pas modifier -->
	<div id = "top"style="position: relative; top: -50px;">
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
	<div id="section">
		<div class="container">
			<div id="carrousel" align="center">
				<div class = "photo">
					<ul>
						<li><img src="Images/Voitures/clio.jpg" alt = "Renault Clio " width="700" height="400.jpg"/></li>
						<li><img src="Images/Voitures/2008.jpg" alt = "Peugeot 2008 "  width="700" height="400.jpg"/></li>
						<li><img src="Images/Voitures/500.jpg" alt = "Fiat 500 "  width="700" height="400.jpg"/></li>
						<li><img src="Images/Voitures/m2.jpg" alt = "BMW M2 "  width="700" height="400.jpg"/></li>
						<li><img src="Images/Voitures/rs6.jpg" alt = "Audi RS6 "  width="700" height="400.jpg"/></li>
						<li><img src="Images/Voitures/huracan.jpg" alt = "Lamborghini Huracan"  width="700" height="400.jpg"/></li>
						<li><img src="Images/Voitures/f8.jpg" alt = "Ferrari F8 "  width="700" height="400.jpg"/></li>
					</ul>
				</div>
			</div>
			<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
			<div class="details">
				<h1><?php echo htmlspecialchars($voiture['modele']); ?></h1>
				<p class="price"><?php echo number_format($voiture['Prix'], 0, ',', ' '); ?> €</p>
				<a href="tel:+33615087505" class="button phone">📞 N° téléphone</a>
				<a href="mailto: vendeurclio@agorafrancia.fr" class="button message">💬 Message</a>
			</div>
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
	<!-- Affichage des résultats --> 
	<div id="resultat">
		<?php
		if (!empty($resultats_recherche) && is_array($resultats_recherche)) {
			foreach ($resultats_recherche as $resultat) {
				echo "<div class='result_item'>";
				echo "<h3>" . htmlspecialchars($resultat['modele']) . "</h3>";
				echo "<p>" . htmlspecialchars($resultat['marque']) . "</p>";
				echo "</div>";
			}
		} elseif (is_string($resultats_recherche)) {
			echo "<p>$resultats_recherche</p>";
		}
		?>
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