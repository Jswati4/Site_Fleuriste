<?php
// Démarre la session PHP pour gérer les variables de session (connexion utilisateur)
session_start();

// Inclut le fichier de configuration pour la connexion à la base de données (BDD) via PDO
require 'config.php'; // Connexion à la BDD via PDO

// Vérifie si le formulaire a été soumis en méthode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Récupère l'email et le mot de passe envoyés par le formulaire (ou chaîne vide si non définis)
  $email = $_POST['email'] ?? '';
  $mdp = $_POST['mdp'] ?? '';

  // Prépare une requête SQL pour récupérer le client correspondant à l'email
  $stmt = $conn->prepare("SELECT * FROM Client WHERE email = ?");
  $stmt->execute([$email]);
  $client = $stmt->fetch(PDO::FETCH_ASSOC);

  // Vérifie si le client existe et si le mot de passe saisi correspond au hash stocké
  if ($client && password_verify($mdp, $client['mdp'])) {
    // Stocke les informations du client dans la session pour maintenir la connexion
    $_SESSION['client'] = [
      'id' => $client['id_c'],
      'nom' => $client['nom'],
      'prenom' => $client['prenom']
    ];

    // Redirige l'utilisateur vers la page d'accueil après connexion réussie
    header('Location: index.php');
    exit;
  } else {
    // Affiche un message d'erreur si les identifiants sont incorrects
    $erreur = "Identifiants incorrects.";
  }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion - Fleur de Lune</title>
  <!-- Lien vers la feuille de style externe -->
  <link rel="stylesheet" href="assets/compte.css">
  <style>
  /* Style général de la page */
  body {
    background-color: #fff8e7;
    font-family: 'Arial', sans-serif;
    color: #5B4138;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
  }

  /* Style du conteneur de connexion */
  .connexion-container {
    background-color: #fffced;
    padding: 40px 30px;
    border-radius: 20px;
    box-shadow: 0 5px 15px rgba(91, 65, 56, 0.3);
    width: 320px;
    text-align: center;
  }

  /* Titre du formulaire */
  .connexion-container h2 {
    font-size: 2.5em;
    margin-bottom: 30px;
    color: #5B4138;
  }

  /* Style des champs de saisie */
  .connexion-container input {
    width: 100%;
    padding: 12px 15px;
    margin-bottom: 20px;
    border-radius: 12px;
    border: 2px solid #F9AAB4;
    font-size: 1.1em;
    color: #5B4138;
    box-sizing: border-box;
  }

  /* Style du bouton de connexion */
  .connexion-container button {
    width: 100%;
    background-color: #F9AAB4;
    color: white;
    border: none;
    padding: 12px 0;
    font-size: 1.2em;
    border-radius: 30px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  /* Effet au survol du bouton */
  .connexion-container button:hover {
    background-color: #5B4138;
  }

  /* Style du message d'erreur */
  .erreur-message {
    color: red;
    margin-bottom: 15px;
    font-weight: bold;
  }
  </style>
</head>
<body>

   <div class="connexion-container">
  <h2>Connexion</h2>

  <!-- Affiche le message d'erreur si présent -->
  <?php if (isset($erreur)): ?>
    <p class="erreur-message"><?= htmlspecialchars($erreur) ?></p>
  <?php endif; ?>

  <!-- Formulaire de connexion -->
  <form method="POST" action="compte.php">
    <input type="email" name="email" placeholder="E-mail" required />
    <div style="position: relative;">
    <!-- Champ mot de passe et case à cocher pour afficher/masquer le mot de passe -->
    <input type="password" name="mdp" id="mdp" placeholder="Mot de passe" required />
    <input type="checkbox" id="togglePassword" 
         style="position: absolute; top: 32%; right: 15px; transform: translateY(-50%); width: 30px; cursor: pointer;">
    </div>

    <button type="submit">Se connecter</button>
  </form>
  </div>

  <!-- Lien vers la page d'inscription -->
  <p class="footer-link">
  Pas encore de compte ? <a href="inscription">Inscrivez-vous ici</a>
  </p>

<script>
  // Script pour afficher/masquer le mot de passe lors du clic sur la case à cocher
  const togglePassword = document.getElementById("togglePassword");
  const passwordInput = document.getElementById("mdp");

  togglePassword.addEventListener("change", () => {
  passwordInput.type = togglePassword.checked ? "text" : "password";
  });
</script>

</body>
</html>
