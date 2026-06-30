document.addEventListener('DOMContentLoaded', function() {
    
    const counter = document.getElementById('borrow-counter');
    let currentLoans = parseInt(counter ? counter.textContent : 0) || 0; 

    function updateBadge(count) {
        if (counter) {
            if (count > 0) {
                counter.textContent = count;
                counter.style.display = 'inline-block'; 
            } else {
                counter.style.display = 'none'; 
            }
        }
    }

    function showConfirmModal(message, onConfirm) {
        const existingOverlay = document.querySelector('.confirm-overlay');
        if (existingOverlay) existingOverlay.remove();

        const overlay = document.createElement('div');
        overlay.className = 'confirm-overlay';

        const box = document.createElement('div');
        box.className = 'confirm-box';

        box.innerHTML = `
            <div class="confirm-icon"><i class="fas fa-question-circle"></i></div>
            <p class="confirm-text">${message}</p>
            <div class="confirm-actions">
                <button class="confirm-btn btn-cancel" id="btn-no">Annuler</button>
                <button class="confirm-btn btn-confirm" id="btn-yes">Oui, confirmer</button>
            </div>
        `;

        overlay.appendChild(box);
        document.body.appendChild(overlay);

        document.getElementById('btn-no').addEventListener('click', () => overlay.remove());
        document.getElementById('btn-yes').addEventListener('click', () => {
            overlay.remove();
            onConfirm();
        });
    }

    document.body.addEventListener('click', function(event) {
        
        const rentBtn = event.target.closest('.btn-borrow');
        if (rentBtn) {
            event.preventDefault();
            
            const isLoggedIn = document.body.getAttribute('data-logged-in') === 'true';
            if (!isLoggedIn) {
                const redirectUrl = rentBtn.getAttribute('data-login-url');
                if (redirectUrl) {
                    window.location.href = redirectUrl;
                    return;
                }
            }

            const targetUrl = rentBtn.getAttribute('href');
            if (!targetUrl || targetUrl === '#') return;

            showConfirmModal("Confirmer l'emprunt de ce média ?", function() {
                fetch(targetUrl, {
                    method: 'POST',
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        currentLoans++;
                        updateBadge(currentLoans);
                        if (typeof showNotification === 'function') { 
                            showNotification(data.message, 'success'); 
                        } else { 
                            window.location.reload(); 
                        }
                    } else {
                        if (typeof showNotification === 'function') { 
                            showNotification(data.error, 'error'); 
                        } else { 
                            alert(data.error); 
                        }
                    }
                })
                .catch(error => console.error('Erreur:', error));
            });
            return;
        }

        const returnBtn = event.target.closest('.btn-return-modern');
        if (returnBtn) {
            event.preventDefault();
            const targetUrl = returnBtn.getAttribute('href');

            showConfirmModal("Souhaitez-vous vraiment envoyer une demande de retour pour ce média ?", function() {
                window.location.href = targetUrl;
            });
        }
    });
});