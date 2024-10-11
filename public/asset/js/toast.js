function showToast(message, type) {
    // Erstelle das Toast-Element
    var toast = document.createElement('div');
    toast.innerHTML = message; // Verwende innerHTML, um HTML-Inhalte zu unterstützen
    toast.style.position = 'fixed';
    toast.style.fontSize = '1.25em'; // Schriftgröße um 25% erhöht
    toast.style.padding = '12.5px'; // Padding um 25% erhöht
    toast.style.width = 'max-content'; // Breite an Inhalt anpassen
    toast.style.maxWidth = '80%'; // Maximalbreite auf 80% des Viewports begrenzen
    toast.style.left = '50%'; // Zentriert im Viewport
    toast.style.transform = 'translateX(-50%)'; // Zentriert im Viewport
    toast.style.borderRadius = '5px';
    toast.style.zIndex = '1060';
    toast.style.opacity = '0.7';
    toast.style.transition = 'opacity 1.5s, transform 0.3s'; // Transition für Opacity und Transform

    // Setze die Farben basierend auf dem Typ
    if (type === 'error') {
        toast.style.backgroundColor = '#f8d7da';
        toast.style.color = '#721c24';
        toast.style.borderColor = '#f5c6cb';
    } else {
        toast.style.backgroundColor = '#d1e7dd';
        toast.style.color = '#0a3622';
        toast.style.borderColor = '#a3cfbb';
    }

    // Berechne die Position basierend auf der Anzahl der sichtbaren Toasts
    const visibleToasts = document.querySelectorAll('.toast-message').length;
    if (visibleToasts === 0) {
        toast.style.top = '20%';
        toast.style.transform = 'translate(-50%, -50%)'; // Zentriert im Viewport
    } else {
        toast.style.top = `${20 + visibleToasts * 20}px`; // Abstand von 20px zum vorherigen Toast
        toast.style.transform = 'translateX(-50%)'; // Zentriert horizontal
    }

    // Füge eine Klasse für die Toast-Nachricht hinzu
    toast.classList.add('toast-message');

    // Füge das Toast-Element hinzu und fade es ein
    document.body.appendChild(toast);
    setTimeout(() => {
        toast.style.opacity = '0.9';
        toast.style.transform = 'translate(-50%, -50%) scale(1.1)'; // Vergrößern
    }, 100);

    // Zurück zur normalen Größe
    setTimeout(() => {
        toast.style.transform = 'translate(-50%, -50%) scale(1)';
    }, 400);

    // Entferne das Toast-Element nach einer gewissen Zeit
    const displayDuration = type === 'error' ? 4000 : 2000; // Fehler 4 Sekunden, Erfolg 2 Sekunden
    setTimeout(() => {
        toast.style.opacity = '0';
        setTimeout(() => document.body.removeChild(toast),
            1000); // Warte auf das Ende der Opacity-Transition (1 Sekunde)
    }, displayDuration); // Anzeigezeit
}