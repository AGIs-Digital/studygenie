<!DOCTYPE html>
<html lang="de">

<head>
    @section('title', 'StudyGenie')
    @include('components.head')
    <link rel="stylesheet" href="{{ asset('asset/css/clouds.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
@include('components.navbar')
<body class="MainContainer">
    <div class="headerSpacer"></div>
    @include('components.feedback')

    <main class="mainContainer">
        <img src="{{ asset('asset/images/ab1.svg') }}" class="ab5" alt="">
        <img src="{{ asset('asset/images/ab2.svg') }}" class="ab6" alt="">
        <img src="{{ asset('asset/images/ab3.svg') }}" class="ab7" alt="">
        <img src="{{ asset('asset/images/ab4.svg') }}" class="ab8" alt="">

        <div class="headerMainContainer">
            <div class="closetool" style="height: 34px">
            </div>
            <div class="centerCon">
                <h1 >Wobei kann ich dir helfen?</h1><br />
                <img id="StudyGenieImage" src="{{ asset('asset/images/toolsImage.svg') }}" alt="StudyGenieImage">
            </div>
        </div>

        <div class="categoryClouds twoClouds">
            <a href="/bildung" class="Cloud">
                <svg xmlns="http://www.w3.org/2000/svg" width="245" height="167" viewBox="0 0 245 167" fill="none">
                    <image href="{{ asset('asset/images/cloud-background.svg') }}" width="245" height="167"/>
                    <x-cloud-content 
                        tool-name="Bildung" 
                        bg-color="#E09E50"
                        text-color="#FFFFFF"
                        position-x="30"
                        position-y="30"
                        size="large"
                    />
                </svg>
            </a>

            <a href="{{ route('karriere.index') }}" class="Cloud_Karriere">
                <svg xmlns="http://www.w3.org/2000/svg" width="245" height="167" viewBox="0 0 245 167" fill="none">
                    <image href="{{ asset('asset/images/cloud-background.svg') }}" width="245" height="167"/>
                    <x-cloud-content 
                        tool-name="Karriere" 
                        bg-color="#2D3E4E"
                        text-color="#FFFFFF"
                        position-x="30"
                        position-y="30"
                        size="large"
                    />
                </svg>
            </a>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.4.0/dist/confetti.browser.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        const subscription_name = '{{ auth()->user()->subscription_name }}';
        if (localStorage.getItem('subscription_updated') === 'true') {
            showSuccessMessage(subscription_name);
                // Start of Selection
                if (subscription_name !== 'Silber') {
                    showConfetti();
                }
            localStorage.removeItem('subscription_updated');
        }
    });

        function showConfetti() {
            // Zufällige Werte für particleCount und spread zwischen 100 und 400
            const particleCount1 = Math.floor(Math.random() * 301) + 100; // 100-400
            const spread1 = Math.floor(Math.random() * 301) + 100;
            const origin1 = { x: Math.random(), y: Math.random() };

    confetti({
        particleCount: particleCount1,
        spread: spread1,
        origin: origin1
    });

    setTimeout(() => {
        const particleCount2 = Math.floor(Math.random() * 301) + 100;
        const spread2 = Math.floor(Math.random() * 301) + 100;
        const origin2 = { x: Math.random(), y: Math.random() };

        confetti({
            particleCount: particleCount2,
            spread: spread2,
            origin: origin2
        });
            }, 1500);
        }

        function showSuccessMessage(subscription_name) {
        const modalHTML = `
            <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <p>${subscription_name === 'Silber' ? `Du bist jetzt wieder ${subscription_name} Abonnent.` : `Herzlichen Glückwunsch! Du bist jetzt ${subscription_name} Abonnent.`}</p>
                        </div>
                    </div>
                </div>
            </div>
        `;
        document.body.insertAdjacentHTML('beforeend', modalHTML);
        const successModal = new bootstrap.Modal(document.getElementById('successModal'));
        successModal.show();

        setTimeout(() => {
            $('#successModal').fadeOut(4000, () => {
                successModal.hide();
                document.getElementById('successModal').remove();
            });
        }, 2000);
    }
    </script>
</body>

</html>
