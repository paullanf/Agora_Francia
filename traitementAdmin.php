<?php
    session_start();
    $conn = new mysqli('localhost', 'root', '', 'agora_francia');
    if ($conn->connect_error) {
        die("Erreur de connexion : " . $conn->connect_error);
    }


    if (isset($_POST['GererVendeurs'])) {
	    $sql = "SELECT * FROM vendeurs";
	    $result = $conn->query($sql);
	    echo "<h2>Nos vendeurs déjà inscrits</h2>";
	    if ($result->num_rows > 0):
	        echo "<table border='1'>
	                <tr>
						<th>vendeur_nom</th>
						<th>vendeur_prenom</th>
						<th>vendeur_sexe</th>
						<th>vendeur_datedenaissance</th>
						<th>vendeur_login</th>
						<th>vendeur_telephone</th>
						<th>vendeur_profession</th>
						<th>vendeur_adresse1</th>
						<th>vendeur_adresse2</th>
						<th>vendeur_ville</th>
						<th>vendeur_codepostal</th>
						<th>vendeur_pays</th>
						<th>Actions</th>
	                </tr>";
	        while ($row = $result->fetch_assoc()):
	            echo "<tr>
						<td>" . $row["vendeur_nom"] . "</td>
						<td>" . $row["vendeur_prenom"] . "</td>
						<td>" . $row["vendeur_sexe"] . "</td>
						<td>" . $row["vendeur_datedenaissance"] . "</td>
						<td>" . $row["vendeur_login"] . "</td>
						<td>" . $row["vendeur_telephone"] . "</td>
						<td>" . $row["vendeur_profession"] . "</td>
						<td>" . $row["vendeur_adresse1"] . "</td>
						<td>" . $row["vendeur_adresse2"] . "</td>
						<td>" . $row["vendeur_ville"] . "</td>
						<td>" . $row["vendeur_codepostal"] . "</td>
						<td>" . $row["vendeur_pays"] . "</td>
	                    <td>
	                        <form method='POST'>
	                            <input type='hidden' name='id' value='" . $row["vendeur_ID"] . "'>
	                            <input type='submit' name='deletevendeur' value='Supprimer'>
	                        </form>
	                    </td>
	                </tr>";
	        endwhile;
	        echo "</table>";
	    else:
	        echo "<p>Aucun vendeur trouvé.</p>";
	    endif;
	    echo '<h2>Ajouter un nouveau vendeur</h2>
	        <form method="POST">
				<label>Nom : <input type="text" name="vendeur_nom" required></label><br>
				<label>Prénom : <input type="text" name="vendeur_prenom" required></label><br>
				<label>Sexe : <input type="text" name="vendeur_sexe" required></label><br>
				<label>Date de naissance : <input type="Date" name="vendeur_datedenaissance" required></label><br>
				<label>Login : <input type="text" name="vendeur_login" required></label><br>
				<label>Mot de passe : <input type="text" name="vendeur_motdepasse" required></label><br>
				<label>Téléphone : <input type="text" name="vendeur_telephone" required></label><br>
				<label>Profession : <input type="text" name="vendeur_profession" required></label><br>
				<label>Adresse 1 : <input type="text" name="vendeur_adresse1" required></label><br>
				<label>Adresse 2 : <input type="text" name="vendeur_adresse2" required></label><br>
				<label>Ville : <input type="text" name="vendeur_ville" required></label><br>
				<label>Code postal : <input type="text" name="vendeur_codepostal" required></label><br>
				<label>Pays : <input type="text" name="vendeur_pays" required></label><br>
	            <input type="submit" name="ajoutervendeur" value="Ajouter">
	        </form>';
	}

	if (isset($_POST['ajoutervendeur'])) {
		$vendeur_nom = $_POST['vendeur_nom'];
		$vendeur_prenom = $_POST['vendeur_prenom'];
		$vendeur_sexe = $_POST['vendeur_sexe'];
		$vendeur_datedenaissance = $_POST['vendeur_datedenaissance'];
		$vendeur_login = $_POST['vendeur_login'];
		$vendeur_motdepasse = $_POST['vendeur_motdepasse'];
		$vendeur_telephone = $_POST['vendeur_telephone'];
		$vendeur_profession = $_POST['vendeur_profession'];
		$vendeur_adresse1 = $_POST['vendeur_adresse1'];
		$vendeur_adresse2 = $_POST['vendeur_adresse2'];
		$vendeur_ville = $_POST['vendeur_ville'];
		$vendeur_codepostal = $_POST['vendeur_codepostal'];
		$vendeur_pays = $_POST['vendeur_pays'];
        $sql = "INSERT INTO vendeurs (vendeur_nom, vendeur_prenom, vendeur_sexe, vendeur_datedenaissance, vendeur_login, vendeur_motdepasse, vendeur_telephone, vendeur_profession,vendeur_adresse1, vendeur_adresse2, vendeur_ville, vendeur_codepostal, vendeur_pays)
        		VALUES ('$vendeur_nom', '$vendeur_prenom', '$vendeur_sexe', '$vendeur_datedenaissance', '$vendeur_login', '$vendeur_motdepasse', '$vendeur_telephone', '$vendeur_profession', '$vendeur_adresse1', '$vendeur_adresse2', '$vendeur_ville', '$vendeur_codepostal', '$vendeur_pays')";
        if ($conn->query($sql) === TRUE) {
            echo "Nouveau client inscrit avec succès.";
        } else {
            echo "Erreur : " . $conn->error;
        }
    }

    if (isset($_POST['deletevendeur'])) {
    	$id = $_POST['id'];
        $sql = "DELETE FROM vendeurs WHERE vendeur_ID = $id";
        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('Vendeur supprimé avec succès.');</script>";
        } else {
            echo "<script>alert('Erreur lors de la suppression : " . addslashes($conn->error) . "');</script>";
        }
    }   

	if (isset($_POST['GererEncheres'])) {
	    $sql = "SELECT * FROM enchere";
	    $result = $conn->query($sql);
	    echo "<h2>Annonces enchères</h2>";
	    if ($result->num_rows > 0):
	        echo "<table border='1'>
	                <tr>
	                    <th>ID</th>
	                    <th>Modèle</th>
	                    <th>Marque</th>
	                    <th>Prix de départ</th>
	                    <th>Image</th>
	                    <th>Date de fin</th>
	                    <th>Actions</th>
	                </tr>";
	        while ($row = $result->fetch_assoc()):
	            echo "<tr>
	                    <td>" . $row["ID"] . "</td>
	                    <td>" . $row["modele"] . "</td>
	                    <td>" . $row["Marque"] . "</td>
	                    <td>" . $row["prix_de_depart"] . "</td>
	                    <td><img src='" . $row["image"] . "' width=100px></td>
	                    <td>" . $row["date_de_fin"] . "</td>
	                    <td>
	                        <form method='POST'>
	                            <input type='hidden' name='id' value='" . $row["ID"] . "'>
	                            <input type='submit' name='deleteenchere' value='Supprimer'>
	                        </form>
	                    </td>
	                </tr>";
	        endwhile;
	        echo "</table>";
	    else:
	        echo "<p>Pas d'enchère de voiture trouvée.</p>";
	    endif;
	    echo '<h2>Ajouter une nouvelle enchère</h2>
        <form method="POST">
            <label>Modèle: <input type="text" name="modele" required></label><br>
            <label>Marque: <input type="text" name="Marque" required></label><br>
            <label>Prix de départ: <input type="number" name="prix_de_depart" required></label><br>
            <label>Image: <input type="text" name="image"></label><br>
            <label>Date de fin: <input type="datetime-local" name="date_de_fin"></label><br>
            <input type="submit" name="ajouterenchere" value="Ajouter">
        </form>';
	}

	if (isset($_POST['ajouterenchere'])) {
        	$modele = $_POST['modele'];
            $marque = $_POST['Marque'];
            $prix_de_depart = $_POST['prix_de_depart'];
            $image = $_POST['image'];
            $date_de_fin = $_POST['date_de_fin'];
            $sql = "INSERT INTO enchere (modele, Marque, prix_de_depart, image, date_de_fin)
                    VALUES ('$modele', '$marque', '$prix_de_depart', '$image', '$date_de_fin')";
            if ($conn->query($sql) === TRUE) {
                echo "Nouvelle voiture ajoutée avec succès aux enchères.";
            } else {
                echo "Erreur : " . $conn->error;
            }
        }

    	if (isset($_POST['deleteenchere'])) {
    		$id = $_POST['id'];
            $sql = "DELETE FROM enchere WHERE ID = $id";
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Annonce supprimée avec succès des enchères.');</script>";
            } else {
                echo "<script>alert('Erreur lors de la suppression : " . addslashes($conn->error) . "');</script>";
            }
    	}    

    if (isset($_POST['GererAnnonces'])) {
        if (isset($_POST['deleteannonce'])) {
            $id = $_POST['id'];
            $sql = "DELETE FROM voiture WHERE ID = $id";
            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Annonce supprimée avec succès.');</script>";
            } else {
                echo "<script>alert('Erreur lors de la suppression : " . addslashes($conn->error) . "');</script>";
            }
        }
        if (isset($_POST['ajouterannonce'])) {
            $modele = $_POST['modele'];
            $marque = $_POST['marque'];
            $annee = $_POST['annee'];
            $moteur = $_POST['moteur'];
            $boite_de_vitesse = $_POST['boite_de_vitesse'];
            $pays = $_POST['pays'];
            $kilometre = $_POST['kilometre'];
            $prix = $_POST['prix'];
            $puissance_fiscale = $_POST['puissance_fiscale'];
            $puissance_moteur = $_POST['puissance_moteur'];
            $consommation = $_POST['consommation'];
            $Points_forts = $_POST['Points_forts'];
            $equipements = $_POST['equipements'];
            $Type = $_POST['Type'];
            $Image = $_POST['Image'];
            $Localisation = $_POST['Localisation'];
            $sql = "INSERT INTO voiture (modele, marque, année, moteur, Boite_de_vitesse, Pays, Kilometre, Prix, puissance_fiscale, puissance_moteur, consommation, Points_forts, equipements, Type, Image, Localisation)
                    VALUES ('$modele', '$marque', '$annee', '$moteur', '$boite_de_vitesse', '$pays', '$kilometre', '$prix', '$puissance_fiscale', '$puissance_moteur', '$consommation', '$Points_forts', '$equipements', '$Type', '$Image', '$Localisation')";
            if ($conn->query($sql) === TRUE) {
                echo "Nouvelle voiture ajoutée avec succès.";
            } else {
                echo "Erreur : " . $conn->error;
            }
        }
        $sql = "SELECT * FROM voiture";
        $result = $conn->query($sql);
        ?>
        <h2>Annonces de voiture en occasion et en neuf</h2>
        <?php if ($result->num_rows > 0): ?>
            <table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Modèle</th>
                    <th>Marque</th>
                    <th>Année</th>
                    <th>Moteur</th>
                    <th>Boîte de vitesse</th>
                    <th>Pays</th>
                    <th>Kilomètre</th>
                    <th>Prix</th>
                    <th>Puissance fiscale</th>
                    <th>Puissance moteur</th>
                    <th>Consommation</th>
                    <th>Points forts</th>
                    <th>Equipements</th>
                    <th>Type</th>
                    <th>Image</th>
                    <th>Localisation</th>
                    <th>Actions</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row["ID"] ?></td>
                        <td><?= $row["modele"] ?></td>
                        <td><?= $row["marque"] ?></td>
                        <td><?= $row["année"] ?></td>
                        <td><?= $row["moteur"] ?></td>
                        <td><?= $row["Boite_de_vitesse"] ?></td>
                        <td><?= $row["Pays"] ?></td>
                        <td><?= $row["Kilometre"] ?></td>
                        <td><?= $row["Prix"] ?></td>
                        <td><?= $row["puissance_fiscale"] ?></td>
                        <td><?= $row["puissance_moteur"] ?></td>
                        <td><?= $row["consommation"] ?></td>
                        <td><?= $row["Points_forts"] ?></td>
                        <td><?= $row["equipements"] ?></td>
                        <td><?= $row["Type"] ?></td>
                        <td><img src='<?= $row["Image"] ?>' width=100px></td>
                        <td><?= $row["Localisation"] ?></td>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="id" value="<?= $row["ID"] ?>">
                                <input type="submit" name="deleteannonce" value="Supprimer">
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>Pas d'annonce de voiture trouvée.</p>
        <?php endif; ?>
        <h2>Ajouter une nouvelle voiture</h2>
        <form method="POST">
            <label>Modèle: <input type="text" name="modele" required></label><br>
            <label>Marque: <input type="text" name="marque" required></label><br>
            <label>Année: <input type="number" name="annee" required></label><br>
            <label>Moteur: <input type="text" name="moteur"></label><br>
            <label>Boîte de vitesse: <input type="text" name="boite_de_vitesse"></label><br>
            <label>Pays: <input type="text" name="pays"></label><br>
            <label>Kilomètre: <input type="number" name="kilometre"></label><br>
            <label>Prix: <input type="number" name="prix" required></label><br>
            <label>Puissance fiscale: <input type="text" name="puissance_fiscale" required></label><br>
            <label>Puissance moteur: <input type="text" name="puissance_moteur" required></label><br>
            <label>Consommation: <input type="text" name="consommation" required></label><br>
            <label>Points forts: <input type="text" name="Points_forts" required></label><br>
            <label>Equipements: <input type="text" name="equipements" required></label><br>
            <label>Type: <input type="text" name="Type" required></label><br>
            <label>Image: <input type="text" name="Image" required></label><br>
            <label>Localisation: <input type="text" name="Localisation" required></label><br>
            <input type="submit" name="ajouterannonce" value="Ajouter">
        </form>
<?php
    }
    $conn->close();
?>
