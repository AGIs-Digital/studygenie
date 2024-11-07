<!DOCTYPE html>
<html lang="de">
<head>
    <title>StudyGenie</title>
    @include('components.head')
    <meta http-equiv="Permissions-Policy" content="picture-in-picture=(self)">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://www.paypal.com/sdk/js?client-id={{ config('services.paypal.client_id') }}&vault=true&intent=subscription&components=applepay" data-sdk-integration-source="button-factory"></script>
    <script src="{{ asset('asset/js/toast.js') }}"></script>
</head>
@include('components.navbar')
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
    @include('components.wieso')
    @include('components.testimonials-section')
    @include('components.toolpreview-section')

    <div align="center" style="padding-bottom: 35px;">
        <img src="{{ asset('asset/images/swoosh1.svg') }}" alt="swoosh1" loading="lazy">
    </div>

    <h2 class="text-center">Dein persönlicher Genie</h2>
    @include('components.plancards-section')
    @include('components.faq-section')

    <section class="call-to-actionSection">
        <h2>Worauf wartest du?</h2>
        <p>Starte jetzt kostenlos durch und mach dir das Leben leichter 🚀</p>
        <button data-bs-toggle="modal" data-bs-target="#signupModal" class="plancardButton">Jetzt ausprobieren</button>
    </section>

    @include('components.footer')
</body>
</html>