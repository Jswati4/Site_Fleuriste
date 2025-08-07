<?php
// Initialise la variable du message à afficher
$message = "";

// Vérifie si le paramètre 'token' est présent dans l'URL
if (isset($_GET['token'])) {
  $token = $_GET['token']; // Récupère le token depuis l'URL

  // Lit toutes les lignes du fichier des confirmations en attente
  $lines = file('pending_confirmations.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
  $newLines = []; // Stockera les lignes restantes après suppression
  $confirmedEmail = null; // Stockera l'email confirmé si trouvé

  // Parcourt chaque ligne du fichier
  foreach ($lines as $line) {
    // Sépare l'email et le token stocké
    list($email, $storedToken) = explode(',', $line);

    // Si le token correspond à celui fourni
    if ($storedToken === $token) {
      $confirmedEmail = $email; // Sauvegarde l'email confirmé
      // Ajoute l'email au fichier des emails confirmés
      file_put_contents('emails.txt', $email . PHP_EOL, FILE_APPEND);
    } else {
      // Sinon, garde la ligne pour la réécriture du fichier
      $newLines[] = $line;
    }
  }

  // Réécrit le fichier des confirmations en attente sans la ligne confirmée
  file_put_contents('pending_confirmations.txt', implode(PHP_EOL, $newLines) . PHP_EOL);

  // Affiche le message de confirmation ou d'erreur selon le résultat
  if ($confirmedEmail) {
    $message = "Merci, votre inscription est confirmée pour <strong>$confirmedEmail</strong> !";
  } else {
    $message = "Lien de confirmation invalide ou expiré.";
  }
} else {
  // Si aucun token n'est fourni dans l'URL
  $message = "Token manquant.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Confirmation d'inscription - Fleur de Lune</title>
<style>
  /* Style général de la page */
  body {
  background-color: #fff8f0;
  color: #5B4138;
  font-family: 'Arial', sans-serif;
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  margin: 0;
  }
  /* Boîte de confirmation */
  .confirmation-box {
  background: #fffced;
  padding: 30px 40px;
  border-radius: 15px;
  box-shadow: 0 4px 10px rgba(91, 65, 56, 0.2);
  max-width: 450px;
  text-align: center;
  }
  /* Titre */
  h1 {
  margin-bottom: 20px;
  color: #F9AAB4;
  }
  /* Paragraphe */
  p {
  font-size: 1.2em;
  }
  /* Texte en gras */
  strong {
  color: #5B4138;
  }
</style>
</head>
<body>
  <!-- Affichage du message de confirmation ou d'erreur -->
  <div class="confirmation-box">
  <h1>🌸 Confirmation d'inscription</h1>
  <p><?= $message ?></p>
  </div>
</body>
</html>
