<!DOCTYPE html>
<html lang="de">
<head>
    <title>StudyGenie</title>
    @include('components.head')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('asset/js/toast.js') }}"></script>
</head>
@include('components.navbar')
@include('components.feedback')
<body class="MainContainer">
    <div class="headerSpacer"></div>
    @include('components.heroimage-section')
    @include('components.learn-anything-section')
    @include('components.cookie-consent')
    @include('components.mathrix-section')
    @include('components.arrowupbutton')
    @include('components.login-modal')
    @include('components.tooglePasswordVisibility')
    @include('components.signup-modal')
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Google Login
            var googleLoginButton = document.getElementById('google-login');
            if (googleLoginButton) {
                googleLoginButton.addEventListener('click', function() {
                    window.location.href = "{{ url('login/google') }}";
                });
            }
        });
    </script>
</body>
</html>