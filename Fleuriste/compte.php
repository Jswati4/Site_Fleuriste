<?php
session_start();
require 'config.php'; // Connexion à la BDD via PDO

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $mdp = $_POST['mdp'] ?? '';

    // Récupération du client depuis la base
    $stmt = $conn->prepare("SELECT * FROM Client WHERE email = ?");
    $stmt->execute([$email]);
    $client = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérification du mot de passe (hash)
    if ($client && password_verify($mdp, $client['mdp'])) {
        $_SESSION['client'] = [
            'id' => $client['id_c'],
            'nom' => $client['nom'],
            'prénom' => $client['prénom']
        ];

        // ✅ Redirection vers l'accueil
        header('Location: index.php');
        exit;
    } else {
        $erreur = "Identifiants incorrects.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion - Fleur de Lune</title>
  <link rel="stylesheet" href="assets/compte.css">
  <style>
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

    .connexion-container {
      background-color: #fffced;
      padding: 40px 30px;
      border-radius: 20px;
      box-shadow: 0 5px 15px rgba(91, 65, 56, 0.3);
      width: 320px;
      text-align: center;
    }

    .connexion-container h2 {
      font-size: 2.5em;
      margin-bottom: 30px;
      color: #5B4138;
    }

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

    .connexion-container button:hover {
      background-color: #5B4138;
    }

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

    <?php if (isset($erreur)): ?>
      <p class="erreur-message"><?= htmlspecialchars($erreur) ?></p>
    <?php endif; ?>

    <form method="POST" action="compte.php">
      <input type="email" name="email" placeholder="E-mail" required />
      <input type="password" name="mdp" placeholder="Mot de passe" required />
      <button type="submit">Se connecter</button>
    </form>
  </div>

  <p class="footer-link">
    Pas encore de compte ? <a href="inscription.php">Inscrivez-vous ici</a>
  </p>


</body>
</html>
