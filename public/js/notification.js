document.addEventListener('DOMContentLoaded', function() {
    // Create the toasts container
    const toastsContainer = document.createElement('div');
    toastsContainer.classList.add('toasts');

    // Create the master toast notification
    const masterToast = document.createElement('div');
    masterToast.classList.add('master-toast-notification', 'hide-toast');

    // Create the toast content
    const toastContent = document.createElement('div');
    toastContent.classList.add('toast-content');

    // Create the toast icon
    const toastIcon = document.createElement('div');
    toastIcon.classList.add('toast-icon');
    const iconElement = document.createElement('i');
    iconElement.classList.add('fa-solid');
    toastIcon.appendChild(iconElement);

    // Create the toast message
    const toastMsg = document.createElement('div');
    toastMsg.classList.add('toast-msg');

    // Append icon and message to toast content
    toastContent.appendChild(toastIcon);
    toastContent.appendChild(toastMsg);

    // Create the toast progress
    const toastProgress = document.createElement('div');
    toastProgress.classList.add('toast-progress');
    const toastProgressBar = document.createElement('div');
    toastProgressBar.classList.add('toast-progress-bar');
    toastProgress.appendChild(toastProgressBar);

    // Append toast content and progress to master toast
    masterToast.appendChild(toastContent);
    masterToast.appendChild(toastProgress);

    // Append the master toast and the toasts container to the body
    document.body.appendChild(toastsContainer);
    document.body.appendChild(masterToast);
    if (!document.querySelector('link[href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css"]')) {
        const link = document.createElement('link');
        link.href = 'https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css';
        link.rel = 'stylesheet';
        document.head.appendChild(link);
    }
});

let toastCounter = 1;

function displayToastNotification(msg, type) {
    const className = 'toast-' + toastCounter;
    let newNode, icon, iconColor;

    switch (type.toLowerCase()){
        case 'success':
            icon = 'ri-check-line';
            iconColor = '#27ae60';
            break;
        case 'error':
            icon = 'ri-close-large-line';
            iconColor = '#c0392b';
            break;
        case 'info':
            icon = 'ri-info-i';
            iconColor = '#2980b9';
            break;
        case 'warning':
            icon = 'ri-error-warning-line';
            iconColor = '#f39c12';
            break;
        default:
            icon = 'ri-checkbox-blank-circle-line';
            iconColor = '#a3a3a3';
            break;
    }

    const masterToastNotification = document.querySelector('.master-toast-notification');
    newNode = masterToastNotification.cloneNode(true);
    newNode.classList.add(className, 'toast-notification');
    newNode.classList.remove('master-toast-notification');

    document.querySelector('.toasts').appendChild(newNode);

    newNode.querySelector('.toast-msg').textContent = msg;

    const iconElement = newNode.querySelector('.toast-icon i');
    iconElement.classList.add(icon);

    const toastIcon = newNode.querySelector('.toast-icon');
    toastIcon.classList.add('wiggle-me');
    toastIcon.style.backgroundColor = iconColor;

    newNode.classList.remove('hide-toast');
    newNode.classList.add('slide-in-fade-out');

    setTimeout(function() {
        newNode.remove();
    }, 6800);

    toastCounter++;
}