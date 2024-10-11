<section class="problem-solutionSection">
    <img class="crownImg" src="{{ asset('asset/images/crowngrafiti.png') }}" alt="Kronenbild" loading="lazy">
    <h2>Gemeinsam schaffen wir das</h2>
    <p>Wir unterstützen dich in der Schule, im Studium und beim Start in den Beruf.</p>
    <div class="video_sec">
        <video controls id="home_video" loading="lazy" preload="metadata">
            <source src="{{ asset('asset/Videos/video_klein.mp4') }}" type="video/mp4">
            Ihr Browser unterstützt das Video-Tag nicht.
        </video>
        <script>
            document.getElementById('home_video').addEventListener('contextmenu', function(e) {
                e.preventDefault();
            }, false);
        </script>
        <img class="problem-solutionImage" src="{{ asset('asset/images/pic_mac_book.png') }}" alt="Mac Book Bild"
            loading="lazy">
    </div>
    <div class="buttonContainer">
        <img src="{{ asset('asset/images/69.png') }}" alt="Vorwärtspfeil" loading="lazy">
        <button data-bs-toggle="modal" data-bs-target="#signupModal" class="plancardButton">Jetzt
            starten</button>
        <img src="{{ asset('asset/images/68.png') }}" alt="Rückwärtspfeil" loading="lazy">
    </div>
</section>