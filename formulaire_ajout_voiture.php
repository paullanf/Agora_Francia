<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Agora Francia</title>
	<link rel="stylesheet" type="text/css" href="CSS/style_page.css">
	<link rel="stylesheet" type="text/css" href="CSS/search_bar.css">
	<style type="text/css">
		#section{ /* Ajustement de la logueur de la section */
			width: auto;
			height: 900px; /* Longueur a adapter */
			padding-top: 5px;
			
		}
		#formulaire{
			background-color: lightgrey;
		}
		#title{
			color: black;
			background-color: lightgrey;
			width: 420px;
			margin: auto;
			margin-top: 6%;
		}
		#bouton1{
			background-color: skyblue;
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
			<a href="tout_parcourir_choix.php"><img class="nav_bouton" src="Images/Boutons/toutParcourir.jpg" alt="Tout parcourir"></a>
			<a href="notification.php"><img class="nav_bouton" src="Images/Boutons/notification.jpg" alt="Notifications"></a>
			<a href="panier.php"><img class="nav_bouton" src="Images/Boutons/panier.jpg" alt="Panier"></a>
			<a href="moncompte.php"><img class="nav_current_bouton" src="Images/Boutons/votreCompte.jpg" alt="Mon compte"></a>
		</div>
	</div>
	<div id="section">
		<div id = "title">
			<h1 align="center">Ajouter une voiture</h1>
			<form action="formulaire_informations.php" method="post" >
				<table border="1" align = "center" id="formulaire">
					<tr>
						<td>Modèle de la voiture:</td>
						<td><input type="text" name="modele"></td>
					</tr>
					<tr>
						<td>Marque:</td>
						<td><input type="text" name="marque"></td>
					</tr>
					<tr>
						<td>Année de mise en circulation:</td>
						<td><input type="Number" name="année"></td>
					</tr>
					<tr>
						<td>Moteur:</td>
						<td><input type="text" name="moteur"></td>
					</tr>
					<tr>
						<td>Boite de vitesse:</td>
						<td><input type="text" name="Boite_de_vitesse"></td>
					</tr>
					<tr>
						<td>Pays:</td>
						<td><input type="text" name="Pays"></td>
					</tr>
					<tr>
						<td>Kilomètre:</td>
						<td><input type="Number" name="Kilometre"></td>
					</tr>
					<tr>
						<td>Prix:</td>
						<td><input type="Number" name="Prix"></td>
					</tr>
					<tr>
						<td>Puissance fiscale:</td>
						<td><input type="text" name="puissance_fiscale"></td>
					</tr>
					<tr>
						<td>Puissance du moteur:</td>
						<td><input type="text" name="puissance_moteur"></td>
					</tr>
					<tr>
						<td>Consommation:</td>
						<td><input type="text" name="consommation"></td>
					</tr>
					<tr>
						<td>Points forts:</td>
						<td><input type="text" name="Points_forts"></td>
					</tr>
					<tr>
						<td>Equipements:</td>
						<td><input type="text" name="equipements"></td>
					</tr>
					<tr>
						<td>Type:</td>
						<td><input type="text" name="Type"></td>
					</tr>
					<tr>
						<td>Liens des photos (";" entre chaque lien):</td>
						<td><input type="text" name="Image"></td>
					</tr>
					<tr>
						<td colspan="2" align="center">
							<input type="submit" name="Valider" value="Ajouter" id="bouton1">
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
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