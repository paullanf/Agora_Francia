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
    	<link rel="stylesheet" type="text/css" href="CSS/style_page.css">
    	<link rel="stylesheet" type="text/css" href="CSS/search_bar.css">
    	<style type="text/css">
    		#section{ /* Ajustement de la logueur de la section */
    			margin-top: 2%;
    			margin-left: 2%;
    			color:white;
    			width: auto;
    			height: 900px; /* Longueur a adapter */
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
            <a href="tout_parcourir_choix.php"><img class="nav_bouton" src="Images/Boutons/toutParcourir.jpg" alt="Tout parcourir"></a>
            <a href="notification.php"><img class="nav_bouton" src="Images/Boutons/notification.jpg" alt="Notifications"></a>
            <a href="panier.php"><img class="nav_bouton" src="Images/Boutons/panier.jpg" alt="Panier"></a>
            <a href="moncompte.php"><img class="nav_current_bouton" src="Images/Boutons/votreCompte.jpg" alt="Mon compte"></a>
        </div>
    	</div>
    	<div id="section">
    		<?php
	//declaration des variables
    		$modele = isset($_POST["modele"])? $_POST["modele"] : "";
    		$marque = isset($_POST["marque"])? $_POST["marque"] : "";
    		$année = isset($_POST["année"])? $_POST["année"] : "";
    		$moteur = isset($_POST["moteur"])? $_POST["moteur"] : "";
    		$Boite_de_vitesse = isset($_POST["Boite_de_vitesse"])? $_POST["Boite_de_vitesse"] : "";
    		$Pays = isset($_POST["Pays"])? $_POST["Pays"] : "";
    		$Kilometre = isset($_POST["Kilometre"])? $_POST["Kilometre"] : "";
    		$Prix = isset($_POST["Prix"])? $_POST["Prix"] : "";
    		$puissance_fiscale = isset($_POST["puissance_fiscale"])? $_POST["puissance_fiscale"] : "";
    		$consommation = isset($_POST["consommation"])? $_POST["consommation"] : "";
    		$Points_forts = isset($_POST["Points_forts"])? $_POST["Points_forts"] : "";
    		$puissance_moteur = isset($_POST["puissance_moteur"])? $_POST["puissance_moteur"] : "";
    		$equipements = isset($_POST["equipements"])? $_POST["equipements"] : "";
    		$Image = isset($_POST["Image"])? $_POST["Image"] : "";
    		$Type = isset($_POST["Type"])? $_POST["Type"] : "";

    		$erreur = "";
    		if ($modele == "") {
    			$erreur .= "Le champ Modèle de la voiture est vide. <br>";
    		}
    		if ($marque == "") {
    			$erreur .= "Le champ marque est vide. <br>";
    		}
    		if ($année == "") {
    			$erreur .= "Le champ Année de mise en circulation est vide. <br>";
    		}
    		if ($moteur == "") {
    			$erreur .= "Le champ Moteur de naissance est vide. <br>";
    		}
    		if ($Boite_de_vitesse == "") {
    			$erreur .= "Le champ Boite de vitesse de la voiture est vide. <br>";
    		}
    		if ($Pays == "") {
    			$erreur .= "Le champ Pays est vide. <br>";
    		}
    		if ($Kilometre == "") {
    			$erreur .= "Le champ Kilometre de mise en circulation est vide. <br>";
    		}
    		if ($Prix == "") {
    			$erreur .= "Le champ Prix est vide. <br>";
    		}
    		if ($puissance_fiscale == "") {
    			$erreur .= "Le champ Puissance fiscale est vide. <br>";
    		}
    		if ($consommation == "") {
    			$erreur .= "Le champ Consommation est vide. <br>";
    		}
    		if ($Points_forts == "") {
    			$erreur .= "Le champ Points forts est vide. <br>";
    		}
    		if ($equipements == "") {
    			$erreur .= "Le champ Equipements est vide. <br>";
    		}
    		if ($Image== "") {
    			$erreur .= "Le champ Liens des photos est vide. <br>";
    		}
    		if ($Type == "") {
    			$erreur .= "Le champ Type de la voiture est vide. <br>";
    		}
    		if ($erreur == "") {
    			echo "Formulaire valide.";

    			$database = "agora_francia";
		//connectez-vous dans votre BDD
		//Rappel : votre serveur = localhost | votre login = root | votre mot de pass = '' (rien)
    			$db_handle = mysqli_connect('localhost', 'root', '' );
    			$db_found = mysqli_select_db($db_handle, $database);
		//si le BDD existe, faire le traitement

    			if ($db_found) {
    				$sql = "INSERT INTO voiture VALUES (NULL,'" . $modele ."','".$marque."','".$année."','".$moteur."','".$Boite_de_vitesse."','".$Pays."','".$Kilometre."','".$Prix."','".$puissance_fiscale."','".$puissance_moteur."','".$consommation."','".$Points_forts."','".$equipements."','".$Type."','".$Image."')";
    					$result = mysqli_query($db_handle, $sql);
    				}
		//end if
		//si le BDD n'existe pas
    				else {
    					echo "Database not found";
    				}
		//end else
	//fermer la connection
    				mysqli_close($db_handle);
    			} 
    			else {
    				echo "Formulaire invalide<br>" . $erreur;
    			}
    			?>


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