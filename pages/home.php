<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Boutique Fleuriste</title>
  <!-- Feuille de style principale -->
  <link rel="stylesheet" href="assets/style.css">
  <!-- Police Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Oregano&display=swap" rel="stylesheet">
</head>

<body>
<?php include 'composant/header.php'; ?>

  <!-- BANNIÈRE : Section d'accroche avec titre et slogan -->
  <section class="banner banner-accueil">
    <div class="banner-content">
      <h1>Fleuriste & Créatrice d’espaces fleuris</h1>
      <p>✨ Des bouquets sur-mesure, pensés comme des poèmes</p>
    </div>
  </section>

 <!-- SECTION BOUQUETS : Présentation des fleurs de saison -->
<main>
  <section class="intro-bouquets">
    <h1>🌺 Les fleurs de saison</h1>
    <h2>Fraîcheur et Poésie du moment</h2>
    <p>
      <!-- Texte d'introduction sur les bouquets de saison -->
      Chaque bouquet est une parenthèse végétale, pensée pour refléter l'instant présent : 
      les teintes du matin, la lumière d’un après-midi d’été, ou la fraîcheur d’un crépuscule de printemps.<br>
      Nos fleurs de saison sont choisies avec soin pour sublimer l’éphémère, 
      et fleurir vos instants les plus précieux.
    </p>
  </section>

  <!-- Liste des bouquets affichée dynamiquement en JS -->
  <div id="bouquets" class="bouquet-list"></div>
</main>


<!-- SCRIPT JS BOUQUET : Récupère et affiche les bouquets depuis l'API -->
<script>
  // Fonction pour ajouter un bouquet au panier
  function ajouterAuPanier(id) {
    fetch('api/add_to_cart.php', {  // adapte le chemin selon ton API
      method: 'POST',
      headers: {'Content-Type': 'application/x-www-form-urlencoded'},
      body: 'id=' + encodeURIComponent(id)
    })
    .then(response => response.text())
    .then(() => alert("Ajouté au panier !"))
    .catch(err => alert("Erreur lors de l'ajout au panier."));
  }

  // Récupérer et afficher les bouquets
  fetch('api/get_bouquets.php')
    .then(res => res.json())
    .then(bouquets => {
      const div = document.getElementById('bouquets');
      bouquets.forEach(b => {
        // Génère dynamiquement le HTML pour chaque bouquet
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
    })
    .catch(err => console.error('Erreur chargement bouquets:', err));
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
      <!-- Présentation de la fondatrice -->
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

  <!-- Question 1 -->
  <div class="faq-item">
    <button class="faq-question">Quels types de fleurs proposez-vous ?</button>
    <div class="faq-answer">
      Nous proposons une grande variété : roses, tulipes, pivoines, orchidées, et plus encore selon la saison.
    </div>
  </div>

  <!-- Question 2 -->
  <div class="faq-item">
    <button class="faq-question">Livrez-vous à domicile ?</button>
    <div class="faq-answer">
      Oui, nous livrons aux alentours de Paris sans frais & en dehors de Paris avec des
       frais variables selon la distance.
    </div>
  </div>

  <!-- Question 3 -->
  <div class="faq-item">
    <button class="faq-question">Puis-je personnaliser un bouquet ?</button>
    <div class="faq-answer">
      Bien sûr ! Avec notre outil "Composer mon bouquet", vous choisissez vos fleurs préférées.
    </div>

    <!-- Question 4 -->
    <div class="faq-item">
      <button class="faq-question">Quels sont les délais de livraison ?</button>
      <div class="faq-answer">
        Les commandes passées avant 12h sont livrées le jour même dans les zones éligibles. En France, la livraison se fait sous 24h-48h.
      </div>
    </div>
  </div>
</section>

<!-- SCRIPT JS FAQ : Affiche/réduit les réponses -->
<script>
  document.querySelectorAll('.faq-question').forEach(button => {
    button.addEventListener('click', () => {
      const answer = button.nextElementSibling;
      // Affiche ou masque la réponse associée
      answer.style.display = (answer.style.display === 'block') ? 'none' : 'block';
    });
  });
</script>

<!-- FOOTER -->
<footer>
  <p>&copy; 2025 - La Boutique Fleuriste 🌸</p>
</footer>

</body>
</html>
