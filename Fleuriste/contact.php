<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Contact</title>
  <!-- Feuille de style principale -->
  <link rel="stylesheet" href="assets/style.css">
  <!-- Police Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Oregano&display=swap" rel="stylesheet">
</head>

<body>

  <!-- HEADER : En-tête du site avec logo, navigation et icônes utilisateur/panier -->
  <header>
    <div class="header-container">
      <div class="header-left">
        <!-- Logo du site -->
        <img src="assets/images/logo.jpg" alt="Logo" class="logo">
      </div>

      <nav class="header-center">
        <!-- Liens de navigation principaux -->
        <a href="index.php">Accueil</a>
        <a href="a_propos.php">À propos</a>
        <a href="boutique.php">Boutique</a>
        <a href="composer.php">Composer mon bouquet</a>
      </nav>

      <div class="header-right">
        <!-- Icônes utilisateur, panier et bouton contact -->
        <a href="compte.php"><img src="assets/images/user.png" alt="Mon compte" class="icon"></a>
        <a href="panier.php"><img src="assets/images/panier.png" alt="Panier" class="icon"></a>
        <a href="contact.php" class="btn-contact">Contact</a>
      </div>
    </div>
  </header>

  <!-- BANNIÈRE : Présentation et coordonnées -->
  <section class="banner banner-contact">
    <div class="banner-content">
      <h1>🌸 Parlons fleurs…</h1>
      <p>Vous rêvez d’un décor floral sur-mesure pour un mariage, un événement privé ou professionnel à Paris ou en Île-de-France ? Vous souhaitez offrir un bouquet d’exception ou fleurir un lieu spécial ? Écrivez-nous via ce formulaire ou contactez-nous directement :</p>
      <p>📞 01 42 85 73 21       📧 contact@fleurdelune.fr</p>
      <p>Nous serons ravies de discuter ensemble de votre projet floral.</p>
    </div>
  </section>

  <!-- FORMULAIRE DE CONTACT : Section pour envoyer une demande -->
  <section class="contact-form-section">
    <div class="form-container">
      <!-- Formulaire de contact, envoi vers send_contact.php -->
      <form action="send_contact.php" method="POST" class="contact-form" novalidate>
        <!-- Champ Nom -->
        <label for="nom">Nom *</label>
        <input type="text" id="nom" name="nom" required>

        <!-- Champ Prénom -->
        <label for="prenom">Prénom *</label>
        <input type="text" id="prenom" name="prenom" required>

        <!-- Champ Email -->
        <label for="email">Email *</label>
        <input type="email" id="email" name="email" required>

        <!-- Champ Lieu de l'événement -->
        <label for="lieu">Lieu de l'événement *</label>
        <input type="text" id="lieu" name="lieu" required>

        <!-- Champ Code postal avec validation -->
        <label for="code_postal">Code postal *</label>
        <input type="text" id="code_postal" name="code_postal" required pattern="\d{5}" title="Veuillez entrer un code postal valide">

        <!-- Champ Ville -->
        <label for="ville">Ville *</label>
        <input type="text" id="ville" name="ville" required>

        <!-- Champ Téléphone avec validation -->
        <label for="telephone">Téléphone *</label>
        <input type="tel" id="telephone" name="telephone" required pattern="^(\+?\d{1,3}[- ]?)?\d{9,15}$" 
        title="Veuillez entrer un numéro de téléphone valide">

        <!-- Champ Type de prestation -->
        <label for="prestation">Type de prestation *</label>
        <input type="text" id="prestation" name="prestation" required>

        <!-- Champ Date de l’événement, date minimale = aujourd'hui -->
        <label for="date">Date de l’événement *</label>
        <input type="date" id="date" name="date" required min="<?= date('Y-m-d') ?>">

        <!-- Champ Nombre d’invités estimé -->
        <label for="invites">Nombre d’invités estimé</label>
        <input type="number" id="invites" name="invites" min="0" step="1">

        <!-- Champ Budget prévu -->
        <label for="budget">Budget prévu (€)</label>
        <input type="number" id="budget" name="budget" min="0" step="0.01">

        <!-- Champ Message complémentaire -->
        <label for="message">Message complémentaire</label>
        <textarea id="message" name="message" rows="5"></textarea>

        <!-- Bouton d'envoi du formulaire -->
        <button type="submit" class="btn-envoyer">Envoyer</button>
      </form>
    </div>
  </section>

  <!-- FOOTER : Pied de page du site -->
  <footer>
    <p>&copy; 2025 - La Boutique Fleuriste 🌸</p>
  </footer>