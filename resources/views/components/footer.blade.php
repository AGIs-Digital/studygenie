<link rel="stylesheet" href="{{ asset('asset/css/footer.css') }}">
<footer class="mainFooterContainer">
    <div class="footerContainer">
        <!-- Logo Bereich -->
        <div class="logoContainer">
            <img id="footerLogo" src="{{ asset('asset/images/Logo_(2).png') }}" alt="Logo" loading="lazy">
        </div>
        <!-- Link Bereich -->
        <nav class="linksContainer">
            <a href="{{ route('impressum') }}" class="footerLink">Impressum</a>
            <a href="{{ route('agb') }}" class="footerLink">AGBs</a>
            <a href="{{ route('datenschutz') }}" class="footerLink">Datenschutz</a>
        </nav>
        <!-- Social Media Bereich -->
        <div class="socialContainer">
            <a href="#"><img src="{{ asset('asset/images/instagram.svg') }}" alt="Instagram" loading="lazy"></a>
            <a href="#"><img src="{{ asset('asset/images/tiktok.svg') }}" alt="TikTok" loading="lazy"></a>
            <a href="#"><img src="{{ asset('asset/images/linkedin.svg') }}" alt="LinkedIn" loading="lazy"></a>
        </div>
    </div>
</footer>