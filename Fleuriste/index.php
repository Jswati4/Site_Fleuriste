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

  <!-- BANNIÈRE -->
  <section class="banner banner-accueil">
    <div class="banner-content">
      <h1>Fleuriste & Créatrice d’espaces fleuris</h1>
      <p>✨ Des bouquets sur-mesure, pensés comme des poèmes</p>
    </div>
  </section>

 <!-- SECTION BOUQUETS -->
<main>
  <section class="intro-bouquets">
    <h1>🌺 Les fleurs de saison</h1>
    <h2>Fraîcheur et Poésie du moment</h2>
    <p>
      Chaque bouquet est une parenthèse végétale, pensée pour refléter l'instant présent : 
      les teintes du matin, la lumière d’un après-midi d’été, ou la fraîcheur d’un crépuscule de printemps.<br>
      Nos fleurs de saison sont choisies avec soin pour sublimer l’éphémère, 
      et fleurir vos instants les plus précieux.
    </p>
  </section>

  <div id="bouquets" class="bouquet-list"></div>
</main>


<!-- SCRIPT JS BOUQUET -->
<script>
  fetch('api/get_bouquets.php')
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
    <img src="assets/images/panier.png" alt="Ajouter au panier" class="ajouter-panier" onclick="ajouterAuPanier(${b.id})">
  </div>
`;

      });
    });

  function ajouterAuPanier(id) {
    fetch('api/add_to_cart.php', {
      method: 'POST',
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      body: 'id=' + id
    }).then(() => alert("Ajouté au panier !"));
  }
</script>



  <section class="founder-section">
  <div class="founder-images">
    <div class="fond-creme"></div>
    <img src="assets/images/bouquet-rose.jpg" alt="Bouquet rose" class="bouquet-img">
    <img src="assets/images/portrait.jpg" alt="Portrait" class="portrait-img">
  </div>

  <div class="founder-text">
    <h2>🌙 Une âme derrière chaque pétale</h2>
    <p>
      Je suis la fondatrice de Fleur de Lune, une maison florale née d’un désir simple :
      créer des bouquets qui touchent le cœur, racontent une histoire, et laissent un parfum d’instant suspendu.
      <br><br>
      Fleuriste passionnée, je compose chaque arrangement comme une écriture silencieuse. 
      Les fleurs sont mes mots, les couleurs mes émotions. 
      J’aime travailler au rythme des saisons, en laissant la nature me souffler ses palettes et ses textures.
      Mon atelier, situé à Paris, est un espace où la poésie rencontre le végétal — 
      un lieu calme, délicat, où chaque tige est choisie avec soin.
      <br><br>
      Je crois en la beauté des gestes lents, en l’importance du détail, 
      et en la capacité des fleurs à dire ce que les mots ne savent parfois exprimer.
      <br><br>
      <strong>Fleur de Lune</strong>, c’est un peu de moi, beaucoup de vous, et une envie constante de sublimer l’éphémère.
    </p>
  </div>
</section>



<section class="faq">
  <h2>FAQ ?</h2>

  <div class="faq-item">
    <button class="faq-question">Quels types de fleurs proposez-vous ?</button>
    <div class="faq-answer">
      Nous proposons une grande variété : roses, tulipes, pivoines, orchidées, et plus encore selon la saison.
    </div>
  </div>

  <div class="faq-item">
    <button class="faq-question">Livrez-vous à domicile ?</button>
    <div class="faq-answer">
      Oui, nous livrons aux alentours de Paris sans frais & en dehors de Paris avec des
       frais variables selon la distance.
    </div>
  </div>

  <div class="faq-item">
    <button class="faq-question">Puis-je personnaliser un bouquet ?</button>
    <div class="faq-answer">
      Bien sûr ! Avec notre outil "Composer mon bouquet", vous choisissez vos fleurs préférées.
    </div>

    <div class="faq-item">
  <button class="faq-question">Quels sont les délais de livraison ?</button>
  <div class="faq-answer">
    Les commandes passées avant 12h sont livrées le jour même dans les zones éligibles. En France, la livraison se fait sous 24h-48h.
  </div>
</div>


<!-- SCRIPT JS FAQ -->
<script>
  document.querySelectorAll('.faq-question').forEach(button => {
    button.addEventListener('click', () => {
      const answer = button.nextElementSibling;
      answer.style.display = (answer.style.display === 'block') ? 'none' : 'block';
    });
  });
</script>





  </div>
</section>


























<!-- FOOTER -->
  <footer>
    <p>&copy; 2025 - La Boutique Fleuriste 🌸</p>
  </footer>


</body>
</html>
