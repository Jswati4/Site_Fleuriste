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
        $stmt = $conn->prepare("INSERT INTO Client (id_c, nom, prénom, email, adresse, num_de_tel, mdp) VALUES (?, ?, ?, ?, ?, ?, ?)");
        try {
            $stmt->execute([$id_c, $nom, $prenom, $email, $adresse, $tel, $hash]);
            $success = "Inscription réussie. Vous pouvez vous connecter.";
        } catch (PDOException $e) {
            $erreur = "Erreur : " . $e->getMessage();
        }
    }
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
      <input type="text" name="prénom" placeholder="Prénom" required />
      <input type="email" name="email" placeholder="E-mail" required />
      <input type="password" name="mdp" placeholder="Mot de passe" required />
      <input type="password" name="mdp_confirm" placeholder="Confirmer le mot de passe" required />
      <button type="submit">S’inscrire</button>
    </form>

    <p class="footer-link">
      Déjà un compte ? <a href="compte.php">Connectez-vous ici</a>
    </p>

    
  </div>

</body>

</html>
