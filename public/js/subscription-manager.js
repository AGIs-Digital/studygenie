const SubscriptionManager = {
    handleSubscriptionUpdate: function(response) {
        if (response.success) {
            localStorage.setItem('subscription_updated', 'true');
            this.updateUIElements(response.subscription_name);
            showToast('Abonnement erfolgreich aktualisiert', 'success');
        }
    },

    updateUIElements: function(subscriptionName) {
        // UI-Elemente aktualisieren
        document.querySelectorAll('[data-subscription-status]').forEach(element => {
            element.textContent = subscriptionName;
        });
        
        // Zugriffsberechtigungen aktualisieren
        document.querySelectorAll('[data-subscription-access]').forEach(element => {
            const requiredSubscription = element.dataset.subscriptionAccess;
            if (this.hasAccess(subscriptionName, requiredSubscription)) {
                element.classList.remove('disabled');
            } else {
                element.classList.add('disabled');
            }
        });
    },

    hasAccess: function(userSubscription, requiredSubscription) {
        const hierarchy = {
            'Silber': 1,
            'Gold': 2,
            'Diamant': 3
        };
        return hierarchy[userSubscription] >= hierarchy[requiredSubscription];
    }
};

window.SubscriptionManager = SubscriptionManager;
