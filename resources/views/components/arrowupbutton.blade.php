    <!-- Arrow Up Button -->
    <div class="arrow-up hidden" id="arrowUpContainer">
        <img src="{{ asset('asset/images/arrow-up.svg') }}" id="arrowUp" class="hidden" alt="Nach oben">
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
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

            window.addEventListener('scroll', function() {
                if (window.scrollY === 0) {
                    arrowUp.classList.add('hidden');
                    arrowUp.classList.remove('visible');
                    arrowUpContainer.classList.add('hidden');
                    arrowUpContainer.classList.remove('visible');
                }
            });
        });

        function smoothScrollToTop() {
            const scrollDuration = 300;
            const scrollStep = -window.scrollY / (scrollDuration / 15);
            const scrollInterval = setInterval(function() {
                if (window.scrollY !== 0) {
                    window.scrollBy(0, scrollStep);
                } else {
                    clearInterval(scrollInterval);
                }
            }, 15);
        }
    </script>