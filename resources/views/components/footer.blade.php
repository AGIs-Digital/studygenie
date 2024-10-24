<link rel="stylesheet" href="{{ asset('asset/css/footer.css') }}">
<footer class="mainFooterContainer fixed-bottom">
    <div class="footerContainer">
        <!-- Logo Bereich -->
        <div class="logoContainer">
        <a href="/">
            <img id="footerLogo" width="110" height="63" src="{{ asset('asset/images/Logo_(2).png') }}" alt="Logo" loading="lazy">
        </a>
        </div>
        <nav class="linksContainer">
            <a style="text-decoration: none; color:black" href="{{ route('impressum') }}" class="footerLink">Impressum</a>
            <a style="text-decoration: none; color:black" href="{{ route('agb') }}" class="footerLink">AGBs</a>
            <a style="text-decoration: none; color:black" href="{{ route('datenschutz') }}" class="footerLink">Datenschutz</a>
        </nav>
        <!-- Social Media Bereich -->
        <div class="socialContainer">
            <a href="#"><img width="45" height="45" src="{{ asset('asset/images/instagram.svg') }}" alt="Instagram" loading="lazy"></a>
            <a href="#"><img width="45" height="45" src="{{ asset('asset/images/tiktok.svg') }}" alt="TikTok" loading="lazy"></a>
            <a href="#"><img width="45" height="45" src="{{ asset('asset/images/linkedin.svg') }}" alt="LinkedIn" loading="lazy"></a>
        </div>
    </div>
</footer>