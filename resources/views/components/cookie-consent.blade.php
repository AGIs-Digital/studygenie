<div id="cookieConsentModal" class="modal fade" tabindex="-1" aria-labelledby="cookieConsentModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
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
                <button type="button" class="btn btn-primary" id="acceptCookies">Akzeptieren</button>
            </div>
        </div>
    </div>
</div>