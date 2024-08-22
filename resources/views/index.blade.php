<!DOCTYPE html>
<html lang="de">
<head>
    @section('title', 'StudyGenie')
    @include('components.head')
    <link rel="stylesheet" href="{{ asset('asset/css/HomePage.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

@include('components.navbar')
@include('components.feedback')
<body class="MainContainer">
    <div class="headerSpacer"></div>
    @include('components.arrowupbutton')
    @include('components.login-modal')
    @include('components.signup-modal')
    @include('components.forget-modal')
    @include('components.tooglePasswordVisibility')

    @include('components.heroimage-section')
    @include('components.learn-anything-section')
    @include('components.cookie-consent')
    @include('components.mathrix-section')
    @include('components.witness-section')
    @include('components.tutorial-section')

    <div align="center">
        <img src="{{ asset('asset/images/23.png') }}" alt="Ein zentriertes Bild" loading="lazy">
    </div>

    <h1 class="secondary-Heading planCardHeading">Dein persönlicher Genie</h1>
    @include('components.plancards-section')

    <section class="joinNowSection">
        <img src="{{ asset('asset/images/crownimage.png') }}" alt="Kronenbild" loading="lazy">
        <h1 class="secondary-Heading">Worauf wartest du?</h1>
        <p class="secondary-Paragraph">Starte jetzt kostenlos und mach dir das Leben leichter.</p>
        <button data-bs-toggle="modal" data-bs-target="#signupModal" class="plancardButton">Jetzt ausprobieren</button>
    </section>

    @include('components.faq-section')

    <div class="modal fade" id="payment_modal" tabindex="-1" aria-labelledby="payment_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="button_payment_box">
                        <a href="#" id="paypal_btn">Bezahlen mit <span>Pay</span><span>pal</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('components.footer')
    @include('components.scripts')
    <script src="{{ asset('asset/js/index.js') }}"></script>
    <script src="{{ asset('asset/js/toast.js') }}"></script>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Passwort-Reset-Formular-Übermittlung
            var resetButton = document.getElementById("resetButton");
            if (resetButton) {
                resetButton.addEventListener("click", function(e) {
                    e.preventDefault();
                    var email = document.getElementById("email_reset").value;
                    var formData = new FormData();
                    formData.append('email', email);
                    formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

                    fetch("{{ route('password.email') }}", {
                        method: "POST",
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            alert("Ein Link zum Zurücksetzen des Passworts wurde an Ihre E-Mail-Adresse gesendet.");
                            showToast("Ein Link zum Zurücksetzen des Passworts wurde an Ihre E-Mail-Adresse gesendet.");
                            var forgetModal = bootstrap.Modal.getInstance(document.getElementById('forgetModal'));
                            forgetModal.hide();
                        } else {
                            showToast("Fehler beim Senden des Links zum Zurücksetzen des Passworts.", 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                });
            }

            // Funktion zum Anzeigen des Fehler-Toasts
            function showErrorToast(message) {
                var errorToast = new bootstrap.Toast(document.getElementById('errorToast'));
                document.getElementById('errorToastMessage').innerText = message;
                errorToast.show();
            }

            // Login-Formular-Übermittlung
            document.getElementById("loginForm").addEventListener("submit", function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                fetch("{{ route('login.post') }}", {
                    method: "POST",
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === true) {
                        window.location.href = data.redirect_url;
                    } else {
                        var errorsList = document.getElementById('errors-list2');
                        errorsList.innerHTML = '';
                        data.errors.forEach(function(error) {
                            var li = document.createElement('li');
                            li.textContent = error;
                            errorsList.appendChild(li);
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showErrorToast("Ein unerwarteter Fehler ist aufgetreten.");
                });
            });

            // Registrierungs-Formular-Übermittlung
            document.getElementById("registerForm").addEventListener("submit", function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                fetch("{{ route('register.post') }}", {
                    method: "POST",
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === true) {
                        if (data.subscription_updated) {
                            localStorage.setItem('subscription_updated', 'true');
                        }
                        window.location.href = data.redirect;
                    } else {
                        var errorsList = document.getElementById('errors-list');
                        errorsList.innerHTML = '';
                        Object.values(data.errors).flat().forEach(function(error) {
                            var li = document.createElement('li');
                            li.textContent = error;
                            errorsList.appendChild(li);
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showErrorToast("Ein unerwarteter Fehler ist aufgetreten.");
                });
            });

            // Funktion zum Anzeigen der Konfetti-Animation
            function showConfetti() {
                confetti({
                    particleCount: 100,
                    spread: 70,
                    origin: { y: 0.6 }
                });
            }

            // Überprüfung auf Abonnement-Update
            if (localStorage.getItem('subscription_updated') === 'true') {
                showConfetti();
                showSuccessMessage();
                localStorage.removeItem('subscription_updated');
            }

            // Google Login
            document.getElementById('google-login').addEventListener('click', function() {
                window.location.href = "{{ url('login/google') }}";
            });

            // Passwort-Reset-Formular anzeigen
            document.getElementById("forgotPasswordLink").addEventListener("click", function(e) {
                e.preventDefault();
                var loginForm = document.getElementById("loginForm");
                var resetFormHTML = `
                    <div class="emailInput">
                        <label for="email" class="label">Email:</label>
                        <input type="email" placeholder="Deine E-Mailadresse" name="email" id="email_reset" class="emailLogin" autocomplete="email">
                        <input type="submit" value="Zurücksetzen" class="emailLogin" id="resetButton">
                    </div>
                `;
                loginForm.innerHTML += resetFormHTML;
            });
        });
    </script>
</body>

</html>