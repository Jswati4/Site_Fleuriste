<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Contact</title>
  <link rel="stylesheet" href="assets/style.css">
  <link href="https://fonts.googleapis.com/css2?family=Oregano&display=swap" rel="stylesheet">
  

</head>

<body>

  <!-- HEADER -->
  <header>
    <div class="header-container">
      <div class="header-left">
        <img src="assets/images/logo.jpg" alt="Logo" class="logo">
      </div>

      <nav class="header-center">
        <a href="index.php">Accueil</a>
        <a href="a_propos.php">À propos</a>
        <a href="boutique.php">Boutique</a>
        <a href="composer.php">Composer mon bouquet</a>
      </nav>

      <div class="header-right">
        <a href="compte.php"><img src="assets/images/user.png" alt="Mon compte" class="icon"></a>
        <a href="panier.php"><img src="assets/images/panier.png" alt="Panier" class="icon"></a>
        <a href="contact.php" class="btn-contact">Contact</a>
      </div>
    </div>
  </header>

  <!-- BANNIÈRE -->
  <section class="banner banner-contact">
    <div class="banner-content">
      <h1>🌸 Parlons fleurs…</h1>
      <p>Vous rêvez d’un décor floral sur-mesure pour un mariage, un événement privé ou professionnel à Paris ou en Île-de-France ? Vous souhaitez offrir un bouquet d’exception ou fleurir un lieu spécial ? Écrivez-nous via ce formulaire ou contactez-nous directement :</p>
      <p>📞 01 42 85 73 21       📧 contact@fleurdelune.fr</p>
      <p>Nous serons ravies de discuter ensemble de votre projet floral.</p>
        
    </div>
  </section>


  <!-- FORMULAIRE DE CONTACT -->
<!-- SECTION FORMULAIRE -->
<section class="contact-form-section">
  <div class="form-container">
    <form action="send_contact.php" method="POST" class="contact-form" novalidate>

      <label for="nom">Nom *</label>
      <input type="text" id="nom" name="nom" required>

      <label for="prenom">Prénom *</label>
      <input type="text" id="prenom" name="prenom" required>

      <label for="email">Email *</label>
      <input type="email" id="email" name="email" required>

      <label for="lieu">Lieu de l'événement *</label>
      <input type="text" id="lieu" name="lieu" required>

      <label for="code_postal">Code postal *</label>
      <input type="text" id="code_postal" name="code_postal" required pattern="\d{5}" title="Veuillez entrer un code postal valide">

      <label for="ville">Ville *</label>
      <input type="text" id="ville" name="ville" required>

      <label for="telephone">Téléphone *</label>
      <input type="tel" id="telephone" name="telephone" required pattern="^(\+?\d{1,3}[- ]?)?\d{9,15}$" title="Veuillez entrer un numéro de téléphone valide">

      <label for="prestation">Type de prestation *</label>
      <input type="text" id="prestation" name="prestation" required>

      <label for="date">Date de l’événement *</label>
<input type="date" id="date" name="date" required min="<?= date('Y-m-d') ?>">


      <label for="invites">Nombre d’invités estimé</label>
      <input type="number" id="invites" name="invites" min="0" step="1">

      <label for="budget">Budget prévu (€)</label>
      <input type="number" id="budget" name="budget" min="0" step="0.01">

      <label for="message">Message complémentaire</label>
      <textarea id="message" name="message" rows="5"></textarea>

      <button type="submit" class="btn-envoyer">Envoyer</button>
    </form>
  </div>
</section>







<!-- FOOTER -->
  <footer>
    <p>&copy; 2025 - La Boutique Fleuriste 🌸</p>
  </footer>