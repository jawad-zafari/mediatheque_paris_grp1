<!-- Formulaire -->

<form formaction="form_valitate" method="POST">
  <label>Type de média :</label>
  <select name="type">
    <option value="">-- Choisir --</option>
    <option value="livre" <?= ($type === 'livre' ? 'selected' : '') ?>>Livre</option>
    <option value="film" <?= ($type === 'film' ? 'selected' : '')  ?>>Film</option>
    <option value="jeu" <?= ($type === 'jeu' ? 'selected' : '')   ?>>Jeu vidéo</option>
  </select>
  <input type="submit" name="submit" value="Selectionner">
</form>
<form method="POST" enctype="multipart/form-data">




  <br><br>
  <?php if ($type === 'livre'): ?>
    Titre : <input name="titre" value="<?= e($data['title'] ?? '') ?>" required><br>
    Auteur : <input name="auteur" value="<?= e($data['writter'] ?? '') ?>" required><br>
    ISBN : <input name="isbn" value="<?= e($data['isbn'] ?? '') ?>" required><br>
    Pages : <input type="number" name="pages" value="<?= e($data['page_number'] ?? '') ?>" required><br>
    Synopsis : <input type="text" name="synopsis" value="<?= e($data['synopsis'] ?? '') ?>" required><br>
    Année : <input type="number" name="annee" value="<?= e($data['year'] ?? '') ?>" required><br>
    Stock : <input type="number" name="stock" value="<?= e($data['stock'] ?? '') ?>" required><br>
    Genre :
    <select name="genre">
      <?php
      $gender = ["", "Classique", "Science-fiction", "Drame", "Romance", "Fantaisie", "Crime", "Action", "RPG", "Plateforme",];
      $sel = $data['classification'] ?? '';
      foreach ($gender as $g) {
        $lab = $g ?: '-- Choisir --';
        echo "<option value=\"" . e($g) . "\" " . ($sel === $g ? 'selected' : '') . ">$lab</option>";
      }
      ?>
    </select><br>

  <?php elseif ($type === 'film'): ?>
    Titre : <input name="titre" value="<?= e($data['title'] ?? '') ?>" required><br>
    Réalisateur : <input name="realisateur" value="<?= e($data['realisateur'] ?? '') ?>" required><br>
    Année : <input type="number" name="annee" value="<?= e($data['annee'] ?? '') ?>" required><br>
    Durée (min) : <input type="number" name="duree" value="<?= e($data['duree'] ?? '') ?>" required><br>
    Synopsis : <input type="text" name="synopsis" value="<?= e($data['synopsis'] ?? '') ?>" required><br>
    Stock : <input type="number" name="stock" value="<?= e($data['stock'] ?? '') ?>" required><br>
    Classification :
    <select name="classification">
      <?php
      $classes = ["", "Tous publics", "-10", "-12", "-16", "-18"];
      $sel = $data['classification'] ?? '';
      foreach ($classes as $c) {
        $lab = $c ?: '-- Choisir --';
        echo "<option value=\"" . e($c) . "\" " . ($sel === $c ? 'selected' : '') . ">$lab</option>";
      }
      ?>
    </select><br>
    Genre :
    <select name="genre">
      <?php
      $gender = ["", "Classique", "Science-fiction", "Drame", "Romance", "Fantaisie", "Crime", "Action", "RPG", "Plateforme",];
      $sel = $data['classification'] ?? '';
      foreach ($gender as $g) {
        $lab = $g ?: '-- Choisir --';
        echo "<option value=\"" . e($g) . "\" " . ($sel === $g ? 'selected' : '') . ">$lab</option>";
      }
      ?>
    </select><br>

  <?php elseif ($type === 'jeu'): ?>
    Titre : <input name="titre" value="<?= e($data['title'] ?? '') ?>" required><br>
    Éditeur : <input name="editeur" value="<?= e($data['editeur'] ?? '') ?>" required><br>
    Description : <input type="text" name="description" value="<?= e($data['description'] ?? '') ?>" required><br>
    Année : <input type="number" name="annee" value="<?= e($data['year'] ?? '') ?>" required><br>
    Stock : <input type="number" name="stock" value="<?= e($data['stock'] ?? '') ?>" required><br>
    Plateforme :
    <select name="plateforme">
      <?php
      $plats = ["PC", "PlayStation", "Xbox", "Nintendo", "Mobile"];
      $sel = $data['plateforme'] ?? '';
      foreach ($plats as $p) {
        echo "<option value=\"" . e($p) . "\" " . ($sel === $p ? 'selected' : '') . ">$p</option>";
      }
      ?>
    </select><br>
    Âge minimum :
    <select name="age">
      <?php
      $ages = ["3", "7", "12", "16", "18"];
      $sel = $data['age'] ?? '';
      foreach ($ages as $a) {
        echo "<option value=\"" . e($a) . "\" " . ($sel === $a ? 'selected' : '') . ">$a</option>";
      }
      ?>
    </select><br>
    Genre :
    <select name="genre">
      <?php
      $gender = ["", "Classique", "Science-fiction", "Drame", "Romance", "Fantaisie", "Crime", "Action", "RPG", "Plateforme",];
      $sel = $data['classification'] ?? '';
      foreach ($gender as $g) {
        $lab = $g ?: '-- Choisir --';
        echo "<option value=\"" . e($g) . "\" " . ($sel === $g ? 'selected' : '') . ">$lab</option>";
      }
      ?>
    </select><br>
  <?php endif; ?>

  <?php if ($type): ?>
    <br>Image : <input type="file" name="image"><br><br>
    <button type="submit" name="submit_button">Valider</button>
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