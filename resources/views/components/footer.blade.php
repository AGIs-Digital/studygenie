<footer class="mainFooterContainer">
        <div class="footerContainer">
            <img id="footerLogo" src="{{ asset('asset/images/Logo_(2).png') }}" alt="Logo" loading="lazy">
            <div class="CenterContainer">
                <div class="anchorTagsFooterContainer">
                    <a href="{{ route('impressum') }}" class="footerHeading"> Impressum </a>
                </div>
                <div class="anchorTagsFooterContainer">
                    <a href="{{ route('agb') }}" class="footerHeading"> AGBs </a>

                </div>
                <div class="anchorTagsFooterContainer">
                    <a href="{{ route('datenschutz') }}" class="footerHeading"> Datenschutz </a>
                </div>

            </div>

            <div class="rightContainer" style="gap: 0rem;">
                <div class="socialAnchorTags">
                    <a href=""><img id="instagram" src="{{ asset('asset/images/instagram.svg') }}"
                            alt="Instagram" loading="lazy"></a>
                    <a href=""><img id="tiktok" src="{{ asset('asset/images/tiktok.svg') }}" alt="TikTok"
                            loading="lazy"></a> <a href=""><img id="linkedin"
                            src="{{ asset('asset/images/linkedin.svg') }}" alt="LinkedIn" loading="lazy"></a>
                </div>
            </div>
    </div>
</footer>