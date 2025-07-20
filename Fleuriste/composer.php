<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Composer un bouquet</title>
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
  <section class="banner banner-composer">
    <div class="banner-content">
      <h1>Créez votre bouquet unique, inspiré de vos émotions</h1>
      <p>Offrir ou s’offrir un bouquet, c’est bien plus qu’un geste : c’est une déclaration, un murmure, une émotion figée dans le parfum des fleurs. Chez Fleurs de Lune, nous vous invitons à composer une création florale sur mesure, façonnée selon vos envies, vos souvenirs et vos mots doux. Imaginez-le, rêvez-le… et nous lui donnerons vie.</p>
    </div>
  </section>

  <main>
  <h2>Crée ton bouquet personnalisé</h2>
  <form id="formFleurs" class="qcm-section">

    <!-- QCM Form -->
    <fieldset>
      <legend>1. Quelle forme souhaitez-vous ?</legend>
      <label><input type="radio" name="forme" value="classique" required> Rond (classique et structuré)</label><br>
      <label><input type="radio" name="forme" value="champetre"> Champêtre (libre et sauvage)</label><br>
      <label><input type="radio" name="forme" value="poetique"> Rond flou (aérien et délicat)</label>
    </fieldset>

    <fieldset>
      <legend>2. Quelles fleurs souhaitez-vous ? <small>(Choix multiples possibles)</small></legend>
      <label><input type="checkbox" name="fleurs[]" value="rose"> Rose</label><br>
      <label><input type="checkbox" name="fleurs[]" value="tulipes"> Tulipes</label><br>
      <label><input type="checkbox" name="fleurs[]" value="pivoines"> Pivoines</label><br>
      <label><input type="checkbox" name="fleurs[]" value="iris"> Iris</label><br>
      <label><input type="checkbox" name="fleurs[]" value="oeillet"> Lys</label><br>
      <label><input type="checkbox" name="fleurs[]" value="orchidee"> Orchidée</label>
    </fieldset>

    <fieldset>
      <legend>3. Quelles couleurs préférez-vous ? <small>(Choix multiples possibles)</small></legend>
      <label><input type="checkbox" name="couleurs[]" value="rouge"> Rouge</label><br>
      <label><input type="checkbox" name="couleurs[]" value="bleu"> Bleu</label><br>
      <label><input type="checkbox" name="couleurs[]" value="violet"> Violet</label><br>
      <label><input type="checkbox" name="couleurs[]" value="rose"> Rose</label><br>
      <label><input type="checkbox" name="couleurs[]" value="jaune"> Jaune</label><br>
      <label><input type="checkbox" name="couleurs[]" value="vert"> Vert</label>
    </fieldset>

    <fieldset>
      <legend>4. Type de feuillage <small>(Choix multiples possibles)</small></legend>
      <label><input type="checkbox" name="feuillages[]" value="ruscus"> Ruscus</label><br>
      <label><input type="checkbox" name="feuillages[]" value="graminees"> Graminées</label><br>
      <label><input type="checkbox" name="feuillages[]" value="fougere"> Fougère</label><br>
      <label><input type="checkbox" name="feuillages[]" value="pittosporum"> Pittosporum</label>
    </fieldset>

    <fieldset>
      <legend>5. Souhaitez-vous ajouter un petit mot ?</legend>
      <label><input type="radio" name="message_choix" value="oui" required> Oui</label>
      <label><input type="radio" name="message_choix" value="non"> Non</label>
      
      <div id="messageDetails" style="display:none; margin-top:10px;">
        <label for="typeMessage">Type de message :</label>
        <select name="typeMessage" id="typeMessage">
          <option value="je_taime">Je t'aime</option>
          <option value="felicitation">Félicitations</option>
          <option value="anniversaire">Joyeux anniversaire</option>
          <option value="remerciement">Remerciement</option>
          <option value="condoleances">Condoléances</option>
        </select>
        <br>
        <label for="texteMessage">Votre message :</label><br>
        <textarea name="texteMessage" id="texteMessage" rows="3" cols="40"></textarea>
      </div>
    </fieldset>

    <!-- Catalogue fleurs avec quantités -->
    <fieldset>
  <legend>6. Choisissez les fleurs et quantités</legend>
  <div id="catalogue" style="display: flex; flex-direction: column; gap: 10px;"></div>
  <h3 style="margin-top: 20px;">Total : <span id="total">0.00</span> €</h3>
</fieldset>


    <fieldset>
      <legend>7. Quel est votre budget ?</legend>
      <input type="range" name="budget" min="25" max="200" step="5" value="25" oninput="document.getElementById('valBudget').textContent = this.value + ' €'">
      <span id="valBudget">25 €</span>
      <p style="font-size:0.9em; color:#5B4138;">(Plus vers la droite = bouquet plus cher)</p>
    </fieldset>

    <button type="submit">Ajouter au panier</button>
  </form>
</main>


<!-- JS OUI/ NON QCM BOUQUET -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const radios = document.querySelectorAll('input[name="message_choix"]');
    const messageBlock = document.getElementById('messageDetails');

    radios.forEach(function (radio) {
      radio.addEventListener('change', function () {
        if (this.value === 'oui') {
          messageBlock.style.display = 'block';
        } else {
          messageBlock.style.display = 'none';
        }
      });
    });
  });


  let fleurs = [];
  let total = 0;

  // Charger les fleurs depuis ton fichier PHP
  fetch('api/get_fleurs.php')
    .then(res => res.json())
    .then(data => {
      fleurs = data;
      const div = document.getElementById('catalogue');
      data.forEach(fleur => {
        const wrapper = document.createElement('div');
        wrapper.style.display = "flex";
        wrapper.style.alignItems = "center";
        wrapper.style.justifyContent = "space-between";

        wrapper.innerHTML = `
          <label>${fleur.nom} (${fleur.prix} €)</label>
          <input type="number" name="fleur_${fleur.id}" min="0" value="0" style="width: 60px; margin-left: 15px;">
        `;
        div.appendChild(wrapper);
      });

      // Ajouter événement sur tous les champs
      document.querySelectorAll('#catalogue input[type=number]').forEach(input => {
        input.addEventListener('input', calculerTotal);
      });
    });

  // Calcule le total
  function calculerTotal() {
    total = 0;
    fleurs.forEach(fleur => {
      const input = document.querySelector(`input[name="fleur_${fleur.id}"]`);
      const qte = parseInt(input.value) || 0;
      total += qte * fleur.prix;
    });
    document.getElementById('total').textContent = total.toFixed(2);
  }

  document.getElementById('formFleurs').addEventListener('submit', function(event) {
  event.preventDefault();

  const form = this;

  // Récupérer la forme choisie
  const forme = form.elements['forme'].value;

  // Récupérer les fleurs choisies avec quantité
  let fleursChoisies = [];
  fleurs.forEach(fleur => {
    const input = form.querySelector(`input[name="fleur_${fleur.id}"]`);
    const quantite = parseInt(input.value) || 0;
    if (quantite > 0) {
      fleursChoisies.push({
        id: fleur.id,
        nom: fleur.nom,
        prix: fleur.prix,
        quantite: quantite
      });
    }
  });

  if (fleursChoisies.length === 0) {
    alert("Veuillez choisir au moins une fleur avec quantité.");
    return;
  }

  // Couleurs choisies
  const couleurs = Array.from(form.querySelectorAll('input[name="couleurs[]"]:checked')).map(el => el.value);

  // Feuillages choisis
  const feuillages = Array.from(form.querySelectorAll('input[name="feuillages[]"]:checked')).map(el => el.value);

  // Message choisi
  const messageChoix = form.elements['message_choix'].value;
  const typeMessage = form.elements['typeMessage'].value || '';
  const texteMessage = form.elements['texteMessage'].value || '';

  // Budget
  const budget = form.elements['budget'].value;

  // Calcul du total (comme affiché dans la page)
  const total = parseFloat(document.getElementById('total').textContent);

  // Préparer objet bouquet personnalisé
  const bouquetPerso = {
    nom: "Bouquet personnalisé",
    forme: forme,
    fleurs: fleursChoisies,
    couleurs: couleurs,
    feuillages: feuillages,
    messageChoix: messageChoix,
    typeMessage: typeMessage,
    texteMessage: texteMessage,
    budget: budget,
    prix: total,
    image: 'bouquet-personnalise.jpg', // image par défaut (tu peux changer)
    quantite: 1
  };

  // Envoi au panier via fetch POST JSON
  fetch('api/add_to_cart.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(bouquetPerso)
  })
  .then(res => res.json())
  .then(data => {
    if (data.status === 'ok') {
      alert("Votre bouquet personnalisé a été ajouté au panier !");
      form.reset();
      document.getElementById('total').textContent = "0.00";
      document.getElementById('messageDetails').style.display = 'none';
    } else {
      alert("Erreur lors de l'ajout au panier.");
    }
  })
  .catch(() => alert("Erreur réseau."));
});

</script>



<!-- FOOTER -->
  <footer>
    <p>&copy; 2025 - La Boutique Fleuriste 🌸</p>
  </footer>





</body>
</html>
