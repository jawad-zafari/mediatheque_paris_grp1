document.addEventListener('DOMContentLoaded', function() {
    
    /* =========================================================
       1. LOGIQUE DU FORMULAIRE D'ÉDITION DES MÉDIAS
    ========================================================= */
    const selectType = document.getElementById('media_type_select');
    const groupLivre = document.getElementById('fields_livre');
    const groupFilm = document.getElementById('fields_film');
    const groupJeu = document.getElementById('fields_jeu');

    if (selectType && groupLivre && groupFilm && groupJeu) {
        function updateDynamicFields() {
            groupLivre.style.display = 'none';
            groupFilm.style.display = 'none';
            groupJeu.style.display = 'none';
            
            [groupLivre, groupFilm, groupJeu].forEach(group => {
                group.querySelectorAll('input, select').forEach(el => el.removeAttribute('required'));
            });

            const val = selectType.value;
            if (val === 'livre' || val === 'book') {
                groupLivre.style.display = 'block';
                groupLivre.querySelector('[name="writer"]').setAttribute('required', 'true');
                groupLivre.querySelector('[name="page_number"]').setAttribute('required', 'true');
            } else if (val === 'film' || val === 'movie') {
                groupFilm.style.display = 'block';
                groupFilm.querySelector('[name="producer"]').setAttribute('required', 'true');
                groupFilm.querySelector('[name="duration_m"]').setAttribute('required', 'true');
                groupFilm.querySelector('[name="classification"]').setAttribute('required', 'true');
            } else if (val === 'jeu' || val === 'video_game') {
                groupJeu.style.display = 'block';
                groupJeu.querySelector('[name="editor"]').setAttribute('required', 'true');
                groupJeu.querySelector('[name="platform"]').setAttribute('required', 'true');
                groupJeu.querySelector('[name="min_age"]').setAttribute('required', 'true');
            }
        }
        selectType.addEventListener('change', updateDynamicFields);
        updateDynamicFields(); 
    }

    /* =========================================================
       2. MODALE DE CONFIRMATION (ADMIN - GLASSMORPHISM)
    ========================================================= */
    function showAdminConfirmModal(message, onConfirm) {
        const existingOverlay = document.querySelector('.confirm-overlay-admin');
        if (existingOverlay) existingOverlay.remove();

        const overlay = document.createElement('div');
        overlay.className = 'confirm-overlay-admin';
        overlay.style.cssText = 'position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.75); display: flex; justify-content: center; align-items: center; z-index: 10000; backdrop-filter: blur(5px);';

        const box = document.createElement('div');
        box.className = 'confirm-box-admin';
        box.style.cssText = 'background: rgba(1, 36, 71, 0.95); padding: 30px; border-radius: 15px; border: 1px solid #38bdf8; color: #ffffff; text-align: center; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5); min-width: 320px; max-width: 90%;';

        box.innerHTML = `
            <div style="font-size: 3.5rem; color: #38bdf8; margin-bottom: 15px;"><i class="fas fa-question-circle"></i></div>
            <p style="font-size: 1.15rem; margin-bottom: 25px; font-weight: 500;">${message}</p>
            <div style="display: flex; justify-content: center; gap: 15px;">
                <button type="button" id="btn-admin-no" style="background: rgba(239, 68, 68, 0.15); color: #ef4444; border: 1px solid #ef4444; padding: 10px 25px; border-radius: 50px; cursor: pointer; font-weight: 600; transition: all 0.3s;">Annuler</button>
                <button type="button" id="btn-admin-yes" style="background: #38bdf8; color: #012447; border: none; padding: 10px 25px; border-radius: 50px; cursor: pointer; font-weight: 600; transition: all 0.3s;">Oui, confirmer</button>
            </div>
        `;

        overlay.appendChild(box);
        document.body.appendChild(overlay);

        const btnNo = document.getElementById('btn-admin-no');
        const btnYes = document.getElementById('btn-admin-yes');
        
        btnNo.addEventListener('mouseover', () => { btnNo.style.background = '#ef4444'; btnNo.style.color = '#ffffff'; });
        btnNo.addEventListener('mouseout', () => { btnNo.style.background = 'rgba(239, 68, 68, 0.15)'; btnNo.style.color = '#ef4444'; });
        btnYes.addEventListener('mouseover', () => { btnYes.style.background = '#0ea5e9'; btnYes.style.transform = 'translateY(-2px)'; });
        btnYes.addEventListener('mouseout', () => { btnYes.style.background = '#38bdf8'; btnYes.style.transform = 'translateY(0)'; });

        btnNo.addEventListener('click', () => overlay.remove());
        btnYes.addEventListener('click', () => {
            overlay.remove();
            onConfirm();
        });
    }

    /* =========================================================
       3. ÉCOUTEUR GLOBAL DE SOUMISSION (Validation Admin)
    ========================================================= */
    document.body.addEventListener('submit', function(event) {
        if (event.target.classList.contains('form-confirm-return')) {
            event.preventDefault();
            const form = event.target;
            
            showAdminConfirmModal('Confirmer la réception de ce média ?', function() {
                form.submit(); 
            });
        }
    });


});