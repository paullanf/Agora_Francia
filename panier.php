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
			color: white;
		}
		table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-family: Arial, sans-serif;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
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
        tr{
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        h2 {
            font-family: Arial, sans-serif;
        }
        body {
        	color: black;
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
			<a href="panier.php"><img class="nav_current_bouton" src="Images/Boutons/panier.jpg" alt="Panier"></a>
			<a href="moncompte.php"><img class="nav_bouton" src="Images/Boutons/votreCompte.jpg" alt="Mon compte"></a>
		</div>
	</div>
	<h2>Mes commandes</h2>
	<?php

	$newPrix = isset($_POST['proposition']) ? $_POST['proposition']:"";
	$modele = isset($_POST['modele']) ? $_POST['modele']:"";
	$id = isset($_POST['id']) ? $_POST['id']:"";
	$modeAchat = isset($_POST['modeAchat']) ? $_POST['modeAchat']:"";
	$id_session = isset($_SESSION['ID']) ? $_SESSION['ID'] : "";
	$date = date('y-m-d');

	$database = 'agora_francia';

	$db_handle = mysqli_connect('localhost','root','');
	$db_found = mysqli_select_db($db_handle,$database);

	if ($db_found) {
		$sql_verif = "SELECT * FROM panier WHERE id_produit = '".$id."' AND id_acheteur = '".$id_session. "'AND prix_achat = '".$newPrix."'AND date_achat = '". $date. "'AND mode_achat = '".$modeAchat."'AND annonce = '".$modele."'";
		$resultat_verif = mysqli_query($db_handle,$sql_verif);
		if (!empty($modeAchat)) {
			if (mysqli_num_rows($resultat_verif) == 0) {
				$sql = "INSERT INTO panier VALUES(NULL,'".$id."','".$id_session."','".$newPrix."','".$date."','".$modeAchat."','".$modele."','en attente',NULL)";
				$result = mysqli_query($db_handle,$sql);
			}
		}
		
			$sql_panier = "SELECT * FROM panier WHERE id_acheteur = '".$id_session."'AND status = 'en attente'";
			$result_panier = mysqli_query($db_handle,$sql_panier);
			echo "<form method='POST' action='Paiement.php'>";
			echo "<table border = 1>";
			echo "<tr>";
			echo "<th>Numéro de l'annonce</th>";
			echo "<th>Prix</th>";
			echo "<th>Date de commande</th>";
			echo "<th>Type d'achat</th>";
			echo "<th>Lien vers l'annonce</th>";
			echo "<th>Sélection</th>";
			echo "</tr>";
			while ($data = mysqli_fetch_assoc($result_panier)) {
				echo "<tr>";
				echo "<td>".$data['id_produit']."</td>";
				echo "<td>".$data['prix_achat']."€</td>";
				echo "<td>".$data['date_achat']."</td>";
				echo "<td>".$data['mode_achat']."</td>";
				echo "<td>".$data['annonce']."</td>";
				echo "<td><input type='checkbox' name='selection[]' value='".$data['id_produit']."'></td>";
				echo "</tr>";
			}
			echo "<tr><td colspan = '6' style='text-align: center;'>";
			echo "<input type='submit' value='Payer / prépayer'>";
			echo "</td></tr>";
			echo "</table>";
			echo "</form>";
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