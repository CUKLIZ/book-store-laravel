/**
 * Search Filters JavaScript
 * Handles stock filter toggle and sorting functionality
 */

console.log('Search filter scripts loaded');

/**
 * Auto-apply filters when toggle or select changes
 * Updates URL parameters and redirects
 */
window.applyFilters = function() {
    console.log('applyFilters() called');
    
    const url = new URL(window.location.href);
    console.log('Current URL:', url.toString());
    
    // Get stock filter from single toggle switch
    const stockCheckbox = document.getElementById('stock-available');
    const stockAvailable = stockCheckbox ? stockCheckbox.checked : true;
    console.log('Stock available checkbox checked:', stockAvailable);
    
    // If checked (ON) = only available stock (default behavior)
    // If unchecked (OFF) = all products (including out of stock)
    if (!stockAvailable) {
        url.searchParams.set('stock', 'all');
        console.log('Setting stock=all (show all products)');
    } else {
        url.searchParams.delete('stock');
        console.log('Removing stock parameter (default: only available)');
    }
    
    // Get sort filter
    const sortSelect = document.getElementById('sort-select');
    const sortValue = sortSelect ? sortSelect.value : '';
    console.log('Sort value:', sortValue);
    
    if (sortValue) {
        url.searchParams.set('sort', sortValue);
        console.log('Setting sort=' + sortValue);
    } else {
        url.searchParams.delete('sort');
        console.log('Removing sort parameter');
    }
    
    const newUrl = url.toString();
    console.log('Redirecting to:', newUrl);
    
    // Redirect to new URL
    window.location.href = newUrl;
}

/**
 * Reset all filters
 * Removes stock and sort parameters from URL
 */
window.resetFilters = function() {
    console.log('resetFilters() called');
    
    const url = new URL(window.location.href);
    
    // Check if reset button is disabled
    const resetButton = document.querySelector('button[onclick="resetFilters()"]');
    if (resetButton && resetButton.disabled) {
        console.log('Reset button is disabled, no action taken');
        return;
    }
    
    // Keep only the query parameter (q)
    url.searchParams.delete('stock');
    url.searchParams.delete('sort');
    
    console.log('Redirecting to:', url.toString());
    window.location.href = url.toString();
}

/**
 * Initialize on page load
 * Log element status for debugging
 */
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, initializing search filters');
    console.log('Stock checkbox:', document.getElementById('stock-available'));
    console.log('Sort select:', document.getElementById('sort-select'));
});