<section class="testimonialsSection">
    <div class="container">
        <h2>Sie lieben es <span>&#128525;</span></h2>
        <br>
        <div class="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('asset/images/landingpage/testimonial1.png') }}" alt="Sophia B.">
                    <p>"Ich fühle mich jetzt viel sicherer in meiner Karriereplanung!", wunderbar!</p>
                    <h4>Otto B.</h4>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('asset/images/landingpage/testimonial3.png') }}" alt="Max M.">
                    <p>"Die Unterstützung war unglaublich!, sehr hilfreich!"</p>
                    <h4>Max M.</h4>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('asset/images/landingpage/testimonial2.png') }}" alt="Kim M.">
                    <p>"Wow, das mit der Bewerbung ging ja schnell!"</p>
                    <h4>Sophia M.</h4>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('asset/images/landingpage/testimonial3.png') }}" alt="Anna K.">
                    <p>"Ich habe viel gelernt und fühle mich bereit, danke!"</p>
                    <h4>Kim K.</h4>
                </div>
            </div>
        </div>
    </div>
</section>

<style>

</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const items = document.querySelectorAll('.carousel-item');
        let currentItem = 0;

        function showNextItem() {
            items[currentItem].classList.remove('active');
            currentItem = (currentItem + 1) % items.length;
            items[currentItem].classList.add('active');
        }

        setInterval(showNextItem, 3500); // Change item every 3 seconds
    });
</script>