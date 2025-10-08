<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'agora_francia');
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

if (isset($_POST['buttonConnexion'])) {
    $login = $_POST['login'];
    $motdepasse = $_POST['motdepasse'];
    $role = $_POST['role'];
    if ($role == "acheteur") {
        $stmt = $conn->prepare("SELECT client_ID, client_motdepasse, client_nom, client_prenom, client_sexe, client_datedenaissance, client_telephone, client_profession, client_adresse1, client_adresse2, client_ville, client_codepostal, client_pays FROM clients WHERE client_login = ?");
    } elseif ($role == "vendeur") {
        $stmt = $conn->prepare("SELECT vendeur_ID, vendeur_motdepasse, vendeur_nom, vendeur_prenom, vendeur_sexe, vendeur_datedenaissance, vendeur_telephone, vendeur_profession, vendeur_adresse1, vendeur_adresse2, vendeur_ville, vendeur_codepostal, vendeur_pays FROM vendeurs WHERE vendeur_login = ?");
    } elseif ($role == "admin") {
        $stmt = $conn->prepare("SELECT admin_ID, admin_nom, admin_prenom, admin_sexe, admin_login, admin_motdepasse FROM admins WHERE admin_login = ?");
    } else {
        header('Location: connexionpage.php?error=Rôle invalide.');
        exit();
    }
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        if ($role == "acheteur") {
            $stmt->bind_result($ID, $hashed_password, $nom, $prenom, $sexe, $datedenaissance, $telephone, $profession, $adresse1, $adresse2, $ville, $codepostal, $pays);
            $stmt->fetch();
            if (password_verify($motdepasse, $hashed_password)) {
                $_SESSION['ID'] = $ID;
                $_SESSION['login'] = $login;
                $_SESSION['nom'] = $nom;
                $_SESSION['prenom'] = $prenom;
                $_SESSION['sexe'] = $sexe;
                $_SESSION['datedenaissance'] = $datedenaissance;
                $_SESSION['telephone'] = $telephone;
                $_SESSION['profession'] = $profession;
                $_SESSION['adresse1'] = $adresse1;
                $_SESSION['adresse2'] = $adresse2;
                $_SESSION['ville'] = $ville;
                $_SESSION['codepostal'] = $codepostal;
                $_SESSION['pays'] = $pays;
                $_SESSION['role'] = $role;
                header('Location: homepage.php');
                exit();
            }
        } elseif ($role == "vendeur") {
            $stmt->bind_result($ID, $hashed_password, $nom, $prenom, $sexe, $datedenaissance, $telephone, $profession, $adresse1, $adresse2, $ville, $codepostal, $pays);
            $stmt->fetch();
            if (password_verify($motdepasse, $hashed_password)) {
                $_SESSION['ID'] = $ID;
                $_SESSION['login'] = $login;
                $_SESSION['nom'] = $nom;
                $_SESSION['prenom'] = $prenom;
                $_SESSION['sexe'] = $sexe;
                $_SESSION['datedenaissance'] = $datedenaissance;
                $_SESSION['telephone'] = $telephone;
                $_SESSION['profession'] = $profession;
                $_SESSION['adresse1'] = $adresse1;
                $_SESSION['adresse2'] = $adresse2;
                $_SESSION['ville'] = $ville;
                $_SESSION['codepostal'] = $codepostal;
                $_SESSION['pays'] = $pays;
                $_SESSION['role'] = $role;
                header('Location: homepage.php');
                exit();
            }
        } elseif ($role == "admin") {
            $stmt->bind_result($ID, $nom, $prenom, $sexe, $login, $plain_password);
            $stmt->fetch();
            if ($motdepasse == $plain_password) {
                $_SESSION['ID'] = $ID;
                $_SESSION['login'] = $login;
                $_SESSION['nom'] = $nom;
                $_SESSION['prenom'] = $prenom;
                $_SESSION['sexe'] = $sexe;
                $_SESSION['role'] = $role;
                header('Location: homepage.php');
                exit();
            }
        }
        header('Location: connexionpage.php?error=Mot de passe incorrect.');
        exit();
    } else {
        header('Location: connexionpage.php?error=Aucun compte trouvé avec cet identifiant.');
        exit();
    }
    $stmt->close();
}

// Inscription
if (isset($_POST['buttonNewaccount'])) {
    $nom = $_POST['client_nom'];
    $prenom = $_POST['client_prenom'];
    $sexe = $_POST['client_sexe'];
    $datedenaissance = $_POST['client_datedenaissance'];
    $login = $_POST['client_login'];
    $motdepasse = $_POST['client_motdepasse'];
    $confirm_motdepasse = $_POST['client_confirm_motdepasse'];
    $telephone = $_POST['client_telephone'];
    $profession = $_POST['client_profession'];
    $adresse1 = $_POST['client_adresse1'];
    $adresse2 = $_POST['client_adresse2'];
    $ville = $_POST['client_ville'];
    $codepostal = $_POST['client_codepostal'];
    $pays = $_POST['client_pays'];
    $role = $_POST['role'];
    if ($motdepasse === $confirm_motdepasse) {
        $motdepasse_hash = password_hash($motdepasse, PASSWORD_BCRYPT);
        if ($role === "acheteur") {
            $check_stmt = $conn->prepare("SELECT client_ID FROM clients WHERE client_login = ?");
        } elseif ($role === "vendeur") {
            $check_stmt = $conn->prepare("SELECT vendeur_ID FROM vendeurs WHERE vendeur_login = ?");
        } else {
            header('Location: connexionpage.php?error=Rôle invalide.');
            exit();
        }
        $check_stmt->bind_param("s", $login);
        $check_stmt->execute();
        $check_stmt->store_result();
        if ($check_stmt->num_rows > 0) {
            header('Location: connexionpage.php?error=Un utilisateur avec cet email existe déjà.');
            exit();
        } else {
            if ($role === "acheteur") {
                $stmt = $conn->prepare("INSERT INTO clients (client_nom, client_prenom, client_sexe, client_datedenaissance, client_login, client_motdepasse, client_telephone, client_profession, client_adresse1, client_adresse2, client_ville, client_codepostal, client_pays) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            } elseif ($role === "vendeur") {
                $stmt = $conn->prepare("INSERT INTO vendeurs (vendeur_nom, vendeur_prenom, vendeur_sexe, vendeur_datedenaissance, vendeur_login, vendeur_motdepasse, vendeur_telephone, vendeur_profession, vendeur_adresse1, vendeur_adresse2, vendeur_ville, vendeur_codepostal, vendeur_pays) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            }
            $stmt->bind_param("sssssssssssss", $nom, $prenom, $sexe, $datedenaissance, $login, $motdepasse_hash, $telephone, $profession, $adresse1, $adresse2, $ville, $codepostal, $pays);
            if ($stmt->execute()) {
                header('Location: connexionpage.php?error=Votre compte a été créé avec succès.');
                exit();
            } else {
                header('Location: connexionpage.php?error=Erreur lors de la création du compte : ' . $stmt->error);
                exit();
            }
            $stmt->close();
        }
        $check_stmt->close();
    } else {
        header('Location: connexionpage.php?error=Les mots de passe ne correspondent pas.');
        exit();
    }
}
$conn->close();
?>
