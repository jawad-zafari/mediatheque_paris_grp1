<?php
?>
<footer class="site-footer">
    <div class="footer-container">
        <div class="footer-grid">
            
            <div class="footer-about">
                <h3><?php echo APP_NAME ?? 'Médiathèque'; ?></h3>
                <p>Votre espace culturel numérique. Découvrez, empruntez et profitez de notre vaste collection de livres, films et jeux vidéo en toute simplicité.</p>
                <div class="social-links">
                    <a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            
            <div class="footer-links">
                <h4>Navigation</h4>
                <ul>
                    <li><a href="<?php echo url(); ?>"><i class="fas fa-chevron-right"></i> Accueil</a></li>
                    <li><a href="<?php echo url('catalog/index'); ?>"><i class="fas fa-chevron-right"></i> Catalogue</a></li>
                    <li><a href="<?php echo url('home/about'); ?>"><i class="fas fa-chevron-right"></i> À propos</a></li>
                    <li><a href="<?php echo url('home/contact'); ?>"><i class="fas fa-chevron-right"></i> Contact</a></li>
                </ul>
            </div>
            
            <div class="footer-links">
                <h4>Légales</h4>
                <ul>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Conditions d'utilisation</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Politique de confidentialité</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> Mentions légales</a></li>
                    <li><a href="#"><i class="fas fa-chevron-right"></i> FAQ & Aide</a></li>
                </ul>
            </div>
            
            <div class="footer-newsletter">
                <h4>Newsletter</h4>
                <p>Abonnez-vous pour recevoir nos dernières nouveautés et offres exclusives.</p>
                <form action="#" class="newsletter-form" onsubmit="event.preventDefault();">
                    <input type="email" placeholder="Votre adresse email" required autocomplete="off">
                    <button type="submit" title="S'abonner"><i class="fas fa-paper-plane"></i></button>
                </form>
            </div>
            
        </div>
    </div>
    
    <div class="footer-bottom">
        <p>&copy; <?php echo date('Y'); ?> <?php echo APP_NAME ?? 'Médiathèque'; ?>. Tous droits réservés. | Version <?php echo defined('APP_VERSION') ? APP_VERSION : '1.0'; ?></p>
    </div>
</footer>