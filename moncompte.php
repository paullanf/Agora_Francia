<?php
	session_start();
	if (!isset($_SESSION['ID'])) {
	    header('Location: connexionpage.php');
	    exit();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Agora Francia | Mon compte</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript" src = "JS/Carousel.js"></script>
	<link rel="stylesheet" type="text/css" href="CSS/style_page.css">
	<link rel="stylesheet" type="text/css" href="CSS/search_bar.css">
	<style type="text/css">
		#section{ /* Ajustement de la logueur de la section */
			width: auto;
			height: 900px; /* Longueur a adapter */
			padding-top: 5px;
		}
		table{
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-family: Arial, sans-serif;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            color : black;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        h2 {
        	color:white;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        h2 {
            font-family: Arial, sans-serif;
        }
        body {
        	color: white;
        }
        .optionAdmin td {
        	background-color: black;
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
			<a href="homepage.php"><img class="nav_bouton" src="Images/Boutons/accueil.jpg" alt="Accueil" ></a>
			<a href="tout_parcourir_choix.php"><img class="nav_bouton" src="Images/Boutons/toutParcourir.jpg" alt="Tout parcourir"></a>
			<a href="notification.php"><img class="nav_bouton" src="Images/Boutons/notification.jpg" alt="Notifications"></a>
			<a href="panier.php"><img class="nav_bouton" src="Images/Boutons/panier.jpg" alt="Panier"></a>
			<a href="moncompte.php"><img class="nav_current_bouton" src="Images/Boutons/votreCompte.jpg" alt="Mon compte"></a>
		</div>
	</div>
	<?php
		if($_SESSION['role']=="acheteur" || $_SESSION['role']=="vendeur") {
			echo'
				<h2>Informations ' . $_SESSION['role'] .'</h2>
				<table border = 1>
				    <tr>
				        <th>Adresse Mail</th>
				        <th>Nom</th>
				        <th>Prénom</th>
				        <th>Sexe</th>
				        <th>Date de Naissance</th>
				        <th>Téléphone</th>
				        <th>Profession</th>
				        <th>Adresse 1</th>
				        <th>Adresse 2</th>
				        <th>Ville</th>
				        <th>Code Postal</th>
				        <th>Pays</th>
				    </tr>
				    <tr>
				        <td>' . htmlspecialchars($_SESSION['login']) . '</td>
				        <td>' . htmlspecialchars($_SESSION['nom']) . '</td>
				        <td>' . htmlspecialchars($_SESSION['prenom']) . '</td>
				        <td>' . htmlspecialchars($_SESSION['sexe']) . '</td>
				        <td>' . htmlspecialchars($_SESSION['datedenaissance']) . '</td>
				        <td>' . htmlspecialchars($_SESSION['telephone']) . '</td>
				        <td>' . htmlspecialchars($_SESSION['profession']) . '</td>
				        <td>' . htmlspecialchars($_SESSION['adresse1']) . '</td>
				        <td>' . htmlspecialchars($_SESSION['adresse2']) . '</td>
				        <td>' . htmlspecialchars($_SESSION['ville']) . '</td>
				        <td>' . htmlspecialchars($_SESSION['codepostal']) . '</td>
				        <td>' . htmlspecialchars($_SESSION['pays']) . '</td>
				    </tr>
				</table><br>';
			echo '<h2>Écrire au support</h2>
				<form method="POST" action="">
				    <textarea name="message" rows="4" cols="50" placeholder="Votre message..."></textarea><br><br>
				    <button type="submit" name="submit">Envoyer</button>
				</form>';
				if (isset($_POST['submit'])) {
				    $conn = new mysqli('localhost', 'root', '', 'agora_francia');
				    if ($conn->connect_error) {
				        die("Erreur de connexion : " . $conn->connect_error);
				    }
				    $message = $_POST['message'];
				    $date_envoi = date("Y-m-d H:i:s");
				    $id_acheteur = $_SESSION['ID']; 
				    $role = $_SESSION['role'];
				    $id_vendeur = ($role === 'vendeur') ? $_SESSION['user_id'] : null;
				    $stmt = $conn->prepare("
				        INSERT INTO notifications (id_acheteur, id_produit, message, date_envoi, statut, id_vendeur, sens)
				        VALUES (?, NULL, ?, ?, 'non lu', ?, 'A')
				    ");
				    $stmt->bind_param("issi", $id_acheteur, $message, $date_envoi, $id_vendeur);
				    if ($stmt->execute()) {
				        echo "<p>Notification envoyée avec succès !</p>";
				    } else {
				        echo "<p>Erreur : " . $stmt->error . "</p>";
				    }
				    $stmt->close();
				    $conn->close();
				}
		} elseif($_SESSION['role']=="admin") {
				echo'
				<h2>Informations ADMIN</h2>
				<table border = 1>
				    <tr>
				        <th>Adresse Mail</th>
				        <th>Nom</th>
				        <th>Prénom</th>
				        <th>Sexe</th>
				    </tr>
				    <tr>
				        <td>' . htmlspecialchars($_SESSION['login']) . '</td>
				        <td>' . htmlspecialchars($_SESSION['nom']) . '</td>
				        <td>' . htmlspecialchars($_SESSION['prenom']) . '</td>
				        <td>' . htmlspecialchars($_SESSION['sexe']) . '</td>
				    </tr>
				</table><br>';
				echo '
				<div class=optionAdmin>
					<h2>Options ADMIN</h2>
					<form border=1 action="traitementAdmin.php" method="post">
						Ventes d\'occasion et neuf : <input type="submit" name="GererAnnonces" value="Gérer"><br><br>
						Enchères : <input type="submit" name="GererEncheres" value="Gérer"><br><br>
						Vendeurs : <input type="submit" name="GererVendeurs" value="Gérer">
					</form>
				</div>';
			}
		?>
		
	<br><br><br><br><br><br><br><br><br><br><br><br>
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