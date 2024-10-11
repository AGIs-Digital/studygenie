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
    @include('components.problem-solution-section')
    @include('components.cookie-consent')
    @include('components.benefits-section')
    @include('components.arrowupbutton')
    @include('components.login-modal')
    @include('components.tooglePasswordVisibility')
    @include('components.signup-modal')
    @include('components.testimonials-section')
    @include('components.toolpreview-section')

    <div align="center" style="padding-top: 50px; padding-bottom: 35px;">
        <img src="{{ asset('asset/images/swoosh1.png') }}" alt="swoosh1" loading="lazy">
    </div>

    <section class="planCardsSection">
        <h2>Dein persönlicher Genie</h2>
        @include('components.plancards-section')
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

    <section class="call-to-actionSection">
        <h2>Worauf wartest du?</h2>
        <p>Starte jetzt kostenlos durch und mach dir das Leben leichter 🚀</p>
        <button data-bs-toggle="modal" data-bs-target="#signupModal" class="plancardButton">Jetzt ausprobieren</button>
    </section>

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