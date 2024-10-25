@component('mail::message')
# 🔑 Passwort zurücksetzen

Du erhältst diese E-Mail, weil wir eine Anfrage zum Zurücksetzen des Passworts für dein Konto erhalten haben.

@component('mail::button', ['url' => $url])
Passwort zurücksetzen
@endcomponent

✔️ Wenn du das nicht angefordert hast, kannst du diese E-Mail ignorieren.

Bis gleich!<br>
Dein {{ config('app.name') }}<br>
<img src="{{ asset('images/Logo_(2).png') }}" alt="Logo" width="133" height="77">
@endcomponent
