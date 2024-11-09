<div id="mobileWarning" class="mobile-warning" style="display: none;">
    <div class="mobile-warning-content">
        <h4>Hinweis zur optimalen Nutzung</h4>
        <p>Dieses Tool wurde für die Verwendung am Computer oder Tablet optimiert. Für die beste Lernerfahrung empfehlen wir dir, einen Laptop oder PC zu nutzen.</p>
        <button onclick="dismissWarning()" class="btn btn-primary">Verstanden</button>
    </div>
</div>

<style>
.mobile-warning {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.8);
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
}

.mobile-warning-content {
    background: white;
    padding: 20px;
    border-radius: 10px;
    max-width: 90%;
    text-align: center;
}

.mobile-warning-content h4 {
    color: #e09e50;
    margin-bottom: 15px;
}

.mobile-warning-content button {
    background: #e09e50;
    border: none;
    margin-top: 15px;
}
</style>

<script>
function dismissWarning() {
    document.getElementById('mobileWarning').style.display = 'none';
    localStorage.setItem('mobileWarningDismissed', 'true');
}

document.addEventListener('DOMContentLoaded', function() {
    if (window.innerWidth <= 768 && !localStorage.getItem('mobileWarningDismissed')) {
        document.getElementById('mobileWarning').style.display = 'flex';
    }
});
</script>
