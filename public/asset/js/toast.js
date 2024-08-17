function showToast(message) {
    // Erstelle das Toast-Element
    var toast = document.createElement('div');
    toast.textContent = message;
    toast.style.position = 'fixed';
    toast.style.fontSize = '1.25em'; // Schriftgröße um 25% erhöht
    toast.style.padding = '12.5px'; // Padding um 25% erhöht
    toast.style.width = 'max-content'; // Breite an Inhalt anpassen
    toast.style.maxWidth = '80%'; // Maximalbreite auf 80% des Viewports begrenzen
    toast.style.left = '50%'; // Zentriert im Viewport
    toast.style.top = '50%'; // Zentriert im Viewport
    toast.style.transform = 'translate(-50%, -50%)'; // Zentriert im Viewport
    toast.style.backgroundColor = '#d1e7dd';
    toast.style.color = '#0a3622';
    toast.style.borderRadius = '5px';
    toast.style.borderColor = '#a3cfbb';
    toast.style.zIndex = '1000';
    toast.style.opacity = '0';
    toast.style.transition = 'opacity 1.5s, transform 0.3s'; // Transition für Opacity und Transform

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
    setTimeout(() => {
        toast.style.opacity = '0';
        setTimeout(() => document.body.removeChild(toast),
            1000); // Warte auf das Ende der Opacity-Transition (1 Sekunde)
    }, 2000); // Anzeigezeit 2 Sekunden
}