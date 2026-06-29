document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('liveSearchInput');
    const resultsBox = document.getElementById('autocompleteResults');

    if (!searchInput || !resultsBox) return;

    const apiUrl = searchInput.getAttribute('data-url');
    const baseUrl = searchInput.getAttribute('data-base-url');
    let timeout = null;

    
});