/**
 * Reusable alert functionality
 */
document.addEventListener('DOMContentLoaded', function() {
    // Initialize all success alerts
    const alerts = document.querySelectorAll('[id^="alert-"]');
    
    alerts.forEach(function(alert) {
        const closeButton = alert.querySelector('.close-alert');
        
        function closeAlert() {
            alert.style.transition = 'opacity 0.5s';
            alert.style.opacity = '0';
            setTimeout(function() {
                alert.remove();
            }, 500);
        }
        
        if (closeButton) {
            closeButton.addEventListener('click', closeAlert);
        }
        
        // Auto-hide after 5 seconds
        setTimeout(closeAlert, 5000);
    });
});

/**
 * Reusable confirm dialog function
 * @param {string} message - The confirmation message
 * @param {Function} onConfirm - Callback function when confirmed
 * @param {Function} onCancel - Optional callback function when cancelled
 */
function showConfirm(message, onConfirm, onCancel) {
    if (confirm(message)) {
        if (typeof onConfirm === 'function') {
            onConfirm();
        }
        return true;
    } else {
        if (typeof onCancel === 'function') {
            onCancel();
        }
        return false;
    }
}

/**
 * Form submit with confirmation
 * @param {string} formId - The form ID
 * @param {string} message - The confirmation message
 */
function setupFormConfirm(formId, message) {
    const form = document.getElementById(formId);
    if (form) {
        form.addEventListener('submit', function(e) {
            // Check if form is valid before showing confirm dialog
            if (this.checkValidity()) {
                if (!confirm(message)) {
                    e.preventDefault();
                }
            }
        });
    }
}

