<?php
//navbar
//titre
//phrase d'intro
//barre de recherche + filtres
//Livres
//grille affichage livres
//Films
//grille affichage films
//Jeux vidéos
//grille affichage jeux vidéos

/*
    *Fonctions routeur.php
    _utiliser la fonction function_dispatch(){}
*/

/*
    *Fonctions model.php
    _créer une page catalogue_model.php
*/

/*
    *Fonctions view.php
    _créer une fonction load_view_with_layout(){}
*/

/*
    *Fonctions home_controller.php    
    _créer une fonction home_catalogue(){}
    _si fonctionnel et trop volumineux, créer un dossier catalogue/, un fichier 
    catalogue_controleur.php et une fonction home_catalogue
*/



//[ [Accueil] [A propos] [Catalogue] [Profil] [Contact] [Deconnexion] ]
//titre
//phrase d'intro
//[barre de recherche] [Filtres] [Rechercher]
//Livres
//[] [] []
//[] [] []
//Films
//[] [] []
//[] [] []
//Jeux vidéos
//[] [] []
//[] [] []

?>

<div class="page-header">
    <div class="container">
        <h1><?php e($title); ?></h1>
    </div>    
</div>

<section class="content">
    <div class="container">
        <div class="content-grid">
            <div class="content-main">
            <!--<h1><?php// e($message); ?></h1>
                <h2><?php// e($message); ?> </h2>-->
<p><?php e($content); ?></p>

            </div>
        </div>
</section>

<section>
    <form method="GET" action="">

        <legend>Filtres</legend>
        <input type="text" placeholder="Entrez votre recherche">     

        <div class="à remplir">
            <legend>Filtres</legend>
            <select name="style" id="typeFilter">
                <option value="">
                    --type--
                </option>
                <option value="">Livre</option>
                <option value="">Film</option>
                <option value="">Jeu vidéo</option>
            </select>
            <select name="gender" id="GenderFilter">
                <option value="">
                    --genre--
                </option>
                <option value="scienceFiction">
                    --science-fiction--
                </option>
                <option value="bacASable">
                    --bac à sable--
                </option>
            </select>
            <select name="" id="">
                <option value="">
                    --disponibilité--
                </option>
                <option value="">
                    disponible
                </option>
                <option value="">
                    emprunté
                </option>
                <option value="">
                    tous
                </option>                
            </select>            
        </div>
        <input type="submit" name="submit" value="Rechercher">

    </form>
</section>

<h1>======================</h1>
<section class="catalogue-grid">
    <!--Filtre par type de média-->
    <?php if(!empty($data['type'])):?>
        <h3><?php echo $data['type-title'] ?></h3>
        <?php foreach ($data['type'] as $doc): ?>
            <p>titre</p>
            <?= htmlspecialchars($doc['title']) ?>
            <p>synopsis</p>
            <?= htmlspecialchars($doc['synopsis'] ?? '') ?>
            <p>genre</p>
            <?= htmlspecialchars($doc['gender'] ?? '') ?>
        <?php endforeach; ?>
    <?php endif ?>
    <!--Filtre par genre de média-->
    <?php if(!empty($data['gender-filter'])): ?>
    <?php endif ?>
    <!--Filtre par disponibilité des médias-->
    <?php if(!empty($data['stock-filter'])): ?>
        <?php foreach ($data['stock'] as $doc): ?>
            <p>titre</p>
            <?= htmlspecialchars($doc['title']) ?>
            <p>synopsis</p>
            <?= htmlspecialchars($doc['synopsis'] ?? '') ?>
            <p>genre</p>
            <?= htmlspecialchars($doc['gender'] ?? '') ?>
        <?php endforeach; ?>
    <?php endif ?>
   
    <?php //endif ?>    
</section>
<h1>======================</h1>






