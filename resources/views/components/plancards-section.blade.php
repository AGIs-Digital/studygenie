<!-- Fügen Sie den PayPal SDK ein -->
<script src="https://www.paypal.com/sdk/js?client-id=Ae9G4SKK4gDuWY0Yw7J_6irXsfPepGSudxvUktzRQlYbdnOKTaDp2xmuC1mCWS6GTvalCH9Owt-HUl4S&vault=true&intent=subscription"></script>
<script src="{{ asset('asset/js/toast.js') }}"></script>

<div class="planCardsContainer">
    <img id="upperDesign" src="{{ asset('asset/images/patterns.png') }}" alt="Oberes Design" loading="lazy">
    
    <div class="planCard">
        <div class="headerPlanCard">
            <img class="crownImg" src="{{ asset('asset/images/landingpage/silber.png') }}" alt="Kronenbild Silber" loading="lazy">
            <h1 class="secondary-Heading" style="color: #fff">Silber</h1>
        </div>
        <div class="contentPlanCard contentPlanCard1">
            <span class="highWeightSpan">Kostenlos<span class="lowWeightSpan"><span><br />Du bekommst:</span></span>
            <p class="planCardParagraph">

                <span class="textmarker">✓ Intelligente Soforthilfe</span><br />
                <span class="textmarker">✓ Traumberuf finden</span><br />
                <span class="textmarker">✓ Berufsinformationen</span><br /> 
            </p>
            </span>
        </div>
        @guest
            <button data-bs-toggle="modal" data-bs-target="#loginModal" class="plancardButton">Kostenlos</button>
        @else
            @if(auth()->user()->subscription_name == 'silber')
                <button class="plancardButton" disabled>Aktueller Status</button>
            @else
                <button class="plancardButton" id="silberButton">Kostenlos</button>
            @endif
        @endguest
    </div>
    
    <div class="planCard">
        <div class="headerPlanCard">
            <img class="crownImg" src="{{ asset('asset/images/landingpage/gold.png') }}" alt="Kronenbild Gold" loading="lazy">
            <h1 class="secondary-Heading" style="color: #fff">Gold</h1>
        </div>
        <div class="contentPlanCard contentPlanCard1">
            <span class="highWeightSpan">10 € <span class="lowWeightSpan">/ Monat<span><br />Alles aus Silber +</span></span>
            <p class="planCardParagraph">
                <span class="blue-textmarker">✓ Textinspirationen</span><br /> 
                <span class="blue-textmarker">✓ Textanalysen</span><br /> 
                <span class="blue-textmarker">✓ Bewerbungsunterlagen</span><br /> 
            </p>
            </span>
            @guest
                <button data-bs-toggle="modal" data-bs-target="#loginModal" class="plancardButton">Hol dir Gold</button>
            @else
                @if(auth()->user()->subscription_name == 'gold')
                    <button class="plancardButton" disabled>Aktueller Status</button>
                @else
                    <button class="plancardButton" data-bs-toggle="modal" data-bs-target="#paypalModalGold">Hol dir Gold</button>
                @endif
            @endguest
        </div>
        <br />
    </div>
    
    <!-- Modal für PayPal Gold -->
    <div class="modal fade" id="paypalModalGold" tabindex="-1" aria-labelledby="paypalModalGoldLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paypalModalGoldLabel">Zahlungsmöglichkeiten</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="paypal-button-gold"></div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="planCard">
        <div class="headerPlanCard">
            <div class="ribbon ribbon-top-left"><span>Empfohlen</span></div>
            <img class="crownImg" src="{{ asset('asset/images/landingpage/diamant.png') }}" alt="Kronenbild Diamant" loading="lazy">
            <h1 class="secondary-Heading" style="color: #fff">Diamant</h1>
        </div>
        <div class="contentPlanCard contentPlanCard1">
            <span class="highWeightSpan">20 € <span class="lowWeightSpan">/ Monat<span><br />Alles aus Gold +</span></span>
            <p class="planCardParagraph">
                <span class="green-textmarker">✓ Tutor</span><br /> 
                <span class="green-textmarker">✓ Karriere Mentor</span>
                <br /><br />
            </p>
            </span>
            @guest
                <button data-bs-toggle="modal" data-bs-target="#loginModal" class="plancardButton">Hol dir Diamant</button>
            @else
                @if(auth()->user()->subscription_name == 'diamant')
                    <button class="plancardButton" disabled>Aktueller Status</button>
                @else
                    <button class="plancardButton" data-bs-toggle="modal" data-bs-target="#paypalModalDiamant">Hol dir Diamant</button>
                @endif
            @endguest
        </div>
    </div>
    
    <!-- Modal für PayPal Diamant -->
    <div class="modal fade" id="paypalModalDiamant" tabindex="-1" aria-labelledby="paypalModalDiamantLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paypalModalDiamantLabel">Zahlungsmöglichkeiten</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="paypal-button-diamant"></div>
                </div>
            </div>
        </div>
    </div>
    
    <img id="lowerDesign" src="{{ asset('asset/images/patterns1.png') }}" alt="Unteres Design" loading="lazy">
</div>
<script>
    function showToast(message, type) {
        // Implementiere die Toast-Anzeige hier
        console.log(message);
    }
    function showSuccessMessage() {
            const modalHTML = `
            <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <p>Herzlichen Glückwunsch! Du hast ein Diamant-Abonnement erhalten.</p>
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

    function showConfetti() {
        // Implementiere die Konfetti-Animation hier
        console.log('Confetti animation');
    }

    // Render PayPal buttons for Gold and Diamant subscriptions
    paypal.Buttons({
        createSubscription: function(data, actions) {
            return actions.subscription.create({
                'plan_id': '{{ config('services.paypal.gold_plan_id') }}'
            });
        },
        onApprove: function(data, actions) {
            fetch('{{ route('subscriptions.update') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ plan_name: 'gold' })
            })
            .then(response => response.json())
            .then(data => {
                if (data.message === 'Subscription updated successfully') {
                    location.reload();
                    showToast('Herzlichen Glückwunsch, du bist nun ein Gold-Abonnent!', 'success');
                    showConfetti();

                }
            });
        }
    }).render('#paypal-button-gold');

    paypal.Buttons({
        createSubscription: function(data, actions) {
            return actions.subscription.create({
                'plan_id': '{{ config('services.paypal.diamant_plan_id') }}'
            });
        },
        onApprove: function(data, actions) {
            fetch('{{ route('subscriptions.update') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ plan_name: 'diamant' })
            })
            .then(response => response.json())
            .then(data => {
                if (data.message === 'Subscription updated successfully') {
                    location.reload();
                    showToast('Herzlichen Glückwunsch, du bist nun ein Diamant-Abonnent!', 'success');
                    showConfetti();
                }
            });
        }
    }).render('#paypal-button-diamant');
</script>
<!-- Bestätigungsmodal für Silber -->
<div class="modal fade" id="confirmSilberModal" tabindex="-1" aria-labelledby="confirmSilberModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmSilberModalLabel">Abo zu Silber wechseln</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Möchtest du wirklich zu Silber wechseln? Du hast dann nach Ablauf deines jetzigen Plans keinen Zugriff auf manche Tools mehr.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Abo behalten</button>
                <button type="button" class="btn btn-danger" id="confirmSilberButton">Silber</button>
            </div>
        </div>
    </div>
</div>
<script>
    function showToast(message, type) {
        // Implementiere die Toast-Anzeige hier
        console.log(message);
    }

    function showConfetti() {
        // Implementiere die Konfetti-Animation hier
        console.log('Confetti animation');
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Event Listener für den Silber-Button
        document.getElementById('silberButton').addEventListener('click', function() {
            $('#confirmSilberModal').modal('show');
        });

        // Event Listener für den Bestätigungsbutton im Modal
        document.getElementById('confirmSilberButton').addEventListener('click', function() {
            fetch('{{ route('subscriptions.update') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ plan_name: 'silber' })
            })
            .then(response => response.json())
            .then(data => {
                if (data.message === 'Subscription updated successfully') {
                    location.reload(); // Seite neu laden
                }
            });
        });

        // Überprüfen, ob die Seite neu geladen wurde
        if (performance.navigation.type === 1) {
            showToast('Du hast jetzt den Silber Status', 'success');
            showConfetti();
        }
    });
</script>