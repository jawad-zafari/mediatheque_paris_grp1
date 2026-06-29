document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('liveSearchInput');
    const resultsBox = document.getElementById('autocompleteResults');

    if (!searchInput || !resultsBox) return;

    const apiUrl = searchInput.getAttribute('data-url');
    const baseUrl = searchInput.getAttribute('data-base-url');
    let timeout = null;

    searchInput.addEventListener('input', function() {
        clearTimeout(timeout);
        const query = this.value.trim();

        if (query.length < 2) {
            resultsBox.style.display = 'none';
            resultsBox.innerHTML = '';
            return;
        }

        timeout = setTimeout(() => {
            fetch(`${apiUrl}?q=${encodeURIComponent(query)}`)
                .then(response => {
                    if (!response.ok) throw new Error("Erreur réseau");
                    return response.json();
                })
                .then(data => {
                    resultsBox.innerHTML = '';
                    
                    if (data.length === 0) {
                        resultsBox.innerHTML = '<div style="padding: 15px; color: #94a3b8; text-align: center; font-size: 14px;">Aucun résultat trouvé</div>';
                    } else {
                        data.forEach(item => {
                            const itemUrl = `${baseUrl}/${item.id}`;
                            const imgSrc = item.image_url ? item.image_url : 'assets/images/default.jpg';

                            const html = `
                                <a href="${itemUrl}" class="autocomplete-item" style="display: flex; align-items: center; padding: 12px 15px; text-decoration: none; border-bottom: 1px solid rgba(255,255,255,0.05); transition: background 0.3s ease;">
                                    <img src="${imgSrc}" alt="" style="width: 45px; height: 65px; object-fit: cover; border-radius: 6px; margin-right: 15px; box-shadow: 0 4px 10px rgba(0,0,0,0.3);" onerror="this.onerror=null; this.src='assets/images/default.jpg';">
                                    <div class="autocomplete-info" style="display: flex; flex-direction: column;">
                                        <span class="autocomplete-title" style="color: #ffffff; font-size: 0.95rem; font-weight: bold; margin-bottom: 4px;">${item.title}</span>
                                        <span class="autocomplete-type" style="color: #38bdf8; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px;">${item.type_label}</span>
                                    </div>
                                </a>
                            `;
                            resultsBox.insertAdjacentHTML('beforeend', html);
                        });
                    }
                    
                    resultsBox.style.display = 'flex';
                    resultsBox.style.flexDirection = 'column';
                    resultsBox.style.position = 'absolute';
                    resultsBox.style.top = 'calc(100% + 5px)';
                    resultsBox.style.left = '0';
                    resultsBox.style.width = '100%';
                    resultsBox.style.background = 'rgba(1, 36, 71, 0.98)';
                    resultsBox.style.backdropFilter = 'blur(15px)';
                    resultsBox.style.border = '1px solid rgba(56, 189, 248, 0.4)';
                    resultsBox.style.borderRadius = '12px';
                    resultsBox.style.zIndex = '999999';
                    resultsBox.style.boxShadow = '0 15px 35px rgba(0,0,0,0.7)';
                    
                    /* Activation du scroll pour les résultats multiples */
                    resultsBox.style.maxHeight = '350px';
                    resultsBox.style.overflowY = 'auto';
                    resultsBox.style.overflowX = 'hidden';
                })
                .catch(error => {
                    console.error("Erreur Search:", error);
                    resultsBox.innerHTML = '<div style="padding: 15px; color: #ef4444; text-align: center; font-size: 14px;">Erreur de connexion serveur</div>';
                    resultsBox.style.display = 'block';
                });
        }, 300);
    });

    document.addEventListener('click', function(e) {
        if (!searchInput.contains(e.target) && !resultsBox.contains(e.target)) {
            resultsBox.style.display = 'none';
        }
    });
});