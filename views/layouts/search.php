<div class="autocomplete-wrapper" style="position: relative; width: 100%;">
    <style>
        .autocomplete-item:hover {
            background-color: rgba(56, 189, 248, 0.15) !important;
        }
    </style>
    
    <form method="GET" action="<?php echo url('catalog/index'); ?>" id="main-search-form" class="search-bar">
        <input type="hidden" name="url" value="catalog/index">
        <input type="text" name="search_term" id="liveSearchInput" 
               placeholder="Rechercher un média (livre, film, jeu)..." 
               class="search-input" 
               value="<?php echo htmlspecialchars($_GET['search_term'] ?? ''); ?>" 
               autocomplete="off"
               data-url="<?php echo url('catalog/live_search'); ?>"
               data-base-url="<?php echo url('catalog/detail'); ?>">
        <button type="submit" id="searchButton" class="search-button">
            <i class="fas fa-search"></i>
        </button>
    </form>
    
    <div id="autocompleteResults" class="autocomplete-results" style="display: none;"></div>
</div>