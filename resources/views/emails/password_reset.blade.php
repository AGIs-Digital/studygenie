@component('mail::message')
# Passwort zurücksetzen

Sie erhalten diese E-Mail, weil wir eine Anfrage zum Zurücksetzen des Passworts für Ihr Konto erhalten haben.

@component('mail::button', ['url' => $url])
Passwort zurücksetzen
@endcomponent

Wenn Sie kein Zurücksetzen des Passworts angefordert haben, sind keine weiteren Maßnahmen erforderlich.

Danke,<br>
{{ config('app.name') }}
@endcomponent
