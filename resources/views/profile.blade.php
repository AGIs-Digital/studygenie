<!DOCTYPE html>
<html lang="de">

<head>
    @section('title', Auth::check() ? auth()->user()->name . ' - Profil' : 'Profil')
    @include('includes.head')
    <link rel="stylesheet" href="{{ asset('asset/css/profile.css') }}">
    <script src="https://www.paypal.com/sdk/js?client-id=Abj-J9HxV5L4s1izmSlNl27AJLM0z71Z0BzLAVV4n7ClCYaxlBWEGdvfSBnSvY7beu-AhQv0YdMLOzcc&currency=EUR"></script>
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.4.0/dist/confetti.browser.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

</head>
@include('includes.header')
@include('components.feedback')
<body class="MainContainer">
    <div class="headerSpacer"></div>

    @include('components.tooglePasswordVisibility')

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h1>
                    {{ auth()->user()->name }} - Einstellungen
                    <img src="{{ asset('asset/images/profile.svg') }}">
                </h1>
            </div>
        </div>

        <!-- Display errors and success messages -->
        @foreach ($errors->all() as $error)
            <p class="text-danger">{{ $error }}</p>
        @endforeach

        @if(Session::has('success'))
            <div class="alert alert-success mt-4">
                <strong>{{Session::get('success')}}</strong>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    confetti({
                        particleCount: 900,
                        spread: 170,
                        origin: { x: 0.5, y: 0.5 }
                    });
                });    
            </script>
        @endif
            
        @if(Session::has('error'))
            <div class="alert alert-danger mt-4">
                <strong>{{Session::get('error')}}</strong>
            </div>
        @endif

        <!-- Password change form -->
        <form method="POST" action="{{ route('change.password') }}">
            @csrf
            <div class="content">
                <!-- Subscription plans -->
                <div class="row">
                    <!-- Silber Plan -->
                    <div class="col-md-4 d-flex justify-content-center">
                        <div class="planCard">
                            <div class="headerPlanCard">
                                <img class="crownImg" src="{{ asset('asset/images/landingpage/silber.png') }}" alt="Crown Image">
                                <h6 class="secondary-Heading">Silber</h6>
                            </div>
                            <div class="contentPlanCard contentPlanCard3">
                                <span class="highWeightSpan">0 €<span class="lowWeightSpan"> mtl.</span></span>
                                <p class="planCardParagraph">
                                <span class="textmarker">✓ Intelligente Soforthilfe</span><br /><span class="textmarker">✓ Traumberuf finden</span><br /><span class="textmarker">✓ Berufsinformationen</span><br />✘ Textinspirationen<br />✘ Textanalyse<br />
                                    ✘ Bewerbungsunterlagen<br />✘ Lerncoach<br />✘ Bewerbungstrainer
                                </p>
                                @guest
                                    <button data-bs-toggle="modal" data-bs-target="#loginModal" class="plancardButton">Kostenlos</button>
                                @else
                                    @if(auth()->user()->subscription_name == 'silber')
                                        <button class="plancardButton" disabled>Aktueller Status</button>
                                    @else
                                        <button class="plancardButton silberButton"> Kostenlos </button>
                                    @endif
                                @endguest
                            </div>
                            <br />
                        </div>
                    </div>

                    <!-- Gold Plan -->
                    <div class="col-md-4 d-flex justify-content-center">
                        <div class="planCard">
                            <div class="headerPlanCard">
                                <img class="crownImg" src="{{ asset('asset/images/landingpage/gold.png') }}" alt="Crown Image">
                                <h6 class="secondary-Heading">Gold</h6>
                            </div>
                            <div class="contentPlanCard contentPlanCard2">
                                <span class="highWeightSpan">10 €<span class="lowWeightSpan"> mtl.</span></span>
                                <p class="planCardParagraph">
                                    ✓ Intelligente Soforthilfe<br />✓ Traumberuf finden<br />✓ Berufsinformationen<br /><span class="blue-textmarker">✓ Textinspirationen</span><br /><span class="blue-textmarker">✓ Textanalyse</span><br />
                                    <span class="blue-textmarker">✓ Bewerbungsunterlagen</span><br />✘ Lerncoach<br />✘ Bewerbungstrainer
                                </p>
                                @guest
                                    <button data-bs-toggle="modal" data-bs-target="#signupModal" class="plancardButton">Hol dir Gold</button>
                                @else
                                    @if(auth()->user()->subscription_name == 'gold')
                                        <button class="plancardButton" disabled>Aktueller Status</button>
                                    @else
                                        <button class="plancardButton" data-paypal-route="{{ route('paypal.createSubscription') }}" data-paypal-plan="P-5XT70630D04889123M2LLU5A" data-is-subscription="true">
                                            Hol dir Gold
                                        </button>
                                    @endif
                                @endguest
                            </div>
                            <br />
                        </div>
                    </div>

                    <!-- Diamant Plan -->
                    <div class="col-md-4 d-flex justify-content-center">
                        <div class="planCard">
                            <div class="headerPlanCard">
                            <div class="ribbon ribbon-top-left"><span>Empfohlen</span></div>
                                <img class="crownImg" src="{{ asset('asset/images/landingpage/diamant.png') }}" alt="Crown Image">
                                <h6 class="secondary-Heading">Diamant</h6>
                            </div>
                            <div class="contentPlanCard contentPlanCard3">
                                <span class="highWeightSpan">20 €<span class="lowWeightSpan"> mtl.</span></span>
                                <p class="planCardParagraph">
                                    ✓ Intelligente Soforthilfe<br />✓ Traumberuf finden<br />✓ Berufsinformationen<br />✓ Textinspirationen<br />✓ Textanalyse<br />
                                    ✓ Bewerbungsunterlagen<br /><span class="green-textmarker">✓ Lerncoach</span><br /><span class="green-textmarker">✓ Bewerbungstrainer</span>
                                </p>
                                @guest
                                    <button data-bs-toggle="modal" data-bs-target="#loginModal" class="plancardButton">Hol dir Diamant</button>
                                @else
                                    @if(auth()->user()->subscription_name == 'diamant')
                                        <button class="plancardButton" disabled>Aktueller Status</button>
                                    @else
                                        <button class="plancardButton" data-paypal-route="{{ route('paypal.createSubscription') }}" data-paypal-plan="P-73N16093HM5621830M2LLU5I" data-is-subscription="true">
                                            Hol dir Diamant
                                        </button>
                                    @endif
                                @endguest
                            </div>
                            <br />
                        </div>
                    </div>
                </div>

                <br />

                <!-- Account settings and password change -->
                <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                        <button id="changePasswordButton" type="button" class="btn btn-outline-primary mx-2">Account Einstellungen</button>
                        <button id="deleteAccountButton" type="button" class="btn btn-outline-danger mx-2">Account löschen</button>
                    </div>
                </div>

                <div id="passwordChangeForm" class="hidden mt-4">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="input_group">
                                <label for="old_password">Altes Passwort</label>
                                <input type="password" name="old_password" class="form-control form-control-sm">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input_group">
                                <label for="new_password">Neues Passwort</label>
                                <div class="password-container">
                                    <input type="password" id="new_password" name="new_password" class="form-control form-control-sm">
                                    <span class="toggle-password" onclick="togglePasswordVisibility()">
                                        <img src="{{ asset('asset/images/eye.svg') }}" alt="Toggle Password Visibility" width="25" height="25">
                                    </span>
                                </div>
                                <div id="passwordCriteria" class="mt-2 hidden">
                                    <div class="criteria-row">
                                        <p id="lengthCriteria" class="text-danger"><span class="checkmark">✔</span> 8 Zeichen</p>
                                        <p id="uppercaseCriteria" class="text-danger"><span class="checkmark">✔</span> 1 Großbuchstabe</p>
                                        <p id="numberCriteria" class="text-danger"><span class="checkmark">✔</span> 1 Zahl</p>
                                        <p id="specialCharCriteria" class="text-danger"><span class="checkmark">✔</span> 1 Sonderzeichen</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input_group">
                                <label for="new_confirm_password">Wiederhole Neues Passwort</label>
                                <input type="password" name="new_confirm_password" class="form-control form-control-sm">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <button type="submit" class="btn btn-primary mt-2">Änderung speichern</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @include('components.footer')

    <!-- Payment Modal -->
    <div class="modal fade" id="payment_modal" tabindex="-1" aria-labelledby="payment_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="button_payment_box d-flex justify-content-center align-items-center" style="height: 100%;">
                        <div id="paypal-button-container"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Account Modal -->
    <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteAccountModalLabel">Account löschen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Sind Sie sicher, dass Sie Ihren Account und alle damit verbundenen Daten dauerhaft löschen möchten? Diese Aktion kann nicht rückgängig gemacht werden.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
                    <form method="POST" action="{{ route('user.destroy', ['user' => $user->id]) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Account löschen</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Silber confirmation -->
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

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="{{ asset('asset/js/toast.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // PayPal Button Rendering
            function renderPayPalButton(route, plan) {
                const container = document.getElementById('paypal-button-container');
                container.innerHTML = '';

                paypal.Buttons({
                    createOrder: function(data, actions) {
                        return fetch(route, {
                            method: 'post',
                            headers: {
                                'content-type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ plan_id: plan })
                        }).then(res => res.json())
                        .then(subscriptionData => {
                            if (subscriptionData.links) {
                                const approvalUrl = subscriptionData.links.find(link => link.rel === 'approve').href;
                                window.location.href = approvalUrl;
                            } else {
                                console.error('Subscription creation failed:', subscriptionData);
                            }
                        }).catch(err => console.error('createSubscription error:', err));
                    },
                    onApprove: function(data, actions) {
                        alert('Subscription completed successfully');
                        $("#payment_modal").modal('hide');
                        location.reload();
                    }
                }).render('#paypal-button-container');
            }

            // Event Listeners
            document.querySelectorAll('.plancardButton').forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    renderPayPalButton(button.getAttribute('data-paypal-route'), button.getAttribute('data-paypal-plan'));
                    $("#payment_modal").modal('show');
                });
            });

            document.getElementById('changePasswordButton').addEventListener('click', function () {
                var form = document.getElementById('passwordChangeForm');
                form.classList.toggle('hidden');
                form.classList.toggle('visible');
            });

            // Ensure the password change form is visible if there are validation errors
            @if ($errors->any())
                document.getElementById('passwordChangeForm').classList.remove('hidden');
                document.getElementById('passwordChangeForm').classList.add('visible');
            @endif

            document.getElementById('deleteAccountButton').addEventListener('click', function() {
                $("#deleteAccountModal").modal('show');
            });

            // Password Criteria Validation
            const passwordInput = document.getElementById('new_password');
            const passwordCriteria = document.getElementById('passwordCriteria');
            const criteria = {
                length: document.getElementById('lengthCriteria'),
                uppercase: document.getElementById('uppercaseCriteria'),
                number: document.getElementById('numberCriteria'),
                specialChar: document.getElementById('specialCharCriteria')
            };

            passwordInput.addEventListener('focus', () => passwordCriteria.classList.remove('hidden'));
            passwordInput.addEventListener('blur', () => {
                if (passwordInput.value === '') passwordCriteria.classList.add('hidden');
            });
            passwordInput.addEventListener('input', function() {
                const password = passwordInput.value;
                criteria.length.classList.toggle('text-success', password.length >= 8);
                criteria.length.classList.toggle('text-danger', password.length < 8);
                criteria.uppercase.classList.toggle('text-success', /[A-Z]/.test(password));
                criteria.uppercase.classList.toggle('text-danger', !/[A-Z]/.test(password));
                criteria.number.classList.toggle('text-success', /\d/.test(password));
                criteria.number.classList.toggle('text-danger', !/\d/.test(password));
                criteria.specialChar.classList.toggle('text-success', /[!@#$%^&*(),.?":{}|<>]/.test(password));
                criteria.specialChar.classList.toggle('text-danger', !/[!@#$%^&*(),.?":{}|<>]/.test(password));
            });
        });

        // Confirmations
        function confirmSilberStatus(url) {
            $('#confirmSilberModal').modal('show');
            document.getElementById('confirmSilberButton').onclick = function() {
                fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ subscription_name: 'silber' })
                }).then(response => {
                    if (response.ok) {
                        location.reload();
                    } else {
                        console.error('Failed to update subscription');
                    }
                }).catch(error => console.error('Error:', error));
            };
        }

        function confirmDeletion() {
            return confirm('ACHTUNG: Diese Aktion wird Ihren Account und alle damit verbundenen Daten dauerhaft löschen. Diese Aktion kann nicht rückgängig gemacht werden. Sind Sie sicher, dass Sie fortfahren möchten?');
        }
    </script>
</body>

</html>