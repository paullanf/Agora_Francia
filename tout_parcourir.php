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
    <link rel="stylesheet" type="text/css" href="CSS/Annonces.css">
    <link rel="stylesheet" type="text/css" href="CSS/tout_parcourir.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <style type="text/css">
        #section{ /* Ajustement de la longueur de la section */
            width: auto;
            height: 1700px;
            padding-top: 5px;
        }
        .logo {
            margin-left: 25px;
            width: 30px;
            height: 30px;
        }
    </style>
</head>
<body>
    <!-- En tête à ne pas modifier -->
    <div id="top" style="position: relative; top: -50px; border-right: 8px solid #262524; border-left: 8px solid #262524;">
        <div id="top_id"> <!-- zone de connexion -->
            <h4 id="login">
                <?php if (isset($_SESSION['ID'])): ?>
                    Bienvenue, <?php echo "<a href='moncompte.php'>" . $_SESSION['prenom'] . ' ' . $_SESSION['nom'] . " (" . $_SESSION['role'] . ")</a>"; ?> | 
                    <a href="deconnexion.php">Se déconnecter</a>
                <?php else: ?>
                    <a href="connexionpage.php">Connectez-vous / Inscrivez-vous</a>
                <?php endif; ?>
            </h4>
        </div>
        <div id="logo"> <!-- logo -->
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
            <a href="tout_parcourir_choix.php"><img class="nav_current_bouton" src="Images/Boutons/toutParcourir.jpg" alt="Tout parcourir"></a>
            <a href="notification.php"><img class="nav_bouton" src="Images/Boutons/notification.jpg" alt="Notifications"></a>
            <a href="panier.php"><img class="nav_bouton" src="Images/Boutons/panier.jpg" alt="Panier"></a>
            <a href="moncompte.php"><img class="nav_bouton" src="Images/Boutons/votreCompte.jpg" alt="Mon compte"></a>
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

    <div class="container">
        <div class="base">
            <div class="filtre">
                <?php
                // Identifications de la BDD
                $database = 'agora_francia';

                // Connexion à la BDD
                $db_handle = mysqli_connect('localhost', 'root', '');
                $db_found = mysqli_select_db($db_handle, $database);

                // Récupération des valeurs du formulaire de filtre
                $type = isset($_GET['type']) ? $_GET['type'] : "";
                $marque = isset($_GET['marque']) ? $_GET['marque'] : "";
                $annee_min = isset($_GET['annee_min']) ? $_GET['annee_min'] : "";
                $annee_max = isset($_GET['annee_max']) ? $_GET['annee_max'] : "";
                $km_min = isset($_GET['kilometrage_min']) ? $_GET['kilometrage_min'] : "";
                $km_max = isset($_GET['kilometrage_max']) ? $_GET['kilometrage_max'] : "";
                $essence = isset($_GET['fuel']) ? $_GET['fuel'] : "";
                $transmission = isset($_GET['transmission']) ? $_GET['transmission'] : "";
                $sort_order = isset($_GET['sort_order']) ? $_GET['sort_order'] : "";

                // Formulaire de filtrage
                echo "<h2>Filtres</h2>"; 
                echo "<form method='GET'>";
                echo "<label for='type-vehicule'>Type de véhicule</label>";
                echo "<select id='type-vehicule' name='type'>";
                echo "<option value=''></option>";
                echo "<option value='SUV' " . ($type == 'SUV' ? 'selected' : '') . ">SUV</option>";
                echo "<option value='Citadine' " . ($type == 'Citadine' ? 'selected' : '') . ">Citadine</option>";
                echo "<option value='Berline' " . ($type == 'Berline' ? 'selected' : '') . ">Berline</option>";
                echo "<option value='Break' " . ($type == 'Break' ? 'selected' : '') . ">Break</option>";
                echo "<option value='Sans_Permis' " . ($type == 'Sans_Permis' ? 'selected' : '') . ">Sans Permis</option>";
                echo "<option value='Bus' " . ($type == 'Bus' ? 'selected' : '') . ">Bus</option>";
                echo "<option value='Sportive' " . ($type == 'Sportive' ? 'selected' : '') . ">Sportive</option>";
                echo "</select><br><br>";

                echo "<label for='marque-vehicule'>Marque</label>";
                echo "<select id='marque-vehicule' name='marque'>";
                echo "<option value=''></option>";
                $marques = ['Peugeot', 'Renault', 'Ferrari', 'Lamborghini', 'Citroën', 'Opel', 'Dacia', 'Volkswagen', 'Audi', 'Nissan'];
                foreach ($marques as $item) {
                    echo "<option value='$item' " . ($marque == $item ? 'selected' : '') . ">$item</option>";
                }
                echo "</select><br><br>";

                echo "<h4>Année</h4>";
                echo "<input type='number' name='annee_min' placeholder='min' value='$annee_min'>";
                echo "<input type='number' name='annee_max' placeholder='max' value='$annee_max'><br><br>";

                echo "<h4>Kilométrage</h4>";
                echo "<input type='number' name='kilometrage_min' placeholder='min' value='$km_min'>";
                echo "<input type='number' name='kilometrage_max' placeholder='max' value='$km_max'><br><br>";

                echo "<h4>Carburant</h4>";
                $fuels = ['diesel', 'essence', 'electrique', 'hybride'];
                foreach ($fuels as $fuel) {
                    $checked = in_array($fuel, (array)$essence) ? 'checked' : '';
                    echo "<input type='checkbox' name='fuel[]' value='$fuel' $checked> " . ucfirst($fuel);
                }
                echo "<br><br>";

                echo "<h4>Boîte de vitesse</h4>";
                echo "<input type='checkbox' name='transmission[]' value='automatique' " . (in_array('automatique', (array)$transmission) ? 'checked' : '') . "> Automatique";
                echo "<input type='checkbox' name='transmission[]' value='manuelle' " . (in_array('manuelle', (array)$transmission) ? 'checked' : '') . "> Manuelle";
                echo "<br><br>";

                echo "<label for='sort'>Trier par</label>";
                echo "<select name='sort_order'>";
                echo "<option value=''>Sélectionner un critère</option>";
                echo "<option value='price_asc' " . ($sort_order == 'price_asc' ? 'selected' : '') . ">Prix croissant</option>";
                echo "<option value='price_desc' " . ($sort_order == 'price_desc' ? 'selected' : '') . ">Prix décroissant</option>";
                echo "<option value='mileage_asc' " . ($sort_order == 'mileage_asc' ? 'selected' : '') . ">Kilométrage croissant</option>";
                echo "<option value='mileage_desc' " . ($sort_order == 'mileage_desc' ? 'selected' : '') . ">Kilométrage décroissant</option>";
                echo "</select><br><br>";

                echo "<button type='submit'>Filtrer</button>";
                echo "</form>";

                if(isset($_SESSION["role"])) {
                    if ($_SESSION["role"]==="vendeur"){
                        echo '<br><form border=1 action="traitementCreerAnnonce.php" method="post">
                        <input type="submit" name="creerannonce" value="Créer une annonce">
                        </form>';
                    }
                }
                ?>
            </div>
        </div>

        <div class="rechercher_voiture"> 
            <?php
            // Identifications de la BDD
            $database = 'agora_francia';

            // Connexion à la BDD
            $db_handle = mysqli_connect('localhost', 'root', '');
            $db_found = mysqli_select_db($db_handle, $database);
            // Traitement des résultats
            if ($db_found) {
                $sql = "SELECT * FROM voiture WHERE 1";

                // Ajout des filtres
                if ($type) {
                    $sql .= " AND Type = '$type'";
                }
                if ($marque) {
                    $sql .= " AND marque = '$marque'";
                }
                if ($annee_min) {
                    $sql .= " AND année >= $annee_min";
                }
                if ($annee_max) {
                    $sql .= " AND année <= $annee_max";
                }
                if ($km_min) {
                    $sql .= " AND Kilometre >= $km_min";
                }
                if ($km_max) {
                    $sql .= " AND Kilometre <= $km_max";
                }
                if (!empty($essence)) {
                    $sql .= " AND moteur IN ('" . implode("','", $essence) . "')";
                }
                if (!empty($transmission)) {
                    $sql .= " AND Boite_de_vitesse IN ('" . implode("','", $transmission) . "')";
                }

                // Ajout du tri
                if ($sort_order) {
                    switch ($sort_order) {
                        case 'price_asc':
                        $sql .= " ORDER BY Prix ASC";
                        break;
                        case 'price_desc':
                        $sql .= " ORDER BY Prix DESC";
                        break;
                        case 'mileage_asc':
                        $sql .= " ORDER BY Kilometre ASC";
                        break;
                        case 'mileage_desc':
                        $sql .= " ORDER BY Kilometre DESC";
                        break;
                    }
                }

                // Exécution de la requête
                $result_requete = mysqli_query($db_handle, $sql);

                while ($data = mysqli_fetch_assoc($result_requete)) {
                    $cheminImage = $data['Image'];
                    $imageAffichage = file_exists($cheminImage) ? "<img src='$cheminImage' height='400' width='600'>" : "<p>Image non trouvée</p>";

                    // Affichage des informations de la voiture
                    echo "<div class='result_item'>";
                    echo $imageAffichage;
                    echo "<h3>" . htmlspecialchars($data['modele']) . "</h3>";
                    echo "<p>Marque : " . htmlspecialchars($data['marque']) . "</p>";
                    echo "<p>Prix : " . htmlspecialchars($data['Prix']) . "€</p>";
                    echo "<p>Kilométrage : " . htmlspecialchars($data['Kilometre']) . " km</p>";
                    echo "<a href='voiture_" . htmlspecialchars($data['ID']) . ".php'><img class='logo' src='Images/loupe.png' alt='Loupe'></a>";
                    echo "<a href='Carte_voiture/Carte_Voiture_" . htmlspecialchars($data['ID']) . ".php'><img class='logo' src='Images/map.png' alt='Localisation'></a>";
                    echo "</div>";
                }
            }
            ?>

        </div>
    </div>
    <!-- Footer -->
    <div id="footer">
        <footer>
            <p>Agora Francia: <br>
                Achat revente de véhicules neufs et d'occasion, comptant et aux enchères<br>
                Copyright &copy; 2024
                <a href="mailto:contact@agorafrancia.fr">Contactez-nous par mail!</a></p>
            </footer>
        </div>
    </body>  
    </html>
