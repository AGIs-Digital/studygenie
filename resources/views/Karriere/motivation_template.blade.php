<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Motivationsschreiben PDF</title>
    <style>
        @page {
            size: A4;
            margin: 2cm 2cm 1cm 2cm;
        }
        body {
            font-family: Arial, sans-serif;
            line-height: 1.5;
            color: #000;
        }
        .container {
            width: 100%;
            max-width: 21cm;
            margin: 0 auto;
            padding: 0;
            box-sizing: border-box;
        }
        .address {
            margin-bottom: 1cm;
        }
        .date {
            text-align: right;
            margin-bottom: 1cm;
        }
        .subject {
            font-weight: bold;
            margin-bottom: 1cm;
        }
        .content {
            margin-bottom: 1cm;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="address">
            <!-- Absenderadresse -->
            <p>{{ $name }}<br>{{ $street }}<br>{{ $postal_city }} {{ $city }}<br>Tel: {{ $phone }}<br>E-Mail: {{ $email }}</p>
            <!-- Empfängeradresse -->
            <p>{{ $adressat_company }}    
            @if(!empty($adressat_person))
                <br>z.Hd. {{ $adressat_person }}
            @endif
            <br>{{ $adressat_street }}<br>{{ $adressat_postal_city }} {{ $adressat_city }}</p>
        </div>
        <div class="date">
            <p>{{ date('d.m.Y') }}</p>
        </div>
        <div class="subject">
            <p>Bewerbung - {{$stellenbezeichnung_job}}</p>
        </div>
        <div class="content">
            {!! $motivational_letter !!} <!-- Interpretiert den Inhalt als HTML -->
        </div>
        <div class="signature">
            <p>Mit freundlichen Grüßen,<br>{{ $name }}</p>
        </div>
    </div>
</body>
</html>