<?php
// Traitement AJAX côté serveur
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *'); // Pour tests ou usage distant

    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    if ($email) {
        $file = fopen('emails.txt', 'a');
        fwrite($file, $email . PHP_EOL);
        fclose($file);
        echo json_encode(['success' => true]);
    } else {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Adresse e-mail invalide']);
    }

    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Newsletter - Fleur de Lune</title>
  <style>
    body {
      font-family: 'Arial', sans-serif;
      background-color: #fff8f0;
      padding: 40px;
      color: #5B4138;
    }

    .container {
      max-width: 500px;
      margin: auto;
      background: #fffced;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 4px 10px rgba(91, 65, 56, 0.2);
      text-align: center;
    }

    h2 {
      margin-bottom: 10px;
    }

    input[type="email"] {
      width: 80%;
      padding: 10px;
      margin: 20px 0;
      border-radius: 8px;
      border: 1px solid #ccc;
    }

    button {
      padding: 10px 20px;
      background-color: #F9AAB4;
      color: white;
      border: none;
      border-radius: 25px;
      font-size: 1em;
      cursor: pointer;
    }

    button:hover {
      background-color: #5B4138;
    }

    .note {
      font-size: 0.9em;
      margin-top: 15px;
      color: #7a5b4b;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>🌸 Inscription à la newsletter</h2>
  <p>Recevez nos créations florales et inspirations directement dans votre boîte mail.</p>

  <form id="newsletterForm" onsubmit="return false;">
      <input type="email" id="email" placeholder="Votre adresse email" required />
      <br>
      <button type="submit" onclick="inscrireEmail()">S’inscrire</button>
  </form>

  <p class="note">⚠️ Les bouquets sont disponibles uniquement lorsqu’ils sont en stock.</p>
</div>

<script>
  function inscrireEmail() {
    const email = document.getElementById('email').value.trim();

    if (!email) {
      alert("Veuillez entrer une adresse e-mail.");
      return;
    }

    fetch('newsletter.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: 'email=' + encodeURIComponent(email)
    })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        alert("Merci pour votre inscription 🌸 !");
        document.getElementById('email').value = '';
      } else {
        alert("Erreur : " + (data.message || 'Veuillez réessayer.'));
      }
    })
    .catch(() => {
      alert("Une erreur est survenue, merci de réessayer.");
    });
  }
</script>

</body>
</html>
