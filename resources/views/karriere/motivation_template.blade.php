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

        .header {
            margin-bottom: 2cm;
        }

        .header h1 {
            font-size: 24px;
            color: #2D3E4E;
            margin-bottom: 0.5cm;
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
    </style>
</head>

<body>
    <div class="container">
        <div class="address">
            <!-- Absenderadresse -->
            <p>
                {{ $name }}<br>
                {{ $street }}<br>
                {{ $postal_city }} {{ $city }}
                @if (!empty($phone))
                    <br>Tel: {{ $phone }}
                @endif
                @if (!empty($email))
                    <br>E-Mail: {{ $email }}
                @endif
            </p>
            <!-- Empfängeradresse -->
            <p>
                {{ $adressat_company }}
                @if (!empty($adressat_person))
                    <br>z.Hd. {{ $adressat_person }}
                @endif
                <br>{{ $adressat_street }}<br>{{ $adressat_postal_city }} {{ $adressat_city }}
            </p>
        </div>
        <div class="date">
            <p>{{ date('d.m.Y') }}</p>
        </div>
        <div class="subject">
            <p>Bewerbung - {{ $stellenbezeichnung_job }}</p>
        </div>
        <div class="content">
            {!! $openai_response !!}
        </div>
        <div class="signature">
            <p>Mit freundlichen Grüßen,<br>{{ $name }}</p>
        </div>
    </div>
</body>

</html>
