<section class="testimonialsSection">
    <img class="crownImg" src="{{ asset('asset/images/augeneu.png') }}" alt="Kronenbild" loading="lazy">
    <h2>Sie lieben es <span>&#128525;</span></h2>
    <p>Das Fazit von unseren Nutzern</p>
    <div class="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                    <img src="{{ asset('asset/images/landingpage/testimonial1.jpg') }}" alt="testimonial1" loading="lazy">
                    <h4>Kevin</h4>
                    <p>"Mit StudyGenie konnte ich meine Schwierigkeiten in Mathe überwinden und habe nun eine 2 geschrieben."</p>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('asset/images/landingpage/testimonial3.jpg') }}" alt="testimonial2" loading="lazy">
                    <h4>Arthur</h4>
                    <p>"Dank StudyGenie waren meine Bewerbungsunterlagen perfekt und ich war optimal auf das Vorstellungsgespräch vorbereitet."</p>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('asset/images/landingpage/testimonial2.jpg') }}" alt="testimonial3" loading="lazy">
                    <h4>Sophie</h4>
                <p>"Cool - das stufenweise Heranführen über Fragen und das Checken, welches Wissen tatsächlich bereits vorhanden ist!! So wird jeder individuell abgeholt. TOP"</p>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const items = document.querySelectorAll('.carousel-item');
        let currentItem = 0;

        function showNextItem() {
            items[currentItem].classList.remove('active');
            currentItem = (currentItem + 1) % items.length;
            items[currentItem].classList.add('active');
        }

        setInterval(showNextItem, 4500);
    });
</script>