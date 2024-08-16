<!DOCTYPE html>
<html lang="de">
<head>
    @section('title', 'StudyGenie')
    @include('includes.head')
    <link rel="stylesheet" href="{{ asset('asset/css/HomePage.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/cookie-consent.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.4.0/dist/confetti.browser.min.js"></script>
</head>

<body class="MainContainer">
    <!-- Toast Container -->
    <div aria-live="polite" aria-atomic="true" class="position-relative">
        <div class="toast-container position-fixed top-0 end-0 p-3">
            <div id="errorToast" class="toast align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body" id="errorToastMessage">
                        <!-- Error message will be injected here -->
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Arrow Up Button -->
    <div class="arrow-up hidden" id="arrowUpContainer">
        <img src="{{ asset('asset/images/arrow-up.svg') }}" id="arrowUp" class="hidden" alt="Nach oben">
    </div>

    <!-- Cookie Consent Modal -->
    @include('components.cookie-consent')

    <header class="headerContainer">
        <div class="container">
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <a class="navbar-brand" href="/"> <img src="{{ asset('asset/images/logo.png') }}"
                            width="90" height="48" alt="StudyGenie Logo" loading="lazy"></a>
                    <button class="navbar-toggler navbar navbar-light" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        @guest
                        @else
                            <ul class="navbar-nav mx-auto mb-2 mb-lg-0 anchorTagsContainer">
                                <li class="nav-item"><a class="nav-link anchor active" aria-current="page"
                                        href="/">Home</a></li>
                                <li class="nav-item"><a class="nav-link anchor" href="/tools">Tools</a></li>
                                <li class="nav-item"><a class="nav-link anchor" href="/profile">Profil</a></li>
                                <li class="nav-item"><a class="nav-link anchor" href="/archive">Archiv</a></li>
                            </ul>
                        @endguest

                        <ul class="navbar-nav ms-auto">
                            @guest
                                <li class="nav-item">
                                    <button class="primary-button" data-bs-toggle="modal" data-bs-target="#loginModal"
                                        id="loginButton">Log In</button>
                                </li>
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} </a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">@csrf</form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
        </div>

        <div class="container">
            <div class="mainImageContantContainer">
                <div class="contentContainer">
                    <h1 class="primary-heading">
                        <u>Bildung & Karriere</u></br> neu gedacht, mit</br> Genie gemacht!
                    </h1>
                    <p class="primary-paragraph">Chancengleichheit in Schule,</br>Studium und Karriere</p>
                    <img src="{{ asset('asset/images/23.1.png') }}" alt="Z Design Illustration" loading="lazy">
                </div>
                <div class="imageContainer">
                    <img src="{{ asset('asset/images/illustrations/heroImage.svg') }}" alt="Hauptbild"
                        loading="lazy">
                </div>
            </div>
        </div>

        <div class="headerDesign">
            <img src="{{ asset('asset/images/Group_391.png') }}" alt="Haupt Hintergrundbild" loading="lazy">
        </div>
    </header>

    @include('components.learn-anything-section')
    @include('components.mathrix-section')
    @include('components.witness-section')
    @include('components.tutorial-section')

    <div align="center">
        <img src="{{ asset('asset/images/23.png') }}" alt="Ein zentriertes Bild" loading="lazy">
    </div>

    <h1 class="secondary-Heading planCardHeading">Dein persönlicher Genie</h1>
    @include('components.plancards-section')

    <section class="joinNowSection">
        <img src="{{ asset('asset/images/fill_7.png') }}" alt="Kronenbild" loading="lazy">
        <h1 class="secondary-Heading">Worauf wartest du?</h1>
        <p class="secondary-Paragraph">Starte jetzt kostenlos und mach dir das Leben leichter.</p>
        <button data-bs-toggle="modal" data-bs-target="#signupModal" class="plancardButton">Jetzt ausprobieren</button>
    </section>

    @include('components.faq-section')
    @include('components.login-modal')
    @include('components.signup-modal')
    @include('components.forget-modal')

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
    <footer class="mainFooterContainer">
        <div class="footerContainer">
            <img id="footerLogo" src="{{ asset('asset/images/Logo_(2).png') }}" width="133" height="77"
                alt="Logo " loading="lazy">
                <div class="CenterContainer">
                    <div class="anchorTagsFooterContainer">
                        <a href="/impressum" class="footerHeading"> Impressum </a>
                    </div>
                    <div class="anchorTagsFooterContainer">
                        <a href="/agb" class="footerHeading"> AGBs </a>
                    </div>
                    <div class="anchorTagsFooterContainer">
                        <a href="/datenschutz" class="footerHeading"> Datenschutz </a>
                    </div>
                </div>
                <div class="rightContainer" style="gap: 0rem;">
                    <div class="socialAnchorTags">
                        <a href=""><img id="instagram" src="{{ asset('asset/images/instagram.svg') }}" alt="Instagram" loading="lazy"></a>
                        <a href=""><img id="tiktok" src="{{ asset('asset/images/tiktok.svg') }}" alt="TikTok" loading="lazy"></a> <a href=""><img id="linkedin" src="{{ asset('asset/images/linkedin.svg') }}" alt="LinkedIn" loading="lazy"></a>
                    </div>
                </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('asset/js/index.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

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
                            var forgetModal = bootstrap.Modal.getInstance(document.getElementById('forgetModal'));
                            forgetModal.hide();
                        } else {
                            alert("Fehler beim Senden des Links zum Zurücksetzen des Passworts.");
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

            // Cookie Consent Modal
            if (!localStorage.getItem('cookieConsent')) {
                var cookieModal = new bootstrap.Modal(document.getElementById('cookieConsentModal'));
                cookieModal.show();
            }

            // Funktion zum Anzeigen der Toast-Nachricht
            function showToast(message) {
                var toast = document.createElement('div');
                toast.className = 'toast align-items-center text-white bg-primary border-0';
                toast.role = 'alert';
                toast.ariaLive = 'assertive';
                toast.ariaAtomic = 'true';
                toast.innerHTML = `
                    <div class="d-flex">
                        <div class="toast-body">${message}</div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                `;
                document.body.appendChild(toast);
                var bsToast = new bootstrap.Toast(toast, {
                    delay: 3000
                });
                bsToast.show();
                toast.addEventListener('hidden.bs.toast', function() {
                    toast.remove();
                });
            }

            // Cookies akzeptieren
            document.getElementById('acceptCookies').addEventListener('click', function() {
                var consent = {
                    necessary: true,
                    analytics: document.getElementById('analyticsCookies').checked,
                    marketing: document.getElementById('marketingCookies').checked
                };
                localStorage.setItem('cookieConsent', JSON.stringify(consent));
                showToast('Ihre Cookie-Einstellungen wurden gespeichert.');
                var cookieModal = bootstrap.Modal.getInstance(document.getElementById('cookieConsentModal'));
                cookieModal.hide();
            });

            // Cookies ablehnen
            document.getElementById('declineCookies').addEventListener('click', function() {
                var consent = {
                    necessary: true,
                    analytics: false,
                    marketing: false
                };
                localStorage.setItem('cookieConsent', JSON.stringify(consent));
                showToast('Ihre Cookie-Einstellungen wurden gespeichert.');
                var cookieModal = bootstrap.Modal.getInstance(document.getElementById('cookieConsentModal'));
                cookieModal.hide();
            });

            // Pfeil-nach-oben-Button
            var arrowUp = document.getElementById('arrowUp');
            var arrowUpContainer = document.getElementById('arrowUpContainer');

            window.addEventListener('scroll', function() {
                if (window.scrollY > window.innerHeight) {
                    arrowUp.classList.add('visible');
                    arrowUp.classList.remove('hidden');
                    arrowUpContainer.classList.add('visible');
                    arrowUpContainer.classList.remove('hidden');
                } else {
                    arrowUp.classList.add('hidden');
                    arrowUp.classList.remove('visible');
                    arrowUpContainer.classList.add('hidden');
                    arrowUpContainer.classList.remove('visible');
                }
            });

            arrowUp.addEventListener('click', function() {
                smoothScrollToTop();
            });

            // Pfeil-nach-oben-Button nach dem Scrollen nach oben ausblenden
            window.addEventListener('scroll', function() {
                if (window.scrollY === 0) {
                    arrowUp.classList.add('hidden');
                    arrowUp.classList.remove('visible');
                    arrowUpContainer.classList.add('hidden');
                    arrowUpContainer.classList.remove('visible');
                }
            });

            const passwordInput = document.getElementById('password_register');
            const passwordCriteria = document.getElementById('passwordCriteria');
            const criteria = {
                length: document.getElementById('lengthCriteria'),
                uppercase: document.getElementById('uppercaseCriteria'),
                number: document.getElementById('numberCriteria'),
                specialChar: document.getElementById('specialCharCriteria')
            };

            passwordInput.addEventListener('focus', () => passwordCriteria.classList.remove('hidden'));
            passwordInput.addEventListener('blur', () => {
                if (passwordInput.value === '') passwordCriteria.classList.add('hidden');
            });
            passwordInput.addEventListener('input', function() {
                const password = passwordInput.value;
                criteria.length.classList.toggle('text-success', password.length >= 8);
                criteria.length.classList.toggle('text-danger', password.length < 8);
                criteria.uppercase.classList.toggle('text-success', /[A-Z]/.test(password));
                criteria.uppercase.classList.toggle('text-danger', !/[A-Z]/.test(password));
                criteria.number.classList.toggle('text-success', /\d/.test(password));
                criteria.number.classList.toggle('text-danger', !/\d/.test(password));
                criteria.specialChar.classList.toggle('text-success', /[!@#$%^&*(),.?":{}|<>]/.test(password));
                criteria.specialChar.classList.toggle('text-danger', !/[!@#$%^&*(),.?":{}|<>]/.test(password));
            });
        });

        // Funktion zum sanften Scrollen nach oben
        function smoothScrollToTop() {
            const scrollDuration = 300; // Dauer in ms
            const scrollStep = -window.scrollY / (scrollDuration / 15);
            const scrollInterval = setInterval(function() {
                if (window.scrollY !== 0) {
                    window.scrollBy(0, scrollStep);
                } else {
                    clearInterval(scrollInterval);
                }
            }, 15);
        }

        // Passwort-Sichtbarkeit umschalten
        function togglePasswordVisibility() {
            const passwordRegisterInput = document.getElementById('password_register');
            const passwordLoginInput = document.getElementById('password_login');
            const toggleIcons = document.querySelectorAll('.toggle-password img');

            if (passwordRegisterInput) {
                const type = passwordRegisterInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordRegisterInput.setAttribute('type', type);
                toggleIcons[0].src = type === 'password' ? "{{ asset('asset/images/eye.svg') }}" : "{{ asset('asset/images/eye-off.svg') }}";
            }

            if (passwordLoginInput) {
                const type = passwordLoginInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordLoginInput.setAttribute('type', type);
                toggleIcons[1].src = type === 'password' ? "{{ asset('asset/images/eye.svg') }}" : "{{ asset('asset/images/eye-off.svg') }}";
            }
        }

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
    </script>
</body>

</html>
