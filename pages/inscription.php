<?php
require 'config.php'; // Connexion à la base de données

$erreur = ''; // Variable pour stocker les messages d'erreur
$success = ''; // Variable pour stocker les messages de succès

// Vérifie si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id_c = uniqid("C"); // Génère un identifiant client unique

  // Récupère les données du formulaire ou met une chaîne vide si non renseigné
  $nom = $_POST['nom'] ?? '';
  $prenom = $_POST['prenom'] ?? '';
  $email = $_POST['email'] ?? '';
  $adresse = $_POST['adresse'] ?? '';
  $tel = $_POST['tel'] ?? '';
  $mdp = $_POST['mdp'] ?? '';
  $mdp_conf = $_POST['mdp_conf'] ?? '';

  // Vérifie si les mots de passe correspondent
  if ($mdp !== $mdp_conf) {
    $erreur = "Les mots de passe ne correspondent pas."; // Message d'erreur si les mots de passe ne sont pas identiques
  } else {
    $hash = password_hash($mdp, PASSWORD_DEFAULT); // Hash le mot de passe

    // Prépare la requête d'insertion
    $stmt = $conn->prepare("INSERT INTO Client (id_c, nom, prenom, email, adresse, num_de_tel, mdp) VALUES (?, ?, ?, ?, ?, ?, ?)");
    try {
      // Exécute la requête avec les données du formulaire
      $stmt->execute([$id_c, $nom, $prenom, $email, $adresse, $tel, $hash]);
      $success = "Inscription réussie. Vous pouvez vous connecter."; // Message de succès

      // ✅ Envoi d'un e-mail de confirmation
      $to = $email; // Destinataire
      $subject = "Bienvenue chez notre Fleuriste 🌸"; // Sujet de l'e-mail
      $message = "Bonjour $prenom,\n\nMerci pour votre inscription !\nÀ bientôt sur notre site."; // Corps du message
      $headers = "From: contact@fleuriste.local"; // Expéditeur

      mail($to, $subject, $message, $headers); // Envoie l'e-mail

    } catch (PDOException $e) {
      $erreur = "Erreur : " . $e->getMessage(); // Affiche l'erreur SQL
    }
  }

  // ✅ Redirection vers l'accueil après inscription
  header('Location: index.php'); // Redirige vers la page d'accueil
  exit; // Termine le script
} else {
  $erreur = "Identifiants incorrects."; // Message si la méthode n'est pas POST
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <link rel="stylesheet" href="assets/inscription.css"> <!-- Lien vers le CSS -->
  <meta charset="UTF-8">
  <title>Inscription</title>
</head>
<body>

  <div class="inscription-container">
  <h2>Inscription</h2>

  <!-- Affiche les messages d'erreur ou de succès -->
  <?php if (isset($erreur)): ?>
    <p class="erreur-message"><?= htmlspecialchars($erreur) ?></p>
  <?php elseif (isset($success)): ?>
    <p class="success-message"><?= htmlspecialchars($success) ?></p>
  <?php endif; ?>

  <!-- Formulaire d'inscription -->
  <form method="POST" action="inscription">
    <input type="text" name="nom" placeholder="Nom" required /> <!-- Champ nom -->
    <input type="text" name="prenom" placeholder="Prénom" required /> <!-- Champ prénom -->
    <input type="email" name="email" placeholder="E-mail" required /> <!-- Champ email -->
    <input type="text" name="adresse" placeholder="Adresse" required /> <!-- Champ adresse -->
    <input type="text" name="tel" placeholder="Téléphone" required /> <!-- Champ téléphone -->

    <!-- Champ mot de passe avec affichage/masquage -->
    <div style="position: relative;">
    <input type="password" id="mdp" name="mdp" placeholder="Mot de passe" required /> <!-- Champ mot de passe -->
    <input type="checkbox" id="togglePassword" 
         style="position: absolute; top: 32%; right: 15px; transform: translateY(-50%); width: 30px; cursor: pointer;"> <!-- Checkbox pour afficher/masquer le mot de passe -->
    </div>

    <!-- Champ confirmation mot de passe avec affichage/masquage -->
    <div style="position: relative;">
    <input type="password" id="mdp_conf" name="mdp_conf" placeholder="Confirmer le mot de passe" required /> <!-- Champ confirmation mot de passe -->
    <input type="checkbox" id="togglePassword2" 
         style="position: absolute; top: 32%; right: 15px; transform: translateY(-50%); width: 30px; cursor: pointer;"> <!-- Checkbox pour afficher/masquer la confirmation -->
    </div>

    <button type="submit">S’inscrire</button> <!-- Bouton d'inscription -->
  </form>

  <!-- Lien vers la page de connexion -->
  <p class="footer-link">
    Déjà un compte ? <a href="compte">Connectez-vous ici</a>
  </p>
  </div>

  <!-- Script pour afficher/masquer les mots de passe -->
  <script>
  const togglePassword = document.getElementById("togglePassword"); // Checkbox mot de passe
  const togglePassword2 = document.getElementById("togglePassword2"); // Checkbox confirmation
  const pwd1 = document.getElementById("mdp"); // Champ mot de passe
  const pwd2 = document.getElementById("mdp_conf"); // Champ confirmation

  // Affiche ou masque le mot de passe principal
  togglePassword.addEventListener("change", () => {
    pwd1.type = togglePassword.checked ? "text" : "password";
  });

  // Affiche ou masque la confirmation du mot de passe
  togglePassword2.addEventListener("change", () => {
    pwd2.type = togglePassword2.checked ? "text" : "password";
  });
  </script>

</body>
</html>
