<?php
// Démarre la session pour accéder aux variables de session
session_start();

// Récupère le panier depuis la session, ou un tableau vide si non défini
$panier = $_SESSION['panier'] ?? [];
$total = 0; // Initialisation du total du panier
$reduction = 0; // Initialisation de la réduction
$code_promo_applique = false; // Indique si un code promo est appliqué
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Mon Panier</title>
  <!-- Lien vers la feuille de style principale -->
  <link rel="stylesheet" href="assets/style.css">
  <style>
    /* Style pour les boutons icônes */
    .bouton-icone {
      background: none;
      border: none;
      font-size: 1.2em;
      cursor: pointer;
      margin: 0 5px;
    }
    .bouton-icone:hover {
      color: darkred;
    }
    /* Style du tableau */
    table {
      border-collapse: collapse;
      width: 90%;
      margin: auto;
    }
    th, td {
      padding: 12px;
      text-align: center;
      border-bottom: 1px solid #ccc;
    }
  </style>
</head>
<body>

<header>
  <h1>🧺 Mon Panier</h1>
</header>

<main>
  <?php if (empty($panier)): ?>
    <!-- Affiche un message si le panier est vide -->
    <p style="text-align:center;">Votre panier est vide.</p>
    <div style="text-align:center;">
      <a href="boutique.php">← Retour à la boutique</a>
    </div>
  <?php else: ?>
    <!-- Affiche le tableau du panier si celui-ci n'est pas vide -->
    <table>
      <tr>
        <th>Image</th>
        <th>Nom</th>
        <th>Prix</th>
        <th>Quantité</th>
        <th>Total</th>
      </tr>

      <?php foreach ($panier as $item): ?>
        <?php
          // Calcule le sous-total pour chaque article
          $sous_total = $item['prix'] * $item['quantite'];
          $total += $sous_total; // Ajoute au total général

          // Vérifie si une réduction est en session et la calcule
          if (isset($_SESSION['reduction'])) {
              $reduction = $total * ($_SESSION['reduction'] / 100);
              $code_promo_applique = true;
          }
        ?>
        <tr>
          <!-- Affiche l'image du produit -->
          <td><img src="assets/images/<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['nom']) ?>" width="80"></td>
          <!-- Affiche le nom du produit -->
          <td><?= htmlspecialchars($item['nom']) ?></td>
          <!-- Affiche le prix unitaire -->
          <td><?= number_format($item['prix'], 2) ?> €</td>
          <!-- Gestion de la quantité avec boutons +, -, supprimer -->
          <td>
            <!-- Bouton pour diminuer la quantité -->
            <form method="post" action="modifier_quantite.php" style="display:inline;">
              <input type="hidden" name="action" value="moins">
              <input type="hidden" name="nom" value="<?= htmlspecialchars($item['nom']) ?>">
              <button type="submit" class="bouton-icone">➖</button>
            </form>

            <!-- Affiche la quantité actuelle -->
            <?= htmlspecialchars($item['quantite']) ?>

            <!-- Bouton pour augmenter la quantité -->
            <form method="post" action="modifier_quantite.php" style="display:inline;">
              <input type="hidden" name="action" value="plus">
              <input type="hidden" name="nom" value="<?= htmlspecialchars($item['nom']) ?>">
              <button type="submit" class="bouton-icone">➕</button>
            </form>

            <!-- Bouton pour supprimer l'article du panier -->
            <form method="post" action="modifier_quantite.php" style="display:inline;">
              <input type="hidden" name="action" value="supprimer">
              <input type="hidden" name="nom" value="<?= htmlspecialchars($item['nom']) ?>">
              <button type="submit" class="bouton-icone">🗑️</button>
            </form>
          </td>
          <!-- Affiche le sous-total de l'article -->
          <td><?= number_format($sous_total, 2) ?> €</td>
        </tr>
      <?php endforeach; ?>

      <?php
        // Recalcule la réduction après la boucle pour le total final
        if (isset($_SESSION['reduction'])) {
          $reduction = $total * ($_SESSION['reduction'] / 100);
          $code_promo_applique = true;
        }
        // Calcule le total final après réduction
        $total_final = $total - $reduction;
      ?>

      <?php if ($code_promo_applique): ?>
        <!-- Affiche la ligne de réduction si un code promo est appliqué -->
        <tr>
          <td colspan="4" align="right">Réduction (<?= htmlspecialchars($_SESSION['code_promo_applique']) ?>) :</td>
          <td>-<?= number_format($reduction, 2) ?> €</td>
        </tr>
      <?php endif; ?>

      <!-- Affiche le total à payer -->
      <tr>
        <td colspan="4" align="right"><strong>Total à payer :</strong></td>
        <td><strong><?= number_format($total_final, 2) ?> €</strong></td>
      </tr>
    </table>

    <!-- Formulaire pour entrer un code promo -->
    <div style="text-align:center; margin-top: 20px;">
      <form method="post" action="appliquer_promo.php" style="display:inline-block;">
        <input type="text" name="code_promo" placeholder="Code promo" required>
        <button type="submit">Appliquer</button>
      </form>
    </div>

    <!-- Affiche un message d'erreur ou de succès pour le code promo -->
    <?php if (isset($_SESSION['promo_message'])): ?>
      <p style="text-align:center; color: darkred;"><?= htmlspecialchars($_SESSION['promo_message']) ?></p>
      <?php unset($_SESSION['promo_message']); // Supprime le message après affichage ?>
    <?php endif; ?>

    <!-- Liens pour continuer les achats ou valider la commande -->
    <div style="text-align:center; margin-top: 30px;">
      <a href="boutique">← Continuer mes achats</a> |
      <a href="checkout"><button type="button">✅ Valider ma commande</button></a>
    </div>
  <?php endif; ?>
</main>

</body>
</html>
