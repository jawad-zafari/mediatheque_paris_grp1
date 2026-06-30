document.addEventListener("DOMContentLoaded", function() {
    
    document.body.addEventListener('click', function(e) {
        
        const sidebar = document.getElementById("catalogSidebar");

        if (sidebar && sidebar.classList.contains("active")) {
            const toggleBtn = document.getElementById("catalogSidebarToggleBtn");
            if (!sidebar.contains(e.target) && (!toggleBtn || !toggleBtn.contains(e.target))) {
                sidebar.classList.remove("active");
            }
        }

        const hamburgerToggle = e.target.closest('#catalogSidebarToggleBtn');
        if (hamburgerToggle) {
            if (sidebar) {
                sidebar.classList.toggle("active");
            }
            return;
        }

        const genreToggle = e.target.closest('#catalogGenreToggle');
        if (genreToggle) {
            const genreMenu = document.getElementById("catalogGenreMenu");
            
            if (!sidebar.classList.contains("active") && window.innerWidth > 900) {
                sidebar.classList.add("active");
            }
            if(genreMenu) {
                genreMenu.classList.toggle("open");
                genreToggle.classList.toggle("active");
            }
            return;
        }

        const link = e.target.closest('.sidebar-nav a, .genre-dropdown-content a, .stock-toggle-link, .media-stats-box, .pagination a');
        if (link) {
            e.preventDefault();
            const url = link.getAttribute('href');
            if(!url || url === '#') return;

            const gridContainer = document.querySelector('.grid-container');
            if(gridContainer) gridContainer.style.opacity = '0.4';

            fetch(url)
            .then(response => response.text())
            .then(html => {
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');

                const sectionsToUpdate = [
                    '.grid-container', 
                    '.pagination-container-ajax', 
                    '.catalog-section-header h2',
                    '.sidebar-nav ul', 
                    '.media-stats-container'
                ];

                sectionsToUpdate.forEach(selector => {
                    const newElement = doc.querySelector(selector);
                    const oldElement = document.querySelector(selector);
                    if (oldElement && newElement) {
                        oldElement.innerHTML = newElement.innerHTML;
                    } else if (oldElement && !newElement) {
                        oldElement.innerHTML = ''; 
                    }
                });

                if(gridContainer) gridContainer.style.opacity = '1';
                window.history.pushState({path: url}, '', url);

                if (sidebar && window.innerWidth <= 900) {
                    sidebar.classList.remove("active");
                }
            })
            .catch(error => {
                window.location.href = url;
            });
        }
    });

    window.addEventListener('popstate', function() {
        window.location.reload(); 
    });

    /* Gestion des actions de la page Détail */
    const btnBack = document.getElementById("btnBackHistory");
    if (btnBack) {
        btnBack.addEventListener("click", function() {
            window.history.back();
        });
    }

    const btnPrev = document.getElementById("btnCarouselPrev");
    const btnNext = document.getElementById("btnCarouselNext");
    const carousel = document.getElementById("similarCarousel");

    if (btnPrev && carousel) {
        btnPrev.addEventListener("click", function() {
            carousel.scrollBy({left: -260, behavior: 'smooth'});
        });
    }

    if (btnNext && carousel) {
        btnNext.addEventListener("click", function() {
            carousel.scrollBy({left: 260, behavior: 'smooth'});
        });
    }
});