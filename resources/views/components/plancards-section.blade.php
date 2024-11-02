<script src="https://www.paypal.com/sdk/js?client-id={{ config('services.paypal.client_id') }}&vault=true&intent=subscription"></script>
<script src="{{ asset('asset/js/toast.js') }}"></script>
<link rel="stylesheet" href="{{ asset('asset/css/plancards.css') }}">
<section class="planCardsSection">
    <div class="planCardsContainer">
        <img id="upperDesign" src="{{ asset('asset/images/patterns.png') }}" alt="Oberes Design" loading="lazy">

        <div class="planCard">
            <div class="plancardHeader">
                <img class="crownImg" src="{{ asset('asset/images/landingpage/silber.png') }}" alt="Kronenbild Silber" loading="lazy">
                <h2 style="color: #fff">Silber</h2>
            </div>
            <div class="plancardContent">
                <span class="highSpan">Kostenlos <span class="lowSpan"></span></span>
                <p class="plancardbenefit">Dein Genie kann:</p>
                <p class="planCardParagraph" style="line-height: 2.5;">
                    <span class="textmarker">✓ Fragen beantworten</span><br />
                    <span class="textmarker">✓ Traumberufe finden</span><br />
                    <span class="textmarker">✓ Berufsinformationen</span><br />
                </p>
                @guest
                <button data-bs-toggle="modal" data-bs-target="#signupModal" class="plancardButton">Kostenlos</button>
            @else
                @if(auth()->user()->subscription_name == 'Silber')
                    <button class="plancardButton" disabled>Aktueller Status</button>
                @else
                    <button class="plancardButton" id="silberButton">Kostenlos</button>
                @endif
            @endguest
            </div>

        </div>

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

        <div class="planCard">
            <div class="plancardHeader">
                <img class="crownImg" src="{{ asset('asset/images/landingpage/gold.png') }}" alt="Kronenbild Gold" loading="lazy">
                <h2 style="color: #fff">Gold</h2>
            </div>
            <div class="plancardContent">
                <span class="highSpan">10 € <span class="lowSpan">/ Monat<br /></span></span>
                <p class="plancardbenefit">Alles aus Silber +</p>
                <p class="planCardParagraph" style="line-height: 2.5;">
                    <span class="blue-textmarker">✓ Inspiration beim Schreibe</span><br />
                    <span class="blue-textmarker">✓ Texte analysieren</span><br />
                    <span class="blue-textmarker">✓ Bewerbungsunterlagen</span><br />
                </p>
                @guest
                    <button data-bs-toggle="modal" data-bs-target="#signupModal" class="plancardButton">Hol dir Gold</button>
                @else
                    @if(auth()->user()->subscription_name == 'Gold')
                        @if(auth()->user()->subscription_status === 'cancelled')
                            <button class="plancardButton" disabled>Gekündigt</button>
                            <div class="alert alert-warning subscription-alert">
                                Läuft am {{ auth()->user()->subscription_end_date ? auth()->user()->subscription_end_date->format('d.m.Y') : now()->addMonth()->format('d.m.Y') }} aus
                            </div>
                        @else
                            <button class="plancardButton cancel-subscription" data-plan="{{ auth()->user()->subscription_name }}">Abo kündigen</button>
                        @endif
                    @else
                        <button class="plancardButton" data-bs-toggle="modal" data-bs-target="#paypalModalGold">Hol dir Gold</button>
                    @endif
                @endguest
            </div>
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
            <div class="plancardHeader">
                <div class="ribbon ribbon-top-left"><span>Empfohlen</span></div>
                <img class="crownImg" src="{{ asset('asset/images/landingpage/diamant.png') }}" alt="Kronenbild Diamant" loading="lazy">
                <h2 style="color: #fff">Diamant</h2>
            </div>
            <div class="plancardContent">
                <span class="highSpan">20 € <span class="lowSpan">/ Monat<br /></span></span>
                <p class="plancardbenefit">Silber + Gold +</p>
                <p class="planCardParagraph" style="line-height: 2.5;">
                    <span class="green-textmarker">✓ Persönlicher Tutor</span><br />
                    <span class="green-textmarker">✓ Individueller Karriere Mentor</span>
                    <br /><br />
                </p>
                @guest
                    <button data-bs-toggle="modal" data-bs-target="#signupModal" class="plancardButton">Hol dir Diamant</button>
                @else
                    @if(auth()->user()->subscription_name == 'Diamant')
                        @if(auth()->user()->subscription_status === 'cancelled')    
                            <button class="plancardButton" disabled>Gekündigt</button>
                            <div class="alert alert-warning subscription-alert">
                                Läuft am {{ auth()->user()->subscription_end_date ? auth()->user()->subscription_end_date->format('d.m.Y') : now()->addMonth()->format('d.m.Y') }} aus
                            </div>
                        @else
                            <button class="plancardButton cancel-subscription" data-plan="Diamant">Abo kündigen</button>
                        @endif
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

        <!-- Modal für Abo-Kündigung -->
        <div class="modal fade" id="cancelSubscriptionModal" tabindex="-1" aria-labelledby="cancelSubscriptionModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cancelSubscriptionModalLabel">Abo kündigen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Möchtest du dein <span id="planType"></span>-Abo wirklich kündigen?</p>
                        <p>Das Abo läuft noch bis zum Ende der aktuellen Periode und wird dann nicht verlängert.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
                        <button type="button" class="btn btn-danger" id="confirmCancelButton">Abo kündigen</button>
                    </div>
                </div>
            </div>
        </div>

        <img id="lowerDesign" src="{{ asset('asset/images/patterns1.png') }}" alt="Unteres Design" loading="lazy">
    </div>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.4.0/dist/confetti.browser.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const subscription_name = @json(auth()->check() ? auth()->user()->subscription_name : '');
            
            if (localStorage.getItem('subscription_cancelled') === 'true') {
                showToast('Dein Abo wurde erfolgreich gekündigt und läuft zum Ende der Laufzeit aus.', 'success');
                localStorage.removeItem('subscription_cancelled');
            } else if (localStorage.getItem('subscription_updated') === 'true') {
                showSuccessMessage(subscription_name);
                if (subscription_name !== 'Silber' && subscription_name !== '') {
                    showConfetti();
                }
                localStorage.removeItem('subscription_updated');
            }

            function createPayPalButton(planId, planName, buttonId) {
                if (typeof $ === 'undefined') {
                    console.error('jQuery ist nicht geladen. PayPal-Integration kann nicht initialisiert werden.');
                    return;
                }

                $(`#paypalModal${planName}`).on('shown.bs.modal', function () {
                    paypal.Buttons({
                        createSubscription: function(data, actions) {
                            return actions.subscription.create({
                                'plan_id': planId
                            });
                        },
                        onApprove: function(data, actions) {
                            // Sicherere Abfrage des aktuellen Plans
                            const currentPlan = document.querySelector('meta[name="user-subscription"]')?.content || 'Silber';
                            const changeType = determineSubscriptionChange(currentPlan, planName);
                            
                            fetch('{{ route('subscriptions.update') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({ 
                                    plan_name: planName,
                                    subscription_id: data.subscriptionID 
                                })
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Netzwerk-Antwort war nicht ok');
                                }
                                return response.json();
                            })
                            .then(data => {
                                if (data.success) {
                                    $(`#paypalModal${planName}`).modal('hide');
                                    localStorage.setItem('subscription_updated', 'true');
                                    
                                    if (changeType === 'upgrade') {
                                        showToast(`Herzlichen Glückwunsch, du bist nun ein ${planName}-Abonnent!`, 'success');
                                        showConfetti();
                                    } else {
                                        showToast(`Dein Abonnement wurde auf ${planName} geändert.`, 'info');
                                    }
                                    location.reload();
                                } else {
                                    showToast(data.message || 'Ein Fehler ist aufgetreten', 'error');
                                }
                            })
                            .catch(error => {
                                console.error('Fehler:', error);
                                showToast('Ein Fehler ist aufgetreten bei der Aktualisierung des Abonnements', 'error');
                            });
                        }
                    }).render(buttonId);
                });
            }

            // PayPal-Buttons für Gold und Diamant rendern
            createPayPalButton('{{ config('services.paypal.gold_plan_id') }}', 'Gold', '#paypal-button-gold');
            createPayPalButton('{{ config('services.paypal.diamant_plan_id') }}', 'Diamant', '#paypal-button-diamant');

            document.addEventListener('DOMContentLoaded', function() {
                // Überprüfen, ob der Silber-Button existiert, bevor der Event Listener hinzugefügt wird
                const silberButton = document.getElementById('silberButton');
                if (silberButton) {
                    silberButton.addEventListener('click', function() {
                        $('#confirmSilberModal').modal('show');
                    });
                }

                // Event Listener für den Bestätigungsbutton im Modal
                document.getElementById('confirmSilberButton').addEventListener('click', function() {
                    fetch('{{ route('subscriptions.update') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ plan_name: 'Silber' })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Netzwerk-Antwort war nicht ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            location.reload();
                            localStorage.setItem('subscription_updated', 'true');
                        } else {
                            showToast(data.message || 'Ein Fehler ist aufgetreten', 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Fehler:', error);
                        showToast('Ein Fehler ist aufgetreten bei der Aktualisierung des Abonnements', 'error');
                    });
                });
            });

            // Event Listener für Kündigungs-Buttons
            document.querySelectorAll('.cancel-subscription').forEach(button => {
                button.addEventListener('click', function() {
                    const planType = this.getAttribute('data-plan');
                    document.getElementById('planType').textContent = planType;
                    const modal = new bootstrap.Modal(document.getElementById('cancelSubscriptionModal'));
                    modal.show();
                });
            });

            // Event Listener für Kündigungs-Bestätigung
            document.getElementById('confirmCancelButton').addEventListener('click', function() {
                fetch('{{ route('subscriptions.cancel') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                        localStorage.setItem('subscription_cancelled', 'true'); // Geändert von subscription_updated
                        showToast('Dein Abo wurde erfolgreich gekündigt und läuft zum Ende der Laufzeit aus.', 'success');
                    } else {
                        showToast('Es gab einen Fehler bei der Kündigung. Bitte versuche es später erneut.', 'error');
                    }
                });
                
                bootstrap.Modal.getInstance(document.getElementById('cancelSubscriptionModal')).hide();
            });
        });

        function showConfetti() {
            const particleCount1 = Math.floor(Math.random() * 301) + 100;
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

        function showSuccessMessage(plan_name) {
            const modalHTML = `
                <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-body text-center">
                                <p>${plan_name === 'Silber' ? `Du bist jetzt wieder ${plan_name} Abonnent.` : `Herzlichen Glückwunsch! Du bist jetzt ${plan_name} Abonnent.`}</p>
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

        function determineSubscriptionChange(oldPlan, newPlan) {
            const planHierarchy = {
                'Silber': 1,
                'Gold': 2,
                'Diamant': 3
            };
            
            return planHierarchy[newPlan] > planHierarchy[oldPlan] ? 'upgrade' : 'downgrade';
        }
    </script>
</section>

<meta name="user-subscription" content="{{ auth()->user()?->subscription_name ?? 'Silber' }}">

