<!DOCTYPE html>
<html lang="en">
<head>
    <title>Subscribe</title>
    <script src="https://www.paypal.com/sdk/js?client-id=Ae9G4SKK4gDuWY0Yw7J_6irXsfPepGSudxvUktzRQlYbdnOKTaDp2xmuC1mCWS6GTvalCH9Owt-HUl4S&vault=true&intent=subscription"></script>
</head>
<body>
    <h1>Choose Your Subscription</h1>
    <button id="paypal-button-gold">Subscribe to Gold - €10/month</button>
    <button id="paypal-button-diamant">Subscribe to Diamant - €20/month</button>

    <script>
        paypal.Buttons({
            createSubscription: function(data, actions) {
                return actions.subscription.create({
                    'plan_id': '{{ config('services.paypal.gold_plan_id') }}' 
                });
            },
            onApprove: function(data, actions) {
                alert('Subscription successful! ID: ' + data.subscriptionID);
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
                alert('Subscription successful! ID: ' + data.subscriptionID);
                window.location.href = "{{ route('subscriptions.success') }}";
            }
        }).render('#paypal-button-diamant');
    </script>
</body>
</html>
