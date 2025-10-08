<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Agora Francia | Page de connexion</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script type="text/javascript" src = "JS/Carousel.js"></script>
	<link rel="stylesheet" type="text/css" href="CSS/style_page.css">
	<link rel="stylesheet" type="text/css" href="CSS/search_bar.css">
	<style>
		#section{ /* Ajustement de la logueur de la section */
			width: auto;
			height: 900px; /* Longueur a adapter */
			padding-top: 5px;
		}
		.hidden {
			display: none;
		}
		#footer {
		    padding: 10px 0;
		    margin-top: 400px; 
		    width: 100%;
		}
		small {
			padding-left: 16%;
		}
		#CreerCompte h3 {
			padding-left: 15%;
		}
		#Connexion {
			background-color: lightgrey;
			margin-left: 39%;
			width: 320px;

		}
		#CreerCompte {
			background-color: lightgrey;
			margin-left: 39%;
			width: 320px;
		}
		#Connexion h3 {
			padding-left: 25px;
		}
		#Connexion a {
			color: blue;
		}
		#CreerCompte a {
			color: blue;
		}
		input[name="motdepasse"]:blur {
		    filter: blur(3px);
		}
		td {
			font-size: 15px;
			width: 140px;
		}
	</style>
	<script type="text/javascript">
		function creercompte(){
			const div1 = document.getElementById('Connexion');
        	const div2 = document.getElementById('CreerCompte');
			if (div1.classList.contains('hidden')) {
                div1.classList.remove('hidden');
                div2.classList.add('hidden');
            } else {
                div1.classList.add('hidden');
                div2.classList.remove('hidden');
            }
		}
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
		function validateForm() {
	        const roleRadios = document.getElementsByName('role');
	        let isChecked = false;

	        for (let i = 0; i < roleRadios.length; i++) {
	            if (roleRadios[i].checked) {
	                isChecked = true;
	                break;
	            }
	        }

	        if (!isChecked) {
	            alert('Veuillez sélectionner un rôle : Vendeur ou Acheteur.');
	            return false; // Empêche la soumission du formulaire
	        }

	        return true; // Autorise la soumission du formulaire
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
			<a href="moncompte.php"><img class="nav_bouton" src="Images/Boutons/votreCompte.jpg" alt="Mon compte"></a>
		</div>
	</div>

	<div id="Connexion">
		<h3>Connexion à votre compte :</h2>
		<table border = 1>
			<form border=1 action="traitementConnexion.php" method="post" onsubmit="return validateForm()">
				<tr>
					<td>Vous êtes :</td>
					<td><input type="radio" id="vendeur" name="role" value="vendeur"> Vendeur
					<input type="radio" id="acheteur" name="role" value="acheteur"> Acheteur
					<input type="radio" id="admin" name="role" value="admin"> Admin</td>
				</tr>
				<tr>
					<td>Identifiant (*) :</td>
					<td> <input type="email" name="login" required> </td>
				</tr>
				<tr>
					<td>Mot de passe (*) :</td>
					<td> <input type="password" name="motdepasse" required> </td>
				</tr>
				<tr>
					<td colspan="2" align="center"><input type="submit" name="buttonConnexion" value="Se connecter"></td>
				</tr>
			</form>
		</table><br>
		<small>Vous êtes nouveau ? <a href="#" onClick="creercompte()">Créer un compte</a></small>
		<?php if (isset($_GET['error'])): ?>
		    <?php 
		        $message = htmlspecialchars($_GET['error']);
		        $color = ($message === "Votre compte a été créé avec succès.") ? 'green' : 'red';
		    ?>
		    <p style="color: <?php echo $color; ?>; text-align: center;"><?php echo $message; ?></p>
		<?php endif; ?>
	</div>

	<div class="hidden" id="CreerCompte">
		<h3>Créer un nouveau compte :</h2>
		<table border = 1>
			<form border=1 action="traitementConnexion.php" method="post" onsubmit="return validateRole()">
				<tr>
				    <td>Vous êtes :</td>
				    <td>
				        <input type="radio" id="vendeur" name="role" value="vendeur" required> Vendeur
				        <input type="radio" id="acheteur" name="role" value="acheteur" required> Acheteur
				    </td>
				</tr>
				<tr>
					<td>Nom (*) :</td>
					<td> <input type="text" name="client_nom" required> </td>
				</tr>
				<tr>
					<td>Prénom (*) :</td>
					<td> <input type="text" name="client_prenom" required> </td>
				</tr>
				<tr>
				    <td>Sexe (*) :</td>
				    <td>
				        <select name="client_sexe" required>
				            <option value="Homme">Homme</option>
				            <option value="Femme">Femme</option>
				            <option value="Autre">Autre</option>
				        </select>
				    </td>
				</tr>
				<tr>
					<td>Date de naissance (*) :</td>
					<td> <input type="Date" name="client_datedenaissance" required> </td>
				</tr>
				<tr>
					<td>Identifiant (*) :</td>
					<td> <input type="email" placeholder="prenom.nom@edu.ece.fr" name="client_login" required> </td>
				</tr>
				<tr>
					<td>Mot de passe (*) :</td>
					<td> <input type="password" name="client_motdepasse" required> </td>
				</tr>
				<tr>
				    <td>Confirmer mot de passe (*) :</td>
				    <td><input type="password" name="client_confirm_motdepasse" required></td>
				</tr>
				<tr>
					<td>Numéro de téléphone :</td>
					<td><input type="tel" id="phone" name="client_telephone" placeholder="+33 6 12 34 56 78" pattern="^(\+33|0)[1-9](\d{2}){4}$" required></td>
				</tr>
				<tr>
					<td>Profession (*) :</td>
					<td> <input type="text" name="client_profession" required> </td>
				</tr>
				<tr>
					<td>Adresse Ligne 1 :</td>
					<td> <input type="text" name="client_adresse1" required> </td>
				</tr>
				<tr>
					<td>Adresse Ligne 2 :</td>
					<td> <input type="text" name="client_adresse2"> </td>
				</tr>
				<tr>
					<td>Ville :</td>
					<td> <input type="text" name="client_ville" required> </td>
				</tr>
				<tr>
					<td>Code postal :</td>
					<td> <input type="text" name="client_codepostal" required> </td>
				</tr>
				<tr>
					<td>Pays (*) :</td>
					<td> <input type="text" name="client_pays" required> </td>
				</tr>
				<tr>
					<td colspan="2" align="center"><input type="submit" name="buttonNewaccount" value="Créer votre compte"></td>
				</tr>
			</form>
		</table><br>
		<small>Vous avez déjà un compte ? <a href="#" onClick="creercompte()">Se connecter</a></small>
		<?php if (isset($_GET['error'])): ?>
		    <?php 
		        $message = htmlspecialchars($_GET['error']);
		        $color = ($message === "Votre compte a été créé avec succès.") ? 'green' : 'red';
		    ?>
		    <p style="color: <?php echo $color; ?>; text-align: center;"><?php echo $message; ?></p>
		<?php endif; ?>
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