<?php
$message = "";

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $lines = file('pending_confirmations.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $newLines = [];
    $confirmedEmail = null;

    foreach ($lines as $line) {
        list($email, $storedToken) = explode(',', $line);

        if ($storedToken === $token) {
            $confirmedEmail = $email;
            file_put_contents('emails.txt', $email . PHP_EOL, FILE_APPEND);
        } else {
            $newLines[] = $line;
        }
    }

    file_put_contents('pending_confirmations.txt', implode(PHP_EOL, $newLines) . PHP_EOL);

    if ($confirmedEmail) {
        $message = "Merci, votre inscription est confirmée pour <strong>$confirmedEmail</strong> !";
    } else {
        $message = "Lien de confirmation invalide ou expiré.";
    }
} else {
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
  .confirmation-box {
    background: #fffced;
    padding: 30px 40px;
    border-radius: 15px;
    box-shadow: 0 4px 10px rgba(91, 65, 56, 0.2);
    max-width: 450px;
    text-align: center;
  }
  h1 {
    margin-bottom: 20px;
    color: #F9AAB4;
  }
  p {
    font-size: 1.2em;
  }
  strong {
    color: #5B4138;
  }
</style>
</head>
<body>
  <div class="confirmation-box">
    <h1>🌸 Confirmation d'inscription</h1>
    <p><?= $message ?></p>
  </div>
</body>
</html>
