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

    