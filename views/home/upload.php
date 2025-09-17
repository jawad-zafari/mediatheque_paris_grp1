<!-- Formulaire -->
<form method="POST" enctype="multipart/form-data">
  <label>Type de média :</label>
  <select name="type">
    <option value="">-- Choisir --</option>
    <option value="livre" <?= ($type==='livre'?'selected':'') ?>>Livre</option>
    <option value="film"  <?= ($type==='film'?'selected':'')  ?>>Film</option>
    <option value="jeu"   <?= ($type==='jeu'?'selected':'')   ?>>Jeu vidéo</option>
  </select>
  <br><br>

  <?php if ($type==='livre'): ?>
    Auteur : <input name="auteur" value="<?= e($data['auteur'] ?? '') ?>"><br>
    ISBN : <input name="isbn" value="<?= e($data['isbn'] ?? '') ?>"><br>
    Pages : <input type="number" name="pages" value="<?= e($data['pages'] ?? '') ?>"><br>
    Année : <input type="number" name="annee" value="<?= e($data['annee'] ?? '') ?>"><br>

  <?php elseif ($type==='film'): ?>
    Réalisateur : <input name="realisateur" value="<?= e($data['realisateur'] ?? '') ?>"><br>
    Durée (min) : <input type="number" name="duree" value="<?= e($data['duree'] ?? '') ?>"><br>
    Année : <input type="number" name="annee" value="<?= e($data['annee'] ?? '') ?>"><br>
    Classification :
    <select name="classification">
      <?php
        $classes = ["","Tous publics","-12","-16","-18"];
        $sel = $data['classification'] ?? '';
        foreach ($classes as $c) {
          $lab = $c ?: '-- Choisir --';
          echo "<option value=\"".e($c)."\" ".($sel===$c?'selected':'').">$lab</option>";
        }
      ?>
    </select><br>

  <?php elseif ($type==='jeu'): ?>
    Éditeur : <input name="editeur" value="<?= e($data['editeur'] ?? '') ?>"><br>
    Plateforme :
    <select name="plateforme">
      <?php
        $plats = ["PC","PlayStation","Xbox","Nintendo","Mobile"];
        $sel = $data['plateforme'] ?? '';
        foreach ($plats as $p) {
          echo "<option value=\"".e($p)."\" ".($sel===$p?'selected':'').">$p</option>";
        }
      ?>
    </select><br>
    Âge minimum :
    <select name="age">
      <?php
        $ages = ["3","7","12","16","18"];
        $sel = $data['age'] ?? '';
        foreach ($ages as $a) {
          echo "<option value=\"".e($a)."\" ".($sel===$a?'selected':'').">$a</option>";
        }
      ?>
    </select><br>
  <?php endif; ?>

  <?php if ($type): ?>
    <br>Image : <input type="file" name="image"><br><br>
    <button type="submit">Valider</button>
  <?php endif; ?>
</form>

<?php
// Affichage des erreurs
if (!empty($errors)) {
    echo "<ul style='color:red;'>";
    foreach ($errors as $e) echo "<li>$e</li>";
    echo "</ul>";
}

// Affichage du succès
if ($success) {
    echo "<p style='color:green;'>Image uploadée : $success</p>";
}
?>
