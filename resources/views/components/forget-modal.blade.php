<div class="modal fade" id="forgetModal" tabindex="-1" aria-labelledby="forgetModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="login_sec p-4 position-relative">
                    <img class="login_m1" src="{{ asset('asset/images/m1.svg') }}" alt=""
                        loading="lazy">
                    <img class="login_m2" src="{{ asset('asset/images/m2.svg') }}" alt=""
                        loading="lazy">
                    <img class="login_m3" src="{{ asset('asset/images/m3.svg') }}" alt=""
                        loading="lazy">
                    <img class="login_m4" src="{{ asset('asset/images/m4.svg') }}" alt=""
                        loading="lazy">
                    <img class="close-icon" data-bs-dismiss="modal" aria-label="Close"
                        src="{{ asset('asset/images/ic_close1.png') }}" alt="Close" loading="lazy">
                    <div class="text-center">
                        <img src="{{ asset('asset/images/Logo_(2).png') }}" width="133" height="77"
                            alt="Logo" loading="lazy">
                        <h2 class="primary-heading-forget">Passwort vergessen?</h2>
                    </div>
                    <div class="main">
                        <div class="emailInput">
                            <label for="email_reset" class="label">E-Mail:</label>
                            <input type="email" placeholder="Deine E-Mailadresse" name="email" id="email_reset" class="emailLogin" autocomplete="email">
                            <input type="submit" value="Zurücksetzen" class="emailLogin" id="resetButton">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>