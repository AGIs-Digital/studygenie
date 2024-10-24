function showToast(message, type) {
    var toast = document.createElement('div');
    toast.innerHTML = message;
    toast.style.position = 'fixed';
    toast.style.fontSize = '1.25em';
    toast.style.padding = '12.5px';
    toast.style.width = 'max-content';
    toast.style.maxWidth = '80%';
    toast.style.left = '50%';
    toast.style.transform = 'translateX(-50%)';
    toast.style.borderRadius = '5px';
    toast.style.zIndex = '1060';
    toast.style.opacity = '0.7';
    toast.style.transition = 'opacity 1.5s, transform 0.3s';

    if (type === 'error') {
        toast.style.backgroundColor = '#f8d7da';
        toast.style.color = '#721c24';
        toast.style.borderColor = '#f5c6cb';
    } else {
        toast.style.backgroundColor = '#d1e7dd';
        toast.style.color = '#0a3622';
        toast.style.borderColor = '#a3cfbb';
    }
    
    const visibleToasts = document.querySelectorAll('.toast-message').length;
    if (visibleToasts === 0) {
        toast.style.top = '20%';
        toast.style.transform = 'translate(-50%, -50%)';
    } else {
        toast.style.top = `${20 + visibleToasts * 20}px`;
        toast.style.transform = 'translateX(-50%)';
    }

    toast.classList.add('toast-message');

    document.body.appendChild(toast);
    setTimeout(() => {
        toast.style.opacity = '0.9';
        toast.style.transform = 'translate(-50%, -50%) scale(1.1)';
    }, 100);

    setTimeout(() => {
        toast.style.transform = 'translate(-50%, -50%) scale(1)';
    }, 400);

    const displayDuration = type === 'error' ? 4000 : 2000;
    setTimeout(() => {
        toast.style.opacity = '0';
        setTimeout(() => document.body.removeChild(toast), 1000);
    }, displayDuration);
}