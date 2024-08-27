<style>
    .cookie-consent-modal .modal-content {
    padding: 20px;
}

.cookie-consent-modal .modal-header {
    border-bottom: none;
}

.cookie-consent-modal .modal-footer {
    border-top: none;
    display: flex;
    justify-content: space-between;
}
</style>
<div id="cookieConsentModal" class="modal fade" tabindex="-1" aria-labelledby="cookieConsentModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="cookie-consent-modal modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cookieConsentModalLabel">Cookie-Einstellungen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Wir verwenden Cookies, um Ihre Erfahrung zu verbessern. Sie können wählen, welche Cookies Sie
                    akzeptieren möchten.</p>
                <form id="cookieConsentForm">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="necessary" id="necessaryCookies"
                            checked disabled>
                        <label class="form-check-label" for="necessaryCookies">Notwendige Cookies</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="analytics" id="analyticsCookies">
                        <label class="form-check-label" for="analyticsCookies">Analytische Cookies</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="marketing" id="marketingCookies">
                        <label class="form-check-label" for="marketingCookies">Marketing Cookies</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="declineCookies"
                    data-bs-dismiss="modal">Ablehnen</button>
                <button type="button" class="btn btn-primary" id="acceptCookies" data-bs-dismiss="modal">Akzeptieren</button>
            </div>
        </div>
    </div>
</div>
<script>
                // Cookie Consent Modal
                if (!localStorage.getItem('cookieConsent')) {
                var cookieModal = new bootstrap.Modal(document.getElementById('cookieConsentModal'));
                cookieModal.show();
            }

            // Cookies akzeptieren
            document.getElementById('acceptCookies').addEventListener('click', function() {
                var consent = {
                    necessary: true,
                    analytics: document.getElementById('analyticsCookies').checked,
                    marketing: document.getElementById('marketingCookies').checked
                };
                localStorage.setItem('cookieConsent', JSON.stringify(consent));
                var cookieModalElement = document.getElementById('cookieConsentModal');
                var cookieModal = bootstrap.Modal.getInstance(cookieModalElement);
                if (cookieModal) {
                    cookieModal.hide();
                }
                showToast('Cookie-Einstellungen wurden gespeichert.');
            });

            // Cookies ablehnen
            document.getElementById('declineCookies').addEventListener('click', function() {
                var consent = {
                    necessary: true,
                    analytics: false,
                    marketing: false
                };
                localStorage.setItem('cookieConsent', JSON.stringify(consent));
                showToast('Cookie-Einstellungen wurden gespeichert.');
                var cookieModal = bootstrap.Modal.getInstance(document.getElementById('cookieConsentModal'));
                cookieModal.hide();
            });
</script>