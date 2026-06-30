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

    
});