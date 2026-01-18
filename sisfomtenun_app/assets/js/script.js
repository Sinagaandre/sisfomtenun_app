/* 
   Global JavaScript for SISFOMTENUN App 
   Karya Tulis Ilmiah - Kapita Selekta
*/

document.addEventListener('DOMContentLoaded', function() {
    // 1. Highlight Active Sidebar Menu
    const currentLocation = location.href;
    const menuItem = document.querySelectorAll('.sidebar a');
    const menuLength = menuItem.length;
    
    for (let i = 0; i < menuLength; i++) {
        if (menuItem[i].href === currentLocation) {
            menuItem[i].classList.add("active");
        }
    }

    // 2. Initialize Bootstrap Tooltips (if needed)
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });

    // 3. Simple Alert Auto-close
    const alerts = document.querySelectorAll('.alert-dismissible');
    alerts.forEach(function(alert) {
        setTimeout(function() {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000); // Close after 5 seconds
    });
});
