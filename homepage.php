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
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Agora Francia</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript" src = "JS/Carousel.js"></script>
	<link rel="stylesheet" type="text/css" href="CSS/carousel.css">
	<link rel="stylesheet" type="text/css" href="CSS/style_page.css">
	<link rel="stylesheet" type="text/css" href="CSS/search_bar.css">
	<style type="text/css">
		#section{ /* Ajustement de la logueur de la section */
			width: auto;
			height: 900px; /* Longueur a adapter */
			color: white;
		}
		.logo {
            margin-left: 25px;
            width: 30px;
            height: 30px;
        }
	</style>
	<script>
	function logout() {
	    fetch('deconnexion.php')
	        .then(response => response.text())
	        .then(data => {
	            if (data === 'success') {
	                // Rafraîchit la page après déconnexion réussie
	                window.location.reload();
	            }
	        })
	        .catch(error => console.error('Erreur lors de la déconnexion :', error));
	}
	</script>
</head>
<body>
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
			<a href="homepage.php"><img class="nav_current_bouton" src="Images/Boutons/accueil.jpg" alt="Accueil" ></a>
			<a href="tout_parcourir_choix.php"><img class="nav_bouton" src="Images/Boutons/toutParcourir.jpg" alt="Tout parcourir"></a>
			<a href="notification.php"><img class="nav_bouton" src="Images/Boutons/notification.jpg" alt="Notifications"></a>
			<a href="panier.php"><img class="nav_bouton" src="Images/Boutons/panier.jpg" alt="Panier"></a>
			<a href="moncompte.php"><img class="nav_bouton" src="Images/Boutons/votreCompte.jpg" alt="Mon compte"></a>
		</div>
	</div>
	<div id="section">
		<h1 id = "titre" align="center">Trouvez <FONT COLOR="#FFFF00">la voiture</FONT> qu'il vous faut !! </h1>
		<br>
		<div class="carrousel-container">
			<div id="carrousel1" class="carrousel">
				<ul>
					<li><img src="Images/Voitures/clio.jpg" alt = "Renault Clio " width="700" height="400"/></li>
					<li><img src="Images/Voitures/2008.jpg" alt = "Peugeot 2008 "  width="700" height="400"/></li>
					<li><img src="Images/Voitures/500.jpg" alt = "Fiat 500 "  width="700" height="400"/></li>
					<li><img src="Images/Voitures/m2.jpg" alt = "BMW M2 "  width="700" height="400"/></li>
					<li><img src="Images/Voitures/huracan.jpg" alt = "Lamborghini Huracan"  width="700" height="400"/></li>
					<li><img src="Images/Voitures/f8.jpg" alt = "Ferrari F8 "  width="700" height="400"/></li>
				</ul>
			</div>
			<div id="carrousel2" class="carrousel">
				<ul>
					<li><img src="Images/Voitures/rs6.jpg" alt = "rs6 " width="700" height="400"/></li>
					<li><img src="Images/Voitures/gtr/gtr.jpg" alt = "gtr "  width="700" height="400"/></li>
					<li><img src="Images/Voitures/ami/ami.jpg" alt = "Fiat 500 "  width="700" height="400"/></li>
					<li><img src="Images/Voitures/bus/bus.jpg" alt = "BMW M2 "  width="700" height="400"/></li>
					<li><img src="Images/Voitures/megane/megane.jpg" alt = "Lamborghini Huracan"  width="700" height="400"/></li>
					<li><img src="Images/Voitures/corsa/corsa.jpg" alt = "Ferrari F8 "  width="700" height="400"/></li>
				</ul>
			</div>
		</div>

		<p class="texte-attractif" align="center">
			Si vous souhaiter plus de renseignement sur les differentes voiture n'hésiter pas a regarder si dessous, <FONT COLOR="#FFFF00">nos ventes Flash y sont afficher</FONT>
		</p>

		<div class="pour-image">
			<a href="Voiture_13.php">
				<img src="Images/Voitures/gt3_rs/gt3_rs.jpg" alt="gt3_rs">
			</a>
		</div>
		<div class="pour-image">
			<a href="Voiture_15.php">
				<img src="Images/Voitures/megane/megane.jpg" alt="megane">
			</a>
		</div>
		<div class="pour-image">
			<a href="Voiture_17.php">
				<img src="Images/Voitures/gtr/gtr.jpg" alt="gtr">
			</a>
		</div>
		<div class="pour-image">
			<a href="Voiture_2.php">
				<img src="Images/Voitures/m2/m2.jpg" alt="m2">
			</a>
		</div>
		<br>
		<p class="texte-attractif"align="center">
			Avec Agora Francia, achetez aux enchères, neuf ou d'occasion, depuis votre ordinateur. Plus de 420 commissaires-priseurs expertisent les objets. Les admins publient quotidiennement en ligne les informations relatives aux prochaines ventes aux enchères sur le site. Ils permettent ainsi aux acheteurs de consulter gratuitement la quasi-totalité des annonces de ventes aux enchères, en France et dans le monde entier. Ils ajoutent également toutes les nouvelles annonces relatives aux véhicules neufs ou d'occasion.
		</p>
		<br>
		<h1 align="center">Pour les menu cliquer également en dessous</h1>
		<br>
		<br>
		<div class="image-menu-container"align="center">
			<div class="image_tout_parcourir">
				<a href="tout_parcourir_choix.php">
				<img src="Images/tout_parcourir.jpg" alt="Tout parcourir">
				<div class="overlay">
					<span class="overlay-text">Tout parcourir</span>
				</div>
			</a>
			</div>
			<div class="image_tout_parcourir">
				<a href="connexionpage.php">
				<img src="Images/tout_parcourir.jpg" alt="Autre Image">
				<div class="overlay">
					<span class="overlay-text">Votre compte</span>
				</div>
			</a>
			</div>
			<div class="image_tout_parcourir">
				<a href="homepage.php">
				<img src="Images/tout_parcourir.jpg" alt="Autre Image">
				<div class="overlay">
					<span class="overlay-text">Accueil</span>
				</div>
			</a>
			</div>
			<div class="image_tout_parcourir">
				<a href="notification.php">
				<img src="Images/tout_parcourir.jpg" alt="Autre Image">
				<div class="overlay">
					<span class="overlay-text">Notification</span>
				</div>
			</a>
			</div>
			<div class="image_tout_parcourir">
				<a href="panier.php">
				<img src="Images/tout_parcourir.jpg" alt="Autre Image">
				<div class="overlay">
					<span class="overlay-text">Panier</span>
				</div>
			</a>
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
	</div>

	<div id="footer">
		<footer>
			<br>
			<p> 
			Si vous souhaiter voir notre localisation physique regarder en dessous :
			<br>
			<br>
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d20997.150857532815!2d2.329496502261399!3d48.86500129999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66de0a67db16b%3A0x528689fff94f3c92!2sPublications%20Agora%20France!5e0!3m2!1sfr!2sfr!4v1734080561341!5m2!1sfr!2sfr" width="300" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" align="center"></iframe>
			<br>
			<br>
			Agora Francia: <br>
			Achat revente de vehicules neuf et d'occasion, comptant et aux enchères<br>
			Copyright &copy; 2024
			<a href = "mailto:contact@agorafrancia.fr">Contactez nous par mail! </a><br>
		</p>
		</footer>
	</div>

	</body>
	</html>