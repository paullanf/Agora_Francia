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
	<link rel="stylesheet" type="text/css" href="CSS/enchere.css">
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
		.bouton_choix {
            text-align: center;
        }

        .bouton_choix button {
            background-color: #007BFF; /* Couleur bleue */
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 18px;
            font-weight: bold;
            margin: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .bouton_choix button:hover {
            background-color: #0056b3; /* Couleur assombrie au survol */
        }

        .bouton_choix button:active {
            background-color: #003f7f; /* Couleur plus foncée lors du clic */
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
		<div id="top_id"> <!-- zone de connexion -->
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
		<div id="recherche" style="position: relative; top: 25px;">
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
			<div class="bouton_choix">
				<br>
				<button onclick="location.href='tout_parcourir.php'">Aller aux ventes d'occasion et neuf</button>
				<button onclick="location.href='enchere.php'">Aller a la vente au enchere</button>
			</div>
			<br>
			<br>
			<h1>Agora Francia, le site n°1 pour l'achat de véhicules neufs et d'occasion</h1>
			<p>Agora Francia est la nouvelle référence pour participer à des ventes de véhicules en ligne, qu'ils soient neufs, d'occasion ou de collection, en France et à l’international. Avec Agora Francia, vivez une expérience d’achat simplifiée, transparente et sécurisée, grâce à des véhicules soigneusement sélectionnés et experts.</p>
			<br>
			<br>
			<h2>Notre mission</h2>
			<p>Depuis sa création en 2024, Agora Francia a pour objectif de rendre l'achat de véhicules accessible à tous. Chaque jour, nous mettons en ligne une sélection de voitures, allant des modèles neufs aux voitures d'occasion, avec des prix adaptés à tous les budgets, de quelques centaines à plusieurs milliers d'euros.</p>
			<p>Agora Francia collabore avec un réseau de partenaires professionnels, incluant des concessionnaires et des experts automobiles. Ces professionnels sont rigoureusement sélectionnés pour garantir la qualité, l'authenticité et la sécurité des véhicules proposés. Chaque voiture mise en vente est minutieusement inspectée, avec des informations détaillées et des photos de haute qualité.</p>
			<br>
			<br>
			<h2>Nos services</h2>
			<p>Agora Francia propose une plateforme de vente de véhicules en ligne simple et rapide, permettant à tous d’acheter en quelques clics, où que vous soyez. Notre modèle de vente « sans enchères » vous permet d’acheter directement un véhicule au prix affiché, sans le stress des enchères et sans compétition.</p>
			<br>
			<br>
			<h2>Notre histoire</h2>
			<p>Agora Francia est né de la vision de professionnels passionnés de l’automobile, qui ont vu l’opportunité de transformer la manière dont les véhicules sont achetés et vendus en ligne. En 2024, nous avons lancé cette plateforme innovante, offrant un site collaboratif et sécurisé pour l'achat de véhicules neufs et d'occasion. Grâce à notre interface intuitive et à notre sélection rigoureuse de véhicules, Agora Francia s'impose rapidement comme un acteur clé de la vente automobile en ligne.</p>
			<br>
			<br>
			<h2>Nos engagements</h2>
			<p>Conscients des enjeux environnementaux, Agora Francia s'engage à favoriser l'économie circulaire en permettant à chacun d’acquérir un véhicule de qualité, qu’il soit neuf ou d'occasion, tout en respectant les normes les plus strictes de sécurité et d'environnement. Nos véhicules sont soigneusement vérifiés et nous vous offrons des garanties pour une tranquillité d'esprit totale.</p>
			<br>
			<br>
			<h2>Une équipe passionnée</h2>
			<p>Chez Agora Francia, une équipe dynamique d'experts de l'automobile travaille chaque jour pour offrir la meilleure expérience d'achat en ligne. Toujours disponibles pour vous accompagner, notre équipe est à votre service 7 jours sur 7 pour vous aider à trouver le véhicule qui vous correspond, qu'il soit neuf ou d'occasion.</p>
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