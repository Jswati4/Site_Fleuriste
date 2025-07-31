<?php
require 'config.php'; // Connexion BDD

$erreur = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_c = uniqid("C"); // ID client unique
   $nom = $_POST['nom'] ?? '';
   $prenom = $_POST['prenom'] ?? '';
   $email = $_POST['email'] ?? '';
   $adresse = $_POST['adresse'] ?? '';
   $tel = $_POST['tel'] ?? '';
   $mdp = $_POST['mdp'] ?? '';
   $mdp_conf = $_POST['mdp_conf'] ?? '';


    if ($mdp !== $mdp_conf) {
        $erreur = "Les mots de passe ne correspondent pas.";
    } else {
        $hash = password_hash($mdp, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO Client (id_c, nom, prenom, email, adresse, num_de_tel, mdp) VALUES (?, ?, ?, ?, ?, ?, ?)");
        try {
            $stmt->execute([$id_c, $nom, $prenom, $email, $adresse, $tel, $hash]);
            $success = "Inscription réussie. Vous pouvez vous connecter.";

// ✅ Envoi d'un e-mail de confirmation
$to = $email;
$subject = "Bienvenue chez notre Fleuriste 🌸";
$message = "Bonjour $prenom,\n\nMerci pour votre inscription !\nÀ bientôt sur notre site.";
$headers = "From: contact@fleuriste.local";

mail($to, $subject, $message, $headers);

        } catch (PDOException $e) {
            $erreur = "Erreur : " . $e->getMessage();
        }
    }

    // ✅ Redirection vers l'accueil
        header('Location: index.php');
        exit;
    } else {
        $erreur = "Identifiants incorrects.";
    }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <link rel="stylesheet" href="assets/inscription.css">
  <meta charset="UTF-8">
  <title>Inscription</title>
</head>
<body>

  <div class="inscription-container">
    <h2>Inscription</h2>

    <!-- messages erreur ou succès ici -->
    <?php if (isset($erreur)): ?>
      <p class="erreur-message"><?= htmlspecialchars($erreur) ?></p>
    <?php elseif (isset($success)): ?>
      <p class="success-message"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>


  <form method="POST" action="inscription.php">
  <input type="text" name="nom" placeholder="Nom" required />
  <input type="text" name="prenom" placeholder="Prénom" required />
  <input type="email" name="email" placeholder="E-mail" required />
  <input type="text" name="adresse" placeholder="Adresse" required />
  <input type="text" name="tel" placeholder="Téléphone" required />

  <div style="position: relative;">
    <input type="password" id="mdp" name="mdp" placeholder="Mot de passe" required />
    <input type="checkbox" id="togglePassword" 
           style="position: absolute; top: 32%; right: 15px; transform: translateY(-50%); width: 30px; cursor: pointer;">
  </div>

  <div style="position: relative;">
    <input type="password" id="mdp_conf" name="mdp_conf" placeholder="Confirmer le mot de passe" required />
    <input type="checkbox" id="togglePassword2" 
           style="position: absolute; top: 32%; right: 15px; transform: translateY(-50%); width: 30px; cursor: pointer;">
  </div>

  <button type="submit">S’inscrire</button>
</form>




    <p class="footer-link">
      Déjà un compte ? <a href="compte.php">Connectez-vous ici</a>
    </p>

    
  </div>


 <script>
  const togglePassword = document.getElementById("togglePassword");
  const togglePassword2 = document.getElementById("togglePassword2");
  const pwd1 = document.getElementById("mdp");
  const pwd2 = document.getElementById("mdp_conf");

  togglePassword.addEventListener("change", () => {
    pwd1.type = togglePassword.checked ? "text" : "password";
  });

  togglePassword2.addEventListener("change", () => {
    pwd2.type = togglePassword2.checked ? "text" : "password";
  });
</script>




</body>

</html>
