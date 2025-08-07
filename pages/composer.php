<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Composer un bouquet</title>
  <!-- Feuille de style principale -->
  <link rel="stylesheet" href="assets/style.css">
  <!-- Police Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Oregano&display=swap" rel="stylesheet">
</head>

<body>

  <?php include 'composant/header.php'; ?>


  <!-- BANNIÈRE : Présentation de la personnalisation du bouquet -->
  <section class="banner banner-composer">
    <div class="banner-content">
      <h1>Créez votre bouquet unique, inspiré de vos émotions</h1>
      <p>Offrir ou s’offrir un bouquet, c’est bien plus qu’un geste : c’est une déclaration, un murmure, une émotion figée dans le parfum des fleurs. Chez Fleurs de Lune, nous vous invitons à composer une création florale sur mesure, façonnée selon vos envies, vos souvenirs et vos mots doux. Imaginez-le, rêvez-le… et nous lui donnerons vie.</p>
    </div>
  </section>

  <main>
  <h2>Crée ton bouquet personnalisé</h2>
  <!-- Formulaire de personnalisation du bouquet -->
  <form id="formFleurs" class="qcm-section">

    <!-- QCM Form : Choix de la forme du bouquet -->
    <fieldset>
      <legend>1. Quelle forme souhaitez-vous ?</legend>
      <label><input type="radio" name="forme" value="classique" required> Rond (classique et structuré)</label><br>
      <label><input type="radio" name="forme" value="champetre"> Champêtre (libre et sauvage)</label><br>
      <label><input type="radio" name="forme" value="poetique"> Rond flou (aérien et délicat)</label>
    </fieldset>

    <!-- Choix des fleurs (plusieurs possibles) -->
    <fieldset>
      <legend>2. Quelles fleurs souhaitez-vous ? <small>(Choix multiples possibles)</small></legend>
      <label><input type="checkbox" name="fleurs[]" value="rose"> Rose</label><br>
      <label><input type="checkbox" name="fleurs[]" value="tulipes"> Tulipes</label><br>
      <label><input type="checkbox" name="fleurs[]" value="pivoines"> Pivoines</label><br>
      <label><input type="checkbox" name="fleurs[]" value="iris"> Iris</label><br>
      <label><input type="checkbox" name="fleurs[]" value="oeillet"> Lys</label><br>
      <label><input type="checkbox" name="fleurs[]" value="orchidee"> Orchidée</label>
    </fieldset>

    <!-- Choix des couleurs (plusieurs possibles) -->
    <fieldset>
      <legend>3. Quelles couleurs préférez-vous ? <small>(Choix multiples possibles)</small></legend>
      <label><input type="checkbox" name="couleurs[]" value="rouge"> Rouge</label><br>
      <label><input type="checkbox" name="couleurs[]" value="bleu"> Bleu</label><br>
      <label><input type="checkbox" name="couleurs[]" value="violet"> Violet</label><br>
      <label><input type="checkbox" name="couleurs[]" value="rose"> Rose</label><br>
      <label><input type="checkbox" name="couleurs[]" value="jaune"> Jaune</label><br>
      <label><input type="checkbox" name="couleurs[]" value="vert"> Vert</label>
    </fieldset>

    <!-- Choix du feuillage (plusieurs possibles) -->
    <fieldset>
      <legend>4. Type de feuillage <small>(Choix multiples possibles)</small></legend>
      <label><input type="checkbox" name="feuillages[]" value="ruscus"> Ruscus</label><br>
      <label><input type="checkbox" name="feuillages[]" value="graminees"> Graminées</label><br>
      <label><input type="checkbox" name="feuillages[]" value="fougere"> Fougère</label><br>
      <label><input type="checkbox" name="feuillages[]" value="pittosporum"> Pittosporum</label>
    </fieldset>

    <!-- Choix d'ajouter un message personnalisé -->
    <fieldset>
      <legend>5. Souhaitez-vous ajouter un petit mot ?</legend>
      <label><input type="radio" name="message_choix" value="oui" required> Oui</label>
      <label><input type="radio" name="message_choix" value="non"> Non</label>
      
      <!-- Bloc affiché si "Oui" sélectionné -->
      <div id="messageDetails" style="display:none; margin-top:10px;">
        <label for="typeMessage">Type de message :</label>
        <select name="typeMessage" id="typeMessage">
          <option value="je_taime">💌 Je t'aime</option>
          <option value="felicitation">🎉 Félicitations</option>
          <option value="anniversaire">🎈 Joyeux anniversaire</option>
          <option value="remerciement">🙏 Remerciement</option>
          <option value="condoleances">🤍 Condoléances</option>
        </select>
        <br>
        <label for="texteMessage">Votre message :</label><br>
        <textarea name="texteMessage" id="texteMessage" rows="3" cols="40"></textarea>
      </div>
    </fieldset>

    <!-- Catalogue des fleurs avec quantités à choisir -->
    <fieldset>
      <legend>6. Choisissez les fleurs et quantités</legend>
      <div id="catalogue" style="display: flex; flex-direction: column; gap: 10px;"></div>
      <h3 style="margin-top: 20px;">Total : <span id="total">0.00</span> €</h3>
    </fieldset>

    <!-- Choix du budget via un slider -->
    <fieldset>
      <legend>7. Quel est votre budget ?</legend>
      <input type="range" name="budget" min="25" max="200" step="5" value="25" oninput="document.getElementById('valBudget').textContent = this.value + ' €'">
      <span id="valBudget">25 €</span>
      <p style="font-size:0.9em; color:#5B4138;">(Plus vers la droite = bouquet plus cher)</p>
    </fieldset>

    <!-- Bouton de validation du formulaire -->
    <button type="submit">Valider mon bouquet 💐</button>
  </form>
</main>


<!-- JS OUI/ NON QCM BOUQUET -->
<script>
  // Affiche ou masque le bloc message selon le choix Oui/Non
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


  let fleurs = []; // Stocke les fleurs du catalogue
  let total = 0;   // Total du bouquet

  // Charge les fleurs depuis l'API PHP
  fetch('api/get_fleurs.php')
    .then(res => res.json())
    .then(data => {
      fleurs = data;
      const div = document.getElementById('catalogue');
      // Pour chaque fleur, crée un champ quantité
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

      // Ajoute l'événement de calcul du total sur chaque champ quantité
      document.querySelectorAll('#catalogue input[type=number]').forEach(input => {
        input.addEventListener('input', calculerTotal);
      });
    });

  // Calcule le total du bouquet selon les quantités
  function calculerTotal() {
    total = 0;
    fleurs.forEach(fleur => {
      const input = document.querySelector(`input[name="fleur_${fleur.id}"]`);
      const qte = parseInt(input.value) || 0;
      total += qte * fleur.prix;
    });
    document.getElementById('total').textContent = total.toFixed(2);
  }

  // Gestion de la soumission du formulaire
  document.getElementById('formFleurs').addEventListener('submit', function(event) {
    event.preventDefault();

    const form = this;

    // Récupère la forme choisie
    const forme = form.elements['forme'].value;

    // Récupère les fleurs choisies avec quantité
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

    // Vérifie qu'au moins une fleur est choisie
    if (fleursChoisies.length === 0) {
      alert("Veuillez choisir au moins une fleur avec quantité.");
      return;
    }

    // Récupère les couleurs choisies
    const couleurs = Array.from(form.querySelectorAll('input[name="couleurs[]"]:checked')).map(el => el.value);

    // Récupère les feuillages choisis
    const feuillages = Array.from(form.querySelectorAll('input[name="feuillages[]"]:checked')).map(el => el.value);

    // Récupère le choix du message et son contenu
    const messageChoix = form.elements['message_choix'].value;
    const typeMessage = form.elements['typeMessage'].value || '';
    const texteMessage = form.elements['texteMessage'].value || '';

    // Récupère le budget
    const budget = form.elements['budget'].value;

    // Récupère le total affiché
    const total = parseFloat(document.getElementById('total').textContent);

    // Prépare l'objet bouquet personnalisé à envoyer
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
      image: 'bouquet-personnalise.jpg', // Image par défaut
      quantite: 1
    };

    // Envoie le bouquet au panier via API (POST JSON)
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

<!-- FOOTER : Bas de page du site -->
<footer>
  <p>&copy; 2025 - La Boutique Fleuriste 🌸</p>
</footer>

</body>
</html>
