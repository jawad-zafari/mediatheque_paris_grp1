/* =========================================================
   1. SYSTÈME DE NOTIFICATION TOAST GLOBALE
========================================================= */
function showNotification(message, type = 'success') {
    const existingToast = document.querySelector('.toast-notification');
    if (existingToast) existingToast.remove();

    const toast = document.createElement('div');
    toast.className = `toast-notification toast-${type}`;
    
    const icon = type === 'success' ? '<i class="fas fa-check-circle"></i>' : '<i class="fas fa-exclamation-circle"></i>';
    toast.innerHTML = `${icon} <span>${message}</span>`;
    
    document.body.appendChild(toast);
    
    setTimeout(() => toast.classList.add('show'), 10);
    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => toast.remove(), 400);
    }, 3500);
}

document.addEventListener('DOMContentLoaded', function() {
    
    /* =========================================================
       2. LOGIQUE POUR LA SIDEBAR ADMIN
    ========================================================= */
    const toggleBtn = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('adminSidebar');
    if (toggleBtn && sidebar) {
        toggleBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            sidebar.classList.toggle('active');
        });
        document.addEventListener('click', function(e) {
            if (window.innerWidth <= 900 && !sidebar.contains(e.target) && sidebar.classList.contains('active')) {
                sidebar.classList.remove('active');
            }
        });
    }

    /* =========================================================
       3. LOGIQUE POUR LE PANNEAU DYNAMIQUE (LOGIN/REGISTER)
    ========================================================= */
    const bgClasses = ['dynamic-bg-1', 'dynamic-bg-2', 'dynamic-bg-3', 'dynamic-bg-4'];
    const leftPanel = document.querySelector('.dynamic-left-panel');
    if (leftPanel) {
        const randomClass = bgClasses[Math.floor(Math.random() * bgClasses.length)];
        leftPanel.classList.add(randomClass);
    }

    /* =========================================================
       4. TRAITEMENT AUTOMATIQUE DES MESSAGES FLASH (MÉTHODE FIABLE)
    ========================================================= */
    if (window.ServerFlashMessages) {
        Object.keys(window.ServerFlashMessages).forEach(type => {
            const toastType = (type === 'error' || type === 'danger') ? 'error' : 'success';
            window.ServerFlashMessages[type].forEach(message => {
                if (typeof showNotification === 'function') {
                    showNotification(message, toastType);
                }
            });
        });
        window.ServerFlashMessages = null; 
    } else {
        const flashPublic = document.getElementById('flash-data-public');
        if (flashPublic) {
            try {
                const rawData = flashPublic.getAttribute('data-flash');
                if (rawData) {
                    const flashMessages = JSON.parse(rawData);
                    Object.keys(flashMessages).forEach(type => {
                        const toastType = (type === 'error' || type === 'danger') ? 'error' : 'success';
                        flashMessages[type].forEach(message => {
                            if (typeof showNotification === 'function') {
                                showNotification(message, toastType);
                            }
                        });
                    });
                    flashPublic.removeAttribute('data-flash');
                }
            } catch (e) {
                console.error('Erreur Toast:', e);
            }
        }
    }

    /* =========================================================
       5. LOGIQUE DE LA PAGE PROFIL (Onglets, Formulaire, Mots de passe)
    ========================================================= */
    const profileTabs = document.querySelectorAll('.profile-menu .tab-link');
    if (profileTabs.length > 0) {
        
        function switchTab(tabId) {
            document.querySelectorAll('.profile-tab-content').forEach(tab => {
                tab.style.display = 'none';
            });
            
            const targetTab = document.getElementById(tabId);
            if (targetTab) {
                targetTab.style.display = 'block';
            }
            
            document.querySelectorAll('.profile-menu .tab-link').forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('data-tab') === tabId) {
                    link.classList.add('active');
                }
            });
            
            if (tabId !== 'tab-voir-profil') {
                const formSection = document.getElementById('section-modification-form');
                if (formSection) formSection.style.display = 'none';
            }
        }

        profileTabs.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const tabId = this.getAttribute('data-tab');
                switchTab(tabId);
                
                const url = new URL(window.location);
                url.searchParams.set('tab', tabId);
                window.history.pushState({}, '', url);
            });
        });

        const urlParams = new URLSearchParams(window.location.search);
        const requestedTab = urlParams.get('tab');
        if (requestedTab) {
            switchTab(requestedTab);
        }

        const btnShowEdit = document.getElementById('btn-show-edit');
        const btnHideEdit = document.getElementById('btn-hide-edit');
        const formSection = document.getElementById('section-modification-form');

        if (btnShowEdit && formSection) {
            btnShowEdit.addEventListener('click', function() {
                formSection.style.display = 'block';
                formSection.scrollIntoView({ behavior: 'smooth' });
            });
        }

        if (btnHideEdit && formSection) {
            btnHideEdit.addEventListener('click', function() {
                formSection.style.display = 'none';
            });
        }
    }

    const togglePasswords = document.querySelectorAll('.toggle-password');
    togglePasswords.forEach(icon => {
        icon.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const input = document.getElementById(targetId);
            if (input) {
                if (input.type === 'password') {
                    input.type = 'text';
                    this.classList.remove('fa-eye');
                    this.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    this.classList.remove('fa-eye-slash');
                    this.classList.add('fa-eye');
                }
            }
        });
    });

    /* =========================================================
       6. SCROLL HEADER SEARCH (MOBILE)
    ========================================================= */
    const btnSearch = document.getElementById('mobileSearchBtn');
    if(btnSearch) {
        btnSearch.addEventListener('click', function() {
            const searchContainer = document.getElementById('headerSearch');
            if(searchContainer) {
                searchContainer.style.maxHeight = '250px';
                searchContainer.style.opacity = '1';
                searchContainer.style.marginTop = '10px';
                this.style.display = 'none';
            }
        });
    }
});

/* Gestion du scroll pour le header (attache a document, pas besoin de DOMContentLoaded) */
document.addEventListener('scroll', function() {
    const searchContainer = document.getElementById('headerSearch');
    const mobileSearchBtn = document.getElementById('mobileSearchBtn');
    if (window.innerWidth <= 900 && searchContainer && mobileSearchBtn) {
        if (window.scrollY > 60) {
            searchContainer.style.maxHeight = '0px';
            searchContainer.style.opacity = '0';
            searchContainer.style.marginTop = '0px';
            mobileSearchBtn.style.display = 'block';
        } else {
            searchContainer.style.maxHeight = '250px';
            searchContainer.style.opacity = '1';
            searchContainer.style.marginTop = '10px';
            mobileSearchBtn.style.display = 'none';
        }
    } else if (window.innerWidth > 900 && searchContainer) {
        searchContainer.style.maxHeight = 'none';
        searchContainer.style.opacity = '1';
        if (mobileSearchBtn) mobileSearchBtn.style.display = 'none';
    }
});