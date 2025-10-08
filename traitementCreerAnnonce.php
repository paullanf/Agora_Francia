<?php
session_start();

if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "vendeur") {
    die("Vous n'avez pas les permissions pour créer une annonce.");
}

// Traitement du formulaire
if (isset($_POST['creer_voiture'])) {
    // Récupération et sécurisation des données du formulaire
    $modele = htmlspecialchars($_POST['modele']);
    $marque = htmlspecialchars($_POST['marque']);
    $prix = htmlspecialchars($_POST['prix']);
    $annee = htmlspecialchars($_POST['annee']);
    $kilometrage = htmlspecialchars($_POST['kilometrage']);
    $boite = htmlspecialchars($_POST['boite']);
    $energie = htmlspecialchars($_POST['energie']);
    $puissance_fiscale = htmlspecialchars($_POST['puissance_fiscale']);
    $puissance_din = htmlspecialchars($_POST['puissance_din']);
    $consommation = htmlspecialchars($_POST['consommation']);
    $points_forts = htmlspecialchars($_POST['points_forts']);
    $equipements = htmlspecialchars($_POST['equipements']);
    $id = time(); // ID unique basé sur le timestamp

    // Contenu du fichier de la voiture généré dynamiquement
    $contenu_page = <<<HTML
<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agora Francia - {$marque} {$modele}</title>
    <link rel="stylesheet" type="text/css" href="CSS/style_page.css">
    <link rel="stylesheet" type="text/css" href="CSS/search_bar.css">
    <link rel="stylesheet" type="text/css" href="CSS/Annonces.css">
    <link rel="stylesheet" type="text/css" href="CSS/Carousel_annonce.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript" src="JS/Carousel_annonce.js"></script>
    <script type="text/javascript" src="JS/negociation.js"></script>
    <style type="text/css">
		#section{ 
			width: auto;
			height: 1700px; 
			padding-top: 5px;
		}
	</style>
</head>
<body>
    <div id="top" style="position: relative; top: -50px; border-right: 8px solid #262524; border-left: 8px solid #262524;">
        <div id="top_id">
            <h4 id="login">
                <?php if (isset(\$_SESSION['ID'])): ?>
                    Bienvenue, <?php echo "<a href='moncompte.php'>" . \$_SESSION['prenom'] . ' ' . \$_SESSION['nom'] . " (" . \$_SESSION['role'] . ")</a>"; ?> | 
                    <a href="deconnexion.php">Se déconnecter</a>
                <?php else: ?>
                    <a href="connexionpage.php">Connectez-vous / Inscrivez-vous</a>
                <?php endif; ?>
            </h4>
        </div>
        <div id="logo">
            <img class="img_top" src="Images/logo.jpg" alt="Logo.jpg" width="50%">
        </div>
    </div>

    <div id="section">
        <div class="container">
            <h1>{$marque} {$modele}</h1>
            <p class="price"><strong>Prix :</strong> {$prix} €</p>
            <p><strong>Année :</strong> {$annee}</p>
            <p><strong>Kilométrage :</strong> {$kilometrage} km</p>
            <p><strong>Boîte de vitesse :</strong> {$boite}</p>
            <p><strong>Énergie :</strong> {$energie}</p>
            <p><strong>Puissance fiscale :</strong> {$puissance_fiscale}</p>
            <p><strong>Puissance DIN :</strong> {$puissance_din}</p>
            <p><strong>Consommation :</strong> {$consommation}</p>

            <h2>Points forts</h2>
            <ul>
HTML;

    // Ajout des points forts
    $pointsFortsArray = explode(',', $points_forts);
    foreach ($pointsFortsArray as $point) {
        $contenu_page .= "<li>" . trim($point) . "</li>\n";
    }

    $contenu_page .= <<<HTML
            </ul>

            <h2>Équipements & options</h2>
            <ul>
HTML;

    // Ajout des équipements
    $equipementsArray = explode(',', $equipements);
    foreach ($equipementsArray as $equipement) {
        $contenu_page .= "<li>" . trim($equipement) . "</li>\n";
    }

    $contenu_page .= <<<HTML
            </ul>
        </div>
    </div>

    <div id="footer">
        <footer>
            <p>Agora Francia :<br>
            Achat revente de véhicules neufs et d'occasion, comptant et aux enchères<br>
            Copyright &copy; 2024<br>
            <a href="mailto:contact@agorafrancia.fr">Contactez-nous par mail !</a>
            </p>
        </footer>
    </div>
</body>
</html>
HTML;

    // Nom du fichier pour la nouvelle page voiture
    $nom_fichier = "voiture_$id.php";

    // Sauvegarde du contenu dans le fichier
    if (file_put_contents($nom_fichier, $contenu_page)) {
        echo "L'annonce a été créée avec succès ! <a href='$nom_fichier'>Voir la nouvelle annonce</a>";
    } else {
        echo "Erreur lors de la création de l'annonce.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Agora Francia | Page de connexion</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript" src = "JS/Carousel.js"></script>
	<link rel="stylesheet" type="text/css" href="CSS/style_page.css">
	<link rel="stylesheet" type="text/css" href="CSS/search_bar.css">
	<style>
		#section{ 
			width: auto;
			height: 900px; 
			padding-top: 5px;
		}
		#footer {
		    padding: 10px 0;
		    margin-top: 400px; 
		    width: 100%;
		}
		#form-container {
		    max-width: 600px;
		    margin: 30px auto;
		    padding: 20px;
		    background-color: #f5f5f5;
		    border: 1px solid #ddd;
		    border-radius: 10px;
		    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
		}
		.form-title {
		    text-align: center;
		    font-size: 24px;
		    margin-bottom: 20px;
		    color: white;
		}
		.form-group {
		    margin-bottom: 20px;
		}
		.form-group label {
		    display: block;
		    font-weight: bold;
		    margin-bottom: 8px;
		    color: #333;
		}
		.form-group input[type="text"],
		.form-group input[type="number"],
		.form-group textarea {
		    width: 100%;
		    padding: 10px;
		    border: 1px solid #ccc;
		    border-radius: 5px;
		    font-size: 16px;
		    box-sizing: border-box;
		    transition: border-color 0.3s ease;
		}
		.form-group input:focus,
		.form-group textarea:focus {
		    border-color: #007bff;
		    outline: none;
		}
		.form-group textarea {
		    resize: vertical;
		    height: 100px;
		}
		.submit-btn input[type="submit"] {
		    width: 100%;
		    padding: 12px;
		    background-color: #007bff;
		    color: #fff;
		    border: none;
		    border-radius: 5px;
		    font-size: 18px;
		    cursor: pointer;
		    transition: background-color 0.3s ease;
		}
		.submit-btn input[type="submit"]:hover {
		    background-color: #0056b3;
		}
	</style>
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
			<a href="homepage.php"><img class="nav_bouton" src="Images/Boutons/accueil.jpg" alt="Accueil" ></a>
			<a href="tout_parcourir_choix.php"><img class="nav_bouton" src="Images/Boutons/toutParcourir.jpg" alt="Tout parcourir"></a>
			<a href="notification.php"><img class="nav_bouton" src="Images/Boutons/notification.jpg" alt="Notifications"></a>
			<a href="panier.php"><img class="nav_bouton" src="Images/Boutons/panier.jpg" alt="Panier"></a>
			<a href="moncompte.php"><img class="nav_bouton" src="Images/Boutons/votreCompte.jpg" alt="Mon compte"></a>
		</div>
	</div>
    <h2 class="form-title">Créer une nouvelle annonce de voiture</h2>
	<div id="form-container">
	    <form action="" method="POST">
	        <div class="form-group">
	            <label>Modèle :</label>
	            <input type="text" name="modele" required>
	        </div>

	        <div class="form-group">
	            <label>Marque :</label>
	            <input type="text" name="marque" required>
	        </div>

	        <div class="form-group">
	            <label>Prix :</label>
	            <input type="number" name="prix" required>
	        </div>

	        <div class="form-group">
	            <label>Année :</label>
	            <input type="number" name="annee" required>
	        </div>

	        <div class="form-group">
	            <label>Kilométrage :</label>
	            <input type="number" name="kilometrage" required>
	        </div>

	        <div class="form-group">
	            <label>Boîte de vitesse :</label>
	            <input type="text" name="boite" required>
	        </div>

	        <div class="form-group">
	            <label>Énergie (moteur) :</label>
	            <input type="text" name="energie" required>
	        </div>

	        <div class="form-group">
	            <label>Puissance fiscale :</label>
	            <input type="text" name="puissance_fiscale" required>
	        </div>

	        <div class="form-group">
	            <label>Puissance DIN :</label>
	            <input type="text" name="puissance_din" required>
	        </div>

	        <div class="form-group">
	            <label>Consommation :</label>
	            <input type="text" name="consommation" required>
	        </div>

	        <div class="form-group">
	            <label>Points forts (séparés par des virgules) :</label>
	            <textarea name="points_forts" required></textarea>
	        </div>

	        <div class="form-group">
	            <label>Équipements (séparés par des virgules) :</label>
	            <textarea name="equipements" required></textarea>
	        </div>

	        <div class="form-group submit-btn">
	            <input type="submit" name="creer_voiture" value="Créer l'annonce">
	        </div>
	    </form>
	</div>
</body>
</html>