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
		body {
			color: white;
		}
		h2 {
		    font-family: Arial, sans-serif;
		    color: #777;
		}
		.notification-list {
		    list-style-type: none;
		    padding: 0;
		    margin: 0;
		}
		.notification-item {
		    background-color: #f9f9f9;
		    border: 1px solid #ddd;
		    padding: 10px;
		    margin-bottom: 10px;
		    border-radius: 5px;
		    display: flex;
		    justify-content: space-between;
		}
		.message {
		    font-weight: bold;
		    color: #333;
		}
		.date {
		    font-size: 0.9em;
		    color: black;
		}
	</style>
	<script>
	function logout() {
	    fetch('deconnexion.php')
	        .then(response => response.text())
	        .then(data => {
	            if (data === 'success') {
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
			<a href="notification.php"><img class="nav_current_bouton" src="Images/Boutons/notification.jpg" alt="Notifications"></a>
			<a href="panier.php"><img class="nav_bouton" src="Images/Boutons/panier.jpg" alt="Panier"></a>
			<a href="moncompte.php"><img class="nav_bouton" src="Images/Boutons/votreCompte.jpg" alt="Mon compte"></a>
		</div>
	</div>

	<?php
	if ($_SESSION['role']==="vendeur") {
		$server_name = "localhost";
		$user_name = "root";
		$mot_de_passe = "";
		$dbname = "agora_francia";
		$conn = new mysqli($server_name, $user_name, $mot_de_passe, $dbname);
		if ($conn->connect_error) {
		    die('Erreur de connexion à la base de données : ' . $conn->connect_error);
		}
		$id_vendeur = $_SESSION['ID'];
		$sql = "SELECT * FROM notifications WHERE id_vendeur = ? AND sens = 'A-V' ORDER BY date_envoi DESC";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("i", $id_vendeur);
		$stmt->execute();
		$result = $stmt->get_result();
		echo "<h2>Vos Notifications</h2>";
		if ($result->num_rows > 0) {
		    echo '<ul class="notification-list">';
		    while ($row = $result->fetch_assoc()) {
		        echo '<li class="notification-item">';
		        echo '<span class="message">' . htmlspecialchars($row['message']) . '</span>';
		        echo '<span class="date"> - Envoyé à ' . $row['date_envoi'] . '</span>';
		        echo '</li>';
		    }
		    echo "</ul>";
		} else {
		    echo "<p>Aucune notification pour le moment.</p>";
		}
		$stmt->close();
		$conn->close();
	}
	if ($_SESSION['role']==="acheteur") {
		$server_name = "localhost";
		$user_name = "root";
		$mot_de_passe = "";
		$dbname = "agora_francia";
		$conn = new mysqli($server_name, $user_name, $mot_de_passe, $dbname);
		if ($conn->connect_error) {
		    die('Erreur de connexion à la base de données : ' . $conn->connect_error);
		}
		$id_acheteur = $_SESSION['ID'];
		$sql = "SELECT * FROM notifications WHERE id_acheteur = ? AND sens = 'V-A' ORDER BY date_envoi DESC";
		$stmt = $conn->prepare($sql);
		$stmt->bind_param("i", $id_acheteur);
		$stmt->execute();
		$result = $stmt->get_result();
		echo "<h2>Vos Notifications</h2>";
		if ($result->num_rows > 0) {
		    echo '<ul class="notification-list">';
		    while ($row = $result->fetch_assoc()) {
		        echo '<li class="notification-item">';
		        echo '<span class="message">' . htmlspecialchars($row['message']) . ' Envoyé le : ' . 	'</span>';
		        echo '<span class="date"> - Envoyé à ' . $row['date_envoi'] . '</span>';
		        echo '</li>';
		    }
		    echo "</ul>";
		} else {
		    echo "<p>Aucune notification pour le moment.</p>";
		}
		$stmt->close();
		$conn->close();
	}
	if ($_SESSION['role'] === "admin") {
	    $server_name = "localhost";
	    $user_name = "root";
	    $mot_de_passe = "";
	    $dbname = "agora_francia";
	    $conn = new mysqli($server_name, $user_name, $mot_de_passe, $dbname);
	    if ($conn->connect_error) {
	        die('Erreur de connexion à la base de données : ' . $conn->connect_error);
	    }
	    $sql = "SELECT * FROM notifications WHERE sens = 'A' ORDER BY date_envoi DESC";
	    $result = $conn->query($sql);
	    echo "<h2>Vos Notifications</h2>";
	    if ($result->num_rows > 0) {
	        echo '<ul class="notification-list">';
	        while ($row = $result->fetch_assoc()) {
	            echo '<li class="notification-item">';
	            if (isset($row['id_acheteur'])){
	            	echo '<span class="message">' . htmlspecialchars($row['message']) . " - Envoyé par l'acheteur de numéro : " . htmlspecialchars($row['id_acheteur']) . '</span>';
	            } elseif (isset($row['id_vendeur'])) {
	            	echo '<span class="message">' . htmlspecialchars($row['message']) . " - Envoyé par le vendeur de numéro : " . htmlspecialchars($row['id_vendeur']) . '</span>';
	            }
	            echo '<span class="date"> - Envoyé le : ' . htmlspecialchars($row['date_envoi']) . '</span>';
	            echo '</li>';
	        }
	        echo "</ul>";
	    } else {
	        echo "<p>Aucune notification pour le moment.</p>";
	    }
	    $conn->close();
	}

	?>

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