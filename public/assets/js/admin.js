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

    