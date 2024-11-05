<!DOCTYPE html>
<html lang="en">
<head>
    <title>Abonnement</title>
    <script src="https://www.paypal.com/sdk/js?client-id={{ config('services.paypal.client_id') }}&vault=true&intent=subscription"></script>
</head>
<body>
    <h1>Wähle deinen Abo</h1>
    <button id="paypal-button-gold">Gold - €10/Monat</button>
    <button id="paypal-button-diamant">Diamant - €20/Monat</button>

    <script>
        paypal.Buttons({
            createSubscription: function(data, actions) {
                return actions.subscription.create({
                    'plan_id': '{{ config('services.paypal.gold_plan_id') }}' 
                });
            },
            onApprove: function(data, actions) {
                alert('Abonnement erfolgreich! ID: ' + data.subscriptionID);
                window.location.href = "{{ route('subscriptions.success') }}";
            }
        }).render('#paypal-button-gold');

        paypal.Buttons({
            createSubscription: function(data, actions) {
                return actions.subscription.create({
                    'plan_id': '{{ config('services.paypal.diamant_plan_id') }}' 
                });
            },
            onApprove: function(data, actions) {
                alert('Abonnement erfolgreich! ID: ' + data.subscriptionID);
                window.location.href = "{{ route('subscriptions.success') }}";
            }
        }).render('#paypal-button-diamant');
    </script>
</body>
</html>
