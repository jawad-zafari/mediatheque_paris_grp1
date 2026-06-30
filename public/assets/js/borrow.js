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

   
});