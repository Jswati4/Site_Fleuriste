<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Boutique Fleuriste</title>
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

   <!-- SECTION INTRO BOUTIQUE -->
  <section class="boutique-intro">
    <div class="container">
      <h2>Boutique</h2>
      <p class="subtitle">Des bouquets comme des instants suspendus.</p>
      <p>Chez Fleurs de Lune, chaque création florale est pensée comme une émotion à offrir, à partager, ou à garder pour soi.</p>
      <p>Laissez-vous guider par notre collection de bouquets soigneusement composée, imaginée pour célébrer les instants doux de la vie.</p>
      <p>🌻 Notre sélection en ligne met à l’honneur six créations exclusives, disponibles en trois tailles <em>(S / M / L)</em>, avec des compositions fraîches et de saison.</p>
      <p>🚚 La livraison est offerte dans Paris et ses alentours, pour fleurir vos journées en toute simplicité.</p>
      <img src="assets/images/fleur-gauche.png" alt="Fleur gauche décorative" class="fleur-gauche">
      <img src="assets/images/fleur-droite.png" alt="Fleur droite décorative" class="fleur-droite">
    </div>
  </section>



  <div id="bouquets" class="bouquet-list"></div>
  </main>

  <script>
    fetch('api/get_bouquets_boutique.php')
      .then(res => res.json())
      .then(bouquets => {
        const div = document.getElementById('bouquets');
        bouquets.forEach(b => {
          div.innerHTML += `
            <div class="bouquet">
              <img src="assets/images/${b.image}" alt="${b.nom}">
              <h3>${b.nom}</h3>
              <p class="taille">Taille : ${b.taille}</p>
              <p class="prix">${b.prix} €</p>
              <img src="assets/images/panier.png" alt="Ajouter au panier" class="ajouter-panier" onclick='
              ajouterAuPanier(${JSON.stringify(b)})'>
            </div>
          `;
        });
      });

    function ajouterAuPanier(bouquet) {
  const data = {
    nom: bouquet.nom,
    prix: bouquet.prix,
    image: bouquet.image,
    quantite: 1
  };

  fetch('api/add_to_cart.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(data)
  })
  .then(res => res.json())
  .then(response => {
    if (response.status === 'ok') {
      alert("Ajouté au panier !");
    } else {
      alert("Erreur lors de l'ajout au panier");
    }
  })
  .catch(() => alert("Erreur réseau"));
}
  </script>

  <section class="newsletter">
  <h2>Tenez-vous au courant des nouveautés</h2>
  <p class="sous-titre">Des créations éphémères arrivent régulièrement selon la saison et les inspirations de l’atelier.</p>
  <p class="invitation">Inscrivez-vous pour recevoir nos nouveautés directement dans votre boîte mail ✉️</p>

  <form class="newsletter-form contact-form" onsubmit="event.preventDefault(); inscrireEmail();">
    <input type="email" id="email" placeholder="Votre adresse e-mail" required>
    <button type="submit">Valider</button>
  </form>

  <p class="note">
    ⚠️ <em>Nos bouquets ne sont disponibles à la commande que lorsqu’ils sont en stock.</em>
  </p>
</section>

<script>
  function inscrireEmail() {
    const email = document.getElementById('email').value;
    if (email) {
      alert("Merci pour votre inscription !");
      document.getElementById('email').value = '';
    }
  }
</script>






<!-- FOOTER -->
  <footer>
    <p>&copy; 2025 - La Boutique Fleuriste 🌸</p>
  </footer>


</body>
</html>






