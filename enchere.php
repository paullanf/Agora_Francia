<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Agora Francia | Enchères</title>
	<link rel="stylesheet" type="text/css" href="CSS/style_page.css">
	<link rel="stylesheet" type="text/css" href="CSS/search_bar.css">
	<link rel="stylesheet" type="text/css" href="CSS/enchere.css">
	<link rel="stylesheet" type="text/css" href="CSS/Annonces.css">
	<link rel="stylesheet" type="text/css" href="CSS/Carousel_annonce.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript" src="JS/Carousel_annonce.js"></script>
	<style type="text/css">
		#section {
			width: auto;
			height: 1700px;
			padding-top: 5px;
		}
		.you {
			font-weight: bold;
			border: 2px solid #ffcc00;
			padding: 2px 8px;
			border-radius: 6px;
			background-color: #fffbe6;
			color: #b8860b;
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
		<div id="top_id">
			<h4 id="login">
				<?php if (isset($_SESSION['ID'])): ?>
					Bienvenue, <?php echo "<a href='moncompte.php'>" . $_SESSION['prenom'] . ' ' . $_SESSION['nom'] . " (" . $_SESSION['role'] . ")</a>"; ?> |
					<a href="deconnexion.php">Se déconnecter</a>
				<?php else: ?>
					<a href="connexionpage.php">Connectez-vous / Inscrivez-vous</a>
				<?php endif; ?>
			</h4>
		</div>
		<div id="logo">
			<img class="img_top" src="Images/logo.jpg" alt="Logo.jpg" width="50%">
		</div>
		<div id="recherche" style="position: relative; top: 25px;">
			<form method="GET" action="">
				<input type="text" name="query" placeholder="Rechercher..." value="<?php echo isset($_GET['query']) ? htmlspecialchars($_GET['query']) : ''; ?>" width="12%" height="80%">
				<button type="submit">Rechercher</button>
			</form>
		</div>
		<div id="menu" style="position: relative; top: 40px;">
			<a href="homepage.php"><img class="nav_bouton" src="Images/Boutons/accueil.jpg" alt="Accueil"></a>
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

	<div class="container">
		<h1>Voici les voitures mises en vente aux enchères</h1>
		<?php
        // Informations de connexion
		$host = "localhost";
		$dbname = "agora_francia";
		$username = "root";
		$password = "";

		try {
			$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Suppression des lignes obsolètes
			$sqlDelete = "DELETE FROM enchere WHERE date_de_fin < NOW()";
			$stmtDelete = $pdo->prepare($sqlDelete);
			$stmtDelete->execute();

            // Afficher les enregistrements restants
			$sql = "SELECT * FROM enchere WHERE 1";
			$stmt = $pdo->query($sql);
			while ($data = $stmt->fetch(PDO::FETCH_ASSOC)) {
				$cheminImage = $data['image'];
				$imageAffichage = "<img src='$cheminImage' height='400' width='600'>";
				echo $imageAffichage;
				echo "<h3>" . htmlspecialchars($data['modele']) . "</h3>";
				echo "<p>Marque : " . htmlspecialchars($data['Marque']) . "</p>";
				echo "<p>Prix de départ : " . htmlspecialchars($data['prix_de_depart']) . " €, voir le prix final dans le tableau en bas</p>";
				$datetime_from_db = $data['date_de_fin'];
				$dateTime = new DateTime($datetime_from_db);
				echo "<p>La date de fin est : " . $dateTime->format("d/m/Y H:i") . "</p>";
				date_default_timezone_set("Europe/Paris");
				$currentDateTime = new DateTime();
				echo "La date et l'heure actuelles sont : " . $currentDateTime->format('d/m/Y H:i:s') . "<br><br><br><br><br><br>";
			}
		} catch (PDOException $e) {
			echo "Erreur : " . $e->getMessage();
		}
		?>
		<?php
		if (isset($_SESSION["role"])){
			if ($_SESSION['role'] === "acheteur") {
				echo "<h1>Système d'Enchères</h1>
				<form method=\"POST\" action=\"enchere.php\">
				<div class=\"tx\">
				<label for=\"item_name\">Marque de la voiture</label>
				<input type=\"text\" id=\"item_name\" name=\"item_name\" required>
				</div>
				<div class=\"tx\">
				<label for=\"bidder_name\">Modèle de la voiture</label>
				<input type=\"text\" id=\"bidder_name\" name=\"bidder_name\" required>
				</div>
				<div class=\"tx\">
				<label for=\"bid_amount\">Montant de l'enchère (€)</label>
				<input type=\"number\" id=\"bid_amount\" name=\"bid_amount\" step=\"0.01\" min=\"0\" required>
				</div>
				<button type=\"submit\">Placer une enchère</button>
				</form>";
			}
		}
		?>
		<?php
		$servername = "localhost";
		$username = "root";
		$password = "";
		$database = "agora_francia";
		$conn = new mysqli($servername, $username, $password, $database);
		if ($conn->connect_error) {
			die("Connexion échouée : " . $conn->connect_error);
		}
		if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['ID'])) {
			$marque = $conn->real_escape_string($_POST['item_name']);
			$modele = $conn->real_escape_string($_POST['bidder_name']);
			$prix = floatval($_POST['bid_amount']);
			$acheteur_ID = (int)$_SESSION['ID'];
			$sql_select = "SELECT nouveau_prix FROM historique_enchere WHERE marque = ? AND modele = ?";
			$stmt_select = $conn->prepare($sql_select);
			$stmt_select->bind_param("ss", $marque, $modele);
			$stmt_select->execute();
			$result = $stmt_select->get_result();
			if ($result->num_rows > 0) {
				$row = $result->fetch_assoc();
				$ancienPrix = $row['nouveau_prix'];
				if ($prix > $ancienPrix) {
					$sql1 = "UPDATE historique_enchere SET ancien_prix = nouveau_prix WHERE marque = ? AND modele = ?";
					$stmt1 = $conn->prepare($sql1);
					$stmt1->bind_param("ss", $marque, $modele);
					$stmt1->execute();
					$sql2 = "UPDATE historique_enchere SET nouveau_prix = ?, acheteur_ID = ? WHERE marque = ? AND modele = ?";
					$stmt2 = $conn->prepare($sql2);
					$stmt2->bind_param("diss", $prix, $acheteur_ID, $marque, $modele);
					if ($stmt2->execute()) {
						echo "Enchère mise à jour avec succès.";
					} else {
						echo "Erreur lors de la mise à jour de l'enchère : " . $stmt2->error;
					}
					$stmt1->close();
					$stmt2->close();
				} else {
					echo "<p><strong>Erreur : </strong>Le nouveau prix doit être supérieur à l'ancien prix.</p>";
				}
			} else {
				echo "<p>Aucune enchère trouvée pour cette marque et modèle.</p>";
			}
			$stmt_select->close();
		} else {
			if(!isset($_SESSION['ID'])) {
				echo "<h3 style='color: #ff6666;'>Veuillez vous connecter pour placer une enchère.</h3>";
			}
		}
		$conn->close();
		?>

		<?php
		$servername = "localhost";
		$username = "root";
		$password = "";
		$database = "agora_francia";
		$conn = new mysqli($servername, $username, $password, $database);
		if ($conn->connect_error) {
			die("Connexion échouée : " . $conn->connect_error);
		}
		$sql = "SELECT marque, modele, ancien_prix, nouveau_prix, acheteur_ID FROM historique_enchere";
		$result = $conn->query($sql);
		?>
		<h2>Historique des encheres et enchere actuelle :</h2>
		<table border="1">
			<thead>
				<tr>
					<th>Marque de la voiture</th>
					<th>Modèle de la voiture</th>
					<th>Ancien prix (€)</th>
					<th>Nouveau prix (€)</th>
					<th>Enchérisseur</th>
				</tr>
			</thead>
			<tbody>
				<?php
				if ($result->num_rows > 0) {
					while ($row = $result->fetch_assoc()) {
						echo "<tr>";
						echo "<td>" . htmlspecialchars($row['marque']) . "</td>";
						echo "<td>" . htmlspecialchars($row['modele']) . "</td>";
						echo "<td>" . number_format($row['ancien_prix'], 2) . "</td>";
						echo "<td>" . number_format($row['nouveau_prix'], 2) . "</td>";
						if (isset($_SESSION['ID']) && $row['acheteur_ID']==$_SESSION['ID'] ){
							echo "<td><span class='you'>Vous</span> (" . $_SESSION['nom'] .' ' . $_SESSION['prenom'].")</td>";
						} else {
							echo "<td>" . $row['acheteur_ID'] . "</td>";
						}
						echo "</tr>";
					}
				} else {
					echo "<tr><td colspan='5'>Aucun historique trouvé.</td></tr>";
				}
				?>
			</tbody>
		</table>
		<?php
		$conn->close();
		?>
		<?php
		$servername = "localhost";
		$username = "root";
		$password = "";
		$database = "agora_francia";
		$connection = new mysqli($servername, $username, $password, $database);
		if ($connection->connect_error) {
			die("Connexion échouée : " . $connection->connect_error);
		}
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$marque = $connection->real_escape_string($_POST['item_name']);
			$modele = $connection->real_escape_string($_POST['bidder_name']);
			$prix = floatval($_POST['bid_amount']);
			$sql = "UPDATE enchere SET prix_de_depart = ? WHERE marque = ? AND modele = ?";
			$stmt = $connection->prepare($sql);
			$stmt->bind_param("dss", $prix, $marque, $modele); 
			if ($stmt->execute()) {
				echo "Enchère mise à jour avec succès.";
			} else {
				echo "Erreur lors de la mise à jour de l'enchère : " . $connection->error;
			}
			$stmt->close();
			$connection->close();
		}
		?>


	</tbody>
</table>
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