<?php
/* Vue pour les details complets d'un media (MVC - View) */
$item = $item ?? ['id' => null];
$similar_items = $similar_items ?? [];
?>
<section class="container detail-page-container">
    
    <div class="detail-back-wrapper">
        <button id="btnBackHistory" class="btn-back-detail">
            <i class="fas fa-arrow-left"></i> Retour
        </button>
    </div>
    
    <div class="detail-card">
        
        <div class="detail-image-wrapper">
            <img src="<?php echo htmlspecialchars($item['image_url'] ?? 'https://via.placeholder.com/400'); ?>" alt="<?php echo htmlspecialchars($item['title'] ?? 'Sans titre'); ?>" class="detail-image">
            <?php if (isset($item['stock']) && $item['stock'] > 0): ?>
                <a href="<?php echo url('borrow/rent/' . $item['id']); ?>" class="detail-image-borrow-btn btn-borrow" title="Emprunter">
                    <i class="fas fa-book-reader"></i>
                </a>
            <?php endif; ?>
        </div>
        
        <div class="detail-content">
            <h1 class="detail-title">
                <?php echo htmlspecialchars($item['title'] ?? 'Sans titre'); ?>
            </h1>
            
            <div class="detail-info">
                <p><strong>Genre :</strong> <?php echo htmlspecialchars($item['genre'] ?? 'N/A'); ?></p>
                <p><strong>Année :</strong> <?php echo htmlspecialchars($item['year'] ?? 'N/A'); ?></p>
                
                <?php if (isset($item['type']) && $item['type'] === 'book'): ?>
                    <p><strong>Auteur :</strong> <?php echo htmlspecialchars($item['author_director_publisher'] ?? 'N/A'); ?></p>
                    <p><strong>ISBN :</strong> <?php echo htmlspecialchars($item['isbn_rating_platform'] ?? 'N/A'); ?></p>
                    <p><strong>Pages :</strong> <?php echo htmlspecialchars($item['pages_duration_min_age'] ?? 'N/A'); ?></p>
                <?php elseif (isset($item['type']) && $item['type'] === 'film'): ?>
                    <p><strong>Réalisateur :</strong> <?php echo htmlspecialchars($item['author_director_publisher'] ?? 'N/A'); ?></p>
                    <p><strong>Note :</strong> <?php echo htmlspecialchars($item['isbn_rating_platform'] ?? 'N/A'); ?>/10</p>
                    <p><strong>Durée :</strong> <?php echo htmlspecialchars($item['pages_duration_min_age'] ?? 'N/A'); ?> min</p>
                <?php elseif (isset($item['type']) && $item['type'] === 'game'): ?>
                    <p><strong>Éditeur :</strong> <?php echo htmlspecialchars($item['author_director_publisher'] ?? 'N/A'); ?></p>
                    <p><strong>Plate-forme :</strong> <?php echo htmlspecialchars($item['isbn_rating_platform'] ?? 'N/A'); ?></p>
                    <p><strong>Âge minimum :</strong> <?php echo htmlspecialchars($item['pages_duration_min_age'] ?? 'N/A'); ?>+</p>
                <?php endif; ?>
            </div>

            <div class="detail-stock-wrapper detail-stock-margin">
                <?php if (isset($item['stock']) && $item['stock'] > 0): ?>
                    <span class="badge-in-stock">En Stock : <?php echo htmlspecialchars($item['stock']); ?></span>
                <?php else: ?>
                    <span class="badge-out-stock">Indisponible</span>
                <?php endif; ?>
            </div>

            <div class="detail-summary">
                <p><strong>Résumé :</strong> <br> <?php echo nl2br(htmlspecialchars($item['description'] ?? 'N/A')); ?></p>
            </div>
        </div>
    </div>
    
    <div class="similar-section">
        <div class="catalog-section-header">
            <h2 class="similar-title">Vous pourriez aussi aimer...</h2>
        </div>
        
        <div class="carousel-wrapper">
            <button id="btnCarouselPrev" class="carousel-nav prev-btn"><i class="fas fa-chevron-left"></i></button>
            <div class="carousel-container" id="similarCarousel">
                <?php 
                $count = 0;
                foreach (($similar_items ?? []) as $sim_item): 
                    if (isset($item['id']) && isset($sim_item['id']) && $sim_item['id'] !== $item['id'] && $count < 6): 
                        $count++;
                ?>
                    <div class="carousel-item">
                        <div class="card-img-wrapper">
                            <img src="<?php echo htmlspecialchars($sim_item['image_url'] ?? 'https://via.placeholder.com/300'); ?>" alt="">
                            <div class="card-overlay">
                                <a href="<?php echo url('catalog/detail/' . $sim_item['id']); ?>" class="card-icon-btn" title="Voir détails"><i class="fas fa-eye"></i></a>
                                <?php if (isset($sim_item['stock']) && $sim_item['stock'] > 0): ?>
                                    <a href="<?php echo url('borrow/rent/' . $sim_item['id']); ?>" class="card-icon-btn rent-btn btn-borrow" title="Emprunter"><i class="fas fa-book-reader"></i></a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="card-content">
                            <h3><?php echo htmlspecialchars($sim_item['title'] ?? 'Sans titre'); ?></h3>
                            <p><?php echo htmlspecialchars($sim_item['author_director_publisher'] ?? 'N/A'); ?></p>
                            <div class="card-status">
                                <?php echo isset($sim_item['stock']) && $sim_item['stock'] > 0 ? '<span class="available">Disponible</span>' : '<span class="unavailable">Indisponible</span>'; ?>
                            </div>
                        </div>
                    </div>
                <?php 
                    endif;
                endforeach; 
                ?>
            </div>
            <button id="btnCarouselNext" class="carousel-nav next-btn"><i class="fas fa-chevron-right"></i></button>
        </div>
    </div>

</section>